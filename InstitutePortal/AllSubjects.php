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

$data = [];
$sql = 'SELECT * FROM `all_subjects`';
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_Assoc($result)){
        // echo '<option value="'.$row['Id'].'">'.$row['Subjects'].' </option>        
        // ';
        $data[] = $row;
}

    $jsonObj = (object) [];
    $jsonObj->data = $data;
    echo json_encode($jsonObj);
}
?>