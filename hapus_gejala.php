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
    
	$kd_gejala = $_GET['kd_gejala'];

    $data_gejala = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gejala WHERE kd_gejala = '$kd_gejala'"));

	$delete_gejala = mysqli_query($conn, "DELETE FROM gejala WHERE kd_gejala = '$kd_gejala'");

	if ($delete_gejala) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Gejala $kd_gejala berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");


		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Gejala " . $kd_gejala . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'gejala.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Gejala $kd_gejala gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Gejala " . $kd_gejala . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'gejala.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
