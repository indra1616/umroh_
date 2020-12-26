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
	<script src="<?php echo base_url(); ?>dist/jquery/jquery.min.js"></script>
	<script>
		$(function(){

			function rand(){
				return Math.floor(Math.random() * 10);
			}

			var a = $('input[name="a"]').val(rand())
			var b = $('input[name="b"]').val(rand())

			$('.result').val( a.val() + ' + ' + b.val() + ' = ' )
		})
	</script>
</head>
<body>

<div class="container" style="margin-top: 5%">
	<div class="row mt-5">
		<div class="col-md-4 offset-md-4">
			<?php echo ( $this->session->flashdata('alert') )? $this->session->flashdata('alert') : ''; ?>
			<form action="<?php echo base_url(); ?>welcome/registrasi" method="post">
				<div class="card">
					<div class="card-header">Daftar</div>
					<div class="card-body">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="nama" placeholder="Nama anda" required="">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" placeholder="Email anda" required="">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password anda" required="">
						</div>
						<div class="row form-group">
							<input type="hidden" name="a">
							<input type="hidden" name="b">
							<div class="col-md-12">
								<label>Keamanan :</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="result form-control" name="" readonly="">
							</div>
							<div class="col">
								<input type="text" class="form-control" name="c" required="">
							</div>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-primary btn-block">Daftar</button>
						</div>
						<div class="form-group">
							<p>Sudah Punya akun ? <a href="<?php echo base_url(); ?>welcome/login">Login Sekarang</a></p>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row bg-light text-center mt-5">
		<div class="col">
			<p>&copy; 2020 biroumroh.id</p>
		</div>
	</div>
</div>

</body>
</html>