
<!doctype html>
<html lang="en">
    <?php
 

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
include_once 'objects/group.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$group = new Group($db);

 
// set ID property of product to be read
$group->groupName = $id;
 
// read the details of product to be read
$group->readOne();
$page_title = "Read Group";
 ?>



 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>GROUP DETAILS </b>

        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="group_dashboard.php"><i class=""></i> Group List</a></li>
            <li class="active">Group Details </li>
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

    <h5><font size="4.5"><b>GROUP DETAILS</b></font></h5><hr>

                    <!-- /.box-header -->
                    <!-- form start -->
<form method="POST" action="">

                                <div class="box-body">
                            
                           
                            <div class="row">

                                    <div class="col-xs-4">
                                        <div class="form-group">
                                             <span>Group Name :</span> <span class="span_class"><?php echo $group->groupName; ?></span>
                                     
                                        </div>
                                    </div>
                                
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <span>Time :</span> <span class="span_class"><?php echo $group->time; ?></span>
                                  
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