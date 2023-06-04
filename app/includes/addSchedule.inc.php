<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

// print_r($_POST);
// $category = "RES (MAIN)";
$default_room_counter = 0;

if($_SERVER["REQUEST_METHOD"]==="POST") {
    $data = array(
        'campus' => $_POST['campus'],
        'exam_date' => $_POST['exam_date'],
        'exam_time' => $_POST['exam_time'],
        'room_number' => $_POST['room_number']
    );

    $pdo = Database::connection();
    $stmt = $pdo->prepare("SELECT * FROM exam_schedule WHERE campus = :campus AND exam_date = :exam_date AND exam_time = :exam_time AND room_number = :room_number");
    $stmt->execute($data);
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($datas == null) {
        $data = array(
            'campus' => $_POST['campus'],
            'exam_date' => $_POST['exam_date'],
            'exam_time' => $_POST['exam_time'],
            'room_number' => $_POST['room_number'],
            'room_counter' => $default_room_counter,
            'max_room_counter' => $_POST['max_room_counter'],
            'class' => $_POST['class']
        );
        
        $sql = "INSERT INTO `exam_schedule` (`campus`, `exam_date`, `exam_time`, `room_number`, `room_counter`, `max_room_counter`, `class`) VALUES (:campus, :exam_date, :exam_time, :room_number, :room_counter, :max_room_counter, :class)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        // Going back to front page
        // Page::route('/admin/index.php');
        echo "Success";
    } else {
        // Student already Exists!
        // Page::route('/admin/index.php');
        echo "Room Not Available";
    }
} else {
    echo "Invalid request method";
}
?>