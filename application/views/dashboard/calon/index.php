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
						<h4 class="page-title">Calon</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
							<li class="breadcrumb-item">Account</li>
							<li class="breadcrumb-item active">Calon</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Calon<a href="<?php echo base_url().'inipanel/calon_tambah';?>"
												class="btn btn-sm btn-primary waves-effect waves-light shadow float-right rounded"><i
													class="ti-plus"></i></a></h4>
							<p class="text-muted m-b-30">Calon kadidat E-Vot.</p>
							<!-- Table -->
							<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Foto</th>
										<th>Visi</th>
										<th>Misi</th>
										<th>Kelas</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; foreach($calon as $c){ ?>
									<tr>
										<td><?= $no++;?></td>
										<td><?= $c->calon_nama;?></td>
										<td>
                                 <?php if($c->calon_foto != NULL){?>
                                    <div style="width: 200px;">
                                       <img style="width: auto;height: auto;object-fit: cover; object-position: center;" src="<?= base_url().'/gambar/calon/'.$c->calon_foto;?>">
                                    </div>
											<?php }else{ ?>
												<img src="<?= base_url().'/gambar/calon/default.jpg'?>" width="20%">
											<?php }?>
                              </td>
										<td><?= $c->calon_visi;?></td>
										<td><?= $c->calon_misi;?></td>
                              <td><?= $c->kelas_nama;?></td>
										<td>
											<a href="<?= base_url().'inipanel/calon_edit/'.encrypt_url($c->calon_id)."";?>"
												class="btn btn-sm btn-warning waves-effect waves-light"><i
													class="ti-pencil"></i></a>
											<a href="<?= base_url().'inipanel/calon_hapus/'.encrypt_url($c->calon_id)."";?>"
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
