<?php


$user="root";
$host="localhost";
$password="";
$dbname="new_erp_system";
$conn=mysqli_connect($host,$user,$password,$dbname);

$cust_id=$_REQUEST['cust_id'];
// echo $cust_id;
$query = "DELETE FROM `customer_master` WHERE cust_id = $cust_id"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());


//  $sql=mysqli_query($conn,"select * from food_sale_invoice_item WHERE invoice_no_duplicate=$invoice_no ");
							
// 							  while ($row = mysqli_fetch_array ($sql))
// 							  {
								  
// 								$query1 = "DELETE FROM food_sale_invoice_item WHERE invoice_no_duplicate=$row[invoice_no_duplicate]"; 
// $result1 = mysqli_query($conn,$query1) or die ( mysqli_error());
  
								  
								  
								  
header("Location:customer_dashboard.php"); 

?>