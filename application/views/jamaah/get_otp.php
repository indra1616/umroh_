<div class="row mt-5 mb-5">
	<div class="col-md-4 offset-md-4">
		<div class="alert alert-info"><b>Perharian : </b> Kode OTP anda adalah : <?php echo $this->input->get('otp'); ?></div>
		<form action="<?php echo base_url(); ?>welcome/updateKontak" method="post">
			<div class="card">
				<div class="card-header">
					Kode OTP
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>OTP</label>
						<input type="text" class="form-control" minlength="4" maxlength="4" name="otp" required="" placeholder="4 digit">
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary float-right">Periksa</button>
					<p>Belum dapat kode <a href="<?php echo base_url(); ?>welcome/generateOTP_again">Kirim Ulang</a></p>
				</div>
			</div>
		</form>
	</div>
</div>