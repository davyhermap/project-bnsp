<?php
session_start();
if ($_SESSION['role'] == 'peserta') {
	include '../template/header/header-pendaftaran.php'; // menampilkan header

	if (isset($_POST['submit'])) {
		// mendeklarasikan variabel
		$id = $_POST['id'];
		$file_name = $_FILES['krs']['name']; // mengambil nama file
		$file_temp = $_FILES['krs']['tmp_name']; // mengambil file temp
		$krs = date("dmy") . "_" . $_SESSION['id'] . "_KRS.pdf"; // membuat nama unik baru untuk file upload
		$location = "../uploads/"; // tentukan lokasi file akan dipindahkan

		// mengubah data pada tabel pendaftaran berdasarkan id
		$sql = "UPDATE pendaftaran SET krs='$krs' WHERE id_daftar='$id'";
		$result = mysqli_query($conn, $sql);

		if ($result) {
			move_uploaded_file($file_temp, $location . $krs); // pindahkan file

			header("Location: index.php?success=Perubahan berhasil tersimpan"); // menampilkan notifikasi apabila eksekusi berhasil
		} else {
			header("Location: index.php?error=Gagal membuat perubahan"); // menampilkan notifikasi apabila eksekusi gagal
		}
	} else {
		header("Location: ../");
	}
}
