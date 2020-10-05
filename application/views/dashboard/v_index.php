<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">

			<div class="row">
				<div class="col-sm-12">
					<div class="page-title-box">
						<h4 class="page-title">Dashboard</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-xl-3 col-md-6">
					<div class="card mini-stat bg-warning">
						<div class="card-body mini-stat-img">
							<div class="mini-stat-icon">
								<i class="mdi mdi-chart-line float-right"></i>
							</div>
							<div class="text-white">
								<h6 class="text-uppercase mb-3">Suara</h6>
								<h4 class="mb-4"><?=$jumlah_suara?></h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card mini-stat bg-warning">
						<div class="card-body mini-stat-img">
							<div class="mini-stat-icon">
								<i class="mdi mdi-account-location float-right"></i>
							</div>
							<div class="text-white">
								<h6 class="text-uppercase mb-3">Calon Ketua</h6>
								<h4 class="mb-4"><?=$jumlah_calon?></h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card mini-stat bg-warning">
						<div class="card-body mini-stat-img">
							<div class="mini-stat-icon">
								<i class="mdi mdi-account-multiple float-right"></i>
							</div>
							<div class="text-white">
								<h6 class="text-uppercase mb-3">Pemilih</h6>
								<h4 class="mb-4"><?=$jumlah_pemilih?></h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card mini-stat bg-warning">
						<div class="card-body mini-stat-img">
							<div class="mini-stat-icon">
								<i class="mdi mdi-pin float-right"></i>
							</div>
							<div class="text-white">
								<h6 class="text-uppercase mb-3">Belum memilih</h6>
								<h4 class="mb-4"><?=$belum_memilih?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title text-center mb-5">Pemenang Voting</h4>
						<?php foreach($pemenang as $pm){?>
							<h4 class="mt-0 mb-0 text-center"><?= $pm->calon_nama;?></h4>
							<div class="m-b-30 text-center"><b>Kelas: </b><?= $pm->calon_kelas;?></div>
							<div class="col text-center mb-2">
							<img style="width: 100px;height: auto;object-fit: cover; object-position: center;" src="<?= base_url().'/gambar/calon/'.$pm->calon_foto;?>" class="shadow">
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">

				<div class="col-lg-6">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title mb-3">Grafik E-Vot</h4>
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
									<p class="text-muted">Pemilih</p>
								</li>
							</ul>

							<canvas id="doughnut" height="260"></canvas>
						</div>
					</div>

				</div>
				<div class="col-lg-6">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title mb-4">Latest Coblos</h4>

							<ol class="activity-feed mb-0">
								<?php $no = 1; foreach($suara as $s){ ?>
								<li class="feed-item">
									<div class="feed-item-list">
										<span
											class="date"><?php setlocale(LC_ALL, 'id-ID', 'id_ID'); echo strftime("%A, %d %B %Y, %H:%m", strtotime($s->tanggal_memilih))?></span>
										<span class="activity-text"><?= $s->pemilih_nama;?></span>
									</div>
								</li>
								<?php } ?>
							</ol>

							<div class="text-center">
								<a href="<?=base_url('inipanel/suara');?>" class="btn btn-sm btn-primary">Load More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->

		</div> <!-- container-fluid -->

	</div> <!-- content -->
