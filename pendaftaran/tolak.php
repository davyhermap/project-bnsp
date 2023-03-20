<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include '../template/header/header-pendaftaran.php'; // menampilkan header

	if ($_GET['id_daftar']) {
		$id = $_GET['id_daftar']; // mengambil id yang dipilih

		// mengubah data pada tabel pendaftaran berdasarkan id
		$sql = "UPDATE pendaftaran SET status='Pendaftaran Ditolak' WHERE id_daftar='$id'";
		$result = mysqli_query($conn, $sql);

		if ($result) {
			// menampilkan notifikasi apabila eksekusi berhasil
			header("Location: index.php?success=Pendaftaran berhasil diverifikasi");
		} else {
			// menampilkan notifikasi apabila eksekusi gagal
			header("Location: index.php?error=Gagal memverifikasi pendaftaran");
		}
	} else {
		header("Location: ../");
	}
}
