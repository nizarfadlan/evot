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
							<li class="breadcrumb-item">Pemilih</li>
							<li class="breadcrumb-item active">Pemilih Edit</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-header">
							<a href="<?=base_url('inipanel/pemilih');?>"
								class="btn btn-danger btn-sm waves-effect waves-light shadow rounded mr-2"><i
									class="ti-arrow-left"></i> Kembali</a>
						</div>
						<div class="card-body">
                  <?php foreach($pemilih as $p){?>
							<form method="post" action="<?php echo base_url('inipanel/pemilih_edit_aksi')?>">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
									value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" name="id" value="<?=encrypt_url($p->pemilih_id)."";?>">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Nama</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="nama" value="<?= $p->pemilih_nama;?>"
											required>
									</div>
									<?php echo form_error('nama');?>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Kelas</label>
									<div class="col-sm-9">
										<select class="form-control" name="kelas">
											<option>Kelas</option>
                                 <?php 
                                 $kelas = $this->db->query("SELECT * FROM kelas")->result();
                                 foreach($kelas as $k) {?>
                                    <option <?php if($p->pemilih_kelas == $k->kelas_id){echo "selected='selected'";} ?>
                                       value="<?= $k->kelas_id;?>"><?= $k->kelas_nama;?></option>
                                 <?php } ?>
										</select>
									</div>
									<?php echo form_error('kelas');?>
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

		</div> <!-- container-fluid -->

	</div> <!-- content -->
