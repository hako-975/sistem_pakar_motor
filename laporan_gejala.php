<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $kerusakan_solusi = mysqli_query($conn, "SELECT * FROM kerusakan_solusi ORDER BY kd_kerusakan ASC");

    if (isset($_POST['btnLaporanGejala'])) {
        $kd_kerusakan = $_POST['kd_kerusakan'];
        $nama_kerusakan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kerusakan_solusi WHERE kd_kerusakan = '$kd_kerusakan'"))['nama_kerusakan'];

        $data_gejala = mysqli_query($conn, "SELECT gejala.* FROM gejala, relasi WHERE gejala.kd_gejala = relasi.kd_gejala AND relasi.kd_kerusakan = '$kd_kerusakan' ORDER BY gejala.kd_gejala");
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Laporan Gejala - Sistem Pakar Motor</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-file-alt"></i> Laporan Gejala</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Laporan Gejala
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="m-0">Tampilkan Gejala & Kerusakan</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post"> 
                                        <div class="mb-3"> 
                                            <label for="kd_kerusakan" class="form-label">Kerusakan</label>
                                            <select class="form-select" id="kd_kerusakan" name="kd_kerusakan">
                                                <option value="0">--- Pilih Kerusakan ---</option>
                                                <?php foreach ($kerusakan_solusi as $dks): ?>
                                                    <option value="<?= $dks['kd_kerusakan']; ?>"><?= $dks['kd_kerusakan']; ?> | <?= $dks['nama_kerusakan']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="card-footer pt-3">
                                            <button type="submit" name="btnLaporanGejala" class="btn btn-primary">Submit</button>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_POST['btnLaporanGejala'])): ?>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="m-0">Nama Kerusakan: <?= $nama_kerusakan; ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="m-0">Daftar Gejala Kerusakan</h4>
                                        <div class="table-responsive p-2">
                                            <table class="table table-bordered" id="table_id">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th class="text-center align-middle">No.</th>
                                                        <th class="text-center align-middle">Kode Gejala</th>
                                                        <th class="text-center align-middle">Gejala</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($data_gejala as $ddg): ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $ddg['kd_gejala']; ?></td>
                                                            <td><?= $ddg['gejala']; ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>