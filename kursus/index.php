<?php
session_start();
include '../template/header/header-kursus.php'; // menampilkan header

$no = 1; // mendeklarasikan variabel nomor
if ($_SESSION['role'] == 'admin') {
?>

	<!-- Tampilan kursus admin -->
	<div class="container">
		<!-- Form tambah data -->
		<form action="tambah.php" method="post" class="needs-validation" novalidate>
			<h2 class="pt-5 pb-4">Tambah Materi Kursus</h2>

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
				<label for="name">Nama Kursus</label>
				<input type="text" class="form-control" id="name" placeholder="Masukkan nama kursus" name="nama" maxlength="64" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="ket">Keterangan Kursus</label>
				<input type="text" class="form-control" id="ket" placeholder="Masukkan keterangan kursus" name="ket" maxlength="255" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="lama">Lama Kursus</label>
				<input type="text" class="form-control" id="lama" placeholder="Masukkan lama kursus" name="lama" maxlength="32" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<button type="submit" class="btn btn-primary mb-5" name="tambah_kursus">Tambah</button>
		</form>
		<hr>

		<!-- Tabel daftar kursus -->
		<h2 class="text-center pt-5 pb-3">Daftar Kursus</h2>
		<div class="table-responsive mb-5">
			<table class="table table-bordered">
				<thead class="thead-light text-center">
					<tr>
						<th>#</th>
						<th>Nama Kursus</th>
						<th>Keterangan</th>
						<th>Lama Kursus</th>
						<th colspan="2">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data kursus
					$sql = "SELECT * FROM kursus";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_kursus'];

						// menampilkan data pada baris tabel
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['keterangan'] ?></td>
							<td><?= $row['lama'] ?></td>
							<td class="text-center"><a href="edit.php?id_kursus=<?= $id ?>">
									<button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i> Edit</button>
								</a></td>
							<td class="text-center">
								<button type="button" class="btn btn-outline-danger" onclick="myFunction('delete.php?id_kursus=', '<?= $id ?>')">
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

<?php } else { ?>

	<!-- Tampilan materi kursus -->
	<div class="container">
		<h2 class="text-center pt-5 pb-3">Materi Kursus</h2>

		<div class="table-responsive mb-5">
			<table class="table table-bordered">
				<thead class="thead-light text-center">
					<tr>
						<th>#</th>
						<th>Nama Kursus</th>
						<th>Keterangan</th>
						<th>Lama Kursus</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data kursus
					$sql = "SELECT * FROM kursus";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_kursus'];

						// menampilkan data pada baris tabel
						echo '<tr>
								<td>' . $no++ . '</td>
								<td>' . $row['nama'] . '</td>
								<td>' . $row['keterangan'] . '</td>
								<td>' . $row['lama'] . '</td>
							</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php }
include '../template/footer.php'; // menampilkan footer 
?>