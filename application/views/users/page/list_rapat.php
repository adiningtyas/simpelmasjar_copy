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
						<h4 class="mb-sm-0">Agenda Rapat</h4>

						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
								<li class="breadcrumb-item active">Agenda Rapat</li>
							</ol>
						</div>

					</div>
				</div>
			</div>
			<!-- end page title -->

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="d-grid gap-2 mb-4">
							<a href="<?= base_url();?>admin/list-rapat-belom-acc" class="btn btn-warning btn-animation waves-effect waves-light mt-2"><i class="ri-error-warning-line"></i> Klik Disini Untuk List Rapat Yang Belum Approve</a>
							<div class="flex-grow-1">
								<span class="fw-medium">Keterangan :</span>
							</div>
							<div class="flex-grow-1">
								<i class="mdi mdi-checkbox-blank-circle me-2 text-success"></i>
								<span class="fw-medium">Reservasi Sudah Disetujui</span>
							</div>
							<div class="flex-grow-1">
								<i class="mdi mdi-checkbox-blank-circle me-2 text-danger"></i>
								<span class="fw-medium">Reservasi Belum Disetujui</span>
							</div>
						</div>
						<div class="col-xl-6">
							<div> <!-- ////////////////// RAPAT YANG AKAN DATANG /////////////// -->
								<h5 class="mb-1">Rapat Yang Akan Datang</h5>
								<p class="text-muted">Jadwal Rapat Yang Akan Berlangsung</p>
								<div class="pe-2 me-n1 mb-3" >
									<div id="upcoming-event-list">

										<table id="rapat_akan_datang" class="" style="width:100%">
											<thead>
												<tr>
													<th style="width: 100%; border: none !important;"></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$count=0; 
												foreach ($data_akan_datang as $val) { 
													$count=$count+1;
													if($val->isActive==0){
														$warna_status="danger";
														$tombol='<button type="button" class="btn btn-soft-success" id="btn-aktivasi" onclick="aktivasi_rapat('.$val->id.')"><i class="ri-check-double-line align-bottom"></i> Aktifkan</button>';
													}else{
														$warna_status="success";
														$tombol='<button type="button" class="btn btn-soft-warning" id="btn-nonaktif" onclick="aktivasi_rapat('.$val->id.')"><i class="ri-close-circle-line align-bottom"></i> Non-Aktifkan</button>';
													}
													?>
													<tr><td>
														<div class="card mb-3">
															<div class="card-body">
																<div class="d-flex mb-3">
																	<div class="flex-grow-1">
																		<i class="mdi mdi-checkbox-blank-circle me-2 text-<?= $warna_status;?>"></i>
																		<span class="fw-medium"><?= tanggalIndo($val->tanggal_rapat);?></span>
																	</div>
																	<div class="flex-shrink-0">
																		<small class="badge badge-soft-<?= $warna_status;?> ms-auto"><?= date("H:i", strtotime($val->jam_mulai))?> to <?= date("H:i", strtotime($val->jam_selesai))?></small>
																		<a href="#" class="btn btn-sm btn-soft-primary" onclick="edit_rapat(<?=$val->id;?>,<?= $val->id_rr;?>)"><i class="ri-edit-2-line align-bottom"></i> Edit</a>
																	</div>
																</div>
																<div class="flex-shrink-0 me-3">
																	<i class="ri-user-line me-2 text-muted"></i><span class="fw-medium"><?=help_singk_dinas($val->id_user);?></span>
																</div>
																<div class="flex-shrink-0 me-3">
																	<i class="ri-map-pin-line me-2 text-muted"></i><span class="fw-medium"><?=help_rr($val->id_rr);?></span>
																</div>
																<div class="flex-shrink-0 me-3">
																	<i class="ri-pen-nib-line me-2 text-muted"></i><span class="fw-medium"><?=$val->judul_rapat;?></span>
																</div>
																<div class="hstack gap-2 justify-content-end">
																	<button type="button" class="btn btn-soft-danger" id="btn-delete-event" onclick="delete_rapat(<?=$val->id;?>)"><i class="ri-delete-bin-2-line align-bottom"></i> Hapus</button>
																	<?php if($this->session->userdata('role')==1) 
																	{
																		echo $tombol;
																	}
																	?>
																</div>

																<p class="text-muted text-truncate-two-lines mb-0"></p>
															</div>
														</div>
													</td></tr>
												<?php } ?>
											</tbody>
										</table>
										
									</div>
								</div>
							</div>

						</div> <!-- end col-->

						<div class="col-xl-6">
							<div> <!-- ////////////////// RAPAT YANG SUDAH TERLAKSANA /////////////// -->
								<h5 class="mb-1">Rapat Yang Sudah Terlaksana</h5>
								<p class="text-muted">Jadwal Rapat Yang Sudah Terlaksana</p>
								<div class="pe-2 me-n1 mb-3" >
									<div id="upcoming-event-list">

										<table id="rapat_terlaksana" class="" style="width:100%">
											<thead>
												<tr>
													<th style="width: 100%; border: none !important;"></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$count=0; 
												foreach ($data_terlaksana as $val) { 
													$count=$count+1;
													if($val->isActive==0){
														$warna_status="danger";
														$tombol='<button type="button" class="btn btn-soft-success" id="btn-aktivasi" onclick="aktivasi_rapat('.$val->id.')"><i class="ri-check-double-line align-bottom"></i> Aktifkan</button>';
													}else{
														$warna_status="success";
														$tombol='<button type="button" class="btn btn-soft-warning" id="btn-nonaktif" onclick="aktivasi_rapat('.$val->id.')"><i class="ri-close-circle-line align-bottom"></i> Non-Aktifkan</button>';
													}
													?>
													<tr><td>
														<div class="card mb-3">
															<div class="card-body">
																<div class="d-flex mb-3">
																	<div class="flex-grow-1">
																		<i class="mdi mdi-checkbox-blank-circle me-2 text-<?= $warna_status;?>"></i>
																		<span class="fw-medium"><?= tanggalIndo($val->tanggal_rapat);?></span>
																	</div>
																	<div class="flex-shrink-0">
																		<small class="badge badge-soft-<?= $warna_status;?> ms-auto"><?= date("H:i", strtotime($val->jam_mulai))?> to <?= date("H:i", strtotime($val->jam_selesai))?></small>
																		<a href="#" class="btn btn-sm btn-soft-primary" onclick="edit_rapat(<?=$val->id;?>,<?= $val->id_rr;?>)"><i class="ri-edit-2-line align-bottom"></i> Edit</a>
																	</div>
																</div>
																<div class="flex-shrink-0 me-3">
																	<i class="ri-user-line me-2 text-muted"></i><span class="fw-medium"><?=help_singk_dinas($val->id_user);?></span>
																</div>
																<div class="flex-shrink-0 me-3">
																	<i class="ri-map-pin-line me-2 text-muted"></i><span class="fw-medium"><?=help_rr($val->id_rr);?></span>
																</div>
																<div class="flex-shrink-0 me-3">
																	<i class="ri-pen-nib-line me-2 text-muted"></i><span class="fw-medium"><?=$val->judul_rapat;?></span>
																</div>
																<div class="hstack gap-2 justify-content-end">
																	<button type="button" class="btn btn-soft-danger" id="btn-delete-event" onclick="delete_rapat(<?=$val->id;?>)"><i class="ri-delete-bin-2-line align-bottom"></i> Hapus</button>
																	<?php if($this->session->userdata('role')==1) 
																	{
																		echo $tombol;
																	}
																	?>
																</div>

																<p class="text-muted text-truncate-two-lines mb-0"></p>
															</div>
														</div>
													</td></tr>
												<?php } ?>
											</tbody>
										</table>
										

									</div>
								</div>
							</div>
						</div><!-- end col -->
					</div><!--end row-->

					<div style='clear:both'></div>

				</div>
			</div> <!-- end row-->

		</div>
		<!-- container-fluid -->
	</div>
	<!-- End Page-content -->
	<!-- End Page-content -->
	<?php $this->load->view('users/page/modal/modal_reservasi'); ?>
	<?php $this->load->view('users/layout/new-footer'); ?>
	<?php $this->load->view('users/page/service_js/js_list'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#rapat_akan_datang').DataTable({
				"bInfo" : false,
				"bLengthChange": false,
				"drawCallback": function( settings ) {
					$("#rapat_akan_datang thead").remove(); },
					"ordering":false,
					"language": {
						"search": "<button type='submit' class='btn btn-info btn-sm' style='background:#3FBBC0; border:none; padding: 8.3px 10px !important; position:relative; bottom:1; left:6'><i class='mdi mdi-magnify search-widget-icon'></i></button>",
						"searchPlaceholder": "Pencarian",
						"paginate": {
							"previous": "<",
							"next":">"
						}
					}
				});
			$('#rapat_terlaksana').DataTable({
				"bInfo" : false,
				"bLengthChange": false,
				"drawCallback": function( settings ) {
					$("#rapat_terlaksana thead").remove(); },
					"ordering":false,
					"language": {
						"search": "<button type='submit' class='btn btn-info btn-sm' style='background:#3FBBC0; border:none; padding: 8.3px 10px !important; position:relative; bottom:1; left:6'><i class='mdi mdi-magnify search-widget-icon'></i></button>",
						"searchPlaceholder": "Pencarian",
						"paginate": {
							"previous": "<",
							"next":">"
						}
					}
				});
		} );
	</script>