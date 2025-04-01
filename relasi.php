<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $relasi_1 = mysqli_query($conn, "SELECT relasi.kd_kerusakan, kerusakan_solusi.nama_kerusakan FROM relasi JOIN kerusakan_solusi ON kerusakan_solusi.kd_kerusakan = relasi.kd_kerusakan GROUP BY relasi.kd_kerusakan");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Relasi - Sistem Pakar Motor</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-link"></i> Relasi</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Relasi
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
                                    <h4 class="m-0">Daftar Relasi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive p-2">
                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                            <a href="tambah_relasi.php" class="mb-3 btn btn-primary">
                                                <i class="fas fa-plus"></i> Tambah Relasi
                                            </a>
                                        <?php endif ?>

                                        <table class="table table-bordered" id="table_id">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-center">No.</th>
                                                    <th class="text-center">Gejala</th>
                                                    <th class="text-center">Nama Kerusakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($relasi_1 as $dr1): ?>
                                                    <?php $id_kerusakan = $dr1['kd_kerusakan']; ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i++; ?>.</td>
                                                        <td>
                                                            <table width="600" class="table table-bordered">
                                                                <?php
                                                                    $relasi_2 = mysqli_query($conn, "SELECT relasi.id_relasi, relasi.kd_gejala, relasi.bobot, relasi.jenis_gejala, gejala.gejala FROM relasi JOIN gejala ON gejala.kd_gejala = relasi.kd_gejala WHERE relasi.kd_kerusakan = '$id_kerusakan'"); 
                                                                ?>
                                                                <?php foreach ($relasi_2 as $dr2): ?>
                                                                    <tr>
                                                                        <td class="align-middle text-center" width="50"><?= $dr2['kd_gejala']; ?></td>
                                                                        <td class="align-middle" width="300"><?= $dr2['gejala']; ?></td>
                                                                        <td class="align-middle" width="300"><?= $dr2['jenis_gejala']; ?></td>
                                                                        <td class="align-middle text-center" width="50"><?= $dr2['bobot'] ?></td>
                                                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                                            <td class="align-middle text-center" width="150">
                                                                                <a href="ubah_relasi.php?id_relasi=<?= $dr2['id_relasi'] ?>" class="m-1 btn btn-success btn-sm"><i class="fas fa-fw fa-edit"></i> Ubah</a> 
                                                                                <a href="hapus_relasi.php?id_relasi=<?= $dr2['id_relasi'] ?>"data-nama="<?= $dr2['gejala']; ?>" class="m-1 btn btn-danger btn-delete btn-sm"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                                            </td>
                                                                        <?php endif ?>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </table>
                                                        </td>
                                                        <td><strong><?= $dr1['kd_kerusakan'];?> | <?= $dr1['nama_kerusakan'] ?></strong></td>
                                                    </tr>
                                                <?php endforeach; ?>
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