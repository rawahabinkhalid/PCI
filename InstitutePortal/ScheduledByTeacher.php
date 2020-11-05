<?php 
include_once('../conn.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e

    $obj = new \StdClass;
       
    if($jsonObj['Type'] == 'Institute'){
        $sql1 = 'SELECT requestdemo_teacherside.Id AS Demo_Teacher_Id, instituteregistrationform.Email AS Ins_Email, tutorform_section1.Email, requestdemo_teacherside.*, instituteregistrationform.*, tutorform_section1.*  FROM requestdemo_teacherside JOIN instituteregistrationform ON requestdemo_teacherside.Institute_Id = instituteregistrationform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_teacherside.TeacherId WHERE requestdemo_teacherside.`Status` ="Scheduled" AND requestdemo_teacherside.`Id` = '.$jsonObj['ScheduledId'].' '; 
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

            $sql = 'INSERT INTO demostatus (`DemoId`,`DemoTeacherId`,`Type`,`Student_Confirm`,`Classes`,`Subjects`,`StartingDate`,`Fees`,`DaysOfTution`,`RejectedBy`,`Description`,`Status`) VALUES ("'.$jsonObj['ScheduledId'].'","'.$jsonObj['ScheduledId'].'","Institute","0","'.$classes.'","'.$subjects.'","'.$startingdate.'","'.$fees.'","'.$daysoftution.'","'.$rejectby.'","'.$description.'","'.$jsonObj['Status'].'")';
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE requestdemo_teacherside SET `StatusByInstitute`='".$jsonObj['Status']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
            if($row['StatusByTeacher'] == 'Confirmed' && ($row['Status'] == 'Confirmed' || $row['Status'] == 'Scheduled')) {
            // if($row['StatusByTeacher'] == 'Confirmed') {
                $sql = "UPDATE requestdemo_teacherside SET `Status`='".$jsonObj['Status']."', `StatusByInstitute`='".$jsonObj['Status']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
            } else if ($row['StatusByTeacher'] == 'Rejected' || $jsonObj['Status'] == 'Rejected') {
                $sql = "UPDATE requestdemo_teacherside SET `Status`='Rejected', `StatusByInstitute`='".$jsonObj['Status']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
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