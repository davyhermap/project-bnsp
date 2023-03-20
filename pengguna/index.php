<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include '../template/header/header-pengguna.php'; // menampilkan header
	$no = 1; // mendeklarasikan variabel nomor
?>
	<!-- Tampilan role admin -->
	<div class="container">
		<!-- Form tambah data -->
		<form action="tambah.php" method="post" class="needs-validation" novalidate>
			<h2 class="pt-5 pb-4">Tambah Pengguna</h2>

			<?php if (isset($_GET['error'])) { ?>
				<!-- Notifikasi error -->
				<div class="alert alert-danger" role="alert">
					<?= $_GET['error'] ?>
				</div>
			<?php } elseif (isset($_GET['success'])) { ?>
				<!-- Notifikasi success -->
				<div class="alert alert-success" role="alert">
					<?= $_GET['success'] ?>
				</div>
			<?php } ?>

			<div class="form-group">
				<label for="nama">Nama</label>
				<input type="text" class="form-control" id="nama" placeholder="Masukkan nama" name="nama" maxlength="32" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="telp">Nomor Telepon</label>
				<input type="text" class="form-control" id="telp" placeholder="Masukkan nomor telepon" name="telp" maxlength="13" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="uname">Username</label>
				<input type="text" class="form-control" id="uname" placeholder="Masukkan username" name="username" maxlength="16" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="pwd">Password</label>
				<input type="password" class="form-control" id="pwd" placeholder="Masukkan password" name="password" maxlength="16" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="rpwd">Ulang Password</label>
				<input type="password" class="form-control" id="rpwd" placeholder="Masukkan password kembali" name="re_password" maxlength="16" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<button type="submit" class="btn btn-primary mb-5" name="tambah_pengguna">Tambah</button>
		</form>
		<hr>

		<!-- Tabel daftar pengguna -->
		<h2 class="text-center pt-5 pb-3">Daftar Pengguna</h2>
		<div class="table-responsive mb-5">
			<table class="table table-bordered">
				<thead class="thead-light text-center">
					<tr>
						<th>#</th>
						<th>Username</th>
						<th>Nama</th>
						<th>Nomor Telepon</th>
						<th colspan="2">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data user
					$sql = "SELECT * FROM user";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_user'];

						// menampilkan data pada baris tabel
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $row['username'] ?></td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['telepon'] ?></td>
							<td class="text-center"><a href="edit.php?id_user=<?= $id ?>">
									<button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i> Edit</button>
								</a></td>
							<td class="text-center">
								<button type="button" class="btn btn-outline-danger" onclick="myFunction('delete.php?id_user=', '<?= $id ?>')">
									<i class="fa-solid fa-trash-can"></i> Hapus
								</button>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php include '../template/footer.php'; // menampilkan footer
} else {
	header("Location: index.php"); // jika bukan admin maka membuka index.php
} ?>