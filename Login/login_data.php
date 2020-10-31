<?php

include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {
    session_start();

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $userid = null;
    $userrole = null;
    $userfullname = null;

    $sql = "SELECT * FROM userroles WHERE (`Email` = '".$email."' OR PhoneNumber = '".$email."') AND BINARY `Password` = '".$pass."' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $userrole = $row['Status'];
        $userid = $row['UserId'];
        $_SESSION['userrole'] = $row['Status'];
        $_SESSION['userid'] = $row['UserId'];

        if($row['Status'] == "Institute") {
            $sql1 = "SELECT * FROM signupinstitute WHERE `Institute_Id` = ". $row['UserId'];
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $_SESSION['userfullname'] = $row1['FullName'];
            $userfullname = $row1['FullName'];
            // header("Location: ../InstitutePortal/index.php");

        } else if($row['Status'] == "Student") {
            $sql1 = "SELECT * FROM signupstudent WHERE `Student_Id` = ". $row['UserId'];
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $_SESSION['usefullname'] = $row1['FullName'];
            $userfullname = $row1['FullName'];
            // header("Location: ../StudentPortal/index.php");

        } else if($row['Status'] == "Teacher") {
            $sql1 = "SELECT * FROM signupteacher WHERE `Teacher_Id` = ". $row['UserId'];
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $_SESSION['usefullname'] = $row1['FullName'];
            $userfullname = $row1['FullName'];
            // header("Location: ../TeacherPortal/index.php");
        
        } else if($row['Status'] == "Admin") {
            $sql1 = "SELECT * FROM `admin` WHERE `Admin_Id` = ". $row['UserId'];
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $_SESSION['usefullname'] = $row1['FullName'];
            $userfullname = $row1['FullName'];
            // header("Location: ../AdminPortal/index.php");
        }  

    }
    else{
        // echo "No user exists";
    }
    $jsonObj = (object) [];
    $jsonObj->userid = $userid;
    $jsonObj->userrole = $userrole;
    $jsonObj->userfullname = $userfullname;
    echo json_encode($jsonObj);
}
?>