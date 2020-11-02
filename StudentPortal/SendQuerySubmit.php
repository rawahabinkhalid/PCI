<?php
include_once('../conn.php');

session_start();

if($_SERVER['REQUEST_METHOD']=='POST') {

    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e
    
    
    if(isset($jsonObj["userid"])) {
        $userid = $jsonObj['userid'];
    } else {
        $userid = $_SESSION['userid'];
    }

    $sql = 'INSERT INTO QueryStudent (`UserId`, `Description`) VALUES ("'.$userid.'", "'.$_POST['querydescription'].'") ';
    $result = mysqli_query($conn, $sql);

        if($result){
            // echo '<script>alert("Query has been Submitted Successfully");window.open("SendQuery.php", "_self");</script>';
        }
        else{
            echo $sql;
        }


    // $jsonObj->userid = $userid;
    // echo json_encode($jsonObj);
}
?>