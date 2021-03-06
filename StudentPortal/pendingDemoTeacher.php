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

    <title>Student Panel | Dashboard</title>

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
                                
                                $sql = 'SELECT requestdemo_teacherside.Id, tutorform_section1.TutorImage, tutorform_section1.FullName, tutorform_section1.PhoneNo1, tutorform_section1.Email, studenttutorform.StudentName, studenttutorform.ContactNo1, studenttutorform.StudentEmail, ScheduledDateByAdmin FROM requestdemo_teacherside JOIN studenttutorform ON requestdemo_teacherside.Student_Id = studenttutorform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_teacherside.TeacherId WHERE requestdemo_teacherside.`Status` = "Scheduled" AND requestdemo_teacherside.`StatusByStudent` = "" AND requestdemo_teacherside.`StatusByTeacher` <> "Rejected"';
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
                                                    type="date" readonly value="'.$row['ScheduledDateByAdmin'].'" style="width:250px" required>
                                                    <br>
                                                    <button type="button" name="" class="btn btn-success scheduledDemoStudentTeacher" data-toggle="modal" data-target="#myModal1" data-id="Teacher" style="width:250px" value="'.$row['Id'].'">Confirm</button>
                                                    <br><br>
                                                    <button class="btn btn-danger RejectButtonStudent" data-toggle="modal" data-id="Teacher" data-target="#myModal2"  value="'.$row['Id'].'" type="button" style="width:250px">Reject</button>
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



                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <br><br><br><br><br><br>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- waiting response modal on click of schedule button -->
        <div id="myModalWait" class="modal fade" role="dialog">
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

        <!-- Confirm button Modal Box start -->
        <div id="myModal1" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title bg-dark text-white w-100 text-center">Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form id="ScheduledStatus">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <p style="font-weight: bold">Classes:</p>
                                        <input class="form-control" id="classes" name="classes" type="text" required
                                            style="outline: none; margin-top: -12px;">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <p style="font-weight: bold">Subjects:</p>
                                        <input class="form-control" id="subjects" name="subjects" type="text" required
                                            style="outline: none; margin-top: -12px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <p style="font-weight: bold">Starting Tution Date:</p>
                                        <input class="form-control" id="startingdate" name="startingdate" type="date"
                                            required style="outline: none; margin-top: -12px;">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <p style="font-weight: bold">Fees:</p>
                                        <input class="form-control" id="fees" name="fees" type="text" required
                                            style="outline: none; margin-top: -12px;">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <p style="font-weight: bold">Days Of Tution:</p>
                                        <input class="form-control" id="daysoftution" name="daysoftution" type="text"
                                            required style="outline: none; margin-top: -12px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="modalbox" class="btn btn-primary"
                                style="width: 100px;">OK</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                style="width: 100px;">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Confirm button Modal Box end -->

        <!-- Reject button Modal Box start -->
        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title bg-dark text-white w-100 text-center">Rejected Reason</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form id="ScheduledStatusRej">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <p style="font-weight: bold">Description:</p>
                                        <textarea class="form-control" id="discriptionRej" name="discription"
                                            type="text" required style="outline: none; margin-top: -12px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="modalboxrej" class="btn btn-primary"
                                style="width: 100px;">OK</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                style="width: 100px;">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Reject button Modal Box end -->

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
    $('#modalboxrej').val($(this).val());
})

$('#ScheduledStatusRej').on('submit', function(e) {
    e.preventDefault();
    $('#myModalWait').modal({
        backdrop: 'static',
        keyboard: false
    })
    var scheduledId = $('#modalboxrej').val();
    var obj = {};
    obj.ScheduledId = scheduledId;
    obj.Status = 'Rejected';
    obj.Type = 'Student';
    obj.Classes = '';
    obj.Subjects = '';
    obj.TuitionStartDate = '';
    obj.Fees = '';
    obj.RejectedBy = 'Student';
    obj.Description = $('#discriptionRej').val();
    obj.DaysOfTuition = '';
    runAjax(obj);

})
</script>

<script>
//Sheduled demo between student --> teacher  
$(document).on('click', '.scheduledDemoStudentTeacher', function() {
    $('#modalbox').val($(this).val());
})

$('#ScheduledStatus').on('submit', function(e) {
    e.preventDefault();
    $('#myModalWait').modal({
        backdrop: 'static',
        keyboard: false
    })
    var scheduledId = $('#modalbox').val();
    var obj = {};
    obj.ScheduledId = scheduledId;
    obj.Type = 'Student';
    obj.Status = 'Confirmed';
    obj.Classes = $('#classes').val();
    obj.Subjects = $('#subjects').val();
    obj.TuitionStartDate = $('#startingdate').val();
    obj.Fees = $('#fees').val();
    obj.RejectedBy = '';
    obj.Description = '';
    obj.DaysOfTuition = $('#daysoftution').val();
    runAjax(obj);

})


function runAjax(obj) {
    $.ajax({
        type: "POST",
        url: "ScheduledByTeacher.php",
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