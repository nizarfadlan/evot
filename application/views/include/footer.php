<?php $p = $this->db->get('pengaturan')->row();?>
            	<footer class="footer">
            		Copyright© <?php echo date('Y');?> <?=$p->pengaturan_nama?> - <span>
            			Made with
            			<i class="mdi mdi-heart text-danger"></i> by Nizar</span>.
            	</footer>

            	</div>


            	<!-- ============================================================== -->
            	<!-- End Right content here -->
            	<!-- ============================================================== -->


            	</div>
            	<!-- END wrapper -->
            	<!-- jQuery  -->
            	<script src="<?= base_url();?>assets/js/jquery.min.js"></script>
            	<script src="<?= base_url();?>assets/js/bootstrap.bundle.min.js"></script>
            	<script src="<?= base_url();?>assets/js/metisMenu.min.js"></script>
            	<script src="<?= base_url();?>assets/js/jquery.slimscroll.js"></script>
            	<script src="<?= base_url();?>assets/js/waves.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
            	<!-- App js -->
            	<script src="<?= base_url();?>assets/js/app.js"></script>
					<script src="<?= base_url();?>assets/plugins/sweet-alert2/sweetalert2.all.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/sweet-alert2/myscript.js"></script>>

					<!-- Required datatable js -->
					<script src="<?= base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
					<!-- Buttons examples -->
					<script src="<?= base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/jszip.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/pdfmake.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/vfs_fonts.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/buttons.html5.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/buttons.print.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/buttons.colVis.min.js"></script>
					<!-- Responsive examples -->
					<script src="<?= base_url();?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
					<script src="<?= base_url();?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

					<!-- Datatable init js -->
					<script src="<?= base_url();?>assets/pages/datatables.init.js"></script>

					<!-- Plugins Init js -->
        			<script src="<?= base_url();?>assets/pages/form-advanced.js"></script>
					<script src="<?= base_url();?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
					<script src="<?= base_url();?>assets/ckeditor/ckeditor.js"></script>
					<script src="<?= base_url();?>assets/ckeditor/adapters/jquery.js"></script>
					<script>
						$(function(){
							CKEDITOR.replace('editor')
						});
					</script>
					<script>
						$(function(){
							CKEDITOR.replace('editor1')
						});
					</script>

					<!-- chart -->
        			<script src="<?= base_url();?>assets/plugins/chart.js/chart.min.js"></script>
					<script>

					!function($) {
						"use strict";

						var ChartJs = function() {};

						ChartJs.prototype.respChart = function(selector,type,data, options) {
							// get selector by context
							var ctx = selector.get(0).getContext("2d");
							// pointing parent container to make chart js inherit its width
							var container = $(selector).parent();

							// enable resizing matter
							$(window).resize( generateChart );

							// this function produce the responsive Chart JS
							function generateChart(){
									// make chart width fit with its container
									var ww = selector.attr('width', $(container).width() );
									switch(type){
										case 'Line':
											new Chart(ctx, {type: 'line', data: data, options: options});
											break;
										case 'Doughnut':
											new Chart(ctx, {type: 'doughnut', data: data, options: options});
											break;
										case 'Pie':
											new Chart(ctx, {type: 'pie', data: data, options: options});
											break;
										case 'Bar':
											new Chart(ctx, {type: 'bar', data: data, options: options});
											break;
										case 'Radar':
											new Chart(ctx, {type: 'radar', data: data, options: options});
											break;
										case 'PolarArea':
											new Chart(ctx, {data: data, type: 'polarArea', options: options});
											break;
									}
									// Initiate new chart or Redraw

							};
							// run function - render chart at first load
							generateChart();
						},
						//init
						ChartJs.prototype.init = function() {
							//donut chart
							var donutChart = {
									labels: [
										"Belum Memilih",
										"Sudah Memilih",
										"Jumlah Pemilih"
									],
									datasets: [
										{
											data: [<?=$belum_memilih;?>, <?=$sudah_memilih;?>, <?=$jumlah_pemilih;?>],
											backgroundColor: [
													"#ebeff2",
													"#f4a90d",
													"#6a5db6"
											],
											hoverBackgroundColor: [
													"#ebeff2",
													"#f4a90d",
													"#6a5db6"
											],
											hoverBorderColor: "#fff"
										}]
							};
							this.respChart($("#doughnut"),'Doughnut',donutChart);
						},
						$.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

					}(window.jQuery),

					//initializing
					function($) {
						"use strict";
						$.ChartJs.init()
					}(window.jQuery);

					</script>
            	</body>

            	</html>
