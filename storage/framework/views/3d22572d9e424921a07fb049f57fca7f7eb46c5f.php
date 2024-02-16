<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Surat Keluar</title>
</head>

<body>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table border="1" width="100%">
                        <tbody>
                            <tr>
                                <td valign="top">
                                    <div align="center">
                                        <span style="font-size: x-small;">&emsp;&emsp;&emsp;&emsp;<img src="/admin/assets/img/logo_rs.jpg" style="max-width: 7rem;" alt="Gambar iahn"></span>
                                    </div>
                                </td>
                                <td>
                                    <table border="0" cellpadding="1" style="width: 500px;text-align: center;">
                                        <tbody>
                                            <tr>
                                                <td width="100%"><span style="font-size: x-small;">
                                                        <h6>RUMAH SAKIT HARAPAN</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%"><span style="font-size: x-small;">
                                                        <center>
                                                            <pre>Jalan Maju Mundur <br> Telepon (1234) 628382; Faksimili (1234) 12345,<br> www.rs-harapan.com, email : info@rs-harapan.id</pre>
                                                        </center>
                                                    </span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div>
                        <h6>Laporan Surat Keluar</h6>
                    </div>
                    <table class="table table-sm table-striped table-bordered" width="100%">
                        <thead>
                            <th style="text-align: center;font-size: small;">No.</th>
                            <th style="text-align: center;font-size: small;">No. Surat</th>
                            <th style="text-align: center;font-size: small;">Perihal</th>
                            <th style="text-align: center;font-size: small;">Tujuan</th>
                            <th style="text-align: center;font-size: small;">Tanggal</th>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            ?>
                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letterout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="text-align: center;font-size: small;"><?php echo e($no++); ?></td>
                                <td style="text-align: center;font-size: small;"><?php echo e($letterout->letter_no); ?></td>
                                <td style="text-align: center;font-size: small;"><?php echo e($letterout->regarding); ?></td>
                                <td style="text-align: center;font-size: small;"><?php echo e($letterout->purpose); ?></td>
                                <td style="text-align: center;font-size: small;"><?php echo e(Carbon\Carbon::parse($letterout->letter_date)->translatedFormat('l, d F Y')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.print();
        window.onafterprint = window.close;
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html><?php /**PATH C:\laragon\www\setia-arsip\resources\views/pages/admin/letterout/print-outgoing.blade.php ENDPATH**/ ?>