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

    <link rel="stylesheet" href="https:////cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />

    <style>
    tr:hover {
        background-color: #BEE5EB;
    }

    .demo {
        background: linear-gradient(to right, #ffcccc 0%, #6666ff 100%);
    }

    a {
        text-decoration: none;
        color: #fff;
    }

    a:hover {
        color: #fff;
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
                            <h1 class="m-0 demo text-bold">STATUS OF CONFIRMED INSTITUTE</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" style="color:blue">Home</a></li>
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
                        <div class="col-lg-5 offset-lg-3">
                            <br>
                            <h2><b>All Confirmed Institute Status</b></h2>
                        </div>

                        <div class="col-lg-12">
                            <table class="table" id="myTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Institute Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Teacher Name</th>
                                        <th scope="col">Starting Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Change Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                            
                                $count = 1;    
                                $sql = 'SELECT * FROM demostatus WHERE `Status` = "Confirmed" ';
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                        $sqlGetName = 'SELECT tutorform_section1.TeacherId,tutorform_section1.FullName,instituteregistrationform.UserId,instituteregistrationform.InstituteName,instituteregistrationjobs.Class,requestdemo_instituteside.* FROM requestdemo_instituteside JOIN tutorform_section1 ON requestdemo_instituteside.TeacherId = tutorform_section1.Id JOIN instituteregistrationform ON instituteregistrationform.Id = requestdemo_instituteside.Institute_Id JOIN instituteregistrationjobs ON instituteregistrationjobs.Instituteregform_Id = instituteregistrationform.Id WHERE requestdemo_instituteside.Id = '.$row['DemoId'];
                                        $resultName = mysqli_query($conn, $sqlGetName);
                                        $row1 = mysqli_fetch_assoc($resultName);
                                    echo ' 
                                        <tr>
                                            <th scope="row">'.$count++.'</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p>'.$row1['InstituteName'].'</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p>'.$row1['Class'].'</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p>'.$row1['FullName'].'</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p>'.$row['StartingDate'].'</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p>'.$row['Status'].'</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p><button class="btn btn-primary" value="'.$row['DemoId'].'" id="ResetStatus">Status Reset</button></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
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

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
    //datatable work 
    $('#myTable').DataTable();
    </script>

    <!-- Reset Status For Student -->
    <script>
    $('#ResetStatus').on('click', function() {

        var id = $(this).val();
        // alert(id);
        $.ajax({
            type: 'POST',
            url: 'ResetStatus_Student.php?id=' + id,
            success: function(response) {
                alert("Status Has Been Changed Successfully !");
                location.reload();

            },
        });
    })
    </script>

</body>

</html>