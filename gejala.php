<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $gejala = mysqli_query($conn, "SELECT * FROM gejala ORDER BY kd_gejala ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Gejala - Sistem Pakar Motor</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-exclamation-triangle"></i> Gejala</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Gejala
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
                                    <h4 class="m-0">Daftar Gejala</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive p-2">
                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                            <a href="tambah_gejala.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Gejala</a>
                                        <?php endif ?>
                                        <table class="table table-bordered" id="table_id">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-center align-middle">Kode Gejala</th>
                                                    <th class="text-center align-middle">Gejala</th>
                                                    <th class="text-center align-middle">Deksripsi Gejala</th>
                                                    <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                        <th class="text-center align-middle">Aksi</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($gejala as $dks): ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $dks['kd_gejala']; ?></td>
                                                        <td class="align-middle"><?= $dks['gejala']; ?></td>
                                                        <td class="align-middle"><?= $dks['deskripsi_gejala']; ?></td>
                                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                            <td class="text-center align-middle">
                                                                <a href="ubah_gejala.php?kd_gejala=<?= $dks['kd_gejala']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                                <a href="hapus_gejala.php?kd_gejala=<?= $dks['kd_gejala']; ?>" data-nama="<?= $dks['kd_gejala']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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