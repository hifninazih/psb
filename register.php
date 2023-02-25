<?php

	session_start();
	include './config/konfigurasi-umum.php';
	include './config/koneksi-db.php';

	if(isset($_SESSION["email"]))
	{
		//jika sudah login, arahkan ke index
		header("Location: index.php");
		exit;
	}
	if(!isset($_POST['register'])) {

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Buat Akun Baru</title>
		<link rel="stylesheet" href="assets/vendor/bootstrap-4.3/css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-5">
					<div class="mt-4">
						<h2>Buat Akun</h2>
					</div>
					<hr>
					<form method="POST">
						<div class="form-group">
							<label for="email"><i>E-mail</i></label>
							<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukkan alamat e-mail" required>
						</div>
						<div class="form-group">
							<label for="no_hp">No.HP</label>
							<input name="no_hp" type="tel" class="form-control" id="no_hp" placeholder="Masukkan nomor HP/WA" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input name="password" type="password" class="form-control" id="password" placeholder="Masukkan password" required>
						</div>
						<div class="form-group">
							<label for="konfirmasi-password">Konfirmasi Password</label>
							<input name="re-password" type="password" class="form-control" id="konfirmasi-password" placeholder="Masukkan ulang password" required>
						</div>
						<button name="register" type="submit" class="btn btn-success mr-2">Buat Akun</button>
						<label>
							<a href="login.php">Sudah punya akun?</a>
						</label>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

<?php

	} else {

		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$no_hp = $_POST['no_hp'];

		// Query
		$sql = "INSERT INTO akun 
				VALUES('', '{$email}', '{$password}', 
						'{$no_hp}', 'Pendaftar')";
		$query = mysqli_query($db_conn, $sql);

		echo "<script>alert('Berhasil membuat akun!');</script>";
		echo "<meta http-equiv='refresh' content='0; url=login.php'>";
	}
	
?>

<?php 
	include './app/layout/footer.php';
 ?>