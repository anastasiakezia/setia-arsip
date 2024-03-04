

<?php $__env->startSection('title'); ?>
Surat Disposisi
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="mail"></i></div>
                            Data Surat Disposisi
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
                            <a class="btn btn-sm btn-warning" href="<?php echo e(route('disposisi.create')); ?>">
                                <i data-feather="plus-square"></i> &nbsp;
                                Tambah Surat
                            </a>
                            <a class="btn btn-sm btn-success" href="<?php echo e(route('print-surat-disposisi')); ?>" target="_blank">
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
                            <table class="table table-striped table-hover table-sm table-responsive" id="disposisiTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>No.Surat</th>
                                        <th>Asal Unit</th>
                                        <th>Asal Direksi / Karyawan</th>
                                        <th>Tujuan Unit</th>
                                        <th>Tujuan Direksi / Karyawan</th>  
                                        <th>Isi Disposisi</th>
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
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-script'); ?>
<script>
    var datatable = $('#disposisiTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '<?php echo url()->current(); ?>',
        },
        columns: [{
                "data": 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'letter.letter_no',
                // label: 'No.Surat'
                name: 'letter.letter_no'
            },
            {
                data: 'asal_disposisi.department.name',
                name: 'asal_disposisi.department.name'
            },
            {
                data: 'asal_disposisi.nama',
                name: 'asal_disposisi.nama'
            },
            {
                data: 'tujuan_disposisi.department.name',
                name: 'tujuan_disposisi.department.name'
            },
            {
                data: 'tujuan_disposisi.nama',
                name: 'tujuan_disposisi.nama'
            },
            {
                data: 'isi_disposisi',
                name: 'isi_disposisi'
                // label:'isi_disposisi'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ]
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/disposisi/incoming.blade.php ENDPATH**/ ?>