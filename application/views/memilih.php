<html>
<?php $p = $this->db->get('pengaturan')->row();?>
<head>
	<title><?=$p->pengaturan_nama?> - Memilih</title>
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
	<!-- alert -->
	<div class="flash-data-sukses" data-flashdatasukses="<?= $this->session->flashdata('sukses'); ?>"></div>
	<div class="flash-data-gagal" data-flashdatagagal="<?= $this->session->flashdata('gagal'); ?>"></div>
	<header>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
				<div class="container">
					<a class="navbar-brand" href="#">
						<img class="log" src="<?= base_url();?>gambar/pengaturan/<?=$p->pengaturan_logo?>" alt="" loading="lazy">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="mdi mdi-menu"></i>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<div class="navbar-nav ml-auto">
							<a class="nav-item btn btn-warning rounded" href="<?= base_url();?>coblos/keluar">Keluar</a>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<?php 
$id_user = $this->session->userdata('id');
$sudah = $this->db->query("select * from pemilih where pemilih_id='$id_user'")->row();
?>
	<?php
	if($sudah->sudah_memilih=="0"){
?>
	<main>
		<section class="memilih m-t-30">
			<div class="container">
				<div class="section-header text-center m-b-30">
					<h1>Pilih ketua</h1>
					<h6 class="mb-0">Jangan sampai salah pilih ketua</h6>
				</div>
				<div class="section-body">
					<div class="row">
						<?php foreach($calon as $c){ ?>
						<div class="col-lg-4">
							<div class="card shadow-lg">
								<div class="card-body">
									<h5 class="mt-0 m-b-30 text-center"><?= $c->calon_nama;?></h5>
									<div class="col text-center mb-4">
										<?php if($c->calon_foto != NULL){?>
										<img style="width: 200px;height: auto;object-fit: cover; object-position: center;"
											src="<?= base_url().'/gambar/calon/'.$c->calon_foto;?>" class="shadow">
										<?php }else{ ?>
										<img src="<?= base_url().'/gambar/calon/default.jpg'?>" width="35%" class="shadow">
										<?php }?>
									</div>
									<div style="font-size:1rem;">
										<span><b>Kelas: </b><?= $c->kelas_nama;?></span><br>
										<span><b>Visi:</b><br><?= $c->calon_visi;?></span>
										<span><b>Misi:</b><br><?= $c->calon_misi;?></span>
									</div>
									<form method="post" class="form-horizontal" action="<?= base_url();?>coblos/pilih">
										<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
											value="<?=$this->security->get_csrf_hash();?>">
										<input type="hidden" name="pilihan" value="<?=encrypt_url($c->calon_id)."";?>">
										<input style="float: right; width:7em;"
											class="btn btn-warning waves-effect waves-light rounded m-t-10" type="submit"
											value="Pilih">
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
		<section class="live m-t-40">
			<div class="container">
				<div class="section-header text-center m-b-30">
					<h2>Hasil pemilihan</h2>
				</div>
				<div class="section-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6 mb-5">
											<h4 class="mt-0 header-title mb-3">Grafik <?=$p->pengaturan_nama?></h4>
											<ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
												<li class="list-inline-item">
													<h5 class="mb-0"><?= $belum_memilih;?></h5>
													<p class="text-muted">Belum Memilih</p>
												</li>
												<li class="list-inline-item">
													<h5 class="mb-0"><?= $sudah_memilih;?></h5>
													<p class="text-muted">Sudah Memilih</p>
												</li>
												<li class="list-inline-item">
													<h5 class="mb-0"><?= $jumlah_pemilih;?></h5>
													<p class="text-muted">Siswa</p>
												</li>
											</ul>

											<canvas id="doughnut" height="260"></canvas>
										</div>
										<div class="col-lg-6">
											<h4 class="mt-0 header-title mb-4">Suara</h4>
											<?php $no = 0; foreach ($cetak as $c){?>
											<div style="margin-bottom:35px">
												<h5><img style="width: 100px;height: auto; margin-right:20px;"
														src="<?= base_url().'/gambar/calon/'.$c['calon_foto'];?>"
														class="shadow rounded-lg"><?=$c['calon_nama']?></h5>
												<div class="">
													<?php $persen=$c['total_suara']/$sudah_memilih*100;?>
													<div class="progress" style="height: 16px;">
														<div class="progress-bar" role="progressbar" style="width: <?=$persen;?>%;"
															aria-valuenow="<?=$persen;?>" aria-valuemin="0" aria-valuemax="100">
															<?=$persen;?>%</div>
													</div>
												</div>
											</div>
											<?php $no++; } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php } else{?>
	<main>
		<div class="container-fluid">
			<section class="live m-t-40">
				<div class="container">
					<div class="section-header text-center m-b-30">
						<h2>Hasil pemilihan</h2>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="card shadow-lg">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 mb-5">
												<h4 class="mt-0 header-title mb-3">Grafik <?=$p->pengaturan_nama?></h4>
												<ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
													<li class="list-inline-item">
														<h5 class="mb-0"><?= $belum_memilih;?></h5>
														<p class="text-muted">Belum Memilih</p>
													</li>
													<li class="list-inline-item">
														<h5 class="mb-0"><?= $sudah_memilih;?></h5>
														<p class="text-muted">Sudah Memilih</p>
													</li>
													<li class="list-inline-item">
														<h5 class="mb-0"><?= $jumlah_pemilih;?></h5>
														<p class="text-muted">Siswa</p>
													</li>
												</ul>

												<canvas id="doughnut" height="260"></canvas>
											</div>
											<div class="col-lg-6">
												<h4 class="mt-0 header-title mb-4">Suara</h4>
												<?php $no = 0; foreach ($cetak as $c){?>
												<div style="margin-bottom:35px">
													<h5><img style="width: 100px;height: auto; margin-right:20px;"
															src="<?= base_url().'/gambar/calon/'.$c['calon_foto'];?>"
															class="shadow rounded-lg"><?=$c['calon_nama']?></h5>
													<div class="">
														<div class="progress" style="height: 16px;">
															<div class="progress-bar" role="progressbar" style="width: <?=$c['total_suara'];?>%;"
																aria-valuenow="<?=$c['total_suara'];?>" aria-valuemin="0" aria-valuemax="100">
																<?=$c['total_suara'];?></div>
														</div>
													</div>
												</div>
												<?php $no++; } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
	<?php } ?>
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
<!-- chart -->
<script src="<?= base_url();?>assets/plugins/chart.js/chart.min.js"></script>
<script>
	! function ($) {
		"use strict";

		var ChartJs = function () {};

		ChartJs.prototype.respChart = function (selector, type, data, options) {
				// get selector by context
				var ctx = selector.get(0).getContext("2d");
				// pointing parent container to make chart js inherit its width
				var container = $(selector).parent();

				// enable resizing matter
				$(window).resize(generateChart);

				// this function produce the responsive Chart JS
				function generateChart() {
					// make chart width fit with its container
					var ww = selector.attr('width', $(container).width());
					switch (type) {
						case 'Doughnut':
							new Chart(ctx, {
								type: 'doughnut',
								data: data,
								options: options
							});
							break;
					}
					// Initiate new chart or Redraw

				};
				// run function - render chart at first load
				generateChart();
			},
			//init
			ChartJs.prototype.init = function () {
				//donut chart
				var donutChart = {
					labels: [
						"Belum Memilih",
						"Sudah Memilih",
						"Siswa"
					],
					datasets: [{
						data: [ <?= $belum_memilih; ?> , <?= $sudah_memilih; ?> , <?= $jumlah_pemilih; ?> ],
						backgroundColor: [
							"#ebeff2",
							"#f4a90d",
							"#6a5db6"
						],
						hoverBackgroundColor: [
							"#ebeff2",
							"#f4a90d",
							"#6a5db6"
						],
						hoverBorderColor: "#fff"
					}]
				};
				this.respChart($("#doughnut"), 'Doughnut', donutChart);
			},
			$.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

	}(window.jQuery),

	//initializing
	function ($) {
		"use strict";
		$.ChartJs.init()
	}(window.jQuery);

</script>

</html>
