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

            $stmt = $pdo->prepare("SELECT * FROM examinee WHERE id = ?");
            $stmt->execute([$_POST['student_id']]);
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($datas !== null) {
                $data = array(
                    'id' => $_POST['student_id'],
                    'or_number' => $_POST['or_number'],
                    'or_date' => $_POST['or_date']
                );

                $stmt = $pdo->prepare("UPDATE examinee SET or_number = :or_number, or_date = :or_date WHERE id = :id");
                $stmt->execute($data);

                echo "Success";
            } else {
                echo "Schedule Not Available";
            }
        }
    }
    // Going back to front page
    // Page::route('/admin/index.php');
} else {
    echo "Invalid request method";
}
?>