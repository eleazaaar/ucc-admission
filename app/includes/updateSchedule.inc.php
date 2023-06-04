<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

// print_r($_POST);

if($_SERVER["REQUEST_METHOD"]==="POST") {

    $data = array(
        'id' => $_POST['schedule_id'],
        'campus' => $_POST['campus'],
        'exam_date' => $_POST['exam_date'],
        'exam_time' => $_POST['exam_time'],
        'room_number' => $_POST['room_number']
    );

    $pdo = Database::connection();
    $stmt = $pdo->prepare("SELECT * FROM exam_schedule WHERE campus = :campus AND exam_date = :exam_date AND exam_time = :exam_time AND room_number = :room_number AND id != :id");
    $stmt->execute($data);
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($datas == null) {
        $data = array(
            'id' => $_POST['schedule_id'],
            'campus' => $_POST['campus'],
            'exam_date' => $_POST['exam_date'],
            'exam_time' => $_POST['exam_time'],
            'room_number' => $_POST['room_number'],
            'max_room_counter' =>  $_POST['max_room_counter'],
            'class' => $_POST['class']
        );

        $pdo = Database::connection();
        $stmt = $pdo->prepare("UPDATE  exam_schedule SET campus = :campus, exam_date = :exam_date, exam_time = :exam_time,  room_number = :room_number, max_room_counter = :max_room_counter, class = :class WHERE id = :id");
        $stmt->execute($data);

        // Going back to front page
        // Page::route('/admin/index.php');
        echo "Success";
    } else {
        echo "Date/Time not Available";
    }
} else {
    echo "Invalid request method";
}
?>