<style>
    td{
      vertical-align:middle !important;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
	    text-align:center;
      /* text-align:center !important; */
    }
    .webgrid-table-hidden
    {
        display: none;
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
    .span_address{
      font-weight:bolder;
    }
    #checkbox{
      width:20px;
      height:20px;
      border-radius:5px;
    }
    div#store_top {
      padding-top: 5px;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6 col-sm-12">
        <h1 class="m-0">MIGRATION LIST</h1>
      </div><!-- /.col -->
      <div class="col-md-6 col-sm-12" style="font-size: 20px;">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/dashboard">HOME</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/migration">MIGRATION</a></li>
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
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header p-2">
            
                <?php $attributes2 = array('id'=>'post','class'=>'form_horizontal','method'=>'POST'); ?>
                <?php echo form_open_multipart('migration/migrate', $attributes2);?>
                <?php echo form_close();?>

                <?php $attributes4 = array('id'=>'all','class'=>'form_horizontal','method'=>'POST'); ?>
                <?php echo form_open_multipart('migration/export_all/', $attributes4);?>
                <?php echo form_close();?>

                <?php $attributes5 = array('id'=>'range','class'=>'form_horizontal','method'=>'POST'); ?>
                <?php echo form_open_multipart('migration/export_range/', $attributes5);?>
                <?php echo form_close();?>

  
                <div class="row pt-3">
                  <div class="col-md-6">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link button_all btn btn-primary" style="color:white;">MIGRATION LIST</a></li>
                    </ul>
                  </div>
                </div>
              

              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="row">
                    <div class="col-md-2">
                      <h2 class="filter_by">FILTER BY:</h2>
                    </div>
                    <div class="col-md-10">
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <select class='form-control select2 select2-primary' form="post" required="required" id='store_code' name='store_code' form='select'>
                              
                        </select>  
                    </div>

                    <div id="store_top" class="col-md-8 col-sm-12">
                        
                    </div>
                    <div id="store_top" class="col-md-2 col-sm-12">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter2">
                        EXPORT
                      </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">EXPORT TO EXCEL</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                  <label>DATE FROM:</label>
                                  <input form="range" style="width:100%;" class="form-control"  name="date_from_range" autocomplete="off" id="search"  type="date" placeholder="DATE FROM">                  
                                </div>
                                <div class="form-group">
                                  <label>DATE TO:</label>
                                  <input form="range" style="width:100%;" class="form-control"  name="date_to_range" autocomplete="off" id="search"  type="date" placeholder="DATE FROM">                  
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              
                                <input type="submit" class="btn btn-success" value="ALL" form="all" data-toggle="modal" data-target="#monitoringModal">
                                
                    
                                <input type="submit" class="btn btn-success" value="WITH RANGE" form="range" data-target="#monitoringModal">

                              
                                
                              
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>      
                  <hr>
                  <!-- Modal -->
                  <div class="modal fade" id="monitoringModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="palletCenter" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-center" id="exampleModalLongTitle">PLEASE WAIT FOR YOUR EXCEL TO DOWNLOAD</h5>
                        
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
                  <div class="row mt-2">
                      <div class="col-md-2 col-sm-12" style="font-weight:bold;">
                        ADDRESSES:
                      </div>
                      <div class="col-md-10">
                        <div class="row" id="address">
                        </div>
                      </div>
                      
                  </div>
                  <hr>            
                     
                  <div class="row">
                  
                    <div class="col-sm-12">
                      <table id="table_header" class="table verticalDisplay" style="width:100%; max-width:1920px; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                         
                          <tbody>
                            <tr >
                                <td style="border:none; font-weight:bold; width:8%;"></td>                  
                                <td style="border:none; font-weight:bold; width:12%; padding-left:px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RTV DATE</td>
                                <td style="border:none; font-weight:bold; width:10%; padding-left:-3px;">RTV NO.</td>
                                <td style="border:none; font-weight:bold; width:10%;">SKU CODE</td>
                                <td style="border:none; font-weight:bold; width:10%;">DESCRIPTION</td>
                                <td style="border:none; font-weight:bold; width:10%;">RTV QTY</td>
                                <td style="border:none; font-weight:bold; width:10%;">RECEIVE QTY</td>
                              
                            </tr>
                          </tbody>
                          
                      </table>
                      <hr>

                   
                    </div>
                  </div>
                  <div class="col-sm-12">
                     <table id="migration" class="table table-bordered table-hover verticalDisplay" style="width:100%; max-width:1920px; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                          <thead>
                          <tr>
                              <th style="visibility:hidden; width:10%;"></th>                  
                              <th style="visibility:hidden; width:10%;"></th>
                              <th style="visibility:hidden; width:10%;"></th>
                              <th style="visibility:hidden; width:10%;"></th>
                              <th style="visibility:hidden; width:10%;"></th>
                              <th style="visibility:hidden; width:10%;"></th>
                              <th style="visibility:hidden; width:10%;"></th>
                          </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                      </table>
                  </div>
                  <div id="button_submit" class="row pt-3" style="display:none;">
                      <div class="col-md-3">
                        <input type="submit" id="approve_submit" form="post" value="POST" class="btn btn-warning btn-block" style="color:white;">
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

<script type="text/javascript">
    var button = document.getElementById('approve_submit')
    button.addEventListener('click',hideshow,false);

    function hideshow() {
        document.getElementById('approve_submit').style.display = 'block'; 
        this.style.display = 'none'
    }   
</script>
