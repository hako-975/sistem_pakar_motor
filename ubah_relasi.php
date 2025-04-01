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

    $id_relasi = $_GET['id_relasi'];
    $data_relasi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM relasi INNER JOIN kerusakan_solusi ON relasi.kd_kerusakan = kerusakan_solusi.kd_kerusakan INNER JOIN gejala ON relasi.kd_gejala = gejala.kd_gejala WHERE id_relasi = '$id_relasi'"));
    if ($data_relasi == null) {
        header("Location: relasi.php");
        exit;
    }
    
    $kd_kerusakan = $data_relasi['kd_kerusakan'];
    $kd_gejala = $data_relasi['kd_gejala'];
    
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah Relasi</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnUbahRelasi'])) {
            $bobot = htmlspecialchars($_POST['bobot']);
            $jenis_gejala = htmlspecialchars($_POST['jenis_gejala']);

            $update_relasi = mysqli_query($conn, "UPDATE relasi SET bobot = '$bobot', jenis_gejala = '$jenis_gejala' WHERE id_relasi = '$id_relasi'");

            if ($update_relasi) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Relasi $kd_kerusakan | $kd_gejala berhasil diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Relasi " . $kd_kerusakan .'|'. $kd_gejala . " berhasil diubah!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'relasi.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Relasi $kd_gejala gagal diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Relasi " . $kd_kerusakan .'|'. $kd_gejala . " gagal diubah!'
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
                            <h3 class="mb-0">Ubah Relasi</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="relasi.php">Relasi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Ubah Relasi
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
                                            <select style="cursor: not-allowed;" disabled class="form-select" id="kd_kerusakan" name="kd_kerusakan">
                                                <option value="<?= $data_relasi['kd_kerusakan']; ?>"><?= $data_relasi['kd_kerusakan']; ?> | <?= $data_relasi['nama_kerusakan']; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="kd_gejala" class="form-label">Gejala</label>
                                            <select style="cursor: not-allowed;" disabled class="form-select" id="kd_gejala" name="kd_gejala">
                                                <option value="<?= $data_relasi['kd_gejala']; ?>"><?= $data_relasi['kd_gejala']; ?> | <?= $data_relasi['gejala']; ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="jenis_gejala" class="form-label">Jenis Gejala</label>
                                            <select class="form-select" id="jenis_gejala" name="jenis_gejala">
                                                <?php if ($data_relasi['jenis_gejala'] == 'Ringan'): ?>
                                                    <option value="Ringan">Ringan</option>
                                                    <option value="Sedang">Sedang</option>
                                                    <option value="Berat">Berat</option>
                                                <?php elseif ($data_relasi['jenis_gejala'] == 'Sedang'): ?>
                                                    <option value="Sedang">Sedang</option>
                                                    <option value="Ringan">Ringan</option>
                                                    <option value="Berat">Berat</option>
                                                <?php elseif ($data_relasi['jenis_gejala'] == 'Berat'): ?>
                                                    <option value="Berat">Berat</option>
                                                    <option value="Ringan">Ringan</option>
                                                    <option value="Sedang">Sedang</option>
                                                <?php else: ?>
                                                    <option value="Ringan">Ringan</option>
                                                    <option value="Sedang">Sedang</option>
                                                    <option value="Berat">Berat</option>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="bobot" class="form-label">Bobot</label>
                                            <input type="number" step="0.01" class="form-control" id="bobot" name="bobot" value="<?= $data_relasi['bobot']; ?>" required>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnUbahRelasi" class="btn btn-primary">Submit</button>
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