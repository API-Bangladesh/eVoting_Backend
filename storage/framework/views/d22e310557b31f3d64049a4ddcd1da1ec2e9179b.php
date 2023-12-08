<script type="text/javascript">
    <?php if($errors->any()): ?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.warning("The given data was invalid.");
    <?php endif; ?>

    <?php if(session()->has('message')): ?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.success("<?php echo e(session('message')); ?>");
    <?php endif; ?>

    <?php if(session()->has('success')): ?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.success("<?php echo e(session('success')); ?>");
    <?php endif; ?>

    <?php if(session()->has('info')): ?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.info("<?php echo e(session('info')); ?>");
    <?php endif; ?>

    <?php if(session()->has('warning')): ?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.warning("<?php echo e(session('warning')); ?>");
    <?php endif; ?>

     <?php if(session()->has('error')): ?>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.error("<?php echo e(session('error')); ?>");
    <?php endif; ?>

    setTimeout(() => {
        $('.alert').slideUp(function () {
            $(this).remove();
        });
    }, 2000);
</script>
<?php /**PATH D:\laragon\www\eVoting_Backend\resources\views/common/alert-message.blade.php ENDPATH**/ ?>