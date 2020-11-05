<?php
include "../conn.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e

    if(isset($jsonObj["userid"])) {
        $userid = $jsonObj['userid'];
    } else {
        $userid = $_SESSION['userid'];
    }

    $obj = new \StdClass;

    $count = 1;
    $sql = 'SELECT requestdemo_studentside.*, StudentName, FullName FROM requestdemo_studentside JOIN studenttutorform ON requestdemo_studentside.Student_Id = studenttutorform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_studentside.TeacherId WHERE requestdemo_studentside.Status = "Scheduled" AND  studenttutorform.UserId = ' . $userid;
    $data = [];    
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0 ){
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
            // echo'
            //         <tr>
            //             <td>'.$count++.'</td>
            //             <td>'.$row['StudentName'].'</td>
            //             <td>'.$row['FullName'].'</td>
            //             <td>'.$row['DefultDateTime'].'</td>
            //         </tr>
            //         ';
        }
    }
    $obj->data = $data;
    echo json_encode($obj);
}
?>