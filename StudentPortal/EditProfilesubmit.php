<?php

include_once('../conn.php');

session_start();

if($_SERVER['REQUEST_METHOD']=='POST') {
    
//jason s
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);
//jason e

$studentname = $jsonObj['name'];
$fathername = $jsonObj['fathername'];
$studentemail = $jsonObj['email'];
$contactno1 = $jsonObj['contactno1'];
$contactno2 = $jsonObj['contactno2'];
$contactno3 = $jsonObj['contactno3'];
$class = $jsonObj['class'];
// $subjects = $_POST['subjects'];
$schoolcollege = $jsonObj['schoolcollege'];
$housenum = $jsonObj['housenum'];
$buildingname = $jsonObj['buildingname'];
$streetnum = $jsonObj['streetnum'];
$blocknum = $jsonObj['blocknum'];
$area = $jsonObj['area'];
$city = $jsonObj['city'];
$country = $jsonObj['country'];
$gender = $jsonObj['gender'];
// $desiredtiming = $_POST['desiredtiming'];

if(isset($jsonObj["userid"])) {
    $userid = $jsonObj['userid'];
} else {
    $userid = $_SESSION['userid'];
}

$studenttutorformId = $jsonObj['Id'];

$sql = 'UPDATE studenttutorform SET `UserId`="'.$userid.'",`StudentName`="'.$studentname.'",`FatherName`="'.$fathername.'",`StudentEmail`="'.$studentemail.'",`ContactNo1`="'.$contactno1.'",`ContactNo2`="'.$contactno2.'",`ContactNo3`="'.$contactno3.'",
                                      `Class`="'.$class.'",`SchoolCollege`="'.$schoolcollege.'",`HouseNumber`="'.$housenum.'",`BuildingName`="'.$buildingname.'",
                                      `StreetNumber`="'.$streetnum.'",`BlockNumber`="'.$blocknum.'",`Area`="'.$area.'",`City`="'.$city.'",`Country`="'.$country.'",`Gender`="'.$gender.'" WHERE Id = ' . $jsonObj['Id'];
    
    if($conn->query($sql)) {
        
        $sqldeletesub = 'DELETE FROM studenttutorsubjects WHERE studenttutorform_id = "'.$studenttutorformId.'" ';
        if($conn->query($sqldeletesub)){

            for($i = 0; $i<sizeof($jsonObj['subjects']); $i++){    
                $sql1 = "INSERT INTO studenttutorsubjects (`studenttutorform_id`,`Subjects`) VALUES ('".$studenttutorformId."','".$jsonObj['subjects'][$i]."')";
                $result1 = mysqli_query($conn, $sql1);
            }
        }
        
        $sqldeletetime = 'DELETE FROM studenttutordesiredtimings WHERE studenttutorform_id = "'.$studenttutorformId.'" ';
        if($conn->query($sqldeletetime)){
            for($j = 0; $j<sizeof($jsonObj['desiredtiming']); $j++){
                $sql2 = "INSERT INTO studenttutordesiredtimings (`studenttutorform_id`,`DesiredTimings`) VALUES ('".$studenttutorformId."','".$jsonObj['desiredtiming'][$j]."')";
                $result2 = mysqli_query($conn, $sql2);    
            }
        }
        // echo "success sql";
    } 
    else {  
        // echo $sql;
        // echo 'Error! Try Again';
        mysqli_close($conn);
    }

    $jsonObj = new \StdClass;
    $jsonObj->studenttutorformId = $studenttutorformId;
    echo json_encode($jsonObj);
}  
?>