

<?php $__env->startSection('main'); ?>
<main>
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <!-- Basic login form-->
                <div class="card card-login border-0 rounded-lg mt-5" id="shadow-login">
                    <!-- <div class="card-header justify-content-center">

                    </div> -->
                    <br>
                    <div class="col-xl-4 col-xxl-12 text-center d-flex mt-3" style="margin-left: 45px">
                        <img class="img-fluid" src="/admin/assets/img/logo_rs.jpg"width="50px"/>
                        <h3 class="mt-3" style="font-size: 28px; margin-left: 14px; font-color: #232857"><b>SeTIA</b></h3> 
                    </div>
                    <div style="margin-left:-13px">
                        <p class="text-center mt-3" style="font-size: 14px">Masukkan informasi pengguna Anda</p>
                    </div>
                    <div class="card-body">
                        <?php if(session()->has('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        <?php if(session()->has('loginError')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo e(session('loginError')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        <!-- Login form-->
                        <form action="/login" method="post" class="container">
                            <?php echo csrf_field(); ?>
                            <!-- Form Group (email address)-->
                            <div class="mb-3" style="margin-top:-15px">
                                <label class="small mb-1" for="email"><b>Email</b></label>
                                <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" placeholder="Enter email address" autofocus required />
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- Form Group (password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="password"><b>Password</b></label>
                                <input class="form-control" id="password" name="password" type="password" placeholder="Enter password" required />
                            </div>
                            <!-- Form Group (remember password checkbox)-->
                            
                            <!-- Form Group (login box)-->
                            <div class="align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="#">

                                </a>
                                <button type="submit" class="btn btn-primary btn-login">Login</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/auth/login.blade.php ENDPATH**/ ?>