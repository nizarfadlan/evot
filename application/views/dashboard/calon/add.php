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
							<li class="breadcrumb-item">Calon</li>
							<li class="breadcrumb-item active">Calon Tambah</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-header">
							<a href="<?=base_url('inipanel/calon');?>"
								class="btn btn-danger btn-sm waves-effect waves-light shadow rounded mr-2"><i
									class="ti-arrow-left"></i> Kembali</a>
						</div>
						<div class="card-body">
							<form method="post" action="<?php echo base_url('inipanel/calon_tambah_aksi')?>" enctype="multipart/form-data">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
									value="<?=$this->security->get_csrf_hash();?>" style="display: none">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Nama</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="nama" placeholder="Masukkan nama..."
											required>
									</div>
									<?php echo form_error('nama');?>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Visi</label>
									<div class="col-sm-9">
                              <textarea class="form-control" name="visi" id="editor" required></textarea>
									</div>
									<?php echo form_error('visi');?>
								</div>
                        <div class="form-group row">
									<label class="col-sm-3 col-form-label">Misi</label>
									<div class="col-sm-9">
                              <textarea class="form-control" name="misi" id="editor1" required></textarea>
									</div>
									<?php echo form_error('misi');?>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Kelas</label>
									<div class="col-sm-9">
										<select class="form-control" name="kelas">
											<option>Kelas</option>
                                 <?php $kelas = $this->db->query("SELECT * FROM kelas")->result(); foreach($kelas as $k) {?>
                                 <option <?php if(set_value('kelas')==$k->kelas_id){echo "selected='selected'";} ?>
                                    value="<?php echo $k->kelas_id;?>"><?php echo $k->kelas_nama;?></option>
                                 <?php } ?>
										</select>
									</div>
									<?php echo form_error('kelas');?>
								</div>
                        <div class="form-group row">
									<label class="col-sm-3 col-form-label">Foto<br>
                              <small class="text-danger">(Format File: JPG/JPEG/PNG)</small>
                           </label>
									<div class="col-sm-9">
                              <input type="file" class="filestyle" id="upload" name="foto" data-buttonname="btn-secondary" required>
									</div>
									<?php
                              if(isset($gambar_error)){
                                 echo $gambar_error;
                              }
                           ?>
								</div>
								<div class="form-group row float-right">
									<div class="col-sm-auto">
										<button type="submit" class="btn btn-primary"><i class="ti-plus"></i>
											Tambah</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div> <!-- end col -->
			</div>

		</div> <!-- container-fluid -->

	</div> <!-- content -->
