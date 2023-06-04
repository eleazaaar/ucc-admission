<?php
    session_start();
    include_once('app/classes/Page.class.php');
    
    if(isset($_SESSION['admission_user_token'])){
      Page::route('/admin/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCC Admission | Log in</title>

    <link href="public/assets/img/logo.png" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=<?php echo Page::asset("/public/plugins/fontawesome-free/css/all.min.css");?>>        
    <!-- Theme style -->
    <link rel="stylesheet" href=<?php echo Page::asset("/public/dist/css/adminlte.min.css");?>>
    <link href="public/assets/css/style.css" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="login-box">
                        <div class="login-logo">                        
                            <a href='index.php'><b>UCC </b> Admission</a>
                        </div>
                        <!-- /.login-logo -->
                        <div class="card">
                            <div class="card-body login-card-body">
                                <p class="login-box-msg">Sign in to start your session</p>
    
                                <form action="./app/includes/auth/login.inc.php" method="POST">
                                    <div class="input-group mb-3">
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign
                                                In</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                                <p class="mb-0">
                                    <!-- <a href="register.php" class="text-center">Create a new account</a> -->
                                </p>
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img">
                    <img src="public/assets/img/undraw_Visionary_technology.svg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src=<?php echo Page::asset("/public/plugins/jquery/jquery.min.js");?>></script>
    <!-- Bootstrap 4 -->
    <script src=<?php echo Page::asset("/public/plugins/bootstrap/js/bootstrap.bundle.min.js");?>></script>
    <!-- AdminLTE App -->
    <script src=<?php echo Page::asset("/public/dist/js/adminlte.min.js");?>></script>
    <script src="public/assets/js/main.js"></script>
</body>

</html>