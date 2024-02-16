<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Menu</div>
            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link <?php echo e((request()->is('admin/dashboard')) ? 'active' : ''); ?>" href="<?php echo e(route('admin-dashboard')); ?>">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <a class="nav-link <?php echo e((request()->is('admin/department*')) ? 'active' : ''); ?>" href="<?php echo e(route('department.index')); ?>">
                <div class="nav-link-icon"><i data-feather="home"></i></div>
                Data Unit
            </a>
            <a class="nav-link <?php echo e((request()->is('admin/employee*')) ? 'active' : ''); ?>" href="<?php echo e(route('karyawan')); ?>" style="line-height:20px">
                <div class="nav-link-icon"><i data-feather="home"></i></div>
                Data Direksi dan Karyawan
            </a>
            
            <a class="nav-link <?php echo e((request()->is('admin/letter/surat-masuk')) ? 'active' : ''); ?>" href="<?php echo e(route('surat-masuk')); ?>">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Surat Masuk
            </a>
            <a class="nav-link <?php echo e((request()->is('admin/letterout/surat-keluar')) ? 'active' : ''); ?>" href="<?php echo e(route('surat-keluar')); ?>">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Surat Keluar
            </a>
            <a class="nav-link <?php echo e((request()->is('admin/disposisi/surat-disposisi')) ? 'active' : ''); ?>" href="<?php echo e(route('surat-disposisi')); ?>">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Pengajuan Disposisi
            </a>
            <a class="nav-link <?php echo e((request()->is('admin/dinasLuar/dinas-luar')) ? 'active' : ''); ?>" href="<?php echo e(route('dinas-luar')); ?>">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Laporan Dinas Luar
            </a>
            
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title"><?php echo e(Auth::user()->name); ?></div>
        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\setia-arsip\resources\views/includes/sidebar-admin.blade.php ENDPATH**/ ?>