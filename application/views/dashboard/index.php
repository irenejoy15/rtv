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
              <i class="fas fa-chart-bar mr-1"></i>
              RTV
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <div class="row text-center" >
                <div class="col-md-12">
                <?php 
                  date_default_timezone_set('Asia/Manila');
		              $year = date('Y');
                ?>
                <h1 class="h1_dashboard">RTV MONITORING ON YEAR <?php echo $year;?></h1>
                </div>
              </div>
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active">
                  <canvas id="myChart" height="500px"></canvas>
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
