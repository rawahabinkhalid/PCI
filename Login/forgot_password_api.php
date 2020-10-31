<?php

//Ye file qadir bhai ke liye bnayi ha unhy data get krne ke liye .. Me ye data select ki 
//query hardcode krke hi kr rha hun jese normal krty ha ..

include_once('../conn.php');

session_start();
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

date_default_timezone_set("Asia/Karachi");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    $data_temp = new \StdClass;
    $type = "";

    $sql = "SELECT * FROM signupstudent WHERE `Email` = '".$jsonObj['Email'] . "' AND `PhoneNumber` = '".$jsonObj['PhoneNumber'] . "'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $type = "Student";
        $forgotPassOutput = forgotPasswordFunction($conn, $row, $jsonObj['Email'], 'signupstudent');
    } else {
        $sql1 = "SELECT * FROM signupteacher WHERE `Email` = '".$jsonObj['Email'] . "' AND `PhoneNumber` = '".$jsonObj['PhoneNumber'] . "'";
        $result1 = mysqli_query($conn, $sql1);
        if($result1->num_rows > 0) {
            $row1 = mysqli_fetch_assoc($result1);
            $type = "Teacher";
            $forgotPassOutput = forgotPasswordFunction($conn, $row1, $jsonObj['Email'], 'signupteacher');
        } else {
            $sql2 = "SELECT * FROM signupinstitute WHERE `Email` = '".$jsonObj['Email'] . "' AND `PhoneNumber` = '".$jsonObj['PhoneNumber'] . "'";
            $result2 = mysqli_query($conn, $sql2);

            if($result2->num_rows > 0) {
                $row2 = mysqli_fetch_assoc($result2);
                $type = "Institute";
                $forgotPassOutput = forgotPasswordFunction($conn, $row2, $jsonObj['Email'], 'signupinstitute');
            } else {
                $forgotPassOutput = "No user is registered with this email address!";
            }
        }
    }
    $data_temp->message = $forgotPassOutput;
    $data_temp->type = $type;
    echo json_encode($data_temp);
}


function forgotPasswordFunction($conn, $row, $email, $tablename) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);
    $key = md5($expDate . $email);
    $addKey = substr(md5(uniqid(rand(),1)),3,10);
    $key = $key . $addKey;
    $sql = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`, `tablename`) VALUES ('".$email."', '".$key."', '".$expDate."', '".$tablename."');";
    $result = $conn->query($sql);
    // mysqli_query($conn, "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('".$email."', '".$key."', '".$expDate."');")
    if($result) {
        $outputOfMail = sendMail($email, $key);
        return $outputOfMail;
    } else {
        return $conn->error;
    }
    
}


function sendMail($email, $key) {
    
    $output='<p>Dear user,</p>';
    $output.='<p>Please click on the following link to reset your password.</p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p><a href="http://pci.edusol.co/forgot-password/reset-password.php?
    key='.$key.'&email='.$email.'&action=reset" target="_blank">
    http://pci.edusol.co/forgot-password/reset-password.php
    ?key='.$key.'&email='.$email.'&action=reset</a></p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p>Please be sure to copy the entire link into your browser.
    The link will expire after 1 day for security reason.</p>';
    $output.='<p>If you did not request this forgotten password email, no action 
    is needed, your password will not be reset. However, you may want to log into 
    your account and change your security password as someone may have guessed it.</p>';   
    $output.='<p>Thanks,</p>';
    $output.='<p>PCI By MATZ Solutions Pvt Ltd</p>';
    $body = $output; 
    $subject = "Password Recovery";
     
    $email_to = $email;
    $fromserver = "noreply@pci.edusol.co"; 
    require("../PHPMailer/PHPMailerAutoload.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "pci.edusol.co"; // Enter your host here
    $mail->SMTPAuth = true;
    $mail->Username = "noreply@pci.edusol.co"; // Enter your email here
    $mail->Password = "(&@Tw10VX]j%"; //Enter your password here
    $mail->Port = 25;
    $mail->IsHTML(true);
    $mail->From = "noreply@pci.edusol.co";
    $mail->FromName = "PCI By MATZ Solutions Pvt Ltd";
    $mail->Sender = $fromserver; // indicates ReturnPath header
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($email_to);
    if(!$mail->Send()){
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "An email has been sent to you with instructions on how to reset your password.";
    }
}
?>