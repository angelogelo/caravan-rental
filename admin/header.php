<?php

  include '../includes/connection.php';

  if (isset($_SESSION['admin'])) {

      $username = $_SESSION['admin'];
      $emp_type = "admin";

  }else {

    echo '<script>window.location.href="../index.php";</script>';

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CARAVAN &middot; RENT A CAR</title>
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Logo -->
  <link rel="icon" href="../assets/images/caravan.png">
  <!-- Light Slider -->
  <link rel="stylesheet"  href="../assets/lightslider/src/css/lightslider.css"/> 
  <style>
    /* th{
      text-align: center;
    }

    td{
      text-align: center;
    } */
    .disclaimer{
      display: none;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-footer-fixed">
  <div class="wrapper">
  
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-indent" style="transform: rotate(180deg); color: black;"></i></a>
        </li>

      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-warning" id="logout" href="#" title="Logout" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa-sign-out-alt"></i>
            Log out
          </a>
        </li>
      </ul>
    </nav><!-- /.navbar -->

    <!-- logout modal -->
    <div class="modal fade" id="logoutModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-gradient-danger text-white">
            <h5 class="modal-title"><i class="fa fa-info-circle"></i> Message</h5>
          </div>
          <div class="modal-body py-3">
            <div class="py-3">
              <p class="h6">Are you sure you want to logout?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            <button type="button" class="btn btn-outline-danger btn-sm" id="logoutButton" data-type="<?php echo $emp_type; ?>"><i class="fa fa-sign-out-alt"></i> Logout</button>
          </div>
        </div>
      </div>
    </div>
   

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-warning elevation-2" style="background-color: #f8f9fa;">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../assets/images/avatar5.png" class="brand-image img-circle elevation-3"
              style="opacity: .8">
        <span class="brand-text font-weight-light" style="color: black;">Administrator</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar text-sm">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-header">HOME</li>

            <li class="nav-item">
              <a href="index.php" class="nav-link <?php if($page == 'dashboard') { echo ' active'; } ?>" style="color: black;">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <?php 
              $tree_open = '';
              $tree_active = '';
              if(
                $page == 'vehicle-list' ||
                $page == 'vehicles' ||
                $page == 'vehicle-add'
              ) {
                $tree_open = ' menu-open';
                $tree_active = ' active';
              }
            ?>

            <li class="nav-item has-treeview <?php echo $tree_open; ?>">
                <a href="#" class="nav-link <?php if($page == 'vehicles') { echo $tree_active; } else { echo $tree_active; } ?>" style="color: black;">
                    <i class="nav-icon fas fa-car"></i>
                    <p>
                        Vehicle Management
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="vehicle-list.php" class="nav-link <?php if($page == 'vehicle-list') { echo ' active'; } ?>" style="color: black;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vehicle List</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="vehicle-add.php" class="nav-link <?php if($page == 'vehicle-add') { echo ' active'; } ?>" style="color: black;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vehicle Add</p>
                        </a>
                    </li>
                </ul>
            </li>

            <?php 
              $tree_open = '';
              $tree_active = '';
              if(
                $page == 'driver-list' ||
                $page == 'drivers' ||
                $page == 'driver-edit' ||
                $page == 'driver-add'
              ) {
                $tree_open = ' menu-open';
                $tree_active = ' active';
              }
            ?>

            <li class="nav-item has-treeview <?php echo $tree_open; ?>">
                <a href="#" class="nav-link <?php if($page == 'drivers') { echo $tree_active; } else { echo $tree_active; } ?>" style="color: black;">
                    <i class="nav-icon fas fa-user-secret"></i>
                    <p>
                        Driver Management
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="driver-list.php" class="nav-link <?php if($page == 'driver-list') { echo ' active'; } ?>" style="color: black;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Driver List</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="driver-add.php" class="nav-link <?php if($page == 'driver-add') { echo ' active'; } ?>" style="color: black;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Driver Add</p>
                        </a>
                    </li>
                </ul>
            </li>

            <?php 
              $tree_open = '';
              $tree_active = '';
              if(
                $page == 'list-of-booking'
              ) {
                $tree_open = ' menu-open';
                $tree_active = ' active';
              }
            ?>

            <li class="nav-item has-treeview <?php echo $tree_open; ?>">
                <a href="#" class="nav-link <?php if($page == 'list-of-booking') { echo $tree_active; } else { echo $tree_active; } ?>" style="color: black;">
                    <i class="nav-icon fas fa-road"></i>
                    <p>
                        Booking Management
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="list-of-booking.php" class="nav-link <?php if($page == 'list-of-booking') { echo ' active'; } ?>" style="color: black;">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List of Bookings</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
              <a href="payment-list.php" class="nav-link <?php if($page == 'payment-list') { echo ' active'; } ?>" style="color: black;">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>
                  Payment List
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="invoice-list.php" class="nav-link <?php if($page == 'invoice_list') { echo ' active'; } ?>" style="color: black;">
                <i class="nav-icon fas fa-receipt"></i>
                <p>
                  Invoice List
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="messages.php" class="nav-link <?php if($page == 'message') { echo ' active'; } ?>" style="color: black;">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                  Message
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="https://www.sinotrack.com/" class="nav-link" style="color: black;" target="_blank">
                <i class="nav-icon fas fa-location-arrow"></i>
                <p>
                  GPS Tracker
                </p>
              </a>
            </li>

          </ul>
        </nav><!-- /.sidebar-menu -->
      </div><!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">