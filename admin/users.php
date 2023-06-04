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
    $stmt = $pdo->prepare("SELECT * FROM admission_user WHERE user_type != 'ADMIN'");
    // $stmt = $pdo->prepare("SELECT * FROM admission_user");
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datas as $data) {
        $display .= "<tr>
                        <td>".$data['name']."</td>
                        <td>".$data['email']."</td>
                        <td style='text-align: center'>".$data['user_type']."</td>
                        <td style='text-align: center'>
                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#student-modal' onclick='viewUser(".$data['id'].")'><i class='fas fa-eye'></i></button>
                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#student-modal' onclick='editUser(".$data['id'].")'><i class='fas fa-edit'></i></button>
                        </td>
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
                    <h1 class="m-0">User Accounts</h1>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-modal" onclick="clearUserForm()">Add User</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped dataTable dtr-inline p-3" id="table-schedule">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $display; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="user-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user-modal-label">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container">
                        <form id="frm-user" method="post" class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="campus">Campus</label>
                                                    <select class="form-control" name="campus" id="campus" required>
                                                        <option value=""></option>
                                                        <option value="MAIN">MAIN</option>
                                                        <option value="NORTH">NORTH</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" name="username" id="username" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="user_type">User Type</label>
                                                    <select class="form-control" name="user_type" id="user_type" required>
                                                        <option value=""></option>
                                                        <option value="REGISTRAR">REGISTRAR</option>
                                                        <option value="MIS">MIS</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="fullname">Name</label>
                                                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="confirm_password">Confirm Password</label>
                                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="saveUser" class="btn btn-primary" data-dismiss="modal" onclick="addUser()">Save</button>
                                            <button type="button" id="updateUser" class="btn btn-primary" data-dismiss="modal" onclick="updateUser()">Update</button>
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
