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
                            <h1 class="m-0 demo text-bold">TEACHERS PROFILE</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" style="color:#007bff">Home</a></li>
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
                        <div class="col-lg-5 offset-lg-4">
                            <br>
                            <h2><b>All Teachers Record</b></h2>
                        </div>

                        <?php
                        $count = 1;
                                
                        $sql = "SELECT * FROM tutorform_section1";
                        $result = mysqli_query($conn,$sql);

                        echo'
                        <table class="table table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Preferred Classes</th>
                                <th scope="col">Teacher Email</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Profile</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>';
                                
                        while($row = mysqli_fetch_assoc($result)){
                            $sql1 = "SELECT * FROM tutorform_section4 WHERE UserId = ".$row['Id'];
                            $result1 = mysqli_query($conn,$sql1);
                            echo '
                        <div class="col-lg-12">
        
                            <tbody>
                                <tr>
                                    <th scope="row">'.$count++.'</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>'.$row['FullName'].'</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">';
                                                while( $row1 = mysqli_fetch_assoc($result1)){
                                                    echo '<p>'.$row1['ClassToTeach'].'</p>';
                                                    }
                                    echo'   </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>'.$row['Email'].'</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>'.$row['PhoneNo1'].'</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="btn btn-primary"><a href="ViewTeachersProfile.php?id='.$row['Id'].' ">
                                                    View Profile</a></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12" id="statusRow'.$row['Id'].'">';    
                                            if($row['Status']=="Pending"){
                                                  echo'<button class="btn btn-success ApproveForm" value="'.$row['Id'].'">Approve</button>';
                                                  echo'<button class="btn btn-danger RejectForm" value="'.$row['Id'].'">Reject</button>';
                                            } else {
                                                echo'<button class="btn btn-info" disabled >'.$row['Status'].'</button>';
                                            }
                                            echo'</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </div>';
                        }
                        echo '</table>';
                        ?>
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
                    Solutions
                    Pvt
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


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>


<script>
$('.ApproveForm').on('click', function() {
    var ApprovedFormId = $(this).val();
    // alert(ApprovedFormId);

    $.ajax({
        type: 'POST',
        url: 'TeacherFormApprove_or_Reject.php?id1=' + ApprovedFormId,
        success: function(data) {
            // alert(data);
            $('#statusRow' + ApprovedFormId).html(
                '<button class = "btn btn-info" disabled> Approved </button>');
        }
    });
})
</script>

<script>
$('.RejectForm').on('click', function() {
    var RejectFormId = $(this).val();
    // alert(RejectFormId);

    $.ajax({
        type: 'POST',
        url: 'TeacherFormApprove_or_Reject.php?id2=' + RejectFormId,
        success: function(data) {
            // alert(data);
            $('#statusRow' + RejectFormId).html(
                '<button class = "btn btn-info" disabled> Rejected </button>');
        }
    });
})
</script>