<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

// print_r($_POST);

if($_SERVER["REQUEST_METHOD"]==="POST") {
    $api_key_value = "tPmAT5Ab3j7F9";
    if(isset($_POST['api_key'])) {
        $api_key = $_POST['api_key'];
        if($api_key_value === $api_key){
            $pdo = Database::connection();

            $data = array(
                'id' => $_POST['id'],
                'code' => $_POST['code'],
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'pob' => $_POST['pob'],
                'dob' => $_POST['dob'],
                'gender' => $_POST['gender'],
                'age' => $_POST['age'],
                'civil_status' => $_POST['civil_status'],
                'citizenship' => $_POST['citizenship'],
                'religion' => $_POST['religion'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'telephone' => $_POST['telephone'],
                'address' => $_POST['address'],
                'brgy' => $_POST['brgy'],
                'zone' => $_POST['zone'],
                'district' => $_POST['district'],
                'mother_name' => $_POST['mother_name'],
                'father_name' => $_POST['father_name'],
                'mother_occupation' => $_POST['mother_occupation'],
                'father_occupation' => $_POST['father_occupation'],
                'guardian' => $_POST['father_occupation'],
                'guardian_relation' => $_POST['guardian_relation'],
                'guardian_address' => $_POST['guardian_address'],
                'elementary' => $_POST['elementary'],
                'elementary_graduated' => $_POST['elementary_graduated'],
                'high_school' => $_POST['high_school'],
                'high_school_graduated' => $_POST['high_school_graduated'],
                'senior_high' => $_POST['senior_high'],
                'senior_high_graduated' => $_POST['senior_high_graduated'],
                'strand' => $_POST['strand']
            );

            $stmt = $pdo->prepare("UPDATE student SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, email = :email, phone = :phone, telephone = :telephone, pob = :pob, dob = :dob, age = :age, gender = :gender, address = :address, brgy = :brgy, zone = :zone, district = :district, civil_status = :civil_status, citizenship = :citizenship, religion = :religion, mother_name = :mother_name, mother_occupation = :mother_occupation, father_name = :father_name, father_occupation = :father_occupation, guardian = :guardian, guardian_relation = :guardian_relation, guardian_address = :guardian_address, elementary = :elementary, elementary_graduated = :elementary_graduated, high_school = :high_school, high_school_graduated = :high_school_graduated, senior_high = :senior_high, senior_high_graduated = :senior_high_graduated, strand = :strand WHERE id = :id AND student_code = :code");
            $stmt->execute($data);

            $data = array(
                'code' => $_POST['code'],
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
            $stmt = $pdo->prepare("UPDATE examinee_requirements SET birth_certificate = :birth_certificate, diploma_elementary = :diploma_elementary, diploma_high_school = :diploma_high_school, voters_id_parent = :voters_id_parent, voters_id_applicant = :voters_id_applicant, voters_certificate_parent = :voters_certificate_parent, voters_certificate_applicant = :voters_certificate_applicant, good_moral = :good_moral, form_138 = :form_138 WHERE student_code = :code");
            $stmt->execute($data);

            $data = array(
                'grade' => $_POST['grade'],
                'code' => $_POST['code']
            );
            
            $stmt = $pdo->prepare("UPDATE examinee SET grade = :grade WHERE student_code = :code");
            $stmt->execute($data);

            echo "Success";
        }
    }
    // Going back to front page
    // Page::route('/admin/index.php');
} else {
    echo "Invalid request method";
}
?>