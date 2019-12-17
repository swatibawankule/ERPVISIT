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
include_once 'objects/location.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$location = new Location($db);

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
        $location->srNo = $_POST['srNo'];
        $location->customerId = $_POST['customerId'];
        $location->location = $_POST['location'];
        $location->ContactPersonName = $_POST['ContactPersonName'];
        $location->ContactPersonNumber = $_POST['ContactPersonNumber'];
        $location->ContactPersonEmail = $_POST['ContactPersonEmail'];
        
        
       
        
         if($location->create()){
        echo ("<script LANGUAGE='JavaScript'>
  window.alert('Location Added');
  window.location.href='customer_dashboard.php';
  </script>");

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class=''>Unable to add location.</div>";
    }
}
?>
<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>ADD LOCATION</b>

        </h1>
        
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">ADD LOCATION</li>
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
                            <h5><font size="4.5"><b>LOCATION DETAILS</b></font></h5><hr>
                            <div class="row">

                                

                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label >Sr No<span id="redStarMark">*</span></label>
                                            <input  required class="form-control" readonly=true type="number"  name="srNo" id="srNo"
											value="<?php  echo $location->LocId();
                                                         
                                                   ?>">
                                        </div>
                                    </div>

                                      <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>Customer Name<span id="redStarMark">*</span></label>
                                           <select class="form-control" name="customerId" id="customerId">
                                         <option>--Please Select--</option>
                                          <?php
                                                            Require_once('dbconfig.php');
                                                            $sql=mysqli_query($conn,"select * from customer_master");
                                                            while($row=mysqli_fetch_array($sql))
                                                             {
                                                            ?>
                                                          <option value="<?php echo $row["cust_id"];?>"> <?php echo $row["cust_name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                        </select>
                                        </div>
                                    </div>



                                
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label >Location<span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control" name="location" id="location" pattern="^[A-Za-z -]+$" title="Enter valid Customer Name Letters Only" >
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label >Contact Person Name<span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control" name="ContactPersonName" id="ContactPersonName" >
                                        </div>
                                    </div>

                                           <div class="col-xs-4">
                                        <div class="form-group">
                                            <label >Contact Person Number<span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control" name="ContactPersonNumber" id="ContactPersonNumber" >
                                        </div>
                                    </div>

                                            <div class="col-xs-4">
                                        <div class="form-group">
                                            <label >Contact Person Email<span id="redStarMark">*</span></label>
                                            <input type="text" required class="form-control" name="ContactPersonEmail" id="ContactPersonEmail" >
                                        </div>
                                    </div>
        
                            <div class="row">
                                <div class ="col-sm-12">
                                    <center><button onClick="javascript: return confirm('Are you sure you want to save Customer details');"  type="submit" class="btn btn-primary">Save</button></center>

                                </div>
                                

                                <div >        
                                </div>
                                </form>
                            </div>

                        <br>

                        </div>

                        

                       
                        <div class="control-sidebar-bg"></div>
                </div>
                
                <?php
                require_once'footer.php';
                ?>
<style>
#redStarMark{
  color:#c15d5d !important;
}
</style>