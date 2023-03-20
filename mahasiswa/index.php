<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include '../template/header/header-mahasiswa.php'; // menampilkan header
	$no = 1; // mendeklarasikan variabel nomor
?>
	<!-- Tampilan role admin -->
	<div class="container">
		<!-- Form tambah data -->
		<form action="tambah.php" method="post" class="needs-validation" novalidate>
			<h2 class="pt-5 pb-4">Tambah Data Mahasiswa</h2>

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
				<label for="npm">NPM</label>
				<input type="text" class="form-control" id="npm" placeholder="Masukkan npm" name="npm" maxlength="8" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="kelas">Kelas</label>
				<input type="text" class="form-control" id="kelas" placeholder="Masukkan kelas" name="kelas" maxlength="5" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="nama">Nama</label>
				<input type="text" class="form-control" id="nama" placeholder="Masukkan nama" name="nama" maxlength="64" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<button type="submit" class="btn btn-primary mb-5" name="tambah_mahasiswa">Tambah</button>
		</form>
		<hr>

		<!-- Tabel daftar mahasiswa -->
		<h2 class="text-center pt-5 pb-3">Daftar Mahasiswa</h2>
		<div class="table-responsive mb-5">
			<table class="table table-bordered">
				<thead class="thead-light text-center">
					<tr>
						<th>#</th>
						<th>NPM</th>
						<th>Kelas</th>
						<th>Nama</th>
						<th colspan="2">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data mahasiswa
					$sql = "SELECT * FROM mahasiswa";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['npm'];

						// menampilkan data pada baris tabel
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $id ?></td>
							<td><?= $row['kelas'] ?></td>
							<td><?= $row['nama'] ?></td>
							<td class="text-center"><a href="edit.php?npm=<?= $id ?>">
									<button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i> Edit</button>
								</a></td>
							<td class="text-center">
								<button type="button" class="btn btn-outline-danger" onclick="myFunction('delete.php?npm=', '<?= $id ?>')">
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