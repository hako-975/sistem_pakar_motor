<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    if ($dataUser['jabatan'] == 'pelanggan') {
        header("Location: index.php");
        exit;
    }

    $kerusakan_solusi = mysqli_query($conn, "SELECT * FROM kerusakan_solusi ORDER BY kd_kerusakan ASC");

    $gejala = mysqli_query($conn, "SELECT * FROM gejala ORDER BY kd_gejala ASC");


?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Relasi</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahRelasi'])) {
            $kd_kerusakan = htmlspecialchars($_POST['kd_kerusakan']);
            $kd_gejala = htmlspecialchars($_POST['kd_gejala']);
            $jenis_gejala = htmlspecialchars($_POST['jenis_gejala']);
            $bobot = htmlspecialchars($_POST['bobot']);

            if ($kd_kerusakan == '0') {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Pilih Kerusakan dahulu!',
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

            if ($kd_gejala == '0') {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Pilih Gejala dahulu!',
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


            $relasi_cek = mysqli_query($conn, "SELECT * FROM relasi WHERE kd_kerusakan = '$kd_kerusakan' AND kd_gejala = '$kd_gejala'");

            if (mysqli_num_rows($relasi_cek) > 0) {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Relasi sudah ada!',
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

            $gejala = mysqli_query($conn, "SELECT * FROM gejala WHERE kd_gejala = '$kd_gejala'");

            while ($data_tmp = mysqli_fetch_array($gejala)) {
                $sql = "INSERT INTO relasi (kd_kerusakan, kd_gejala, jenis_gejala, bobot) VALUES ('$kd_kerusakan', '$kd_gejala', '$jenis_gejala', '$bobot')"; 
            }

            $insert_relasi = mysqli_query($conn, $sql);

            if ($insert_relasi) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Relasi $kd_kerusakan | $kd_gejala berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Relasi " . $kd_kerusakan .'|'. $kd_gejala . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'relasi.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Relasi $kd_gejala gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Relasi " . $kd_kerusakan .'|'. $kd_gejala . " gagal ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.history.back();
                            }
                        });
                    </script>
                ";
                exit;
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
                            <h3 class="mb-0">Tambah Relasi</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="relasi.php">Relasi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Relasi
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
                                <form method="post" enctype="multipart/form-data"> 
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="kd_kerusakan" class="form-label">Kerusakan</label>
                                            <select class="form-select" id="kd_kerusakan" name="kd_kerusakan">
                                                <option value="0">--- Pilih Kerusakan ---</option>
                                                <?php foreach ($kerusakan_solusi as $dks): ?>
                                                    <option value="<?= $dks['kd_kerusakan']; ?>"><?= $dks['kd_kerusakan']; ?> | <?= $dks['nama_kerusakan']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="kd_gejala" class="form-label">Gejala</label>
                                            <select class="form-select" id="kd_gejala" name="kd_gejala">
                                                <option value="0">--- Pilih Gejala ---</option>
                                                <?php foreach ($gejala as $dg): ?>
                                                    <option value="<?= $dg['kd_gejala']; ?>"><?= $dg['kd_gejala']; ?> | <?= $dg['gejala']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="jenis_gejala" class="form-label">Jenis Gejala</label>
                                            <select class="form-select" id="jenis_gejala" name="jenis_gejala">
                                                <option value="Ringan">Ringan</option>
                                                <option value="Sedang">Sedang</option>
                                                <option value="Berat">Berat</option>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="bobot" class="form-label">Bobot</label>
                                            <input type="number" step="1" class="form-control" id="bobot" name="bobot" required>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnTambahRelasi" class="btn btn-primary">Submit</button>
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