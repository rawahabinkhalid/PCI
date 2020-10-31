<?php

include_once('../conn.php');

session_start();

if($_SERVER['REQUEST_METHOD']=='POST') {

//jason s
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);
//jason e
    
$nameofInstitute = $jsonObj['nameofInstitute'];
$typeofInstitute = $jsonObj['typeofInstitute'];
$othersinstitute = $jsonObj['othersinstitute'];
$email = $jsonObj['email'];
$contactperson  = $jsonObj['contactperson'];
$contactno1 = $jsonObj['contactno1'];
$contactno2 = $jsonObj['contactno2'];
$contactno3 = $jsonObj['contactno3'];
// $class = $_POST['class'];
// $subjects = $_POST['subjects'];
$othersubject = $jsonObj['othersubjects'];

$address = $jsonObj['address'];
$streetnum = $jsonObj['streetnum'];
$blocknum = $jsonObj['blocknum'];
$area = $jsonObj['area'];
$city = $jsonObj['city'];
$country = $jsonObj['country'];
$gender = $jsonObj['gender'];
$timing = $jsonObj['timing'];
$salaryfrom = $jsonObj['salaryfrom'];
$salaryto = $jsonObj['salaryto'];

$formStatus = null;
if(isset($jsonObj['formStatus'])) {
    $formStatus = $jsonObj['formStatus'];
}

if(isset($jsonObj["userid"])) {
    $userid = $jsonObj['userid'];
} else {
    $userid = $_SESSION['userid'];
}

$instituteformId = null;
$sql_temp = null;

if($formStatus == null) {
$sqlDelete = "DELETE FROM instituteregistrationform WHERE `UserId` = ".$userid . " AND FormStatus = 'Draft'";
$conn->query($sqlDelete);
$sql = "INSERT INTO instituteregistrationform (`UserId`,`InstituteName`,`TypeOfInstitute`,`IfInstituteOther`,`Email`,`ContactPerson`,`ContactNo1`,`ContactNo2`,`ContactNo3`,
                                      `IfOtherSubjects`,`Address`,`StreetNum`,`BlockNum`,
                                      `Area`,`City`,`Country`,`Gender`,`Timings`,`SalaryFrom`,`SalaryTo`)
        VALUES ('".$userid."','".$nameofInstitute."','".$typeofInstitute."','".$othersinstitute."','".$email."','".$contactperson."','".$contactno1."','".$contactno2."','".$contactno3."',
                '".$othersubject."','".$address."','".$streetnum."','".$blocknum."',
                '".$area."','".$city."','".$country."','".$gender."','".$timing."','".$salaryfrom."','".$salaryto."')";
} else {
$sqlDelete = "DELETE FROM instituteregistrationform WHERE `UserId` = ".$userid . " AND FormStatus = 'Draft'";
$conn->query($sqlDelete);
$sql = "INSERT INTO instituteregistrationform (`UserId`,`InstituteName`,`TypeOfInstitute`,`IfInstituteOther`,`Email`,`ContactPerson`,`ContactNo1`,`ContactNo2`,`ContactNo3`,
                                      `IfOtherSubjects`,`Address`,`StreetNum`,`BlockNum`,
                                      `Area`,`City`,`Country`,`Gender`,`Timings`,`SalaryFrom`,`SalaryTo`,`FormStatus`)
        VALUES ('".$userid."','".$nameofInstitute."','".$typeofInstitute."','".$othersinstitute."','".$email."','".$contactperson."','".$contactno1."','".$contactno2."','".$contactno3."',
                '".$othersubject."','".$address."','".$streetnum."','".$blocknum."',
                '".$area."','".$city."','".$country."','".$gender."','".$timing."','".$salaryfrom."','".$salaryto."','".$formStatus."')";
}
     $sql_temp = $sql;   
    if($conn->query($sql)) {
        // echo "success sql";
    } 
    else {  
        // echo $sql;
        // echo 'Error! Try Again';
        // echo $conn->error;
        // mysqli_close($conn);
    }

    
    for($i = 0; $i < sizeof($jsonObj['class']); $i++){

    $instituteformId = mysqli_insert_id($conn); 
        
        for($j = 0; $j<sizeof($jsonObj['subjects']); $j++){
        $sql1 = "INSERT INTO instituteregistrationjobs (`Instituteregform_Id`,`UserId`,`Class`,`Subjects`) VALUES ('".$instituteformId."','".$userid."','".$jsonObj['class'][$i]."','".$jsonObj['subjects'][$j]."')";
        $result1 = mysqli_query($conn, $sql1);
        }

            // echo $sql1;
            // echo $conn->error;
            // mysqli_close($conn);
    } 

    //    header("Location: index.php");  

    $jsonObj_Resp = (object) [];
    $jsonObj_Resp->instituteformId = $instituteformId;
    $jsonObj_Resp->sql_temp = $sql_temp;
    echo json_encode($jsonObj_Resp);
}  
?>