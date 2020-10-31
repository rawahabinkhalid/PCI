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
                            <h1 class="m-0 text-dark"><u>Add job/Institute Registration Form</u></h1>
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
                    <form action="instituteregistrationsubmit.php" id="instituteform">
                        <?php 
                            $sql="SELECT * FROM instituteregistrationform WHERE `UserId` = ".$_SESSION['userid'];
                            $result = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold">Name Of Institution:</p>
                                    <input class="form-control" name="nameofInstitute" type="text" required
                                        value="<?php echo $row['InstituteName']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold">Type Of Institute:</p>
                                    <Select class="form-control" name="typeofInstitute"
                                        style="outline: none; margin-top: -12px;">
                                        <option selected disabled
                                            <?php echo ($row['TypeOfInstitute'] =="") ? 'selected' : '' ;?>
                                            value="Please Select Institute">Please Select Institute
                                        </option>
                                        <option <?php echo ($row['TypeOfInstitute'] =="School") ? 'selected' : '' ;?>
                                            value="School">School</option>
                                        <option <?php echo ($row['TypeOfInstitute'] =="College") ? 'selected' : '' ;?>
                                            value="College">College</option>
                                        <option
                                            <?php echo ($row['TypeOfInstitute'] =="University") ? 'selected' : '' ;?>
                                            value="University">University</option>
                                        <option
                                            <?php echo ($row['TypeOfInstitute'] =="CoachingCenter") ? 'selected' : '' ;?>
                                            value="CoachingCenter">Coaching Center</option>
                                        <option <?php echo ($row['TypeOfInstitute'] =="Others") ? 'selected' : '' ;?>
                                            value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold">If Type Of Institute Others:</p>
                                    <input class="form-control" name="othersinstitute" type="othersinstitute"
                                        value="<?php echo $row['IfInstituteOther']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold">Email:</p>
                                    <input class="form-control" name="email" type="email" required
                                        pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$"
                                        title="Email should include @ following sequence of characters. e.g. john@gmail.com"
                                        value="<?php echo $row['Email']?>" style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Person:</p>
                                    <input class="form-control" name="contactperson" type="text" required
                                        value="<?php echo $row['ContactPerson']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 1</p>
                                    <input class="form-control" name="contactno1" type="text" required
                                        pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                        title="Phone # should be in format 0123-4567890"
                                        value="<?php echo $row['ContactNo1']?>"
                                        style="outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p style="font-weight: bold">Contact Number 2</p>
                                    <input class="form-control" name="contactno2" type="text"
                                        pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                        title="Phone # should be in format 0123-4567890"
                                        value="<?php echo $row['ContactNo2']?>"
                                        style=" outline: none; margin-top: -12px;">
                                </div>
                            </div>
                            <div class="col-sm-3">
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
                                    <p class="form-control" style=" background-color:#4EB2E7"><b>Institute Job</b>
                                    </p>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Class</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Subjects</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">If Other (Subjects)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 0px 5px;">
                                        <div class="col-sm-4">
                                            <div class="form-group" style="margin-top:-12px;">
                                                <select class="form-control" name="class[]" id="class" required
                                                    style="outline: none;">
                                                    <option Selected Disabled>Select Class</option>
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
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group" style="margin-top:-12px;">
                                                <select class="form-control subjects" name="subjects[]" id="subjects"
                                                    style="outline: none;" multiple>
                                                    <?php
                                                    $sql = 'SELECT * FROM all_subjects';
                                                    $result = mysqli_query($conn, $sql);
                                                    while($row1 = mysqli_fetch_assoc($result)){
                                                    echo'
                                                    <option value="'.$row1['Subjects'].'">'.$row1['Subjects'].'</option>
                                                    ';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input class="form-control" name="othersubjects" type="text"
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
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Address:</p>
                                                <input class="form-control" name="address" type="text" required
                                                    value="<?php echo $row['Address']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Street Number:</p>
                                                <input class="form-control" name="streetnum" type="text"
                                                    value="<?php echo $row['StreetNum']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Block Number:</p>
                                                <input class="form-control" name="blocknum" type="text"
                                                    value="<?php echo $row['BlockNum']?>"
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
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Country:</p>
                                                <input class="form-control" name="country" type="text" required
                                                    value="<?php echo $row['Country']?>"
                                                    style="outline: none; margin-top: -12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Gender of Required Teacher:</p>
                                                <select class="form-control" name="gender" required
                                                    style="outline: none; margin-top: -12px;">
                                                    <option value="" selected disbaled>Select Gender</option>
                                                    <option value="Any">Any</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Timings:</p>
                                                <select class="form-control" name="timing" required
                                                    style="outline: none; margin-top: -12px;">
                                                    <option selected disabled>Please Select Timings</option>
                                                    <option value="8:30am">8:30am</option>
                                                    <option value="8:30am">8:30am</option>
                                                    <option value="8:30am">9:00am</option>
                                                    <option value="8:30am">9:30am</option>
                                                    <option value="8:30am">10:00am</option>
                                                    <option value="8:30am">10:30am</option>
                                                    <option value="8:30am">11:00am</option>
                                                    <option value="8:30am">11:30am</option>
                                                    <option value="8:30am">12:00pm</option>
                                                    <option value="8:30am">12:30am</option>
                                                    <option value="8:30am">1:00pm</option>
                                                    <option value="8:30am">1:30pm</option>
                                                    <option value="8:30am">2:00pm</option>
                                                    <option value="8:30am">2:30pm</option>
                                                    <option value="8:30am">3:00pm</option>
                                                    <option value="8:30am">3:30pm</option>
                                                    <option value="8:30am">4:00pm</option>
                                                    <option value="8:30am">4:30pm</option>
                                                    <option value="8:30am">5:00pm</option>
                                                    <option value="8:30am">5:30pm</option>
                                                    <option value="8:30am">6:00pm</option>
                                                    <option value="8:30am">6:30pm</option>
                                                    <option value="8:30am">7:00pm</option>
                                                    <option value="8:30am">7:30pm</option>
                                                    <option value="8:30am">8:00pm</option>
                                                    <option value="8:30am">8:30pm</option>
                                                    <option value="8:30am">9:00pm</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Salary From:</p>
                                                <input class="form-control" name="salaryfrom" required
                                                    style="outline: none; margin-top: -12px;" placeholder="5000 -/PKR">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <p style="font-weight: bold">Salary To:</p>
                                                <input class="form-control" name="salaryto" required
                                                    style="outline: none; margin-top: -12px;" placeholder="10000 -/PKR">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <br>
                        <button type="submit" id="submit" name="submit" class="btn btn-success"
                            onclick="FormSubmiConfirmation()" style="width:130px">Submit</button>
                        <button type="submit" id="saveasdraft" name="saveasdraft" class="btn btn-warning ml-2"
                            onclick="SaveAsDraft()" style="width:130px">Save As Draft</button> </form>
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

<!-- *************************** api Institute Registration form ************************* -->
<!-- jason seralized data -->
<script type="text/javascript" src="../dist/js/jquery.serializejson.js"></script>
<script>
$("#submit").click(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    let allAreFilled = true;
    var unfilledInput = '';
    document.getElementById("instituteform").querySelectorAll("[required]").forEach(function(i) {
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
        //     $('#studentform').submit();
        //     alert('Fill all the fields');
        // } else {
        var form = $('#instituteform');
        var url = form.attr('action');
        console.log(url)

        //jason serialised data start
        var data = $('#instituteform').serializeJSON();
        console.log("instituteform", data);
        console.log("instituteform", JSON.stringify(data));
        //jason serialised data end

        $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify(data),
            contentType: "json",

            success: function(data) {
                // alert(data);
                var obj = JSON.parse(data);
                if (obj.instituteformId == null)
                    alert("Error");

                window.location.href = "index.php";
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

    var form = $('#instituteform');
    var url = form.attr('action');
    console.log(url)

    //jason serialised data start
    var data = $('#instituteform').serializeJSON();
    data['formStatus'] = 'Draft';
    console.log("instituteform", data);
    console.log("instituteform", JSON.stringify(data));
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
            if (obj.instituteformId == null)
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

<!-- Browser close event -->
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