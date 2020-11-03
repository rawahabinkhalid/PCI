<?php
include_once('../conn.php');

session_start();

if($_SERVER['REQUEST_METHOD']=='POST') {

    //jason s
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    //jason e
    
    
    if(isset($jsonObj["userid"])) {
        $userid = $jsonObj['userid'];
    } else {
        $userid = $_SESSION['userid'];
    }

    $sql = 'INSERT INTO QueryStudent (`UserId`, `Description`) VALUES ("'.$userid.'", "'.$_POST['querydescription'].'") ';
    $result = mysqli_query($conn, $sql);

        if($result){
            // echo '<script>alert("Query has been Submitted Successfully");window.open("SendQuery.php", "_self");</script>';

            require '../PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;

            $mail->IsSMTP();
            $mail->SMTPDebug = 2;

            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.ipage.com"; // host name
            $mail->Port = 465;
            $mail->Username = "newa@matz.group"; //email id
            $mail->Password = "Qwerty@12";  //password

            $mail->setFrom('admin@pci.edusol.co', 'PCI'); //from email

            $mail->addAddress('hafizabdulrafay7@gmail.com'); 
            // $mail->addReplyTo($email, $name);


            $mail->isHTML(true);
            $mail->Subject = 'Mail Sent';
               $mail->Body='Portal : Student<br>UserId :'.$userid.'<br>Description :'.$_POST['querydescription'];
            // $mail->Body = 'Your query has been submitted successfully';

            if (!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }

        }
        else{
            echo $sql;
        }


    // $jsonObj->userid = $userid;
    // echo json_encode($jsonObj);
}

?>