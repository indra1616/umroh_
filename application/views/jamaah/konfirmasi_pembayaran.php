<?php $row = $query_pendaftaran->row(); ?>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Konfirmasi Pembayaran <button onclick="window.print()" class="btn btn-outline-primary btn-sm float-right"><i class="ti-printer"></i></button></div>
			<div class="card-body">
				<p>Salam Ibadah, <?php echo $this->session->userdata('ci_username'); ?></p>
				<p>Selamat pendaftaran anda berhasil dan sedang kami proses untuk memastikan anda memesan paket ini kami memerlukan konfirmasi pembayaran anda dengan membayar sejumlah <b>Rp.<?php echo number_format( $row->periode_biaya ,0,',','.') ?></b> yang tertera dibawah sebelum <b><?php echo date('d-m-Y H:i:s', strtotime( $row->pendaftaran_tanggal_kadaluarsa )); ?></b> jika tidak maka pendafataran anda akan dibatalkan</p>
				<p>Berikut rincian pendaftaran anda:</p>
				<table class="table table-bordered">
					<tr>
						<td>No Pendafataran</td>
						<td><?php echo $row->pendaftaran_no; ?></td>
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
				<br>
				<p>Saya sudah melakukan pendaftaran. <a href="<?php echo base_url(); ?>welcome/kebijakan#konfirmasi-pembayaran">Baca panduan konfirmasi</a></p>
				<a href="" class="btn btn-outline-primary">Konfirmasi Sekarang</a>
				<a href="<?php echo base_url(); ?>welcome" class="btn btn-danger">Konfirmasi Nanti Saja</a>
			</div>
		</div>
	</div>
</div>