<div class="row">
	<div class="col">
		<button data-target="#tambah" data-toggle="modal" class="btn btn-success"><i class="ti-plus"></i> Tambah Data</button>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-inline" method="get">
			<label>Filter : </label>
			<select class="form-control ml-3" name="filter_by_kategori">
				<option <?php echo ( $kategori == 'umroh' )? 'selected' : ''; ?> value="umroh">Umroh</option>
				<option <?php echo ( $kategori == 'haji' )? 'selected' : ''; ?> value="haji">Haji</option>
			</select>
			<button type="submit" class="btn btn-primary ml-2">Filter</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Data paket <span class="float-right badge badge-info"><?php echo $query_paket->num_rows(); ?></span></div>
			<div class="card-body table-responsive">
				<table class="table">
					<tr>
						<th>No</th>
						<th>Bulan</th>
						<th>Tahun</th>
						<th>Biaya</th>
						<th>Tanggal Berangkat</th>
						<th>Paket</th>
						<th>Kategori</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
					<?php $no = 1; foreach( $query_periode->result() as $row ): ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->periode_bulan; ?></td>
							<td><?php echo $row->periode_tahun; ?></td>
							<td align="right"><?php echo number_format($row->periode_biaya,0,',','.'); ?></td>
							<td><?php echo date('d-m-Y', strtotime($row->periode_tanggal_berangkat)); ?></td>
							<td><?php echo $row->paket_nama; ?></td>
							<td>
								<?php if($row->paket_kategori== 'umroh'): ?>
									<span class="badge badge-success">Umroh</span>
								<?php else: ?>
									<span class="badge badge-danger">Haji </span>
								<?php endif; ?>
							</td>
							<td>
								<?php if($row->periode_status == 'buka'): ?>
									<span class="badge badge-success">Berlaku</span>
									<span class="ml-2 badge badge-warning"><a href="<?php echo base_url(); ?>admin/ubah_status_periode?status=tutup&id=<?php echo $row->periode_id; ?>" >Tutup Sekarang</a> </span>
								<?php else: ?>
									<span class="badge badge-danger">Tidak Berlaku</span>
									<span class="ml-2 badge badge-warning"><a href="<?php echo base_url(); ?>admin/ubah_status_periode?status=buka&id=<?php echo $row->periode_id; ?>" >Buka Sekarang</a> </span>
								<?php endif; ?>
							</td>
							<td>
								<button data-id="<?php echo $row->periode_id; ?>" data-target="#edit" data-toggle="modal" class="btn-edit btn btn-outline-warning btn-sm"><i class="ti-pencil"></i></button>

								<?php if( $this->db->where('periode_id', $row->periode_id )->get('pendaftaran')->num_rows() == 0 ): ?>
									<a href="<?php echo base_url(); ?>admin/hapus_periode/<?php echo $row->periode_id; ?>" class="btn btn-outline-danger btn-sm"><i class="ti-trash"></i></a>
									
								<?php else: ?>
									<a href="#" class="btn btn-outline-danger btn-sm disabled"><i class="ti-trash"></i></a>

								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal tambah data -->
<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
    <form action="<?php echo base_url(); ?>admin/tambah_periode" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label>Bulan</label>
        	<input type="text" class="form-control" name="bulan">
        </div>
        <div class="form-group">
        	<label>Tahun</label>
        	<input type="text" class="form-control" name="tahun">
        </div>
        <div class="form-group">
        	<label>Tanggal Berangkat</label>
        	<input type="date" class="form-control" name="berangkat">
        </div>
        <div class="form-group">
        	<label>Biaya</label>
        	<input type="text" class="form-control" name="biaya">
        </div>
        <div class="form-group">
        	<label>Paket</label>
        	<select class="form-control" name="paket">
				<option value="">--Pilih--</option>
				<?php foreach( $query_paket->result() as $pk ): ?>
					<option value="<?php echo $pk->paket_id; ?>"><?php echo strtoupper($pk->paket_kategori) .' | '. $pk->paket_nama; ?></option>
				<?php endforeach; ?>
			</select>
        </div>
        <div class="form-group">
        	<label>Status Periode</label>
        	<select class="form-control" name="status">
				<option value="buka">Berkalu</option>
				<option value="tutup">Tidak Berlaku</option>
			</select>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
  	</form>

    </div>
  </div>
</div>

<!-- Modal tambah data -->
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="edit-container"></div>

    </div>
  </div>
</div>

<script>
	$(function(){
		$('.btn-edit').on('click', function(){

			var id = $(this).data('id');

			$.get('<?php echo base_url() ?>admin/ajax_edit_periode/'+id+'', function(e){

				$('.edit-container').html(e);

				// console.log(e)

			})
		})
	})
</script>