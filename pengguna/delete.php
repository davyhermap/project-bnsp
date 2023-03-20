<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include "../db_conn.php"; // koneksi database

	if ($_GET['id_user']) {
		$id = $_GET['id_user']; // mengambil id yang dipilih

		$sql = "DELETE FROM user WHERE id_user='$id'"; // menghapus data berdasarkan id
		$result = mysqli_query($conn, $sql);

		if ($result) {
			// menampilkan notifikasi apabila eksekusi berhasil
			header("Location: index.php?success=Data pengguna berhasil dihapus");
		} else {
			// menampilkan notifikasi apabila eksekusi gagal
			header("Location: index.php?error=Gagal menghapus data pengguna");
		}
	} else {
		header("Location: ../");
	}
}
