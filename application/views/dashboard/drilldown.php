<style>
  .chart{
  min-width:300px;
}
</style>
<section class="content  mt-5">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->

    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              RTV
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
       
            <div class="row">
            
              <div class="col-sm-3">
                <div class="row">
              
                <?php foreach($rtvs as $rtv):?>
                  <div class="col-sm-6">
                      <input id="checks"  onchange="return submitForm()" type="checkbox" value="<?php echo $rtv->rtv_number;?>"><?php echo $rtv->rtv_number;?>  <br>
                  </div>
                  <?php endforeach;?> 
                </div>
              
                
            </div>
            <div class="col-sm-9" id="divGraph">
                
            </div>
          

            <div class="row">
                  
                    <div class="col-sm-6">
                      <table id="table_header" class="table table-bordered table-hover verticalDisplay" style="table-layout:fixed; width:100%; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                         
                          <tbody>
                            <tr>
                                <td>RTV NUMBER</td>                  
                                <td>RTV COUNT</td>
                               
                            </tr>
                          </tbody>
                          
                      </table>

                      <table id="drilldown" class="table table-bordered table-hover verticalDisplay" style="table-layout:fixed; width:100%; font-size:13px; text-transform:uppercase;white-space:nowrap;">
                          <thead>
                          <tr>
                              <th style="visibility:hidden;"></th>                  
                              <th style="visibility:hidden;"></th>
                             
                          </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                          
                      </table>
                    
                    </div>
                  </div>
            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active">
                
               </div>

            </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>

    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
