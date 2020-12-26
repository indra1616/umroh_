<?php $row = $query_pendaftaran->row(); ?>
<div class="row">
	<div class="col-md-4">
		<form class="form-inline" method="get">
			<input type="text" class="form-control" name="no" placeholder="Nomor Pendaftaran" required="" value="<?php echo $this->input->get('no'); ?>">
			<button class="btn btn-primary ml-2">Periksa</button>
		</form>
	</div>
	<?php if( $this->input->get('no') ): ?>
	<?php if( $query_pendaftaran->num_rows() == 0 ): ?>
	<div class="col-md-12">
		<div class="alert alert-warning">
		  <strong>Maaf!</strong> Nomor pendaftaran yang anda masukan salah.
		</div>
	</div>
	<?php else: ?>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Status Pendaftaran <button onclick="window.print()" class="btn btn-outline-primary btn-sm float-right"><i class="ti-printer"></i></button></div>
			<div class="card-body">
				<p>Salam Ibadah, <?php echo $row->jamaah_nama; ?></p>
				<p>Berikut rincian pendaftaran anda:</p>
				<table class="table table-bordered">
					<tr>
						<td>No Pendafataran</td>
						<td><?php echo $row->pendaftaran_no; ?></td>
					</tr>
					<tr>
						<td>Tanggal Berangkat</td>
						<td><?php echo date('d-m-Y', strtotime($row->periode_tanggal_berangkat)); ?></td>
					</tr>
					<tr>
						<td>Kategori | Paket </td>
						<td><?php echo strtoupper($row->paket_kategori) .' | '.$row->paket_nama; ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							<?php if( $row->pendaftaran_status == 'menunggu' ): ?>
								<span class="badge badge-info">Menuggu Konfirmasi Pendaftaran</span>
							<?php elseif( $row->pendaftaran_status == 'selesai' ): ?>
								<span class="badge badge-success">Selesai</span>
							<?php else: ?>
								<span class="badge badge-danger">Batal</span>
							<?php endif; ?>

						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php else: ?>
		<div class="col-md-12">
		<div class="alert alert-info">
		  <strong>Perhatian !</strong> Silahkan masukkan Nomor Pendaftaran Anda.
		</div>
	</div>
	<?php endif; ?>
</div>