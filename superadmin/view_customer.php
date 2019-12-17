<?php

session_start();

if(!isset($_SESSION["user_id"])){

 header("location:../index.php");

}

require_once'top_nav.php';

require_once'side_nav.php';


?>


<?php
// set page headers
// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// echo $id;
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/customer.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$customer = new Customer($db);

 
// set ID property of product to be read
$customer->customerId = $id;
 
// read the details of product to be read
$customer->readOne();
$page_title = "Read Customer";
 ?>

 

 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 align="middle">
    Customer Details
      
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
             <li class="active">Customer Details</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-sm-12  col-lg-6 col-lg-offset-3 ">
        <!-- general form elements -->
        <div class="box box-primary">
    <table class="table table-bordered table-hover">
    
    <?php
   echo "<tr>";
        echo "<td><b>CUSTOMER NO</b></td>";
        echo "<td>{$customer->customerId}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td><b>CUSTOMER NAME</b></td>";
        echo "<td>{$customer->customerName}</td>";
    echo "</tr>";

     echo "<tr>";
        echo "<td><b>CONTACT PERSON</b></td>";
        echo "<td>{$customer->custContactPerson}</td>";
    echo "</tr>";

     echo "<tr>";
    echo "<td><b>CONTACT NO</b></td>";
        echo "<td>{$customer->contactNumber}</td>";
    echo "</tr>";

      echo "<tr>";
        echo "<td><b>E-MAIL ID</b></td>";
        echo "<td>{$customer->custEmail}</td>";
    echo "</tr>";

echo "<tr>";
        echo "<td><b>ASSOCIATE AGENT</b></td>";
        echo "<td>{$customer->associated_agent}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td><b>BUSINESS LINE</b></td>";
        echo "<td>{$customer->business_line}</td>";
    echo "</tr>";

     echo "<tr>";
        echo "<td><b>END USE</b></td>";
        echo "<td>{$customer->end_use}</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td><b>PRODUCT GROUP</b></td>";
        echo "<td>{$customer->product_group}</td>";
    echo "</tr>";

      echo "<tr>";
        echo "<td><b>PRODUCT</b></td>";
        echo "<td>{$customer->product}</td>";
    echo "</tr>";

     echo "<tr>";
    echo "<td><b>PROJECT</b></td>";
        echo "<td>{$customer->Project}</td>";
    echo "</tr>";
    
      echo "<tr>";
        echo "<td><b>REGION</b></td>";
        echo "<td>{$customer->region}</td>";
    echo "</tr>";



echo "</table>";

    ?>
  </section>

</div>
</div>
</div>
 
<?php
require_once('footer.php');
?>
