<?php $this->load->view('users/layout/new-header'); ?>
<?php $this->load->view('users/layout/new-navbar'); ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
	<div class="page-content">
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">

				<div class="col-12">
					<div class="page-title-box d-sm-flex align-items-center justify-content-between">
						<h4 class="mb-sm-0">Reservasi</h4><h4 class="mb-sm-0" style="color:#7084C7;"><?php echo $data_reservasi[0]->nama_rr = $data_reservasi[0]->nama_rr ?? "";?></h4>

						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
								<li class="breadcrumb-item active">Reservasi</li>
							</ol>
						</div>

					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-lg-12">
					<div class="">
						<div class="card-body">
							
							<div class="row">
								<div class="col-lg-12">

									<!-- <button type="button" class="btn btn-warning" onclick="get_data()"><i class="las la-server"></i> Get Data</button> -->
									<div id='calendar'></div>

								</div>
							</div>
							<!-- end row -->
						</div>
						<!-- ene card body -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

		</div>
		<!-- container-fluid -->

	</div>
	<!-- End Page-content -->
	<?php $this->load->view('users/page/modal/modal_reservasi'); ?>
	<?php $this->load->view('users/layout/new-footer'); ?>
	<?php $this->load->view('users/page/service_js/js_reservasi'); ?>
	