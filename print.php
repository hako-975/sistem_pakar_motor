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

if (isset($_GET)) {
    if (isset($_GET['dari_tanggal'])) {
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];
        if ($dataUser['jabatan'] == 'admin') {
            $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user LEFT JOIN mekanik ON analisa_hasil.id_mekanik = mekanik.id_mekanik WHERE analisa_hasil.tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER BY analisa_hasil.id_hasil");

        } else {

            $hasil_user = mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user LEFT JOIN mekanik ON analisa_hasil.id_mekanik = mekanik.id_mekanik WHERE analisa_hasil.tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND user.id_user = '$id_user' ORDER BY analisa_hasil.id_hasil");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Hasil Diagnosa Mesin - Dari Tanggal: <?= date('d-m-Y', strtotime($dari_tanggal)); ?> Sampai Tanggal: <?= date('d-m-Y', strtotime($sampai_tanggal)); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .print-container {
            width: 100%;
            margin: 0 auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
<?php
    if (isset($_GET['file_excel'])) {
        if ($_GET['file_excel'] == true) {
            header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment; filename=hasil_ujian_export.xls"); 
        }
    }
?>
    <div class="print-container">
        <h2 class="text-center">Laporan Hasil Diagnosa Mesin</h2>
        <?php if (isset($_GET['dari_tanggal'])) : ?>
            <p class="text-right">Dari Tanggal: <?= date('d-m-Y', strtotime($dari_tanggal)); ?> Sampai Tanggal: <?= date('d-m-Y', strtotime($sampai_tanggal)); ?></p>
        <?php endif ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th class="text-center align-middle">Nama Mekanik</th>
                    <th class="text-center align-middle">Nama</th>
                    <th class="text-center align-middle">Jenis Kelamin</th>
                    <th class="text-center align-middle">Tanggal Lahir</th>
                    <th class="text-center align-middle">Alamat</th>
                    <th class="text-center align-middle">Kerusakan</th>
                    <th class="text-center align-middle">Nilai Kemiripan</th>
                    <th class="text-center align-middle">Tanggal Diagnosa</th>
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
                        <td class="align-middle"><?= date('d-m-Y, H:i \W\I\B', strtotime($dhu['tanggal'])); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>
</html>
