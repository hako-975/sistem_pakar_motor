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
            <span class="brand-text fw-light text-dark small text-wrap">Sistem Pendukung Keputusan Jurusan Kuliah Pada SMK</span>
        </a> 
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> 
                    <a href="index.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/index.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a href="spk.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/spk.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-calculator"></i>
                        <p>SPK Jurusan</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="kriteria.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/kriteria.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-clipboard-list"></i>
                        <p>Kriteria</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="jurusan.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/jurusan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-graduation-cap"></i>
                        <p>Jurusan</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="siswa.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/siswa.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-users"></i>
                        <p>Siswa</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="user.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/user.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-user"></i>
                        <p>User</p>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a href="laporan.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/laporan.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item"> 
                    <a href="log.php" class="nav-link text-dark <?= ($_SERVER['REQUEST_URI'] == '/spk_jurusan_kuliah_pada_smk/log.php') ? 'active' : ''; ?>"> <i class="nav-icon fas fa-fw fa-history"></i>
                        <p>Log</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div> 
</aside> 