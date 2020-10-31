<?php
include_once('../conn.php');

if(isset($_POST['demoStatusConfirm'])) {
    //confirm
    $demoIdCon = $_POST['demoIdCon'];
    $demoTypeCon = $_POST['demoTypeCon'];
    $studentConfirmId = $_POST['studentCheckId'];
    $classes = $_POST['classes'];
    $subjects = $_POST['subjects'];
    $startingdate = $_POST['startingdate'];
    $fees = $_POST['fees'];
    $daysoftution = $_POST['daysoftution'];
    $demoStatusConfirm = $_POST['demoStatusConfirm'];

    $sql = 'INSERT INTO demostatus (`DemoId`,`Type`,`Student_Confirm`,`Classes`,`Subjects`,`StartingDate`,`Fees`,`DaysOfTution`,`Status`) VALUES ("'.$demoIdCon.'","'.$demoTypeCon.'","'.$studentConfirmId.'","'.$classes.'","'.$subjects.'","'.$startingdate.'","'.$fees.'","'.$daysoftution.'","'.$demoStatusConfirm.'")';
    $result = mysqli_query($conn, $sql);

    $sqlUpdate = 'UPDATE requestdemo_studentside SET `Status` = "Confirmation Completed" WHERE Id = "'.$demoIdCon.'" ';
    $conn->query($sqlUpdate);

    if($result){
    
        // echo $sql;
        header('Location:ScheduledDemo.php');
    }
    else {
        echo "Error";
    }
} else if (isset($_POST['demoStatusRej'])) {

    // rejected 
    $demoIdRej = $_POST['demoIdRej'];
    $demoTypeRej = $_POST['demoTypeRej'];
    $rejectby = $_POST['rejectby'];
    $description = $_POST['discription'];
    $demoStatusRej = $_POST['demoStatusRej'];

    $sql1 = 'INSERT INTO demostatus (`DemoId`, `Type`,`RejectedBy`,`Description`,`Status`) VALUES ("'.$demoIdRej.'", "'.$demoTypeRej.'","'.$rejectby.'","'.$description.'","'.$demoStatusRej.'")';
    $result1 = mysqli_query($conn, $sql1);

    if($result1){
        
        // echo $sql1;
        header('Location:ScheduledDemo.php');
    }
    else {
        echo "Error";
    }
} else if (isset($_POST['demoStatusSus'])) {

    // rejected 
    $demoIdSus = $_POST['demoIdSus'];
    $demoTypeSus = $_POST['demoTypeSus'];
    $suspiciousdescription = $_POST['suspiciousdescription'];
    $demoStatusSus = $_POST['demoStatusSus'];

    $sql2 = 'INSERT INTO demostatus (`DemoId`,`Type`,`Description`,`Status`) VALUES ("'.$demoIdSus.'","'.$demoTypeSus.'","'.$suspiciousdescription.'","'.$demoStatusSus.'")';
    $result2 = mysqli_query($conn, $sql2);

    if($result2){
        
        // echo $sql2;
        header('Location:ScheduledDemo.php');
    }
    else {
        echo "Error";
    }
}

?>