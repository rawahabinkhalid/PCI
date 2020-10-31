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
                            <h1 class="m-0 demo text-dark"><u><b>Teachers Profile</b></u></h1>
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
                    <form action="tutorformsubmit.php" id="tutorform" enctype="multipart/form-data">

                        <!-- section 1 -->
                        <?php
                            $sql = "SELECT * FROM tutorform_section1 WHERE `Id` =".$_GET['id'];
                            $result= mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <img class="form-control img-circle" src="<?php echo $row['TutorImage'] ?>"
                                        style="outline: none; margin-top: -12px; width:150px; height: 140px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Documents</p>
                                    <?php 
                                    $sqlDoc = 'SELECT * FROM tutorform_documents WHERE TutorId = ' . $row['Id'];
                                    $resultDoc = $conn->query($sqlDoc);
                                    if($resultDoc->num_rows > 0) {
                                        $iter = 0;
                                        while($rowDoc = $resultDoc->fetch_assoc()) {
                                            $iter++;
                                            ?>

                                    <a onclick="openDoc(this);"
                                        href="<?php echo $rowDoc['TutorDocuments'] ?>"><?php echo "Document # " . $iter; ?></a><br>
                                    <?php

                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">You Are Interested:</p>
                                    <input class="form-control" value="<?php echo $row['TutorCategory'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Are you teacher by profession?</p>
                                    <input class="form-control" value="<?php echo $row['TeacherByProfession'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class=" form-group">
                                    <p style="font-weight: bold">If Yes Then Where</p>
                                    <input class="form-control" value="<?php echo $row['YesThenWhere'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Full Name</p>
                                    <input class="form-control" value="<?php echo $row['FullName'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Father/Husband Name</p>
                                    <input class="form-control" value="<?php echo $row['FatherHusbandName'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Mother Name/ Tounge</p>
                                    <input class="form-control" value="<?php echo $row['MotherNameTounge'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Gender</p>
                                    <input class="form-control" value="<?php echo $row['Gender'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Date of Birth</p>
                                    <input class="form-control" value="<?php echo $row['DateOfBirth'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Age</p>
                                    <input class="form-control" value="<?php echo $row['Age'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Nationality</p>
                                    <input class="form-control" value="<?php echo $row['Nationality'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Religion</p>
                                    <input class="form-control" value="<?php echo $row['Religion'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">C.N.I.C Number</p>
                                    <input class="form-control" value="<?php echo $row['CnicNo'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Present Address</p>
                                    <input class="form-control" value="<?php echo $row['PresentAddress'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Permanent Address</p>
                                    <input class="form-control" value="<?php echo $row['PermanentAddress'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Phone # 1</p>
                                    <input class="form-control" value="<?php echo $row['PhoneNo1'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Phone # 2</p>
                                    <input class="form-control" value="<?php echo $row['PhoneNo2'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Phone # 3</p>
                                    <input class="form-control" value="<?php echo $row['PhoneNo3'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Facebook I.D</p>
                                    <input class="form-control" value="<?php echo $row['FacebookId'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">E-mail</p>
                                    <input class="form-control" value="<?php echo $row['Email'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>

                            <!-- section 2 -->
                            <div class="col-sm-2">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Qualifications</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Subjects/Specialization</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Institute / University</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Year of Passing</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Grade / Division</p>
                                </div>
                            </div>
                            <?php
                            $sql = "SELECT * FROM tutorform_section2 WHERE `UserId` =".$_GET['id'];
                            $result= mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '
                                  <div class="col-sm-2">
                                    <div class="form-group">
                                        <input class="form-control" value="'.$row['Qualification'].'"
                                             style="outline: none; margin-top: -12px;">
                                    </div>
                                  </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                              <input class="form-control" value="'.$row['SubjectSpecialization'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                           <input class="form-control" value="'.$row['InstituteUniversity'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                           <input class="form-control" value="'.$row['YearOfPassing'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" value="'.$row['GradeDivision'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>';
                                }
                            ?>

                            <!-- section 3 -->
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Job Entitlement</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Name of Organization</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">From</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Till</p>
                                </div>
                            </div>
                            <?php
                            $sql = "SELECT * FROM tutorform_section3 WHERE `UserId` =".$_GET['id'];
                            $result= mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <input class="form-control" value="'.$row['JobEntitlement'].'"
                                             style="outline: none; margin-top: -12px;">
                                    </div>
                                  </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                              <input class="form-control" value="'.$row['OrganizationName'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                           <input class="form-control" value="'.$row['FromTo'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                           <input class="form-control" value="'.$row['Till'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>';
                                }
                            ?>

                            <!-- section 4 -->
                            <div class="col-sm-3">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Classes to Teach</p>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold;">Preferred Subject
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Preferred Area</p>
                                </div>
                            </div>
                            <?php

                            $locations = array();
                            $sql1 = "SELECT * FROM tutorform_section4_locations WHERE `UserId` =".$_SESSION['userid'];
                                $result1= mysqli_query($conn,$sql1);
                                while($row1 = mysqli_fetch_assoc($result1)){
                                    array_push($locations,$row1['PreferredArea']);
                                }

                            $sql = "SELECT * FROM tutorform_section4 WHERE `UserId` =".$_SESSION['userid'];
                            $result= mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control" value="'.$row['ClassToTeach'].'"
                                             style="outline: none; margin-top: -12px;">
                                    </div>
                                  </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                              <input class="form-control" value="'.$row['PreferredSubjects'].'"
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                                <div class="form-group"> 
                                                <input class="form-control" value="';?><?php
                                                $temp = sizeof($locations);
                                                $temp = $temp -1;
                                                 for($i=0; $i<sizeof($locations);$i++){
                                                    echo $locations[$i];
                                                    
                                                    if($i<$temp){
                                                        echo ", ";
                                                    }
                                                }
                                                ?>
                            <?php echo '"
                                                                        style="outline: none; margin-top: -12px;">
                                                                </div>
                                                        </div>';

                                                        
                                                }
                                                ?>

                            <!-- section 5 -->
                            <?php
                            $sql = "SELECT * FROM tutorform_section5 WHERE `UserId` =".$_GET['id'] . ' LIMIT 2';
                            $romanChar = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
                            $counter = 0;
                            $result= mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="col-sm-12 text-center">
                                <p style="background-color: #C7C7C7"><b>Reference <?php echo $romanChar[$counter] ?></b>
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Name:</p>
                                    <input class="form-control" value="<?php echo $row['Name'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Relation:</p>
                                    <input class="form-control" value="<?php echo $row['Relation'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Occupation:</p>
                                    <input class="form-control" value="<?php echo $row['Occupation'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Telephone No:</p>
                                    <input class="form-control" value="<?php echo $row['TelephoneNo'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <p style="font-weight: bold">Address:</p>
                                    <input class="form-control" value="<?php echo $row['Address'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <?php $counter++; } ?>

                            <!-- SECTION 1 Remaining values-->
                            <?php
                            $sql = "SELECT * FROM tutorform_section1 WHERE `Id` =".$_GET['id'];
                            $result= mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Do you have personal conveyance?</p>
                                    <input class="form-control" value="<?php echo $row['PersonalConveyance'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">If Yes Then Car/Bike?:</p>
                                    <input class="form-control" value="<?php echo $row['YesThenCarBike'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                                <div class="form-group">
                                    <p style="font-weight: bold">Date:</p>
                                    <input class="form-control" value="<?php echo $row['DateOfFormSubmission'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
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