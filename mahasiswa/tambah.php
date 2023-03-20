<?php
session_start();
include "../db_conn.php"; // koneksi database

if (isset($_POST['tambah_mahasiswa'])) {
	// menyimpan hasil input dari form
	$npm = $_POST['npm'];
	$kelas = $_POST['kelas'];
	$nama = $_POST['nama'];

	// mengambil data mahasiswa berdasarkan npm
	$sql = "SELECT * FROM mahasiswa WHERE npm='$npm'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) === 1) { // jika terdapat npm yang sama
		// menampilkan notifikasi error
		header("Location: index.php?error=Data mahasiswa sudah ada");
	} else {
		// menambah data pada tabel mahasiswa
		$sql = "INSERT INTO mahasiswa (npm, kelas, nama)
				VALUES ('$npm', '$kelas', '$nama')";
		$result = mysqli_query($conn, $sql);

		// menampilkan notifikasi berhasil
		header("Location: index.php?success=Berhasil menambahkan data mahasiswa");
	}
} else {
	header("Location: ../");
}
