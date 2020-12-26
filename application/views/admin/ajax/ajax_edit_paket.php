<?php $row = $query_paket->row(); ?>

<form action="<?php echo base_url(); ?>admin/update_paket/<?php echo $row->paket_id; ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label>Kode</label>
        	<input type="text" class="form-control" name="no" value="<?php echo $row->paket_no; ?>" readonly="">
        </div>
        <div class="form-group">
        	<label>Nama Paket</label>
        	<input type="text" class="form-control" name="nama" value="<?php echo $row->paket_nama; ?>">
        </div>
        <div class="form-group">
        	<label>Deskripsi Paket</label>
        	<textarea class="form-control" name="deskripsi" ><?php echo $row->paket_deskripsi; ?></textarea>
        </div>
        <div class="form-group">
        	<label>Kategori Paket</label>
        	<select class="form-control" name="kategori">
				<option value="umroh" <?php echo ( $row->paket_kategori == 'umroh' )? 'selected' : ''; ?>>Umroh</option>
				<option value="haji" <?php echo ( $row->paket_kategori == 'haji' )? 'selected' : ''; ?>>Haji</option>
			</select>
        </div>
        <div class="form-group">
        	<label>Status Paket</label>
        	<select class="form-control" name="status">
				<option value="buka" <?php echo ( $row->paket_status == 'buka' )? 'selected' : ''; ?>>Berkalu</option>
				<option value="tutup" <?php echo ( $row->paket_status == 'tutup' )? 'selected' : ''; ?>>Tidak Berlaku</option>
			</select>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
</form>