<?php
include "dbconfig.php";

$custid = $_POST['customer'];   // customer id

$sql = "SELECT customer_locations_details.contact_person_name FROM customer_locations_details WHERE customer_locations_details.cust_id=$custid
UNION ALL select customer_master.contact_person as contact_person_name from customer_master where customer_master.cust_id=$custid";

$result = mysqli_query($conn,$sql);

$users_arr = array();
if($result->num_rows>0){
while( $row = mysqli_fetch_array($result) ){
//    $userid = $row['sr_no'];
    $name = $row['contact_person_name'];

    $users_arr[] = array( "contact_person_name" => $name);
}
}else{

}

// encoding array to json format
echo json_encode($users_arr);
?>