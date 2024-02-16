<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> <?php echo e($title); ?> </title>
    <link rel="shortcut icon" href="/admin/assets/img/logo_rs.jpg">
    <link href="admin/css/styles.css" rel="stylesheet" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>
<style>
    #shadow-login {
        background-color: white;
    }
</style>

<body style="background-color: #E2E8F0">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <?php echo $__env->yieldContent('main'); ?>
        </div>
        <div id="layoutAuthentication_footer">
            <?php echo $__env->make('includes.auth-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo e(url('admin/js/scripts.js')); ?>"></script>
</body>

</html><?php /**PATH C:\laragon\www\arsip-iahn\resources\views/layouts/auth.blade.php ENDPATH**/ ?>