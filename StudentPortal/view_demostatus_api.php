<?php
include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {

    // $studenttutorformId = null;


    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    $sql = 'SELECT * FROM studenttutorform WHERE Id = ' . $jsonObj['StudentId'];
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $subjects = [];
        $sql1 = 'SELECT * FROM studenttutorsubjects WHERE studenttutorform_id = ' . $row['Id'];
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $subjects[] = $row1['Subjects'];
            }
        }
        $row['Subjects'] = implode(', ', $subjects);

        $studenttutordesiredtimings = [];
        $sql2 = 'SELECT * FROM studenttutordesiredtimings WHERE studenttutorform_id = ' . $row['Id'];
        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $studenttutordesiredtimings[] = $row2['DesiredTimings'];
            }
        }
        $row['DesiredTiming'] = implode(', ', $studenttutordesiredtimings);



        // $data = $row;
    }

    // Demo Requested
    $sql = 'SELECT COUNT(Status) FROM requestdemo_studentside WHERE `Status` = "Pending" AND `Student_Id` = "'.$jsonObj['StudentId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_requested = $row['COUNT(Status)'];

    // Demo Scheduled
    $sql = 'SELECT COUNT(Status) AS Count_Status FROM requestdemo_studentside WHERE `Status` = "Scheduled" AND `Student_Id` = "'.$jsonObj['StudentId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_scheduled = $row['Count_Status'];

    // Confirm Tutions
    $sql = 'SELECT COUNT(demostatus.Status) FROM requestdemo_studentside LEFT JOIN demostatus ON requestdemo_studentside.Id = demostatus.DemoId WHERE demostatus.`Status` = "Confirmed" AND `Student_Id` = "'.$jsonObj['StudentId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_confirmtution = $row['COUNT(demostatus.Status)'];

    // Rejected Tutions
    $sql = 'SELECT COUNT(*) AS Count_Status FROM requestdemo_studentside LEFT JOIN demostatus ON requestdemo_studentside.Id = demostatus.DemoId WHERE (demostatus.`Status` = "Rejected" OR (demostatus.`Status` IS NULL AND requestdemo_studentside.`Status` = "Rejected")) AND `Student_Id` = "'.$jsonObj['StudentId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_rejected = $row['Count_Status'];
    
    
    echo json_encode($data);

    // $jsonObj = (object) [];
    // $jsonObj->studenttutorformId = $studenttutorformId;
    // echo json_encode($jsonObj);
}


?>