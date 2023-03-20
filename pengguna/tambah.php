<?php
session_start();
include "../db_conn.php"; // koneksi database

if (isset($_POST['tambah_pengguna'])) {
	// menyimpan hasil input dari form
	$nama = $_POST['nama'];
	$telp = $_POST['telp'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$re_password = $_POST['re_password'];

	// mengambil data user berdasarkan username
	$sql = "SELECT * FROM user WHERE username='$username'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) === 1) { // jika terdapat username yang sama
		// menampilkan notifikasi error
		header("Location: index.php?error=Username sudah ada");
	} else {
		if ($password === $re_password) { // jika password sesuai
			// menambah data pada tabel user
			$sql = "INSERT INTO user (username, password, nama, telepon)
					VALUES ('$username', '$password', '$nama', '$telp')";
			$result = mysqli_query($conn, $sql);

			// menampilkan notifikasi berhasil
			header("Location: index.php?success=Berhasil menambahkan pengguna");
		} else { // jika password tidak sesuai
			// menampilkan notifikasi error
			header("Location: index.php?error=Password tidak sesuai");
		}
	}
} else {
	header("Location: ../");
}
