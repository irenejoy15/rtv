<style>
    td{
        vertical-align:middle !important;
        overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
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
    input[type=text] 
    { 
        font-size: 11px !important; 
        padding:2px !important;
        text-align: center;  
        margin:4px;
    }
    th{
      font-size:12px;
    }
    td{
     padding:1px !important;
     text-align:center;
     font-size:12px;
    }
    span.select2-selection.select2-selection--single {
      height:40px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 40px;
      position: absolute;
      top: 1px;
      right: 1px;
      width: 20px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color:black !important;
    }
    @media only screen and (max-width: 767px) {
      
      td{
        padding:10px !important;
        text-align:center;
      }
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
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/monitoring/find">MONITORING</a></li>
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
                <?php echo form_close();?>

                <?php $attributes2 = array('id'=>'search','class'=>'form_horizontal','method'=>'GET'); ?>
                <?php echo form_open_multipart('monitoring/search_monitoring/', $attributes2);?>
                <?php echo form_close();?>

                <?php $attributes3 = array('id'=>'mobile','class'=>'form_horizontal','method'=>'GET'); ?>
                <?php echo form_open_multipart('monitoring/search_monitoring_mobile/', $attributes3);?>
                <?php echo form_close();?>

                <?php $attributes4 = array('id'=>'excel','class'=>'form_horizontal','method'=>'POST'); ?>
                <?php echo form_open_multipart('monitoring/export/', $attributes4);?>
                <?php echo form_close();?>
  
                <div class="row pt-3">
                  <div class="col-md-6">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link button_all btn btn-primary" style="color:white;">RTV LIST</a></li>
                    </ul>
                  </div>
                  
                    <?php if($this->session->userdata('excel_upload_status')=='1'):?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="custom-file">
                            <input type="file" form="monitoring" name="upload_file" accept=".xlsx, .xls, .csv" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>

                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="input-group-append">
                          <input type="submit" form="monitoring" value="UPLOAD" class="btn btn-success btn-block" data-toggle="modal" data-target="#monitoringModal">
                        </div>
                      </div>
                    <?php else:?>
                      <div class="col-md-4">
                      </div>
                    <?php endif;?>

                    
                    <!-- Button trigger modal -->
                    <div class="col-md-12" style=" padding-top:10px;">
                      <button id="filtering" type="button" class="btn btn-warning btn-block rtv_mobile" data-toggle="modal" data-target="#exampleModalCenter" style="color:white;">
                        FILTERS
                      </button>
                     
                    </div>

                    <div class="col-md-12" style=" padding-top:10px;">
                      <a href="<?php echo base_url();?>index.php/monitoring/find" class="pt-2"><button id="reset" type="button" class="btn btn-danger btn-block rtv_mobile" style="color:white;">
                        RESET FILTER
                      </button></a>
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
                                  
                                  <?php if($get_date=="%C2%A0" || $get_date=="&nbsp;"):?>
                                      <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="rtv_date" autocomplete="off" id="search"  type="hidden" placeholder="DATE" value="">
                                  <?php endif;?>
                                    

                                  <div class="form-group">
                                      <label>DATE FROM:</label>
                                      <?php if($date_from!='1970-01-01'):?>
                                        <input class="form-control" type="date" form="mobile" style="width:100%;" name='dates_form' value="<?php echo $date_from;?>">
                                      <?php else:?>
                                        <input class="form-control" type="date" form="mobile" style="width:100%;" name='dates_form'>
                                      <?php endif;?>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label>POD DATE:</label>
                                      <?php if($pod_date=="%C2%A0" || $pod_date=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="pod_date" autocomplete="off" id="search"  type="text" placeholder="RTV NO." value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="pod_date" autocomplete="off" id="search"  type="text" placeholder="RTV NO." value="<?php echo $pod_date; ?>">
                                      <?php endif;?>
                                  </div>

                                  <div class="form-group">
                                      <label>RTV_NUMBER:</label>
                                      <?php if($get_name=="%C2%A0" || $get_name=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="rtv_number" autocomplete="off" id="search"  type="text" placeholder="RTV NO." value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="rtv_number" autocomplete="off" id="search"  type="text" placeholder="RTV NO." value="<?php echo $get_name; ?>">
                                      <?php endif;?>
                                  </div>
                                  <div class="form-group">
                                      <label>STORE CODE:</label>
                                      <?php if($get_store_code=="%C2%A0" || $get_store_code=="&nbsp;"):?>
                                          <input form="mobile" class="form-control mobilenow"  name="store_code" autocomplete="off" id="search"  type="text" placeholder="STORE CODE" value="">
                                      <?php else:?>
                                          <input form="mobile" class="form-control mobilenow"  name="store_code" autocomplete="off" id="search"  type="text" placeholder="STORE CODE" value="<?php echo $get_store_code; ?>">
                                      <?php endif;?>
                                  </div>
                                  <div class="form-group">
                                      <label>STORE:</label>
                                      <?php if($get_store=="%C2%A0" || $get_store=="&nbsp;"):?>
                                          <input form="mobile" class="form-control mobilenow"  name="store" autocomplete="off" id="search"  type="text" placeholder="STORE" value="">
                                      <?php else:?>
                                          <input form="mobile" class="form-control mobilenow"  name="store" autocomplete="off" id="search"  type="text" placeholder="STORE" value="<?php echo $get_store; ?>">
                                      <?php endif;?>
                                  </div>

                                      
                                      <?php if(trim($get_migration)!='0'):?>
                                        <div class="form-group">
                                          <label>SO NUMBER:</label>
                                          <?php if($get_so=="%C2%A0" || $get_so=="&nbsp;"):?>
                                            <input type="text" form="mobile" class="form-control mobilenow"  style="width:100%;" name="so_number" autocomplete="off" id="search" placeholder="SO NO." value="" >
                                          <?php else:?>
                                            <input type="text" form="mobile" style="width:100%;"class="form-control mobilenow"  name="so_number" autocomplete="off" id="search"  type="text" placeholder="SO NO." value="<?php echo $get_so; ?>">
                                          <?php endif;?>
                                        </div>
                                      <?php else:?>
                                        <?php if($get_so=="%C2%A0" || $get_so=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="so_number" autocomplete="off" id="search"  type="hidden" value="">
                                        <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow" name="so_number" autocomplete="off" id="search"  type="hidden" value="">
                                        <?php endif;?>
                                      <?php endif;?>
                                   
                                

                                  <div class="form-group">
                                      <label>SKU CODE:</label>
                                      <?php if($get_sku =="%C2%A0" || $get_sku=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="sku_code" autocomplete="off" id="search"  type="text" placeholder="SKU CODE" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="sku_code" autocomplete="off" id="search"  type="text" placeholder="SKU CODE" value="<?php echo $get_sku; ?>">                  
                                      <?php endif;?>
                                  </div>
                                  <div class="form-group">
                                      <label>DESCRIPTION:</label>
                                      <?php if($description =="%C2%A0" || $description=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="description" autocomplete="off" id="search"  type="text" placeholder="DESCRIPTION" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="description" autocomplete="off" id="search"  type="text" placeholder="DESCRIPTION" value="<?php echo $description; ?>">                  
                                      <?php endif;?>
                                  </div>

                                  <div class="form-group">
                                      <label>Migration Status:</label>
                                      <select class="form-control mt-1" form="mobile" name="migration_status">
                                        <?php if($get_migration=='0'):?>
                                          <option selected="selected" value="0">NOT MIGRATED</option>
                                          <option value="1">MIGRATED</option>
                                          <option value="2">RECON</option>
                                        <?php elseif($get_migration=='1'):?>
                                          <option value="0">NOT MIGRATED</option>
                                          <option selected="selected" value="1">MIGRATED</option>
                                          <option value="2">RECON</option>
                                        <?php else:?>
                                          <option value="0">NOT MIGRATED</option>
                                          <option value="1">MIGRATED</option>
                                          <option selected="selected" value="2">RECON</option>
                                        <?php endif;?>
                                      </select>
                                  </div>

                              </div>

                              <div class="col-6">
                                  <div class="form-group">
                                      <label>DATE TO:</label>
                                      <?php if($date_to!='1970-01-01'):?>
                                        <input class="form-control" type="date" form="mobile" style="width:100%;" name='dates_form' value="<?php echo $date_to;?>">
                                      <?php else:?>
                                        <input class="form-control" type="date" form="mobile" style="width:100%;" name='dates_form'>
                                      <?php endif;?>
                                  </div>

                                  <div class="form-group">
                                      <label>UOM:</label>
                                      <?php if($uom =="%C2%A0" || $uom=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="uom" autocomplete="off" id="search"  type="text" placeholder="UOM" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="uom" autocomplete="off" id="search"  type="text" placeholder="UOM" value="<?php echo $uom; ?>">                  
                                      <?php endif;?>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label>QTY:</label>
                                      <?php if($qty =="%C2%A0" || $qty=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="qty" autocomplete="off" id="search"  type="text" placeholder="QTY" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="qty" autocomplete="off" id="search"  type="text" placeholder="QTY" value="<?php echo $qty; ?>">                  
                                      <?php endif;?>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label>QTY RCV.:</label>
                                      <?php if($qty_received =="%C2%A0" || $qty_received=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="qty_received" autocomplete="off" id="search"  type="text" placeholder="QTY" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="qty_received" autocomplete="off" id="search"  type="text" placeholder="QTY" value="<?php echo $qty_received; ?>">                  
                                      <?php endif;?>
                                  </div>

                                  
                                  <div class="form-group">
                                      <label>AMOUNT:</label>
                                      <?php if($amount =="%C2%A0" || $amount=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="amount" autocomplete="off" id="search"  type="text" placeholder="AMOUNT" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="amount" autocomplete="off" id="search"  type="text" placeholder="AMOUNT" value="<?php echo $amount; ?>">                  
                                      <?php endif;?>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label>REASON:</label>
                                      <?php if($reason =="%C2%A0" || $reason=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="reason" autocomplete="off" id="search"  type="text" placeholder="REASON" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="reason" autocomplete="off" id="search"  type="text" placeholder="REASON" value="<?php echo $reason; ?>">                  
                                      <?php endif;?>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label>CASE:</label>
                                      <?php if($case =="%C2%A0" || $case=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="case" autocomplete="off" id="search"  type="text" placeholder="CASE" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="case" autocomplete="off" id="search"  type="text" placeholder="CASE" value="<?php echo $case; ?>">                  
                                      <?php endif;?>
                                  </div>
                                  <div class="form-group">
                                      <label>REFERENCE:</label>
                                      <?php if($reference =="%C2%A0" || $reference=="&nbsp;"):?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="reference" autocomplete="off" id="search"  type="text" placeholder="REFERENCE" value="">
                                      <?php else:?>
                                          <input form="mobile" style="width:100%;" class="form-control mobilenow"  name="reference" autocomplete="off" id="search"  type="text" placeholder="REFERENCE" value="<?php echo $reference; ?>">                  
                                      <?php endif;?>
                                  </div>

                               
                              </div>
                            </div>
                            <div class="modal-footer">
                              <a  class="btn btn-danger btn-block rtv_mobile"  href="<?php echo base_url();?>index.php/monitoring/find" >
                                RESET FILTER
                              </a>
                              <input form="mobile" type="submit" value="FILTER" name="submitsearch"  style="color:white;" class="btn btn-warning btn-block">
                            </div>
                          </div>
                        </div>
                      </div>

                </div>
              

              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                                         
                      <div class="row">
                          <div class="col-md-2">
                              <!-- Button trigger modal -->
                              <input type="submit" form="excel" class="btn btn-success btn-block" value="EXPORT" data-toggle="modal" data-target="#monitoringModal">
       
                               <!-- Modal -->
                            <div class="modal fade" id="monitoringModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="monitoringModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-center" id="exampleModalLongTitle">PLEASE WAIT......</h5>
                                    
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-sm-12">
                                        <img src="<?php echo base_url();?>assets/dist/img/1.gif" style="width:100%">
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                         
                          <div class="col-md-2">
                          
                          </div>
                          <div class="col-md-2 top_margin_mobile">
                            <?php if($date_from!='1970-01-01'):?>
                              <input class="form-control" type="date" form="search" name='dates_form' value="<?php echo $date_from;?>">
                              <input class="form-control" type="hidden" form="excel" name='dates_form_export' value="<?php echo $date_from;?>">
                            <?php else:?>
                              <input class="form-control" type="date" form="search" name='dates_form'>
                              <input class="form-control" type="hidden" form="excel" name='dates_form_export' value="">
                            <?php endif;?>
                          </div>
                          <div class="col-md-2 top_margin_mobile">
                            <?php if($date_to!='1970-01-01'):?>
                              <input class="form-control" type="date" form="search" name='dates_to' value="<?php echo $date_to;?>">
                              <input class="form-control" type="hidden" form="excel" name='dates_to_export' value="<?php echo $date_to;?>">
                            <?php else:?>
                              <input class="form-control" type="date" form="search" name='dates_to'>
                              <input class="form-control" type="hidden" form="excel" name='dates_to_export' value="">
                            <?php endif;?>
                          </div>
                          <div class="col-md-2">
                            <select class="form-control top_margin_mobile" form="search" name="migration_status">   
                            <?php if($get_migration=='0'):?>
                              <option selected="selected" value="0">NOT MIGRATED</option>
                              <option value="1">MIGRATED</option>
                              <option value="2">RECON</option>
                            <?php elseif($get_migration=='1'):?>
                              <option value="0">NOT MIGRATED</option>
                              <option selected="selected" value="1">MIGRATED</option>
                              <option value="2">RECON</option>
                            <?php else:?>
                              <option value="0">NOT MIGRATED</option>
                              <option value="1">MIGRATED</option>
                              <option selected="selected" value="2">RECON</option>
                            <?php endif;?>
                            </select>
                          </div>
                          
                          <?php if($get_migration=='0'):?>
                            <input class="form-control" type="hidden" form="excel" name='migration_status_export' value="0">
                          <?php else:?>
                            <input class="form-control" type="hidden" form="excel" name='migration_status_export' value="1">
                          <?php endif;?>
                          
                          <div class="col-md-2">
                            <input form="search" type="submit" value="FILTER" name="submitsearch"  style="color:white;" class="btn btn-warning btn-block search">
                          </div> 
                      </div>
                  <div>
                  <div class="table-responsive mt-3">
                    <table id="monitor_table" class="table table-bordered table-hover verticalDisplay" style="width:100%; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                        <thead>
                        <tr>
                            <th>RTV DATE</th>
                            <th>POD DATE</th>
                            <th>RTV NO. &nbsp;&nbsp;&nbsp;</th>
                            <th>CODE</th>
                            <th>STORE NAME</th>
                            <?php if($get_migration!='0'):?>
                              <th>SO NUMBER</th>
                            <?php endif;?>
                            <th>SKU &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            
                            <th>DESCRIPTION</th>
                            <th>UOM</th>
                            <th>QTY &nbsp;&nbsp;&nbsp;</th>
                            <th>QTY RCV.</th>
                            <th>AMOUNT</th>
                            <th>REASON</th>
                            <th>CASE &nbsp;&nbsp;&nbsp;</th>
                            <th>REF NO.</th>
                            <th>ACTION</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                          
                            <tr class="trdisplay">
                                <td class="margin_right">
                                 <?php if($get_date=="%C2%A0" || $get_date=="&nbsp;"):?>
                                    <input form="search" style="width:100%;" class="form-control search"  name="rtv_date" autocomplete="off" id="search"  type="hidden" placeholder="DATE" value="">
                                 <?php endif;?>
                                </td>
                                <td class="margin_right">
                                 <?php if($pod_date=="%C2%A0" || $pod_date=="&nbsp;"):?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="pod_date" autocomplete="off" id="search"  type="text" placeholder="POD" value="">
                                  <input class="form-control" type="hidden" form="excel" name='pod_export' value="">
                                 <?php else:?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="pod_date" autocomplete="off" id="search"  type="text" placeholder="POD" value="<?php echo $pod_date; ?>">
                                  <input class="form-control" type="hidden" form="excel" name='pod_export' value="<?php echo $pod_date; ?>">
                                 <?php endif;?>
                                </td>
                                <td class="margin_right">
                                 <?php if($get_name=="%C2%A0" || $get_name=="&nbsp;"):?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="rtv_number" autocomplete="off" id="search"  type="text" placeholder="RTV NO." value="">
                                  <input class="form-control" type="hidden" form="excel" name='rtv_number_export' value="">
                                 <?php else:?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="rtv_number" autocomplete="off" id="search"  type="text" placeholder="RTV NO." value="<?php echo $get_name; ?>">
                                  <input class="form-control" type="hidden" form="excel" name='rtv_number_export' value="<?php echo $get_name;?>">
                                 <?php endif;?>
                                </td>
                                <td class="margin_right">
                                <?php if($get_store_code=="%C2%A0" || $get_store_code=="&nbsp;"):?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="store_code" autocomplete="off" id="search"  type="text" placeholder="CODE" value="">
                                  <input class="form-control" type="hidden" form="excel" name='store_code_export' value="">
                                <?php else:?>
                                  <input form="search" style="width:100%;"  class="form-control search"  name="store_code" autocomplete="off" id="search"  type="text" placeholder="CODE" value="<?php echo $get_store_code; ?>">
                                  <input class="form-control" type="hidden" form="excel" name='store_code_export' value="<?php echo $get_store_code;?>">
                                <?php endif;?>
                                </td>
                                <td class="margin_right">
                                <?php if($get_store=="%C2%A0" || $get_store=="&nbsp;"):?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="store" autocomplete="off" id="search"  type="text" placeholder="STORE" value="">
                                  <input class="form-control" type="hidden" form="excel" name='store_export' value="">
                                <?php else:?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="store" autocomplete="off" id="search"  type="text" placeholder="STORE" value="<?php echo $get_store; ?>">
                                  <input class="form-control" type="hidden" form="excel" name='store_export' value="<?php echo $get_store;?>">
                                <?php endif;?>
                                </td>

                                <?php if($get_migration!='0'):?>
                                  <td class="margin_right">
                                    <?php if($get_so=="%C2%A0" || $get_so=="&nbsp;"):?>
                                      <input form="search" style="width:100%;" class="form-control search"  name="so_number" autocomplete="off" id="search"  type="text" placeholder="SO NO." value="">
                                      <input class="form-control" type="hidden" form="excel" name='so_number_export' value="">
                                    <?php else:?>
                                      <input form="search" style="width:100%;" class="form-control search"  name="so_number" autocomplete="off" id="search"  type="text" placeholder="SO NO." value="<?php echo $get_so; ?>">
                                      <input class="form-control" type="hidden" form="excel" name='so_number_export' value="<?php echo $get_so;?>">
                                    <?php endif;?>
                                  </td>
                                <?php else:?>
                                  <?php if($get_so=="%C2%A0" || $get_so=="&nbsp;"):?>
                                    <input form="search" style="width:100%;" class="form-control search"  name="so_number" autocomplete="off" id="search"  type="hidden" value="">
                                    <input class="form-control" type="hidden" form="excel" name='so_number_export' value="">
                                  <?php else:?>
                                    <input form="search" style="width:100%;" class="form-control search"  name="so_number" autocomplete="off" id="search"  type="hidden" value="">
                                    <input class="form-control" type="hidden" form="excel" name='so_number_export' value="">
                                  <?php endif;?>
                                <?php endif;?>
                               

                                <?php if($get_sku =="%C2%A0" || $get_sku=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="sku_code" autocomplete="off" id="search"  type="text" placeholder="SKU" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='sku_code_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="sku_code" autocomplete="off" id="search"  type="text" placeholder="SKU" value="<?php echo $get_sku; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='sku_code_export' value="<?php echo $get_sku;?>">
                                <?php endif;?>

                                <?php if($description =="%C2%A0" || $description=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="description" autocomplete="off" id="search"  type="text" placeholder="DESCRIPTION" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='description_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="description" autocomplete="off" id="search"  type="text" placeholder="DESCRIPTION" value="<?php echo $description; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='description_export' value="<?php echo $description;?>">
                                <?php endif;?>
                                <!-- Check Separate -->
                                <?php if($uom =="%C2%A0" || $uom=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="uom" autocomplete="off" id="search"  type="text" placeholder="UOM" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='uom_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="uom" autocomplete="off" id="search"  type="text" placeholder="UOM" value="<?php echo $uom; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='uom_export' value="<?php echo $uom;?>">
                                <?php endif;?>

                                <?php if($qty =="%C2%A0" || $qty=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="qty" autocomplete="off" id="search"  type="text" placeholder="QTY" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='qty_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="qty" autocomplete="off" id="search"  type="text" placeholder="QTY" value="<?php echo $qty; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='qty_export' value="<?php echo $qty;?>">
                                <?php endif;?>

                                <?php if($qty_received =="%C2%A0" || $qty_received=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="qty_received" autocomplete="off" id="search"  type="text" placeholder="QTY RCV." value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='qty_received_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="qty_received" autocomplete="off" id="search"  type="text" placeholder="QTY RCV." value="<?php echo $qty_received; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='qty_received_export' value="<?php echo $qty_received;?>">
                                <?php endif;?>

                                <?php if($amount =="%C2%A0" || $amount=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="amount" autocomplete="off" id="search"  type="text" placeholder="AMOUNT" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='amount_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="amount" autocomplete="off" id="search"  type="text" placeholder="AMOUNT" value="<?php echo $amount; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='amount_export' value="<?php echo $amount;?>">
                                <?php endif;?>

                                <?php if($reason =="%C2%A0" || $reason=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="reason" autocomplete="off" id="search"  type="text" placeholder="REASON" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='reason_export'>
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="reason" autocomplete="off" id="search"  type="text" placeholder="REASON" value="<?php echo $reason; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='reason_export' value="<?php echo $reason;?>">
                                <?php endif;?>

                                <?php if($case =="%C2%A0" || $case=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="case" autocomplete="off" id="search"  type="text" placeholder="CASE" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='case_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="case" autocomplete="off" id="search"  type="text" placeholder="CASE" value="<?php echo $case; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='case_export' value="<?php echo $case;?>">
                                <?php endif;?>

                                <?php if($reference =="%C2%A0" || $reference=="&nbsp;"):?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="reference" autocomplete="off" id="search"  type="text" placeholder="REFERENCE" value=""></td>
                                 <input class="form-control" type="hidden" form="excel" name='reference_export' value="">
                                <?php else:?>
                                 <td class="margin_right"><input form="search" style="width:100%;" class="form-control search"  name="reference" autocomplete="off" id="search"  type="text" placeholder="REFERENCE" value="<?php echo $reference; ?>"></td>                  
                                 <input class="form-control" type="hidden" form="excel" name='reference_export' value="<?php echo $reference;?>">
                                <?php endif;?>
                                <td></td>

                             
                            </tr>
                            
                            <?php foreach($monitorings as $row):?>
                            <tr>
                            <?php 
                                $date_query = new DateTime( $row->rtv_date );
                                $date_query_2 = new DateTime( $row->pod_date );
		
                                $rtv_date =  $date_query->format("Y-m-d");
                                $dop_date =  $date_query_2->format("Y-m-d");
                                ?>
                                <td><p class="rtv_mobile text-center" style="font-size:20px; font-weight:bold;">RTV DETAIL</p><hr class="rtv_mobile"><span class="rtv_mobile" style="font-weight:bold;">RTV DATE: </span><?php echo $rtv_date;?></td>
                                <td><span class="rtv_mobile" style="font-weight:bold;">POD DATE.: </span><?php echo $row->pod_date;?></td>
                                <td><span class="rtv_mobile" style="font-weight:bold;">RTV NO.: </span><?php echo $row->rtv_number;?></td>
                                <td style="text-align:center;"><span class="rtv_mobile" style="font-weight:bold;">STORE CODE.: </span><?php echo $row->store_code;?></td>
                                <td><span class="rtv_mobile" style="font-weight:bold;">STORE DESC.: </span><?php echo $row->store_description;?></td>
                                <?php if($get_migration!='0'):?>
                                  <td><span class="rtv_mobile" style="font-weight:bold;">SO NUMBER.: </span><?php echo ltrim($row->sales_order, "0");?></td>
                                <?php endif;?>
                                <td style="text-align:center;"><span class="rtv_mobile" style="font-weight:bold;">SKU CODE: </span><?php echo $row->sku_code;?></td>
                                <td style="text-align:center;"><span class="rtv_mobile" style="font-weight:bold;">DESCRIPTION: </span><?php echo $row->description;?></td>
                                <td style="text-align:center;"><span class="rtv_mobile" style="font-weight:bold;">UOM: </span><?php echo $row->uom;?></td>
                                <td style="text-align:center;"><span class="rtv_mobile" style="font-weight:bold;">QTY: </span><?php echo $row->qty;?></td>
                                <td style="text-align:center;"><span class="rtv_mobile" style="font-weight:bold;">QTY RECEIVE: </span><?php echo $row->total_qty_received;?></td>
                                <td><span class="rtv_mobile" style="font-weight:bold;">AMOUNT: </span><?php echo $row->amount;?></td>
                                <td><span class="rtv_mobile" style="font-weight:bold;">REASON: </span><?php echo $row->reason;?></td>
                                <td style="text-align:center;"><span class="rtv_mobile" style="font-weight:bold;">CASE: </span><?php echo round($row->case_reference, 2);?></td>
                                <td><span class="rtv_mobile" style="font-weight:bold;">REFERENCE: </span><?php echo $row->reference_number;?></td>
                                <td>
                                  <?php if($this->session->userdata('usertype')=='3'):?>
                                    <?php if($row->migration_status=='1'):?>       
                                      <a href="<?php echo base_url();?>index.php/monitoring/receive/<?php echo $row->id;?>/-1" ><i class="fas fa-2x fa-eye" style="color:#f0ad4e;"></i>
                                    <?php else:?>
                                      <a href="<?php echo base_url();?>index.php/monitoring/receive/<?php echo $row->id;?>/-1"><i class="fas fa-2x fa-angle-double-left" style="color:green;"></i></a>
                                      &nbsp;
                                      <a onClick="javascript:confirmationDelete($(this));return false;" href="<?php echo base_url();?>index.php/monitoring/delete/<?php echo $row->id;?>"><i class="fas fa-2x fa-trash-alt" style="color:red;"></i></a>
                                    <?php endif;?>
                                  <?php endif;?>
                                </td>
                            
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                        
                    </table>
                    
                  </div>
                    <div class="row pt-3" style="font-size:14px;"> 
                      <div class="col-md-4 col-sm-12">
                        <?php echo $this->pagination->create_links(); ?>
                      </div>  
                      <?php foreach($skus as $sku):?>
                        <div class="col-md-2 col-sm-12 sku_count">
                          <span style="font-weight:bold;"><?php echo $sku->sku_code;?></span><br> <span style="font-weight:bold;">QTY:</span> <?php echo $sku->qty_total;?> pcs <br> <span style="font-weight:bold;">QTY RCV:</span> <?php echo $sku->qty_total_received;?> pcs
                        </div>
                      <?php endforeach;?>

                      </div>
                    </div>
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
