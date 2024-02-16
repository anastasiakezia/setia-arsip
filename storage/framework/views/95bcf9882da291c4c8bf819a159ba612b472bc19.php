<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"> 
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <link rel="shortcut icon" href="/admin/assets/img/logo_rs.jpg">
        <?php echo $__env->yieldPushContent('prepend-style'); ?>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
            <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
            <link href="<?php echo e(url('/admin/css/styles.css')); ?>" rel="stylesheet" />
        <?php echo $__env->yieldPushContent('addon-style'); ?>
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <?php echo $__env->make('includes.navbar-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php echo $__env->make('includes.sidebar-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div id="layoutSidenav_content">
                <?php echo $__env->yieldContent('container'); ?>
                <?php echo $__env->make('includes.footer-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                
            </div>
        </div>
        <?php echo $__env->yieldPushContent('prepend-script'); ?>
            <script src="<?php echo e(url('/admin/js/jquery/jquery.min.js')); ?>"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="<?php echo e(url('/admin/js/scripts.js')); ?>"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
            <script src="<?php echo e(url('/admin/js/litepicker.js')); ?>"></script>
        <?php echo $__env->yieldPushContent('addon-script'); ?>
    </body>
</html>
<?php /**PATH C:\laragon\www\arsip-iahn\resources\views/layouts/admin.blade.php ENDPATH**/ ?>