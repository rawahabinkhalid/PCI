<?php
include_once('../conn.php');
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Institute panel</span>
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
                 $sql= "SELECT `FullName` FROM signupinstitute WHERE `Institute_Id` = '".$_SESSION['userid']."' ";
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
                    <a href="instituteregistrationform.php" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Institute Registration Form
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Addinstituteregistrationform.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Add Job/Institute Form
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="searchtutor.php" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Search Tutors
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            My Jobs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" id="myprofile">
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Demo History
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="demo_requested_history.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Demo Requested History
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="demo_scheduled_history.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Demo Scheduled History
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="demo_confirmed_history.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Demo Confirmed History
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="demo_rejected_history.php" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Demo Rejected History
                                </p>
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


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: 'searchjobsApi.php',
        success: function(data) {
            content = '';
            obj = JSON.parse(data);
            for (i = 0; i < obj.length; i++) {
                content += '<li class="nav-item has-treeview">';
                content += '    <a href="ViewProfile.php?id=' + obj[i].Id + '" class="nav-link">';
                content += '        <i class="nav-icon fas fa-circle"></i>';
                content += '        <p>' + obj[i].Name + '</p>';
                content += '    </a>';
                content += '</li>';
            }
            $('#myprofile').html(content);
        }
    });
})
</script>