<?php
include_once('../conn.php');


if($_SERVER['REQUEST_METHOD']=='POST') {

    // $studenttutorformId = null;


    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    $sql = 'SELECT ClassToTeach FROM tutorform_section4 WHERE UserId ='.$jsonObj['teacherid'];
    $result = mysqli_query($conn, $sql);
    $class = [];
    while($row = mysqli_fetch_assoc($result)){
        $class[] = '"' . $row['ClassToTeach'] . '"';
    }
    
    $status = 'null';
    $datastudent = [];
    $sql1 = 'SELECT Id, StudentName, Class FROM  studenttutorform WHERE Area ="'.$jsonObj['area'].'" AND Class IN ('.implode(', ', $class).')';
    //  echo $sql1;   
    $result1 = mysqli_query($conn, $sql1);
    if($result1->num_rows > 0) {
        while($row1 = mysqli_fetch_assoc($result1)){

            $subjects = [];
            $sql2 = 'SELECT Subjects FROM  studenttutorsubjects WHERE studenttutorform_id ='.$row1['Id'];
            //  echo $sql2;   
            $result2 = mysqli_query($conn, $sql2);
            if($result2->num_rows > 0) {
                while($row2 = mysqli_fetch_assoc($result2)){
                    $subjects[] = $row2['Subjects'];                
                }
            }


            $status = 'null';
            $sql1_Demo = 'SELECT * FROM requestdemo_teacherside WHERE TeacherId = ' . $jsonObj['teacherid'] . ' AND Student_Id = ' . $row1['Id'] . ' ORDER BY DefultDateTime DESC';
            $result1_Demo = mysqli_query($conn, $sql1_Demo);
            if($result1_Demo->num_rows > 0) {
                $rowStatus = $result1_Demo->fetch_assoc();
                $status = $rowStatus['Status'];
            }

            $data_temp = new \stdClass;
            $data_temp->Id = $row1['Id'];
            $data_temp->Name = $row1['StudentName'];
            $data_temp->ClassName = $row1['Class'];
            $data_temp->Subjects = implode(', ', $subjects);
            $data_temp->JobId = "";
            $data_temp->Type = "Student";
            $data_temp->Status = $status;
            $datastudent[] = $data_temp;
        }
    }

    
    $status = 'null';
    $dataInstitute = [];
    $sql1 = 'SELECT Id, InstituteName FROM  instituteregistrationform WHERE Area ="'.$jsonObj['area'].'"';
    //  echo $sql1;   
    $result1 = mysqli_query($conn, $sql1);
    if($result1->num_rows > 0) {
        while($row1 = mysqli_fetch_assoc($result1)){
            $subjects = [];
            $sql2 = 'SELECT Id, Subjects, Class FROM  instituteregistrationjobs WHERE Instituteregform_Id ='.$row1['Id'] . ' AND Class IN ('.implode(', ', $class).')';
            //  echo $sql2;   
            $result2 = mysqli_query($conn, $sql2);
            if($result2->num_rows > 0) {
                while($row2 = mysqli_fetch_assoc($result2)){



                    $status = 'null';
                    $sql1_Demo = 'SELECT * FROM requestdemo_teacherside WHERE TeacherId = ' . $jsonObj['teacherid'] . ' AND Institute_Id = ' . $row1['Id'] . ' AND JobId = ' . $row2['Id'] . ' ORDER BY DefultDateTime DESC';
                    $result1_Demo = mysqli_query($conn, $sql1_Demo);
                    if($result1_Demo->num_rows > 0) {
                        $rowStatus = $result1_Demo->fetch_assoc();
                        $status = $rowStatus['Status'];
                    }

                    $data_temp = new \stdClass;
                    $data_temp->Id = $row1['Id'];
                    $data_temp->Name = $row1['InstituteName'];
                    $data_temp->ClassName = $row2['Class'];
                    $data_temp->Subjects = $row2['Subjects'];
                    $data_temp->JobId = $row2['Id'];
                    $data_temp->Type = "Institute";
                    $data_temp->Status = $status;
                    $dataInstitute[] = $data_temp;

                }
            }
        }
    }

    $data_master = new \stdClass;
    $data_master->studentData = $datastudent;
    $data_master->instituteData = $dataInstitute;


    echo json_encode($data_master);
}


?>