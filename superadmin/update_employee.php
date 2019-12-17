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
 
// set page header

$page_title = "Update Employee";
//include_once "layout_header.php";

?>
<?php
// retrieve one product will be here
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/employee.php';
//include_once 'objects/Stateinfo.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$employee = new Employee($db);



// set ID property of product to be edited
$employee->employeeId = $id;
 
// read the details of product to be edited
$employee->readOne();
//$slocation->selectLOCATION();
// ChromePhp::log($customer->customerName);
?>

<?php

if($_POST){

$employee->employeeId = $_POST['employeeId'];
        $employee->employeeName = $_POST['employeeName'];
        $employee->employeeRoll = $_POST['employeeRoll'];
        $employee->mobileNumber = $_POST['mobileNumber'];
        $employee->mailId = $_POST['mailId'];
        $employee->location = $_POST['location'];
        $employee->region = $_POST['region'];
        
         // update the product
    if($employee->update()){
        echo ("<script LANGUAGE='JavaScript'>
  window.alert('Employee Updated');
  window.location.href='employee_dashboard.php';
  </script>");
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update employee.";
        echo "</div>";
    }
}
?>
<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>UPDATE EMPLOYEE</b>

        </h1>
        
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="employee_dashboard.php"><i class=""></i> Employee List</a></li>
            <li class="active">Update Employee</li>
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
                   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <div class="box-body">
                            <hr>
                            
                            <h5><font size="4.5"><b>EMPLOYEE DETAILS</b></font></h5><hr>
                            <div class="row">


                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Employee Id<span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control" disabled=""  name="employeeId" value= "<?php echo $employee->employeeId; ?>">
                                        <input type="hidden" required class="form-control"name="employeeId" value= "<?php echo $employee->employeeId; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Employee Name<span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"name="employeeName" value="<?php echo $employee->employeeName; ?>"pattern="^[A-Za-z -]+$" title="Enter valid Employee Name Letters Only" >

                                    </div>
                                </div> 
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Employee Roll <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="employeeRoll" value="<?php echo $employee->employeeRoll; ?>" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Mobile Number <span id="redStarMark">*</span></label>
                                        <input type="tel" required class="form-control"  name="mobileNumber" value="<?php echo $employee->mobileNumber; ?>" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" title="Enter 10 digit mobile number">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Email Id <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="mailId" value="<?php echo $employee->mailId; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Location <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="location" value="<?php echo $employee->location; ?>" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Region <span id="redStarMark">*</span></label>
                                        <Select name="region" required class="form-control" id="region">
                                            <option disabled selected value="<?php echo $employee->region; ?>"><?php echo $employee->region; ?></option>
                                            <?php
                                            require_once'dbconfig.php';
                                            $SELECT = "SELECT * FROM  group_master ";
                                            $result = $conn->query($SELECT);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<option value="' . $row["group_name"] . '">' . $row["group_name"] . ' </option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                       <div class="row">
                                <div class ="col-sm-12">
                                    <center><button type="submit" class="btn btn-primary">Save</button></center>

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