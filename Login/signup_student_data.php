<?php
include_once('../conn.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    session_start();

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phonenumber'];
    $password = $_POST['password'];
    $studentid = null;

        if(isset($_POST['fullname'])){
            $sql = "INSERT INTO signupstudent (`FullName`,`Email`,`PhoneNumber`,`Password`) VALUES ('".$fullname."','".$email."','".$phoneno."','".$password."')";
            mysqli_query($conn, $sql);
            $studentid = mysqli_insert_id($conn);
            
            if(isset($_POST['fullname'])){
                    $sql1 = "INSERT INTO userroles (`UserId`,`Status`,`Email`,`PhoneNumber`,`Password`) VALUES ('".$studentid."','Student','".$email."','".$phoneno."','".$password."')";
                mysqli_query($conn, $sql1);
                // header("Location: ../StudentPortal/index.php");
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
    $jsonObj->studentid = $studentid;
    echo json_encode($jsonObj);
}
?>