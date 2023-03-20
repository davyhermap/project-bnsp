<?php
session_start();
include "../db_conn.php"; // koneksi database

if (isset($_POST['login'])) {
	// menyimpan hasil input dari form
	$username = $_POST['username'];
	$password = $_POST['password'];

	// mengambil data user berdasarkan username
	$sql1 = "SELECT * FROM user WHERE username='$username'";
	$result1 = mysqli_query($conn, $sql1);

	// mengambil data mahasiswa berdasarkan npm
	$sql2 = "SELECT * FROM mahasiswa WHERE npm='$username'";
	$result2 = mysqli_query($conn, $sql2);

	if (mysqli_num_rows($result1) === 1) { // jika data user hanya 1 (unik)
		// menyimpan data user pada sesi
		$row = mysqli_fetch_assoc($result1);
		if ($row['password'] === $password) {
			$_SESSION['id'] = $row['id_user'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['name'] = $row['nama'];
			$_SESSION['role'] = "admin";

			header("Location: ../home.php");
		} else {
			// menampilkan notifikasi error
			header("Location: ../login.php?error=Username atau password salah");
		}
	} elseif (mysqli_num_rows($result2) === 1) { // jika data mahasiswa hanya 1 (unik)
		// menyimpan data mahasiswa pada sesi
		$row = mysqli_fetch_assoc($result2);
		if ($row['npm'] === $password) {
			$_SESSION['id'] = $row['npm'];
			$_SESSION['kelas'] = $row['kelas'];
			$_SESSION['name'] = $row['nama'];
			$_SESSION['role'] = "peserta";

			header("Location: ../home.php");
		} else {
			// menampilkan notifikasi error
			header("Location: ../login.php?error=Username atau password salah");
		}
	} else {
		// menampilkan notifikasi error
		header("Location: ../login.php?error=Username atau password salah");
	}
} else {
	header("Location: ../");
}
