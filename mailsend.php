<?php
// include('PHPMailer/class.phpmailer.php');
if(isset($_POST['submit']))
{
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$country = $_POST['country'];
$message = $_POST['message'];
$submit =$_POST['submit'];

    $email = "hafizabdulrafay7@gmail.com";
    $subject = 'Email query';
    $headers = 'From: notification@matz.group' . "\r\n" .
        'Reply-To: notification@matz.group' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $message1 = 'Name :'.$fname."\r\n".'Father Name :'.$lname."\r\n".'Email :'.$email."\r\n".'Country :'.$country."\r\n".'Message: '.':'.$message;

   if(mail($email, $subject, $message1, $headers)){
        header('location:index.html?email_sent');
   }
   else{
       echo "Mailer Error: ". $mail->ErrorInfo;

   }
    // echo "yes";
    // require 'PHPMailer/PHPMailerAutoload.php';
    //    $mail = new PHPMailer;
       
    //    $mail->IsSMTP();
    //    $mail->SMTPDebug = 2;
       
    //    $mail->SMTPAuth = true;
    //    $mail->SMTPSecure = "ssl";
    //    $mail->Host = "smtp.ipage.com"; // host name
    //    $mail->Port = 465;
    //    $mail->Username = "notification@matz.group"; //email id
    //    $mail->Password = "Qwerty@12";  //password
       
    //    $mail->setFrom('notification@matz.group','Admin'); //from email
    //    $mail->addAddress('cpskarachi@hotmail.com'); //same email id as line16 
    //    $mail->addReplyTo($email,$fname.' '. $lname);
        
       
    //    $mail->isHTML(true);
    //    $mail->Subject = 'Email Query';
    //    $mail->Body='Name :'.$fname.'<br>Father Name :'.$lname.'<br>Email :'.$email.'<br>Country :'.$country.'<br>Message: '.':'.$message;
       
    //    if(!$mail->Send())
    //    {
    //        echo "Mailer Error: ". $mail->ErrorInfo;
    //    }
    //    else
    //    {
    //        header('location:index.html?email_sent');
    //    }
}
?>