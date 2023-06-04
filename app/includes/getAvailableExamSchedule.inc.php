<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

if($_SERVER["REQUEST_METHOD"]==="POST") {
    $api_key_value = "tPmAT5Ab3j7F9";
    if(isset($_POST['api_key'])) {
        $api_key = $_POST['api_key'];
        $campus = $_POST['campus'];
        $exam_class = $_POST['exam_class'];

        if($api_key_value === $api_key){
            try{
                $pdo = Database::connection();
                $stmt = $pdo->prepare("SELECT exam_schedule_available.exam_schedule_id, exam_schedule_available.seat_number, exam_schedule.campus, exam_schedule.class FROM exam_schedule_available INNER JOIN exam_schedule ON exam_schedule_available.exam_schedule_id = exam_schedule.id WHERE exam_schedule.campus = ? AND exam_schedule.class = ? ORDER BY exam_schedule_available.id LIMIT 1");
                $stmt->execute([$campus, $exam_class]);
                $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($datas != null) {
                    foreach ($datas as $data) {
                        $id = $data['exam_schedule_id'];
                    }
                    $stmt = $pdo->prepare("SELECT exam_schedule.*, exam_schedule_available.seat_number FROM exam_schedule INNER JOIN exam_schedule_available ON exam_schedule_available.exam_schedule_id = exam_schedule.id WHERE exam_schedule.id = ?");
                    $stmt->execute([$id]);
                    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $stmt = $pdo->prepare("SELECT * FROM exam_schedule WHERE campus = ? AND class = ? AND room_counter < max_room_counter ORDER BY id LIMIT 1");
                    $stmt->execute([$campus, $exam_class]);
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