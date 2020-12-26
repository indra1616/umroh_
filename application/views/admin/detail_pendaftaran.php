<?php $row = $query_pendaftaran->row(); ?>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Formulir Pendaftaran</div>
			<div class="card-body table-responsive">
				<h3>A. Identitas Pendaftar #<?php echo $row->pendaftaran_no; ?></h3>
				<table class="table table-bordered">
					<tr>
						<td width="20%">Nama Lengkap</td>
						<td><?php echo $row->jamaah_nama; ?></td>
					</tr>
					<tr>
						<td>No KTP</td>
						<td><?php echo $row->jamaah_nik; ?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td><?php echo $row->jamaah_jk; ?></td>
					</tr>
					<tr>
						<td>Tempat Lahir</td>
						<td></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><?php echo $row->jamaah_alamat; ?></td>
					</tr>
				</table>
				<h3>B. Program Umrah / Haji</h3>
				<table class="table table-bordered">
					<tr>
						<td width="20%">Nama Program</td>
						<td><?php echo $row->paket_nama; ?></td>
					</tr>
					<tr>
						<td>Bulan Berangkat</td>
						<td><?php echo $row->periode_bulan; ?></td>
					</tr>
					<tr>
						<td>Biaya Program</td>
						<td><?php echo number_format($row->periode_biaya,0,',','.'); ?></td>
					</tr>
					<tr>
						<td>Status Pelunasan</td>
						<td>
							<?php if($row->pendaftaran_status == 'menunggu'): ?>
								<span class="badge badge-info">Menunggu Pelunasan</span>
							<?php elseif($row->pendaftaran_status == 'selesai'): ?>
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
</div>
<div class="row">
	<div class="col">
		<p>Ubah Status Menjadi
			<a href="<?php echo base_url(); ?>admin/update_status_pendaftaran/<?php echo $row->pendaftaran_id; ?>?status=selesai" class="btn btn-outline-success">Selesai</a>
			<a href="<?php echo base_url(); ?>admin/update_status_pendaftaran/<?php echo $row->pendaftaran_id; ?>?status=batal" class="btn btn-outline-danger">Batal</a>
		</p>
	</div>
</div>