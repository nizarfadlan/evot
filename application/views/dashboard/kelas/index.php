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
						<h4 class="page-title">Kelas</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Dashboard</li>
							<li class="breadcrumb-item active">Kelas</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- end row -->
			<div class="row">
				<div class="col-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h4 class="mt-0 header-title">Kelas<a href="<?php echo base_url().'inipanel/kelas_tambah/';?>"
												class="btn btn-sm btn-primary waves-effect waves-light rounded float-right"><i class="ti-plus"></i></a></h4>
							<p class="text-muted m-b-30">managemen kelas E-Vot.</p>
							<!-- Table -->
							<table id="datatable" class="table table-bordered dt-responsive nowrap"
								style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead>
									<tr>
										<th>No</th>
                              <th>Kelas</th>
                              <th>Jumlah Siswa</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; foreach($kelas as $k){ ?>
									<tr>
										<td><?php echo $no++;?></td>
                              <td><?php echo $k->kelas_nama;?></td>
                              <td>
                                 <?php $this->db->like('pemilih_kelas', $k->kelas_id); $this->db->from('pemilih'); $jumlah = $this->db->count_all_results();?>
                                 <?= $jumlah;?>
                              </td>
										<td>
                                 <a href="<?php echo base_url().'inipanel/kelas_edit/'.encrypt_url($k->kelas_id)."";?>"
												class="btn btn-sm btn-warning waves-effect waves-light"><i
                                       class="ti-pencil"></i></a>
                                 <a href="<?php echo base_url().'inipanel/kelas_hapus/'.encrypt_url($k->kelas_id)."";?>"
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
