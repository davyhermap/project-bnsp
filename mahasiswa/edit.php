<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include '../template/header/header-mahasiswa.php'; // menampilkan header

	if ($_GET['npm']) {
		$id = $_GET['npm']; // mengambil id yang dipilih

		$sql = "SELECT * FROM mahasiswa WHERE npm='$id'"; // mengambil data berdasarkan npm
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result); // menyimpan hasil eksekusi ke dalam array
?>

		<div class="container">
			<form action="" method="post" class="needs-validation" novalidate>
				<h2 class="py-5">Ubah Data Mahasiswa</h2>
				<div class="form-group">
					<label for="npm">NPM</label>
					<input type="text" class="form-control" id="npm" value="<?= $row['npm'] ?>" readonly>
				</div>
				<div class="form-group">
					<label for="kelas">Kelas</label>
					<input type="text" class="form-control" id="kelas" value="<?= $row['kelas'] ?>" name="kelas" maxlength="5" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama" value="<?= $row['nama'] ?>" name="nama" maxlength="64" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<button type="submit" class="btn btn-primary mb-5" name="submit">Ubah</button>
				<a href="index.php"><button type="button" class="btn btn-outline-secondary ml-3 mb-5">Batal</button></a>
			</form>
		</div>

<?php
		if (isset($_POST['submit'])) {
			// menyimpan hasil input dari form
			$kelas = $_POST['kelas'];
			$nama = $_POST['nama'];

			// mengubah data pada tabel mahasiswa berdasarkan npm
			$sql = "UPDATE mahasiswa SET kelas='$kelas', nama='$nama'
				WHERE npm='$id'";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				// menampilkan notifikasi apabila eksekusi berhasil
				header("Location: index.php?success=Data mahasiswa berhasil diubah");
			} else {
				// menampilkan notifikasi apabila eksekusi gagal
				header("Location: index.php?error=Gagal mengubah data mahasiswa");
			}
		}
	} else {
		header("Location: ../");
	}
} ?>