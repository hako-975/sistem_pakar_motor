<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    if ($dataUser['jabatan'] == 'admin') {
        $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user ORDER BY analisa_hasil.id");
    } else {
        $id_user = $dataUser['id_user'];
        $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user WHERE user.id_user = '$id_user'");
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Laporan User - Sistem Pakar Motor</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-file-alt"></i> Laporan User</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Laporan User
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
                                    <h4 class="m-0">Daftar Laporan User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive p-2">
                                        <table class="table table-bordered" id="table_id">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-center align-middle">No.</th>
                                                    <th class="text-center align-middle">Nama</th>
                                                    <th class="text-center align-middle">Jenis Kelamin</th>
                                                    <th class="text-center align-middle">Tanggal Lahir</th>
                                                    <th class="text-center align-middle">Alamat</th>
                                                    <th class="text-center align-middle">Kerusakan</th>
                                                    <th class="text-center align-middle">Tanggal Diagnosa</th>
                                                    <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                        <th class="text-center align-middle">Aksi</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($hasil_user as $dhu): ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                        <td class="align-middle"><?= $dhu['nama']; ?></td>
                                                        <td class="align-middle"><?= $dhu['jenis_kelamin']; ?></td>
                                                        <td class="align-middle"><?= $dhu['tanggal_lahir']; ?></td>
                                                        <td class="align-middle"><?= $dhu['alamat']; ?></td>
                                                        <td class="align-middle"><?= $dhu['nama_kerusakan']; ?> (<?= $dhu['kd_kerusakan']; ?>)</td>
                                                        <td class="align-middle"><?= $dhu['tanggal']; ?></td>
                                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                            <td class="text-center align-middle">
                                                                <a href="hapus_hasil_user.php?id=<?= $dhu['id']; ?>" data-nama="<?= $dhu['nama']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                            </td>
                                                        <?php endif ?>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>