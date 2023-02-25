<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Selamat Datang Calon Siswa</title>
		<link rel="stylesheet" href="assets/vendor/bootstrap-4.3/css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-10">
					<div class="jumbotron">
						<h1 class="display-5">Selamat Datang Calon Siswa</h1>
						<p class="lead">Silakan <i>log-in</i> menggunakan akun pendaftaran untuk melengkapi persyaratan</p>
						<hr class="my-4">
						<p>Jika belum mempunyai akun silakan membuat akun pendaftaran terlebih dahulu</p>
						<a class="btn btn-primary btn-md mr-2" href="login.php" role="button">Log-in</a>
						<a class="btn btn-success btn-md" href="register.php" role="button">Buat akun</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php 

	include './config/konfigurasi-umum.php';
	include './app/layout/footer.php';
	
 ?>