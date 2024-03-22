<?php
    date_default_timezone_set('Asia/Manila');
    $year = date('Y');
    $datetoday = date('m-d-Y');
    $timetoday = date('h:i a');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RTV MONITORING</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/custom.css">
   <!-- DataTables -->

  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Dual List -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/img/LOGO.png" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->
  <style>
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
      background-color: #6610f2;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline .select2-search__field,.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
      color: black !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed dark-mode">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-indigo">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto ">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
     <p class="brand-link logo-switch navbar-gray">
      <span class="brand-logo-xl logo-xs font-weight-bold" style="font-family:arial;font-weight: bolder; padding-left:11px;"><b>RM</b></span>
      <span class="pl-3 brand-logo-xs logo-xl font-weight-bold" style="font-family:arial;font-weight: bolder;"><b>RTV MONITORING</b></span>
    </p>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>assets/dist/img/user2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column pb-2" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
          <a class="nav-link" data-toggle="modal" data-target="#modal-secondary">
              <i class="nav-icon fas fa-address-card"></i>
                <p style="font-weight:bold;" >
                  <?php if($this->session->userdata('usertype')==1):?>
                    ADMIN
                  <?php elseif($this->session->userdata('usertype')==2):?>
                    ACCOUNTING
                  <?php elseif($this->session->userdata('usertype')==3):?>
                    WAREHOUSE
                  <?php endif;?>
                </p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open" >
            <a href="<?php echo base_url();?>index.php/dashboard" class="nav-link active">
              <i class="nav-icon fas fa-location-arrow"></i>
              <p>
                Navigation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url();?>index.php/dashboard" class="nav-link" style="background-color: #3b3b3a; font-size:15px;">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <p>Dashboard</p>
                  </a>
                </li>
                <?php if($this->session->userdata('superuser')=="1"):?>
                  <li class="nav-item">
                    <a href="<?php echo base_url();?>index.php/user" class="nav-link" style="background-color: #3b3b3a; font-size:15px;">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                        Users
                      </p>
                    </a>
                  </li>
                <?php endif;?>

                <li class="nav-item">
                  <a href="<?php echo base_url();?>index.php/monitoring/find" class="nav-link" style="background-color: #3b3b3a; font-size:15px;">
                    <i class="nav-icon fas fa-desktop"></i>
                    <p>
                      Monitoring
                    </p>
                  </a>
                </li>
                <?php if($this->session->userdata('migration_upload_status')=="1"):?>
                <li class="nav-item">
                  <a href="<?php echo base_url();?>index.php/migration" class="nav-link" style="background-color: #3b3b3a; font-size:15px;">
                    <i class="nav-icon fas fa-sync"></i>
                    <p>
                      Migration
                    </p>
                  </a>
                </li>
                <?php endif;?>

                <li class="nav-item">
                  <a href="<?php echo base_url();?>index.php/account" class="nav-link" style="background-color: #3b3b3a; font-size:15px;">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                      Settings
                    </p>
                  </a>
                </li>
              </ul>
          </li>

          <li class="nav-item menu-open" >
            <a href="<?php echo base_url();?>index.php/loginuser/logout" class="nav-link bg-danger">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <?php $this->load->view($main_view);?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright <?php echo $year;?> <a>Beauty Elements Venture Manufacturing Inc</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.2.0
    </div>
  </footer>
</div>


<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url();?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->



<?php if(!empty($alert)):?>
  <?php $this->load->view($alert);?>
<?php endif;?>

<?php if(!empty($ajax_view)):?>
  <?php $this->load->view($ajax_view);?>
<?php endif;?>

<?php if(!empty($dual_view)):?>
  <?php $this->load->view($dual_view);?>
<?php endif;?>

<?php if(!empty($chart)):?>
  <?php $this->load->view($chart);?>
<?php endif;?>

<?php if(!empty($quagga)):?>
  <?php $this->load->view($quagga);?>
<?php endif;?>

<?php if(!empty($select)):?>
  <?php $this->load->view($select);?>
<?php endif;?>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

</body>
</html>
