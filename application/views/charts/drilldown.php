<script>

  function submitForm() {
    
    var base_url = '<?php echo base_url();?>';
    var myCheckboxes = new Array();
        $("input:checked").each(function() {
        myCheckboxes.push($(this).val());
    });

    var formData = {
      checks: myCheckboxes
    };
      var table = $('#drilldown').DataTable( {
           
           "ajax": {
               url: base_url+"index.php/dashboard/drilldown_ajax/",
                   type : 'POST',
                   data: formData,
                   dataType: "json"
                   },
                   
           "paging": false,
           "lengthChange": false,
           "searching": true,
           "ordering": false,
           "info": true,
           "autoWidth": true,
           "scrollX": true,
           "orderCellsTop": true,
          
           "deferRender": true
           } );
          
       table.destroy();
       table.draw();
       
       $.ajax({
            type: 'POST',
            data: formData,
           
            url: base_url+"index.php/dashboard/drilldown_ajax_chart2/"
            }).then(function (bar_graph){
              console.log(bar_graph);
              $("#divGraph").html(bar_graph);
              $("#graph").chart = new Chart($("#graph"), $("#graph").data("settings"));
        
        });

     

   }


</script>
