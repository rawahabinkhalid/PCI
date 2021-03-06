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
    <link rel="stylesheet" href="https:////cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <style>
    body {
        background-color: #F4F6F9;
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
                        <div class="col-sm-6 mt-3">
                            <h1 class="m-0 text-dark"><u>Search Tutors</u></h1>
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
                    <form action="searchtutorsubmit.php" id="instituteform">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold; margin-bottom:5px;">Search Tuition For:</p>
                                    <select class="form-control" name="searchinstitute[]" required
                                        style="outline: none;" multiple id="institute">
                                        <?php
                                            $sql = "SELECT * FROM instituteregistrationform WHERE `UserId` = ".$_SESSION['userid'];
                                            $result = mysqli_query($conn, $sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$row['Id'].'">'.$row['InstituteName'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p style="font-weight: bold">Location/Preferred Area:</p>
                                    <select class="form-control" name="locationarea" required
                                        style="outline: none; margin-top: -12px;">
                                        <option Selected Disabled>Select Preferred Area</option>
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
                                        <option value="NewKarachi Town">New Karachi Town</option>
                                        <option value="North Nazimabad Town">North Nazimabad Town</option>
                                        <option value="Orangi Town">Orangi Town</option>
                                        <option value="Saddar Town">Saddar Town</option>
                                        <option value="Nazimabad Town">Nazimabad Town</option>
                                        <option value="ShahFaisal Town">Shah Faisal Town</option>
                                        <option value="SITE Town">SITE Town</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-2">
                                <div class="form-group">
                                    <p style="font-weight: bold">Fees From:</p>
                                    <input class="form-control" name="feesfrom" type="text" required
                                        style="outline: none; margin-top: -12px;" placeholder="1000 -/PKR">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <p style="font-weight: bold">Fees To:</p>
                                    <input class="form-control" name="feesto" type="text" required
                                        style="outline: none; margin-top: -12px;" placeholder="5000 -/PKR">
                                </div>
                            </div> -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="offset-sm-5">
                                <button type="submit" name="submit" class="btn btn-success"
                                    style="width:150px">Check</button>
                            </div>
                        </div>
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


    <!-- Selects Multiple Chilrens in dropdown -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
    </script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="../dist/js/jquery.serializejson.js"></script>

    <script>
    $(document).ready(function() {
        $('#institute').multiselect({
            nonSelectedText: 'Select Institute',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            includeSelectAllOption: true
        });
    });
    </script>


    <script>
    $("#instituteform").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        //jason serialised data start
        var data = $('#instituteform').serializeJSON();
        console.log("instituteform", data);
        console.log("instituteform", JSON.stringify(data));
        //jason serialised data end

        $.ajax({
            type: "POST",
            url: url,

            //jason serialised data start
            cache: false,
            data: JSON.stringify(data),
            contentType: "json",
            //jason serialised data end

            success: function(data) {
                console.log(data);

                var obj = JSON.parse(data);
                console.log(obj);
                count = 1;
                content = '';
                content +=
                    '<table class="table" id="myTable"><thead><tr><th>S.No</th><th>Profile</th><th>Name</th><th>Preffered Subjects</th><th>Qualification</th><th>Address</th><th>Age</th><th>Experience</th><th>Status</th></tr></thead>';
                content += '<tbody>';
                for (i = 0; i < obj.length; i++) {
                    content += '<tr>';
                    content += '<th>';
                    content += count++;
                    content += '</th>';
                    content += '<td>';
                    content += '<img class="img-circle" style="width:60px; height: 60px;" src="' +
                        obj[i].TutorImage + '">';
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].FullName;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].PreferredSubjects;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].Qualification;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].PresentAddress;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].Age;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].TotalExperience;
                    content += '</td>';
                    content += '<td>';
                    if (obj[i].Status == 'null' || obj[i].Status == 'Rejected') {
                        content +=
                            '<button class="btn btn-success requestDemo" type="button" value="' +
                            obj[i]
                            .Id + '">Request Demo</button>';
                    } else if (obj[i].Status == 'Pending') {
                        content +=
                            '<button class="btn btn-success requestDemo" type="button" value="' +
                            obj[i]
                            .Id + '" disabled>Demo Requested</button>';
                    } else if (obj[i].Status == 'Scheduled') {
                        content +=
                            '<button class="btn btn-success requestDemo" type="button" value="' +
                            obj[i]
                            .Id + '" disabled>Demo Scheduled</button>';
                    }
                    content += '</td>';
                    content += '</tr>';
                }
                content += '</tbody>';
                content += '</table>';
                $('#tutordata').html(content);
                $('#myTable').DataTable();

                // window.location.href = "index.php";
            }
        });
    });

    //request demo button 
    $(document).on('click', '.requestDemo', function() {
        var institutes = [];
        $("#institute > option:selected").each(function() {
            institutes.push(this.value);
        });

        var obj = {};
        obj.TeacherId = $(this).val();
        obj.Institutes = institutes;
        console.log(obj);
        $.ajax({
            type: "POST",
            url: "RequestDemo.php",
            cache: false,
            data: JSON.stringify(obj),
            contentType: "json",
            success: function(data) {
                console.log("requestdemodata", data);
                refreshTableBySubmittingForm(); //ye humne perdefine function name likha hai
            }
        });
    });


    //ye code isliye repeat ua ha coz hum refresh krwarhe ha jb requestdemo ke button pr click kr rhy ha to
    function refreshTableBySubmittingForm() {
        var form = $('#instituteform');
        var url = form.attr('action');

        //jason serialised data start
        var data = $('#instituteform').serializeJSON();
        console.log("instituteform", data);
        console.log("instituteform", JSON.stringify(data));
        //jason serialised data end

        $.ajax({
            type: "POST",
            url: url,

            //jason serialised data start
            cache: false,
            data: JSON.stringify(data),
            contentType: "json",
            //jason serialised data end

            success: function(data) {
                console.log(data);

                var obj = JSON.parse(data);
                console.log(obj);
                count = 1;
                content = '';
                content +=
                    '<table class="table" id="myTable"><thead><tr><th>S.No</th><th>Profile</th><th>Name</th><th>Preffered Subjects</th><th>Qualification</th><th>Address</th><th>Age</th><th>Experience</th><th>Status</th></tr></thead>';
                content += '<tbody>';
                for (i = 0; i < obj.length; i++) {
                    content += '<tr>';
                    content += '<th>';
                    content += count++;
                    content += '</th>';
                    content += '<td>';
                    content += '<img class="img-circle" style="width:60px; height: 60px;" src="' +
                        obj[i].TutorImage + '">';
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].FullName;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].PreferredSubjects;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].Qualification;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].PresentAddress;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].Age;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].TotalExperience;
                    content += '</td>';
                    content += '<td>';
                    if (obj[i].Status == 'null' || obj[i].Status == 'Rejected') {
                        content +=
                            '<button class="btn btn-success requestDemo" type="button" value="' +
                            obj[i]
                            .Id + '">Request Demo</button>';
                    } else if (obj[i].Status == 'Pending') {
                        content +=
                            '<button class="btn btn-success requestDemo" type="button" value="' +
                            obj[i]
                            .Id + '" disabled>Demo Requested</button>';
                    } else if (obj[i].Status == 'Scheduled') {
                        content +=
                            '<button class="btn btn-success requestDemo" type="button" value="' +
                            obj[i]
                            .Id + '" disabled>Demo Scheduled</button>';
                    }
                    content += '</td>';
                    content += '</tr>';
                }
                content += '</tbody>';
                content += '</table>';
                $('#tutordata').html(content);
                $('#myTable').DataTable();

                // window.location.href = "index.php";
            }
        });
    }
    </script>

</html>