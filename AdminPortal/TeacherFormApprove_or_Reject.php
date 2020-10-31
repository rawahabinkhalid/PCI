<?php
include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {

    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    if(isset($_GET['id1'])){
         $sql = 'UPDATE tutorform_section1 SET `Status` = "Approved" WHERE `Id`='.$_GET['id1'];
        $result = mysqli_query($conn,$sql);
        // echo $sql;
    }

    else if (isset($_GET['id2'])){
       $sql = 'UPDATE tutorform_section1 SET `Status` = "Rejected" WHERE `Id`='.$_GET['id2'];
        $result = mysqli_query($conn,$sql);
        // echo $sql;
    }
    

    // echo json_encode($);

}

?>