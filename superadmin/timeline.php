
    <?php

session_start();

if(!isset($_SESSION["user_id"])){

 header("location:../index.php");

}

require_once'top_nav.php';

require_once'side_nav.php';


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Follow Up Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item"><a href="visit_dashboard.php">Visit List</a></li>
              <li class="breadcrumb-item active">Timeline</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">

<!-- timeline time label -->
<li class="time-label">
    <span class="bg-red">
        10 Feb. 2014
    </span>
</li>
<!-- /.timeline-label -->

<!-- timeline item -->
<li>
    <!-- timeline icon -->
    <i class="fa fa-comments bg-yellow"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

        <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

        <div class="timeline-body">
            ...
            Content goes here
        </div>

        <div class="timeline-footer">
            <a class="btn btn-primary btn-xs">...</a>
        </div>
    </div>
</li>
<li>
    <!-- timeline icon -->
    <i class="fa fa-comments bg-yellow"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

        <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

        <div class="timeline-body">
            ...
            Content goes here
        </div>

        <div class="timeline-footer">
            <a class="btn btn-primary btn-xs">...</a>
        </div>
    </div>
</li>
<li>
    <!-- timeline icon -->
    <i class="fa fa-comments bg-yellow"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

        <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

        <div class="timeline-body">
            ...
            Content goes here
        </div>

        <div class="timeline-footer">
            <a class="btn btn-primary btn-xs">...</a>
        </div>
    </div>
</li>
<li>
    <!-- timeline icon -->
    <i class="fa fa-comments bg-yellow"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

        <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

        <div class="timeline-body">
            ...
            Content goes here
        </div>

        <div class="timeline-footer">
            <a class="btn btn-primary btn-xs">...</a>
        </div>
    </div>
</li>

<!-- END timeline item -->

...

</ul>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
require_once'footer.php';
?>
