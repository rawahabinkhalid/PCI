<?php 
include_once('../conn.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e

    if($jsonObj['Type'] == 'Student'){
    $sql = 'UPDATE requestdemo_studentside SET `Status`="Rejected" WHERE `Id` ='.$jsonObj['RejectId'];
    $result = mysqli_query($conn, $sql);
        if(!$result) {
            $obj->message = $conn->error;
        } else {
            $obj->message = 'Successfully saved';
        }
        
    } else if($jsonObj['Type'] == 'Institute'){
    $sql = 'UPDATE requestdemo_instituteside SET `Status`="Rejected" WHERE `Id` ='.$jsonObj['RejectId'];
    $result = mysqli_query($conn, $sql);
        if(!$result) {
            $obj->message = $conn->error;
        } else {
            $obj->message = 'Successfully saved';
        }
        
    } else if($jsonObj['Type'] == 'TeacherStudent'){
    $sql = 'UPDATE requestdemo_teacherside SET `Status`="Rejected" WHERE `Id` ='.$jsonObj['RejectId'];
    $result = mysqli_query($conn, $sql);
        if(!$result) {
            $obj->message = $conn->error;
        } else {
            $obj->message = 'Successfully saved';
        }
        
    } else if($jsonObj['Type'] == 'TeacherInstitute'){
    $sql = 'UPDATE requestdemo_teacherside SET `Status`="Rejected" WHERE `Id` ='.$jsonObj['RejectId'];
    $result = mysqli_query($conn, $sql);
        if(!$result) {
            $obj->message = $conn->error;
        } else {
            $obj->message = 'Successfully saved';
        }
        
    } 
    
    echo json_encode($obj);
}

?>