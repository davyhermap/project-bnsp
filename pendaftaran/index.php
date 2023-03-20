<?php
session_start();
include '../template/header/header-pendaftaran.php'; // menampilkan header

$no = 1; // mendeklarasikan variabel nomor
if ($_SESSION['role'] == 'admin') {
	$sql = "SELECT * FROM kursus"; // mengambil data kursus
	$result = mysqli_query($conn, $sql);
?>

	<!-- Tampilan pendaftaran admin -->
	<div class="container">
		<!-- Tabel pendaftaran -->
		<h2 class="text-center pt-5 pb-3">Pendaftaran Mahasiswa</h2>
		<form class="form-inline" action="" method="post">
			<label for="ktg" class="mb-4 mr-sm-2">Kategori:</label>
			<select name="status" class="custom-select mb-4 mr-sm-2" id="ktg">
				<option value="1" <?php if ($_POST['status'] == "1") {
										echo "selected";
									} ?>>Menunggu Persetujuan</option>
				<option value="2" <?php if ($_POST['status'] == "2") {
										echo "selected";
									} ?>>Pendaftaran Diterima</option>
				<option value="3" <?php if ($_POST['status'] == "3") {
										echo "selected";
									} ?>>Pendaftaran Ditolak</option>
			</select>
			<button type="submit" class="btn btn-primary mb-4">Submit</button>
		</form>
		<div class="table-responsive mb-5">
			<table class="table table-bordered">
				<thead class="thead-light text-center">
					<tr>
						<th>#</th>
						<th>NPM</th>
						<th>Kelas</th>
						<th>Nama Mahasiswa</th>
						<th>Nama Kursus</th>
						<th>Waktu Kursus</th>
						<th>KRS</th>
						<?php if ($_POST['status'] == "2" || $_POST['status'] == "3") { ?>
							<th>Status</th>
						<?php } else { ?>
							<th colspan="2">Aksi</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php
					// mendeskripsikan status
					switch ($_POST['status']) {
						case "1":
							$status = "Menunggu Persetujuan";
							break;
						case "2":
							$status = "Pendaftaran Diterima";
							break;
						case "3":
							$status = "Pendaftaran Ditolak";
							break;
						default:
							$status = "Menunggu Persetujuan";
					}

					// mengambil data pendaftaran berdasarkan status
					$sql = "SELECT * FROM pendaftaran WHERE status='" . $status . "'";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_daftar'];

						// mengambil data mahasiswa dari tabel mahasiswa berdasarkan npm
						$sql2 = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm='" . $row['npm'] . "'");
						$row2 = mysqli_fetch_array($sql2);

						// mengambil jadwal kursus dari tabel jadwal berdasarkan id_jadwal
						$sql3 = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal='" . $row['id_jadwal'] . "'");
						$row3 = mysqli_fetch_array($sql3);

						// mengambil nama kursus dari tabel kursus berdasarkan id_kursus dari tabel jadwal
						$sql4 = mysqli_query($conn, "SELECT nama FROM kursus WHERE id_kursus='" . $row3['id_kursus'] . "'");
						$row4 = mysqli_fetch_array($sql4);

						// menampilkan data pada baris tabel
						echo '<tr>
								<td>' . $no++ . '</td>
								<td>' . $row['npm'] . '</td>
								<td>' . $row2['kelas'] . '</td>
								<td>' . $row2['nama'] . '</td>
								<td>' . $row4['nama'] . '</td>
								<td>' . date_format(date_create($row3['waktu']), "j F Y") . '</td>
								<td><a target="_blank" href="../uploads/' . $row['krs'] . '">' . $row['krs'] . '</a></td>';
						if ($status == "Menunggu Persetujuan") {
					?>
							<td class="text-center">
								<button type="button" class="btn btn-outline-success" onclick="myFunction('terima.php?id_daftar=', '<?= $id ?>')">
									<i class="fa-solid fa-check"></i> Terima
								</button>
							</td>
							<td class="text-center">
								<button type="button" class="btn btn-outline-danger" onclick="myFunction('tolak.php?id_daftar=', '<?= $id ?>')">
									<i class="fa-solid fa-xmark"></i> Tolak
								</button>
							</td>
					<?php
						} else {
							echo '<td>' . $row['status'] . '</td>';
						}
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php } elseif ($_SESSION['role'] == 'peserta') 
{ 
	$uid = $_SESSION['id'];
	?>


	<!-- Tampilan pendaftaran peserta -->
	<div class="container">
		<h2 class="text-center pt-5 pb-3">Informasi Pendaftaran</h2>

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

		<div class="table-responsive mb-5">
			<table class="table table-bordered">
				<thead class="thead-light text-center">
					<tr>
						<th>#</th>
						<th>Nama Kursus</th>
						<th>Waktu Kursus</th>
						<th>KRS</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1; // mendeklarasikan variabel nomor

					// mengambil data pendaftaran
					$sql = "SELECT * FROM pendaftaran where npm = '$uid'";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_daftar'];

						// mengambil jadwal kursus dari tabel jadwal berdasarkan id_jadwal
						$sql2 = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal='" . $row['id_jadwal'] . "'");
						$row2 = mysqli_fetch_array($sql2);

						// mengambil nama kursus dari tabel kursus berdasarkan id_kursus dari tabel jadwal
						$sql3 = mysqli_query($conn, "SELECT nama FROM kursus WHERE id_kursus='" . $row2['id_kursus'] . "'");
						$row3 = mysqli_fetch_array($sql3);

						// menampilkan data pada baris tabel
						echo '<tr>
								<td>' . $no++ . '</td>
								<td>' . $row3['nama'] . '</td>
								<td>' . date_format(date_create($row2['waktu']), "j F Y") . '</td>
								<td><a target="_blank" href="../uploads/' . $row['krs'] . '">' . $row['krs'] . '</a></td>
								<td>' . $row['status'] . '</td>';
						if ($row['status'] == "Menunggu Persetujuan") {
							echo '<td class="text-center">
									<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
										<i class="fa-solid fa-pen"></i> Edit
									</button>
								</td>';
						} else {
							echo '<td class="text-center"><a href="detail.php?id_daftar=' . $id . '">
									<button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-circle-info"></i> Detail</button>
								</a></td>';
						}
						echo '</tr>';
					?>
						<!-- The Modal -->
						<div class="modal fade" id="myModal">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Ubah Data Pendaftaran</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<form action="edit.php" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
											<input type="hidden" name="id" value="<?= $id ?>">
											<div class="form-group">
												<label for="krs">File KRS</label>
												<div class="custom-file mb-3" id="krs">
													<input type="file" class="custom-file-input" id="customFile" name="krs" accept=".pdf" required>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<button type="submit" class="btn btn-primary mb-3" name="submit">Submit</button>
											<button type="button" class="btn btn-outline-secondary mb-3" data-dismiss="modal">Batal</button>
										</form>
									</div>

								</div>
							</div>
						</div>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php }
include '../template/footer.php'; // menampilkan footer
?>