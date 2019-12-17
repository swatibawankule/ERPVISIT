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
$page_title = "Update Customer";

if($_POST){
 
    // set product property values
       
        $customer->customerName = $_POST['customerName'];
        $customer->custContactPerson = $_POST['custContactPerson'];
        $customer->contactNumber = $_POST['contactNumber'];
        $customer->custEmail = $_POST['custEmail'];
        $customer->associated_agent = $_POST['associated_agent'];
        $customer->business_line = $_POST['business_line'];
        $customer->end_use = $_POST['end_use'];
        $customer->product_group = $_POST['product_group'];
        $customer->product = $_POST['product'];
        $customer->Project = $_POST['Project'];
        $customer->region = $_POST['region'];
        

    // update customer 

    if($customer->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "customer was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update customer.";
        echo "</div>";
    }
}



 ?>

 

 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 align="middle">
    Customer Update
      
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
             <li class="active">Customer Update</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-sm-12  col-lg-6 col-lg-offset-3 ">
        <!-- general form elements -->
        <div class="box box-primary">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class="table table-bordered table-hover">

   <tr >
            <td ><b>Customer Name</b></td>
            <td ><input  type='text'  name='customerName' value= '<?php echo $customer->customerName; ?>' class='form-control' /></td>
        </tr>

   <tr >
            <td ><b>Contact Person</b></td>
            <td ><input  type='text'  name='custContactPerson' value= '<?php echo $customer->custContactPerson; ?>' class='form-control' /></td>
        </tr>

   <tr >
            <td ><b>Contact Number</b></td>
            <td ><input  type='text'  name='contactNumber' value= '<?php echo $customer->contactNumber; ?>' class='form-control' /></td>
        </tr>

   <tr >
            <td ><b>Customer Email</b></td>
            <td ><input  type='text'  name='custEmail' value= '<?php echo $customer->custEmail; ?>' class='form-control' /></td>
        </tr>

        <tr >
            <td ><b>Associate Agent</b></td>
            <td >  <select class="form-control" name="associated_agent" id="associated_agent">
                                         <option><?php echo $customer->associated_agent; ?><option>
                                          <?php
                                                            Require_once('dbconfig.php');
                                                            $sql=mysqli_query($conn,"select emp_id from employee_master");
                                                            while($row=mysqli_fetch_array($sql))
                                                             {
                                                            ?>
                                                          <option value="<?php echo $row["emp_id"];?>"><?php echo $row["emp_id"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                        </select></td>
        </tr>

        <tr >
            <td ><b>Business Line</b></td>
            <td >         <select class="form-control" name="business_line" id="business_line">
                                         <option><?php echo $customer->business_line; ?></option>
                                          <?php
                                                            Require_once('dbconfig.php');
                                                            $sql=mysqli_query($conn,"select application from business_line");
                                                            while($row=mysqli_fetch_array($sql))
                                                             {
                                                            ?>
                                                          <option value="<?php echo $row["application"];?>"> <?php echo $row["application"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                        </select></td>
        </tr>

        <tr >
            <td ><b>End Use</b></td>
            <td > <select class="form-control" name="end_use" id="end_use">
                                         <option><?php echo $customer->end_use; ?></option>
                                          <?php
                                                            Require_once('dbconfig.php');
                                                            $sql=mysqli_query($conn,"select end_use from end_use");
                                                            while($row=mysqli_fetch_array($sql))
                                                             {
                                                            ?>
                                                          <option value="<?php echo $row["end_use"];?>"> <?php echo $row["end_use"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                        </select>
                                      </td>
        </tr>

          <tr >
            <td ><b>Product Group</b></td>
            <td ><input  type='text'  name='product_group' value= '<?php echo $customer->product_group; ?>' class='form-control' /></td>
        </tr>

  <tr >
            <td ><b>Product</b></td>
            <td ><input  type='text'  name='product' value= '<?php echo $customer->product; ?>' class='form-control' /></td>
        </tr>
  <tr >
            <td ><b>Project</b></td>
            <td ><input  type='text'  name='Project' value= '<?php echo $customer->Project; ?>' class='form-control' /></td>
        </tr>
  <tr >
            <td ><b>Region</b></td>
            <td ><input  type='text'  name='region' value= '<?php echo $customer->region; ?>' class='form-control' /></td>
        </tr>

             <tr>
            <td>
               
            </td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
        





    </table>
    <form>
  </div>
</div>
</div>
</section>

<?php
require_once 'footer.php';
?>