<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $api_key_value = "tPmAT5Ab3j7F9";
    if(isset($_POST['api_key'])){
        $api_key = $_POST['api_key'];
        $code = $_POST['appointment_code'];
        if($api_key_value === $api_key){
            try{
                $pdo = Database::connection();
                $stmt = $pdo->prepare("SELECT examinee_requirements.*, student.*, examinee.grade FROM student INNER JOIN examinee_requirements ON student.student_code = examinee_requirements.student_code INNER JOIN examinee ON student.student_code = examinee.student_code WHERE student.student_code = ?");
                $stmt->execute([$code]);
                $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($datas) === 0) {
                    $stmt = $pdo->prepare("SELECT * FROM student WHERE student_code = ?");
                    $stmt->execute([$code]);
                    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                $jsonData = [
                    "data"=>$datas
                ];
                echo json_encode($jsonData);
            } catch(PDOException $e) {
                echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
            } catch(Exception $er) {
                echo json_encode(['error' => 'Server error: ' . $er->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Invalid API key']);
        }
    } else {
        echo json_encode(['error' => 'Missing API key']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>