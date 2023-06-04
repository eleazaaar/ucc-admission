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
            'campus' => $_GET['campus'],
            'exam_date' => $_GET['date'],
            'exam_time' => $_GET['time'],
            'count' => 0
        );

        $pdo = Database::connection();
        $sql = "SELECT * FROM exam_schedule WHERE campus = :campus AND exam_date = :exam_date AND exam_time = :exam_time AND room_counter > :count ORDER BY room_number ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($datas as $data) {
            // var_dump($data);

            $this->AddPage('P', 'Letter', 0);

            $x = 25; $y = 35;
            $this->setY($y);
            $this->SetFont('times','B', 16);
            $this->Cell(0, 15, 'ADTEST EXAMINEES LISTING', 0, 0, 'C');

            $x = 20; $y = 50;
            $this->setXY($x, $y);
            $this->SetFont('times','', 12);
            $this->Cell(0, 6, 'Room Number: ' . $data['room_number'], $x, $y);
            $this->Cell(0, 6, 'Category: ' . $data['class'], $x, $y);

            $x = 130; $y = 50;
            $this->setXY($x, $y);
            $this->SetFont('times','', 12);
            $date = date_create($data['exam_date']);
            $this->Cell(0, 6, 'Date of Exam: ' . date_format($date,"F d, Y"), $x, $y);
            $this->Cell(0, 6, 'Time: ' . $data['exam_time'], $x, $y);

            $x = 25; $y = 70;
            $this->SetXY($x, $y);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(25, 7, 'No.', 0, 0, 'C');
            $this->Cell(65, 7, 'Name', 0, 0, 'C');
            // $this->Cell(20, 7, 'Category', 0, 0, 'C');
            $this->Cell(35, 7, 'Code', 0, 0, 'C');
            $this->Cell(35, 7, 'Signature', 0, 0, 'C');
            $this->Ln();

            $examScheduleId = $data['id'];
            $campus = $data['campus'];

            $sql = "SELECT examinee.*, student.first_name, student.middle_name, student.last_name FROM examinee INNER JOIN student ON examinee.student_code = student.student_code WHERE examinee.exam_schedule_id = ? AND examinee.campus = ? ORDER BY examinee.seat_number ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$examScheduleId, $campus]);
            $studentDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $x = 25; $y = 75;

            foreach ($studentDatas as $studentData) {
                $y += 5;
                $fullName = $studentData['last_name'] . ", " . $studentData['first_name'] . " " . $studentData['middle_name'];
                $this->SetXY($x, $y);
                $this->SetFont('Arial', '', 10);
                $this->Cell(25, 5, $studentData['seat_number'], 0, 0, 'C');
                $this->Cell(65, 5, $fullName, 0, 0);
                // $this->Cell(20, 5, $studentData['class'], 0, 0, 'C');
                $this->Cell(35, 5, $studentData['student_code'], 0, 0, 'C');
                $this->Cell(35, 5, '__________', 0, 0, 'C');
                $this->Ln();
                
            }

        }
    }

    // Page footer
    function Footer() {
        
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->main();
$pdf->SetTitle("Examinees Report");
$pdf->Output('I', 'Examinees Report.pdf');
?>

