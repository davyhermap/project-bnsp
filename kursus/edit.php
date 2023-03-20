<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include '../template/header/header-kursus.php'; // menampilkan header

	if ($_GET['id_kursus']) {
		$id = $_GET['id_kursus']; // mengambil id yang dipilih

		$sql = "SELECT * FROM kursus WHERE id_kursus='$id'"; // mengambil data berdasarkan id
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result); // menyimpan hasil eksekusi ke dalam array
?>

		<div class="container">
			<form action="" method="post" class="needs-validation" novalidate>
				<h2 class="py-5">Ubah Data Kursus</h2>
				<div class="form-group">
					<label for="name">Nama Kursus</label>
					<input type="text" class="form-control" id="name" value="<?= $row['nama'] ?>" name="nama" maxlength="64" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<div class="form-group">
					<label for="ket">Keterangan Kursus</label>
					<input type="text" class="form-control" id="ket" value="<?= $row['keterangan'] ?>" name="ket" maxlength="255" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<div class="form-group">
					<label for="lama">Lama Kursus</label>
					<input type="text" class="form-control" id="lama" value="<?= $row['lama'] ?>" name="lama" maxlength="32" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<button type="submit" class="btn btn-primary mb-5" name="submit">Ubah</button>
				<a href="index.php"><button type="button" class="btn btn-outline-secondary ml-3 mb-5">Batal</button></a>
			</form>
		</div>

<?php
		if (isset($_POST['submit'])) {
			// menyimpan hasil input dari form
			$nama = $_POST['nama'];
			$ket = $_POST['ket'];
			$lama = $_POST['lama'];

			// mengubah data pada tabel kursus berdasarkan id
			$sql = "UPDATE kursus SET nama='$nama', keterangan='$ket', lama='$lama'
				WHERE id_kursus='$id'";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				// menampilkan notifikasi apabila eksekusi berhasil
				header("Location: index.php?success=Data kursus berhasil diubah");
			} else {
				// menampilkan notifikasi apabila eksekusi gagal
				header("Location: index.php?error=Gagal mengubah data kursus");
			}
		}
	} else {
		header("Location: ../");
	}
} ?>