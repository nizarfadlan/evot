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
						<h4 class="page-title">Setting</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
							<li class="breadcrumb-item">Account</li>
							<li class="breadcrumb-item">Setting</li>
							<li class="breadcrumb-item active">Setting Edit</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-header">
							<a href="<?=base_url('inipanel/setting');?>"
								class="btn btn-danger btn-sm waves-effect waves-light shadow rounded mr-2"><i
									class="ti-arrow-left"></i> Kembali</a>
						</div>
						<div class="card-body">
                  <?php foreach($pengaturan as $p){?>
							<form method="post" action="<?php echo base_url('inipanel/setting_edit_aksi')?>">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
									value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" name="id" value="<?=encrypt_url($p->pengaturan_id)."";?>">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Nama</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="nama" value="<?= $p->pengaturan_nama;?>"
											required>
									</div>
									<?php echo form_error('nama');?>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Keterangan</label>
									<div class="col-sm-9">
                              <textarea class="form-control" name="ket" id="editor" required><?= $p->pengaturan_tentang;?></textarea>
									</div>
									<?php echo form_error('ket');?>
								</div>
								<div class="form-group row float-right">
									<div class="col-sm-auto">
										<button type="submit" class="btn btn-primary"><i class="ti-pencil"></i>
											Ganti</button>
									</div>
								</div>
							</form>
                  <?php }?>
						</div>
					</div>
				</div> <!-- end col -->
			</div>
         <div class="row">
            <div class="col-lg-6">
               <div class="card m-b-20">
                  <div class="card-body">
                  <?php foreach($pengaturan as $p){?>
                     <form method="post" action="<?php echo base_url('inipanel/setting_edit_logo')?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
									value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" name="id" value="<?=encrypt_url($p->pengaturan_id)."";?>">
                        <div class="form-group row">
									<label class="col-sm-12 col-form-label">Logo<br>
                              <small>* Jika tidak diganti biarkan saja</small><br>
                              <small class="text-danger">(Format File: JPG/JPEG/PNG)<br>* 50x50</small><br>
                           </label>
									<div class="col-sm-12">
                              <input type="file" class="filestyle" id="upload" name="logo" data-buttonname="btn-secondary">
									</div>
									<?php
                              if(isset($gambar_error)){
                                 echo $gambar_error;
                              }
                           ?>
								</div>
                        <div class="form-group row float-right">
									<div class="col-sm-auto">
										<button type="submit" class="btn btn-primary"><i class="ti-pencil"></i>
											Ganti</button>
									</div>
								</div>
                     </form>
                  <?php } ?>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="card m-b-20">
                  <div class="card-body">
                  <?php foreach($pengaturan as $p){?>
                     <form method="post" action="<?php echo base_url('inipanel/setting_edit_panjang')?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
									value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" name="id" value="<?=encrypt_url($p->pengaturan_id)."";?>">
                        <div class="form-group row">
									<label class="col-sm-12 col-form-label">Logo Panjang<br>
                              <small>* Jika tidak diganti biarkan saja</small><br>
                              <small class="text-danger">(Format File: JPG/JPEG/PNG)<br>* 136x36</small><br>
                           </label>
									<div class="col-sm-12">
                              <input type="file" class="filestyle" id="upload1" name="logop" data-buttonname="btn-secondary">
									</div>
									<?php
                              if(isset($gambar_error1)){
                                 echo $gambar_error1;
                              }
                           ?>
								</div>
                        <div class="form-group row float-right">
									<div class="col-sm-auto">
										<button type="submit" class="btn btn-primary"><i class="ti-pencil"></i>
											Ganti</button>
									</div>
								</div>
                     </form>
                  <?php } ?>
                  </div>
               </div>
            </div>
         </div>

		</div> <!-- container-fluid -->

	</div> <!-- content -->
