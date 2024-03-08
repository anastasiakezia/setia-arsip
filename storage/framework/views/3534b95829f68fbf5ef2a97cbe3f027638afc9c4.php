

<?php $__env->startSection('title'); ?>
Tambah Surat
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file-text"></i></div>
                            Tambah Surat Masuk
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="<?php echo e(route('surat-masuk')); ?>">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali ke Semua Disposisi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
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
        <form action="<?php echo e(route('letter.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row gx-4">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">Form Surat</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="letter_type" class="col-sm-3 col-form-label">Jenis Surat</label>
                                <div class="col-sm-9">
                                    <select name="letter_type" class="form-control" required>
                                        <option value="Surat Masuk" <?php echo e((old('letter_type') == 'Surat Masuk')? 'selected':''); ?>>Surat Masuk</option>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['letter_type'];
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
                            <div class="mb-3 row">
                                <label for="letter_date" class="col-sm-3 col-form-label">Tanggal Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="date" id="todayDate" class="form-control <?php $__errorArgs = ['letter_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('letter_date')); ?>" name="letter_date" required>
                                    <script>
                                        document.getElementById("todayDate").valueAsDate = new Date();
                                    </script>
                                </div>
                                <?php $__errorArgs = ['letter_date'];
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
                            <div class="mb-3 row">
                                <label for="letter_no" class="col-sm-3 col-form-label">No. Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    
                                    
                                    
                                    <input type="text" name="letter_no" class="form-control" id="nomor_surat" placeholder="No Surat...">
                                    
                                    <span class="col-sm-12 col-form-label" id="no_surat_error" style="color:red; margin-left:5px;"></span>
                                        <script>
                                            // jQuery
                                            $('#nomor_surat').on('blur', function() {
                                                var noSurat=$(this).val();

                                                $.ajax({
                                                    type:'GET',
                                                    url:'<?php echo e(url("admin/letter/check_no_surat")); ?>',
                                                    data:{'letter_no':noSurat},
                                                    dataType:'json',
                                                    success: function(response) {
                                                        if (response.is_duplicate) {
                                                            $('#no_surat_error').text('Nomor surat sudah ada di database');
                                                        }else{
                                                            $('#no_surat_error').text('Nomor surat belum ada di database');
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                </div>
                                <?php $__errorArgs = ['letter_no'];
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
                            <div class="mb-3 row">
                                <label for="letter_char" class="col-sm-3 col-form-label">Sifat Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="letter_char" class="form-control" id="letter_char" required>
                                        <option value="">Pilih Sifat Surat..</option>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Rahasia">Rahasia</option>
                                        <option value="Segera">Segera</option>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['letter_char'];
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
                            <div class="mb-3 row">
                                <label for="letter_name" class="col-sm-3 col-form-label">Nama Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['letter_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('letter_name')); ?>" name="letter_name" placeholder="Nama Surat.." required>
                                </div>
                                <?php $__errorArgs = ['letter_name'];
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
                            <div class="mb-3 row">
                                <label for="regarding" class="col-sm-3 col-form-label">Perihal <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['regarding'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('regarding')); ?>" name="regarding" placeholder="Perihal.." required>
                                </div>
                                <?php $__errorArgs = ['regarding'];
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
                            <div class="mb-3 row">
                                <label for="sender_type" class="col-sm-3 col-form-label">Jenis Pengirim <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="sender_type" id="sender_type" class="form-control" required>
                                        <option value='' selected disabled>Pilih Asal Surat</option>
                                        <option value="Eksternal">Eksternal</option>
                                        <option value="Internal">Internal</option>
                                    <select>                                                                      
                                    
                                </div>
                                <?php $__errorArgs = ['sender_type'];
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
                            
                            <div class="mb-3 row" id="eksternal_fields" style="display: none">
                                <label for="sender_name_eksternal" class="col-sm-3 col-form-label">Pengirim Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['sender_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('sender_name')); ?>" name="sender_name" placeholder="Nama / Instansi Pengirim..">
                                </div>
                                <?php $__errorArgs = ['sender_name'];
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
                            
                            <div class="mb-3 row" id="pengirim_internal_unit" style="display: none">
                                <label for="unit_sender_internal" class="col-sm-3 col-form-label">Unit Pengirim<b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="pengirim_unit_internal" id="unit_pengirim" class="form-control">
                                        <option value="">Pilih Unit Pengirim...</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php echo e((old('pengirim_unit_internal') == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['pengirim_unit_internal'];
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
                            <div class="mb-3 row" id ="pengirim_internal_karyawandireksi" style="display: none">
                                <label for="sender_name" class="col-sm-3 col-form-label">Pengirim <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="sender_name" id="karyawandireksi_pengirim" class="form-control">
                                        <option selected disabled>..Nama Pengirim...</option>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['sender_name'];
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
                            
                            
                            
                            <div class="mb-3 row">
                                <label for="unit_tujuan" class="col-sm-3 col-form-label">Unit Tujuan<b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="unit_sender_internal" id="unit_id" class="form-control" required>
                                        <option value="">Pilih Unit Tujuan...</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="mb-3 row">
                                <label for="karyawan_tujuan" class="col-sm-3 col-form-label">Kepada <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="employees_id_destination" id="kepada" class="form-control" required>
                                        <option selected disabled>..Surat ditujukan ke...</option>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['employees_id_destination'];
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
                            
                            <div class="mb-3 row">
                                <label for="letter_file" class="col-sm-3 col-form-label">File <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?php $__errorArgs = ['letter_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('letter_file')); ?>" name="letter_file" required>
                                    <div id="letter_file" class="form-text">Ekstensi .pdf | <span style="color: blue;"> * Harus diisi</span></div>
                                </div>
                                <?php $__errorArgs = ['letter_file'];
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
                            <div class="mb-3 row">
                                <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-style'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('addon-script'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".selectx").select2({
        theme: "bootstrap-5"
    });

//TUJUAN
    $(document).ready(function(){
        $('#unit_id').change(function() {
            var id = $(this).val();
            // if (id) {
                $.ajax({
                    type: "GET",
                    // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
                    url:'<?php echo e(route('karyawan.dropdown')); ?>',
                    data:{id:id},
                    dataType: 'JSON',
                    success: function(response) {
                        if (response) {
                            $("#kepada").empty();
                            $("#kepada").append('<option>...Surat ditujukan ke...</option>');
                            $.each(response, function(id, value) {
                                $("#kepada").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                            });
                        } else {
                            $("#kepada").empty();
                        }
                    }
            });
        });
    });

    // bagian pengirim surat
    // $(document).ready(function(){
    //     $('#jenis_pengirim').change(function() {
    //         var point = $(this).val();
    //         if(point == "Eksternal"){
    //             $('#after_jenis_surat_filled').html(
    //                 '<div class="mb-3 row"><label for="sender_name" class="col-sm-3 col-form-label">Pengirim Surat<b style="color: red">*</b></label><div class="col-sm-9"><input input="text" class="form-control"></input></div></div>'
    //             );
    //         }else if(point == "Internal"){
    //             $('#after_jenis_surat_filled').html('<div class="col-sm-9"><select><option value=1>satu</option></select></div>');
    //         }
    //     });
    // });

    // bagian pengirim surat
    $(document).ready(function(){
        $('#sender_type').change(function() {
            var point = $(this).val();
            if(point == "Eksternal"){
                $('#eksternal_fields').show();
                $('#pengirim_internal_unit').hide();
                $('#pengirim_internal_karyawandireksi').hide();
            }else {
                $('#eksternal_fields').hide();
                $('#pengirim_internal_unit').show();
                $('#pengirim_internal_karyawandireksi').show();
                $('#unit_pengirim').change(function(){
                    var id = $(this).val();
                    $.ajax({
                        type: "GET",
                        // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
                        url:'<?php echo e(route('karyawan.dropdown')); ?>',
                        data:{id:id},
                        dataType: 'JSON',
                        success: function(response) {
                            if (response) {
                                $("#karyawandireksi_pengirim").empty();
                                $("#karyawandireksi_pengirim").append('<option>...Nama Pengirim...</option>');
                                $.each(response, function(id, value) {
                                    $("#karyawandireksi_pengirim").append('<option value="' + value.nama + '">' + value.nama + ' - '+value.position+'</option>');
                                });
                            } else {
                                $("#karyawandireksi_pengirim").empty();
                            }
                        }
                    });
                })
            }

        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/letter/create.blade.php ENDPATH**/ ?>