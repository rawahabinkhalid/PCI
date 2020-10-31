<?php
include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {

    // $studenttutorformId = null;


    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    
    $data = [];    
    $status = 'null';
    for($i=0;$i<sizeof($jsonObj['searchinstitute']);$i++){
        
         $instituteId = $jsonObj['searchinstitute'][$i];
        //  echo $instituteId;
         $sql = 'SELECT * FROM instituteregistrationform JOIN instituteregistrationjobs ON instituteregistrationform.Id = instituteregistrationjobs.Instituteregform_Id WHERE instituteregistrationform.Id ='.$instituteId;
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
             $area = $jsonObj['locationarea'];
             $class = $row['Class'];
         }
         $sqlSelectTutor = 'SELECT * FROM  tutorform_section1 JOIN tutorform_section4 ON tutorform_section1.Id = tutorform_section4.UserId  JOIN tutorform_section2 ON tutorform_section2.UserId = tutorform_section1.Id JOIN tutorform_section4_locations ON tutorform_section4_locations.UserId = tutorform_section1.Id WHERE PreferredArea ="'.$area.'" AND ClassToTeach = "'.$class.'" AND (TutorCategory ="Teaching Job" OR TutorCategory ="Both")';
        //  echo $sqlSelectTutor;   
         $resultTutor = mysqli_query($conn, $sqlSelectTutor);
             while($row1 = mysqli_fetch_assoc($resultTutor)){
                 $status = 'null';
                 $sql1 = 'SELECT * FROM requestdemo_instituteside WHERE TeacherId = ' . $row1['TeacherId'] . ' AND Institute_Id = ' . $instituteId . ' ORDER BY DefultDateTime DESC';
                 $result1 = mysqli_query($conn, $sql1);
                 if($result1->num_rows > 0) {
                     $rowStatus = $result1->fetch_assoc();
                     $status = $rowStatus['Status'];
                 }
                $row1['Status'] = $status;
                $row1['Id'] = $row1['TeacherId'];
                $data[] = $row1;
             }

    }
    echo json_encode($data);

    // $jsonObj = (object) [];
    // $jsonObj->studenttutorformId = $studenttutorformId;
    // echo json_encode($jsonObj);
}


?>