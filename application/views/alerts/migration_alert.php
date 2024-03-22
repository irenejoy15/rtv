<script>
  $(function() {
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

    
        <?php if($this->session->flashdata('Migration Successful')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'RTV',
                body: 'Migration Successful.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Migration is Empty')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: 'Migration is Empty.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('The Rtv Numbers were already migrated')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: 'The Rtv Numbers were already migrated.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Successfully Download')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'RTV',
                body: '<?php echo $this->session->flashdata('Successfully Download');?>.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('The Rtv Numbers must be below 9')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'RTV',
                body: '<?php echo $this->session->flashdata('The Rtv Numbers must be below 9');?>.'
            })
        <?php endif;?>
        
        

    });
</script>
