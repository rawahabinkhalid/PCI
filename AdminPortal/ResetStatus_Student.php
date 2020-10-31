<?php
include_once('../conn.php');

$row_Id = $_GET['id'];

$sql = 'DELETE FROM `requestdemo_studentside` WHERE Id = "'.$row_Id.'" '; 
$conn->query($sql);

$sql1 = 'DELETE FROM `demostatus` WHERE DemoId = "'.$row_Id.'" '; 
$conn->query($sql1);


?>