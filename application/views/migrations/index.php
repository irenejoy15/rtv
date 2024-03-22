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
            
                <?php $attributes2 = array('id'=>'search','class'=>'form_horizontal','method'=>'GET'); ?>
                <?php echo form_open_multipart('migration/search_monitoring/', $attributes2);?>
                <?php echo form_close();?>

                <?php $attributes3 = array('id'=>'mobile','class'=>'form_horizontal','method'=>'GET'); ?>
                <?php echo form_open_multipart('migration/search_monitoring_mobile/', $attributes3);?>
                <?php echo form_close();?>
  
                <div class="row pt-3">
                  <div class="col-md-6">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link button_all btn btn-primary" style="color:white;">MIGRATION LIST</a></li>
                    </ul>
                  </div>
                  
                    <!-- Button trigger modal -->
                    <div class="col-md-12" style=" padding-top:10px;">
                      <button id="filtering" type="button" class="btn btn-warning btn-block rtv_mobile" data-toggle="modal" data-target="#exampleModalCenter" style="color:white;">
                        FILTERS
                      </button>
                     
                    </div>

                    <div class="col-md-12" style=" padding-top:10px;">
                      <a href="<?php echo base_url();?>index.php/migration" class="pt-2"><button id="reset" type="button" class="btn btn-danger btn-block rtv_mobile" style="color:white;">
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
                                   
                              
                              <div class="col-12">
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
                          <div class="col-md-10">

                          </div>
                          <div class="col-md-2">
                              <input form="search" type="submit" value="FILTER" name="submitsearch"  style="color:white;" class="btn btn-warning btn-block search">
                          </div> 
                      </div>
                  <div>
                  <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover verticalDisplay" style="width:100%; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                        <thead>
                        <tr>
                            <th>STORE CODE</th>
                            <th>STORE DESCRIPTION</th>
                            <th>RTV COUNT</th>
                            <th>RTV NUMBER</th>
                            <th>ACTION</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                          
                            <tr class="trdisplay">
                                <td>
                                <?php if($get_store_code=="%C2%A0" || $get_store_code=="&nbsp;"):?>
                                  <input form="search" style="width:100%;" class="form-control search"  name="store_code" autocomplete="off" id="search"  type="text" placeholder="CODE" value="">
                                <?php else:?>
                                  <input form="search" style="width:100%;"  class="form-control search"  name="store_code" autocomplete="off" id="search"  type="text" placeholder="CODE" value="<?php echo $get_store_code; ?>">
                                <?php endif;?>
                                </td>
                                <td>
                                <?php if($get_store=="%C2%A0" || $get_store=="&nbsp;"):?>
                                  <input form="search" class="form-control search"  name="store" autocomplete="off" id="search"  type="text" placeholder="STORE" value="">
                                <?php else:?>
                                  <input form="search" class="form-control search"  name="store" autocomplete="off" id="search"  type="text" placeholder="STORE" value="<?php echo $get_store; ?>">
                                <?php endif;?>
                                </td> 
                                <td>
                                </td>       
                            </tr>
                            <?php if(!empty($migrations)):?>
                                <?php foreach($migrations as $migration):?>
                                <?php 
                                    $store_code = $migration->store_code;
                                    $count = $this->Migration_model->migration_count($store_code);    
                                ?>
                                    <tr>
                                        <td><?php echo $migration->store_code;?></td>
                                        <td><?php echo $migration->store_description;?></td>
                                        <td><?php echo $count;?></td>
                                        <td><a href="<?php echo base_url();?>index.php/migration/post/<?php echo $migration->store_code;?>/-1"><button class="btn btn-success btn-block">POST</button></a></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                            
                        </tbody>
                        
                    </table>
                    <?php echo $this->pagination->create_links(); ?>  
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
