

<?php $__env->startSection('title'); ?>
Disposisi / Eskalasi Lanjutan
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
                            Disposisi / Eskalasi Lanjutan
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali Ke Semua Surat
                        </button>
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
        <form action="<?php echo e(route('disposisi.update', $item->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row gx-4">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">Form Disposisi / Eskalasi Lanjutan <span style="color: green;"> * Harus diisi</span></div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="letter_id" class="col-sm-3 col-form-label">No. Surat</label>
                                <div class="col-sm-9">
                                    <input class ="form-control" type="text" name="letter_id" value=<?php echo e($item->letter->letter_no); ?> disabled>
                                    
                                </div>
                                <?php $__errorArgs = ['letter_id'];
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
                                <label for="post_id" class="col-sm-3 col-form-label">Pilih Jenis <br> Pengiriman Surat</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline mt-4">
                                        <input class="form-check-input" type="radio" name="status_surat" id="inlineRadio1" value="0" <?php echo e($item->status_surat == 'Disposisi' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="inlineRadio1">Disposisi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_surat" id="inlineRadio2" value="1">
                                        <label class="form-check-label" for="inlineRadio2">Eskalasi</label>
                                    </div>
                                    <?php $__errorArgs = ['catatan_rektor'];
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
                            </div>
                            <div class="mb-3 row">
                                <label for="post_id" class="col-sm-3 col-form-label">Asal Unit</label>
                                <div class="col-sm-9">
                                    <select class="form-control single-select-field" id="asal_unit" data-placeholder="Pilih Direksi/Karyawan" required>
                                        
                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($department->id); ?>" <?php echo e(($item->asalDisposisi->department->id == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['department_id'];
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
                                <label for="sender_name" class="col-sm-3 col-form-label">Asal Direksi / Karyawan <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select class="form-control single-select-field" id="asal_direksi_karyawan" data-placeholder="Pilih Direksi/Karyawan" required>
                                        <option>== Pilih Direksi/Karyawan ==</option>
                                            
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="post_id" class="col-sm-3 col-form-label">Unit Tujuan</label>
                                <div class="col-sm-9">
                                    <select class="form-control single-select-field" id="tujuan_unit" data-placeholder="Pilih Unit" required>
                                        <option>== Pilih Unit ==</option>
                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($department->id); ?>" <?php echo e(($item->tujuanDisposisi->department->id == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['department_id'];
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
                                <label for="sender_name" class="col-sm-3 col-form-label">Direksi / Karyawan Tujuan <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select class="form-control single-select-field" id="tujuan_direksi_karyawan" data-placeholder="Pilih Direksi/Karyawan" required>
                                        <option>== Pilih Direksi/Karyawan ==</option>
                                            
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="isi_disposisi" class="col-sm-3 col-form-label">Isi Disposisi/Eskalasi</label>
                                <div class="col-sm-9">
                                    <textarea id="isi_disposisi" class="form-control <?php $__errorArgs = ['isi_disposisi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="isi_disposisi" placeholder="Isi Disposisi/Eskalasi.." required><?php echo e(old('catatan_rektor', $item->isi_disposisi)); ?></textarea>
                                </div>
                                <?php $__errorArgs = ['isi_disposisi'];
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-style'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('addon-script'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // yang buat asal direksi dan unit (bagian disposisi)
    // $(document).ready(function(){
    //     $('#asal_unit').change(function() {
    //         var id = $(this).val();
    //         // if (id) {
    //             $.ajax({
    //                 type: "GET",
    //                 // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
    //                 url:'<?php echo e(route('karyawan.dropdown')); ?>',
    //                 data:{id:id},
    //                 dataType: 'JSON',
    //                 success: function(response) {
    //                     if (response) {
    //                         $("#asal_direksi_karyawan").empty();
    //                         $("#asal_direksi_karyawan").append('<option>---Pilih Direksi / Karyawan---</option>');
    //                         $.each(response, function(id, value) {
    //                             $("#asal_direksi_karyawan").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
    //                         });
    //                     } else {
    //                         $("#direksi_tujasal_direksi_karyawanuan").empty();
    //                     }
    //                 }
    //             });
    //         // } else {
    //         //     $("#direksi_tujuan").empty();
    //         // }
    //     });
    // });

    // ASAL UNIT DISPOSISI
    $(document).ready(function(){
        $('#asal_unit').change(function() {
            var id = $(this).val();
            console.log("Nilai dari #asal_unit: " + id);
            if (id) {
                $.ajax({
                    type: "GET",
                    url: '<?php echo e(route("getDropdownKaryawan", ":asal_unit")); ?>'.replace(':asal_unit', id),
                    dataType: 'JSON',
                    success: function(response) {
                        // Kosongkan dropdown sebelum menambahkan opsi baru
                        $("#asal_direksi_karyawan").empty();
                        
                        // Tambahkan opsi default
                        $("#asal_direksi_karyawan").append('<option value="">---Pilih Direksi / Karyawan---</option>');
                        
                        // Tambahkan opsi karyawan baru ke dropdown
                        $.each(response.karyawan, function(id, value) {
                            $("#asal_direksi_karyawan").append('<option value="' + value.id + '">' + value.nama +'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Tampilkan pesan error jika terjadi kesalahan
                    }
                });
            } else {
                // Kosongkan dropdown jika tidak ada nilai yang dipilih
                $("#asal_direksi_karyawan").empty();
            }
        });
    });
    // END ASAL UNIT DISPOSISI

    // ASAL DIREKSI/KARYAWAN
    $(document).ready(function() {
        // Fungsi untuk memuat daftar karyawan berdasarkan unit internal
        function loadEmployeesByDepartment(asal_unit) {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(route("getDropdownKaryawan", ":asal_unit")); ?>'.replace(':asal_unit', asal_unit),
                dataType: 'json',
                success: function(response) {
                    // $('#karyawandireksi_pengirim').empty(); // Kosongkan dropdown karyawan
                    console.log(response);
                    $("#asal_direksi_karyawan").append('<option>...Surat ditujukan ke...</option>');
                    // Iterasi melalui data karyawan dan tambahkan ke dropdown
                    $.each(response.karyawan, function(index, emp) {
                        $('#asal_direksi_karyawan').append($('<option>', {
                            value: emp.id,
                            text: emp.nama,
                            selected: emp.id == "<?php echo e($item->asal_disposisi); ?>"
                        }));
                    });
                }
            });
        }
        
        // Panggil fungsi untuk memuat daftar karyawan saat dokumen siap
        var selectedValue = $('#asal_unit').val();
        console.log("asal "+selectedValue)
        loadEmployeesByDepartment(selectedValue);
    });
    // END ASAL DIREKSI/KARYAWAN 

     // TUJUAN UNIT
    $(document).ready(function(){
        $('#tujuan_unit').change(function() {
            var id = $(this).val();
            console.log("Nilai dari #tujuan_unit: " + id);
            if (id) {
                $.ajax({
                    type: "GET",
                    url: '<?php echo e(route("getDropdownKaryawan", ":tujuan_unit")); ?>'.replace(':tujuan_unit', id),
                    dataType: 'JSON',
                    success: function(response) {
                        // Kosongkan dropdown sebelum menambahkan opsi baru
                        $("#tujuan_direksi_karyawan").empty();
                        
                        // Tambahkan opsi default
                        $("#tujuan_direksi_karyawan").append('<option value="">---Pilih Direksi / Karyawan---</option>');
                        
                        // Tambahkan opsi karyawan baru ke dropdown
                        $.each(response.karyawan, function(id, value) {
                            $("#tujuan_direksi_karyawan").append('<option value="' + value.id + '">' + value.nama +'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Tampilkan pesan error jika terjadi kesalahan
                    }
                });
            } else {
                // Kosongkan dropdown jika tidak ada nilai yang dipilih
                $("#tujuan_direksi_karyawan").empty();
            }
        });
    });
    // END TUJUAN UNIT

    // DIREKSI/KARYAWAN TUJUAN
    $(document).ready(function() {
        // Fungsi untuk memuat daftar karyawan berdasarkan unit internal
        function loadEmployeesByDepartment(tujuan_unit) {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(route("getDropdownKaryawan", ":tujuan_unit")); ?>'.replace(':tujuan_unit', tujuan_unit),
                dataType: 'json',
                success: function(response) {
                    // $('#karyawandireksi_pengirim').empty(); // Kosongkan dropdown karyawan
                    console.log(response);
                    $("#tujuan_direksi_karyawan").append('<option>...Surat ditujukan ke...</option>');
                    // Iterasi melalui data karyawan dan tambahkan ke dropdown
                    $.each(response.karyawan, function(index, emp) {
                        $('#tujuan_direksi_karyawan').append($('<option>', {
                            value: emp.id,
                            text: emp.nama,
                            selected: emp.id == "<?php echo e($item->tujuan_disposisi); ?>"
                        }));
                    });
                }
            });
        }
        
        // Panggil fungsi untuk memuat daftar karyawan saat dokumen siap
        var selectedtujuan = $('#tujuan_unit').val();
        console.log("department "+selectedtujuan)
        loadEmployeesByDepartment(selectedtujuan);
    });
    // END DIREKSI/KARYAWAN TUJUAN

    //SEARCH DROPDOWN
    $(document).ready(function(){
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        });
    });

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/disposisi/edit.blade.php ENDPATH**/ ?>