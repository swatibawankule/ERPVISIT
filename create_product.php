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
include_once 'objects/product.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$product = new Product($db);

//include_once "layout_header.php";
$stmt = $product->readAll($from_record_num, $records_per_page);


$total_rows=$product->countAll();
if($total_rows!=NULL){


}

require'top_nav.php';
require_once'side_nav.php';
?>
<?php

if($_POST){

        $product->productId = $_POST['productId'];
        $product->productName = $_POST['productName'];
        $product->productGroup = $_POST['productGroup'];
        $product->location = $_POST['location'];
        
        
         if($product->create()){
        echo ("<script LANGUAGE='JavaScript'>
  window.alert('Product Created');
  window.location.href='product_dashboard.php';
  </script>");

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class=''>Unable to create Product.</div>";
    }
}
?>

<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>CREATE PRODUCT</b>

        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Details</li>
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
                            <h5><font size="4.5"><b>PRODUCT DETAILS</b></font></h5><hr>
                            <div class="row">


                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Product Id<span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"   name="productId" pattern="[a-zA-Z0-9-]+" title="Only Alphabet & Numbers Are Allowed">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label >Product Name<span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"name="productName">

                                    </div>
                                </div> 
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Product Group <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="productGroup" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Location <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="location">
                                    </div>
                                </div>
                                
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