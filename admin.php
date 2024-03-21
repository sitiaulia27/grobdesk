<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
include 'function_admin_profile.php';
include 'config.php';
isLoggedIn();
?>
<head>
  <?php include 'global_head.php'; ?>
  <title> Dashboard </title>
  <style>
    .icon {
      margin-left: 1050px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
<?php include 'global_header.php'; ?>
<?php include 'global_sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php admin_solved(); ?>
                <p>Recently Solved Ticket</p>
              </div>
              <div class="icon">
                <i class="fas fa-ticket-alt"></i>
              </div>
              <a href="recently_solved_tickets.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php admin_unassigned(); ?>
                <p>Ticket Unassigned</p>
              </div>
              <div class="icon">
                <i class="fas fa-ticket-alt"></i>
              </div>
              <a href="unassigned_tickets.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
             <!-- small box -->
             <div class="small-box bg-warning">
              <div class="inner">
                <?php admin_unsolved(); ?>

                <p>Your Unsolved Tickets</p>
              </div>
              <div class="icon">
                <i class="fas fa-ticket-alt"></i>
              </div>
              <a href="your_unsolved_tickets.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">


            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
  <?php include 'global_footer.php'; ?>

</body>
</html>
