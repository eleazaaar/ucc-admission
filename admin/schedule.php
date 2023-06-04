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

    $display = "";

    $pdo = Database::connection();
    //SELECT SPECIFIC DATA DEPENDENPING ON CAMPUS OF USER | IF ADMIN, SELECT *
    if ($_SESSION['user_type'] !== 'ADMIN') {
        $stmt = $pdo->prepare("SELECT * FROM exam_schedule WHERE campus = ?");
        $stmt->execute([$_SESSION['user_campus']]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM exam_schedule");
        $stmt->execute();
    }
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($datas as $data) {
        $date = date_create($data['exam_date']);
        $time = strtotime($data['exam_time']);
        $isEmpty = (+$data['room_counter'] > 0) ? 'disabled' : 'enabled';
        $display .= "<tr>
                        <td>".$data['campus']."</td>
                        <td>".date_format($date, "l - F d, Y")."</td>
                        <td>".date("h:i A", $time)."</td>
                        <td>".$data['room_number']."</td>
                        <td>".$data['room_counter']."</td>
                        <td>".$data['max_room_counter']."</td>
                        <td>".$data['available_counter']."</td>
                        <td>".$data['class']."</td>
                        <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#schedule-modal' onclick='editSchedule(".$data['id'].")' $isEmpty><i class='fas fa-edit'></i></button>
                    </tr>";
    }
?>

<link rel="stylesheet" href=<?php echo Page::asset("/public/plugins/bs-stepper/css/bs-stepper.min.css"); ?>>
<link rel="stylesheet" href="<?php echo Page::asset('/public/plugins/jquery-ui/jquery-ui.css') ?>">
<link rel="stylesheet" href="<?php echo Page::asset('/public/plugins/toastr/toastr.min.css') ?>">

<div class="content-wrapper" style="min-height: 711px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Schedule</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white p-3">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- <h1 class="m-0">Schedule</h1> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#schedule-modal" onclick="clearScheduleForm()">Add Schedule</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped dataTable dtr-inline p-3" id="table-schedule">
            <thead>
                <tr>
                    <th>Campus</th>
                    <th>Exam Date</th>
                    <th>Exam Time</th>
                    <th>Room Number</th>
                    <th>Room Counter</th>
                    <th>Max Room Counter</th>
                    <th>Available Counter</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $display; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="schedule-modal" tabindex="-1" role="dialog" aria-labelledby="schedule-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="schedule-modal-label">Add Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container">
                        <form id="frm-schedule" method="post" class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-6" style="display: none">
                                                <div class="form-group">
                                                    <label for="exam_sched_id">Exam Schedule ID</label>
                                                    <input type="text" class="form-control" name="id" id="id" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="campus">CAMPUS</label>
                                                    <select class="form-control" name="campus" id="campus" required>
                                                        <option name="campus" value=""></option>
                                                        <option name="campus" value="MAIN">MAIN</option>
                                                        <option name="campus" value="NORTH">NORTH</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="room_counter">Max Counter</label>
                                                    <input type="number" class="form-control" name="max_room_counter" id="max_room_counter" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exam_date">Exam Date</label>
                                                    <input type="date" class="form-control" name="exam_date" id="exam_date" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exam_time">Exam Time</label>
                                                    <input type="time" class="form-control" name="exam_time" id="exam_time" required>
                                                    <!-- <select class="form-control" name="exam_time" id="exam_time" required>
                                                        <option name="exam_time" value=""></option>
                                                        <option name="exam_time" value="8:00 AM">8:00 AM</option>
                                                        <option name="exam_time" value="1:00 PM">1:00 PM</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="room_number">Room Number</label>
                                                    <input type="number" class="form-control" name="room_number" id="room_number" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="class">Class</label>
                                                    <select class="form-control" name="class" id="class" required>
                                                        <option value=""></option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="saveSchedule" class="btn btn-primary" data-dismiss="modal" onclick="addSchedule()">Save</button>
                                            <button type="button" id="updateSchedule" class="btn btn-primary" data-dismiss="modal" onclick="updateScheduleById()">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
<script>
    $(function () {
        $("#table-schedule").DataTable();
    });
</script>
<script src="js/ajax.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<?php include_once "../app/resources/views/end.layout.php";?>
