<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<!--<![endif]-->
<!--[if gte IE 9] <style type="text/css"> .gradient {filter: none;}</style><![endif]-->
<!--[if !IE]><html lang="en"><![endif]-->
<html lang="en-US" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Required meta tags for responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<!-- Favicon and touch icons -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon/favicon-16x16.png')); ?>" />
	<meta name="misapplication-TileColor" content="#ffffff" />
	<meta name="theme-color" content="#ffffff" />
	<!-- Website title -->
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-icons.css')); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" />
	<!-- Main CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>" />
	<!-- jQuery (necessary for jQuery plugins) -->
	<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
</head>

<body>
	<!-- Main Coding Start Here -->
    <?php echo $__env->yieldContent('auth'); ?>


    	<!-- Main Coding End -->
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
	<!-- Script JS -->
	<script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
</body>

</html>

<?php /**PATH D:\laragon\www\eVoting_Backend\resources\views/auth/layout.blade.php ENDPATH**/ ?>