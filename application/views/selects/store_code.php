<script>
    base_url = "<?php  echo base_url();?>";
    $(document).ready(function(){

        $("#store_code").select2({
            placeholder: "STORE CODE",
            ajax: {
                url: base_url+"index.php/migration/store_code_ajax/",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                    searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                    results: response
                    };
                },
                cache: true
            }
        });

       
        $('#store_code').on('select2:select', function (e) {
            var store_code = $("#store_code").val();
            // var data = e.params.data;
            // var store_description = data.id;
                $.ajax({
                    type: 'GET',
                    url: base_url+"index.php/migration/address_ajax/"+store_code
                    }).then(function (result){
                        $('#address').html(result);
                });

                $.ajax({
                    type: 'GET',
                    url: base_url+"index.php/migration/store_description_ajax_now/"+store_code
                    }).then(function (result){
                        $('#store_top').html(result);
                });

         
                var table = $('#migration').DataTable( {
            
                "ajax": {
                    url: base_url+"index.php/migration/rtvs_ajax/"+store_code,
                        type : 'GET',
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
                document.getElementById('button_submit').style.display='block';
            
            table.clear().destroy();
            table.draw();
            
        });

      
        
    });

</script>
