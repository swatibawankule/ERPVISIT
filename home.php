<?php
session_start();
if(!isset($_SESSION["user_id"])){
 header("location:index.php");
}
require'top_nav.php';
require_once'side_nav.php';



?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <b>Home </b>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
             
      </ol>
    </section>

    <!-- Main content -->
    <!-- <section class="content">
      <div class="row">
         left column -->
        <!-- <div class="col-sm-12 ">
           general form elements -->
          <!-- <div class="box box-primary" id="main_div"> --> 


<?php
require_once'footer.php';
?>
<style>
.content-wrapper {
    min-height: 100%;
/*    background-image:url('images/zensolutions.jpg') !important;*/
    z-index: 800;
}
</style>