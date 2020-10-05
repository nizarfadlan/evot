<!DOCTYPE html>
<html lang="en">
<?php
$id_user = $this->session->userdata('id');
$user = $this->db->query("select * from pengurus where pengguna_id='$id_user'")->row();
$p = $this->db->get('pengaturan')->row();?>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title><?php echo $judul; ?></title>
	<link rel="shortcut icon" href="<?= base_url();?>gambar/pengaturan/<?=$p->pengaturan_logo?>">
	<link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url();?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
	
	<!-- DataTables -->
	<link href="<?= base_url();?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url();?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<!-- Responsive datatable examples -->
	<link href="<?= base_url();?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<!-- Begin page -->
	<div id="wrapper">
		<!-- Top Bar Start -->
		<div class="topbar">

			<!-- LOGO -->
			<div class="topbar-left">
				<a href="#" class="logo">
					<span>
						<img src="<?= base_url();?>gambar/pengaturan/<?=$p->logo_panjang?>" alt="" height="30">
					</span>
					<i>
						<img src="<?= base_url();?>gambar/pengaturan/<?=$p->pengaturan_logo?>" alt="" height="30">
					</i>
				</a>
			</div>

			<nav class="navbar-custom">


				<ul class="navbar-right d-flex list-inline float-right mb-0">

					<li class="dropdown notification-list">
						<div class="dropdown notification-list nav-pro-img">
							<a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown"
								href="#" role="button" aria-haspopup="false" aria-expanded="false">
								<img src="<?php echo base_url().'/gambar/pengguna/default.jpg'?>"
									alt="<?php echo $user->pengguna_username; ?>" class="rounded-circle">
							</a>
							<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
								<!-- item-->
								<a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
								<a class="dropdown-item d-block" href="#"><i class="mdi mdi-settings m-r-5"></i>
									Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="<?= base_url();?>inipanel/keluar"><i
										class="mdi mdi-power text-danger"></i>
									Keluar</a>
							</div>
						</div>
					</li>

				</ul>

				<ul class="list-inline menu-left mb-0">
					<li class="float-left">
						<button class="button-menu-mobile open-left waves-effect">
							<i class="mdi mdi-menu"></i>
						</button>
					</li>
				</ul>

			</nav>

		</div>
		<!-- Top Bar End -->
