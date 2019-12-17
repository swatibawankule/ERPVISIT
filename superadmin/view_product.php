
<!doctype html>
<html lang="en">
    <?php
session_start();

if(!isset($_SESSION["user_id"])){

 header("location:../index.php");

}
 

require'top_nav.php';
require_once'side_nav.php';
//require_once'dbconfig.php';
    ?>

<?php
// set page headers
// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$product = new Product($db);

 
// set ID property of product to be read
$product->productId = $id;
 
// read the details of product to be read
$product->readOne();
$page_title = "Read Product";
 ?>



 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>PRODUCT DETAILS </b>

        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="product_dashboard.php"><i class=""></i> Product List</a></li>
            <li class="active">Product Details </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-sm-12 ">
                <!-- general form elements -->
                <div class="box box-primary">
                    <br>

    <h5><font size="4.5"><b>PRODUCT DETAILS</b></font></h5><hr>

                    <!-- /.box-header -->
                    <!-- form start -->
<form method="POST" action="">

                                <div class="box-body">
                            
                           
                            <div class="row">

                                    <div class="col-xs-4">
                                        <div class="form-group">
                                             <span>Product Id :</span> <span class="span_class"><?php echo $product->productId; ?></span>
                                     
                                        </div>
                                    </div>
                                
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <span>Product Name :</span> <span class="span_class"><?php echo $product->productName; ?></span>
                                  
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <span>Product Group :</span> <span class="span_class"><?php echo $product->productGroup; ?></span>
                                       
                                        </div>
                                    </div>

                                <div class="col-xs-4">
                                        <div class="form-group">
                                            <span>Location :</span> <span class="span_class"><?php echo $product->location; ?></span>     
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
<!--                                <div class ="col-sm-12">
                                    <center><button type="submit" class="btn btn-primary">Save</button></center>

                                </div>-->
                                <!--                /.box-body -->

                                <div >        
                                </div>
                                        </form>



                    
                                            </div>
                                            
                                        </div>

                                    </div>
                                    
                                    
                                </div>

    <?php


require_once"footer.php";
?>
<style>
.span_class {
color:#3c8cbc;
background: transparent !important;
border: none !important;
outline: none !important;
padding: Opx Opx Opx Opx !important;
font-size: 15px !important;

}

.form-group >span{
  display: block;
  width:280px !important;
}
</style>