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

    <title>Institute Panel | Dashboard</title>

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
                            <h1 class="m-0 demo text-dark"><u><b>My Job</b></u></h1>
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
                    <form action="instituteregistrationsubmit.php" id="instituteform">
                        <?php 
                            $sqlJob = 'SELECT * FROM instituteregistrationjobs WHERE `Id` = '.$_GET['id'];
                            $resultJob = mysqli_query($conn,$sqlJob);
                            if($resultJob->num_rows > 0) {
                                $rowJob = mysqli_fetch_assoc($resultJob);

                                $sql="SELECT * FROM instituteregistrationform WHERE `Id` = ".$rowJob['Instituteregform_Id'];
                                $result = mysqli_query($conn,$sql);
                                $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold">Name Of Institution:</p>
                                    <input class="form-control" value="<?php echo $row['InstituteName']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Type Of Institute:</p>
                                    <input class="form-control" value="<?php echo $row['TypeOfInstitute']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold">If Type Of Institute Others:</p>
                                    <input class="form-control" name="othersinstitute" type="othersinstitute"
                                        value="
                                        <?php
                                        //  echo $row['IfInstituteOther']
                                         ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div> -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Email:</p>
                                    <input class="form-control" value="<?php echo $row['Email']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Person:</p>
                                    <input class="form-control" value="<?php echo $row['ContactPerson']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 1</p>
                                    <input class="form-control" value="<?php echo $row['ContactNo1']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 2</p>
                                    <input class="form-control" value="<?php echo $row['ContactNo2']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 3</p>
                                    <input class="form-control" name="contactno3" type="text"
                                        value="<?php echo $row['ContactNo3']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>

                            <?php 
                            $sql="SELECT * FROM instituteregistrationjobs WHERE `Id` = ".$_GET['id'];
                            $result = mysqli_query($conn,$sql);
                            $row1 = mysqli_fetch_assoc($result);
                            ?>
                            <div class="col-sm-2">
                                <hr>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Class</p>
                                    <input class="form-control" value="<?php echo $row1['Class']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold"> Subjects</p>
                                    <input class="form-control" value="<?php echo $row1['Subjects']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold"> If Other (Subjects)</p>
                                    <input class="form-control" value="<?php echo $row['IfOtherSubjects']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <hr>
                            </div>

                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Address:</p>
                                    <input class="form-control" value="<?php echo $row['Address']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Street Number:</p>
                                    <input class="form-control" value="<?php echo $row['StreetNum']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Block Number:</p>
                                    <input class="form-control" value="<?php echo $row['BlockNum']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Area:</p>
                                    <input class="form-control" value="<?php echo $row['Area']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">City:</p>
                                    <input class="form-control" value="<?php echo $row['City']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Country:</p>
                                    <input class="form-control" value="<?php echo $row['Country']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Gender of Required Teacher:</p>
                                    <input class="form-control" value="<?php echo $row['Gender']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Timings:</p>
                                    <input class="form-control" value="<?php echo $row['Timings']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Salary From:</p>
                                    <input class="form-control" value="<?php echo $row['SalaryFrom']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Salary To:</p>
                                    <input class="form-control" value="<?php echo $row['SalaryTo']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <hr style="border: 2px solid #000;">
                                <p style="font-weight: bold"><u>Demo Requested:</u></p>
                                <?php 
                            $sql = 'SELECT COUNT(Status) FROM requestdemo_instituteside WHERE `Status` = "Pending" AND `Institute_Id` = "'.$_SESSION['userid'].'" ';
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<p>' .$row['COUNT(Status)']. '</p>';
                            }
                            ?>
                            </div>
                            <div class="col-sm-3 text-center">
                                <hr style="border: 2px solid #000;">
                                <p style="font-weight: bold"><u>Demo Scheduled:</u></p>
                                <?php 
                            $sql = 'SELECT COUNT(Status) AS Count_Status FROM requestdemo_instituteside WHERE `Status` = "Scheduled" AND `Institute_Id` = "'.$_SESSION['userid'].'" ';
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<p>' .$row['Count_Status']. '</p>';
                            }
                            ?>
                            </div>
                            <div class="col-sm-3 text-center">
                                <hr style="border: 2px solid #000;">
                                <p style="font-weight: bold"><u>Confirm Tutions:</u></p>
                                <?php 
                            $sql = 'SELECT COUNT(demostatus.Status) FROM requestdemo_instituteside LEFT JOIN demostatus ON requestdemo_instituteside.Id = demostatus.DemoId WHERE demostatus.`Status` = "Confirmed" AND `Institute_Id` = "'.$_SESSION['userid'].'" ';
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<p>' .$row['COUNT(demostatus.Status)']. '</p>';
                            }
                            ?>
                            </div>
                            <div class="col-sm-3 text-center">
                                <hr style="border: 2px solid #000;">
                                <p style="font-weight: bold"><u>Rejected Tutions:</u></p>
                                <?php 
                            $sql = 'SELECT COUNT(*) AS Count_Status FROM requestdemo_instituteside LEFT JOIN demostatus ON requestdemo_instituteside.Id = demostatus.DemoId WHERE (demostatus.`Status` = "Rejected" OR (demostatus.`Status` IS NULL AND requestdemo_instituteside.`Status` = "Rejected")) AND `Institute_Id` = "'.$_SESSION['userid'].'" ';
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<p>' .$row['Count_Status']. '</p>';
                            }
                            ?>
                            </div>
                        </div>

                        <?php 
                        } 
                        ?>
                    </form>
                </div>
                <br><br><br>
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

</html>