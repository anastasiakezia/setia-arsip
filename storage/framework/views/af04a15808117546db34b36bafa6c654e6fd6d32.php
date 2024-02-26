

<?php $__env->startSection('title'); ?>
Detail Surat
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
                            Detail Surat
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
        <div class="row gx-4">
            <div class="col-lg-7">
                <div class="card mb-4">
                    <div class="card-header">Detail Surat</div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Jenis Surat</th>
                                        <td><?php echo e($item->letter_type); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Surat</th>
                                        <td><?php echo e(Carbon\Carbon::parse($item->letter_date)->translatedFormat('l, d F Y')); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Surat</th>
                                        <td><?php echo e($item->letter_no); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sifat Surat</th>
                                        <td><?php echo e($item->letter_char); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Asal Pengirim</th>
                                        <td><?php echo e($item->sender_type); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Perihal</th>
                                        <td><?php echo e($item->regarding); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tujuan Disposisi</th>
                                        <td><?php echo e($item->disposisi); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pengirim Surat</th>
                                        <td><?php echo e($item->sender_name_external); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Departemen</th>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-header">
                        File Surat -
                        <a href="<?php echo e(route('download-surat', $item->id)); ?>" class="btn btn-sm btn-primary">
                            <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download Surat
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <embed src="<?php echo e(Storage::url($item->letter_file)); ?>" width="500" height="375" type="application/pdf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/letter/show.blade.php ENDPATH**/ ?>