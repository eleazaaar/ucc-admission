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

            $stmt = $pdo->prepare("SELECT * FROM examinee WHERE or_number = ?");
            $stmt->execute([$_POST['or_number']]);
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($datas == null) {
                $data = array(
                    'exam_schedule_id' => $_POST['exam_schedule_id'],
                    'seat_number' => $_POST['seat_number']
                );
                
                $stmt = $pdo->prepare("SELECT * FROM examinee WHERE exam_schedule_id = :exam_schedule_id AND seat_number = :seat_number");
                $stmt->execute($data);
                $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($datas == null) {
                    $data = array(
                        'id' => $_POST['student_id'],
                        'exam_schedule_id' => $_POST['exam_schedule_id'],
                        'seat_number' => $_POST['seat_number'],
                        'or_number' => $_POST['or_number'],
                        'or_date' => $_POST['or_date']
                    );

                    $stmt = $pdo->prepare("UPDATE examinee SET exam_schedule_id = :exam_schedule_id ,seat_number = :seat_number, or_number = :or_number, or_date = :or_date, is_scheduled = 1 WHERE id = :id");
                    $stmt->execute($data);

                    $data = array(
                        'exam_schedule_id' => $_POST['exam_schedule_id'],
                        'seat_number' => $_POST['seat_number']
                    );
                    
                    if ($_POST['from_available'] === "true") {
                        $stmt = $pdo->prepare("DELETE FROM exam_schedule_available WHERE exam_schedule_id = :exam_schedule_id AND seat_number = :seat_number");
                        $stmt->execute($data);
                    } else {
                        $stmt = $pdo->prepare("UPDATE exam_schedule SET room_counter = :seat_number WHERE id = :exam_schedule_id");
                        $stmt->execute($data);
                    }

                    $stmt = $pdo->prepare("SELECT COUNT(*) as available_count FROM exam_schedule_available WHERE exam_schedule_id = ?");
                    $stmt->execute([$_POST['exam_schedule_id']]);
                    $datas = $stmt->fetchAll();

                    foreach ($datas as $data) {
                        $available_count = $data['available_count'];
                    }

                    $data = array(
                        'exam_schedule_id' => $_POST['exam_schedule_id'],
                        'available_count' => $available_count
                    );

                    $stmt = $pdo->prepare("UPDATE exam_schedule SET available_counter = :available_count WHERE id = :exam_schedule_id");
                    $stmt->execute($data);

                    echo "Success";
                } else {
                    echo "Schedule Not Available";
                }
            } else {
                foreach ($datas as $data) {
                   echo "Duplicate OR Number: " . $data['student_code'];
                   return;
                }
            }
        }
    }
    // Going back to front page
    // Page::route('/admin/index.php');
} else {
    echo "Invalid request method";
}
?>