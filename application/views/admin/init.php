<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/bootstrap/css/bootstrap.min.css">
    <!-- Goggle Font CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/gfont/css.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/admin-style.css">
    <!-- Themify Icon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/themify/themify-icons.css">
    <!-- jQuery JS -->
    <script src="<?php echo base_url(); ?>dist/jquery/jquery.min.js"></script>
    <!-- Highchart -->
    <script src="<?php echo base_url(); ?>dist/highcharts/highcharts.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <h3><b>Admin</b></h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="<?php echo base_url(); ?>admin/dashboard"><i class="ti-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/jamaah"><i class="ti-user"></i> Data Jamaah</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/paket"><i class="ti-package"></i> Data Paket</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/periode"><i class="ti-time"></i> Data Periode U/H</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/pendaftaran"><i class="ti-pencil"></i> Pendaftaran</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/keluar"><i class="ti-power-off"></i> Keluar</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="ti-menu"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-light d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-user"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Administrator</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="row">
                <div class="col">
                    <?php echo ( $this->session->flashdata('alert') )? $this->session->flashdata('alert') : ''; ?>
                </div>
            </div>

            <?php echo $init; ?>

            <p class="mt-5">&copy; 2019 </p>
        </div>
    </div>

    
    <!-- Popper.JS -->

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url(); ?>dist/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>