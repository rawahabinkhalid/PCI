<?php
include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {

    // $studenttutorformId = null;


    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    $sql = 'SELECT * FROM tutorform_section1 WHERE Id = ' . $jsonObj['TutorId'];
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $qualification = [];
        $sql1 = 'SELECT * FROM tutorform_section2 WHERE UserId = ' . $row['Id'];
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $qualification[] = $row1;
            }
        }
        $row['Qualification'] = $qualification;

        $experience = [];
        $sql1 = 'SELECT * FROM tutorform_section3 WHERE UserId = ' . $row['Id'];
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $experience[] = $row1;
            }
        }
        $row['Experience'] = $experience;

        $areaOfInterest = [];
        $sql1 = 'SELECT * FROM tutorform_section4 WHERE UserId = ' . $row['Id'];
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $areaOfInterest[] = $row1;
            }
        }
        $row['AreaOfInterest'] = $areaOfInterest;

        $references = [];
        $sql1 = 'SELECT * FROM tutorform_section5 WHERE UserId = ' . $row['Id'];
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $references[] = $row1;
            }
        }
        $row['References'] = $references;

        // $data = $row;
    }

    
    // Demo Requested
    $sql = 'SELECT COUNT(Status) FROM requestdemo_teacherside WHERE `Status` = "Pending" AND `TeacherId` = "'.$jsonObj['TutorId'].'" ';
    // $data->sql = $sql;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_requested = $row['COUNT(Status)'];

    // Demo Scheduled
    $sql = 'SELECT COUNT(Status) AS Count_Status FROM requestdemo_teacherside WHERE `Status` = "Scheduled" AND `TeacherId` = "'.$jsonObj['TutorId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_scheduled = $row['Count_Status'];

    // Confirm Tutions
    $sql = 'SELECT COUNT(demostatus.Status) FROM requestdemo_teacherside LEFT JOIN demostatus ON requestdemo_teacherside.Id = demostatus.DemoId WHERE demostatus.`Status` = "Confirmed" AND `TeacherId` = "'.$jsonObj['TutorId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_confirmtution = $row['COUNT(demostatus.Status)'];

    // Rejected Tutions
    $sql = 'SELECT COUNT(*) AS Count_Status FROM requestdemo_teacherside LEFT JOIN demostatus ON requestdemo_teacherside.Id = demostatus.DemoId WHERE (demostatus.`Status` = "Rejected" OR (demostatus.`Status` IS NULL AND requestdemo_teacherside.`Status` = "Rejected")) AND `TeacherId` = "'.$jsonObj['TutorId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_rejected = $row['Count_Status'];
 
    // Total Tutions Salary
    $sql = 'SELECT IFNULL(SUM(Fees), 0) AS SUM_Fees FROM requestdemo_teacherside LEFT JOIN demostatus ON requestdemo_teacherside.Id = demostatus.DemoId WHERE demostatus.`Status` = "Confirmed" AND `Type` = "Teacher" AND `TeacherId` = "'.$jsonObj['TutorId'].'"';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_totalsalary = $row['SUM_Fees'];


    echo json_encode($data);

    // $jsonObj = (object) [];
    // $jsonObj->studenttutorformId = $studenttutorformId;
    // echo json_encode($jsonObj);
}


?>