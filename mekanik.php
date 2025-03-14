<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $mekanik = mysqli_query($conn, "SELECT * FROM mekanik ORDER BY nama_mekanik ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Mekanik - Sistem Pakar Motor</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-users-cog"></i> Mekanik</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Mekanik
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
                                    <h4 class="m-0">Daftar Mekanik</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive p-2">
                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                            <a href="tambah_mekanik.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Mekanik</a>
                                        <?php endif ?>
                                        <table class="table table-bordered" id="table_id">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th width="200" class="text-center align-middle">ID Mekanik</th>
                                                    <th class="text-center align-middle">Mekanik</th>
                                                    <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                        <th width="300" class="text-center align-middle">Aksi</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($mekanik as $dm): ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $dm['id_mekanik']; ?></td>
                                                        <td class="align-middle"><?= $dm['nama_mekanik']; ?></td>
                                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                            <td class="text-center align-middle">
                                                                <a href="ubah_mekanik.php?id_mekanik=<?= $dm['id_mekanik']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                                <a href="hapus_mekanik.php?id_mekanik=<?= $dm['id_mekanik']; ?>" data-nama="<?= $dm['nama_mekanik']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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