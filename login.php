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

	if(!isset($_POST['login'])) {
		
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
		<link rel="stylesheet" href="assets/vendor/bootstrap-4.3/css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<div class="row justify-content-center mt-5">
				<div class="col-5">
					<div class="mt-4">
						<h2>Log-in</h2>
					</div>
					<hr>
					<form method="POST">
						<div class="form-group">
							<label for="email"><i>E-mail</i></label>
							<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukkan alamat e-mail" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input name="password" type="password" class="form-control" id="password" placeholder="Masukkan password" required>
						</div>
						<button name="login" type="submit" class="btn btn-primary mr-2">Login</button>
						<label>
							<a href="register.php">Belum punya akun?</a>
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
		$password = $_POST['password'];

		$sql = "SELECT * FROM `akun` WHERE `email` = '{$email}'";
		$query = mysqli_query($db_conn, $sql);

		if($query->num_rows > 0) {
			$data = mysqli_fetch_array($query);

			if(password_verify($password, $data['password'])){
				$_SESSION['id_akun'] = $data['id_akun'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['no_hp'] = $data['no_hp'];
				$_SESSION['jenis_akun'] = $data['jenis_akun'];
				
				echo "<script>alert('Login Berhasil!');</script>";
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
			} else {
				echo "<script>alert('Login Gagal!');</script>";
			  	echo "<meta http-equiv='refresh' content='0; url=login.php'>";
			}
		} else {
			echo "<script>alert('Login Gagal!');</script>";
			echo "<meta http-equiv='refresh' content='0; url=login.php'>";
		}
	}
?>

<?php 
	include './app/layout/footer.php';
 ?>