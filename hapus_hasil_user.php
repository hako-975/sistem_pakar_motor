<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	if ($dataUser['jabatan'] == 'pelanggan') {
        header("Location: index.php");
        exit;
    }
    
	$id = $_GET['id'];

    $data_analisa_hasil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM analisa_hasil INNER JOIN user ON analisa_hasil.id_user = user.id_user WHERE id = '$id'"));
    $nama = $data_analisa_hasil['nama'];
	$delete_analisa_hasil = mysqli_query($conn, "DELETE FROM analisa_hasil WHERE id = '$id'");

	if ($delete_analisa_hasil) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Analisa Hasil $nama berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");


		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Analisa Hasil " . $nama . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'laporan_user.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Analisa Hasil $nama gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Analisa Hasil " . $nama . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'laporan_user.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
