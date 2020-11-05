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

$sqlDelete = 'DELETE FROM tutorform_section1 WHERE TeacherId = ' . $userid;
if(mysqli_query($conn, $sqlDelete)) {

    ///////////////////////// Section 1 Personal Information ///////////////////////////
    // $Regno = $jsonObj['Regno'];
    // $secretcode = $jsonObj['secretcode'];
    $tutorcategory = $jsonObj['tutorcategory'];

    $tutorimage = $jsonObj['tutorimageBase64'];
    // $tutorimage = $_FILES['tutorimage']['name'];

    // $tutordocuments = $jsonObj['uploaddocument'];
    // $tutordocuments = $_FILES['uploaddocument']['name'];

    $teacherbyprofession = $jsonObj['teacherbyprofession'];
    $yesthenwhere = $jsonObj['yesthenwhere'];
    $experienceinyears = $jsonObj['experienceinyears'];
    $fullname = $jsonObj['fullname'];
    $fathusname = $jsonObj['fathusname'];
    $mothnametounge = $jsonObj['mothnametounge'];
    $gender = $jsonObj['gender'];
    $dob = $jsonObj['dob'];
    $age = $jsonObj['age'];
    $nationality = $jsonObj['nationality'];
    $religion = $jsonObj['religion'];
    $cnicno = $jsonObj['cnicno'];
    $presentadd = $jsonObj['presentadd'];
    $permanentadd = $jsonObj['permanentadd'];
    $phoneno1 = $jsonObj['phoneno1'];
    $phoneno2 = $jsonObj['phoneno2'];
    $phoneno3 = $jsonObj['phoneno3'];
    $fbid = $jsonObj['fbid'];
    $email = $jsonObj['email'];
    $personalconveyance = $jsonObj['personalconveyance'];
    $carbike = $jsonObj['carbike'];
    $dateofsubmission = $jsonObj['dateofsubmission'];


    $formStatus = null;
    if(isset($jsonObj['formStatus'])) {
        $formStatus = $jsonObj['formStatus'];
    }

    $sqlDelete1 = "DELETE FROM tutorform_section1 WHERE `TeacherId` = ".$userid."";
    $conn->query($sqlDelete1);
    $sqlDelete2 = "DELETE FROM tutorform_section2 WHERE `UserId` = ".$userid."";
    $conn->query($sqlDelete2);
    $sqlDelete3 = "DELETE FROM tutorform_section3 WHERE `UserId` = ".$userid."";
    $conn->query($sqlDelete3);
    $sqlDelete4 = "DELETE FROM tutorform_section4 WHERE `UserId` = ".$userid."";
    $conn->query($sqlDelete4);
    $sqlDelete5 = "DELETE FROM tutorform_section4_locations WHERE `UserId` = ".$userid."";
    $conn->query($sqlDelete5);
    $sqlDelete6 = "DELETE FROM tutorform_section5 WHERE `UserId` = ".$userid."";
    $conn->query($sqlDelete6);
    $sqlDelete7 = "DELETE FROM tutorform_documents WHERE `TutorId` = ".$userid."";
    $conn->query($sqlDelete7);
    
    $sql = "INSERT INTO tutorform_section1 (`Id`, `TeacherId`,`TutorCategory`,`TutorImage`,`TeacherByProfession`,`YesThenWhere`,`TotalExperience`,
                        `FullName`,`FatherHusbandName`,`MotherNameTounge`,`Gender`,`DateOfBirth`,`Age`,`Nationality`,
                        `Religion`,`CnicNo`,`PresentAddress`,`PermanentAddress`,`PhoneNo1`,`PhoneNo2`,`PhoneNo3`,
                        `FacebookId`,`Email`,`FormStatus`,`PersonalConveyance`,`YesThenCarBike`,`DateOfFormSubmission`, `Status`)
                        VALUES ('".$userid."','".$userid."','".$tutorcategory."','".$tutorimage."','".$teacherbyprofession."','".$yesthenwhere."', '".$experienceinyears."',
                                '".$fullname."','".$fathusname."','".$mothnametounge."','".$gender."','".$dob."','".$age."','".$nationality."',
                                '".$religion."','".$cnicno."','".$presentadd."','".$permanentadd."','".$phoneno1."','".$phoneno2."','".$phoneno3."',
                                '".$fbid."','".$email."','".$formStatus."','".$personalconveyance."','".$carbike."','".$dateofsubmission."', 'Pending')";
    }

    if($conn->query($sql))
    {   
        $userid = mysqli_insert_id($conn);
        for($i = 0; $i < count($jsonObj['documents']); $i++) {
            $sql1 = "INSERT INTO tutorform_documents (`TutorDocuments`,`TutorId`)
                                VALUES ('".$jsonObj['documents'][$i]."', ".$userid.")";

            if($conn->query($sql1))
            {   
            }

        }

    }
    else
    {
        $userid = null;
        // echo $sql;
        echo 'Error! Try Again';
        // mysqli_close($conn);
    }


    ///////////////////////// Section 2 Qualification ///////////////////////////

    // $qualification = $_POST['qualification'];
    // $subspec = $_POST['subspec'];
    // $insuni = $_POST['insuni'];
    // $passingyear = $_POST['passingyear'];
    // $gradedivision = $_POST['gradedivision'];

    for($i = 0; $i < sizeof($jsonObj['qualification']); $i++){
    $sql1 = "INSERT INTO tutorform_section2 (`Qualification`,`SubjectSpecialization`,`InstituteUniversity`,`YearOfPassing`,`gradedivision`,`UserId`)
            VALUES ('".$jsonObj['qualification'][$i]."','".$jsonObj['subspec'][$i]."','".$jsonObj['insuni'][$i]."','".$jsonObj['passingyear'][$i]."','".$jsonObj['gradedivision'][$i]."','".$userid."')";
        if($conn->query($sql1)) 
            {    
                // echo "success sql1";
            } else
            {  
                // echo $sql1;
                echo 'Error! Try Again';
                // mysqli_close($conn);
            }
    }


    ///////////////////////// Section 3 Job Experience ///////////////////////////

    // $jobtitle = $_POST['jobtitle'];
    // $orgname = $_POST['orgname'];
    // $from = $_POST['fromto'];
    // $till = $_POST['till'];

    for($i = 0; $i < sizeof($jsonObj['jobtitle']); $i++){
    $sql2 = "INSERT INTO tutorform_section3 (`JobEntitlement`,`OrganizationName`,`FromTo`,`Till`,`UserId`)
            VALUES ('".$jsonObj['jobtitle'][$i]."','".$jsonObj['orgname'][$i]."','".$jsonObj['fromto'][$i]."','".$jsonObj['till'][$i]."','".$userid."')";
        if($conn->query($sql2)) 
            {    
                // echo "success sql2";
            } else
            {  
                // echo $sql2;
                echo 'Error! Try Again';
                // mysqli_close($conn);
            }
    }


    ///////////////////////// Section 4 Area Of Interest ///////////////////////////

    // $classtoteach = $_POST['classtoteach'];
    // $prefsubject = $_POST['prefsubject'];
    // $prefarea = $_POST['prefarea'];

    for($i = 0; $i < sizeof($jsonObj['classtoteach']); $i++){
    $sql3 = "INSERT INTO tutorform_section4 (`ClassToTeach`,`PreferredSubjects`,`UserId`)
            VALUES ('".$jsonObj['classtoteach'][$i]."','".$jsonObj['prefsubject'][$i]."','".$userid."')";

        if($conn->query($sql3)) 
            {    
                // echo "success sql3";
                
            } else
            {  
                // echo $sql3;
                echo 'Error! Try Again';
                mysqli_close($conn);
            }
    }

    for($j = 0; $j<sizeof($jsonObj['prefarea']); $j++){
    $sql_prefarea = "INSERT INTO tutorform_section4_locations (`PreferredArea`,`UserId`) VALUES ('".$jsonObj['prefarea'][$j]."','".$userid."')";
    $result_prefarea = mysqli_query($conn, $sql_prefarea);
    }

    ///////////////////////// Section 5 Personal Reference ///////////////////////////

    $ref1Name = $jsonObj['ref1Name'];
    $ref1Relation = $jsonObj['ref1Relation'];
    $ref1Occupation = $jsonObj['ref1Occupation'];
    $ref1TelephoneNo = $jsonObj['ref1TelephoneNo'];
    $ref1Address = $jsonObj['ref1Address'];

    $ref2Name = $jsonObj['ref2Name'];
    $ref2Relation = $jsonObj['ref2Relation'];
    $ref2Occupation = $jsonObj['ref2Occupation'];
    $ref2TelephoneNo = $jsonObj['ref2TelephoneNo'];
    $ref2Address = $jsonObj['ref2Address'];

    $sql4 = "INSERT INTO tutorform_section5 (`Name`,`Relation`,`Occupation`,`TelephoneNo`,`Address`,`UserId`)
            VALUES ('".$ref1Name."','".$ref1Relation."','".$ref1Occupation."','".$ref1TelephoneNo."','".$ref1Address."','".$userid."')";

        if($conn->query($sql4)) 
            {    
                // echo "success sql4";
            } else
            {  
                echo $sql4;
                echo 'Error! Try Again';
                mysqli_close($conn);
            }

    $sql5 = "INSERT INTO tutorform_section5 (`Name`,`Relation`,`Occupation`,`TelephoneNo`,`Address`,`UserId`)
            VALUES ('".$ref2Name."','".$ref2Relation."','".$ref2Occupation."','".$ref2TelephoneNo."','".$ref2Address."','".$userid."')";

        if($conn->query($sql5)) 
            {    
                // echo "success sql5";
            } else
            {  
                echo $sql5;
                echo 'Error! Try Again';
                mysqli_close($conn);
            }
            // header("Location: tutorform.php");

        $jsonObj = (object) [];
        $jsonObj->userid = $userid;
        echo json_encode($jsonObj);
    } 

?>