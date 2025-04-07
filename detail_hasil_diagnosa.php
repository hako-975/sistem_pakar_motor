<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_hasil = $_GET['id_hasil'];

    $data_analisa_hasil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN kerusakan_solusi ON analisa_hasil.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN user ON analisa_hasil.id_user = user.id_user LEFT JOIN mekanik ON analisa_hasil.id_mekanik = mekanik.id_mekanik WHERE analisa_hasil.id_hasil = '$id_hasil'"));
    $nama = $data_analisa_hasil['nama'];
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Detail Hasil Diagnosa - <?= $nama; ?></title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Detail Hasil Diagnosa - <?= $nama; ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="hasil_diagnosa.php">Hasil Diagnosa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Hasil Diagnosa
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12">
                            <?php
                                $id_hasil = $_GET['id_hasil'];

                                // Ambil data hasil diagnosa berdasarkan id_hasil
                                $query_hasil = mysqli_query($conn, "SELECT * FROM analisa_hasil WHERE id_hasil = '$id_hasil'");
                                $hasil = mysqli_fetch_assoc($query_hasil);

                                // Ambil nama kerusakan dan nilai kemiripan
                                $kd_kerusakan = $hasil['kd_kerusakan'];
                                $nilai_akhir = $hasil['nilai_akhir'];

                                // Ambil nama kerusakan berdasarkan kd_kerusakan
                                $query_kerusakan = mysqli_query($conn, "SELECT * FROM kerusakan_solusi WHERE kd_kerusakan = '$kd_kerusakan'");
                                $kerusakan = mysqli_fetch_assoc($query_kerusakan);
                                $nama_kerusakan = $kerusakan['nama_kerusakan'] . ' ('.$kerusakan['kd_kerusakan'].')';

                                // Ambil detail perhitungan berdasarkan id_hasil
                                $query_perhitungan = mysqli_query($conn, "SELECT g.kd_gejala, g.gejala, p.bobot 
                                                                         FROM perhitungan p 
                                                                         JOIN gejala g ON p.kd_gejala = g.kd_gejala 
                                                                         WHERE p.id_hasil = '$id_hasil'");
                            ?>
                            <h6><strong>Nama Mekanik:</strong> <?= $data_analisa_hasil['nama_mekanik']; ?></h6>
                            <h6><strong>Nama Pelanggan:</strong> <?= $data_analisa_hasil['nama']; ?></h6>
                            <h6><strong>Jenis Kelamin:</strong> <?= $data_analisa_hasil['jenis_kelamin']; ?></h6>
                            <h6><strong>Tanggal Lahir:</strong> <?= $data_analisa_hasil['tanggal_lahir']; ?></h6>
                            <h6><strong>Alamat:</strong> <?= $data_analisa_hasil['alamat']; ?></h6>
                            <h6><strong>Kerusakan:</strong> <?= $data_analisa_hasil['nama_kerusakan']; ?> (<?= $data_analisa_hasil['kd_kerusakan']; ?>)</h6>
                            <h6><strong>Tanggal Diagnosa:</strong> <?= $data_analisa_hasil['tanggal']; ?></h6>
                            <hr>
                            <h5><strong>Kerusakan: </strong> <br> <?= $nama_kerusakan; ?></h5>
                            <h5><strong>Nilai Kemiripan: </strong> <br> <?= round($nilai_akhir, 2); ?>%</h5>
                            <h5><strong>Solusi:</strong></h5>
                            <?php
                                $solusi = $kerusakan['solusi'];
                                $items = preg_split('/\s*\d+\.\s*/', $solusi, -1, PREG_SPLIT_NO_EMPTY);
                                foreach ($items as $i => $item) {
                                    echo ($i + 1) . '. ' . trim($item) . '<br>';
                                }
                            ?>
                            <hr>
                            <h5><strong>Detail Perhitungan:</strong></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">Kode Gejala</th>
                                        <th class="text-center align-middle">Gejala</th>
                                        <th class="text-center align-middle">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_bobot = 0;
                                        $gejala_terpilih = [];

                                        foreach ($query_perhitungan as $dp): 
                                            $total_bobot += $dp['bobot']; // Menjumlahkan bobot
                                            $gejala_terpilih[] = $dp['kd_gejala']; // Simpan kode gejala

                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= htmlspecialchars($dp['kd_gejala']); ?></td>
                                        <td><?= htmlspecialchars($dp['gejala']); ?></td>
                                        <td><?= htmlspecialchars($dp['bobot']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total Bobot</th>
                                        <th><?= htmlspecialchars($total_bobot); ?></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <?php 
                                // Pastikan ada gejala yang dipilih sebelum menjalankan query kedua
                                $query = mysqli_query($conn, "SELECT r.kd_kerusakan, k.nama_kerusakan, SUM(r.bobot) as total_bobot 
                                          FROM relasi r 
                                          JOIN kerusakan_solusi k ON r.kd_kerusakan = k.kd_kerusakan 
                                          WHERE r.kd_gejala IN ('" . implode("','", $gejala_terpilih) . "') 
                                          GROUP BY r.kd_kerusakan 
                                          ORDER BY total_bobot DESC 
                                          LIMIT 1");

                                // Ambil hasilnya
                                $hasil = mysqli_fetch_assoc($query);
                                $total_bobot_sistem = $hasil['total_bobot'];
                            ?>
                            <h5><strong>Rumus:</strong></h5>
                            <p>
                                CBR = (Total Bobot Sistem / Total Bobot Gejala) * 100
                            </p>
                            <p>
                                CBR = (<?= $total_bobot_sistem; ?> / <?= $total_bobot; ?>) * 100
                            </p>
                            <strong>Hasil Nilai Kemiripan = <?= round(($total_bobot_sistem / $total_bobot) * 100, 2); ?>%</strong>
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