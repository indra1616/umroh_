<?php $row = $query_jamaah ?>
<?php $disabled = ($row->jamaah_nik == null )? 'disabled' : ''; ?>

<div class="row">
	<div class="col-md-12">
		<h3>Profil</h3>
	</div>
	<div class="col-md-6">
		<form action="<?php echo base_url(); ?>welcome/update_profil_jamaah" method="post">
			<div class="card">
				<div class="card-header">
					Identitas Diri
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $row->jamaah_email; ?>" required="" readonly="">
					</div>
					<div class="form-group">
						<label>No Penduduk</label>
						<input type="text" class="form-control" minlength="16" maxlength="16" name="nik" value="<?php echo $row->jamaah_nik; ?>" required="">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $row->jamaah_nama; ?>" required="">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select class="form-control" name="jk">
							<option value="Laki-Laki" <?php echo ( $row->jamaah_jk == 'Laki-Laki' )? 'selected' : ''; ?>>Laki-Laki</option>
							<option value="Perempuan" <?php echo ( $row->jamaah_jk == 'Perempuan' )? 'selected' : ''; ?>>Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tempat Lahir</label>
						<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $row->jamaah_tempat_lahir; ?>" required="">
					</div>
					<div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $row->jamaah_tanggal_lahir; ?>" required="">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat"><?php echo $row->jamaah_alamat; ?></textarea>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Perbarui</button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-6">
		<form action="<?php echo base_url(); ?>welcome/generateOTP" method="post">
			<div class="card">
				<div class="card-header">
					Kontak
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>No telp</label>
						
						<input type="text" class="form-control" name="phone" value="<?php echo $row->jamaah_hp; ?>" <?php echo $disabled; ?> required="">
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Dapatkan Kode OTP</button>
				</div>
			</div>
		</form>
	</div>
</div>