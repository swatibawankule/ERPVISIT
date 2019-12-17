<?php

session_start();

if(!isset($_SESSION["user_id"])){

 header("location:index.php");

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



$SELECT ="SELECT * FROM  product_master";





$result= $conn->query($SELECT);



if($result->num_rows>0)

{



  echo' <div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

    Product List

      

    </h1>

    <ol class="breadcrumb">

      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

             <li class="active">Product List</li>

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

        <th>Product Id</th>

        <th>Product Name</th>

        <th>View</th>

        <th>Edit</th>
        
        <th>Delete</th>



      </tr>

    </thead>

    <tbody>';

    while($row = $result->fetch_assoc())

    {

           $id=$row["product_id"];



            echo'

              <tr>

                <td>'. $row["product_id"].'</td>

                <td>'. $row["product_name"].'</td>

                <td><a class="btn btn-info" href="view_product.php?id='. $row["product_id"].'"> View </button></td>

                <td><a class="btn btn-warning" href="#"> Edit </button></td>

                <td>';  ?>





                <button type="button" class="btn btn-danger" onclick="#" >Delete </button> 

                

                <?php  echo'</td>

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

    Product List

      

    </h1>

    <ol class="breadcrumb">

      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

             <li class="active">Product List</li>

    </ol>

  </section>



  <!-- Main content -->

  <section class="content">

    <div class="row">

      <!-- left column -->

      <div class="col-sm-12 ">

        <!-- general form elements -->

        <div class="box box-primary">

        <h4>No Product Registered!</h4>

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

    window.location.assign("emp_delete.php?emp_id="+txt);

  } else {

    alert(id);

  }

  }

  </script>

