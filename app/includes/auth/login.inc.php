<?php
session_start();
include '../../classes/Page.class.php';

if(isset($_POST['submit'])){


    // Grabbing the data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instantiate LoginController class
    include '../../classes/Database.class.php';
    include '../../classes/models/auth/LoginUser.class.php';
    include '../../classes/controllers/auth/LoginUserController.class.php';

    $login = new LoginUserController($email, $password);    

    // Running error huandlers and user login
    $login->login();

    // Going back to front page
    if ($_SESSION['user_type'] === "MIS")
        Page::route('/admin/admission.php');
    else
        Page::route('/admin/index.php');
}