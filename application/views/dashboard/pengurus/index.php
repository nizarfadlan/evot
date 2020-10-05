<!-- Alert -->
<div class="flash-data-sukses" data-flashdatasukses="<?= $this->session->flashdata('sukses'); ?>"></div>
<div class="flash-data-gagal" data-flashdatagagal="<?= $this->session->flashdata('gagal'); ?>"></div>
<div class="flash-data-ada" data-flashdataada="<?= $this->session->flashdata('ada'); ?>"></div>
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
						<h4 class="page-title">Pengurus</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
							<li class="breadcrumb-item">Account</li>
							<li class="breadcrumb-item active">Pengurus</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Pengurus<a href="<?php echo base_url().'inipanel/pengurus_tambah';?>"
												class="btn btn-sm btn-primary waves-effect waves-light shadow float-right rounded"><i
													class="ti-plus"></i></a></h4>
							<p class="text-muted m-b-30">Pengurus E-Vot ini yang akan diselengarakan.</p>
							<!-- Table -->
							<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Username</th>
										<th>Level</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; foreach($pengguna as $p){ ?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $p->pengguna_nama;?></td>
										<td><?php echo $p->pengguna_username;?></td>
										<td><?php echo $p->pengguna_level;?></td>
										<td>
											<?php if($p->pengguna_status == 1){
											   echo"<span class='badge badge-pill badge-success shadow'>Aktif</span>";
                                 }else {
                                    echo"<span class='badge badge-pill badge-danger shadow'>Non Aktif</span>";
                                 };?>
										</td>
										<td>
											<?php if($p->pengguna_status == 1){ ?>
											<a href="<?php echo base_url().'inipanel/pengurus_non/'.encrypt_url($p->pengguna_id)."";?>"
												class="btn btn-sm btn-secondary waves-effect waves-light tombol-non"><i
													class="ti-close"></i></a>
											<?php }else { ?>
											<a href="<?php echo base_url().'inipanel/pengurus_aktif/'.encrypt_url($p->pengguna_id)."";?>"
												class="btn btn-sm btn-success waves-effect waves-light"><i class="ti-check"></i></a>
											<?php }; ?>

											<a href="<?php echo base_url().'inipanel/pengurus_edit/'.encrypt_url($p->pengguna_id)."";?>"
												class="btn btn-sm btn-warning waves-effect waves-light"><i
													class="ti-pencil"></i></a>
											<a href="<?php echo base_url().'inipanel/pengurus_hapus/'.encrypt_url($p->pengguna_id)."";?>"
												class="btn btn-sm btn-danger tombol-hapus waves-effect waves-light"><i
													class="ti-trash"></i></a>
										</td>
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
