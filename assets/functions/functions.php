<?php 
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_psb");


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ){
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data){
	global $conn;

	$no_pendaftar = htmlspecialchars($data["no_pendaftar"]);
	$nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
	$nik = htmlspecialchars($data["nik"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$sekolah_asal = htmlspecialchars($data["sekolah_asal"]);
	$alamat = htmlspecialchars($data["alamat"]);

	// upload gambar
	$gambar = upload();
	if (!$gambar){
		return false;
	}

	$query = "INSERT INTO daftar_produk
				VALUES
				('','$kode_barang','$nama_barang','$harga_jual','$harga_beli','$kadalwarsa','$gambar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload(){
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "<script>
				alert('pilih gambar terlebih dahulu');
				</script>";
		return false;
	}

	//cek apakah yang diupload adalah gambar
	$esktensiGambarValid = ['jpg','jpeg','png'];
	$esktensiGambar = explode('.', $namaFile);
	$esktensiGambar = strtolower(end($esktensiGambar));
	if( !in_array($esktensiGambar, $esktensiGambarValid) ){
		echo "<script>
				alert('yang anda upload bukan gambar');
				</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('gambarnya terlalu besar');
				</script>";
		return false;
	}

	//lolos pengecekan, gambar siap upload
	//generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '_';
	$namaFileBaru .= $namaFile;
	$namaFileBaru .= '.';
	$namaFileBaru .= $esktensiGambar;
	
	move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

	return $namaFileBaru;
}






function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM daftar_produk WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$id = $data["id"];
	//htmlspecialchars --> agar script html tidak jalan
	$kode_barang = htmlspecialchars($data["kode_barang"]);
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$harga_jual = htmlspecialchars($data["harga_jual"]);
	$harga_beli = htmlspecialchars($data["harga_beli"]);
	$kadalwarsa = htmlspecialchars($data["kadalwarsa"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//cek apakah user pilih gambar baru atau tidak
	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	}else{
		$gambar = upload();
	}

	$query = "UPDATE daftar_produk 
				SET
				kode_barang = '$kode_barang',
				nama_barang = '$nama_barang',
				harga_jual = '$harga_jual',
				harga_beli = '$harga_beli',
				kadalwarsa = '$kadalwarsa',
				gambar = '$gambar'
				WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword){
		$query = "SELECT * FROM daftar_produk
					WHERE
					kode_barang LIKE '%$keyword%' OR
					nama_barang LIKE '%$keyword%' OR
					harga_beli LIKE '%$keyword%' OR
					harga_jual LIKE '%$keyword%' OR
					kadalwarsa LIKE '%$keyword%'
					";
		return query($query);
}
?>