<?php
include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {

    // $studenttutorformId = null;


    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    
    $data = [];    
    for($i=0;$i<sizeof($jsonObj['searchchildren']);$i++){
        
         $studentId = $jsonObj['searchchildren'][$i];
        //  echo $studentId;
         $sql = 'SELECT studenttutorform.*, Subjects FROM studenttutorform JOIN studenttutorsubjects ON studenttutorform.Id = studenttutorsubjects.studenttutorform_id WHERE studenttutorform.Id ='.$studentId;
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
             $area = $jsonObj['locationarea'];
             $class = $row['Class'];
         }
         $sqlSelectTutor = 'SELECT tutorform_section1.Id, PresentAddress, Age, TotalExperience, TutorCategory, FullName, PreferredSubjects, Email, PhoneNo1, TutorImage, Qualification FROM  tutorform_section4 JOIN tutorform_section1 ON tutorform_section1.Id = tutorform_section4.UserId JOIN tutorform_section2 ON tutorform_section2.UserId = tutorform_section1.Id JOIN tutorform_section4_locations ON tutorform_section4_locations.UserId = tutorform_section1.Id WHERE PreferredArea ="'.$area.'" AND ClassToTeach = "'.$class.'" AND (TutorCategory ="Home Tution" OR TutorCategory ="Both")';
        //  echo $sqlSelectTutor;   
         $resultTutor = mysqli_query($conn, $sqlSelectTutor);
             while($row1 = mysqli_fetch_assoc($resultTutor)){
                 $status = 'null';
                 $sql1 = 'SELECT * FROM requestdemo_studentside WHERE TeacherId = ' . $row1['Id'] . ' AND Student_Id = ' . $studentId . ' ORDER BY DefultDateTime DESC';
                 $result1 = mysqli_query($conn, $sql1);
                 if($result1->num_rows > 0) {
                     $rowStatus = $result1->fetch_assoc();
                     $status = $rowStatus['Status'];
                 }
                $row1['Status'] = $status;
                $data[] = $row1;
             }

    }
    echo json_encode($data);

    // $jsonObj = (object) [];
    // $jsonObj->studenttutorformId = $studenttutorformId;
    // echo json_encode($jsonObj);
}


?>