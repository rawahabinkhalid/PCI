<?php
include_once('../conn.php');
session_start();

if($_SERVER['REQUEST_METHOD']=='POST') {
    
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phonenumber'];
    $password = $_POST['password'];
    $teacherid = null;

        if(isset($_POST['fullname'])){
            $sql = "INSERT INTO signupteacher (`FullName`,`Email`,`PhoneNumber`,`Password`) VALUES ('".$fullname."','".$email."','".$phoneno."','".$password."')";
            mysqli_query($conn, $sql);
            $teacherid = mysqli_insert_id($conn);
            
            if(isset($_POST['fullname'])){
                    $sql1 = "INSERT INTO userroles (`UserId`,`Status`,`Email`,`PhoneNumber`,`Password`) VALUES ('".$teacherid."','Teacher','".$email."','".$phoneno."','".$password."')";
                mysqli_query($conn, $sql1);
                // header("Location: ../TeacherPortal/index.php");
            }
        }
        else {
            // echo 'Error Try Again!!';
        }
    // }
    // else{
    //     // echo "No user exists";
    // }
    $jsonObj = (object) [];
    $jsonObj->teacherid = $teacherid;
    echo json_encode($jsonObj);
}    
?>