<?php 

$jenis_akun = $_SESSION['jenis_akun'];
if ($jenis_akun === 'Admin') {
	$sapaan = 'Admin';
	$pesan = 'Periksa data pendaftar dengan teliti!';
} else {
	$sapaan = 'calon siswa';
	$pesan = 'Silakan isi data calon siswa di bagian Data Pendaftar.';
}

?>
<br><br><br>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Selamat datang <?= $sapaan; ?></h1>
    <p class="lead"><?= $pesan; ?></p>
  </div>
</div>