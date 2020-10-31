<?php
session_start();
if(!isset($_SESSION['userrole'])){
    header('location:../Login/index.php');
}

include_once('../conn.php');
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
                            <h1 class="m-0 text-dark"><u>Edit Child/Siblings/Student Tuition Form</u></h1>
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

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <form action="EditProfilesubmit.php" id="editstudent">
                        <?php
                            $sql = "SELECT * FROM studenttutorform WHERE `Id` = ".$_GET['id'];
                            $result= mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Student Name:</p>
                                    <input type="hidden" name="Id" type="text" value="<?php echo $row['Id']?>"
                                        style="outline: none; margin-top: -12px;">
                                    <input class="form-control" name="name" type="text" required
                                        value="<?php echo $row['StudentName']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Father Name:</p>
                                    <input class="form-control" name="fathername" type="text" required
                                        value="<?php echo $row['FatherName']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Student Email:</p>
                                    <input class="form-control" name="email" type="email" required
                                        pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$"
                                        title="Email should include @ following sequence of characters. e.g. john@gmail.com"
                                        value="<?php echo $row['StudentEmail']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 1</p>
                                    <input class="form-control" name="contactno1" type="text" required
                                        pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                        title="Phone # should be in format 0123-4567890"
                                        value="<?php echo $row['ContactNo1']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 2</p>
                                    <input class="form-control" name="contactno2" type="text"
                                        pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                        title="Phone # should be in format 0123-4567890"
                                        value="<?php echo $row['ContactNo2']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 3</p>
                                    <input class="form-control" name="contactno3" type="text"
                                        pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                        title="Phone # should be in format 0123-4567890"
                                        value="<?php echo $row['ContactNo3']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div style="height: auto; border:1px solid #000; background-color:#ebf8a4;
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Student Class</b>
                                    </p>

                                    <div class="row" id="studentclass" name="studentclass" style="padding: 0px 5px;">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Class</p>
                                                <select class="form-control" name="class" required
                                                    style="outline: none; margin-top: -12px;">
                                                    <option <?php echo ($row['Class']=="") ? 'selected' : '' ;?>
                                                        Selected disabled>Select Class</option>
                                                    <option <?php echo ($row['Class']=="Class 1") ? 'selected' : '' ;?>
                                                        value="Class 1">Class 1</option>
                                                    <option <?php echo ($row['Class']=="Class 2") ? 'selected' : '' ;?>
                                                        value="Class 2">Class 2</option>
                                                    <option <?php echo ($row['Class']=="Class 3") ? 'selected' : '' ;?>
                                                        value="Class 3">Class 3</option>
                                                    <option <?php echo ($row['Class']=="Class 4") ? 'selected' : '' ;?>
                                                        value="Class 4">Class 4</option>
                                                    <option <?php echo ($row['Class']=="Class 5") ? 'selected' : '' ;?>
                                                        value="Class 5">Class 5</option>
                                                    <option <?php echo ($row['Class']=="Class 6") ? 'selected' : '' ;?>
                                                        value="Class 6">Class 6</option>
                                                    <option <?php echo ($row['Class']=="Class 7") ? 'selected' : '' ;?>
                                                        value="Class 7">Class 7</option>
                                                    <option <?php echo ($row['Class']=="Class 8") ? 'selected' : '' ;?>
                                                        value="Class 8">Class 8</option>
                                                    <option <?php echo ($row['Class']=="Matric 9") ? 'selected' : '' ;?>
                                                        value="Matric 9">Matric 9</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Matric 10") ? 'selected' : '' ;?>
                                                        value="Matric 10">Matric 10</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Olevel Year 1") ? 'selected' : '' ;?>
                                                        value="Olevel Year 1">Olevel Year 1</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Olevel Year 2") ? 'selected' : '' ;?>
                                                        value="Olevel Year 2">Olevel Year 2</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Olevel Year 3") ? 'selected' : '' ;?>
                                                        value="Olevel Year 3">Olevel Year 3</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Inter Year 1") ? 'selected' : '' ;?>
                                                        value="Inter Year 1">Inter Year 1</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Inter Year 2") ? 'selected' : '' ;?>
                                                        value="Inter Year 2">Inter Year 2</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Alevel Year 1") ? 'selected' : '' ;?>
                                                        value="Alevel Year 1">Alevel Year 1</option>
                                                    <option
                                                        <?php echo ($row['Class']=="Alevel Year 2") ? 'selected' : '' ;?>
                                                        value="Alevel Year 2">Alevel Year 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group" style="margin-top:-12px;">
                                                <p style="font-weight: bold">Subjects</p>
                                                <select class="form-control subjects" name="subjects[]" id="subjects"
                                                    multiple style="outline: none; margin-top: -12px;">
                                                    <?php 
                                                        $sql1 = 'SELECT * FROM studenttutorsubjects WHERE studenttutorform_id = ' . $row['Id'];
                                                        $result1 = $conn->query($sql1);
                                                        $subjects = [];
                                                        if($result1->num_rows > 0) {
                                                            while($row1 = $result1->fetch_assoc()) {
                                                                $subjects[] = $row1['Subjects'];
                                                            }
                                                        }
                                                    ?>
                                                    <option
                                                        <?php echo (in_array("English", $subjects)) ? 'selected' : ''; ?>
                                                        value="English">English</option>
                                                    <option
                                                        <?php echo (in_array("Urdu", $subjects)) ? 'selected' : ''; ?>
                                                        value="Urdu">Urdu</option>
                                                    <option
                                                        <?php echo (in_array("Maths", $subjects)) ? 'selected' : ''; ?>
                                                        value="Maths">Maths</option>
                                                    <option
                                                        <?php echo (in_array("Science", $subjects)) ? 'selected' : ''; ?>
                                                        value="Science">Science</option>
                                                    <option
                                                        <?php echo (in_array("History", $subjects)) ? 'selected' : ''; ?>
                                                        value="History">History</option>
                                                    <option
                                                        <?php echo (in_array("Sindhi", $subjects)) ? 'selected' : ''; ?>
                                                        value="Sindhi">Sindhi</option>
                                                    <option
                                                        <?php echo (in_array("Chemistry", $subjects)) ? 'selected' : ''; ?>
                                                        value="Chemistry">Chemistry</option>
                                                    <option
                                                        <?php echo (in_array("Physics", $subjects)) ? 'selected' : ''; ?>
                                                        value="Physics">Physics</option>
                                                    <option
                                                        <?php echo (in_array("Biology", $subjects)) ? 'selected' : ''; ?>
                                                        value="Biology">Biology</option>
                                                    <option
                                                        <?php echo (in_array("Pak. Studies", $subjects)) ? 'selected' : ''; ?>
                                                        value="Pak. Studies">Pak. Studies</option>
                                                    <option
                                                        <?php echo (in_array("Islamiat", $subjects)) ? 'selected' : ''; ?>
                                                        value="Islamiat">Islamiat</option>
                                                    <option
                                                        <?php echo (in_array("Geography", $subjects)) ? 'selected' : ''; ?>
                                                        value="Geography">Geography</option>
                                                    <option
                                                        <?php echo (in_array("Add Maths", $subjects)) ? 'selected' : ''; ?>
                                                        value="Add Maths">Add Maths</option>
                                                    <option
                                                        <?php echo (in_array("Computer", $subjects)) ? 'selected' : ''; ?>
                                                        value="Computer">Computer</option>
                                                    <option
                                                        <?php echo (in_array("Others", $subjects)) ? 'selected' : ''; ?>
                                                        value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">If Other (Subjects)</p>
                                                <input class="form-control" name="othersubjects" type="text"
                                                    value=" <?php echo $row['IfOtherSubjects']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">School/College</p>
                                                <input class="form-control" name="schoolcollege" type="text" required
                                                    value="<?php echo $row['SchoolCollege']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Class Year</p>
                                                <input class="form-control" name="classyear" type="text" required
                                                    value="<?php echo $row['ClassYear']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div style="height: 310px; border:1px solid #000; background-color:#ebf8a4;
                                            border-radius:5px;">
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Please Provide
                                            Details</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">House Number:</p>
                                                <input class="form-control" name="housenum" type="text" required
                                                    value="<?php echo $row['HouseNumber']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Building Name:</p>
                                                <input class="form-control" name="buildingname" type="text"
                                                    value="<?php echo $row['BuildingName']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Street Number:</p>
                                                <input class="form-control" name="streetnum" type="text"
                                                    value="<?php echo $row['StreetNumber']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Block Number:</p>
                                                <input class="form-control" name="blocknum" type="text"
                                                    value="<?php echo $row['BlockNumber']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Area:</p>
                                                <select class="form-control" name="area" required
                                                    style="outline: none; margin-top: -12px;">
                                                    <option <?php echo ($row['Area']=="") ? 'selected' : '' ;?> Selected
                                                        Disabled> Select Preferred Area</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Baldia Town") ? 'selected' : '' ;?>
                                                        value="Baldia Town">Baldia Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Bin Qasim Town") ? 'selected' : '' ;?>
                                                        value="Bin Qasim Town">Bin Qasim Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Gadap Town") ? 'selected' : '' ;?>
                                                        value="Gadap Town">Gadap Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Gulberg Town") ? 'selected' : '' ;?>
                                                        value="Gulberg Town">Gulberg Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Gulshan Town") ? 'selected' : '' ;?>
                                                        value="Gulshan Town">Gulshan Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Jamshed Town") ? 'selected' : '' ;?>
                                                        value="Jamshed Town">Jamshed Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Kiamari Town") ? 'selected' : '' ;?>
                                                        value="Kiamari Town">Kiamari Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Korangi Town") ? 'selected' : '' ;?>
                                                        value="Korangi Town">Korangi Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Landhi Town") ? 'selected' : '' ;?>
                                                        value="Landhi Town">Landhi Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Liaquatabad Town") ? 'selected' : '' ;?>
                                                        value="Liaquatabad Town">Liaquatabad Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Lyari Town") ? 'selected' : '' ;?>
                                                        value="Lyari Town">Lyari Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Malir Town") ? 'selected' : '' ;?>
                                                        value="Malir Town">Malir Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="New Karachi Town") ? 'selected' : '' ;?>
                                                        value="New Karachi Town">New Karachi Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="North Nazimabad Town") ? 'selected' : '' ;?>
                                                        value="North Nazimabad Town">North Nazimabad Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Orangi Town") ? 'selected' : '' ;?>
                                                        value="Orangi Town">Orangi Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Saddar Town") ? 'selected' : '' ;?>
                                                        value="Saddar Town">Saddar Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Nazimabad Town") ? 'selected' : '' ;?>
                                                        value="Nazimabad Town">Nazimabad Town</option>
                                                    <option
                                                        <?php echo ($row['Area']=="Shah Faisal Town") ? 'selected' : '' ;?>
                                                        value="Shah Faisal Town">Shah Faisal Town</option>
                                                    <option <?php echo ($row['Area']=="SITE Town") ? 'selected' : '' ;?>
                                                        value="SITE Town">SITE Town</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">City:</p>
                                                <input class="form-control" name="city" type="text" required
                                                    value="<?php echo $row['City']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Country:</p>
                                                <input class="form-control" name="country" type="text" required
                                                    value="<?php echo $row['Country']?>"
                                                    style="outline: none; margin-top: -12px;">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Gender of Required Teacher:</p>
                                                <select class="form-control" name="gender" required
                                                    style="outline: none; margin-top: -12px;">
                                                    <option <?php echo ($row['Gender']=="") ? 'selected' : '' ;?>
                                                        value="" selected disbaled>Select Gender</option>
                                                    <option <?php echo ($row['Gender']=="Any") ? 'selected' : '' ;?>
                                                        value="Any">Any</option>
                                                    <option <?php echo ($row['Gender']=="Male") ? 'selected' : '' ;?>
                                                        value="Male">Male</option>
                                                    <option <?php echo ($row['Gender']=="Female") ? 'selected' : '' ;?>
                                                        value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group" style="margin-top: -12px;">
                                                <p style="font-weight: bold">Desired Timings:</p>
                                                <select class="form-control" name="desiredtiming[]" id="desiredtiming"
                                                    required multiple style="outline: none; margin-top: -12px;">
                                                    <?php 
                                                        $sql2 = 'SELECT * FROM studenttutordesiredtimings WHERE studenttutorform_id = ' . $row['Id'];
                                                        $result2 = $conn->query($sql2);
                                                        $desiredtimings = [];
                                                        if($result2->num_rows > 0) {
                                                            while($row2 = $result2->fetch_assoc()) {
                                                                $desiredtimings[] = $row2['DesiredTimings'];
                                                            }
                                                        }
                                                    ?>
                                                    <option
                                                        <?php echo (in_array("8am", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="8am">8am</option>
                                                    <option
                                                        <?php echo (in_array("9am", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="9am">9am</option>
                                                    <option
                                                        <?php echo (in_array("10am", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="10am">10am</option>
                                                    <option
                                                        <?php echo (in_array("11am", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="11am">11am</option>
                                                    <option
                                                        <?php echo (in_array("12pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="12pm">12pm</option>
                                                    <option
                                                        <?php echo (in_array("1pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="1pm">1pm</option>
                                                    <option
                                                        <?php echo (in_array("2pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="2pm">2pm</option>
                                                    <option
                                                        <?php echo (in_array("3pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="3pm">3pm</option>
                                                    <option
                                                        <?php echo (in_array("4pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="4pm">4pm</option>
                                                    <option
                                                        <?php echo (in_array("5pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="5pm">5pm</option>
                                                    <option
                                                        <?php echo (in_array("6pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="6pm">6pm</option>
                                                    <option
                                                        <?php echo (in_array("7pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="7pm">7pm</option>
                                                    <option
                                                        <?php echo (in_array("8pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="8pm">8pm</option>
                                                    <option
                                                        <?php echo (in_array("9pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="9pm">9pm</option>
                                                    <option
                                                        <?php echo (in_array("10pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="10pm">10pm</option>
                                                    <option
                                                        <?php echo (in_array("11pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="11pm">11pm</option>
                                                    <option
                                                        <?php echo (in_array("12pm", $desiredtimings)) ? 'selected' : ''; ?>
                                                        value="12pm">12pm</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <br>
                        <button type="submit" id="submit" name="submit" class="btn btn-success" onclick="myFunction()"
                            style="width:130px">Update</button>
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

    <!-- Selects Multiple subjects in dropdown -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
    </script>

    <script>
    $(document).ready(function() {
        $('#subjects').multiselect({
            nonSelectedText: 'Select Subjects',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            includeSelectAllOption: false
        });
    });
    </script>

    <!-- Select Multiple Desired Tuition Timings in dropdown -->
    <script>
    $(document).ready(function() {
        $('#desiredtiming').multiselect({
            nonSelectedText: 'Select Desired Timings(Max 3)',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            includeSelectAllOption: false,

            //condition three select box--------------------------------------------
            onChange: function(option, checked) {
                // Get selected options.
                var selectedOptions = jQuery('#desiredtiming option:selected');

                if (selectedOptions.length >= 3) {
                    // Disable all other checkboxes.
                    var nonSelectedOptions = jQuery('#desiredtiming option').filter(function() {
                        return !jQuery(this).is(':selected');
                    });

                    nonSelectedOptions.each(function() {
                        var input = jQuery('#desiredtiming + .btn-group input[value="' +
                            jQuery(this).val() + '"]');
                        input.prop('disabled', true);
                        input.parent('li').addClass('disabled');
                    });
                } else {
                    // Enable all checkboxes.
                    jQuery('#desiredtiming option').each(function() {
                        var input = jQuery('#desiredtiming + .btn-group  input[value="' +
                            jQuery(this).val() + '"]');
                        input.prop('disabled', false);
                        input.parent('li').addClass('disabled');
                    });
                }
            }
        });
    });
    </script>
</body>

<!-- *************************** api Add Student/siblings/child Tuition form ************************* -->
<!-- jason seralized data -->
<script type="text/javascript" src="../dist/js/jquery.serializejson.js"></script>
<script>
$("#submit").click(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    let allAreFilled = true;
    var unfilledInput = '';
    document.getElementById("editstudent").querySelectorAll("[required]").forEach(function(i) {
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
        //     $('#editstudent').submit();
        //     alert('Fill all the fields');
        // } else {
        var form = $(this);
        var url = form.attr('action');

        //jason serialised data start
        var data = $('#editstudent').serializeJSON();
        console.log("editstudent", data);
        console.log("editstudent", JSON.stringify(data));
        //jason serialised data end

        $.ajax({
            type: "POST",
            url: 'EditProfilesubmit.php',

            //jason serialised data start
            cache: false,
            data: JSON.stringify(data),
            contentType: "json",
            //jason serialised data end

            success: function(data) {
                // alert(data);
                console.log(data);
                // var obj = JSON.parse(data);
                // if (obj.studenttutorformId == null)
                //     alert("Error");

                // window.location.href = "index.php";
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
function myFunction() {
    alert("Your Profile Has Been Updated");
    location.reload();
}
</script>

</html>