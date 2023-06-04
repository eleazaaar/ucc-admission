    <!-- Theme style -->
    <link rel="stylesheet" href=<?php echo Page::asset("/public/dist/css/adminlte.min.css");?>>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>                
            </li>
            <li class="nav-item">
                <!--<a class="nav-link" href=<?php //echo Page::asset('/admin/index.php')?> role="button">Home</a>                -->
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <?php
                        if(isset($_SESSION['admission_user_token'])){
                            echo '<li class="nav-item">                            
                                <form action="../app/includes/auth/logout.inc.php" method="POST">
                                    <input type="submit" name="submit" value="Logout" class="btn">
                                </form>
                                </li>';
                        } else {
                            echo '<li class="nav-item">
                                    <a href= '.Page::asset('/login.php').' class="nav-link">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a href='.Page::asset('/register.php').' class="nav-link">Register</a>
                                </li>';
                        }
                    ?>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
            <img src=<?php echo Page::asset("/public/assets/img/logo.png");?> alt="UCC Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">UCC Admission</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['user_name']?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <?php if ($_SESSION['user_type'] === 'ADMIN' || $_SESSION['user_type'] === 'REGISTRAR') {?>
                            <li class="nav-item">
                                <a href="index.php" id="admission" class="nav-link">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Registration</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="student.php" id= "student" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Student</p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['user_type'] === 'ADMIN' || $_SESSION['user_type'] === 'MIS') {?>
                        <li class="nav-item">
                            <a href="admission.php" id="admission" class="nav-link">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>Admission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="schedule.php" id= "schedule" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>Schedule</p>
                            </a>
                        </li>
                        <li class="nav-item menu-is-opening">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Report<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="studentReport.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Student Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="roomReport.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Room Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['user_type'] === 'ADMIN') {?>
                        <li class="nav-item">
                            <a href="users.php" id= "register" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>