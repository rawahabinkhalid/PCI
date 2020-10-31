<?php
include_once("../conn.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e

    
    $obj = new \StdClass;
    if($jsonObj['Type'] == 'Student') {
        $sql = "INSERT INTO requestdemo_teacherside (`TeacherId`,`Student_Id`) VALUES (".$jsonObj['TeacherId'].", ".$jsonObj['Id'].")";
        if($conn->query($sql)) {
            $obj->message = 'Successfully saved';
        } else {
            $obj->message = $conn->error;
        }
    } else if ($jsonObj['Type'] == 'Institute') {
        $sql = "INSERT INTO requestdemo_teacherside (`TeacherId`,`Institute_Id`,`JobId`) VALUES (".$jsonObj['TeacherId'].", ".$jsonObj['Id'].", ".$jsonObj['JobId'].")";
        if($conn->query($sql)) {
            $obj->message = 'Successfully saved';
        } else {
            $obj->message = $conn->error;
        }
    }

    echo json_encode($obj);
}

?>