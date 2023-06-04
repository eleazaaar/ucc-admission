<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

// print_r($_POST);

if($_SERVER["REQUEST_METHOD"]==="POST") {
    $username = $_POST['username'];

    $pdo = Database::connection();
    $stmt = $pdo->prepare("SELECT * FROM admission_user WHERE email = ?");
    $stmt->execute([$username]);
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($datas == null) {
        $data = array(
            'campus' => $_POST['campus'],
            'username' => $_POST['username'],
            'user_type' => $_POST['user_type'],
            'fullname' => $_POST['fullname'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        );

        $sql = "INSERT INTO admission_user (name, email, password, user_type, user_campus) VALUES (:fullname, :username, :password, :user_type, :campus)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        // Going back to front page
        // Page::route('/admin/index.php');
        echo "Success";
    } else {
        // Student already Exists!
        // Page::route('/admin/index.php');
        echo "Email Already Taken";
    }
} else {
    echo "Invalid request method";
}
?>