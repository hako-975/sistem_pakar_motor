<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $get_gejala = mysqli_query($conn, "SELECT * FROM gejala ORDER BY kd_gejala ASC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Hasil Diagnosa Mesin</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahDiagnosaMesin'])) {
            $id_mekanik = $_POST['id_mekanik'];
            if (!isset($_POST['gejala'])) {
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

            $sql1 = "DELETE FROM tmp_kerusakan";
            $kosong_tmp_kerusakan = mysqli_query($conn, $sql1);

            // mengambil variabel dari halaman konsultasiFM.php
            $gejala = '';
            $events = '';
            
            if (isset($_POST['gejala']))
            {
                $selectors  = htmlentities(implode(',', $_POST['gejala']));
            }

            $data = $selectors;
            $input = $data;
            //memecahkan string input berdasarkan karakter '\r\n\r\n'
            $pecah = explode("\r\n\r\n", $input);
            // string kosong inisialisasi
            $text = "";
            for ($i = 0; $i <= count($pecah)-1; $i++)
            {
                $part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
                $text .= $part;
            }
            
            //menampilkan outputnya
            // echo $text;
            $kosongtabel = mysqli_query($conn, "DELETE FROM tmp_gejala");
            $text_line = $data;
            $text_line = explode(",", $text_line);
            $posisi = 0;

            for ($start = 0; $start < count($text_line); $start++) {
                $baris = $text_line[$start]; 
                $sql = "INSERT INTO tmp_gejala (kd_gejala) VALUES ('$baris')";
                $query = mysqli_query($conn, $sql);
                $posisi++;
            }

            $sqlkerusakan = "SELECT * FROM relasi GROUP BY kd_kerusakan";
            $querykerusakan = mysqli_query($conn, $sqlkerusakan);
            $Similarity = 0;

            while ($rowkerusakan = mysqli_fetch_assoc($querykerusakan)) 
            {

                $kd_pen = $rowkerusakan['kd_kerusakan'];

                //mengambil gejala di tabel relasi
                $query_gejala = mysqli_query($conn,"SELECT * FROM relasi WHERE kd_kerusakan='$kd_pen'");
                $var1 = 0; $var2 = 0; $var3 = 0;
                $querySUM = mysqli_query($conn,"SELECT sum(bobot) AS jumlahbobot FROM relasi WHERE kd_kerusakan = '$kd_pen'");
                $resSUM = mysqli_fetch_assoc($querySUM);
                // echo $resSUM['jumlahbobot'] ."<br>";
                $SUMbobot = $resSUM['jumlahbobot'];

                while ($row_gejala = mysqli_fetch_assoc($query_gejala))
                {
                    // kode gejala di tabel relasi
                    $kode_gejala_relasi = $row_gejala['kd_gejala'];
                    $bobotRelasi=$row_gejala['bobot'];

                    // mencari data di tabel tmp_gejala dan membandingkannya
                    $query_tmp_gejala = mysqli_query($conn,"SELECT * FROM tmp_gejala WHERE kd_gejala = '$kode_gejala_relasi'");
                    $row_tmp_gejala = mysqli_fetch_assoc($query_tmp_gejala);

                    // Mengecek apakah ada data di tabel tmp_gejala
                    $adadata = mysqli_num_rows($query_tmp_gejala);
                    if ($adadata !== 0)
                    {
                        $bobotNilai = $bobotRelasi * 1;
                        $HasilKaliSatu;
                        $var1 = $bobotNilai / $SUMbobot;
                        $var3 = $var3+$var1;
                    } else {
                        $bobotNilai = $bobotRelasi * 0; 
                        $var2 = $bobotNilai + $bobotNilai;
                    }
                
                    $Nilai_tmp_gejala = $var1 + $var2; 
                }

                // input data ke tabel tmp_kerusakan     
                $query_tmp_kerusakan = mysqli_query($conn,"INSERT INTO tmp_kerusakan (kd_kerusakan, nilai) VALUES ('$kd_pen', '$var3')");

                $nilaiMax = mysqli_query($conn, "SELECT kd_kerusakan, MAX(nilai) AS NilaiAkhir FROM tmp_kerusakan GROUP BY nilai ORDER BY nilai ASC");

                $nilaiMin = mysqli_query($conn, "SELECT kd_kerusakan, MAX(nilai) AS NilaiAkhir FROM tmp_kerusakan GROUP BY nilai ORDER BY nilai DESC");

                $rowMax = mysqli_fetch_assoc($nilaiMax);
                $kerusakanakhir = $rowMax['kd_kerusakan'];
                
                $sql_pilih_kerusakan = mysqli_query($conn, "SELECT * FROM kerusakan_solusi WHERE kd_kerusakan = '$kerusakanakhir'");
                
                $row_hasil = mysqli_fetch_assoc($sql_pilih_kerusakan);
                
                $kd_kerusakan = $row_hasil['kd_kerusakan'];
                $kerusakan = $row_hasil['nama_kerusakan'];
                $keterangan_kerusakan = $row_hasil['definisi'];
                $solusi = $row_hasil['solusi'];
            }

            $query_gejala_input = mysqli_query($conn, "SELECT gejala.gejala AS namagejala, tmp_gejala.kd_gejala FROM gejala, tmp_gejala WHERE tmp_gejala.kd_gejala = gejala.kd_gejala");

            $nogejala = 0;
            
            

            //mencari persen
            $query_nilai = mysqli_query($conn, "SELECT SUM(nilai) as nilaiSum FROM tmp_kerusakan");
            $rowSUM = mysqli_fetch_array($query_nilai);
            $nilaiTotal = $rowSUM['nilaiSum'];
            // echo $nilaiTotal."<br>";

            

            
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
                            <h3 class="mb-0">Hasil Diagnosa Mesin</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="laporan_user.php">Diagnosa Mesin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Hasil Diagnosa Mesin
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
                                while ($row_gejala_input = mysqli_fetch_array($query_gejala_input)) 
                                {
                                    $nogejala++;
                                    echo $nogejala. ".". $row_gejala_input['namagejala']. "<br>";
                                } 

                                $query_sum_tmp = mysqli_query($conn, "SELECT * FROM tmp_kerusakan ORDER BY nilai DESC LIMIT 0, 6");
                                while ($row_sumtmp = mysqli_fetch_array($query_sum_tmp))
                                {
                                    $nilai = $row_sumtmp['nilai'];
                                    $nilai_persen = $nilai;
                                    $data_persen = $nilai_persen * 100;
                                    $persen = substr($data_persen, 0, 5);
                                    $kd_pen2 = $row_sumtmp['kd_kerusakan'];

                                    $query_penyasol = mysqli_query($conn, "SELECT * FROM kerusakan_solusi WHERE kd_kerusakan = '$kd_pen2'");
                                    while ($row_penyasol = mysqli_fetch_array($query_penyasol))
                                    {
                                        echo "Persentase kerusakan mesin motor " . $row_penyasol['nama_kerusakan'] . " Sebesar ". $persen . "%". "<br>";
                                        // simpan data
                                        $id_user = $dataUser['id_user'];
                                        $query_hasil2 = "INSERT INTO analisa_hasil(id_user, id_mekanik, kd_kerusakan, tanggal) VALUES ('$id_user', '$id_mekanik','$kd_pen2', CURRENT_TIMESTAMP())";
                                        $res_hasil2 = mysqli_query($conn, $query_hasil2);
                                        if ($res_hasil2) {
                                            echo "";
                                        } else {
                                            echo "<font color='#FF0000'>Data tidak dapat disimpan..!</font><br>";
                                        }
                                    }
                                }

                                $query_kesimpulan_akhir = mysqli_query($conn, "SELECT * FROM tmp_kerusakan ORDER BY nilai DESC LIMIT 0, 1");
            
                                while ($row_sumtmp = mysqli_fetch_array($query_kesimpulan_akhir))
                                {
                                    $nilai = $row_sumtmp['nilai'];
                                    $nilai_persen = $nilai;
                                    $data_persen = $nilai_persen * 100;
                                    $persen = substr($data_persen, 0, 5);
                                    $kd_pen2 = $row_sumtmp['kd_kerusakan'];

                                    $query_penyasol = mysqli_query($conn,"SELECT * FROM kerusakan_solusi WHERE kd_kerusakan = '$kd_pen2'");
                                    while ($row_penyasol=mysqli_fetch_array($query_penyasol))
                                    {
                                        echo "<p>"."<strong>Dilihat dari hasil persentase setiap kerusakan yang tertera, mesin anda mengalami kerusakan ".$row_penyasol['nama_kerusakan']." sebesar ".$persen." % </p></strong>";
                                        echo "<p>"."<strong style=color:#C60>Solusi Perbaikan :</strong><br><br> ".$row_penyasol['solusi']."</p><hr>";
                                    }
                                }
                            ?>
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