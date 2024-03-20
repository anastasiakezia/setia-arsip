


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
                                        
                                        <th>Nama Pengirim</th>
                                        
                                        
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
    
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow-auto;" data-focus="false">
        <div class="modal-dialog modal-xl" role="document" style="max-width:64%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalDisposisi">Tambah Disposisi / Eskalasi</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="<?php echo e(route('disposisi.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body overflow-auto" >
                        <div class="mb-3">
                            <div class="col-md-12">
                                
                                <label for="post_id"><b>Jenis Surat</b></label>
                                <select name="letter_type" class="form-control" required>
                                    <option value="Surat Masuk" <?php echo e((old('letter_type') == 'Surat Masuk')? 'selected':''); ?>>Surat Masuk</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Pilih Jenis Pengiriman Surat<b style="color: red">*</b></b></label>
                                <div class="mb-3">
                                    <div class="col-md-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_surat" id="inlineRadio1" value="0">
                                            <label class="form-check-label" for="inlineRadio1">Disposisi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_surat" id="inlineRadio2" value="1">
                                            <label class="form-check-label" for="inlineRadio2">Eskalasi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Asal Unit</b><b style="color: red">*</b></label>
                                <select class="form-control single-select-field" id="asal_unit" data-placeholder="pilih unit" required style=" margin-top: 336px;">
                                    <option>== Pilih Unit ==</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php echo e((old('department_id') == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-bottom:30px" >
                                
                                <label for="post_id"><b>Asal Direksi / Karyawan</b><b style="color: red">*</b></label>
                                <select class="form-control single-select-field" name="asal_disposisi" id="asal_direksi_karyawan" data-placeholder="pilih unit" required>                                    
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
                                
                                <label for="post_id"><b>Tujuan Unit</b><b style="color: red">*</b></label>
                                <select class="form-control single-select-field" id="tujuan_disposisi" data-placeholder="pilih unit" required>                                    
                                        <option>== Tujuan Unit ==</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php echo e((old('department_id') == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                
                                <label for="post_id"><b>Tujuan Direksi / Karyawan</b><b style="color: red">*</b></label>
                                <select class="form-control single-select-field" name="tujuan_disposisi" id="direksi_tujuan" data-placeholder="pilih unit" required>
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
                                <label for="post_id"><b>Isi Disposisi / Eskalasi</b><b style="color: red">*</b></label>
                                
                                <textarea type="text" name="isi_disposisi" class="form-control disposisi-desc" placeholder="Masukkan isi Disposisi / Eskalasi.." required style="height: 100px; width:770px;"></textarea>
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
    

    
    <div class="modal fade" id="createModalTindak" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow-auto;">
        <div class="modal-dialog" role="document" style="max-width:64%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Tambah Tindak Lanjut</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('disposisi.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body overflow-auto" >
                        <div class="mb-3">
                            <div class="col-md-12">
                                <?php $__currentLoopData = $letters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="letter_id" value=<?php echo e($letter->id); ?>>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <label for="post_id"><b>Nomor Surat</b></label>
                                
                                    
                                    <input type="text" class="form-control <?php $__errorArgs = ['letter_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($letter->letter_no); ?>" name="letter_no" placeholder="No. Surat.." disabled>
                                
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                
                                <label for="post_id"><b>Unit</b></label>
                                <select class="form-control single-select-field" id="asal_unit_tindakLanjut" data-placeholder="pilih unit" required>
                                    <option>== Pilih Unit ==</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php echo e((old('department_id') == $department->id)? 'selected':''); ?>><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-bottom:30px">
                                
                                <label for="post_id"><b>Direksi / Karyawan</b></label>
                                <select class="form-control single-select-field" name="asal_disposisi" id="asal_direksi_karyawan_tindak_lanjut" data-placeholder="pilih unit" required>                                    <option>== Pilih Direksi / Karyawan ==</option>
                                        
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
                        
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Isi Tindak Lanjut</b></label>
                                
                                <textarea type="text" name="isi_disposisi" class="form-control disposisi-desc" placeholder="Masukkan isi Tindak Lanjut.." required style="height: 100px; width:770px;"></textarea>
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

<?php $__env->startPush('addon-style'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


<?php $__env->stopPush(); ?>


<?php $__env->startPush('addon-script'); ?>
<script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        // scrollX: true,
        scrollCollapse: true,
        autoWidth : true,
        fixedHeader: {
            header: true,
            // headerOffset: 20,
            },
        responsive:true,
        ajax: {
            url: '<?php echo url()->current(); ?>',
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
                name: 'letter_no',
                width: '10%'
            },
            {
                data: 'letter_char',
                name: 'letter_char',
            },
            {
                data: 'regarding',
                name: 'regarding',
                width: '10%'
            },
            {
                data: 'sender_type',
                name: 'sender_type',
            },
            {
                data: 'sender_name',
                // data: 'sender_internal',
                name: 'sender_name',
                width: '10%'
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
                name: 'employee.nama',
                width: '10%'
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
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
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
    // $('#createModalDisposisi').on('shown.bs.modal', function () {
    // });
    

    // yang buat asal direksi dan unit (bagian tindak lanjut)
    $(document).ready(function(){
        $('#asal_unit_tindakLanjut').change(function() {
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
                            $("#asal_direksi_karyawan_tindak_lanjut").empty();
                            $("#asal_direksi_karyawan_tindak_lanjut").append('<option>---Pilih Direksi / Karyawan---</option>');
                            $.each(response, function(id, value) {
                                $("#asal_direksi_karyawan_tindak_lanjut").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                            });
                        } else {
                            $("#direksi_tujasal_direksi_karyawanuan").empty();
                        }
                    }
                });
        });
    });

    // SEARCH DROPDOWN
    $(document).ready(function(){
        $('#createModal').on('shown.bs.modal', function (){
            $('#asal_unit').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
            $('#asal_direksi_karyawan').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
            $('#tujuan_disposisi').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
            $('#direksi_tujuan').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
        });
        });
    // END SEARCH DROPDOWN

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/letter/incoming.blade.php ENDPATH**/ ?>