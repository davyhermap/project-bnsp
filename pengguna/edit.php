<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include '../template/header/header-pengguna.php'; // menampilkan header

	if ($_GET['id_user']) {
		$id = $_GET['id_user']; // mengambil id yang dipilih

		$sql = "SELECT * FROM user WHERE id_user='$id'"; // mengambil data berdasarkan id
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result); // menyimpan hasil eksekusi ke dalam array
?>

		<div class="container">
			<form action="" method="post" class="needs-validation" novalidate>
				<h2 class="py-5">Ubah Data Pengguna</h2>
				<div class="form-group">
					<label for="uname">Username</label>
					<input type="text" class="form-control" id="uname" value="<?= $row['username'] ?>" name="username" maxlength="16" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<div class="form-group">
					<label for="name">Nama</label>
					<input type="text" class="form-control" id="name" value="<?= $row['nama'] ?>" name="nama" maxlength="32" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<div class="form-group">
					<label for="telp">Nomor Telepon</label>
					<input type="text" class="form-control" id="telp" value="<?= $row['telepon'] ?>" name="telp" maxlength="13" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<button type="submit" class="btn btn-primary mb-5" name="submit">Ubah</button>
				<a href="index.php"><button type="button" class="btn btn-outline-secondary ml-3 mb-5">Batal</button></a>
			</form>
		</div>

<?php
		if (isset($_POST['submit'])) {
			// menyimpan hasil input dari form
			$username = $_POST['username'];
			$nama = $_POST['nama'];
			$telp = $_POST['telp'];

			// mengubah data pada tabel user berdasarkan id
			$sql = "UPDATE user SET username='$username', nama='$nama', telepon='$telp'
				WHERE id_user='$id'";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				// menampilkan notifikasi apabila eksekusi berhasil
				header("Location: index.php?success=Data pengguna berhasil diubah");
			} else {
				// menampilkan notifikasi apabila eksekusi gagal
				header("Location: index.php?error=Gagal mengubah data pengguna");
			}
		}
	} else {
		header("Location: ../");
	}
} ?>