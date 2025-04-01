<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $get_gejala = mysqli_query($conn, "SELECT * FROM gejala ORDER BY kd_gejala ASC");
    $mekanik = mysqli_query($conn, "SELECT * FROM mekanik ORDER BY nama_mekanik ASC");
    $user = mysqli_query($conn, "SELECT * FROM user ORDER BY nama ASC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Diagnosa Mesin</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahDiagnosaMesin'])) {
            $id_mekanik = $_POST['id_mekanik'];
            if ($dataUser['jabatan'] == 'admin') {
                $id_user = $_POST['id_user'];
            } else {
                $id_user = $dataUser['id_user'];
            }

            if (!isset($_POST['gejala']) || empty($_POST['gejala'])) {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Anda Belum Memilih Gejala!',
                            confirmButtonText: 'Kembali'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.history.back();
                            }
                        });
                    </script>
                ";
                exit;
            }

            // Insert ke tabel analisa_hasil
            mysqli_query($conn, "INSERT INTO analisa_hasil (id_user, id_mekanik, tanggal) VALUES ('$id_user', '$id_mekanik', CURRENT_TIMESTAMP())");
            $id_hasil = mysqli_insert_id($conn);

            $gejala_terpilih = $_POST['gejala'];
            $total_bobot_user = 0;

            // Hitung total bobot dari gejala yang dipilih
            $total_bobot_user = 0;
            foreach ($gejala_terpilih as $kd_gejala) {
                $result = mysqli_query($conn, "SELECT bobot FROM relasi WHERE kd_gejala = '$kd_gejala'");
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                        $bobot = $row['bobot'];
                        $total_bobot_user += $bobot;
                    }
                }
            }
           
            // ================================
            // Proses Perhitungan CBR
            // ================================

            // Ambil semua kerusakan yang berhubungan dengan gejala yang dipilih
            $query = mysqli_query($conn, "SELECT r.kd_kerusakan, k.nama_kerusakan, SUM(r.bobot) as total_bobot 
                                          FROM relasi r 
                                          JOIN kerusakan_solusi k ON r.kd_kerusakan = k.kd_kerusakan 
                                          WHERE r.kd_gejala IN ('" . implode("','", $gejala_terpilih) . "') 
                                          GROUP BY r.kd_kerusakan 
                                          ORDER BY total_bobot DESC 
                                          LIMIT 1");

            if (mysqli_num_rows($query) > 0) {
                $hasil = mysqli_fetch_assoc($query);
                $kd_kerusakan = $hasil['kd_kerusakan'];
                $nama_kerusakan = $hasil['nama_kerusakan'];
                $total_bobot_sistem = $hasil['total_bobot'];
                // Hitung nilai kemiripan (%) berdasarkan bobot user vs sistem
                $nilai_kemiripan = ($total_bobot_sistem / $total_bobot_user) * 100;

                // Simpan detail ke tabel perhitungan
                foreach ($gejala_terpilih as $kd_gejala) {
                    $result = mysqli_query($conn, "SELECT * FROM relasi WHERE kd_gejala = '$kd_gejala'");
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            $bobot = $row['bobot'];
                            mysqli_query($conn, "INSERT INTO perhitungan (id_hasil, kd_gejala, bobot) 
                                                 VALUES ('$id_hasil', '$kd_gejala', '$bobot')");
                        } else {
                            mysqli_query($conn, "INSERT INTO perhitungan (id_hasil, kd_gejala, bobot) 
                                                 VALUES ('$id_hasil', '$kd_gejala', '0')");
                        }
                    }
                }

                // Update analisa_hasil dengan hasil kerusakan dan nilai kemiripan
                mysqli_query($conn, "UPDATE analisa_hasil 
                                     SET kd_kerusakan='$kd_kerusakan', nilai_akhir='$nilai_kemiripan' 
                                     WHERE id_hasil='$id_hasil'");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            html: 'Diagnosa berhasil disimpan! <br> Kerusakan: $nama_kerusakan <br> Kemiripan: " . round($nilai_kemiripan, 2) . "%',
                            confirmButtonText: 'Lihat Hasil'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'detail_hasil_diagnosa.php?id_hasil=$id_hasil';
                            }
                        });
                    </script>
                ";

            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Tidak Ditemukan!',
                            text: 'Tidak ditemukan kecocokan kerusakan pada gejala yang dipilih!',
                            confirmButtonText: 'Kembali'
                        });
                    </script>
                ";
            }
        }
    ?>


    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Tambah Diagnosa Mesin</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="hasil_diagnosa.php">Hasil Diagnosa Mesin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Diagnosa Mesin
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-primary card-outline mb-4">
                                <form method="post"> 
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="id_mekanik" class="form-label">Nama Mekanik</label> 
                                            <select class="form-select" id="id_mekanik" name="id_mekanik" required>
                                                <option value="0">--- Nama Mekanik ---</option>
                                                <?php foreach ($mekanik as $dm): ?>
                                                    <option value="<?= $dm['id_mekanik']; ?>"><?= $dm['nama_mekanik']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <?php if ($dataUser['jabatan'] == 'admin'): ?>
                                            <div class="mb-3"> 
                                                <label for="id_user" class="form-label">Nama Konsumen</label> 
                                                <select class="form-select" id="id_user" name="id_user" required>
                                                    <option value="0">--- Nama Konsumen ---</option>
                                                    <?php foreach ($user as $du): ?>
                                                        <option value="<?= $du['id_user']; ?>"><?= $du['nama']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        <?php endif ?>
                                        <hr>
                                        <h5 class="text-center">Pilih Gejala Yang Dialami</h5>
                                        <h5>Form Konsultasi:</h5>
                                        <?php $id_no = 1; ?>
                                        <?php foreach ($get_gejala as $dg): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="gejala[]" value="<?= $dg['kd_gejala']; ?>" id="<?= $id_no; ?>">
                                                <label class="form-check-label" for="<?= $id_no; ?>">
                                                    <?= $dg['gejala']; ?>
                                                </label>
                                            </div>
                                            <?php $id_no++; ?>
                                        <?php endforeach ?>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnTambahDiagnosaMesin" class="btn btn-primary">Submit</button>
                                        <input type="reset" value="Reset" class="btn btn-danger">
                                    </div> 
                                </form> <!--end::Form-->
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