<?php

 include '../conn.php';

session_start();
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

date_default_timezone_set("Asia/Karachi");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);

    $key = $jsonObj['key'];
    $email = $jsonObj['email'];
    $new_password = $jsonObj['new_password'];
    $confirm_password = $jsonObj['confirm_password'];
    $current_date = date('Y-m-d H:i:s');

    $data_temp = new \StdClass;
    
    $sql = "SELECT * FROM password_reset_temp WHERE `email` = '".$email . "' AND `key` = '".$key."'";
    // $forgotPassOutput = $sql;

    // $data_temp->message = $forgotPassOutput;
    // echo json_encode($data_temp);
    
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $expiryDate = $row['expDate'];
        if($expiryDate >= $current_date) {
            if($new_password != $confirm_password) {
                $forgotPassOutput = "Passwords do not match.";
            } else {
                $sql = 'UPDATE '.$row['tablename'].' SET user_password = "'.$new_password.'" WHERE user_email = "'.$email.'"';
                if($conn->query($sql)) {
                    $forgotPassOutput = "Password updated successfully.";
                } else {
                    $forgotPassOutput = "Error occurred while updating Password.";
                }
            }
        } else {
            $forgotPassOutput = "Link Expired. You are trying to use the expired link which is valid only for 24 Hours.";
        }
    } else {
        $forgotPassOutput = "Invalid Link. Link is either invalid/expired.";
    }
        
    
    $data_temp->message = $forgotPassOutput;
    echo json_encode($data_temp);
}

?>