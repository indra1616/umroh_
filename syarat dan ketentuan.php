<div id="Syarat Dan Ketentuan" class="row">  
	<div class="col">
		<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body table-responsive">
				<?php if( $query_umroh->num_rows() == 0 ): ?>
					<p>Paket Haji sedang tidak tersedia</p>
				<?php else: ?>
				<table class="table">
					<tr>
						<th>No</th>
						<th><center>Tanggal Berangkat</center></th>
						<th>Paket</th>
						<th>Deskripsi</th>
						<th>Biaya</th>
						<th>Opsi</th>
					</tr>
				<?php $no=1; foreach( $query_umroh->result() as $row ): ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td align="center">
							<b class="h1 text-primary"><?php echo date('d', strtotime($row->periode_tanggal_berangkat)); ?></b><br>
							<small><?php echo date('M-Y', strtotime($row->periode_tanggal_berangkat)); ?></small>
						</td>
						<td><?php echo $row->paket_nama; ?></td>
						<td><?php echo $row->paket_deskripsi; ?></td>
						<td><?php echo number_format($row->periode_biaya,0,',','.'); ?></td>
						<td>
							<a href="<?php echo base_url(); ?>welcome/syarat_dan_ketentuan/<?php echo $row->periode_id; ?>" class="btn btn-outline-success btn-sm">DETAIL</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</div>