<?php
session_start();
include "../db_conn.php"; // koneksi database

if (isset($_POST['tambah_kursus'])) {
	// menyimpan hasil input dari form
	$nama = $_POST['nama'];
	$ket = $_POST['ket'];
	$lama = $_POST['lama'];

	// menambah data pada tabel kursus
	$sql = "INSERT INTO kursus (nama, keterangan, lama)
			VALUES ('$nama', '$ket', '$lama')";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		// menampilkan notifikasi apabila eksekusi berhasil
		header("Location: index.php?success=Data kursus berhasil ditambah");
	} else {
		// menampilkan notifikasi apabila eksekusi gagal
		header("Location: index.php?error=Gagal menambahkan data kursus");
	}
} else {
	header("Location: ../");
}
