<?php
$servername = 'localhost';
$username = "root";
$password = "";

$dbname = "pci";

//$servername = 'edusol.co';
//$username = "edusol_pci";
//$password = "edusol_pci";
//$dbname = "edusol_pci";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>