<!-- Konfirmasi logout -->
<div class="modal fade" id="modalLogout">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				Apakah Anda yakin ingin keluar?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
				<a href="../logout.php"><button type="button" class="btn btn-outline-danger">Keluar</button></a>
			</div>
		</div>
	</div>
</div>

<script>
	// Disable form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Get the forms we want to add validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();

	// konfirmasi aksi
	function myFunction(a, b) {
		txt = a + b;
		if (confirm("Yakin ingin melanjutkan?")) {
			location.href = txt;
		}
		document.getElementById("demo").innerHTML = txt;
	}

	// menampilkan nama file pada input file
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>

</body>

</html>