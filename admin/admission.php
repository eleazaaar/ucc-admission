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

    try {
        //code...
        $pdo = Database::connection();
        //SELECT SPECIFIC DATA DEPENDENPING ON CAMPUS OF USER | IF ADMIN, SELECT *
        if ($_SESSION['user_type'] !== 'ADMIN') {
            $stmt = $pdo->prepare("SELECT examinee.id, examinee.student_code, examinee.grade, examinee.is_scheduled, examinee.campus, student.last_name, student.first_name, student.middle_name FROM examinee INNER JOIN student ON examinee.student_code = student.student_code WHERE examinee.campus = ?");
            $stmt->execute([$_SESSION['user_campus']]);
        } else {
            $stmt = $pdo->prepare("SELECT examinee.id, examinee.student_code, examinee.grade, examinee.is_scheduled, examinee.campus, student.last_name, student.first_name, student.middle_name FROM examinee INNER JOIN student ON examinee.student_code = student.student_code");
            $stmt->execute();
        }
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datas as $data) {
            $fullName = $data['last_name'] . ", " . $data['first_name']. " " . $data['middle_name'];
            $scheduleStatus = ($data['is_scheduled']) ? "<i class='fa fa-check-circle fa-2x' style='color: green'></i>" : "<i class='fa fa-times-circle fa-2x' style='color: red'></i>";
            $scheduled = ($data['is_scheduled']) ? "" : "hidden";
            
            $display .= "<tr>
                    <td style='text-align: center'>".$data['student_code']."</td>
                    <td>".$fullName."</td>
                    <td style='text-align: center'>".$data['grade']."</td>
                    <td style='text-align: center'>".$scheduleStatus."</td>
                    <td style='text-align: center'>".$data['campus']."</td>
                    <td style='text-align: center'>
                        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#student-modal' onclick='viewStudentSchedule(".$data['id'].")' $scheduled><i class='fas fa-eye'></i></button>
                        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#student-modal' onclick='editStudentSchedule(".$data['id'].")'><i class='fas fa-edit'></i></button>
                    </td>
                </tr>";
        }
    } catch (\Throwable $th) {
        //throw $th;
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
                    <h1 class="m-0">Students</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white p-3">
        <table class="table table-bordered table-striped dataTable dtr-inline p-3" id="table-schedule">
            <thead>
                <tr>
                    <th>Student Code</th>
                    <th>Name</th>
                    <th>General Average</th>
                    <th>Schedule Status</th>
                    <th>Campus</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $display; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="student-modal" tabindex="-1" role="dialog" aria-labelledby="schedule-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-modal-label">Student Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container">
                        <form id="frm-student" method="post" class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-body p-2">
                                        <div class="row" hidden>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="student_id">Student ID</label>
                                                    <input type="text" class="form-control" name="student_id" id="student_id" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="student_code">Student Code</label>
                                                    <input type="text" class="form-control" name="student_code" id="student_code" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="campus">Campus</label>
                                                    <input type="text" class="form-control" name="campus" id="campus" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="student_id">Student Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" hidden>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="schedule_id">Old Schedule ID</label>
                                                    <input type="text" class="form-control" name="old_exam_schedule_id" id="old_exam_schedule_id" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="old_seat_number">Old Seat Number</label>
                                                    <input type="text" class="form-control" name="old_seat_number" id="old_seat_number" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="old_exam_schedule_id">New Schedule ID</label>
                                                    <input type="text" class="form-control" name="exam_schedule_id" id="exam_schedule_id" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="available">From Available?</label>
                                                    <input type="text" class="form-control" name="from_available" id="from_available" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="student_id">Average</label>
                                                    <input type="text" class="form-control" name="grade" id="grade" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="student_id">Class</label>
                                                    <input type="text" class="form-control" name="class" id="class" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exam_date">Exam Date</label>
                                                    <input type="date" class="form-control" name="exam_date" id="exam_date" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exam_time">Exam Time</label>
                                                    <input type="time" class="form-control" name="exam_time" id="exam_time" readonly required>
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
                                                    <input type="number" class="form-control" name="room_number" id="room_number" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="room_number">Seat Number</label>
                                                    <input type="number" class="form-control" name="seat_number" id="seat_number" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="room_number">OR Number</label>
                                                    <input type="text" class="form-control" name="or_number" id="or_number" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="room_number">OR Date</label>
                                                    <input type="date" class="form-control" name="or_date" id="or_date" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="button" id="saveStudentSchedule" class="btn btn-success" onclick="saveStudentExamSchedule()">Save</button>
                                            <button type="button" id="updateStudentSchedule" class="btn btn-success" onclick="updateStudentExamSchedule()">Update</button>
                                            <button type="button" id="updateOR" class="btn btn-primary" onclick="updateStudentOR()">Update OR Only</button>
                                            <br><br><br>
                                            <button type="button" id="rescheduleStudentSchedule" class="btn btn-info" onclick="rescheduleStudentExamSchedule()">Reschedule Student</button>
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
