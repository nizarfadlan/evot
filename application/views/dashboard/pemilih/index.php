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
						<h4 class="page-title">Pemilih</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
							<li class="breadcrumb-item">Account</li>
							<li class="breadcrumb-item active">Pemilih</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Pemilih<a href="<?php echo base_url().'inipanel/pemilih_tambah';?>"
												class="btn btn-sm btn-primary waves-effect waves-light shadow float-right rounded"><i
													class="ti-plus"></i></a></h4>
							<p class="text-muted m-b-30">Pemilih E-Vot ini yang akan diselengarakan.</p>
							<!-- Table -->
							<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Username</th>
										<th>kelas</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; foreach($pemilih as $p){ ?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $p->pemilih_nama;?></td>
										<td><?php echo $p->pemilih_username;?></td>
										<td><?php echo $p->kelas_nama;?></td>
										<td>
											<?php if($p->sudah_memilih == 1){?>
                                    <span class="badge badge-pill badge-success shadow">Sudah Memilih</span><br>
												<small><?=$p->tanggal_memilih;?></small><br>
                                 <?php }else { ?>
                                    <span class="badge badge-pill badge-danger shadow">Belum Memilih</span>
                                 <?php } ?>
										</td>
										<td>
											<?php if($p->sudah_memilih == 1){ ?>
											<a href="<?php echo base_url().'inipanel/pemilih_non/'.encrypt_url($p->pemilih_id)."";?>"
												class="btn btn-sm btn-secondary waves-effect waves-light tombol-sudah"><i
													class="ti-close"></i></a>
											<?php }else { ?>
											<a href="<?php echo base_url().'inipanel/pemilih_aktif/'.encrypt_url($p->pemilih_id)."";?>"
												class="btn btn-sm btn-success waves-effect waves-light"><i class="ti-check"></i></a>
											<?php }; ?>

											<a href="<?php echo base_url().'inipanel/pemilih_edit/'.encrypt_url($p->pemilih_id)."";?>"
												class="btn btn-sm btn-warning waves-effect waves-light"><i
													class="ti-pencil"></i></a>
											<a href="<?php echo base_url().'inipanel/pemilih_hapus/'.encrypt_url($p->pemilih_id)."";?>"
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
