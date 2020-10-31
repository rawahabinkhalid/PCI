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
$othersubjects = $jsonObj['othersubjects'];
$classyear = $jsonObj['classyear'];
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

$formStatus = null;
if(isset($jsonObj['formStatus'])) {
    $formStatus = $jsonObj['formStatus'];
}
// $desiredtiming = $_POST['desiredtiming'];

if(isset($jsonObj["userid"])) {
    $userid = $jsonObj['userid'];
} else {
    $userid = $_SESSION['userid'];
}

$studenttutorformId = null;
$sql_temp = null;

if($formStatus == null) {
$sqlDelete = "DELETE FROM studenttutorform WHERE `UserId` = ".$userid . " AND FormStatus = 'Draft'";
$conn->query($sqlDelete);
$sql = "INSERT INTO studenttutorform (`UserId`,`StudentName`,`FatherName`,`StudentEmail`,`ContactNo1`,`ContactNo2`,`ContactNo3`,
                                      `Class`,`IfOtherSubjects`,`SchoolCollege`,`ClassYear`,`HouseNumber`,`BuildingName`,
                                      `StreetNumber`,`BlockNumber`,`Area`,`City`,`Country`,`Gender`)
        VALUES ('".$userid."','".$studentname."','".$fathername."','".$studentemail."','".$contactno1."','".$contactno2."','".$contactno3."',
                '".$class."','".$othersubjects."','".$schoolcollege."','".$classyear."','".$housenum."','".$buildingname."',
                '".$streetnum."','".$blocknum."','".$area."','".$city."','".$country."','".$gender."')";

} else {
$sqlDelete = "DELETE FROM studenttutorform WHERE `UserId` = ".$userid . " AND FormStatus = 'Draft'";
$conn->query($sqlDelete);
$sql = "INSERT INTO studenttutorform (`UserId`,`StudentName`,`FatherName`,`StudentEmail`,`ContactNo1`,`ContactNo2`,`ContactNo3`,
                                      `Class`,`IfOtherSubjects`,`SchoolCollege`,`ClassYear`,`HouseNumber`,`BuildingName`,
                                      `StreetNumber`,`BlockNumber`,`Area`,`City`,`Country`,`Gender`,`FormStatus`)
        VALUES ('".$userid."','".$studentname."','".$fathername."','".$studentemail."','".$contactno1."','".$contactno2."','".$contactno3."',
                '".$class."','".$othersubjects."','".$schoolcollege."','".$classyear."','".$housenum."','".$buildingname."',
                '".$streetnum."','".$blocknum."','".$area."','".$city."','".$country."','".$gender."', '".$formStatus."')";
}
    $sql_temp = $sql;    
    if($conn->query($sql)) {
        
        $studenttutorformId = mysqli_insert_id($conn);  
          
        for($i = 0; $i<sizeof($jsonObj['subjects']); $i++){
        $sql1 = "INSERT INTO studenttutorsubjects (`studenttutorform_id`,`Subjects`) VALUES ('".$studenttutorformId."','".$jsonObj['subjects'][$i]."')";
        $result1 = mysqli_query($conn, $sql1);
        }
        
        for($j = 0; $j<sizeof($jsonObj['desiredtiming']); $j++){
        $sql2 = "INSERT INTO studenttutordesiredtimings (`studenttutorform_id`,`DesiredTimings`) VALUES ('".$studenttutorformId."','".$jsonObj['desiredtiming'][$j]."')";
        $result2 = mysqli_query($conn, $sql2);    
        }
        
        // echo "success sql";
    } 
    else {  
        // echo $sql;
        // echo 'Error! Try Again';
        // mysqli_close($conn);
    }
    // header("Location: index.php");

    $jsonObj_Resp = (object) [];
    $jsonObj_Resp->studenttutorformId = $studenttutorformId;
    $jsonObj_Resp->sql_temp = $sql_temp;
    echo json_encode($jsonObj_Resp);
}  
?>