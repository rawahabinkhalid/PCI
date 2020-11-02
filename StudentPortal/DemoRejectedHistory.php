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

    <title>Student Panel | Demo Rejected History</title>

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
                            <h1 class="m-0 text-dark text-center"><b><u>Demo Rejected History</u></b></h1>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <!-- <h1 class="m-0 text-dark"><u>Search Tutors</u></h1> -->
                        </div><!-- /.col -->
                        <div class="col-sm-6 mt-3">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Demo Rejected History</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th scope="col"><b>S.No</b></th>
                                <th scope="col"><b>Student Name</b></th>
                                <th scope="col"><b>Teacher Name</b></th>
                                <th scope="col"><b>Rejected Date</b></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_table">
                            <?php
                                // $count = 1;
                                // $sql = 'SELECT requestdemo_studentside.*, StudentName, FullName FROM requestdemo_studentside JOIN studenttutorform ON requestdemo_studentside.Student_Id = studenttutorform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_studentside.TeacherId WHERE requestdemo_studentside.Status = "Rejected" ';
                                // // echo $sql;
                                // $result = mysqli_query($conn, $sql);
                                // if(mysqli_num_rows($result) > 0 ){
                                //     while($row = mysqli_fetch_assoc($result)){
                                //         echo'
                                //         <tr>
                                //             <td>'.$count++.'</td>
                                //             <td>'.$row['StudentName'].'</td>
                                //             <td>'.$row['FullName'].'</td>
                                //             <td>'.$row['DefultDateTime'].'</td>
                                //         </tr>
                                //         ';
                                //     }
                                // }
                            ?>
                        </tbody>
                        <tfoot id="">

                        </tfoot>
                    </table>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <br><br><br>
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

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: 'DemoRejectedHistoryApi.php',
            success: function(data) {
                console.log(data);

                var obj_master = JSON.parse(data);
                obj = obj_master.data;
                console.log(obj);
                count = 1;
                content = '';
                for (i = 0; i < obj.length; i++) {
                    content += '<tr>';
                    content += '<td>';
                    content += count++;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].StudentName;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].FullName;
                    content += '</td>';
                    content += '<td>';
                    content += obj[i].DefultDateTime;
                    content += '</td>';
                    content += '</tr>';
                }
                $('#tbody_table').html(content);
                $('.table').DataTable();
            }
        });

    });
    </script>

</html>