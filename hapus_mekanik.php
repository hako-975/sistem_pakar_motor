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
    
	$id_mekanik = $_GET['id_mekanik'];

    $data_mekanik = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mekanik WHERE id_mekanik = '$id_mekanik'"));
    $nama_mekanik = $data_mekanik['nama_mekanik'];
    
	$delete_mekanik = mysqli_query($conn, "DELETE FROM mekanik WHERE id_mekanik = '$id_mekanik'");

	if ($delete_mekanik) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Mekanik $nama_mekanik berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");


		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Mekanik " . $nama_mekanik . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'mekanik.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Mekanik $nama_mekanik gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Mekanik " . $nama_mekanik . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'mekanik.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
