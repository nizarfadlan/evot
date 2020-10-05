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
						<h4 class="page-title">Settings</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
							<li class="breadcrumb-item active">Settings</li>
						</ol>
					</div>
				</div>
			</div>
			<?php $coblos = $this->db->query("SELECT * FROM pemilih WHERE sudah_memilih='1'")->num_rows();
			$calon = $this->m_data->get_data('calon')->num_rows();
			$pemilih = $this->m_data->get_data('pemilih')->num_rows();
			$suara = $this->m_data->get_data('suara')->num_rows();?>
			<!-- end row -->
			<div class="row">
				<div class="col-5">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Hapus data</h4>
							<div class="m-b-5"><a href="<?php echo base_url().'inipanel/hapuscoblosnizar';?>"
									class="btn btn-primary waves-effect waves-light shadow tombol-hapus rounded m-r-5">Hapus
									Coblos</a><span> Jumlah data: <?=$coblos?></span></div>
							<div class="m-b-5"><a href="<?php echo base_url().'inipanel/hapuscalonnizar';?>"
									class="btn btn-primary waves-effect waves-light shadow tombol-hapus rounded m-r-5">Hapus
									calon</a><span> Jumlah data: <?=$calon?></span></div>
							<div class="m-b-5"><a href="<?php echo base_url().'inipanel/hapuspemilihnizar';?>"
									class="btn btn-primary waves-effect waves-light shadow tombol-hapus rounded m-r-5">Hapus
									pemilih</a><span> Jumlah data: <?=$pemilih?></span></div>
							<div class="m-b-5"><a href="<?php echo base_url().'inipanel/hapussuaranizar';?>"
									class="btn btn-primary waves-effect waves-light shadow tombol-hapus rounded m-r-5">Hapus
									suara</a><span> Jumlah data: <?=$suara?></span></div>
						</div>
					</div>
				</div>
				<div class="col-7">
					<div class="card m-b-20 bg-dark" style="color:#fff;">
						<div class="card-body">
							<?php foreach($pengaturan as $p){ ?>
							<h4 class="mt-0 header-title">Informasi <a href="<?php echo base_url().'inipanel/setting_edit/'.encrypt_url($p->pengaturan_id)."";?>" class="float-right"><i class="ti-pencil text-warning"></i></a></h4>
							<div class="m-b-5">
								<span><b>Nama : </b><?=$p->pengaturan_nama?></span>
							</div>
							<div class="m-b-5">
								<span>Logo : </span>
								<img src="<?= base_url();?>gambar/pengaturan/<?=$p->pengaturan_logo?>" alt="" height="30">
							</div>
							<div class="m-b-5">
								<span>Logo Panjang : </span>
								<img src="<?= base_url();?>gambar/pengaturan/<?=$p->logo_panjang?>" alt="" height="30">
							</div>
							<div class="m-b-5">
								<span><b>Deskripsi : </b></span><br>
								<span><?=$p->pengaturan_tentang?></span>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div> <!-- end col -->
		</div> <!-- end row -->
		<div class="row">
			<div class="col-12">
				<div class="card m-b-20">
					<div class="card-body">
						<h4 class="mt-0 m-b-30 header-title"><i class="ti-timer"></i> Log User <a
								href="<?php echo base_url().'inipanel/hapuslognizargans';?>"
								class="btn btn-primary waves-effect waves-light shadow tombol-hapus float-right rounded"><i
									class="ti-trash"></i></a></h4>
						<!-- Table-->
						<table id="datatable" class="table table-bordered dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Pengguna</th>
									<th>Action</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($log as $l){ ?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $l->log_time;?></td>
									<td><?php echo $l->log_user;?></td>
									<td>
										<?php 
												if($l->log_tipe == 0){
													echo"<span class='badge badge-pill badge-primary shadow'>Login</span>";
												}elseif($l->log_tipe == 1) {
													echo"<span class='badge badge-pill badge-dark shadow'>Logout</span>";
												}elseif($l->log_tipe == 2) {
													echo"<span class='badge badge-pill badge-success shadow'>Add</span>";
												}elseif($l->log_tipe == 3) {
													echo"<span class='badge badge-pill badge-warning shadow'>Edit</span>";
												}elseif($l->log_tipe == 5) {
													echo"<span class='badge badge-pill badge-info shadow'>Coblos</span>";
												}else{
													echo"<span class='badge badge-pill badge-danger shadow'>Remove</span>";
												};
											?>
									</td>
									<td><?php echo $l->log_desc;?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- container-fluid -->
</div> <!-- content -->
