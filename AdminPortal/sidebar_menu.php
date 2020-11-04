<?php
include_once('../conn.php');
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin panel</span>
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
                    $sql= "SELECT `FullName` FROM admin WHERE `Admin_Id` = '".$_SESSION['userid']."' ";
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
                    <a href="ScheduledDemo.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Scheduled Demo
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-check-double"></i>
                        <p>
                            Tution Status
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="ConfirmStudentsDemo.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Students
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ConfirmInstitutesDemo.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Institutes
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="ViewStudents.php" class="nav-link">
                        <i class=" nav-icon fas fa-user-graduate"></i>
                        <p>
                            View Students
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="ViewTeachers.php" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            View Teachers
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="ViewInstitutes.php" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            View Institutes
                        </p>
                    </a>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="AddNew_Subject.php" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Add New Subjects
                            <!-- <span class="badge badge-info right">2</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link" >
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Queries
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="Queries_Student.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Student Queries
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Queries_Teacher.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Teacher Queries
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Queries_Institute.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Institute Queries
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>