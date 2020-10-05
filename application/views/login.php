<html>
<?php $p = $this->db->get('pengaturan')->row();?>
<head>
	<title>Login - <?=$p->pengaturan_nama?></title>
	<meta charset="utf-8">
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="<?= base_url();?>gambar/pengaturan/<?=$p->pengaturan_logo?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Begin page -->
	<div class="wrapper-page">

		<div class="card">
			<div class="card-body">

				<h3 class="text-center m-0">
					<a href="index.php" class="logo logo-admin"><img
							src="<?= base_url();?>gambar/pengaturan/<?=$p->pengaturan_logo?>" height="40" alt="logo"></a>
				</h3>

				<div class="p-3">
					<h4 class="text-muted font-18 m-b-5 text-center">Welcome <?=$p->pengaturan_nama?></h4>
					<p class="text-muted text-center">Silahkan isi untuk masuk.</p>
					<!-- Alert -->
					<?php
                        if(isset($_GET['alert'])){
                            if($_GET['alert']=="gagal"){
                                echo "<div class='alert alert-danger bg-danger text-white text-center' role='alert'><small><strong>Login Gagal</strong> Cek username dan password pastikan benar.</small></div>";
                            }else
                                    if($_GET['alert']=="logout"){
                                        echo "<div class='alert alert-success bg-success text-white text-center' role='alert'><small><strong>Logout!</strong> Anda sudah berhasil keluar.</small></div>";
                                    }else 
                                if($_GET['alert']=="belum_login"){
                                    echo "<div class='alert alert-danger bg-danger text-white text-center' role='alert'><small><strong>Belum Login!</strong> Silahkan login terlebih dahulu.</small></div>";
                                }
                        }
                        ?>
					<!-- Alert end -->
					<form method="post" class="form-horizontal m-t-30" action="<?php echo base_url();?>mlebugais/aksi">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control" id="username"
								placeholder="Enter username">
						</div>

						<div class="form-group">
							<label for="userpassword">Password</label>
							<input type="password" name="password" class="form-control" id="userpassword"
								placeholder="Enter password">
						</div>

						<div class="form-group row m-t-20">
							<div class="col-6">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customControlInline">
									<label class="custom-control-label" for="customControlInline">Remember me</label>
								</div>
							</div>
							<div class="col-6 text-right">
								<input class="btn btn-primary w-md waves-effect waves-light" type="submit"
									value="Masuk"></input>
							</div>
						</div>
					</form>
				</div>

				<div class="m-t-20 text-center">
					<a class="text-danger" href="<?= base_url();?>">Kembali ke home</a>
					<p>Copyright© <?php echo date('Y');?> <?=$p->pengaturan_nama?>. Made with <i class="mdi mdi-heart text-danger"></i>
						by Nizar</p>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="<?= base_url();?>assets/js/jquery.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url();?>assets/js/waves.min.js"></script>
<script src="<?= base_url();?>assets/js/app.js"></script>
<script src="<?= base_url();?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url();?>assets/pages/dashboard.js"></script>
</html>