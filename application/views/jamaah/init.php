<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
	<title><?php echo $title; ?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="google-site-verification" content="">
	<meta name="msvalidate.01" content="">
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:locale" content="" />
	<meta property="og:image" content="" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>dist/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>dist/select2/zeniora/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>dist/select2/zeniora/select2-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>dist/themify/themify-icons.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>dist/gfont/css.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>dist/style.css">

	<script src="<?php echo base_url(); ?>dist/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>dist/select2/zeniora/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>dist/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>dist/script.js"></script>
</head>
<body class="bg-light">



<?php if(  $this->lengkap != 'lengkap' && $this->lengkap != '' ): ?>
<div class="container">
	<div class="row">
		<div class="col">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">×</span>
		        </button>
		        <b>Perhatian</b> Maaf beberapa fitur sementara sedang kami disabled sampai anda melangkapi identitas diri dengan benar. Terima kasih <br>Ok, saya megerti <a href="<?php echo base_url(); ?>welcome/profil">Lengkapi sekarang</a>
		    </div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if( is_null($this->session->userdata('ci_userid')) ): ?>
<div class="container">
	<div class="row">
		<div class="col">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">×</span>
		        </button>
		        Silahkan <a href="<?php echo base_url(); ?>welcome/login">Masuk</a> untuk dapat melakukan transaksi di aplikasi ini
		    </div>
		</div>
	</div>
</div>
<?php endif; ?>

<div class="container bg-white shadow mt-4 mb-4 pt-4" style="border-radius: 20px;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-light p-3">
	  <a class="navbar-brand" href="<?php echo base_url(); ?>welcome"><img src="<?php echo base_url(); ?>dist/logo.png" class="img-fluid" style="width: 260px"></a>
	  <button class="navbar-toggler navbar-toggler-right bg-light" type="button" data-toggle="collapse" data-target="#navb">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navb">
	    <ul class="navbar-nav mr-auto">
	       <li class="nav-item">
		      <a class="nav-link text-dark" href="<?php echo base_url(); ?>welcome/status_pendaftaran"><i class="ti-check"></i> Status Pendaftaran</a>
		    </li>
	    </ul>
	    <?php if( is_null($this->session->userdata('ci_userid')) ): ?>
		    <a href="<?php echo base_url(); ?>welcome/daftar" class="btn btn-success my-2 my-sm-0">Daftar</a>
		    <a href="<?php echo base_url(); ?>welcome/login" class="btn btn-outline-success my-2 my-sm-0 ml-3">Masuk</a>
		<?php else: ?>
			<a class="btn btn-success" href="<?php echo base_url(); ?>welcome/profil">Salam, <?php echo $this->session->userdata('ci_username'); ?></a>
			<a href="<?php echo base_url(); ?>welcome/logout" class="btn btn-danger my-2 my-sm-0 ml-3"><i class="ti-power-off"></i></a>
		</li>
		<?php endif; ?>
	  </div>
	</nav>
	<div class="row">
		<div class="col">
			<?php echo ( $this->session->flashdata('alert') )? $this->session->flashdata('alert') : ''; ?>
		</div>
	</div>
	
	<?php echo $init; ?>

	<div class="row bg-light text-center mt-5">
		<div class="col">
			<p>&copy; 2020 biroumroh.id</p>
		</div>
	</div>
</div>

</body>
</html>