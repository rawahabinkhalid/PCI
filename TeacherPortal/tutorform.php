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

    <title>Teacher Panel | Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

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
                        <div class="col-sm-6 mt-3">
                            <h1 class="m-0 text-dark"><u>Registration Form for Home Tuition</u></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 mt-3">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <?php
            // $RegNo = 0;
            // $SecretCode = 0;
            // $sqlCode = 'SELECT MAX(RegNo) + 1 AS RegNo, MAX(SecretCode) + 1 AS SecretCode FROM tutorform_section1';
            // $resultCode = $conn->query($sqlCode);
            // if($resultCode->num_rows > 0) {
            //     $rowCode = $resultCode->fetch_assoc();
            //     $RegNo = $rowCode['RegNo'];
            //     $SecretCode = $rowCode['SecretCode'];
            // }
            ?>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <form action="tutorformsubmit.php" id="tutorform" enctype="multipart/form-data">
                        <div class="row">
                            <?php
                            $sql = "SELECT * FROM tutorform_section1 WHERE `TeacherId` = ".$_SESSION['userid']." AND FormStatus = 'Draft'";
                            $result= mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Reg#: (for office use)</p>
                                    <input class="form-control" name="Regno" type="text" placeholder="" required
                                        value="<?php echo $RegNo; ?>" style="outline: none; margin-top: -12px;"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Secret Code #</p>
                                    <input class="form-control" name="secretcode" type="text" placeholder="" required
                                        style="outline: none; margin-top: -12px;" value="<?php echo $SecretCode; ?>"
                                        readonly>
                                </div>
                            </div> -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">You Are Interested:</p>
                                    <select class="form-control" name="tutorcategory" required
                                        style="outline: none; margin-top: -12px;">
                                        <option <?php echo ($row['TutorCategory']=="") ? 'selected' : '' ;?> Selected
                                            Disabled> Select Category</option>
                                        <option <?php echo ($row['TutorCategory']=="Home Tution") ? 'selected' : '' ;?>
                                            value="Home Tution"> Home Tution</option>
                                        <option <?php echo ($row['TutorCategory']=="Teaching Job") ? 'selected' : '' ;?>
                                            value="Teaching Job"> Teaching Job</option>
                                        <option <?php echo ($row['TutorCategory']=="Both") ? 'selected' : '' ;?>
                                            value="Both"> Both</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Insert Image</p>
                                    <input class="form-control" name="tutorimage" id="tutorimage" type="file" required
                                        style="outline: none; margin-top: -12px;">
                                    <input class="form-control" name="tutorimageBase64" type="hidden"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Upload Document</p>
                                    <input class="form-control" name="uploaddocument" multiple id="uploaddocument"
                                        type="file" required style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Are you teacher by profession?</p>
                                    <select class="form-control" name="teacherbyprofession"
                                        style="outline: none; margin-top: -12px;">
                                        <option <?php echo ($row['TeacherByProfession']=="") ? 'selected' : '' ;?>
                                            Selected Disabled> Select</option>
                                        <option <?php echo ($row['TeacherByProfession']=="Yes") ? 'selected' : '' ;?>
                                            value="Yes">Yes</option>
                                        <option <?php echo ($row['TeacherByProfession']=="No") ? 'selected' : '' ;?>
                                            value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class=" form-group">
                                    <p style="font-weight: bold">If Yes Then Where</p>
                                    <input class="form-control" name="yesthenwhere" type="text" placeholder=""
                                        value="<?php echo $row['YesThenWhere'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class=" form-group">
                                    <p style="font-weight: bold">Total Experience In Years</p>
                                    <input class="form-control" name="experienceinyears" type="number" min="0" required
                                        value="<?php echo $row['TotalExperience'] ?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <p style="color:#4eb2e7"><b>Please read the instruction carefully given at the bottom
                                        before filling in this form.</b>
                                </p>
                            </div>
                            <div class="col-sm-12">
                                <div style="height: 470px; border:1px solid #000; background-color:#ebf8a4; 
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Section I - Personal
                                            Information</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Full Name</p>
                                                <input class="form-control" name="fullname" type="text" required
                                                    value="<?php echo $row['FullName'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Father/Husband Name</p>
                                                <input class="form-control" name="fathusname" type="text" required
                                                    value="<?php echo $row['FatherHusbandName'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Mother Name/ Tounge</p>
                                                <input class="form-control" name="mothnametounge" type="text" required
                                                    value="<?php echo $row['MotherNameTounge'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Gender</p>
                                                <select class="form-control" name="gender" required
                                                    style="outline: none; margin-top: -12px;">
                                                    <option <?php echo ($row['Gender']=="") ? 'selected' : '' ;?>
                                                        Selected Disabled>Select Gender</option>
                                                    <option <?php echo ($row['Gender']=="Male") ? 'selected' : '' ;?>
                                                        value="Male">Male</option>
                                                    <option <?php echo ($row['Gender']=="Female") ? 'selected' : '' ;?>
                                                        value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Date of Birth</p>
                                                <input class="form-control" name="dob" type="date" required
                                                    value="<?php echo $row['DateOfBirth'] ?>"
                                                    style="outline: none; margin-top: -12px;"
                                                    max="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Age</p>
                                                <input class="form-control" name="age" type="text" pattern="\d*"
                                                    maxlength="2" required value="<?php echo $row['Age'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Nationality</p>
                                                <input class="form-control" name="nationality" type="text" required
                                                    value="<?php echo $row['Nationality'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Religion</p>
                                                <input class="form-control" name="religion" type="text" required
                                                    value="<?php echo $row['Religion'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p style="font-weight: bold">C.N.I.C Number</p>
                                                <input class="form-control" name="cnicno" type="text" required
                                                    pattern="\d*" maxlength="14" value="<?php echo $row['CnicNo'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Present Address</p>
                                                <input class="form-control" name="presentadd" type="text" required
                                                    value="<?php echo $row['PresentAddress'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Permanent Address</p>
                                                <input class="form-control" name="permanentadd" type="text" required
                                                    value="<?php echo $row['PermanentAddress'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Phone # 1</p>
                                                <input class="form-control" name="phoneno1" type="text" required
                                                    pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                                    title="Phone # should be in format 0123-4567890"
                                                    value="<?php echo $row['PhoneNo1'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Phone # 2</p>
                                                <input class="form-control" name="phoneno2" type="text"
                                                    pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                                    title="Phone # should be in format 0123-4567890"
                                                    value="<?php echo $row['PhoneNo2'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Phone # 3</p>
                                                <input class="form-control" name="phoneno3" type="text"
                                                    pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                                    title="Phone # should be in format 0123-4567890"
                                                    value="<?php echo $row['PhoneNo3'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Facebook I.D</p>
                                                <input class="form-control" name="fbid" type="text"
                                                    pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$|\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                                    title="Email should include @ following sequence of characters. e.g. john@gmail.com and 
                                                            Phone # should be in format 0123-4567890"
                                                    value="<?php echo $row['FacebookId'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold">E-mail</p>
                                                <input class="form-control" name="email" type="email" required
                                                    pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$"
                                                    title="Email should include @ following sequence of characters. e.g. john@gmail.com"
                                                    value="<?php echo $row['Email'] ?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div style="height: auto; border:1px solid #000; background-color:#ebf8a4;
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Section II -
                                            Qualifications</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Qualifications</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Subjects/Specialization</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Institute / University</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Year of Passing</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Grade / Division</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="section2_qualification" name="section2_qualification"
                                        style="padding: 0px 5px;">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input class="form-control" name="qualification[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input class="form-control" name="subspec[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input class="form-control" name="insuni[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input class="form-control" name="passingyear[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input class="form-control" name="gradedivision[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- add row & delete row-->
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-2">
                                            <input name="addsection2_qualification" type="button"
                                                value="+Add Qualification" onclick="addsec2_qualification();"
                                                class="form-control" style="font-size: 18px; color: #9C4BEB;" />
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="delsection2_qualification" type="button"
                                                value="-Remove Qualification" onclick="delsec2_qualification();"
                                                class="form-control"
                                                style=" width:200px; font-size: 18px; color: #9C4BEB;" />
                                        </div>
                                    </div>
                                    <br>

                                    <!-- <p class="form-control" style=" background-color:#4EB2E7"><b>Extra
                                        Qualifications</b>
                                </p>
                                <div class="row" style="padding: 0px 5px;">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <p style="font-weight: bold">Qualifications</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <p style="font-weight: bold">Subjects/Specialization</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <p style="font-weight: bold">Institute / University</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <p style="font-weight: bold">Year of Passing</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <p style="font-weight: bold">Grade / Division</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="section2_extraqualification" name="section2_extraqualification"
                                    style="padding: 0px 5px;">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" type="text" required
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" type="text" required
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control" type="text" required
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" type="text" required
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" type="text" required
                                                style="outline: none; margin-top: -12px;">
                                        </div>
                                    </div>
                                </div> -->

                                    <!-- add row & delete row-->
                                    <!-- <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-2">
                                        <input name="addsection2_extraqualification" type="button"
                                            value="+Add Qualification" onclick="addsec2_extraqualification();"
                                            class="form-control" style="font-size: 18px; color: #9C4BEB;" />
                                    </div>
                                    <div class="col-sm-2">
                                        <input name="delsection2_extraqualification" type="button"
                                            value="-Remove Qualification" onclick="delsec2_extraqualification();"
                                            class="form-control"
                                            style=" width:200px; font-size: 18px; color: #9C4BEB;" />
                                    </div>
                                </div>
                                <br> -->
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div style="height: auto; border:1px solid #000; background-color:#ebf8a4;
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Section III -
                                            Job Experiences</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Job Entitlement</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Name of Organization</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">From</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Till</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="section3_jobexperience" name="section3_jobexperience"
                                        style="padding: 0px 5px;">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input class="form-control" name="jobtitle[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input class="form-control" name="orgname[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input class="form-control" name="fromto[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input class="form-control" name="till[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- add row & delete row-->
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-2">
                                            <input name="addsection3_jobexperience" type="button"
                                                value="+Add Experience" onclick="addsec3_jobexperience();"
                                                class="form-control" style="font-size: 18px; color: #9C4BEB;" />
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="delsection3_jobexperience" type="button"
                                                value="-Remove Experience" onclick="delsec3_jobexperience();"
                                                class="form-control"
                                                style=" width:200px; font-size: 18px; color: #9C4BEB;" />
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div style="height: auto; border:1px solid #000; background-color:#ebf8a4;
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Section IV -
                                            Area of Interest</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Classes to Teach</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold;">Preferred Subject
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="section4_areaofinterest" name="section4_areaofinterest"
                                        style="padding: 0px 5px;">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select class="form-control" name="classtoteach[]" required
                                                    style="outline: none; margin-top: -12px;">
                                                    <option Selected Disabled>Please Select Class</option>
                                                    <option value="Class 1">Class 1</option>
                                                    <option value="Class 2">Class 2</option>
                                                    <option value="Class 3">Class 3</option>
                                                    <option value="Class 4">Class 4</option>
                                                    <option value="Class 5">Class 5</option>
                                                    <option value="Class 6">Class 6</option>
                                                    <option value="Class 7">Class 7</option>
                                                    <option value="Class 8">Class 8</option>
                                                    <option value="Matric 9">Matric 9</option>
                                                    <option value="Matric 10">Matric 10</option>
                                                    <option value="Olevel Year 1">Olevel Year 1</option>
                                                    <option value="Olevel Year 2">Olevel Year 2</option>
                                                    <option value="Olevel Year 3">Olevel Year 3</option>
                                                    <option value="Inter Year 1">Inter Year 1</option>
                                                    <option value="Inter Year 2">Inter Year 2</option>
                                                    <option value="Alevel Year 1">Alevel Year 1</option>
                                                    <option value="Alevel Year 2">Alevel Year 2</option>
                                                    <option value="Alevel Year 3">Alevel Year 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group" style="margin-top:-12px">
                                                <input class="form-control" name="prefsubject[]" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- add row & delete row-->
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-2">
                                            <input name="addsection4_areaofinterest" type="button" value="+Add Class"
                                                onclick="addsec4_areaofinterest();" class="form-control"
                                                style="font-size: 18px; color: #9C4BEB;" />
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="delsection4_areaofinterest" type="button" value="-Remove Class"
                                                onclick="delsec4_areaofinterest();" class="form-control"
                                                style=" width:200px; font-size: 18px; color: #9C4BEB;" />
                                        </div>
                                    </div>
                                    <br>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <p style="font-weight: bold;">Preferred Area</p>
                                            <select class="form-control" name="prefarea[]" id="prefarea" required
                                                style="outline: none;" multiple>
                                                <option value="Baldia Town">Baldia Town</option>
                                                <option value="Bin Qasim Town">Bin Qasim Town</option>
                                                <option value="Gadap Town">Gadap Town</option>
                                                <option value="Gulberg Town">Gulberg Town</option>
                                                <option value="Gulshan Town">Gulshan Town</option>
                                                <option value="Jamshed Town">Jamshed Town</option>
                                                <option value="Kiamari Town">Kiamari Town</option>
                                                <option value="Korangi Town">Korangi Town</option>
                                                <option value="Landhi Town">Landhi Town</option>
                                                <option value="Liaquatabad Town">Liaquatabad Town</option>
                                                <option value="Lyari Town">Lyari Town</option>
                                                <option value="Malir Town">Malir Town</option>
                                                <option value="New Karachi Town">New Karachi Town</option>
                                                <option value="North Nazimabad Town">North Nazimabad Town</option>
                                                <option value="Orangi Town">Orangi Town</option>
                                                <option value="Saddar Town">Saddar Town</option>
                                                <option value="Nazimabad Town">Nazimabad Town</option>
                                                <option value="Shah Faisal Town">Shah Faisal Town</option>
                                                <option value="SITE Town">SITE Town</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div style="height: 550px; border:1px solid #000; background-color:#ebf8a4;
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Section V -
                                            References
                                            (Please provide two refernces) with differences addresses</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-12 text-center">
                                            <p style="background-color: #C7C7C7"><b>Reference I</b></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Name:</p>
                                                <input class="form-control" name="ref1Name" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Relation:</p>
                                                <input class="form-control" name="ref1Relation" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Occupation:</p>
                                                <input class="form-control" name="ref1Occupation" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Telephone No:</p>
                                                <input class="form-control" name="ref1TelephoneNo" type="text" required
                                                    pattern="\d*" maxlength="12"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Address:</p>
                                                <input class="form-control" name="ref1Address" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-12 text-center">
                                            <p style="background-color: #C7C7C7"><b>Reference II</b></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Name:</p>
                                                <input class="form-control" name="ref2Name" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Relation:</p>
                                                <input class="form-control" name="ref2Relation" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Occupation:</p>
                                                <input class="form-control" name="ref2Occupation" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Telephone No:</p>
                                                <input class="form-control" name="ref2TelephoneNo" type="text" required
                                                    pattern="\d*" maxlength="12"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Address:</p>
                                                <input class="form-control" name="ref2Address" type="text" required
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Do you have personal conveyance?</p>
                                                <select class="form-control" name="personalconveyance"
                                                    style="outline: none; margin-top: -12px;">
                                                    <option value="Select">Select</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <p style="font-weight: bold">If Yes Then Car/Bike?:</p>
                                                <input class="form-control" name="carbike" type="text"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div style="height: 220px; border:1px solid #000; background-color:#ebf8a4;
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Section VI -
                                            Undertaking</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-12">
                                            <p> I certify that the information given above is correct to the best of
                                                my
                                                knowledge and that I have not with held any information, which any
                                                adversely
                                                affect to any Home Tuition. I further certify that I have never been
                                                expelled
                                                or otherwise penalised or misconduct by any educational or
                                                professional
                                                institution and I have never been convieted by court of law.
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Date:</p>
                                                <input class="form-control" name="dateofsubmission" type="date" required
                                                    style="outline: none; margin-top: -12px;"
                                                    min="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <br>
                        <button name="submit" id="submit" class="btn btn-success" onclick="FormSubmiConfirmation()"
                            style="width:130px">Submit</button>
                        <button type="submit" id="saveasdraft" name="saveasdraft" class="btn btn-warning ml-2"
                            onclick="SaveAsDraft()" style="width:130px">Save As Draft</button>
                    </form>
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

    <!-- Select Multiple Location -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
    </script>
    <script>
    $('#prefarea').multiselect({
        nonSelectedText: 'Select Locations',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '100%',
        includeSelectAllOption: false
    });
    </script>

    <!-- section 2 row insert and delete script start-->
    <script>
    // document.getElementsByName("teacherbyprofession")[0].value = "Yes";
    // document.getElementsByName("yesthenwhere")[0].value = "Yes";
    // document.getElementsByName("fullname")[0].value = "Yes";
    // document.getElementsByName("fathusname")[0].value = "Yes";
    // document.getElementsByName("mothnametounge")[0].value = "Yes";
    // document.getElementsByName("gender")[0].value = "Yes";
    // document.getElementsByName("dob")[0].value = "2020-06-04";
    // document.getElementsByName("age")[0].value = "Yes";
    // document.getElementsByName("nationality")[0].value = "Yes";
    // document.getElementsByName("religion")[0].value = "Yes";
    // document.getElementsByName("cnicno")[0].value = "Yes";
    // document.getElementsByName("presentadd")[0].value = "Yes";
    // document.getElementsByName("permanentadd")[0].value = "Yes";
    // document.getElementsByName("phoneno1")[0].value = "0323-1234567";
    // document.getElementsByName("phoneno2")[0].value = "0323-1234567";
    // document.getElementsByName("phoneno3")[0].value = "0323-1234567";
    // document.getElementsByName("fbid")[0].value = "Yes";
    // document.getElementsByName("email")[0].value = "abc@gmail.co";
    // document.getElementsByName("qualification[]")[0].value = "Yes";
    // document.getElementsByName("subspec[]")[0].value = "Yes";
    // document.getElementsByName("insuni[]")[0].value = "Yes";
    // document.getElementsByName("passingyear[]")[0].value = "Yes";
    // document.getElementsByName("gradedivision[]")[0].value = "Yes";
    // document.getElementsByName("jobtitle[]")[0].value = "Yes";
    // document.getElementsByName("orgname[]")[0].value = "Yes";
    // document.getElementsByName("fromto[]")[0].value = "Yes";
    // document.getElementsByName("till[]")[0].value = "Yes";
    // document.getElementsByName("classtoteach[]")[0].value = "Yes";
    // document.getElementsByName("prefsubject[]")[0].value = "Yes";
    // document.getElementsByName("prefarea[]")[0].value = "Yes";
    // document.getElementsByName("ref1Name")[0].value = "Yes";
    // document.getElementsByName("ref1Relation")[0].value = "Yes";
    // document.getElementsByName("ref1Occupation")[0].value = "Yes";
    // document.getElementsByName("ref1TelephoneNo")[0].value = "Yes";
    // document.getElementsByName("ref1Address")[0].value = "Yes";
    // document.getElementsByName("ref2Name")[0].value = "Yes";
    // document.getElementsByName("ref2Relation")[0].value = "Yes";
    // document.getElementsByName("ref2Occupation")[0].value = "Yes";
    // document.getElementsByName("ref2TelephoneNo")[0].value = "Yes";
    // document.getElementsByName("ref2Address")[0].value = "Yes";
    // document.getElementsByName("personalconveyance")[0].value = "Yes";
    // document.getElementsByName("carbike")[0].value = "Yes";
    // document.getElementsByName("dateofsubmission")[0].value = "2020-06-29";


    function addsec2_qualification() {
        $("#section2_qualification").clone().insertAfter("#section2_qualification");
    }

    function delsec2_qualification() {
        if (document.getElementsByName('section2_qualification').length > 1)
            $("#section2_qualification").remove();
    }
    </script>
    <!-- section 2 row insert and delete script end-->

    <!-- section 3 row insert and delete script start-->
    <script>
    function addsec3_jobexperience() {
        $("#section3_jobexperience").clone().insertAfter("#section3_jobexperience");
    }

    function delsec3_jobexperience() {
        if (document.getElementsByName('section3_jobexperience').length > 1)
            $("#section3_jobexperience").remove();
    }
    </script>
    <!-- section 3 row insert and delete script end-->

    <!-- section 4 row insert and delete script start-->
    <script>
    function addsec4_areaofinterest() {
        $("#section4_areaofinterest").clone().insertAfter("#section4_areaofinterest");
    }

    function delsec4_areaofinterest() {
        if (document.getElementsByName('section4_areaofinterest').length > 1)
            $("#section4_areaofinterest").remove();
    }
    </script>
    <!-- section 4 row insert and delete script end-->
</body>




<!-- *************************** api Teacher Tutor form ************************* -->
<!-- jason seralized data -->
<script type="text/javascript" src="../dist/js/jquery.serializejson.js"></script>
<script>
var docBase64 = [];
$("#tutorimage").on('change', function() {
    var imageFiles = document.getElementsByName("tutorimage")[0];
    filesLength = imageFiles.files.length;

    var file = imageFiles.files[0];

    var reader = new FileReader();
    reader.onloadend = function() {
        // console.log('RESULT', reader.result);
        document.getElementsByName("tutorimageBase64")[0].value = reader.result;
    }
    var imageBase64 = reader.readAsDataURL(file);
    // console.log(imageBase64);
    document.getElementsByName("tutorimageBase64")[0].value = imageBase64;
});

$("#uploaddocument").on('change', function() {
    var docFiles = document.getElementsByName("uploaddocument")[0].files;
    console.log('RESULT', docFiles.length);
    console.log('RESULT', docFiles);
    i = 0;

    var reader = [];
    for (i = 0; i < docFiles.length; i++) {
        var file = docFiles[i];
        console.log('RESULT', i);
        console.log('RESULT', file.name);

        reader[i] = new FileReader();
        reader[i].readAsDataURL(file);
        reader[i].onloadend = function(result) {
            docBase64.push(result.currentTarget.result);
            // console.log('RESULT', reader.result);
            // document.getElementsByName("uploaddocument")[0].value = reader.result;
        }
        // docBase64[i] = reader.readAsDataURL(file);
        // document.getElementsByName("uploaddocument")[0].value = docBase64;
    }
    console.log(docBase64);

});


$("#submit").click(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    let allAreFilled = true;
    var unfilledInput = '';
    document.getElementById("tutorform").querySelectorAll("[required]").forEach(function(i) {
        if (!allAreFilled) return;
        patternvalid = true;
        if (document.getElementsByName(i.name)[0].pattern != undefined)
            if (document.getElementsByName(i.name)[0].value.match(document.getElementsByName(i
                    .name)[0].pattern)) {
                // form.submit();
            } else {
                allAreFilled = false;
                patternvalid = false;
                document.getElementsByName(i.name)[0].focus();
                alert(document.getElementsByName(i.name)[0].title);
                return;
                // display message
            }

        if (patternvalid) {
            if (!i.value) {
                allAreFilled = false;
                console.log('i', i);
                document.getElementsByName(i.name)[0].focus();
                alert("This field is required.");
                return;
            }
        } else {
            allAreFilled = false;
            patternvalid = false;
            document.getElementsByName(i.name)[0].focus();
            alert(document.getElementsByName(i.name)[0].title);
            return;
        }
    })
    if (allAreFilled) {
        //     alert('Fill all the fields');
        // } else {
        var form = $('#tutorform');
        var url = form.attr('action');
        console.log(url)

        //jason serialised data start
        var data = $('#tutorform').serializeJSON();
        data.documents = docBase64;
        console.log("tutorform", data);
        console.log("tutorform", JSON.stringify(data));
        //jason serialised data end

        $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify(data),
            contentType: "json",

            success: function(data) {
                // alert(data);
                console.log(data);
                var obj = JSON.parse(data);
                if (obj.userid == null)
                    alert("Error");

                window.location.href = "tutorform.php";
            }

        });
    }
});


//jb field fill nh hogi to ye redirect krega us field pr 
$('input').focus(function() {
    $('html, body').animate({
        scrollTop: $(this).offset().top - 100 + 'px'
    }, 'fast');
});
</script>


<script>
$("#saveasdraft").click(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $('#tutorform');
    var url = form.attr('action');
    console.log(url)

    //jason serialised data start
    var data = $('#tutorform').serializeJSON();
    data['formStatus'] = 'Draft';
    console.log("tutorform", data);
    console.log("tutorform", JSON.stringify(data));
    //jason serialised data end

    $.ajax({
        type: "POST",
        url: url,
        data: JSON.stringify(data),
        contentType: "json",

        success: function(data1) {
            // alert(data);
            console.log("First " + data1);

            location.reload();
            var obj = JSON.parse(data1);
            if (obj.userid == null)
                alert("Error");

            // window.location.href = "index.php";
            // location.reload();
        }
    });
});
</script>

<script>
function FormSubmiConfirmation() {
    alert("Your Form Has been Submitted!");
}
</script>

<script>
function SaveAsDraft() {
    alert("Your Form Has been Saved as a Draft!");
}
</script>

<!-- browser close event -->
<script>
window.onbeforeunload = function(e) {
    e = e || window.event;

    // For IE and Firefox prior to version 4
    if (e) {
        e.returnValue = 'Sure?';
    }

    // For Safari
    return 'Sure?';
};
</script>

</html>