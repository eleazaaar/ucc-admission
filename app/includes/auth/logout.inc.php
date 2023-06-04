<?php
session_start();
include '../../classes/Page.class.php';

if(isset($_POST['submit'])){
    session_unset();
    Page::route('/index.php');
}