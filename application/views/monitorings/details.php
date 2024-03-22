<style>
    td{
        vertical-align:middle !important;
	    /* text-align:center !important; */
    }
    .my-custom-scrollbar {
      position: relative;
      height: 400px;
      overflow: auto;
    }
    .table-wrapper-scroll-y {
      display: block;
    }
    div#details_table_wrapper div.row {
      margin-left: 0px;
      margin-right: 0px;
    }

</style>

<?php if($this->session->userdata('usertype')!='3'): ?>
    <script>
        window.location.href = "<?php echo base_url();?>index.php/dashboard";
    </script>
<?php endif;?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6 col-sm-12">
        <h1 class="m-0">RTV RECEIVE</h1>
      </div><!-- /.col -->
      <div class="col-md-6 col-sm-12" style="font-size: 20px;">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/dashboard">HOME</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/monitoring/find">MONITORING</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/monitoring/receive/<?php echo $rtv->id;?>">RECEIVE</a></li>
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
                       src="<?php// echo base_url();?>assets/dist/img/user2.png"
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

                <div class="row pt-3" >
                  <div class="col-md-6">
                    <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link button_all btn btn-primary" style="color:white;">RTV NUMBER: <?php echo $rtv->rtv_number;?> | SKU CODE: <?php echo $rtv->sku_code;?> | QTY: <?php echo $rtv->qty;?></a></li>            
                  </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                      
                        <a href="javascript: history.go(<?php echo $this->uri->segment(4);?>)"  class="btn btn-danger btn-block" >GO BACK</a>                        
                      </div>
                    </div>
                    <?php if($rtv->migration_status!='1'):?>
                      <?php $attributes = array('id'=>'monitoring','class'=>'form_horizontal'); ?>
                      <?php echo form_open('monitoring/detail', $attributes);?>
                      <?php echo form_close();?>
                    <?php endif;?>
                    
                    <input type="hidden" form="monitoring" name="segment" value="<?php echo $this->uri->segment(4);?>" >
                    <div class="col-md-2">
                      <div class="form-group">
                        <?php if($rtv->migration_status!='1'):?>
                          <input type="submit" value="SUBMIT" form="monitoring" style="color:white;" class="btn btn-warning btn-block">
                        <?php else:?>
                          <button class="btn btn-success btn-block">MIGRATION SUCCESS</button>
                        <?php endif?>
                      </div>
                    </div>
                </div>
                <input type="hidden" form="monitoring" name="monitoring_id" value="<?php echo $rtv->id;?>">
                <input type="hidden" form="monitoring" name="qty_to_check" value="<?php echo $rtv->qty;?>">
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="table-wrapper-scroll-y my-custom-scrollbar" >
                    <table id="details_table" class="table table-bordered table-hover" style="width:100%; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                        <thead>
                        <tr>
                          <th>REMARKS</th>
                          <th>LOT</th>
                          <th>QTY</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php if(empty($receives)):?>
                            <?php for($x = 0; $x <= 11; $x++):?>
                              <tr>
                                <td>
                                  <span id="notexist<?php echo $x;?>" class="alert alert-danger mt-3" style="display:none;">LOT DOES NOT EXIST</span>
                                  <span id="exist<?php echo $x;?>" class="alert alert-success mt-3" style="display:none;">LOT EXIST</span>
                                </td>
                                <td>
                                  <span style="display:none;">value of the input</span>
                                  
                                  <input type="text" id="lot<?php echo $x;?>" form="monitoring" oninput="myFunction<?php echo $x;?>()" class="form-control" name="lot[]">
                                </td>
                                <td>
                                  <input type="number" disabled="disabled" id="qty<?php echo $x;?>" form="monitoring" min="0" value="1" required="required" class="form-control" name="qty[]">
                                </td>
                              </tr>
                            <?php endfor;?>
                        <?php else:?>
                        <?php $counts = count($receives);?>
                        <?php $totals = 11 - $counts; ?>
                        <?php foreach($receives as $receive):?>
                          <tr>
                            <td>
                              <span class="btn btn-block btn-success" >LOT EXIST</span>
                            </td>
                            <td>
                              <span style="display:none;"><?php echo $receive->detail_lot;?></span>
                              <input type="text" form="monitoring" class="form-control" value="<?php echo $receive->detail_lot;?>" name="editlot[]">
                            </td>
                            <td>
                              <input type="number" form="monitoring" min="0" required="required" value="<?php echo $receive->detail_qty;?>" class="form-control" name="editqty[]">
                              <input type="hidden" form="monitoring" value="<?php echo $receive->id;?>" class="form-control" name="editid[]">

                            </td>
                          </tr>
                        <?php endforeach;?>
                        <?php for($x = 0; $x <= $totals; $x++):?>
                          <tr>
                            <td>
                              <span id="notexist<?php echo $x;?>" class="btn btn-block btn-danger mt-3" style="display:none;">LOT DOES NOT EXIST</span>
                              <span id="exist<?php echo $x;?>" class="btn btn-block btn-success mt-3" style="display:none;">LOT EXIST</span>
                            </td>
                            <td>
                              <input type="text" id="lot<?php echo $x;?>" form="monitoring" oninput="myFunction<?php echo $x;?>()" class="form-control" name="lot[]">
                            </td>
                            <td>
                              <input type="number" disabled="disabled" id="qty<?php echo $x;?>" form="monitoring" min="0" value="1" required="required" class="form-control" name="qty[]">
                            </td>
                          </tr>
                        <?php endfor;?>
                      <?php endif;?>
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
