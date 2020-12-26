<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Data jamaah <span class="float-right badge badge-info"><?php echo $query_jamaah->num_rows(); ?></span></div>
			<div class="card-body table-responsive">
				<table class="table">
					<tr>
						<th>No</th>
						<th>ID</th>
						<th>Nama Jamaah</th>
						<th>Email</th>
						<th>HP</th>
						<th>Domisili</th>
						<th>Status</th>
					</tr>
					<?php $no = 1; foreach( $query_jamaah->result() as $row ): ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->jamaah_nik; ?></td>
							<td><?php echo $row->jamaah_nama; ?></td>
							<td><?php echo $row->jamaah_email; ?></td>
							<td><?php echo $row->jamaah_hp; ?></td>
							<td><?php echo $row->jamaah_alamat ; ?></td>
							<td>
								<?php if($row->jamaah_status == 'baru'): ?>
									<span class="badge badge-info">Baru</span>
								<?php elseif($row->jamaah_status == 'aktif'): ?>
									<span class="badge badge-success">Aktif</span>
								<?php elseif($row->jamaah_status == 'lengkap'): ?>
									<span class="badge badge-success">Aktif</span><span class="ml-2 badge badge-info">Lengkap</span>
								<?php else: ?>
									<span class="badge badge-danger">Banned</span>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>