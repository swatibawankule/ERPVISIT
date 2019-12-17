<?php
require_once'top_nav_login.php';

if(isset($_POST["submit"])){
require_once'dbconfig.php';
$admin_id=$_POST["admin_id"];
$password=md5($_POST["password"]);

$query="select * from admin_master where `admin_id`='$admin_id' AND `password`='$password'";
//die($query);
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);
if($row>0)
{
  session_start();
  $_SESSION["user_id"]=$admin_id;
  $_SESSION["user_name"]=$row["name"];
  $_SESSION["user_roll"]="super_admin";

  //die('$_SESSION["user_name"]'.$_SESSION["user_name"]);
    header("location:home.php");
}
else
{
    $password=$_POST["password"];

    $query_emp="select * from employee_master where `emp_id`='$admin_id' AND `password`='$password'";
    //die($query);
    $result_emp=mysqli_query($conn,$query_emp);
    $row_emp=mysqli_fetch_array($result_emp);
    if($row_emp>0){
      session_start();
      $_SESSION["user_id"]=$admin_id;
      $_SESSION["user_name"]=$row_emp["emp_name"];
      $_SESSION["user_name"]=$row_emp["region"];
      $_SESSION["user_roll"]="region_employee";
      
      //die('$_SESSION["user_name"]'.$_SESSION["user_name"]);
      header("location:home.php");
    }else{

        echo"<center><div class='well'> Invalid Login Details...
        <div class=''> <a href='index.php'> click here to Login  </a></div></center>";
    }
}
}
else{
?>
<div class="container">
<br><br><br><br><br><br>

<div class="col-sm-6 col-sm-offset-3">

<div class="box box-info">
            <div class="box-header with-border">
<!--           <center> <img  class="logo-lg " src="dist/img/logo.png" class="user-image" alt="User Image">-->
            <br>
              <h3 class="box-title"> Login </h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Admin Id/Employee Id</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputEmail3" name="admin_id" placeholder="Admin Id">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">

                <input type="submit" name="submit" value="Sign in" class="btn btn-info pull-right">
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        <?php
}
        ?>