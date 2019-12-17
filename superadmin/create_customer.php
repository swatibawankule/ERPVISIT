<?php
error_reporting(1);
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:../index.php");
}
//require_once'dbconfig.php';
?>
<?php

include_once 'config/core.php';
include_once 'config/database.php';
//die("HI");
include_once 'objects/customer.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$customer = new Customer($db);

//include_once "layout_header.php";
//$stmt = $customer->readAll($from_record_num, $records_per_page);


//$total_rows=$customer->countAll();
//if($total_rows!=NULL){


//}

require'top_nav.php';
require_once'side_nav.php';
?>
<?php

if($_POST){

        $customer->customerId = $_POST['customerId'];
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
        
         if($customer->create()){
        echo ("<script LANGUAGE='JavaScript'>
  window.alert('Customer Created');
  window.location.href='customer_dashboard.php';
  </script>");

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class=''>Unable to create customer.</div>";
    }
}
?>
<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>CREATE CUSTOMER</b>

        </h1>
        
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Create Customer</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-sm-12 ">
                
                <!-- general form elements -->
                <div class="box box-primary">
                    

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <hr>
                            <h5><font size="4.5"><b>CUSTOMER DETAILS</b></font></h5><hr>
                            <div class="row">

                                

                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label >Customer No <span id="redStarMark">*</span></label>
                                            <input  required class="form-control" readonly=true type="number"  name="customerId" id="customerId"
											value="<?php  echo $customer->custId();
                                                         
                                                   ?>">
                                        </div>
                                    </div>
                                
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label >Customer Name <span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control" name="customerName" id="customerName" pattern="^[A-Za-z -]+$" title="Enter valid Customer Name Letters Only" >
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label >Contact Person  <span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control" name="custContactPerson" id="custContactPerson" >
                                        </div>
                                    </div>

                                           <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label >Contact Number  <span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control" name="contactNumber" id="contactNumber" >
                                        </div>
                                    </div>
                                                                     
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label >Customer Email <span id="redStarMark">*</span></label>
                                            <input type="email" required class="form-control"  name="custEmail" id="custEmail">
                                        </div>
                                    </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Associated Agent <span id="redStarMark">*</span></label>
                                         
                                        <select class="form-control" name="associated_agent" id="associated_agent">
                                         <option>--Please Select--</option>
                                          <?php
                                                            Require_once('dbconfig.php');
                                                            $sql=mysqli_query($conn,"select emp_id from employee_master");
                                                            while($row=mysqli_fetch_array($sql))
                                                             {
                                                            ?>
                                                          <option value="<?php echo $row["emp_id"];?>"> <?php echo $row["emp_id"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label >Business Line <span id="redStarMark">*</span></label>
                                            
                                           <select class="form-control" name="business_line" id="business_line">
                                         <option>--Please Select--</option>
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
                                        </select>
                                        </div>
                                    </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>End Use <span id="redStarMark">*</span></label>
                                           <select class="form-control" name="end_use" id="end_use">
                                         <option>--Please Select--</option>
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
                                        </div>
                                    </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Product Group</label>
                                            <input type="text"  class="form-control" name="product_group"id="product_group">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Product</label>
                                            <input type="text"  class="form-control" name="product"id="product">
                                        </div>
                                    </div>
                                     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Project</label>
                                            <input type="text"  class="form-control" name="Project"id="project">
                                        </div>
                                    </div>

                               

                                         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                          <label>REGION <span id="redStarMark">*</span></label>
                                        <select class="form-control" name="region" id="region" required>
                                         
                                         <option value="" disabled="" selected="">Select Region</option>
                                          <?php
                                                            Require_once('dbconfig.php');
                                                            $sql=mysqli_query($conn,"select group_name from group_master");
                                                            while($row=mysqli_fetch_array($sql))
                                                             {
                                                            ?>
                                                          <option value="<?php echo $row["group_name"];?>"> <?php echo $row["group_name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                        </select>
                                                   </div>
                                    </div>

                               </div>


<!--                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label >Permanent Address <span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control"   name="permanent_address">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label >Local  Address<span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control"   name="local_address">
                                        </div>
                                    </div>
                                    
                                                                    
                                </div>-->

                            </div>
                            <div class="row">
                                <div class ="col-sm-12">
                                    <center><button onClick="javascript: return confirm('Are you sure you want to save Customer details');"  type="submit" class="btn btn-primary">Save</button></center>

                                </div>
                                <!--                /.box-body -->

                                <div >        
                                </div>
                                </form>
                            </div>

                        <br>

                        </div>

                        

                        <!-- /.control-sidebar -->
                        <!-- Add the sidebar's background. This div must be placed
                             immediately after the control sidebar -->
                        <div class="control-sidebar-bg"></div>
                </div>
                <!-- ./wrapper -->
                <?php
                require_once'footer.php';
                ?>
<style>
#redStarMark{
  color:#c15d5d !important;
}
</style>