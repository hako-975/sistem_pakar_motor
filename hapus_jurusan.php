<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_jurusan = $_GET['id_jurusan'];

    $data_jurusan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jurusan WHERE id_jurusan = '$id_jurusan'"));
    $nama_jurusan = $data_jurusan['nama_jurusan'];

	$delete_jurusan = mysqli_query($conn, "DELETE FROM jurusan WHERE id_jurusan = '$id_jurusan'");

	if ($delete_jurusan) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Jurusan $nama_jurusan berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Jurusan " . $nama_jurusan . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'jurusan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Jurusan $nama_jurusan gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Jurusan " . $nama_jurusan . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'jurusan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
