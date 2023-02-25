<?php

	include './config/koneksi-db.php';

	$no = '0'; // variable untuk menentukkan user
			if(isset($_GET['no'])) { // memeriksa variable
				$no = $_GET['no'];
			}

	if (!isset($_POST['simpan'])) {
		// Query
		$sql = "SELECT * FROM data_pendaftar WHERE no_pendaftar = '{$no}';";
		$query = mysqli_query($db_conn, $sql);
		$row = $query->num_rows;
		$data = mysqli_fetch_array($query);

		if ($row > 0) {
			$no_pendaftar = $data['no_pendaftar'];
			$nama_lengkap = $data['nama_lengkap'];
			$nik = $data['nik'];
			$jenis_kelamin = $data['jenis_kelamin'];
			$sekolah_asal = $data['sekolah_asal'];
			$status = $data['status'];
		} else {
			echo "<script>alert('ID Pendaftaran tidak ditemukan!');</script>";
			// mengalihkan halaman
			echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
			exit;
		}

 ?>

<br><br><br>
<h2>Data Pendaftar</h2>
<br>
<form method="POST">
	<div class="form-group row">
		<label for="no_pendaftar" class="col-sm-2 col-form-label">No Pendaftaran</label>
		<div class="col-sm-10">
			<input readonly name="no_pendaftar" type="text" class="form-control" id="no_pendaftar" placeholder="Tidak perlu diisi" value="<?php echo ($row > 0) ? $data['no_pendaftar'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
		<div class="col-sm-10">
			<input readonly name="nama_lengkap" type="text" class="form-control" id="nama_lengkap" placeholder="Isi Nama Lengkap" value="<?php echo ($row > 0) ? $data['nama_lengkap'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="nik" class="col-sm-2 col-form-label">NIK</label>
		<div class="col-sm-10">
			<input readonly name="nik" type="number" class="form-control" id="nik" placeholder="Isi Nomor Induk Kependudukan" value="<?php echo ($row > 0)? $data['nik'] : ''; ?>">
		</div>
	</div>
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L" <?php echo ($row > 0 && $data['jenis_kelamin'] == 'L') ? 'checked' : ''; ?> disabled>
					<label class="form-check-label" for="laki-laki">
						Laki-laki
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?php echo ($row > 0 && $data['jenis_kelamin'] == 'P') ? 'checked' : ''; ?> disabled>
					<label class="form-check-label" for="perempuan">
						Perempuan
					</label>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="form-group row">
		<label for="sekolah_asal" class="col-sm-2 col-form-label">Sekolah Asal</label>
		<div class="col-sm-10">
			<input readonly name="sekolah_asal" type="text" class="form-control" id="sekolah_asal" placeholder="Isi Sekolah Asal" value="<?php echo ($row > 0) ? $data['sekolah_asal'] : '' ; ?>">
		</div>
	</div>
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">Status</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="status" id="D" value="D" <?php echo ($row > 0 && $data['status'] == 'D') ? 'checked' : ''; ?>>
					<label class="form-check-label" for="D">
						<span class="badge badge-success">Diterima</span>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="status" id="T" value="T" <?php echo ($row > 0 && $data['status'] == 'T') ? 'checked' : ''; ?>>
					<label class="form-check-label" for="T">
						<span class="badge badge-danger">Tidak Diterima</span>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="status" id="C" value="C" <?php echo ($row > 0 && $data['status'] == 'C') ? 'checked' : ''; ?>>
					<label class="form-check-label" for="C">
						<span class="badge badge-warning">Cadangan</span>
					</label>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="form-group row">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">
			<button name="simpan" type="simpan" class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

<?php

	} else {
		$status = $_POST['status'];
		$no = $_GET['no'];
		// Query
		$sql = "UPDATE data_pendaftar 
		 		SET status 	= '{$status}'
		 		WHERE no_pendaftar	='{$no}'";
		$query = mysqli_query($db_conn, $sql);

		echo "<script>alert('Berhasil disimpan');</script>";
		// mengalihkan halaman
		echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
		exit;
	}

 ?>
