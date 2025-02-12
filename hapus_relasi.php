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
    
	$id_relasi = $_GET['id_relasi'];

	$delete_relasi = mysqli_query($conn, "DELETE FROM relasi WHERE id_relasi = '$id_relasi'");

	if ($delete_relasi) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Relasi berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");


		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Relasi berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'relasi.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Relasi gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Relasi gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'relasi.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
