<script>
  $(function () {
    var base_url = "<?php echo base_url();?>";
    $('#users_table').DataTable({
      "ajax": {
	            url : base_url+"index.php/user/user_ajax",
	            type : 'GET'
	            },
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
      "scrollX": true,
      "deferRender": true
    });
  });
</script>
