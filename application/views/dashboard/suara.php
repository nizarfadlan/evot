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
						<h4 class="page-title">Suara</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
							<li class="breadcrumb-item active">Suara</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Suara</h4>
							<p class="text-muted m-b-30">Suara yang masuk dalam E-Vot.</p>
							<!-- Table -->
							<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead>
									<tr>
										<th>No</th>
										<th>Kadidat</th>
										<th>Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; foreach($calon as $c){ ?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $c->calon_nama;?></td>
										<td><?php echo $c->total_suara;?></td>
									</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div> <!-- end col -->
			</div> <!-- end row -->
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Log Suara</h4>
							<p class="text-muted m-b-30">Log suara.</p>
							<!-- Table -->
							<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Kadidat</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; foreach($suara as $s){ ?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $s->pemilih_nama;?></td>
										<td><?php echo $s->calon_nama;?></td>
										<td><?php echo $s->tanggal_memilih;?></td>
									</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div> <!-- end col -->
			</div> <!-- end row -->
		</div> <!-- container-fluid -->
	</div> <!-- content -->
