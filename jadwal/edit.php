<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include '../template/header/header-jadwal.php'; // menampilkan header

	if ($_GET['id_jadwal']) {
		$id = $_GET['id_jadwal']; // mengambil id yang dipilih

		$sql = "SELECT * FROM jadwal WHERE id_jadwal='$id'"; // mengambil data berdasarkan id
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result); // menyimpan hasil eksekusi ke dalam array

		$sql2 = "SELECT * FROM kursus WHERE id_kursus='" . $row['id_kursus'] . "'"; // mengambil data berdasarkan id
		$result2 = mysqli_query($conn, $sql2);
		$row2 = mysqli_fetch_array($result2); // menyimpan hasil eksekusi ke dalam array
?>

		<div class="container">
			<form action="" method="post" class="needs-validation" novalidate>
				<h2 class="py-5">Ubah Jadwal Kursus</h2>
				<div class="form-group">
					<label for="name">Nama Kursus</label>
					<input type="text" class="form-control" id="name" value="<?= $row2['nama'] ?>" readonly>
				</div>
				<div class="form-group">
					<label for="waktu">Waktu Kursus</label>
					<input type="date" class="form-control" id="waktu" value="<?= $row['waktu'] ?>" name="waktu" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<button type="submit" class="btn btn-primary mb-5" name="submit">Ubah</button>
				<a href="index.php"><button type="button" class="btn btn-outline-secondary ml-3 mb-5">Batal</button></a>
			</form>
		</div>

<?php
		if (isset($_POST['submit'])) {
			// menyimpan hasil input dari form
			$waktu = $_POST['waktu'];

			// mengubah data pada tabel jadwal berdasarkan id
			$sql = "UPDATE jadwal SET waktu='$waktu' WHERE id_jadwal='$id'";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				// menampilkan notifikasi apabila eksekusi berhasil
				header("Location: index.php?success=Data jadwal berhasil diubah");
			} else {
				// menampilkan notifikasi apabila eksekusi gagal
				header("Location: index.php?error=Gagal mengubah data jadwal");
			}
		}
	} else {
		header("Location: ../");
	}
} ?>