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

    <title>Student Panel | Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .demo {
        background: linear-gradient(to right, #ffcccc 0%, #6666ff 100%);
    }

    .form-control {
        border: 0px solid #000;
        background: none;
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
                        <div class="col-sm-12">
                            <h1 class="m-0 text-dark text-center"><b><u>PCI Tutors Academy</u></b></h1>
                        </div>
                        <div class="col-sm-10 mt-3">
                            <h1 class="m-0 demo text-dark"><u><b>Student Profile</b></u></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2 mt-3">
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
                    <form action="studenttutorformsubmit.php" id="addstudent">
                        <?php
                            $sql = "SELECT * FROM studenttutorform WHERE `Id` = ".$_GET['id'];
                            $result= mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Student Name:</p>
                                    <input class="form-control" value="<?php echo $row['StudentName']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Father Name:</p>
                                    <input class="form-control" value="<?php echo $row['FatherName']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Student Email:</p>
                                    <input class="form-control" value="<?php echo $row['StudentEmail']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 1</p>
                                    <input class="form-control" value="<?php echo $row['ContactNo1']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 2</p>
                                    <input class="form-control" value="<?php echo $row['ContactNo2']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 3</p>
                                    <input class="form-control" value="<?php echo $row['ContactNo3']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Class:</p>
                                    <input class="form-control" value="<?php echo $row['Class']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Subjects:</p>
                                    <?php
                                    $sql = 'SELECT * FROM studenttutorsubjects WHERE `studenttutorform_id` ='.$_GET['id'];
                                    $result = mysqli_query($conn,$sql);
                                    echo '<p>';
                                    $dataSubject = [];
                                    while($row1 = mysqli_fetch_assoc($result)){
                                        $dataSubject[] = $row1['Subjects'];
                                    }
                                    echo implode(', ', $dataSubject);
                                    echo '</p>';
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">School / College:</p>
                                    <input class="form-control" value="<?php echo $row['SchoolCollege']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">House Number:</p>
                                    <input class="form-control" value="<?php echo $row['HouseNumber']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Building Name:</p>
                                    <input class="form-control" value="<?php echo $row['BuildingName']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Street Number:</p>
                                    <input class="form-control" value="<?php echo $row['StreetNumber']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Block Number:</p>
                                    <input class="form-control" value="<?php echo $row['BlockNumber']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Area:</p>
                                    <input class="form-control" value="<?php echo $row['Area']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">City:</p>
                                    <input class="form-control" value="<?php echo $row['City']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Country:</p>
                                    <input class="form-control" value="<?php echo $row['Country']?>"
                                        style="outline: none; margin-top: -12px;">

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Gender of Required Teacher:</p>
                                    <input class="form-control" value="<?php echo $row['Gender']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-top: -12px;">
                                    <p style="font-weight: bold">Desired Timings:</p>
                                    <?php
                                    $sql = 'SELECT * FROM studenttutordesiredtimings WHERE `studenttutorform_id` ='.$_GET['id'];
                                    $result = mysqli_query($conn,$sql);
                                    echo '<p>';
                                    $dataTiming = [];
                                    while($row = mysqli_fetch_assoc($result)){
                                        $dataTiming[] = $row['DesiredTimings'];
                                    }
                                    echo implode(', ', $dataTiming);
                                    echo '</p>';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <br>
                    </form>
                </div>
                <br><br><br>
                <div id="tutordata"></div>
                <!-- /.container-fluid -->
            </div>
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
            <strong>Copyright &copy; 2020 <a href="https://matz.group/" target="_blank" style="color:#007bff">Matz
                    Solutions Pvt
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


</html>