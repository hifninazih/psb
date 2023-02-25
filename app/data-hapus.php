<?php

	include './config/koneksi-db.php';
	
	if(isset($_GET['no'])) { // memperoleh no pendaftaran
		$no_pendaftar = $_GET['no'];

		if(!empty($no_pendaftar)) {
			// Query
			$sql = "DELETE FROM data_pendaftar WHERE no_pendaftar = '{$no_pendaftar}';";
			$query = mysqli_query($db_conn, $sql);

			if(!$query) {
				echo "<script>alert('Data gagal dihapus!');</script>";
			}
		} else {
			echo "<script>alert('No Pendaftaran Kosong!');</script>";
		}
	} else {
		echo "<script>alert('No Pendaftaran tidak didefinisikan!');</script>";		
	}

	// mengalihkan halaman
	echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";

?>