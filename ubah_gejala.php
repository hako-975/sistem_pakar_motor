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

    $kd_gejala = $_GET['kd_gejala'];
    $data_gejala = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gejala WHERE kd_gejala = '$kd_gejala'"));
    if ($data_gejala == null) {
        header("Location: gejala.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah Gejala - <?= $data_gejala['kd_gejala']; ?></title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        $kd_gejala = $data_gejala['kd_gejala'];
        
        if (isset($_POST['btnUbahGejala'])) {
            $gejala = htmlspecialchars($_POST['gejala']);
            $deskripsi_gejala = htmlspecialchars($_POST['deskripsi_gejala']);

            $update_gejala = mysqli_query($conn, "UPDATE gejala SET gejala = '$gejala', deskripsi_gejala = '$deskripsi_gejala' WHERE kd_gejala = '$kd_gejala'");

            if ($update_gejala) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Gejala $kd_gejala berhasil diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Gejala " . $kd_gejala . " berhasil diubah!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'gejala.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Gejala $kd_gejala gagal diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gejala " . $kd_gejala . " gagal diubah!'
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
                            <h3 class="mb-0">Ubah Gejala - <?= $data_gejala['kd_gejala']; ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="gejala.php">Gejala</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Ubah Gejala
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
                                            <label for="kd_gejala" class="form-label">Kode Gejala</label>
                                            <input type="text" disabled style="cursor: not-allowed;"  class="form-control" id="kd_gejala" name="kd_gejala" value="<?= $data_gejala['kd_gejala']; ?>">
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="gejala" class="form-label">Gejala</label> 
                                            <textarea class="form-control" id="gejala" name="gejala" required><?= $data_gejala['gejala']; ?></textarea>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="deskripsi_gejala" class="form-label">Deskrispi Gejala</label> 
                                            <textarea class="form-control" id="deskripsi_gejala" name="deskripsi_gejala" required><?= $data_gejala['deskripsi_gejala']; ?></textarea>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnUbahGejala" class="btn btn-primary">Submit</button>
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