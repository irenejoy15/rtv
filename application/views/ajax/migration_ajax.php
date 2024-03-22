<script>
  $(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'none';
    var base_url = "<?php echo base_url();?>";
    var table = $('#migrations_table').DataTable( {
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "ajax": {
              url : base_url+"index.php/migration/migration_ajax",
	          type : 'POST',
              dataType: "json"
	            },
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
      "scrollX": true,
      "orderCellsTop": true,
      "fixedHeader": true,

    } );
    table.ajax.reload();
} );
</script>
