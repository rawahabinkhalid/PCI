<?php
include_once("../conn.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e

    
    $obj = new \StdClass;
    for($i = 0; $i < count($jsonObj['Institutes']); $i++) {
        $sql = "INSERT INTO requestdemo_instituteside (`TeacherId`,`Institute_Id`) VALUES (".$jsonObj['TeacherId'].", ".$jsonObj['Institutes'][$i].")";
        if($conn->query($sql)) {

        } else {
            $obj->message = $conn->error;
        }
    }
    if (!isset($obj->message)) {
        $obj->message = 'Successfully saved';
    }

    echo json_encode($obj);
}

?>