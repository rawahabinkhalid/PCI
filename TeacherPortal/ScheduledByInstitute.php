<?php 
include_once('../conn.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e

    $obj = new \StdClass;
       
    if($jsonObj['Type'] == 'Teacher'){
        $sql1 = 'SELECT requestdemo_instituteside.Id, StatusByInstitute, instituteregistrationform.InstituteName, instituteregistrationform.ContactNo1, instituteregistrationform.Email AS Ins_Email , tutorform_section1.FullName, tutorform_section1.PhoneNo1, tutorform_section1.Email, tutorform_section1.TutorImage, ScheduledDateByAdmin FROM requestdemo_instituteside JOIN tutorform_section1 ON requestdemo_instituteside.TeacherId = tutorform_section1.Id JOIN instituteregistrationform ON instituteregistrationform.Id = requestdemo_instituteside.Institute_Id WHERE requestdemo_instituteside.`Status` = "Scheduled" AND requestdemo_instituteside.`Id` = '.$jsonObj['ScheduledId'].' '; 
        $result = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $classes = $jsonObj['Classes'];
            $subjects = $jsonObj['Subjects'];
            $startingdate = $jsonObj['TuitionStartDate'];
            $fees = $jsonObj['Fees'];
            $daysoftution = $jsonObj['DaysOfTuition'];
            $rejectby = $jsonObj['RejectedBy'];
            $description = $jsonObj['Description'];

            $sql = 'INSERT INTO demostatus (`DemoId`,`DemoInstituteId`,`Type`,`Student_Confirm`,`Classes`,`Subjects`,`StartingDate`,`Fees`,`DaysOfTution`,`RejectedBy`,`Description`,`Status`) VALUES ("'.$jsonObj['ScheduledId'].'","'.$jsonObj['ScheduledId'].'","Teacher","0","'.$classes.'","'.$subjects.'","'.$startingdate.'","'.$fees.'","'.$daysoftution.'","'.$rejectby.'","'.$description.'","'.$jsonObj['Status'].'")';
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE requestdemo_instituteside SET `StatusByTeacher`='".$jsonObj['Status']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
            if($row['StatusByInstitute'] == 'Confirmed' && ($row['Status'] == 'Confirmed' || $row['Status'] == 'Scheduled')) {
            // if($row['StatusByTeacher'] == 'Confirmed') {
                $sql = "UPDATE requestdemo_instituteside SET `Status`='".$jsonObj['Status']."', `StatusByTeacher`='".$jsonObj['Status']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
            } else if ($row['StatusByInstitute'] == 'Rejected' || $jsonObj['Status'] == 'Rejected') {
                $sql = "UPDATE requestdemo_instituteside SET `Status`='Rejected', `StatusByTeacher`='".$jsonObj['Status']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
            }
            if(mysqli_query($conn, $sql)) {
                $obj->message = 'Successfully saved';
            } else {
                $obj->message = $conn->error;
            }
            
        } else {
            $obj->message = $conn->error;
        }
        // echo $result;
    }
    echo json_encode($obj);

}
?>