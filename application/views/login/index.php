<?php if($this->session->userdata('logged_in_rtv')): ?>
    <script>
        window.location.href = "<?php echo base_url();?>index.php/dashboard";
    </script>
<?php endif;?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/custom.css">
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/img/LOGO.png" />
  <style>
  body, html {
    height: 100%;
  }
  .login-page{
  /* The image used */
  background-image: url(<?php echo base_url();?>assets/dist/img/20943711.jpg);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
  </style>
</head>
<body class="hold-transition login-page">

  <div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center mb-3 mt-3">
      <a class="h1"><b>RTV MONITORING</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg mb-3 mt-3"><img src="<?php echo base_url();?>assets/dist/img/user2.png" class="img-circle elevation-2" alt="User Image" width="75px" height="75px"></p>

      <?php $attributes = array('id'=>'login_user','class'=>'form'); ?>
      <?php echo form_open('loginuser/login/', $attributes);?>
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
                    <!-- /.col -->
          <div class="col-12 mb-3">
            <button type="submit" class="btn btn-success btn-block">LOGIN</button>
          </div>
          <!-- /.col -->
        </div>
      <?php echo form_close();?>


      <!-- /.social-auth-links -->

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.min.js"></script>
<?php if(!empty($alert)):?>
  <?php $this->load->view($alert);?>
<?php endif;?>
</body>
</html>
