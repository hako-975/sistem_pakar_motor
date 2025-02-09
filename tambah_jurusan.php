<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Jurusan</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahJurusan'])) {
            $nama_jurusan = htmlspecialchars($_POST['nama_jurusan']);

            $insert_jurusan = mysqli_query($conn, "INSERT INTO jurusan VALUES ('', '$nama_jurusan', CURRENT_TIMESTAMP())");

            if ($insert_jurusan) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Jurusan $nama_jurusan berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Jurusan " . $nama_jurusan . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'jurusan.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Jurusan $nama_jurusan gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Jurusan " . $nama_jurusan . " gagal ditambahkan!'
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
                            <h3 class="mb-0">Tambah Jurusan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="jurusan.php">Jurusan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Jurusan
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
                                            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" required>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3 text-end">
                                        <button type="submit" name="btnTambahJurusan" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Submit</button>
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