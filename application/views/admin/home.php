<div class="row widget">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h1><?php echo $total_jamaah; ?></h1>
				<p>Total Jamaah</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h1><?php echo $total_paket; ?></h1>
				<p>Total Paket</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h1><?php echo $total_periode; ?></h1>
				<p>Total Periode</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h1><?php echo 'Rp.'. number_format($total_income,0,',','.'); ?></h1>
				<p>Total Income</p>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">Grafik Transaksi</div>
			<div class="card-body">
				<div id="bar" style="width: 100%;height: 300px;"></div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">Notifikasi <span class="float-right badge badge-info"><?php echo $query_pendaftaran->num_rows(); ?></span></div>
			<div class="card-body table-responsive">
				<?php if( $query_pendaftaran->num_rows() > 0 ): ?>
					<table class="table">
						<tr>
							<th>Tanggal</th>
							<th>Nama Jamaah</th>
							<th>Paket</th>
							<th>Kategori</th>
							<th>Aksi</th>
						</tr>
						<?php foreach( $query_pendaftaran->result() as $tp ): ?>
							<tr>
								<td><?php echo date('d-m-Y H:i:s', strtotime($tp->pendaftaran_tanggal_tambah)); ?></td>
								<td><?php echo $tp->jamaah_nama; ?></td>
								<td><?php echo $tp->paket_nama; ?></td>
								<td>
									<?php if($tp->paket_kategori == 'haji'): ?>
										<span class="badge badge-danger">Haji</span>
									<?php else: ?>
										<span class="badge badge-success">Umroh</span>
									<?php endif; ?>
								</td>
								<td><a href="<?php echo base_url(); ?>admin/pendafataran_periode?filter_by_id=<?php echo $tp->pendaftaran_id; ?>" class="btn btn-primary">Go</a></td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php else: ?>
					<p>Tidak Ada Transaksi</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	Highcharts.chart('bar', {
	    chart: {
	        type: 'column',
	    },
	    title: {
	        text: ''
	    },
	    xAxis: {
	        categories: <?php echo json_encode($bar_kategori); ?>
	    },
	    yAxis: {
	          min: 0,
	          title: {
	              text: 'Transkasi'
	          }
	    },
	    tooltip: {
	          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	              '<td style="padding:0"><b>{point.y}  Transkasi</b></td></tr>',
	          footerFormat: '</table>',
	          shared: true,
	          useHTML: true
	    },
	    credits: {
	        enabled: false
	    },
	    plotOptions: {
        column: {
            borderRadius: 5
        }
    },
	    series: [{
	        name: 'Bulan',
	        data: <?php echo json_encode($bar_periode); ?>
	    }]
	});
</script>