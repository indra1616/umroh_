<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Adminstrator Panel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/bootstrap/css/bootstrap.min.css">
    <!-- Goggle Font CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/gfont/css.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/admin-style.css">
    <!-- Themify Icon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/themify/themify-icons.css">
</head>

<body>
	<div class="container">
		<div class="row" style="margin-top: 15%">
			<div class="col-md-4 offset-md-4">
				<?php echo ( $this->session->flashdata('alert') )? $this->session->flashdata('alert') : ''; ?>
				<form action="<?php echo base_url(); ?>admin/checking" method="post">
					<div class="card">
						<div class="card-header">Login Admin</div>
						<div class="card-body">
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="username" placeholder="Username anda" required="">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="password" placeholder="Password anda" required="">
							</div>
							<div class="form-group mt-5">
								<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>