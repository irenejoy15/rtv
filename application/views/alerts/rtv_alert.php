<script>
  $(function() {
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        <?php if($this->session->flashdata('Invalid File Extension')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: 'Invalid File Extension<br>Please Upload with a file extension of .xlsx, .xls or .csv.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('No File Uploaded')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: 'Please upload a file with a file extension of .xlsx, .xls or .csv.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Uploading Wrong Format')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: 'Please upload a file with the correct Format.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('File Successfully Uploaded')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'RTV',
                body: 'File Successfully Uploaded.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Item Received')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'RTV',
                body: 'Item Received.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Lot Does Not Exist')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: '<?php echo $this->session->flashdata('Lot Does Not Exist');?>.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Qty Exceeded')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: '<?php echo $this->session->flashdata('Qty Exceeded');?>.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('RTV Detail Successfully Deleted')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'RTV',
                body: '<?php echo $this->session->flashdata('RTV Detail Successfully Deleted');?>.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('RTV Already Migrated')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: '<?php echo $this->session->flashdata('RTV Already Migrated');?>.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Successfully Download')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'RTV',
                body: '<?php echo $this->session->flashdata('Successfully Download');?>.'
            })
        <?php endif;?>
        
        <?php if($this->session->flashdata('You Have No Access To This Content')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: 'You Have No Access To This Content.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('There is No Store Code')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: 'There is No Store Code.'
            })
        <?php endif;?>

    });
</script>
