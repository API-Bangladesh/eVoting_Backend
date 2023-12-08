<script type="text/javascript">
    @if($errors->any())
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.warning("The given data was invalid.");
    @endif

    @if(session()->has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if(session()->has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if(session()->has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if(session()->has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.warning("{{ session('warning') }}");
    @endif

     @if(session()->has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.error("{{ session('error') }}");
    @endif

    setTimeout(() => {
        $('.alert').slideUp(function () {
            $(this).remove();
        });
    }, 2000);
</script>
