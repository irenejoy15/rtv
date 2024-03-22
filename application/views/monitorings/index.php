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
    .webgrid-table-hidden
    {
        display: none;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6 col-sm-12">
        <h1 class="m-0">RTV LIST</h1>
      </div><!-- /.col -->
      <div class="col-md-6 col-sm-12" style="font-size: 20px;">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/dashboard">HOME</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/monitoring">MONITORING</a></li>
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
            <!-- <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                       <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url();?>assets/dist/img/user2.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center mt-4"><span id="locationcode">RTV</span></h3>

                <!-- <p class="text-muted text-center">IT DEPARTMENT</p> -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header p-2">
                <?php $attributes = array('id'=>'monitoring','class'=>'form_horizontal'); ?>
                <?php echo form_open_multipart('monitoring/upload', $attributes);?>
                <div class="row pt-3">
                  <div class="col-md-6">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link button_all btn btn-primary" style="color:white;">RTV LIST</a></li>
                    </ul>
                  </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="custom-file">
                          <input type="file" name="upload_file" accept=".xlsx, .xls, .csv"  required="required" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>

                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="input-group-append">
                        <input type="submit" value="UPLOAD" class="btn btn-success btn-block">
                      </div>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="col-md-12" style=" padding-top:10px;">
                      <button id="filtering" type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#exampleModalCenter" style="color:white;">
                        FILTERS
                      </button>
                      <button id="reset" type="button" class="btn btn-danger btn-block rtv_mobile" style="color:white;">
                        RESET FILTER
                      </button>
                    </div>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">FILTERS</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    <label>DATE:</label>
                                    <input class="form-control" type="date" id="column0_search">
                                  </div>
                                  <div class="form-group">
                                    <label>RTV No.:</label>
                                    <input class="form-control" type="text" name="column1_search" id="column1_search">
                                  </div>
                                  <div class="form-group">
                                    <label>STORE:</label>
                                    <input class="form-control" type="text" name="column2_search" id="column2_search">
                                  </div>
                                  <div class="form-group">
                                    <label>SKU CODE:</label>
                                    <input class="form-control" type="text" id="column3_search">
                                  </div>
                                  <div class="form-group">
                                    <label>DESCRIPTION:</label>
                                    <input class="form-control" type="text" id="column4_search">
                                  </div>
                                  <div class="form-group">
                                    <label>UOM:</label>
                                    <input class="form-control" type="text" id="column5_search">
                                  </div>

                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label>QTY:</label>
                                    <input class="form-control" type="number" id="column6_search">
                                  </div>
                                  <div class="form-group">
                                    <label>AMOUNT:</label>
                                    <input class="form-control" type="text" id="column7_search">
                                  </div>
                                  <div class="form-group">
                                    <label>REASON:</label>
                                    <input class="form-control" type="text" id="column8_search">
                                  </div>
                                  <div class="form-group">
                                    <label>CASE:</label>
                                    <input class="form-control" type="text" id="column9_search">
                                  </div>
                                  <div class="form-group">
                                    <label>REFERENCE NO.:</label>
                                    <input class="form-control" type="text" id="column10_search">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button id="reset" type="button" class="btn btn-danger btn-block rtv_mobile" style="color:white;">
                                RESET FILTER
                              </button>
                              <button type="button" class="btn btn-success btn-block" data-dismiss="modal">APPLY</button>
                            </div>
                          </div>
                        </div>
                      </div>

                </div>
              <?php echo form_close();?>

              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div>
                    <table id="rtv_table" class="table table-bordered table-hover verticalDisplay" style="width:100%; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                        <thead>
                        <tr>
                            <th>RTV Date</th>
                            <!-- <th>DOP Date</th> -->
                            <th>RTV NO.</th>
                            <th>STORE</th>
                            <th>SKU</th>
                            <th>DESCRIPTION</th>
                            <th>UOM</th>
                            <th>QTY</th>
                            <th>AMOUNT</th>
                            <th>REASON</th>
                            <th>CASE</th>
                            <th>REFERENCE NO.</th>
                            <th>ACTION</th>
                            <!-- <th>CM No.</th>
                            <th>Document</th>
                            <th>Remarks</th> -->
                        </tr>
                        </thead>
                        
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
