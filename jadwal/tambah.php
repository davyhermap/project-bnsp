<?php
session_start();
include "../db_conn.php"; // koneksi database

if (isset($_POST['tambah_jadwal'])) {
	// menyimpan hasil input dari form
	$kursus = $_POST['kursus'];
	$waktu = $_POST['waktu'];

	// menambah data pada tabel jadwal
	$sql = "INSERT INTO jadwal (id_kursus, waktu)
			VALUES ('$kursus', '$waktu')";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		// menampilkan notifikasi apabila eksekusi berhasil
		header("Location: index.php?success=Data jadwal berhasil ditambah");
	} else {
		// menampilkan notifikasi apabila eksekusi gagal
		header("Location: index.php?error=Gagal menambahkan data jadwal");
	}
} else {
	header("Location: ../");
}
