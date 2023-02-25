<?php

session_start();
include './config/konfigurasi-umum.php';
include './assets/functions/functions.php';
// Harus login dulu
if(!isset($_SESSION["email"])){
	//jika belum login, arahkan ke login
	header("Location: home.php");
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PSB Online</title>
		<link rel="stylesheet" href="./assets/vendor/bootstrap-4.3/css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<?php
			include 'app/layout/navbar.php';
			include 'app/layout/container.php';
			include 'app/layout/footer.php';
			?>
		</div>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>