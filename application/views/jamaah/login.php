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
</head>
<body>

<div class="container" style="margin-top: 10%">
	<div class="row mt-5">
		<div class="col-md-4 offset-md-4">
			<?php echo ( $this->session->flashdata('alert') )? $this->session->flashdata('alert') : ''; ?>
			<form action="<?php echo base_url(); ?>welcome/checking" method="post">
				<div class="card">
					<div class="card-header">Login</div>
					<div class="card-body">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" placeholder="Email anda" required="">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password anda" required="">
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
						<div class="form-group">
							<p>Belum Punya akun ? <a href="<?php echo base_url(); ?>welcome/daftar">Daftar Sekarang</a></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row bg-light text-center mt-5">
		<div class="col">
			<p>&copy; 2019 biroumroh.id</p>
		</div>
	</div>
</div>

</body>
</html>