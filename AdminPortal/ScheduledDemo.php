<?php
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
    <style>
    tr:hover {
        background-color: #BEE5EB;
    }

    .demo {
        background: linear-gradient(to right, #ffcccc 0%, #6666ff 100%);
    }
    </style>
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
                        <div class="col-sm-10">
                            <h1 class="demo m-0 text-bold">CONFIRM SCHEDULED
                                DEMO
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2">
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
                        <div class="col-lg-9">
                            <br>
                            <h2>
                                <span style="color: blue;">Student <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    Teacher</span>
                            </h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Scheduled Date</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Teacher Name</th>';
                                        // <th scope="col">Status</th>
                                        echo'
                                    </tr>
                                </thead>';

                                $sql = 'SELECT requestdemo_studentside.Id AS Demo_student_Id, requestdemo_studentside.*, studenttutorform.*, tutorform_section1.* FROM requestdemo_studentside JOIN studenttutorform ON requestdemo_studentside.Student_Id = studenttutorform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_studentside.TeacherId WHERE requestdemo_studentside.`Status` ="Scheduled" ';
                                $result= mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){

                                echo'<tbody>
                                    <tr>
                                        <th scope="row">'.$count++.'</th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['ScheduledDateByAdmin'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['StudentName'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['FullName'].'</p>
                                                </div>
                                            </div>
                                        </td>';
                                        // <td>
                                        //     <div class="row">
                                        //         <div class="col-lg-12">
                                        //             <button class="btn btn-success confirmedDialogStudent" data-toggle="modal" data-id="Student" value="'.$row['Demo_student_Id'].'" data-target="#myModal1" 
                                        //                 style="width:100px;">Confirm</button>
                                        //             <button class="btn btn-danger rejectedDialog" data-toggle="modal" data-id="Student" value="'.$row['Demo_student_Id'].'" data-target="#myModal2" 
                                        //                 style="width:100px;">Reject</button>
                                        //             <button class="btn btn-warning suspiciousDialog" data-toggle="modal" data-id="Student" value="'.$row['Demo_student_Id'].'" data-target="#myModal3"
                                        //                 style="width:100px;">Suspicious</button>
                                        //         </div>
                                        //     </div>
                                        // </td>
                                        echo'
                                    </tr>';
                                }
                                echo'</tbody>
                            </table>
                        </div>'; ?>
                    </div>
                    <!-- /.row -->
                    <br>

                    <div class="row">
                        <div class="col-lg-9">
                            <br>
                            <h2>
                                <span style="color: blue;">Institute <i class="fa fa-arrow-right"
                                        aria-hidden="true"></i> Teacher</span>
                            </h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Scheduled Date</th>
                                        <th scope="col">Institute Name</th>
                                        <th scope="col">Teacher Name</th>';
                                        // <th scope="col">Status</th>
                                        echo'
                                    </tr>
                                </thead>';

                                $sql = 'SELECT requestdemo_instituteside.Id AS Demo_Institute_Id, requestdemo_instituteside.*, instituteregistrationform.*, tutorform_section1.* FROM requestdemo_instituteside JOIN instituteregistrationform ON requestdemo_instituteside.Institute_Id = instituteregistrationform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_instituteside.TeacherId WHERE requestdemo_instituteside.`Status` ="Scheduled" ';
                                $result= mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){

                                echo'<tbody>
                                    <tr>
                                        <th scope="row">'.$count++.'</th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['ScheduledDateByAdmin'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['InstituteName'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['FullName'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        // <td>
                                        //     <div class="row">
                                        //         <div class="col-lg-12">
                                        //             <button class="btn btn-success confirmedDialog" data-toggle="modal" data-id="Institute" value="'.$row['Demo_Institute_Id'].'" data-target="#myModal1" 
                                        //                 style="width:100px;">Confirm</button>
                                        //             <button class="btn btn-danger rejectedDialog" data-toggle="modal" data-id="Institute" value="'.$row['Demo_Institute_Id'].'" data-target="#myModal2" 
                                        //                 style="width:100px;">Reject</button>
                                        //             <button class="btn btn-warning suspiciousDialog" data-toggle="modal" data-id="Institute" value="'.$row['Demo_Institute_Id'].'" data-target="#myModal3"
                                        //                 style="width:100px;">Suspicious</button>
                                        //         </div>
                                        //     </div>
                                        // </td>
                                    </tr>';
                                }
                                echo'</tbody>
                            </table>
                        </div>'; ?>
                    </div>
                    <!-- /.row -->
                    <br>

                    <div class="row">
                        <div class="col-lg-9">
                            <br>
                            <h2>
                                <span style="color: blue;">Teacher <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    Student</span>
                            </h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Scheduled Date</th>
                                        <th scope="col">Teacher Name</th>
                                        <th scope="col">Student Name</th>
                                        // <th scope="col">Status</th>
                                    </tr>
                                </thead>';

                                $sql = 'SELECT requestdemo_teacherside.Id AS Demo_Teacher_Id, requestdemo_teacherside.*, studenttutorform.*, tutorform_section1.* FROM requestdemo_teacherside JOIN studenttutorform ON requestdemo_teacherside.Student_Id  = studenttutorform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_teacherside.TeacherId WHERE requestdemo_teacherside.`Status` ="Scheduled" ';
                                $result= mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){

                                echo'<tbody>
                                    <tr>
                                        <th scope="row">'.$count++.'</th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['ScheduledDateByAdmin'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['FullName'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['StudentName'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        // <td>
                                        //     <div class="row">
                                        //         <div class="col-lg-12">
                                        //             <button class="btn btn-success confirmedDialog" data-toggle="modal" data-id="Teacher" value="'.$row['Demo_Teacher_Id'].'" data-target="#myModal1" 
                                        //                 style="width:100px;">Confirm</button>
                                        //             <button class="btn btn-danger rejectedDialog" data-toggle="modal" data-id="Teacher" value="'.$row['Demo_Teacher_Id'].'" data-target="#myModal2" 
                                        //                 style="width:100px;">Reject</button>
                                        //             <button class="btn btn-warning suspiciousDialog" data-toggle="modal" data-id="Teacher" value="'.$row['Demo_Teacher_Id'].'" data-target="#myModal3"
                                        //                 style="width:100px;">Suspicious</button>
                                        //         </div>
                                        //     </div>
                                        // </td>
                                    </tr>';
                                }
                                echo'</tbody>
                            </table>
                        </div>'; ?>
                    </div>
                    <!-- /.row -->
                    <br>

                    <div class="row">
                        <div class="col-lg-9">
                            <br>
                            <h2>
                                <span style="color: blue;">Teacher <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    Institute</span>
                            </h2>
                        </div>
                        <?php
                        $count = 1;

                        echo '
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Scheduled Date</th>
                                        <th scope="col">Teacher Name</th>
                                        <th scope="col">Institute Name</th>';
                                        // <th scope="col">Status</th>
                                        echo'
                                    </tr>
                                </thead>';

                                $sql = 'SELECT requestdemo_teacherside.Id AS Demo_Teacher_Id, requestdemo_teacherside.*, instituteregistrationform.*, tutorform_section1.*  FROM requestdemo_teacherside JOIN instituteregistrationform ON requestdemo_teacherside.Institute_Id = instituteregistrationform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_teacherside.TeacherId WHERE requestdemo_teacherside.`Status` ="Scheduled" ';
                                $result= mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){

                                echo'<tbody>
                                    <tr>
                                        <th scope="row">'.$count++.'</th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['ScheduledDateByAdmin'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['FullName'].'</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p> &nbsp; '.$row['InstituteName'].'</p>
                                                </div>
                                            </div>
                                        </td>';
                                        // <td>
                                        //     <div class="row">
                                        //         <div class="col-lg-12">
                                        //             <button class="btn btn-success confirmedDialog" data-toggle="modal" data-id="Teacher" value="'.$row['Demo_Teacher_Id'].'" data-target="#myModal1" 
                                        //                 style="width:100px;">Confirm</button>
                                        //             <button class="btn btn-danger rejectedDialog" data-toggle="modal" data-id="Teacher" value="'.$row['Demo_Teacher_Id'].'" data-target="#myModal2" 
                                        //                 style="width:100px;">Reject</button>
                                        //             <button class="btn btn-warning suspiciousDialog" data-toggle="modal" data-id="Teacher" value="'.$row['Demo_Teacher_Id'].'" data-target="#myModal3"
                                        //                 style="width:100px;">Suspicious</button>
                                        //         </div>
                                        //     </div>
                                        // </td>
                                        echo'
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
            <br><br><br><br><br>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

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

<!-- Confirm button Modal Box start -->
<!-- <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title bg-dark text-white w-100 text-center">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="ScheduledStatus.php" method="POST">
                <input type="hidden" name="demoIdCon" id="demoIdCon">
                <input type="hidden" name="demoTypeCon" id="demoTypeCon">
                <input type="hidden" name="demoStatusConfirm" id="demoStatusConfirm" value="Confirmed">
                <input type="hidden" name="studentCheckId" id="studentCheckId" value="0">


                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <p style="font-weight: bold">Classes:</p>
                                <input class="form-control" name="classes" type="text" required
                                    style="outline: none; margin-top: -12px;">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p style="font-weight: bold">Subjects:</p>
                                <input class="form-control" name="subjects" type="text" required
                                    style="outline: none; margin-top: -12px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <p style="font-weight: bold">Starting Tution Date:</p>
                                <input class="form-control" name="startingdate" type="date" required
                                    style="outline: none; margin-top: -12px;">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <p style="font-weight: bold">Fees:</p>
                                <input class="form-control" name="fees" type="text" required
                                    style="outline: none; margin-top: -12px;">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p style="font-weight: bold">Days Of Tution:</p>
                                <input class="form-control" name="daysoftution" type="text" required
                                    style="outline: none; margin-top: -12px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modalbox" class="btn btn-primary" style="width: 100px;">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px;">Close</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Confirm button Modal Box end -->

<!-- Reject button Modal Box start -->
<!-- <div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title bg-dark text-white w-100 text-center">Rejected Reason</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="ScheduledStatus.php" method="POST">
                <input type="hidden" name="demoIdRej" id="demoIdRej">
                <input type="hidden" name="demoTypeRej" id="demoTypeRej">
                <input type="hidden" name="demoStatusRej" id="demoStatusRej" value="Rejected">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <p style="font-weight: bold">Rejected By Student/Teacher:</p>
                                <select class="form-control" name="rejectby" type="text" required
                                    style="outline: none; margin-top: -12px;">
                                    <option value="Teacher">Teacher</option>
                                    <option value="Student">Student</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <p style="font-weight: bold">Description:</p>
                                <textarea class="form-control" name="discription" type="text" required
                                    style="outline: none; margin-top: -12px;">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modalbox" class="btn btn-primary" style="width: 100px;">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px;">Close</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Reject button Modal Box end -->

<!-- Suspicious button Modal Box start -->
<!-- <div id="myModal3" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title bg-dark text-white w-100 text-center">Suspicious</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="ScheduledStatus.php" method="POST">
                <input type="hidden" name="demoIdSus" id="demoIdSus">
                <input type="hidden" name="demoTypeSus" id="demoTypeSus">
                <input type="hidden" name="demoStatusSus" id="demoStatusSus" value="Suspicious">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <p style="font-weight: bold">Description:</p>
                                <textarea class="form-control" name="suspiciousdescription" type="text" required
                                    style="outline: none; margin-top: -12px;">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modalbox" class="btn btn-primary" style="width: 100px;">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width: 100px;">Close</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Suspicious button Modal Box end -->

<!--After Scheduled DEMO -->
<!-- <script>
$('.confirmedDialog').on('click', function() {
    console.log($(this).val());
    $('#demoIdCon').val($(this).val());
    $('#demoTypeCon').val($(this).attr('data-id'));
    $('#studentCheckId').val(0);
});
$('.confirmedDialogStudent').on('click', function() {
    console.log($(this).val());
    $('#demoIdCon').val($(this).val());
    $('#demoTypeCon').val($(this).attr('data-id'));
    $('#studentCheckId').val(1);
});
</script>

<script>
$('.rejectedDialog').on('click', function() {
    console.log($(this).val());
    $('#demoTypeRej').val($(this).attr('data-id'));
    $('#demoIdRej').val($(this).val());
});
</script>

<script>
$('.suspiciousDialog').on('click', function() {
    console.log($(this).val());
    $('#demoTypeSus').val($(this).attr('data-id'));
    $('#demoIdSus').val($(this).val());
});
</script> -->

</html>