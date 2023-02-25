<?php

	echo '<br><br><br>';
	include './config/koneksi-db.php';
	
	if($_SESSION['jenis_akun'] === 'Pendaftar') {
		//Jenis Akun Pendaftar
		if(!isset($_POST['simpan'])) {
			//Jika belum klik simpan
			// Query
			$sql = "SELECT * FROM data_pendaftar WHERE email = '{$_SESSION['email']}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			if($row > 0) {
			//jika data ditemukan
				$data = mysqli_fetch_array($query); // memperoleh data
			}

?>

<h2>Form Pendaftaran</h2>
<br>
<form method="POST" enctype="multipart/form-data">
	<input type="hidden" name="nama_file" value="<?= $data['file_ijazah']; ?>">
	<div class="form-group row">
		<label for="no_pendaftar" class="col-sm-2 col-form-label">No Pendaftaran</label>
		<div class="col-sm-10">
			<input readonly name="no_pendaftar" type="text" class="form-control" id="no_pendaftar" placeholder="Tidak perlu diisi" value="<?php echo ($row > 0) ? $data['no_pendaftar'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
		<div class="col-sm-10">
			<input name="nama_lengkap" type="text" class="form-control" id="nama_lengkap" placeholder="Isi Nama Lengkap" value="<?php echo ($row > 0) ? $data['nama_lengkap'] : ''; ?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="nik" class="col-sm-2 col-form-label">NIK</label>
		<div class="col-sm-10">
			<input name="nik" type="number" class="form-control" id="nik" placeholder="Isi Nomor Induk Kependudukan" value="<?php echo ($row > 0)? $data['nik'] : ''; ?>" required>
		</div>
	</div>
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L" <?php echo ($row > 0 && $data['jenis_kelamin'] == 'L') ? 'checked' : ''; ?>>
					<label class="form-check-label" for="laki-laki">
						Laki-laki
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?php echo ($row > 0 && $data['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>>
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
			<input name="sekolah_asal" type="text" class="form-control" id="sekolah_asal" placeholder="Isi Sekolah Asal" value="<?php echo ($row > 0) ? $data['sekolah_asal'] : '' ; ?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
		<div class="col-sm-10">
			<textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" placeholder="Isi Alamat" rows="3" required><?php echo ($row > 0) ? $data['alamat'] : '' ; ?></textarea>
		</div>
	</div>

  	<div class="form-group row">
  		<label for="ijazah" class="col-sm-2 col-form-label">Upload Ijazah</label>
  		<div class="col-sm-10">
    		<input type="file" name="ijazah" class="form-control-file" id="ijazah">
    		<?php 
    			if ($row > 0) {
    				echo '<a target="_blank" href="assets/ijazah/' . $data['file_ijazah'] . '">' . $data['file_ijazah'] . '</a>';
    			}
    		?>
    	</div>
  	</div>

	<div class="form-group row">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">
			<button name="simpan" type="simpan" class="btn btn-primary">Simpan</button>
			<a class="btn btn-secondary ml-2" href="<?php echo ($row > 0) ? 'cetak.php?no=' . $data['no_pendaftar'] : 'index.php'; ?>" role="button" target='_blank'>Cetak</a>
		</div>
	</div>
</form>

<?php

		} else {
		//Jika klik simpan
			// Query
			$sql = "SELECT * FROM data_pendaftar WHERE email = '{$_SESSION['email']}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;

			if ($row > 0) {
			//jika data sudah diisi sebelumnya
				$nama_lengkap = $_POST['nama_lengkap'];
				$nik = $_POST['nik'];
				$jenis_kelamin = $_POST['jenis_kelamin'];
				$sekolah_asal = $_POST['sekolah_asal'];
				$alamat = $_POST['alamat'];

				//cek apakah user pilih file baru atau tidak
				if($_FILES['ijazah']['error'] === 4){
					$nama_file_baru = $_POST['nama_file'];;
				}else{
					$nama_file_asli = $_FILES['ijazah']['name']; // nama file.ext
					$error = $_FILES['ijazah']['error'];
					$tmp_name = $_FILES['ijazah']['tmp_name'];

					//cek apakah yang diupload adalah pdf
					$esktensi_file_valid = ['pdf'];
					$esktensi_file = explode('.', $nama_file_asli);
					$esktensi_file = strtolower(end($esktensi_file));
					if( !in_array($esktensi_file, $esktensi_file_valid) ){
						echo "<script>
								alert('File ijazah harus memiliki format pdf');
							</script>";

						//Mengalihkan halaman
						echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
						return false;
					}

					//lolos pengecekan, file siap upload
					//generate nama file baru
					$nama_file_baru = uniqid();
					$nama_file_baru .= '_';
					$nama_file_baru .= $nama_file_asli;

					$status_upload = move_uploaded_file($tmp_name, './assets/ijazah/'.$nama_file_baru);

					if (!$status_upload){
						echo "<script>
								alert('Data gagal diupload!');
							</script>";
						//Mengalihkan halaman
						echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
						return false;
					}
				}


				// Query
				$sql = "UPDATE data_pendaftar 
						SET nama_lengkap 	= '{$nama_lengkap}',
							nik 			= '{$nik}',
							jenis_kelamin	= '{$jenis_kelamin}',
							sekolah_asal	= '{$sekolah_asal}',
							alamat			= '{$alamat}',
							file_ijazah		= '{$nama_file_baru}'
						WHERE email			='{$_SESSION['email']}'";
				$query = mysqli_query($db_conn, $sql);

				//Jika data gagal diubah
				if(!$query) {
					echo "<script>alert('Data gagal diubah!');</script>";
				}

				//Mengalihkan halaman
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";

			} elseif ($row === 0) {
				//Data Baru
				$nama_file_asli = $_FILES['ijazah']['name']; // nama file.ext
				$error = $_FILES['ijazah']['error'];
				$tmp_name = $_FILES['ijazah']['tmp_name'];

				//cek apakah tidak ada gambar yang diupload
				if ($error === 4) {
					echo "<script>
							alert('Pilih file ijazah terlebih dahulu');
						</script>";
					//Mengalihkan halaman
					echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
					return false;
				}

				//cek apakah yang diupload adalah pdf
				$esktensi_file_valid = ['pdf'];
				$esktensi_file = explode('.', $nama_file_asli);
				$esktensi_file = strtolower(end($esktensi_file));
				if( !in_array($esktensi_file, $esktensi_file_valid) ){
					echo "<script>
							alert('File ijazah harus memiliki format pdf');
						</script>";
					//Mengalihkan halaman
					echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
					return false;
				}

				//lolos pengecekan, file siap upload
				//generate nama file baru
				$nama_file_baru = uniqid();
				$nama_file_baru .= '_';
				$nama_file_baru .= $nama_file_asli;

				$status_upload = move_uploaded_file($tmp_name, './assets/ijazah/'.$nama_file_baru);

				if (!$status_upload){
					echo "<script>
							alert('Data gagal diupload!');
						</script>";
					//Mengalihkan halaman
					echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
					return false;
				}

				$nama_lengkap = $_POST['nama_lengkap'];
				$nik = $_POST['nik'];
				$jenis_kelamin = $_POST['jenis_kelamin'];
				$sekolah_asal = $_POST['sekolah_asal'];
				$alamat = $_POST['alamat'];
				$email = $_SESSION['email'];

				$sql = "INSERT INTO data_pendaftar 
						VALUES 	('',
								'$email',
								'$nama_lengkap',
								'$nik',
								'$jenis_kelamin',
								'$sekolah_asal',
								'$alamat',
								'$nama_file_baru',
								'B')";
				$query = mysqli_query($db_conn, $sql);

				echo "<script>alert('Berhasil ditambahkan');</script>";
				// mengalihkan halaman
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
				exit;
			}
		}

	} else {
	/*Jenis akun Admin*/
		/* Query */
		$sql = "SELECT * FROM data_pendaftar ORDER BY no_pendaftar;";
		$query = mysqli_query($db_conn, $sql);

?>

<div class="page-title">
	<h3>Data Pendaftar</h3>	
</div>

<table class="table table-bordered">
 	<thead>
    	<tr>
      		<th class="text-center" scope="col">No</th>
      		<th class="text-center" scope="col">No.Pendaftaran</th>
      		<th class="text-center" scope="col">Nama</th>
      		<th class="text-center" scope="col">Status</th>
      		<th class="text-center" scope="col">Aksi</th>
    	</tr>
  	</thead>
  	<tbody>
  		<?php

  			$i = 1;
			while($data = mysqli_fetch_array($query)) {

		?>

    	<tr>
      		<th class="text-center" scope="row"><?php echo $i++; ?></th>
      		<td><?php echo $data['no_pendaftar']; ?></td>
      		<td><?php echo $data['nama_lengkap']; ?></td>
      		<td class="text-center"><?php if($data['status'] == 'D'){ echo '<span class="badge badge-success">Diterima</span>';} elseif($data['status'] == 'T') { echo '<span class="badge badge-danger">Tidak Diterima</span>';} elseif($data['status'] == 'C') { echo '<span class="badge badge-warning">Cadangan</span>';} else { echo '<span class="badge badge-secondary">Belum diseleksi</span>';} ?>
      		</td>
      		<td class="text-center">
      			<a class="btn btn-success" href="index.php?p=data-detail&no=<?php echo $data['no_pendaftar']; ?>" role="button">Detail</a>
      			<a class="btn btn-primary" href="index.php?p=data-info&no=<?php echo $data['no_pendaftar']; ?>" role="button">Info Akun</a>
      			<a class="btn btn-danger confirm" href="index.php?p=data-hapus&no=<?php echo $data['no_pendaftar']; ?>" role="button">Hapus</a>
      		</td>
    	</tr>

    	<?php 
    		}
    	?>
    	
  	</tbody>
</table>

<?php 
	}
?>