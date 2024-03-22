<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/sweetalert3.css">
	    <script src="<?php echo base_url();?>assets/dist/js/sweetalert-dev.js"></script>  
    </head>
    <body style="background-color:#454d55;"> 
        <script>
        window.setTimeout(function() {
            document.forms["irene"].submit();
        }, 500);
        </script>
        <form action="<?php echo base_url();?>uploads/migration.xlsx" name="irene"></form>
        <?php $this->session->set_flashdata('Successfully Download','Successfully Download'); ?>

        
        <script type="text/javascript">
		swal({
			title: "Success!",
			text: "Downloaded successfully!",
			type: "success",
			timer: 1000,
			showConfirmButton: false
			}, function(){
                window.history.go(-1);
		});

	</script>
    </body>
</html>