
<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
Surat Masuk
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="mail"></i><i data-feather="arrow-right"></i></div>
                            Data Surat Masuk
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Data :
                        <div>
                            <?php ($status_condition=1); ?>
                            <a class="btn btn-sm btn-danger" href="<?php echo e(route('surat-masuk-terhapus', $status_condition)); ?>">
                                <i data-feather="trash-2"></i> &nbsp;
                                Data Terhapus
                            </a>
                            <a class="btn btn-sm btn-warning" href="<?php echo e(route('letter.create')); ?>">
                                <i data-feather="plus-square"></i> &nbsp;
                                Tambah Surat
                            </a>
                            <a class="btn btn-sm btn-success" href="<?php echo e(route('print-surat-masuk')); ?>" target="_blank">
                                <i data-feather="printer"></i> &nbsp;
                                Cetak Laporan
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <?php if(session()->has('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
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
                        
                        <div class="table table-responsive">
                            <table class="table table-striped table-hover table-sm" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Masuk</th>
                                        <th>No. Surat</th>
                                        <th>Sifat Surat</th>
                                        <th>Perihal</th>
                                        <th>Jenis Pengirim</th>
                                        <th>Pengirim</th>
                                        
                                        
                                        
                                        <th>Direksi / Karyawan Tujuan</th>                         
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow-auto;">
        <div class="modal-dialog" role="document" style="max-width:64%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Tambah Disposisi / Eskalasi</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('disposisi.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body overflow-auto">
                        <div class="mb-3">
                            <div class="col-md-12">
                                <?php $__currentLoopData = $letters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="letter_id" value=<?php echo e($letter->id); ?>>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <label for="post_id"><b>Jenis Surat</b></label>
                                <select class="form-control">
                                    <option value="Surat Masuk" >Surat Masuk</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                
                                <label for="post_id"><b>Asal Unit</b></label>
                                <select class="form-control" id="asal_unit" data-placeholder="pilih unit" required>
                                    <option>== Pilih Unit ==</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php echo e((old('department_id') == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-bottom:30px">
                                
                                <label for="post_id"><b>Asal Direksi / Karyawan</b></label>
                                <select class="form-control" name="asal_disposisi" id="asal_direksi_karyawan" data-placeholder="pilih unit" required>
                                    <option>== Pilih Direksi / Karyawan ==</option>
                                        
                                </select>
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
                        </div><hr style="border-top: 2px dotted black; width:90%; margin: 0 auto;">
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-top: 20px">
                                
                                <label for="post_id"><b>Tujuan Unit</b></label>
                                <select class="form-control" id="tujuan_disposisi" data-placeholder="pilih unit" required style="width: 100%">
                                    <option>== Tujuan Unit ==</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php echo e((old('department_id') == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                
                                <label for="post_id"><b>Tujuan Direksi / Karyawan</b></label>
                                <select class="form-control" name="tujuan_disposisi" id="direksi_tujuan" data-placeholder="pilih unit" required>
                                    <option>---Pilih Direksi / Karyawan---</option>
                                    
                                        
                                </select>
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
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Isi Disposisi / Eskalasi</b></label>
                                
                                <textarea type="text" name="isi_disposisi" class="form-control disposisi-desc" placeholder="Masukkan isi Disposisi.." required style="height: 100px; width:770px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-script'); ?>
<script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '<?php echo url()->current(); ?>',
            // type:'GET',
            // dataType:'json'
        },
        columns: [{
                "data": 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'letter_date',
                name: 'letter_date',
                width: '10%'
            },
            {
                data: 'letter_no',
                name: 'letter_no'
            },
            {
                data: 'letter_char',
                name: 'letter_char',
                width: '10%'
            },
            {
                data: 'regarding',
                name: 'regarding'
            },
            {
                data: 'sender_type',
                name: 'sender_type'
            },
            {
                data: 'sender_name',
                // data: 'sender_internal',
                name: 'sender_name'
            },
            // {
            //     data: 'unit_sender_internal',
            //     name: 'unit_sender_internal',
            // },
            // {
            //     data: 'sender_name_internal',
            //     name:'sender_name_internal'
            // },
            {
                data: 'employee.nama',
                name: 'employee.nama'
            },
            // {
            //     data:'employee.position',
            //     name: 'employee.position'
            // },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: true,
                width: '15%'
            },
            
        ]
    });
    
$(document).ready(function(){
    $('#tujuan_disposisi').change(function() {
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
                        $("#direksi_tujuan").empty();
                        $("#direksi_tujuan").append('<option>---Pilih Direksi / Karyawan---</option>');
                        $.each(response, function(id, value) {
                            $("#direksi_tujuan").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                        });
                    } else {
                        $("#direksi_tujuan").empty();
                    }
                }
            });
    });
});
    
// yang buat asal direksi dan unit (bagian disposisi)
$(document).ready(function(){
    $('#asal_unit').change(function() {
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
                        $("#asal_direksi_karyawan").empty();
                        $("#asal_direksi_karyawan").append('<option>---Pilih Direksi / Karyawan---</option>');
                        $.each(response, function(id, value) {
                            $("#asal_direksi_karyawan").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                        });
                    } else {
                        $("#direksi_tujasal_direksi_karyawanuan").empty();
                    }
                }
            });
        // } else {
        //     $("#direksi_tujuan").empty();
        // }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/letter/incoming.blade.php ENDPATH**/ ?>