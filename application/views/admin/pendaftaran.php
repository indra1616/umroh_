<div class="row">
	<div class="col-md-12">
		<form class="form-inline" method="get">
			<label>Filter : </label>
			<select class="form-control ml-3" name="filter_by_kategori">
				<option <?php echo ( $kategori == 'umroh' )? 'selected' : ''; ?> value="umroh">Umroh</option>
				<option <?php echo ( $kategori == 'haji' )? 'selected' : ''; ?> value="haji">Haji</option>
			</select>
			<select class="form-control ml-3" name="filter_by_status">
				<option <?php echo ( $status == 'menunggu' )? 'selected' : ''; ?> value="menunggu">Menunggu</option>
				<option <?php echo ( $status == 'selesai' )? 'selected' : ''; ?> value="selesai">Selesai</option>
				<option <?php echo ( $status == 'batal' )? 'selected' : ''; ?> value="batal">Batal</option>
			</select>
			<button type="submit" class="btn btn-primary ml-2">Filter</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Data Pendaftaran <span class="float-right badge badge-info"><?php echo $query_pendaftaran->num_rows(); ?></span></div>
			<div class="card-body table-responsive">
				<table class="table">
					<tr>
						<th>No</th>
						<th>No Identitas</th>
						<th>Nama</th>
						<th>Paket</th>
						<th>Kategori</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
					<?php $no = 1; foreach( $query_pendaftaran->result() as $row ): ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->jamaah_nik; ?></td>
							<td><?php echo $row->jamaah_nama; ?></td>
							<td><?php echo $row->paket_nama; ?></td>
							<td>
								<?php if($row->paket_kategori== 'umroh'): ?>
									<span class="badge badge-success">Umroh</span>
								<?php else: ?>
									<span class="badge badge-danger">Haji </span>
								<?php endif; ?>
							</td>
							<td>
								<?php if($row->pendaftaran_status == 'menunggu'): ?>
									<span class="badge badge-info">Menunggu Pelunasan</span>
								<?php elseif($row->pendaftaran_status == 'selesai'): ?>
									<span class="badge badge-success">Selesai/span>
								<?php else: ?>
									<span class="badge badge-danger">Batal</span>
								<?php endif; ?>
							</td>
							<td>
								<a href="<?php echo base_url(); ?>admin/detail_pendaftaran/<?php echo $row->pendaftaran_id; ?>" class="btn btn-outline-primary btn-sm"><i class="ti-eye"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>
