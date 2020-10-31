<?php
include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    $classes = [];
    $subjects = [];
    $sql1 = 'SELECT * FROM instituteregistrationjobs WHERE Id = ' . $jsonObj['InstituteId'];
    $result1 = $conn->query($sql1);
    if($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
            $subjects[] = $row1['Subjects'];
            $classes[] = $row1['Class'];
            $sql = 'SELECT * FROM instituteregistrationform WHERE Id = ' . $row1['Instituteregform_Id'];
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        }
        $row['Subjects'] = implode(', ', $subjects);
        $row['InstituteClass'] = implode(', ', $classes);

        // $data = $row;
    }
    

    // Demo Requested
    $sql = 'SELECT COUNT(Status) FROM requestdemo_instituteside WHERE `Status` = "Pending" AND `Institute_Id` = "'.$jsonObj['InstituteId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_requested = $row['COUNT(Status)'];

    // Demo Scheduled
    $sql = 'SELECT COUNT(Status) AS Count_Status FROM requestdemo_instituteside WHERE `Status` = "Scheduled" AND `Institute_Id` = "'.$jsonObj['InstituteId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_scheduled = $row['Count_Status'];

    // Confirm Tutions
    $sql = 'SELECT COUNT(demostatus.Status) FROM requestdemo_instituteside LEFT JOIN demostatus ON requestdemo_instituteside.Id = demostatus.DemoId WHERE demostatus.`Status` = "Confirmed" AND `Institute_Id` = "'.$jsonObj['InstituteId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_confirmtution = $row['COUNT(demostatus.Status)'];

    // Rejected Tutions
    $sql = 'SELECT COUNT(*) AS Count_Status FROM requestdemo_instituteside LEFT JOIN demostatus ON requestdemo_instituteside.Id = demostatus.DemoId WHERE (demostatus.`Status` = "Rejected" OR (demostatus.`Status` IS NULL AND requestdemo_instituteside.`Status` = "Rejected")) AND `Institute_Id` = "'. $jsonObj['InstituteId'].'" ';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data->demo_rejected = $row['Count_Status'];

    echo json_encode($data);

    // $jsonObj = (object) [];
    // $jsonObj->studenttutorformId = $studenttutorformId;
    // echo json_encode($jsonObj);
}


?>