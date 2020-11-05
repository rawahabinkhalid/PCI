<?php 
include_once('../conn.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e

    $email1 = '';
    $email2 = '';

    $obj = new \StdClass;
       
    if($jsonObj['Type'] == 'Student'){
        $sql = "UPDATE requestdemo_studentside SET `Status`='Scheduled', ScheduledDateByAdmin = '".$jsonObj['ScheduledDate']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
        if(mysqli_query($conn, $sql)) {
            
            $sql1 = 'SELECT requestdemo_studentside.*, studenttutorform.StudentEmail, tutorform_section1.Email  FROM requestdemo_studentside JOIN studenttutorform ON requestdemo_studentside.Student_Id = studenttutorform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_studentside.TeacherId WHERE requestdemo_studentside.Status = "Scheduled" AND requestdemo_studentside.`Id` = '.$jsonObj['ScheduledId'].' '; 
            $result = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
                $email1 = $row['StudentEmail'];
                $email2 = $row['Email'];
            }
            $obj->message = 'Successfully saved';
            
        } else {
            $obj->message = $conn->error;
        }
        // echo $result;
        
    } else if($jsonObj['Type'] == 'Institute'){
        $sql = "UPDATE requestdemo_instituteside SET `Status`='Scheduled', ScheduledDateByAdmin = '".$jsonObj['ScheduledDate']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
        if(mysqli_query($conn, $sql)) {
            
            $sql1 = 'SELECT requestdemo_instituteside.*, instituteregistrationform.Email AS Ins_Email, tutorform_section1.Email FROM requestdemo_instituteside JOIN instituteregistrationform ON requestdemo_instituteside.Institute_Id = instituteregistrationform.Id JOIN tutorform_section1 ON tutorform_section1.Id = requestdemo_instituteside.TeacherId WHERE requestdemo_instituteside.Status = "Scheduled" AND requestdemo_instituteside.`Id` = '.$jsonObj['ScheduledId'].' '; 
            $result = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
                $email1 = $row['Ins_Email'];
                $email2 = $row['Email'];
            }
            $obj->message = 'Successfully saved';
        
        } else { 
            $obj->message = $conn->error;
        }
        // echo $result;
        echo json_encode($obj);
          
    } else if($jsonObj['Type'] == 'TeacherStudent'){
        $sql = "UPDATE requestdemo_teacherside SET `Status`='Scheduled', ScheduledDateByAdmin = '".$jsonObj['ScheduledDate']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
        if(mysqli_query($conn, $sql)) {
            
            $sql1 = 'SELECT requestdemo_teacherside.*, tutorform_section1.Email, studenttutorform.StudentEmail FROM requestdemo_teacherside JOIN tutorform_section1 ON requestdemo_teacherside.TeacherId = tutorform_section1.Id JOIN studenttutorform ON studenttutorform.Id = requestdemo_teacherside.Student_Id WHERE requestdemo_teacherside.Status = "Scheduled" AND requestdemo_teacherside.`Id` = '.$jsonObj['ScheduledId'].' '; 

            $result = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
                $email1 = $row['Email'];
                $email2 = $row['StudentEmail'];
            } else {
                $obj->message = $conn->error;
            }
            $obj->message = 'Successfully saved';
            
        } else {
            $obj->message = $conn->error;
        } 
        // echo $result;   
        echo json_encode($obj);
            
    } else if($jsonObj['Type'] == 'TeacherInstitute'){
        $sql = "UPDATE requestdemo_teacherside SET `Status`='Scheduled', ScheduledDateByAdmin = '".$jsonObj['ScheduledDate']."' WHERE `Id` = ".$jsonObj['ScheduledId'];
        if(mysqli_query($conn, $sql)) {
            
            $sql1 = 'SELECT requestdemo_teacherside.*, tutorform_section1.Email AS Tut_Email, instituteregistrationform.Email FROM requestdemo_teacherside JOIN tutorform_section1 ON requestdemo_teacherside.TeacherId = tutorform_section1.Id JOIN instituteregistrationform ON instituteregistrationform.Id = requestdemo_teacherside.Institute_Id WHERE requestdemo_teacherside.Status = "Scheduled" AND requestdemo_teacherside.`Id` = '.$jsonObj['ScheduledId'].' '; 
            $result = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
                $email1 = $row['Tut_Email'];
                $email2 = $row['Email'];
            }
            $obj->message = 'Successfully saved';

        } else {
            $obj->message = $conn->error;
        }
        // echo $result;
        echo json_encode($obj);
        
    }


    if($email1 != '' && $email2 != '') {
        require '../PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
    
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
    
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.ipage.com"; // host name
        $mail->Port = 465;
        $mail->Username = "info_pci@matz.group"; //email id
        $mail->Password = "Qwerty@123";  //password
    
        $mail->setFrom('admin@pci.edusol.co', 'PCI'); //from email
    
        $mail->addAddress($email1); 
        $mail->addAddress($email2); 
        // $mail->addReplyTo($email, $name);
    
    
        $mail->isHTML(true);
        $mail->Subject = 'Mail Sent';
        $mail->Body='Admin scheduled your demo on ' . date('d-M-Y', strtotime($jsonObj['ScheduledDate'])) . '. Kindly check your portal to see further details.';
        // $mail->Body = 'Your query has been submitted successfully';
    
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            $obj->error = $mail->ErrorInfo;
        }
    
    }
    echo json_encode($obj);

}
?>