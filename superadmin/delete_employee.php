<?php


if(isset($_GET["delete_flag_true"])){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Deleted');
    window.location.href='employee_dashboard.php';
    </script>");
   
}

$tid="";
if(isset($_GET["emp_id"])){
$id=$_GET["emp_id"];
require_once'dbconfig.php';

    $DELETE ="DELETE FROM employee_master  WHERE emp_id='$id'";
    //die($DELETE);
$result=mysqli_query($conn,$DELETE);
if($result){
    header("location:employee_dashboard.php?delete_flag_true=true");
 }
}

?>