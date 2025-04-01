<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }
    
    $id_user = $dataUser['id_user'];

    if ($dataUser['jabatan'] == 'admin') {
        $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user LEFT JOIN mekanik ON analisa_hasil.id_mekanik = mekanik.id_mekanik ORDER BY analisa_hasil.id_hasil");
    } else {
        $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user LEFT JOIN mekanik ON analisa_hasil.id_mekanik = mekanik.id_mekanik WHERE user.id_user = '$id_user'");
    }

    if (isset($_GET['btnPrint'])) {
        $dari_tanggal = $_GET['dari_tanggal'] . ' 00:00:00';
        $sampai_tanggal = $_GET['sampai_tanggal'] . ' 23:59:59';

        if ($dataUser['jabatan'] == 'admin') {
            $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user LEFT JOIN mekanik ON analisa_hasil.id_mekanik = mekanik.id_mekanik WHERE analisa_hasil.tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER BY analisa_hasil.id_hasil");

        } else {

            $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user LEFT JOIN mekanik ON analisa_hasil.id_mekanik = mekanik.id_mekanik WHERE analisa_hasil.tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND user.id_user = '$id_user' ORDER BY analisa_hasil.id_hasil");
        }
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Hasil Diagnosa - Sistem Pakar Motor</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-user-check"></i> Hasil Diagnosa</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Hasil Diagnosa
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
                                    <h4 class="m-0">Daftar Hasil Diagnosa</h4>
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row">
                                            <div class="col-3"> 
                                                <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                                                <input type="date" value="<?= (isset($_GET['dari_tanggal']) ? $_GET['dari_tanggal'] : date('Y-m-01')); ?>" class="form-control" id="dari_tanggal" name="dari_tanggal" required>
                                            </div>
                                            <div class="col-3"> 
                                                <label for="sampai_tanggal" class="form-label">Sampai Tanggal</label>
                                                <input type="date" value="<?= (isset($_GET['sampai_tanggal']) ? $_GET['sampai_tanggal'] : date('Y-m-d')); ?>" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required>
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-end"> 
                                                <button type="submit" name="btnPrint" class="me-3 btn btn-primary"><i class="fas fa-fw fa-filter"></i> Filter</button>
                                                <a href="hasil_diagnosa.php" class="me-3 btn btn-danger"><i class="fas fa-fw fa-times"></i> Reset</a>
                                                <?php if (isset($_GET['btnPrint'])): ?>
                                                    <a href="print.php?dari_tanggal=<?= $dari_tanggal; ?>&sampai_tanggal=<?= $sampai_tanggal; ?>" target="_blank" class="me-3 btn btn-success"><i class="fas fa-fw fa-print"></i> Print</a>
                                                    <a href="print.php?dari_tanggal=<?= $dari_tanggal; ?>&sampai_tanggal=<?= $sampai_tanggal; ?>&file_excel=true" target="_blank" class="me-3 btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Excel</a>
                                                <?php else: ?>
                                                    <a href="print.php" target="_blank" class="me-3 btn btn-success"><i class="fas fa-fw fa-print"></i> Print</a>
                                                    <a href="print.php?file_excel=true" target="_blank" class="me-3 btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Excel</a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="table-responsive p-2">
                                        <table class="table table-bordered" id="table_id">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-center align-middle">No.</th>
                                                    <th class="text-center align-middle">Nama Mekanik</th>
                                                    <th class="text-center align-middle">Nama</th>
                                                    <th class="text-center align-middle">Jenis Kelamin</th>
                                                    <th class="text-center align-middle">Tanggal Lahir</th>
                                                    <th class="text-center align-middle">Alamat</th>
                                                    <th class="text-center align-middle">Kerusakan</th>
                                                    <th class="text-center align-middle">Nilai Kemiripan</th>
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
                                                        <td class="align-middle"><?= $dhu['nama_mekanik']; ?></td>
                                                        <td class="align-middle"><?= $dhu['nama']; ?></td>
                                                        <td class="align-middle"><?= $dhu['jenis_kelamin']; ?></td>
                                                        <td class="align-middle"><?= $dhu['tanggal_lahir']; ?></td>
                                                        <td class="align-middle"><?= $dhu['alamat']; ?></td>
                                                        <td class="align-middle"><?= $dhu['nama_kerusakan']; ?> (<?= $dhu['kd_kerusakan']; ?>)</td>
                                                        <td class="align-middle"><?= round($dhu['nilai_akhir'], 2); ?>%</td>
                                                        <td class="align-middle"><?= $dhu['tanggal']; ?></td>
                                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                                            <td class="text-center align-middle">
                                                                <a href="detail_hasil_diagnosa.php?id_hasil=<?= $dhu['id_hasil']; ?>" class="m-1 btn btn-primary"><i class="fas fa-fw fa-bars"></i> Detail</a>
                                                                <a href="hapus_hasil.php?id_hasil=<?= $dhu['id_hasil']; ?>" data-nama="<?= $dhu['nama']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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