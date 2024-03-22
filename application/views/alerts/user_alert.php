<script>
  $(function() {
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        <?php if($this->session->flashdata('Email already exist')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'User',
                body: 'Email Already Exist Please Change Your Email.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('User already exist')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'User',
                body: 'User Already Exist Please Change Your Details.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('User Successfully Created')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'User',
                body: 'User Succesfully Created.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('User Successfully Updated')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'User',
                body: 'User Succesfully Updated.'
            })
        <?php endif;?>

    });
</script>
