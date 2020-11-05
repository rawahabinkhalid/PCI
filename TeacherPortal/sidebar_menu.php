<?php
include_once('../conn.php');
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Teacher Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php
                     $sql= "SELECT `FullName` FROM signupteacher WHERE `Teacher_Id` = '".$_SESSION['userid']."' ";
                    $result = mysqli_query($conn, $sql);
                    while($row= mysqli_fetch_assoc($result)){
                    echo"<a>" .$row['FullName']. "</a>";
                    // <a href="#" class="d-block">Alexander Pierce</a>
                    }
                ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="index.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="tutorform.php" class="nav-link">
                        <i class="nav-icon fab fa-wpforms"></i>
                        <p>
                            Teacher Form
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Edittutorform.php" class="nav-link">
                        <i class="nav-icon fas fa-pen-square"></i>
                        <p>
                            Update Teacher Form
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="searchstudent_institute.php" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Search Student/Institute
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview" id="myprofile">
                    <a href="ViewProfile.php" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            My Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Demo History
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="DemoRequestedHistory.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>Demo Requested History</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="DemoScheduledHistory.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>Demo Scheduled History</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="DemoConfirmedHistory.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>Demo Confirmed History</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="DemoRejectedHistory.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>Demo Rejected History</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Scheduled Demo
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="pendingDemoInstitute.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>By Institute</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="pendingDemo.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>By Student</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="pendingDemoTeacherInstitute.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>By Teacher to Institute</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="pendingDemoTeacher.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>By Teacher to Student</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="SendQuery.php" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Send Query
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>