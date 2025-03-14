<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $get_gejala = mysqli_query($conn, "SELECT * FROM gejala ORDER BY kd_gejala ASC");
    $mekanik = mysqli_query($conn, "SELECT * FROM mekanik ORDER BY nama_mekanik ASC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Diagnosa Mesin</title>
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
                            <h3 class="mb-0">Tambah Diagnosa Mesin</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="laporan_user.php">Diagnosa Mesin</a></li>
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
                                <form method="post" action="hasil_diagnosa.php"> 
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
                                        <h4 class="text-center">Pilih Gejala Yang Dialami</h4>
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