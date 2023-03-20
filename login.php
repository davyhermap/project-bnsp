<?php
session_start();
if (!isset($_SESSION['role'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Login | Lembaga Kursus</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
		<script src="https://kit.fontawesome.com/461ced2cb1.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

		<style>
			body {
				background-color: lightsteelblue;
			}

			form {
				width: 450px;
				background-color: white;
			}
		</style>
	</head>

	<body>
		<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
			<form action="template/check-login.php" method="post" class="shadow p-4 rounded needs-validation" novalidate>
				<h3 class="text-center">Lembaga Kursus</h3>
				<h4 class="text-center mb-4" style="font-weight: normal;">Universitas Jewepe</h4>
				<p style="color: grey;">Silakan login dengan npm (bagi mahasiswa)</p>

				<?php if (isset($_GET['error'])) { ?>
					<!-- Notifikasi error -->
					<div class="alert alert-danger" role="alert">
						<?= $_GET['error'] ?>
					</div>
				<?php } elseif (isset($_GET['success'])) { ?>
					<!-- Notifikasi success -->
					<div class="alert alert-success" role="alert">
						<?= $_GET['success'] ?>
					</div>
				<?php } ?>

				<div class="form-group">
					<label for="uname">Username</label>
					<input type="text" class="form-control" id="uname" placeholder="Masukkan username" name="username" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<div class="form-group">
					<label for="pwd">Password</label>
					<input type="password" class="form-control" id="pwd" placeholder="Masukkan password" name="password" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<button type="submit" class="btn btn-primary" name="login">Login</button>
			</form>
		</div>

		<script>
			// Disable form submissions if there are invalid fields
			(function() {
				'use strict';
				window.addEventListener('load', function() {
					// Get the forms we want to add validation styles to
					var forms = document.getElementsByClassName('needs-validation');
					// Loop over them and prevent submission
					var validation = Array.prototype.filter.call(forms, function(form) {
						form.addEventListener('submit', function(event) {
							if (form.checkValidity() === false) {
								event.preventDefault();
								event.stopPropagation();
							}
							form.classList.add('was-validated');
						}, false);
					});
				}, false);
			})();
		</script>

	<?php include('template/footer.php'); // menampilkan footer
} else {
	header("Location: home.php"); // jika sudah login maka membuka home.php
} ?>