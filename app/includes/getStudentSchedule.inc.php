<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

if($_SERVER["REQUEST_METHOD"]==="POST") {
    $api_key_value = "tPmAT5Ab3j7F9";
    if(isset($_POST['api_key'])) {
        $api_key = $_POST['api_key'];
        $id = $_POST['id'];
        if($api_key_value === $api_key){
            try{
                $pdo = Database::connection();
                $stmt = $pdo->prepare("SELECT examinee.*, student.last_name, student.first_name, student.middle_name, exam_schedule.* FROM examinee INNER JOIN student ON examinee.student_code = student.student_code INNER JOIN exam_schedule ON examinee.exam_schedule_id = exam_schedule.id WHERE examinee.id = ?");
                $stmt->execute([$id]);
                $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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