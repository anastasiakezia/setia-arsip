

<?php $__env->startSection('title'); ?>
Tambah Surat Disposisi
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
                            Tambah Surat Disposisi
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="<?php echo e(route('surat-disposisi')); ?>">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali ke Semua Surat Disposisi
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
        <form action="<?php echo e(route('disposisi.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row gx-4">
                <div class="col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header">Form Disposisi <span style="color: green;"> * Harus diisi</span></div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="letter_id" class="col-sm-3 col-form-label">No. Surat Disposisi</label>
                                <div class="col-sm-9">
                                    <select name="letter_id" class="form-control " required>
                                        <option value="">Pilih Surat Yang Akan di Disposisi...</option>
                                        <?php $__currentLoopData = $letters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($letter->id); ?>"><?php echo e($letter->letter_no); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
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
                                <label for="lampiran" class="col-sm-3 col-form-label">Lampiran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['lampiran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('lampiran')); ?>" name="lampiran" placeholder="Lampiran.." required>
                                </div>
                                <?php $__errorArgs = ['lampiran'];
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
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" value="Asli" name="status[]"> Asli <br>
                                    <input type="checkbox" value="Tembusan" name="status[]"> Tembusan
                                </div>
                                <?php $__errorArgs = ['status'];
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
                                <label for="sifat" class="col-sm-3 col-form-label">Sifat</label>
                                <div class="col-sm-9 row" style="float: right;">
                                    <div class="col-sm-4">
                                        <input type="checkbox" value="Sangat Segera/kilat" name="sifat[]"> Sangat Segera/kilat <br>
                                        <input type="checkbox" value="Segera" name="sifat[]"> Segera <br>
                                        <input type="checkbox" value="Biasa" name="sifat[]"> Biasa
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="checkbox" value="Sangat Rahasia" name="sifat[]"> Sangat Rahasia <br>
                                        <input type="checkbox" value="Rahasia" name="sifat[]"> Rahasia <br>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['sifat'];
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
                                <label for="petunjuk" class="col-sm-3 col-form-label">Petunjuk</label>
                                <div class="col-sm-9 row" style="float: right;">
                                    <div class="col-sm-4">
                                        <input type="checkbox" value="Setuju" name="petunjuk[]"> Setuju <br>
                                        <input type="checkbox" value="Tolak" name="petunjuk[]"> Tolak <br>
                                        <input type="checkbox" value="Teliti & Pendapat" name="petunjuk[]"> Teliti & Pendapat <br>
                                        <input type="checkbox" value="Untuk Diketahui" name="petunjuk[]"> Untuk Diketahui <br>
                                        <input type="checkbox" value="Selesaikan" name="petunjuk[]"> Selesaikan <br>
                                        <input type="checkbox" value="Sesuai Catatan" name="petunjuk[]"> Sesuai Catatan <br>
                                        <input type="checkbox" value="Untuk Perhatian" name="petunjuk[]"> Untuk Perhatian <br>
                                        <input type="checkbox" value="Edarkan" name="petunjuk[]"> Edarkan <br>
                                        <input type="checkbox" value="-" name="petunjuk[]"> -
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="checkbox" value="Jawab" name="petunjuk[]"> Jawab <br>
                                        <input type="checkbox" value="Perbaiki" name="petunjuk[]"> Perbaiki <br>
                                        <input type="checkbox" value="Bicarakan Dengan saya" name="petunjuk[]"> Bicarakan Dengan saya <br>
                                        <input type="checkbox" value="Bicarakan Bersama" name="petunjuk[]"> Bicarakan Bersama <br>
                                        <input type="checkbox" value="Ingatkan" name="petunjuk[]"> Ingatkan <br>
                                        <input type="checkbox" value="Simpan" name="petunjuk[]"> Simpan <br>
                                        <input type="checkbox" value="Disiapkan" name="petunjuk[]"> Disiapkan <br>
                                        <input type="checkbox" value="Harap dihadiri/diwakili" name="petunjuk[]"> Harap dihadiri/diwakili <br>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['petunjuk'];
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
                                <label for="catatan_rektors" class="col-sm-3 col-form-label">Catatan Rektor</label>
                                <div class="col-sm-9">
                                    <textarea id="catatan_rektors" class="form-control <?php $__errorArgs = ['catatan_rektor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="catatan_rektor" placeholder="Catatan Rektor.." required><?php echo e(old('catatan_rektor')); ?></textarea>
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
                    </div>
                </div>
            </div>
            <div class="row gx-4">
                <div class="col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header">Form Disposisi Lanjutan <span style="color: green;"> * Harus diisi</span></div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="tgl_selesai" class="col-sm-3 col-form-label">Tanggal Penyelesaian</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?php $__errorArgs = ['tgl_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('tgl_selesai')); ?>" name="tgl_selesai">
                                </div>
                                <?php $__errorArgs = ['tgl_selesai'];
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
                                <label for="kepada" class="col-sm-3 col-form-label">Kepada</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['kepada'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('kepada')); ?>" name="kepada" placeholder="Kepada..">
                                </div>
                                <?php $__errorArgs = ['kepada'];
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
                                <label for="petunjuks" class="col-sm-3 col-form-label">Petunjuk</label>
                                <div class="col-sm-9">
                                    <textarea id="petunjuks" class="form-control <?php $__errorArgs = ['petunjuk_kpd_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="petunjuk_kpd_1" placeholder="Petunjuk Untuk Penerima Disposisi..."><?php echo e(old('petunjuk_kpd_1')); ?></textarea>
                                </div>
                                <?php $__errorArgs = ['petunjuk_kpd_1'];
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
                                <label for="tgl_selesai_2" class="col-sm-3 col-form-label">Tanggal Penyelesaian</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?php $__errorArgs = ['tgl_selesai_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('tgl_selesai_2')); ?>" name="tgl_selesai_2">
                                </div>
                                <?php $__errorArgs = ['tgl_selesai_2'];
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
                                <label for="penerima_2" class="col-sm-3 col-form-label">Penerima</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['penerima_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('penerima_2')); ?>" name="penerima_2" placeholder="penerima 2..">
                                </div>
                                <?php $__errorArgs = ['penerima_2'];
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
            <div class="row gx-4">
                <div class="col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header">Form Pengajuan Kembali Disposisi<span style="color: green;">* Harus diisi</span></div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="tgl_aju_kembali" class="col-sm-3 col-form-label">Tanggal Diajukan kembali</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?php $__errorArgs = ['tgl_aju_kembali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('tgl_aju_kembali')); ?>" name="tgl_aju_kembali">
                                </div>
                                <?php $__errorArgs = ['tgl_aju_kembali'];
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
                                <label for="penerima_disposisi_2" class="col-sm-3 col-form-label">Penerima Disposisi</label>
                                <div class="col-sm-9 row" style="float: right;">
                                    <div class="col-sm-4">
                                        <input type="checkbox" value="Wakil Rektor I" name="penerima_disposisi_2[]"> Wakil Rektor I <br>
                                        <input type="checkbox" value="Kepala Biro" name="penerima_disposisi_2[]"> Kepala Biro <br>
                                        <input type="checkbox" value="Kasubbag" name="penerima_disposisi_2[]"> Kasubbag <br>
                                        <input type="checkbox" value="Dekan Fakultas" name="penerima_disposisi_2[]"> Dekan Fakultas <br>
                                        <input type="checkbox" value="Koordinator Prodi" name="penerima_disposisi_2[]"> Koordinator Prodi <br>
                                        <input type="checkbox" value="Kepala Unit" name="penerima_disposisi_2[]"> Kepala Unit <br>
                                        <input type="checkbox" value="-" name="penerima_disposisi_2[]"> -
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="checkbox" value="Wakil Rektor II" name="penerima_disposisi_2[]"> Wakil Rektor II <br>
                                        <input type="checkbox" value="Kabag" name="penerima_disposisi_2[]"> Kabag <br>
                                        <input type="checkbox" value="Direktur" name="penerima_disposisi_2[]"> Direktur <br>
                                        <input type="checkbox" value="Ketua Jurusan" name="penerima_disposisi_2[]"> Ketua Jurusan <br>
                                        <input type="checkbox" value="Ketua Lembaga" name="penerima_disposisi_2[]"> Ketua Lembaga <br>
                                        <input type="checkbox" value="Kepala Lab" name="penerima_disposisi_2[]"> Kepala Lab <br>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['penerima_disposisi_2'];
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
                                <label for="kepada_2" class="col-sm-3 col-form-label">Kepada</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['kepada_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('kepada_2')); ?>" name="kepada_2" placeholder="Kepada 2..">
                                </div>
                                <?php $__errorArgs = ['kepada_2'];
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
                                <label for="petunjuks" class="col-sm-3 col-form-label">Petunjuk</label>
                                <div class="col-sm-9">
                                    <textarea id="petunjuks" class="form-control <?php $__errorArgs = ['petunjuk_kpd_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="petunjuk_kpd_2" placeholder="Petunjuk Untuk Penerima Disposisi..."><?php echo e(old('petunjuk_kpd_2')); ?></textarea>
                                </div>
                                <?php $__errorArgs = ['petunjuk_kpd_2'];
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
                                <label for="tgl_selesai_3" class="col-sm-3 col-form-label">Tanggal Penyelesaian</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?php $__errorArgs = ['tgl_selesai_3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('tgl_selesai_3')); ?>" name="tgl_selesai_3">
                                </div>
                                <?php $__errorArgs = ['tgl_selesai_3'];
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
                                <label for="penerima_3" class="col-sm-3 col-form-label">Penerima</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?php $__errorArgs = ['penerima_3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('penerima_3')); ?>" name="penerima_3" placeholder="penerima 3..">
                                </div>
                                <?php $__errorArgs = ['penerima_3'];
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    $(".selectx").select2({
        theme: "bootstrap-5"
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arsip-iahn\resources\views/pages/admin/disposisi/create.blade.php ENDPATH**/ ?>