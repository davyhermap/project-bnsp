<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include "../db_conn.php"; // koneksi database

	if ($_GET['npm']) {
		$id = $_GET['npm']; // mengambil id yang dipilih

		$sql = "DELETE FROM mahasiswa WHERE npm='$id'"; // menghapus data berdasarkan npm
		$result = mysqli_query($conn, $sql);

		if ($result) {
			// menampilkan notifikasi apabila eksekusi berhasil
			header("Location: index.php?success=Data mahasiswa berhasil dihapus");
		} else {
			// menampilkan notifikasi apabila eksekusi gagal
			header("Location: index.php?error=Gagal menghapus data mahasiswa");
		}
	} else {
		header("Location: ../");
	}
}
