<?php
//server 

define('DB_SERVER', 'localhost'); 
define('DB_USER','dwleaalz_rahul');
define('DB_PASS','Learnwell@123');
 define('DB_NAME','dwleaalz_new_erp_system');
$conn=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

//local

// $user="root";
// $host="localhost";
// $password="";
// $dbname="new_erp_system";
// $conn=mysqli_connect($host,$user,$password,$dbname);

if(!$conn)
{
    die("db connect error".mysqli_connect_error());
}

?>