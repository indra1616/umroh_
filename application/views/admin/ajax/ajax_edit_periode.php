<?php $row = $query_periode->row(); ?>

<form action="<?php echo base_url(); ?>admin/update_periode/<?php echo $row->periode_id; ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label>Bulan</label>
            <input type="text" class="form-control" name="bulan" value="<?php echo $row->periode_bulan; ?>">
        </div>
        <div class="form-group">
            <label>Tahun</label>
            <input type="text" class="form-control" name="tahun" value="<?php echo $row->periode_tahun; ?>">
        </div>
        <div class="form-group">
            <label>Tanggal Berangkat</label>
            <input type="date" class="form-control" name="berangkat" value="<?php echo $row->periode_tanggal_berangkat; ?>">
        </div>
        <div class="form-group">
            <label>Biaya</label>
            <input type="text" class="form-control" name="biaya" value="<?php echo $row->periode_biaya; ?>">
        </div>
        <div class="form-group">
            <label>Paket</label>
            <select class="form-control" name="paket">
                <option value="">--Pilih--</option>
                <?php foreach( $query_paket->result() as $pk ): ?>
                    <option value="<?php echo $pk->paket_id; ?>" <?php echo ($pk->paket_id)? 'selected' : ''; ?>><?php echo strtoupper($pk->paket_kategori) .' | '. $pk->paket_nama; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Status Periode</label>
            <select class="form-control" name="status">
                <option value="buka" <?php echo ( $row->periode_status == 'buka' )? 'selected' : ''; ?>>Berkalu</option>
                <option value="tutup" <?php echo ( $row->periode_status == 'tutup' )? 'selected' : ''; ?>>Tidak Berlaku</option>
            </select>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
</form>