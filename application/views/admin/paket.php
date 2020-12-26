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
						<th>Kode</th>
						<th>Nama Paket</th>
						<th>Deskripsi</th>
						<th>Kategori</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
					<?php $no = 1; foreach( $query_paket->result() as $row ): ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->paket_no; ?></td>
							<td><?php echo $row->paket_nama; ?></td>
							<td><?php echo $row->paket_deskripsi; ?></td>
							<td>
								<?php if($row->paket_kategori== 'umroh'): ?>
									<span class="badge badge-success">Umroh</span>
								<?php else: ?>
									<span class="badge badge-danger">Haji </span>
								<?php endif; ?>
							</td>
							<td>
								<?php if($row->paket_status == 'buka'): ?>
									<span class="badge badge-success">Berlaku</span>
									<span class="ml-2 badge badge-warning"><a href="<?php echo base_url(); ?>admin/ubah_status_paket?status=tutup&id=<?php echo $row->paket_id; ?>" >Tutup Sekarang</a> </span>
								<?php else: ?>
									<span class="badge badge-danger">Tidak Berlaku</span>
									<span class="ml-2 badge badge-warning"><a href="<?php echo base_url(); ?>admin/ubah_status_paket?status=buka&id=<?php echo $row->paket_id; ?>" >Buka Sekarang</a> </span>
								<?php endif; ?>
							</td>
							<td>
								<button data-id="<?php echo $row->paket_id; ?>" data-target="#edit" data-toggle="modal" class="btn-edit btn btn-outline-warning btn-sm"><i class="ti-pencil"></i></button>

								<?php if( $this->db->where('paket_id', $row->paket_id )->get('periode')->num_rows() == 0 ): ?>
									<a href="<?php echo base_url(); ?>admin/hapus_paket/<?php echo $row->paket_id; ?>" class="btn btn-outline-danger btn-sm"><i class="ti-trash"></i></a>
									
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
    <form action="<?php echo base_url(); ?>admin/tambah_paket" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label>Kode</label>
        	<input type="text" class="form-control" name="no">
        </div>
        <div class="form-group">
        	<label>Nama Paket</label>
        	<input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group">
        	<label>Deskripsi Paket</label>
        	<textarea class="form-control" name="deskripsi"></textarea>
        </div>
        <div class="form-group">
        	<label>Kategori Paket</label>
        	<select class="form-control" name="kategori">
				<option value="umroh">Umroh</option>
				<option value="haji">Haji</option>
			</select>
        </div>
        <div class="form-group">
        	<label>Status Paket</label>
        	<select class="form-control" name="status">
				<option value="buka">Berlaku</option>
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

			$.get('<?php echo base_url() ?>admin/ajax_edit_paket/'+id+'', function(e){

				$('.edit-container').html(e);

				// console.log(e)

			})
		})
	})
</script>