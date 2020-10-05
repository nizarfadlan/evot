<html>
<?php $p = $this->db->get('pengaturan')->row();?>
<head>
	<title><?=$p->pengaturan_nama?></title>
	<meta charset="utf-8">
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="<?= base_url();?>gambar/pengaturan/<?=$p->pengaturan_logo?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="flash-data-masuk" data-flashdatamasuk="<?= $this->session->flashdata('masuk'); ?>"></div>
	<div class="flash-data-sukses" data-flashdatasukses="<?= $this->session->flashdata('sukses'); ?>"></div>
	<main>
		<div class="container-fluid">
         <div class="jumbotron jumbotron-fluid">
            <div class="container">
               <img src="<?= base_url();?>assets/images/jm.svg" alt="">
               <h1 class="display-4"><?=$p->pengaturan_nama?></h1>
               <p class="lead"><?=$p->pengaturan_tentang?>.</p>
					<div class="alerts">
						<?php
                     if(isset($_GET['alert'])){
                        if($_GET['alert']=="coblos"){
									echo "<div class='alert alert-success bg-success text-white text-center' role='alert'><small><strong>Berhasil!!!</strong> Coblos.</small></div>";
								}else{
									if($_GET['alert']=="keluar"){
									echo "<div class='alert alert-success bg-success text-white text-center' role='alert'><small><strong>Berhasil!!!</strong> Keluar.</small></div>";
									}
								}
                  	}
                  ?>
					</div>
               <p class="lead mt-4">
						<form method="post" class="form-inline" action="<?php echo base_url();?>home/memilih">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
							<div class="form-group">
								<div class="col-lg-10">
									<input class="form-control shadow user" style="border-radius: 10rem;" type="text" placeholder="Username" name="username">
								</div>
								<div class="col-lg-2">
									<input class="btn btn-warning waves-effect waves-light masuk shadow" style="border-radius: 10rem;" type="submit" value="Masuk"></input>
								</div>
							</div>
						</form>
               </p>
            </div>
         </div>
		</div>
	</main>
	<!-- Footer -->
	<footer class="bawah text-center">
		Copyright© <?php echo date('Y');?> <?=$p->pengaturan_nama?> - <span>
			Made with
			<i class="mdi mdi-heart text-danger"></i> by Nizar</span>.
	</footer>

</body>

<script src="<?= base_url();?>assets/js/jquery.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url();?>assets/js/waves.min.js"></script>
<script src="<?= base_url();?>assets/js/app.js"></script>
<script src="<?= base_url();?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url();?>assets/plugins/sweet-alert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url();?>assets/plugins/sweet-alert2/myscript.js"></script>
</html>
