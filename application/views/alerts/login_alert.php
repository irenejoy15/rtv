<script>
  $(function() {
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        <?php if($this->session->flashdata('User Does Not Exist')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Login',
                body: 'User Does Not Exist Please Contact the IT Department.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Please Relogin Now')):  ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Login',
                body: 'Please Relogin Your Details Was Successfully Updated.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('User Disabled')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Login',
                body: 'User Disabled Please Contact the IT Department.'
            })
        <?php endif;?>

        <?php if($this->session->flashdata('Login Failed')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Login',
                body: 'Your password is incorrect Please Contact the IT Department.'
            })
        <?php endif;?>

    });
</script>
