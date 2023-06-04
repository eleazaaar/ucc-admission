<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

// print_r($_POST);

if($_SERVER["REQUEST_METHOD"]==="POST") {
    $student_code = $_POST['student_code'];
    $grade = $_POST['grade'];
    $campus = ($_POST['campus'] == "1") ? "MAIN" : "NORTH";
    
    $pdo = Database::connection();

    $stmt = $pdo->prepare("SELECT * FROM examinee WHERE student_code = ?");
    $stmt->execute([$student_code]);
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $requirementsData = array(
        'student_code' => $_POST['student_code'],
        'birth_certificate' => $_POST['birth_certificate'],
        'diploma_elementary' => $_POST['diploma_elementary'],
        'diploma_high_school' => $_POST['diploma_high_school'],
        'voters_id_parent' => $_POST['voters_id_parent'],
        'voters_id_applicant' => $_POST['voters_id_applicant'],
        'voters_certificate_parent' => $_POST['voters_certificate_parent'],
        'voters_certificate_applicant' => $_POST['voters_certificate_applicant'],
        'good_moral' => $_POST['good_moral'],
        'form_138' => $_POST['form_138']
    );

    if ($datas == null || $datas == []) {
        $stmt = $pdo->prepare("INSERT INTO examinee (student_code, grade, campus) VALUES (?, ?, ?)");
        $stmt->execute([$student_code, $grade, $campus]);
        
        $stmt = $pdo->prepare("INSERT INTO examinee_requirements (student_code, birth_certificate, diploma_elementary, diploma_high_school, voters_id_parent, voters_id_applicant, voters_certificate_parent, voters_certificate_applicant, good_moral, form_138) VALUES (:student_code, :birth_certificate, :diploma_elementary, :diploma_high_school, :voters_id_parent, :voters_id_applicant, :voters_certificate_parent, :voters_certificate_applicant, :good_moral, :form_138)");
        $stmt->execute($requirementsData);

        // Going back to front page
        // Page::route('/admin/index.php');
        echo "Added Successfully";
    } else {
        $stmt = $pdo->prepare("UPDATE examinee SET grade = ? WHERE student_code = ?");
        $stmt->execute([$grade, $student_code]);

        $stmt = $pdo->prepare("UPDATE examinee_requirements SET birth_certificate = :birth_certificate, diploma_elementary = :diploma_elementary, diploma_high_school = :diploma_high_school, voters_id_parent = :voters_id_parent, voters_id_applicant = :voters_id_applicant, voters_certificate_parent = :voters_certificate_parent, voters_certificate_applicant = :voters_certificate_applicant, good_moral = :good_moral, form_138 = :form_138 WHERE student_code = :student_code");
        $stmt->execute($requirementsData);

        // Student already Exists!
        // Page::route('/admin/index.php');
        echo "Updated Successfully";
    }
} else {
    echo "Invalid request method";
}
?>