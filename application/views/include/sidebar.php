            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
            	<div class="slimscroll-menu" id="remove-scroll">

            		<!--- Sidemenu -->
            		<div id="sidebar-menu">
            			<!-- Left Menu Start -->
            			<ul class="metismenu" id="side-menu">
            				<li class="menu-title">Main</li>
            				<li>
            					<a href="<?= base_url();?>inipanel" class=" waves-effect">
            						<i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
            					</a>
            				</li>
            				<li>
            					<a href="<?= base_url();?>inipanel/suara" class="waves-effect"><i class="mdi mdi-chart-line"></i><span>
            							Suara </span></a>
								</li>
								
            				<li>
            					<a href="<?= base_url();?>inipanel/kelas" class="waves-effect"><i class="mdi mdi-google-circles"></i><span>
            							Kelas </span></a>
            				</li>

            				<li>
            					<a href="javascript:void(0);" class="waves-effect"><i
            							class="mdi mdi-account-multiple"></i><span> Account <span class="float-right menu-arrow"><i
            									class="mdi mdi-chevron-right"></i></span> </span></a>
            					<ul class="submenu">
										<?php if($this->session->userdata('level') == "admin"){?>
            							<li><a href="<?= base_url();?>inipanel/pengurus">Pengurus</a></li>
										<?php } ?>
                              <li><a href="<?= base_url();?>inipanel/pemilih">Pemilih</a></li>
            						<li><a href="<?= base_url();?>inipanel/calon">Calon</a></li>
                           </ul>
                        </li>
								<li class="menu-title">Action</li>
								<?php if($this->session->userdata('level') == "admin"){?>
								<li>
            					<a href="<?= base_url();?>inipanel/setting" class="waves-effect"><i class="mdi mdi-settings m-r-5"></i><span>
            							Settings </span></a>
            				</li>
								<?php }?>
								<li>
            					<a href="<?= base_url();?>inipanel/keluar" class="waves-effect"><i class="mdi mdi-power text-danger"></i><span class="text-danger">
            							Keluar </span></a>
            				</li>
            			</ul>

            		</div>
            		<!-- Sidebar -->
            		<div class=" clearfix">
            		</div>

            	</div>
            	<!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
