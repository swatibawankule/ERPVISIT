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
include_once 'objects/employee.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$employee = new Employee($db);

//include_once "layout_header.php";
$stmt = $employee->readAll($from_record_num, $records_per_page);


$total_rows=$employee->countAll();
if($total_rows!=NULL){


}

require'top_nav.php';
require_once'side_nav.php';
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
        $employee->password = $_POST['password'];
        $employee->agentFlag = $_POST['agentFlag'];
        
         if($employee->create()){
        echo ("<script LANGUAGE='JavaScript'>
  window.alert('Employee Created');
  window.location.href='employee_dashboard.php';
  </script>");

    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class=''>Unable to create employee.</div>";
    }
}
?>

<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>CREATE EMPLOYEE</b>

        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee Details</li>
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
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <hr>
                            <h5><font size="4.5"><b>EMPLOYEE DETAILS</b></font></h5><hr>
                            <div class="row">


                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Employee Id<span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control" name="employeeId" pattern="[a-zA-Z0-9-]+" title="Only Alphabet & Numbers Are Allowed" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Employee Name<span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"name="employeeName" pattern="^[A-Za-z -]+$" title="Enter valid Employee Name Letters Only">

                                    </div>
                                </div> 
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Employee Roll <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="employeeRoll" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Mobile Number <span id="redStarMark">*</span></label>
                                        <input type="tel" required class="form-control"  name="mobileNumber" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" title="Enter 10 digit mobile number" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Email Id <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="mailId" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Location <span id="redStarMark">*</span></label>
                                        <input type="text" required class="form-control"  name="location" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Region <span id="redStarMark">*</span></label>
                                        <Select name="region" required class="form-control" id="region">
                                            <option>---Select Region---</option>
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
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Password <span id="redStarMark">*</span></label>
                                        <input type="password" required class="form-control"  name="password" >
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label> Employee/Agent <span id="redStarMark">*</span></label>
                                        <Select name="agentFlag" required class="form-control" id="agentFlag">
                                            <option>---Select---</option>
                                            <option>Employee</option>
                                            <option>Agent</option>
                                        </select>
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