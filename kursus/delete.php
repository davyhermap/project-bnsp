<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include "../db_conn.php"; // koneksi database

	if ($_GET['id_kursus']) {
		$id = $_GET['id_kursus']; // mengambil id yang dipilih

		$sql = "DELETE FROM kursus WHERE id_kursus='$id'"; // menghapus data berdasarkan id
		$result = mysqli_query($conn, $sql);

		if ($result) {
			// menampilkan notifikasi apabila eksekusi berhasil
			header("Location: index.php?success=Data kursus berhasil dihapus");
		} else {
			// menampilkan notifikasi apabila eksekusi gagal
			header("Location: index.php?error=Gagal menghapus data kursus");
		}
	} else {
		header("Location: ../");
	}
}
