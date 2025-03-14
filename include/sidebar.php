<style>
    .nav-link.active {
        background-color: #0d6efd!important;
        color: #fff!important;
    }
</style>

<aside class="app-sidebar bg-white shadow" data-bs-theme="dark">
    <div class="sidebar-brand border-primary border-bottom"> 
        <a href="index.php" class="brand-link"> 
            <img src="assets/img/properties/logo.png" alt="Logo" class="brand-image-xl">
            <span class="brand-text fw-light text-dark small text-wrap">Sistem Pakar Motor</span>
        </a> 
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> 
                    <a href="index.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/index.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a href="diagnosa_mesin.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/diagnosa_mesin.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-cogs"></i>
                        <p>Diagnosa Mesin</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="kerusakan_solusi.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/kerusakan_solusi.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-x-ray"></i>
                        <p>Kerusakan & Solusi</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="gejala.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/gejala.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-exclamation-triangle"></i>
                        <p>Gejala</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="relasi.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/relasi.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-link"></i>
                        <p>Relasi</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="mekanik.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/mekanik.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-users-cog"></i>
                        <p>Mekanik</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="laporan_gejala.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/laporan_gejala.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-file-alt"></i>
                        <p>Laporan Gejala</p>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a href="laporan_user.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/laporan_user.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-file-alt"></i>
                        <p>Laporan User</p>
                    </a>
                </li>
                <?php if ($dataUser['jabatan'] == 'admin'): ?>
                    <li class="nav-item"> 
                        <a href="user.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/user.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-user"></i>
                            <p>User</p>
                        </a> 
                    </li>
                <?php endif ?>
                <hr class="sidebar-divider">
                <li class="nav-item"> 
                    <a href="log.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/sistem_pakar_motor/log.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-history"></i>
                        <p>Log</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div> 
</aside> 