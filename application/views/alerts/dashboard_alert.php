<script>
  $(function() {
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        <?php if($this->session->flashdata('You Have No Access To This Content')):  ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Login',
                body: 'You Have No Access To This Content.'
            })
        <?php endif;?>

    });
</script>
