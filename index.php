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
    <title>Dashboard - Sistem Pakar Motor</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-tachometer-alt"></i> Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
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
                                    <h4 class="m-0">Selamat datang, <?= $dataUser['username']; ?>!</h4>
                                </div>
                                <div class="card-body">
                                    <h5>Sistem Pakar Deteksi Kerusakan Mesin Sepeda Motor</h5>
                                    <p>Sistem Pakar Deteksi Kerusakan Mesin Sepeda Motor merupakan sistem berbasis website yang dirancang untuk membantu bengkel dalam mendiagnosis kerusakan mesin kendaraan secara cepat dan akurat.</p>
                                    <p>Sebagai pemilik bengkel, penting untuk memiliki kewaspadaan yang tinggi terhadap berbagai jenis kerusakan yang dapat terjadi pada mesin sepeda motor. Untuk itu, adanya Sistem Pakar Deteksi Kerusakan Mesin Sepeda Motor yang menggunakan metode Case-Based Reasoning (CBR) dapat dijadikan salah satu solusi. Sistem ini mampu menganalisis dan mendeteksi kerusakan dengan perhitungan yang tepat, sehingga dapat membantu mekanik dalam memberikan layanan perbaikan yang lebih efisien dan profesional.</p>
                                    <a href="diagnosa_mesin.php" class="btn btn-primary"><i class="fas fa-fw fa-cogs"></i> Diagnosa Mesin</a>
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