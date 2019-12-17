<?php

session_start();

if(!isset($_SESSION["user_id"])){

 header("location:../index.php");

}

require_once'top_nav.php';

require_once'side_nav.php';

//if(isset($_GET["delete_flag"])){

//  if($_GET["delete_flag"]=="true")

//  {

//      echo'<script>alert("Employee Deleted..")</script>';

//  }

//  }

if(isset($_GET["status_flag"])){

if($_GET["status_flag"]=="true")
{
    echo'<script>alert("Employee Registered..")</script>';
}
}
if(isset($_GET["status"])){

if($_GET["status"]=="true")

{

    echo'<script>alert("Employee Updated..")</script>';

}

}



?>

<?php

require_once'dbconfig.php';



$SELECT ="SELECT * FROM  customer_master";





$result= $conn->query($SELECT);



if($result->num_rows>0)

{



  echo' <div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

    Customer List

      

    </h1>
    <br>
    <a class="btn-lg btn-primary " href="create_customer.php"> + Add Customer</a>
    <br>
    <ol class="breadcrumb">

      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

             <li class="active">Customer Dashboard</li>

    </ol>

  </section>



  <!-- Main content -->

  <section class="content">

    <div class="row">

      <!-- left column -->

      <div class="col-sm-12 ">

        <!-- general form elements -->

        <div class="box box-primary">';
        
  

    while($row = $result->fetch_assoc())
    {

           $id_main=$row["cust_id"];
           $colapse_id="collapse$id_main";
           $SELECT_LOCATIONS ="SELECT * FROM  customer_locations_details  where cust_id=$id_main";

           $result_locations= $conn->query($SELECT_LOCATIONS);
          
           
          echo'
              <div class="panel box box-primary">
              <div class="box-header with-border">
                <h4 >
                <table class="table  table-hover">
                <tr>
                <td >'.$row["cust_name"] .'</td> 
                <td style="text-align:left;; ">'.$row["location"] .'</td>
                <td >'.$row["contact_person"] .'</td>
                <td >'.$row["contact_number"] .'</td>
                 
                    <td >  <a  data-toggle="collapse" data-parent="#accordion" href="#'.$colapse_id.'" aria-expanded="false" class="collapsed"> 
                      
                            
                            
                             
                             <button class="btn btn-primary">More Details ... </button>
                             </a>
                             </td>
                    <td >   <a href="customer_location.php" class="btn btn-primary">Add Location </a>
                             </td></tr>
                             </table> 
                             </h4> 
              </div>
              <div id="'.$colapse_id.'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
              <div class="box-body">';
              if($result_locations->num_rows>0){
              echo'<table class="table table-bordered table-hover">
              <thead>

            <tr>

        

        <th>Location</th>

        <th>Contact Person </th>

        <th>Contact No</th>

        <th>Email</th>

        <th>View</th>

        <th>Edit</th>

        <th>Delete</th>



      </tr>

    </thead>

    <tbody>';
   
    while($row_location = $result_locations->fetch_assoc())

    {

           $id=$row_location["sr_no"];



            echo'

              <tr>

                <td>'. $row_location["location"].'</td>

                <td>'. $row_location["contact_person_name"].'</td>

                <td>'. $row_location["contact_person_number"].'</td>
                <td>'. $row_location["contact_person_email"].'</td>

                

                <td><a class="btn btn-info" href="view_customer.php?id='. $row_location["sr_no"].'"> View </button></td>

                <td><a class="btn btn-warning" href="emp_edit.php?eid='. $row_location["sr_no"].'"> Edit </button></td>

               

                <td>';  ?>





                <button type="button" class="btn btn-danger" onclick="return deleteConfirm('<?php echo $id  ?>')" >Delete </button> 

                

                <?php  echo'</td>

              </tr>';
              

    }
  }else{
    

    echo"There's no location Added. please ";
    echo"<a href='customer_location.php' class='btn btn-primary'>Add Location </a>";
  }
    
    
    echo'</tbody>

    </table>';
                
    
             
             echo'   </div>
              </div>
              </div>';

    }

}

else{

  echo' <div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

    Customer List

      

    </h1>
   <br>
    <a class="btn-lg btn-primary " href="create_customer.php"> + Add Customer</a>
    <br>
    <ol class="breadcrumb">

      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

             <li class="active">Customer List</li>

    </ol>

  </section>



  <!-- Main content -->

  <section class="content">

    <div class="row">

      <!-- left column -->

      <div class="col-sm-12 ">

        <!-- general form elements -->

        <div class="box box-primary">

        <h4>No Customers!</h4>

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

  var txt= id;

  var r = confirm("Are You Sure !\n Do you want to delete employee.");

  if (r == true) {

    console.log("delete");

   // window.location("http:/localhost/gemscap/delete.php?ei="+id);

    window.location.assign("customer_delete.php?cust_id="+txt);

  } else {

    alert(id);

  }

  }

  </script>

