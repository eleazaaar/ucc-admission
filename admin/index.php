<?php 
    session_start();
    include "../app/classes/Page.class.php";
    
    if(!isset($_SESSION['admission_user_token'])){
        Page::route('/login.php');
    }

    include_once "../app/classes/Database.class.php";
    include_once "../app/resources/views/start.layout.php";
    include_once "../app/resources/views/components/datatable-link.component.php";
    include_once "../app/resources/views/header.layout.php";
?>

<link rel="stylesheet" href=<?php echo Page::asset("/public/plugins/bs-stepper/css/bs-stepper.min.css"); ?>>
<link rel="stylesheet" href="<?php echo Page::asset('/public/plugins/jquery-ui/jquery-ui.css') ?>">
<link rel="stylesheet" href="<?php echo Page::asset('/public/plugins/toastr/toastr.min.css') ?>">

<?php include_once "registrationForm.php"; ?>

<script src="<?php echo Page::asset("/public/plugins/bs-stepper/js/bs-stepper.min.js"); ?>"></script>
<script src="<?php echo Page::asset('/public/plugins/jquery-ui/jquery-ui.js') ?>"></script>
<script src="<?php echo Page::asset("/public/plugins/toastr/toastr.min.js"); ?>"></script>

<?php include_once "../app/resources/views/footer.layout.php";?>
<?php include_once "../app/resources/views/components/required-script.component.php";?>
<?php include_once "../app/resources/views/components/datatable-script.component.php";?>
<script src="js/jquery-ajax.min.js"></script>
<script src="js/ajax.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<?php include_once "../app/resources/views/end.layout.php";?>
