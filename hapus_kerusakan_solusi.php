<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	if ($dataUser['jabatan'] == 'petugas') {
        header("Location: index.php");
        exit;
    }
    
	$kd_kerusakan = $_GET['kd_kerusakan'];

    $data_kerusakan_solusi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kerusakan_solusi WHERE kd_kerusakan = '$kd_kerusakan'"));

	$delete_user = mysqli_query($conn, "DELETE FROM kerusakan_solusi WHERE kd_kerusakan = '$kd_kerusakan'");

	if ($delete_user) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kerusakan & Solusi $kd_kerusakan berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");


		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Kerusakan & Solusi " . $kd_kerusakan . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'kerusakan_solusi.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Kerusakan & Solusi $kd_kerusakan gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Kerusakan & Solusi " . $kd_kerusakan . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'kerusakan_solusi.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
