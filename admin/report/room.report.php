<?php
include_once "../../app/classes/Database.class.php";
require('fpdf/fpdf.php');

// var_dump($_GET);

class PDF extends FPDF {
// Page header
    function Header() {
        // Logo
        $this->Image('../../public/assets/img/ucc.png', 37.5, 12, 15);

        $x = 25; $y = 25;

        $this->SetFont('times','B', 18);
        $this->Cell(0, 15, 'UNIVERSITY OF CALOOCAN CITY', $x, $y, 'C');
        $this->SetFont('times','I', 9);
        $this->Cell(0, 0, 'BIGLANG AWA ST. GRACE PARK EAST, 12TH AVENUE, CALOOCAN CITY', $x, $y, 'C');
    }

    function main() {
        $data = array(
            'exam_date' => $_GET['date'],
            'campus' => $_GET['campus']
        );

        $x = 25; $y = 35;
        $this->setY($y);
        $this->SetFont('times','B', 16);
        $this->Cell(0, 15, 'ADTEST ROOM REPORT', 0, 0, 'C');

        $x = 20; $y = 55;
        $this->setXY($x, $y);
        $this->SetFont('times','', 12);
        $date = date_create($data['exam_date']);
        $this->Cell(0, 6, 'Date of Exam: ' . date_format($date,"F d, Y"), $x, $y);

        $x = 25; $y = 70;
        $this->SetXY($x, $y);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 7, 'Room No.', 0, 0, 'C');
        $this->Cell(65, 7, 'Counter', 0, 0, 'C');
        $this->Cell(35, 7, 'Class', 0, 0, 'C');
        $this->Cell(35, 7, 'Campus', 0, 0, 'C');
        $this->Ln();

        $pdo = Database::connection();
        $sql = "SELECT * FROM exam_schedule WHERE campus = :campus AND exam_date = :exam_date ORDER BY room_number ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // $x = 35; $y = 70;

        foreach ($datas as $data) {
            // var_dump($data);]
            $y += 7;
            $this->SetXY($x, $y);
            $this->SetFont('Arial', '', 10);
            $this->Cell(25, 7, $data['room_number'], 0, 0, 'C');
            $this->Cell(65, 7, $data['room_counter'], 0, 0, 'C');
            $this->Cell(35, 7, $data['class'], 0, 0, 'C');
            $this->Cell(35, 7, $data['campus'], 0, 0, 'C');
            $this->Ln();
        }
    }

    // Page footer
    function Footer() {
        
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage('P', 'Letter', 0);
$pdf->AliasNbPages();
$pdf->main();
$pdf->SetTitle("Room Report");
$pdf->Output('I', 'Room Report.pdf');
?>

