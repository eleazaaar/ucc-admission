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
                $stmt = $pdo->prepare("SELECT * FROM exam_schedule WHERE id = ?");
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