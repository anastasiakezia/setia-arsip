

<?php $__env->startSection('title'); ?>
    Profile Pengguna
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Pengguna - Informasi Akun
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link <?php echo e((request()->is('admin/setting')) ? 'active ms-0' : ''); ?>" href="<?php echo e(route('setting.index')); ?>">Profil</a>
                <a class="nav-link <?php echo e((request()->is('admin/setting/change-password')) ? 'active ms-0' : ''); ?>" href="<?php echo e(route('change-password')); ?>">Ubah Password</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col">
                     <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <?php if($user->profile != NULL): ?>
                                <img class="img-account-profile rounded-circle mb-2" src="<?php echo e(Storage::url($user->profile)); ?>" alt="" />
                            <?php else: ?>
                                <img class="img-account-profile rounded-circle mb-2" src="https://ui-avatars.com/api/?name=<?php echo e($user->name); ?>" alt="" />
                            <?php endif; ?>
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG atau PNG tidak lebih besar dari 1 MB</div>
                            <!-- Profile picture upload button-->
                            <form action="<?php echo e(route('profile-upload')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                <input
                                  type="file"
                                  id="profile"
                                  name="profile"
                                  style="display: none;"
                                  onchange="form.submit()"
                                />    
                                <button class="btn btn-primary" type="button" onclick="thisFileUpload();">Unggah Photo</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Informasi Akun</div>
                        <div class="card-body">
                            
                            <?php if(session()->has('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(session('success')); ?>

                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(route('user.update', $user->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Nama</label>
                                    <input class="form-control" name="name" type="text" value="<?php echo e($user->name); ?>" required/>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" name="email" type="email" placeholder="name@example.com" value="<?php echo e($user->email); ?>" required/>
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Perbarui Profil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-script'); ?>
    <script>
        function thisFileUpload() {
            document.getElementById("profile").click();
        }
    </script> 
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/user/profile.blade.php ENDPATH**/ ?>