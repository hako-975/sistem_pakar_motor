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

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Kerusakan & Solusi</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahKerusakanSolusi'])) {
            $kd_kerusakan = htmlspecialchars($_POST['kd_kerusakan']);
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kerusakan_solusi WHERE kd_kerusakan = '$kd_kerusakan'")) > 0) {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Kode Kerusakan sudah digunakan!',
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

            $nama_kerusakan = htmlspecialchars($_POST['nama_kerusakan']);
            $definisi = htmlspecialchars($_POST['definisi']);
            $solusi = htmlspecialchars($_POST['solusi']);

            $insert_kerusakan_solusi = mysqli_query($conn, "INSERT INTO kerusakan_solusi VALUES ('$kd_kerusakan', '$nama_kerusakan', '$definisi', '$solusi')");

            if ($insert_kerusakan_solusi) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kerusakan Solusi $kd_kerusakan berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Kerusakan & Solusi " . $kd_kerusakan . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'kerusakan_solusi.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kerusakan & Solusi $kd_kerusakan gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Kerusakan & Solusi " . $kd_kerusakan . " gagal ditambahkan!'
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
                            <h3 class="mb-0">Tambah Kerusakan & Solusi</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="kerusakan_solusi.php">Kerusakan & Solusi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Kerusakan & Solusi
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
                                            <label for="kd_kerusakan" class="form-label">Kode Kerusakan</label>
                                            <input type="text" class="form-control" id="kd_kerusakan" name="kd_kerusakan" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="nama_kerusakan" class="form-label">Nama Kerusakan</label> 
                                            <textarea class="form-control" id="nama_kerusakan" name="nama_kerusakan" required></textarea>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="definisi" class="form-label">Definisi</label> 
                                            <textarea class="form-control" id="definisi" name="definisi" required></textarea>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="solusi" class="form-label">Solusi</label> 
                                            <textarea class="form-control" id="solusi" name="solusi" required></textarea>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnTambahKerusakanSolusi" class="btn btn-primary">Submit</button>
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