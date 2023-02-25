<br><br><br>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="mt-4">
				<h2>Informasi Akun</h2>
			</div>
			<hr>
			<form>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="email" value=": <?= $_SESSION['email']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="no_hp" class="col-sm-2 col-form-label">No.HP</label>
					<div class="col-sm-10">
						<input type="tel" readonly class="form-control-plaintext" id="no_hp" value=": <?= $_SESSION['no_hp']; ?>">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>