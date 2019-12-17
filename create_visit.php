<?php
error_reporting(1);
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:index.php");
}
//require_once'dbconfig.php';
?>
<?php

include_once 'config/core.php';
include_once 'config/database.php';
//die("HI");
include_once 'objects/visit.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$visit = new Visit($db);

//include_once "layout_header.php";
$stmt = $visit->readAll($from_record_num, $records_per_page);


$total_rows=$visit->countAll();
if($total_rows!=NULL){


}

require'top_nav.php';
require_once'side_nav.php';
?>
<?php

if($_POST){

        $visit->customer_id = $_POST['customer_id'];
        $visit->emp_id_created = "admin";
        $visit->visit_date = $_POST['visit_date'];
        $visit->product_name = $_POST['product_name'];
        $visit->application = $_POST['application'];
        $visit->description = $_POST['description'];
        $visit->status = $_POST['status'];
        $visit->status_date = $_POST['status_date'];
        $visit->last_updated_by = "ADMIN";
       // $visit->image_name = $_POST['image_name'];
        $visit->region = "INDIA";
       
        
         if($visit->create()){
        echo ("<script LANGUAGE='JavaScript'>
  window.alert('Visit Created');
  window.location.href='visit_dashboard.php';
  </script>");

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class=''>Unable to create visit.</div>";
    }
}
?>
<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>CREATE VISIT</b>

        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Visit Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-sm-12 col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <hr>
                            <h5><font size="4.5"><b>VISIT DETAILS</b></font></h5><hr>
                            <div class="row">


                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Customer Name<span id="redStarMark">*</span></label>
                                        <Select name="customer_id" required class="form-control" >
                                        <option value="" disabled="" selected="">Select Customer</option>
                                            <?php
                                            require_once'dbconfig.php';
                                            $SELECT = "SELECT * FROM  customer_master";
                                            $result = $conn->query($SELECT);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option value="' . $row["cust_id"] . '">' . $row["cust_name"] . ' </option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
<!--                                <input name="emp_id_created">-->

                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label >Visit Date & Time <span id="redStarMark">*</span></label>
                                        <input type="date" required class="form-control" name="visit_date"  title="Enter valid Date" value="<?php
                                        date_default_timezone_set("Asia/Calcutta");
                                        echo date("d/m/Y  h:i:s A") ?>">

                                    </div>
                                </div> 
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label> Product Name <span id="redStarMark">*</span></label>
                                        <Select name="product_name" required class="form-control" >
                                            <option>---Select Product---</option>
                                            <?php
                                            require_once'dbconfig.php';
                                            $SELECT = "SELECT * FROM  product_master";
                                            $result = $conn->query($SELECT);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option value="' . $row["product_id"] . '">' . $row["product_name"] . ' </option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label> Application <span id="redStarMark">*</span></label>
                                        <Select name="application" required class="form-control" >
                                            <option>---Select Application---</option>
                                            <?php
                                            require_once'dbconfig.php';
                                            $SELECT = "SELECT * FROM  business_line";
                                            $result = $conn->query($SELECT);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option value="' . $row["application"] . '">' . $row["application"] . ' </option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label> Description <span id="redStarMark">*</span></label>
                                        <textarea  required class="form-control"  name="description" rows="5"></textarea>
                                    </div>
                                </div>
                            
                           
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Staus <span id="redStarMark">*</span></label>
                                        
                                        <Select name="status" required class="form-control" >
                                        <option value="" disabled="" selected="">Select Status</option>
                                            <?php
                                            require_once'dbconfig.php';
                                            $SELECT = "SELECT * FROM  status_master";
                                            $result = $conn->query($SELECT);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option value="' . $row["Status"] . '">' . $row["status"] . ' </option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label> Status Date  <span id="redStarMark">*</span></label>
                                        <input type="date" required class="form-control" name="status_date"  >
                                    </div>
                                </div>
<!--                                <input name="last_updated_by">
                                 <input name="image_name">-->

                            </div>
                            <div class="row">
                                <div class ="col-sm-12">
                                    <center><button type="submit" class="btn btn-primary">Submit</button></center>

                                </div>
                                <!--                /.box-body -->

                                <div >        
                                </div>
                                </form>
                            </div>



                        </div>

<!--                        <script>
                            function ageCalc() {
                                var age = document.getElementById("age").value;
                                if (age != "NAN" || age != "") {
                                    var age_ = getAge(age);
                                    var age_in_years = " <b>" + getAge(age) + "</b> Years";
                                    // alert(age_in_years);
                                    document.getElementById("age_in_year").innerHTML = age_in_years;
                                    document.getElementById("DATE_OF_BIRTH").value = age_;
                                }

                            }
                            function getAge(DOB) {
                                var today = new Date();
                                var birthDate = new Date(DOB);
                                var age = today.getFullYear() - birthDate.getFullYear();
                                var m = today.getMonth() - birthDate.getMonth();
                                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                    age = age - 1;
                                }
                                return age;
                            }
                        </script>-->

                        <!-- /.control-sidebar -->
                        <!-- Add the sidebar's background. This div must be placed
                             immediately after the control sidebar -->
                        <div class="control-sidebar-bg"></div>
                </div>
                <!-- ./wrapper -->
                <?php
                require_once'footer.php';
                ?>