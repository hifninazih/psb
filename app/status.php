<?php 

	echo '<br><br><br>';
	include './config/koneksi-db.php';

	// Query
	$sql = "SELECT * FROM data_pendaftar WHERE email = '{$_SESSION['email']}';";
	$query = mysqli_query($db_conn, $sql);
	$row = $query->num_rows;
	$data = mysqli_fetch_array($query);

	if ($row === 0) {

?>

<div class="alert alert-warning" role="alert">
 	<h4 class="alert-heading">Silakan isi data pendaftaran terlebih dahulu</h4>
</div>

<?php	

	} else {
		// if ($data['status']) {
		// 	$pesan = 'Pendaftaran kamu belum diseleksi';
		// 	$alert = 'alert-primary';
		// }
		switch ($data['status']) {
  			case "D":
    			$pesan = 'Selamat, kamu diterima di sekolah ini';
				$alert = 'alert-success';
    			break;
    		case "T":
    			$pesan = 'Maaf, kamu tidak diterima di sekolah ini';
				$alert = 'alert-danger';
    			break;
    		case "C":
    			$pesan = 'Kamu dinyatakan sebagai cadangan';
				$alert = 'alert-warning';
    			break;
  			default:
    			$pesan = 'Pendaftaran kamu belum diseleksi';
				$alert = 'alert-primary';
		}

?>

<div class="alert <?= $alert; ?>" role="alert">
  	<h4 class="alert-heading"><?= $pesan; ?></h4>
</div>

<?php 

	}

 ?>