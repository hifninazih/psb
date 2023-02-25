<?php

	include './config/koneksi-db.php';

	$no = '0'; // variable untuk menentukkan user
			if(isset($_GET['no'])) { // memeriksa variable
				$no = $_GET['no'];
			}
			
	// Query
	$sql = "SELECT * FROM data_pendaftar WHERE no_pendaftar = '{$no}';";
	$query = mysqli_query($db_conn, $sql);
	$row = $query->num_rows;
	$data = mysqli_fetch_array($query);

	if ($row > 0) {
		$email = $data['email'];
		// Query
		$sql = "SELECT * FROM akun WHERE email = '{$email}';";
		$query = mysqli_query($db_conn, $sql);
		$row = $query->num_rows;
		$data = mysqli_fetch_array($query);
	} else {
		echo "<script>alert('ID Pendaftaran tidak ditemukan!');</script>";
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
		exit;
	}
	
 ?>

<br><br><br>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="mt-4">
				<h2>Informasi Akun Pendaftar</h2>
			</div>
			<hr>
			<form>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="email" value=": <?= $data['email']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="no_hp" class="col-sm-2 col-form-label">No.HP</label>
					<div class="col-sm-10">
						<input type="tel" readonly class="form-control-plaintext" id="no_hp" value=": <?= $data['no_hp']; ?>">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>