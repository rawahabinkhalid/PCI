<?php
include_once('../conn.php');

session_start();
if(!isset($_SESSION['userrole'])){
    header('location:../Login/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin Panel | Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- <style>
    tr:hover {
        background-color: #BEE5EB;
    }
    </style> -->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
          include "header.php";
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
          include "sidebar_menu.php";
        ?>
        <!-- /.sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Admin Panel Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php 
                                    // include_once('../conn.php');
                                    // $sql = 'Select COUNT(GroupName) as total from groups where UserId="'.$_SESSION['UID'].'" ';
                                    // $result = mysqli_query($conn,$sql);
                                    // $row = mysqli_fetch_assoc($result);
                                    // echo "<h3 style='margin-left: 10px;'>".$row['total']."</h3>";
                                    ?>
                                    <h3 style='margin-left: 10px;'>0</h3>
                                    <p>SCHEDULED DEMO</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php 
                                        $sql = 'SELECT COUNT(Id) AS total FROM studenttutorform';
                                        $result = mysqli_query($conn,$sql);
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<h3 style='margin-left: 10px;'>".$row['total']."</h3>";
                                    ?>
                                    <p>TOTAL STUDENTS</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php 
                                        $sql = 'SELECT COUNT(Id) AS total FROM tutorform_section1';
                                        $result = mysqli_query($conn,$sql);
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<h3 style='margin-left: 10px;'>".$row['total']."</h3>";
                                    ?>
                                    <p>TOTAL TEACHERS</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php 
                                        $sql = 'SELECT COUNT(Id) AS total FROM instituteregistrationform';
                                        $result = mysqli_query($conn,$sql);
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<h3 style='margin-left: 10px;'>".$row['total']."</h3>";
                                    ?>
                                    <p>TOTAL INSTITUTES</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="row">
                        <div class="col-lg-7 offset-lg-3">
                            <br>
                            <h2><b>Student Request For Teacher Demo</b></h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Student</th>
                                        <th scope="col">Requested Demo</th>
                                        <th scope="col">Teacher</th>
                                    </tr>
                                </thead>';
                                
                                $sql = 'SELECT requestdemo_studentside.Id, studenttutorform.StudentName, studenttutorform.ContactNo1, studenttutorform.StudentEmail, tutorform_section1.FullName, tutorform_section1.PhoneNo1, tutorform_section1.Email, tutorform_section1.TutorImage FROM requestdemo_studentside JOIN tutorform_section1 ON requestdemo_studentside.TeacherId = tutorform_section1.Id JOIN studenttutorform ON studenttutorform.Id = requestdemo_studentside.Student_Id WHERE requestdemo_studentside.`Status` = "Pending"';
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                echo'<tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="mt-5">
                                            '.$count++.'
                                            </div>
                                        </th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1 text-left mt-5">
                                                    <p> <b>Name:</b> &nbsp; '.$row['StudentName'].'</p>
                                                    <p> <b>Contact:</b> &nbsp; '.$row['ContactNo1'].' </p>
                                                    <p> <b>Email:</b> &nbsp; '.$row['StudentEmail'].' </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-4 offset-lg-1">
                                                    <input class="form-control text-center mt-4" id="scheduledDate_'.$row['Id'].'"
                                                    type="date" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'" style="width:250px" required>
                                                    <br>
                                                    <button type="button" name="" class="btn btn-success scheduledDemoStudentTeacher" style="width:250px" value="'.$row['Id'].'">Schedule</button>
                                                    <br><br>
                                                    <button class="btn btn-danger RejectButtonStudent"  value="'.$row['Id'].'" type="button" style="width:250px">Reject</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1">
                                                    <div class="image">
                                                        <img src="'.$row['TutorImage'].'" class="img-circle elevation-2" style="width: 100px;"
                                                            alt="User Image">
                                                    </div>
                                                    <div class="text-center mt-2">
                                                        <p> <b>Name:</b> &nbsp; '.$row['FullName'].' <br>
                                                        <b>Contact:</b> &nbsp; '.$row['PhoneNo1'].' <br>
                                                        <b>Email:</b> &nbsp; '.$row['Email'].'  </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                                echo'</tbody>
                            </table>
                        </div>'; ?>
                    </div>
                    <!-- /.row -->
                    <br><br>



                    <div class="row">
                        <div class="col-lg-7 offset-lg-3">
                            <br>
                            <h2><b>Institute Request For Teacher Demo</b></h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Institute</th>
                                        <th scope="col">Requested Demo</th>
                                        <th scope="col">Teacher</th>
                                    </tr>
                                </thead>';
                                
                                $sql = 'SELECT requestdemo_instituteside.Id, instituteregistrationform.InstituteName, instituteregistrationform.ContactNo1, instituteregistrationform.Email AS Ins_Email, tutorform_section1.FullName, tutorform_section1.PhoneNo1, tutorform_section1.Email, tutorform_section1.TutorImage FROM requestdemo_instituteside JOIN tutorform_section1 ON requestdemo_instituteside.TeacherId = tutorform_section1.Id JOIN instituteregistrationform ON instituteregistrationform.Id = requestdemo_instituteside.Institute_Id WHERE requestdemo_instituteside.`Status` = "Pending"';
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                echo'<tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="mt-5">
                                            '.$count++.'
                                            </div>
                                        </th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1 text-left mt-5">
                                                    <p> <b>Name:</b> &nbsp; '.$row['InstituteName'].'</p>
                                                    <p> <b>Contact:</b> &nbsp; '.$row['ContactNo1'].' </p>
                                                    <p> <b>Email:</b> &nbsp; '.$row['Ins_Email'].' </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-4 offset-lg-1">
                                                    <input class="form-control text-center mt-4" id="scheduledDate_'.$row['Id'].'"
                                                    type="date" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'" style="width:250px" required>
                                                    <br>
                                                    <button type="button" name="" class="btn btn-success scheduledDemoInstituteTeacher" style="width:250px" value="'.$row['Id'].'">Schedule</button>
                                                    <br><br>
                                                   <button class="btn btn-danger RejectButtonInstitute"  value="'.$row['Id'].'" type="button" style="width:250px">Reject</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1">
                                                    <div class="image">
                                                        <img src="'.$row['TutorImage'].'" class="img-circle elevation-2" style="width: 100px; height:90px"
                                                            alt="User Image">
                                                    </div>
                                                    <div class="text-center mt-2">
                                                        <p> <b>Name:</b> &nbsp; '.$row['FullName'].' <br>
                                                        <b>Contact:</b> &nbsp; '.$row['PhoneNo1'].' <br>
                                                        <b>Email:</b> &nbsp; '.$row['Email'].'  </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                                echo'</tbody>
                            </table>
                        </div>'; ?>
                    </div>
                    <!-- /.row -->
                    <br><br>



                    <div class="row">
                        <div class="col-lg-8 offset-lg-3">
                            <br>
                            <h2><b>Teacher Request For Student Demo</b></h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Teacher</th>
                                        <th scope="col">Requested Demo</th>
                                        <th scope="col">Student</th>
                                    </tr>
                                </thead>';
                                
                                $sql = 'SELECT requestdemo_teacherside.Id, tutorform_section1.TutorImage, tutorform_section1.FullName, tutorform_section1.PhoneNo1, tutorform_section1.Email, studenttutorform.StudentName, studenttutorform.ContactNo1, studenttutorform.StudentEmail FROM requestdemo_teacherside JOIN studenttutorform ON requestdemo_teacherside.Student_Id = studenttutorform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_teacherside.TeacherId WHERE requestdemo_teacherside.`Status` = "Pending"';
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                echo'<tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="mt-5">
                                            '.$count++.'
                                            </div>
                                        </th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1">
                                                    <div class="image">
                                                        <img src="'.$row['TutorImage'].'" class="img-circle elevation-2" style="width: 100px;"
                                                            alt="User Image">
                                                    </div>
                                                    <div class="text-center mt-2">
                                                        <p> <b>Name:</b> &nbsp; '.$row['FullName'].' <br>
                                                        <b>Contact:</b> &nbsp; '.$row['PhoneNo1'].' <br>
                                                        <b>Email:</b> &nbsp; '.$row['Email'].'  </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-4 offset-lg-1">
                                                    <input class="form-control text-center mt-4" id="scheduledDate_'.$row['Id'].'"
                                                    type="date" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'" style="width:250px" required>
                                                    <br>
                                                    <button type="button" name="" class="btn btn-success scheduledDemoTeacherStudent" style="width:250px" value="'.$row['Id'].'">Schedule</button>
                                                    <br><br>
                                                    <button class="btn btn-danger RejectButtonTeacherStudent"  value="'.$row['Id'].'" type="button" style="width:250px">Reject</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1 text-left mt-5">
                                                    <p> <b>Name:</b> &nbsp; '.$row['StudentName'].'</p>
                                                    <p> <b>Contact:</b> &nbsp; '.$row['ContactNo1'].' </p>
                                                    <p> <b>Email:</b>  &nbsp; '.$row['StudentEmail'].' </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                                echo'</tbody>
                            </table>
                        </div>'; ?>
                    </div>
                    <!-- /.row -->
                    <br><br>



                    <div class="row">
                        <div class="col-lg-8 offset-lg-3">
                            <br>
                            <h2><b>Teacher Request For Institute Demo</b></h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Teacher</th>
                                        <th scope="col">Requested Demo</th>
                                        <th scope="col">Institute</th>
                                    </tr>
                                </thead>';
                                
                                $sql = 'SELECT requestdemo_teacherside.Id, tutorform_section1.TutorImage, tutorform_section1.FullName, tutorform_section1.PhoneNo1, tutorform_section1.Email AS Tut_Email, instituteregistrationform.InstituteName, instituteregistrationform.ContactNo1, instituteregistrationform.Email FROM requestdemo_teacherside JOIN instituteregistrationjobs ON instituteregistrationjobs.Id = requestdemo_teacherside.JobId JOIN instituteregistrationform ON requestdemo_teacherside.Institute_Id = instituteregistrationform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_teacherside.TeacherId WHERE requestdemo_teacherside.`Status` = "Pending"';
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                echo'<tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="mt-5">
                                            '.$count++.'
                                            </div>
                                        </th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1">
                                                    <div class="image">
                                                        <img src="'.$row['TutorImage'].'" class="img-circle elevation-2" style="width: 100px;"
                                                            alt="User Image">
                                                    </div>
                                                    <div class="text-center mt-2">
                                                        <p> <b>Name:</b> &nbsp; '.$row['FullName'].' <br>
                                                        <b>Contact:</b> &nbsp; '.$row['PhoneNo1'].' <br>
                                                        <b>Email:</b> &nbsp; '.$row['Tut_Email'].'  </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-4 offset-lg-1">
                                                    <input class="form-control text-center mt-4" id="scheduledDate_'.$row['Id'].'"
                                                    type="date" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'" style="width:250px" required>
                                                    <br>
                                                    <button type="button" name="" class="btn btn-success scheduledDemoTeacherInstitute" style="width:250px" value="'.$row['Id'].'">Schedule</button>
                                                    <br><br>
                                                    <button class="btn btn-danger RejectButtonTeacherInstitute"  value="'.$row['Id'].'" type="button" style="width:250px">Reject</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-11 offset-lg-1 text-left mt-5">
                                                    <p> <b>Name:</b> &nbsp; '.$row['InstituteName'].'</p>
                                                    <p> <b>Contact:</b> &nbsp; '.$row['ContactNo1'].' </p>
                                                    <p> <b>Email:</b>  &nbsp; '.$row['Email'].' </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                                echo'</tbody>
                            </table>
                        </div>'; ?>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <br><br><br><br><br><br>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- waiting response modal on click of schedule button -->
        <div id="myModal1" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm" style="margin-top: 270px;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <p>Please Wait..!</p>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 <a href="https://matz.group/" target="_blank">Matz Solutions Pvt
                    Ltd</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.0-rc.1
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script src="../dist/js/demo.js"></script>
    <script src="../dist/js/pages/dashboard3.js"></script>
</body>


<script>
// Admin reject student --> Teacher request Demo
$(document).on('click', '.RejectButtonStudent', function() {
    var RejectId = $(this).val();
    var obj = {};
    obj.RejectId = RejectId;
    obj.Type = 'Student';

    var con = confirm("Are You Sure Want To Reject This Demo Request!");
    if (con) {
        $.ajax({
            type: 'POST',
            url: 'RejectButton.php',
            data: JSON.stringify(obj),
            success: function(data) {
                alert("Rejected Successfully");
                location.reload();
            }
        });
    }
})
</script>

<script>
// Admin reject Institute --> Teacher request Demo
$(document).on('click', '.RejectButtonInstitute', function() {
    var RejectId = $(this).val();
    var obj = {};
    obj.RejectId = RejectId;
    obj.Type = 'Institute';

    var con = confirm("Are You Sure Want To Reject This Demo Request!");
    if (con) {
        $.ajax({
            type: 'POST',
            url: 'RejectButton.php',
            data: JSON.stringify(obj),
            success: function(data) {
                alert("Rejected Successfully");
                location.reload();
            }
        });
    }
})
</script>

<script>
// Admin reject Teacher --> Student request Demo
$(document).on('click', '.RejectButtonTeacherStudent', function() {
    var RejectId = $(this).val();
    var obj = {};
    obj.RejectId = RejectId;
    obj.Type = 'TeacherStudent';

    var con = confirm("Are You Sure Want To Reject This Demo Request!");
    if (con) {
        $.ajax({
            type: 'POST',
            url: 'RejectButton.php',
            data: JSON.stringify(obj),
            success: function(data) {
                alert("Rejected Successfully");
                location.reload();
            }
        });
    }
})
</script>

<script>
// Admin reject Teacher --> Student request Demo
$(document).on('click', '.RejectButtonTeacherInstitute', function() {
    var RejectId = $(this).val();
    var obj = {};
    obj.RejectId = RejectId;
    obj.Type = 'TeacherInstitute';

    var con = confirm("Are You Sure Want To Reject This Demo Request!");
    if (con) {
        $.ajax({
            type: 'POST',
            url: 'RejectButton.php',
            data: JSON.stringify(obj),
            success: function(data) {
                alert("Rejected Successfully");
                location.reload();
            }
        });
    }
})
</script>


<script>
//Sheduled demo between student --> teacher  
$(document).on('click', '.scheduledDemoStudentTeacher', function() {
    $('#myModal1').modal({
        backdrop: 'static',
        keyboard: false
    })
    var scheduledId = $(this).val();
    var obj = {};
    obj.ScheduledId = scheduledId;
    obj.Type = 'Student';
    obj.ScheduledDate = $('#scheduledDate_' + scheduledId).val();
    runAjax(obj);
})

//Sheduled demo between Institute --> teacher  
$(document).on('click', '.scheduledDemoInstituteTeacher', function() {
    $('#myModal1').modal({
        backdrop: 'static',
        keyboard: false
    })
    var scheduledId = $(this).val();
    var obj = {};
    obj.ScheduledId = scheduledId;
    obj.Type = 'Institute';
    obj.ScheduledDate = $('#scheduledDate_' + scheduledId).val();
    runAjax(obj);
})

//Sheduled demo between teacher --> student  
$(document).on('click', '.scheduledDemoTeacherStudent', function() {
    $('#myModal1').modal({
        backdrop: 'static',
        keyboard: false
    })
    var scheduledId = $(this).val();
    var obj = {};
    obj.ScheduledId = scheduledId;
    obj.Type = 'TeacherStudent';
    obj.ScheduledDate = $('#scheduledDate_' + scheduledId).val();
    runAjax(obj);
})

//Sheduled demo between teacher --> Institute 
$(document).on('click', '.scheduledDemoTeacherInstitute', function() {
    $('#myModal1').modal({
        backdrop: 'static',
        keyboard: false
    })
    var scheduledId = $(this).val();
    var obj = {};
    obj.ScheduledId = scheduledId;
    obj.Type = 'TeacherInstitute';
    obj.ScheduledDate = $('#scheduledDate_' + scheduledId).val();
    runAjax(obj);
})

function runAjax(obj) {
    $.ajax({
        type: "POST",
        url: "ScheduledByAdmin.php",
        cache: false,
        data: JSON.stringify(obj),
        contentType: "json",
        success: function(data) {
            console.log(data);
            window.open('index.php', '_self');

        }
    });
}
</script>

<!-- waiting modal on click of Schedule button -->
<script>
// /$('.scheduledDemoStudentTeacher').modal({backdrop: 'static', keyboard: false})  
</script>

</html>