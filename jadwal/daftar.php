<?php
session_start();
if ($_SESSION['role'] == 'peserta') {
	include '../template/header/header-jadwal.php'; // menampilkan header

	if ($_GET['id_jadwal'] && $_GET['npm']) {
		$id = $_GET['id_jadwal']; // mengambil id yang dipilih
		$npm = $_GET['npm']; // mengambil npm peserta

		// mengambil data jadwal berdasarkan id
		$sql = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal='" . $id . "'");
		$row = mysqli_fetch_array($sql);

		// mengambil data kursus berdasarkan id
		$sql2 = mysqli_query($conn, "SELECT * FROM kursus WHERE id_kursus='" . $row['id_kursus'] . "'");
		$row2 = mysqli_fetch_array($sql2);

		// mengambil data mahasiswa berdasarkan npm
		$sql3 = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm='" . $npm . "'");
		$row3 = mysqli_fetch_array($sql3);
?>

		<div class="container">
			<form action="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
				<h2 class="py-5">Formulir Pendaftaran Kursus</h2>
				<div class="form-group">
					<label for="kursus">Nama Kursus</label>
					<input type="text" class="form-control" id="kursus" value="<?= $row2['nama'] ?>" readonly>
				</div>
				<div class="form-group">
					<label for="waktu">Waktu Kursus</label>
					<input type="date" class="form-control" id="waktu" value="<?= $row['waktu'] ?>" name="waktu" readonly>
				</div>
				<div class="form-group">
					<label for="mhs">Nama Mahasiswa</label>
					<input type="text" class="form-control" id="mhs" value="<?= $row3['nama'] ?>" readonly>
				</div>
				<div class="form-group">
					<label for="npm">NPM</label>
					<input type="text" class="form-control" id="npm" value="<?= $npm ?>" readonly>
				</div>
				<div class="form-group">
					<label for="kelas">Kelas</label>
					<input type="text" class="form-control" id="kelas" value="<?= $row3['kelas'] ?>" readonly>
				</div>
				<div class="form-group">
					<label for="krs">File KRS</label>
					<div class="custom-file mb-3" id="krs">
						<input type="file" class="custom-file-input" id="customFile" name="krs" accept=".pdf" required>
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<button type="submit" class="btn btn-primary mb-5" name="submit">Submit</button>
				<a href="index.php"><button type="button" class="btn btn-outline-secondary ml-3 mb-5">Batal</button></a>
			</form>
		</div>

<?php
		if (isset($_POST['submit'])) {
			// mendeklarasikan variabel
			$file_name = $_FILES['krs']['name']; // mengambil nama file
			$file_temp = $_FILES['krs']['tmp_name']; // mengambil file temp
			$krs = date("dmy") . "_" . $npm . "_KRS.pdf"; // membuat nama unik baru untuk file upload
			$location = "../uploads/"; // tentukan lokasi file akan dipindahkan

			// menambah data pada tabel pendaftaran
			$sql = "INSERT INTO pendaftaran (id_jadwal, npm, krs, status)
			VALUES ('$id', '$npm', '$krs', 'Menunggu Persetujuan')";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				move_uploaded_file($file_temp, $location . $krs); // pindahkan file

				header("Location: index.php?success=Pendaftaran berhasil terkirim"); // menampilkan notifikasi apabila eksekusi berhasil
			} else {
				header("Location: index.php?error=Gagal mendaftar"); // menampilkan notifikasi apabila eksekusi gagal
			}
		}
	} else {
		header("Location: ../");
	}
	include '../template/footer.php'; // menampilkan footer
} ?>