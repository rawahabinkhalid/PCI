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
    $sql = 'SELECT requestdemo_instituteside.DefultDateTime, tutorform_section1.FullName, instituteregistrationform.InstituteName FROM requestdemo_instituteside LEFT JOIN instituteregistrationform ON instituteregistrationform.Id = requestdemo_instituteside.Institute_Id LEFT JOIN tutorform_section1 ON  tutorform_section1.Id = requestdemo_instituteside.TeacherId  WHERE requestdemo_instituteside.Status = "Rejected" AND instituteregistrationform.UserId = ' . $userid;
    $data = [];    
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0 ){
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
            //         echo'
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