

<script>
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $.fn.dataTable.ext.errMode = 'none';
    var base_url = "<?php echo base_url();?>";
    var table = $('#rtv_table').DataTable( {
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
              "ajax": {
        	            url : base_url+"index.php/monitoring/rtv_ajax",
        	            type : 'POST',
                        dataType: "json",
                        data: function(data){
                            data.column0_search = $('#column0_search').val();
                            data.column1_search = $('#column1_search').val();
                            data.column2_search = $('#column2_search').val();
                            data.column3_search = $('#column3_search').val();
                            data.column4_search = $('#column4_search').val();
                            data.column5_search = $('#column5_search').val();
                            data.column6_search = $('#column6_search').val();
                            data.column7_search = $('#column7_search').val();
                            data.column8_search = $('#column8_search').val();
                            data.column9_search = $('#column9_search').val();
                            data.column10_search = $('#column10_search').val();
                         },
        	            },
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
              "info": true,
              "autoWidth": true,
              "scrollY":  "300px",
              "scrollX": true,
                        
            });
      
              $('#reset').on( 'click', function () {
                table.search('').columns().search('').draw();
                $("#column0_search").val("");
                $("#column1_search").val("");
                $("#column2_search").val("");
                $("#column3_search").val("");
                $("#column4_search").val("");
                $("#column5_search").val("");
                $("#column6_search").val("");
                $("#column7_search").val("");
                $("#column8_search").val("");
                $("#column9_search").val("");
                $("#column10_search").val("");
                $("#column11_search").val("");
              });

              $('#column0_search').on( 'keyup', function () {
              table
                  .draw();
              } );
              $('#column2_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column1_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column3_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column4_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column5_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column6_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column7_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column8_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column9_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column10_search').on( 'keyup', function () {
              table
                  .draw();
              });
              $('#column11_search').on( 'keyup', function () {
              table
                  .draw();
              });
              table.ajax.reload();


} );


</script>
