<?php
 include_once('../conn.php');

 $addnewsubject = $_POST['addnewsubject'];

 
 $sql = 'INSERT INTO all_subjects (`Subjects`) VALUES ("'.$addnewsubject.'")';
 $result = mysqli_query($conn, $sql);

 if($result){
     header('location: AddNew_Subject.php');
 }
 else {
     echo $sql;
 }

?>