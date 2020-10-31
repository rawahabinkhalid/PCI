<?php
include_once('../conn.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    session_start();
    
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phonenumber'];
    $password = $_POST['password'];
    $instituteid = null;

        if(isset($_POST['fullname'])){
            $sql = "INSERT INTO signupinstitute (`FullName`,`Email`,`PhoneNumber`,`Password`) VALUES ('".$fullname."','".$email."','".$phoneno."','".$password."')";
            mysqli_query($conn, $sql);
            $instituteid = mysqli_insert_id($conn);
            
            if(isset($_POST['fullname'])){
                $sql1 = "INSERT INTO userroles (`UserId`,`Status`,`Email`,`PhoneNumber`,`Password`) VALUES ('".$instituteid."','Institute','".$email."','".$phoneno."','".$password."')";
                mysqli_query($conn, $sql1);
                // header("Location: ../InstitutePortal/index.php");
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
    $jsonObj->instituteid = $instituteid;
    echo json_encode($jsonObj);
}
?>