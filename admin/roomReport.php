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

<div class="content-wrapper" style="min-height: 711px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Room Report</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white p-3">
        <div class="content">
            <div class="container">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="campus">Campus</label>
                                        <!-- <input type="text" class="form-control" name="campus" id="campus" placeholder="" required> -->
                                        <select class="form-control" name="campus" id="campus" required>
                                            <option value=""></option>
                                            <option value="MAIN">MAIN</option>
                                            <option value="NORTH">NORTH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exam_date">Exam Date</label>
                                        <input type="date" class="form-control" name="exam_date" id="exam_date" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <a href="report/room.report.php" target="_blank" class="btn btn-primary">PRINT</a> -->
                                <button id="view" type="button" class="btn btn-primary" onclick="viewRoomReport()">PRINT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo Page::asset("/public/plugins/bs-stepper/js/bs-stepper.min.js"); ?>"></script>
<script src="<?php echo Page::asset('/public/plugins/jquery-ui/jquery-ui.js') ?>"></script>
<script src="<?php echo Page::asset("/public/plugins/toastr/toastr.min.js"); ?>"></script>

<?php include_once "../app/resources/views/footer.layout.php";?>
<?php include_once "../app/resources/views/components/required-script.component.php";?>
<?php include_once "../app/resources/views/components/datatable-script.component.php";?>
<script src="js/ajax.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<?php include_once "../app/resources/views/end.layout.php";?>
