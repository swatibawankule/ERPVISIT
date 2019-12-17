<?php
session_start();
if(!isset($_SESSION["user_id"])){
 header("location:../index.php");
}
require_once'top_nav.php';
require_once'side_nav.php';


?>
<?php
require_once'dbconfig.php';

$SELECT ="SELECT * FROM  employee_master";


$result= $conn->query($SELECT);

if($result->num_rows>0)
{

  echo' <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Employee Details
      
    </h1>
    <br>
    <a class="btn-lg btn-primary " href="create_employee.php"> + Add Employee</a>
    <br>
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
        <div class="box box-primary">';
    echo'<table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Employee Id</th>
        <th>Employee Name</th>
        <th>Mobile Number</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>

      </tr>
    </thead>
    <tbody>';
    while($row = $result->fetch_assoc())
    {
           $id = $row["emp_id"];

            echo'
              <tr>
                <td>'. $row["emp_id"].'</td>
                <td>'. $row["emp_name"].'</td>
                <td>'. $row["mobile_number"].'</td>
                    <td><a class="btn btn-success" href="view_employee.php?id='. $row["emp_id"].'"> View </button></td>
              <td><a class="btn btn-warning" href="#"> Edit </button></td>
              <td>'; ?>
              
                <button type="button" class="btn btn-danger" onclick="#" >Delete </button>
                
                <?php  echo' </td>
              </tr>
              
        ';
    }echo'</tbody>
    </table>
  </div>';
}
else{
  echo' <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Employee List
      
    </h1>
     <br>
    <a class="btn-lg btn-primary " href="create_employee.php"> + Add Employee</a>
    <br>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
             <li class="active">Employee List</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-sm-12 ">
        <!-- general form elements -->
        <div class="box box-primary">
        <h4>No Employee Created!</h4>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        ';
}

require_once('footer.php');
?>
<script>
  function deleteConfirm(id) {
  var txt;
  var r = confirm("Are You Sure !\n Do you want to delete employee.");
  if (r == true) {
    console.log("delete");
   // window.location("http:/localhost/gemscap/delete.php?ei="+id);
    window.location.assign("delete_employee.php?emp_id="+id);
  } else {
    
  }
  }
  </script>