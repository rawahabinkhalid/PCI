<?php

//Ye file qadir bhai ke liye bnayi ha unhy data get krne ke liye .. Me ye data select ki 
//query hardcode krke hi kr rha hun jese normal krty ha ..

include_once('../conn.php');

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
//jason s
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);
//jason e

if(isset($jsonObj["userid"])) {
    $userid = $jsonObj['userid'];
} else {
    $userid = $_SESSION['userid'];
}

    $data = [];

    $sql = "SELECT * FROM instituteregistrationform WHERE `UserId` = ".$userid;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
        // echo '<option value="'.$row['Id'].'">'.$row['InstituteName'].'</option>';
    }

    echo json_encode($data);
}

?>