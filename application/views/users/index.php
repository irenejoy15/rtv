<style>
    td{
        vertical-align:middle !important;
	    /* text-align:center !important; */
    }
    #users_table_filter label{
        width:88%;
    }
    #users_table_filter input{
        width:84%;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6 col-sm-12">
        <h1 class="m-0">USERS LIST</h1>
      </div><!-- /.col -->
      <div class="col-md-6 col-sm-12" style="font-size: 20px;">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/dashboard">HOME</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/user">USER</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                       <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url();?>assets/dist/img/user2.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center mt-4"><span id="locationcode">USERS</span></h3>

                <!-- <p class="text-muted text-center">IT DEPARTMENT</p> -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-sm-12 col-md-12 col-lg-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a href="<?php echo base_url();?>index.php/user/create" class="nav-link button_all btn btn-success" style="color:white;">ADD USER</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div>
                    <table id="users_table" class="table table-bordered table-hover" style="width:100%; font-size:15px; text-transform:uppercase;">
                        <thead>
                        <tr>
                            <th style="width:15%;">Enabled</th>
                            <th style="width:10%;">Superuser</th>
                            <th style="width:30%;">Name</th>
                            <th style="width:20%;">User Type</th>
                            <th style="width:20%;">Username</th>
                            <th style="width:10%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

<script>
    function confirmationDelete(anchor)
    {
    var conf = confirm('Are you sure want to delete this record?');
    if(conf)
        window.location=anchor.attr("href");
    }
</script>
