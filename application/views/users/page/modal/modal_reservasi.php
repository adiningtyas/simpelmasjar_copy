<!-- RESERVASI Modal -->
<div class="modal fade" id="reservasi_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content border-0">
			<div class="modal-header p-3 bg-soft-info">
				<h5 class="modal-title" id="myModalLabel">Form Reservasi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<form id="form_input">
					<div class="row">

						<div class="col-lg-12">
							<div class="mb-3">
								<label for="teammembersName" class="form-label">Nama Ruang Rapat</label>
								<input type="hidden" class="form-control" id="indikator" name="indikator">
								<input type="hidden" class="form-control" id="id_edit" name="id_edit">
								<select class="form-control" name="id_rr" id="id_rr" required>
									<option value="" selected disabled>Ruang Rapat</option>
									<?php
									foreach($data_rr as $val){?>
										<option value="<?= $val->id;?>"><?= $val->nama_rr;?></option>;
									<?php }?>
								</select>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="mb-3">
								<label for="teammembersName" class="form-label">Judul Rapat</label>
								<input type="text" class="form-control" id="judul_rapat" name="judul_rapat" placeholder="Judul Rapat">
							</div>
						</div>

						<div class="col-lg-12"> <!-- +++++++++ CONTACT PERSON +++++++++++ -->
							<div class="mb-3">
								<label for="teammembersName" class="form-label">Contact Person</label>
								<input type="number" class="form-control" id="contact_person" name="contact_person" placeholder="No.Handphone Contact Person">
							</div>
						</div>

						<div class="col-12"> <!-- +++++++++ TANGGAL RAPAT +++++++++++ -->
							<div class="mb-3">
								<label class="form-label">Tanggal Rapat</label>
								<div class="input-group">
									<input type="text" id="tanggal_rapat" name="tanggal_rapat" class="form-control flatpickr flatpickr-input" placeholder="Select date" readonly required> 
									<span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
								</div>
							</div>
						</div><!--end col-->

						<div class="col-12" id="event-time"> <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
							<div class="row">
								<div class="col-6">
									<div class="mb-3">
										<label class="form-label">Mulai</label>
										<div class="input-group">
											<input id="jam_mulai" name="jam_mulai" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select start time" readonly>
											<span class="input-group-text"><i class="ri-time-line"></i></span>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="mb-3">
										<label class="form-label">Selesai</label>
										<div class="input-group">
											<input id="jam_selesai" name="jam_selesai" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select end time" readonly>
											<span class="input-group-text"><i class="ri-time-line"></i></span>
										</div>
									</div>
								</div>
							</div>
						</div><!--end col-->

						<div class="col-lg-12">
							<div class="mb-3">
								<label for="teammembersName" class="form-label">Keterangan</label>
								<textarea name="keterangan" id="keterangan" rows="10" cols="80" class="form-control"></textarea>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="mb-3">
								<label for="formFile" class="form-label">Upload File</label>
								<input class="form-control" type="file" id="file" name="file">
								<div style="margin-top: 1rem; display: none;">
									<a href="" id="link_download" class="btn btn-warning btn-label waves-effect waves-light"><i class=" ri-download-cloud-2-fill label-icon align-middle fs-16 me-2"></i> Download</a>
								</div>
							</div>
						</div>

						<div class="col-lg-12" id="progress" style="display:none">
							<div class="progress animated-progress">
								<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"> Harap Tunggu</div>
							</div>
						</div>

						<div class="col-lg-12" id="tombol">
							<div class="hstack gap-2 justify-content-end">
								<!-- <button type="button" class="btn btn-info" onclick="cek_rapat()"><i class="las la-check-circle"></i> CEK</button> -->
								<button type="button" class="btn btn-success" onclick="save_rapat()"><i class="las la-save"></i> Simpan</button>
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="las la-times"></i> Batal</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div><!--end modal-content-->
	</div><!--end modal-dialog-->
</div><!--end modal-->

<!-- DETAIL Modal -->
<div class="modal fade" id="detail_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content border-0">
			<div class="modal-header p-3 bg-soft-info">
				<h5 class="modal-title" id="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body p-4">
				<form class="needs-validation view-event" name="event-form" id="form-event" novalidate="">
					<div class="text-end">
						<a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event" role="button"><i class="ri-edit-2-line align-bottom"></i> Edit</a>
					</div>
					<div class="event-details">
						<div class="d-flex mb-2">
							<div class="flex-grow-1 d-flex align-items-center">
								<div class="flex-shrink-0 me-3">
									<i class="ri-calendar-event-line text-muted fs-16"></i>
								</div>
								<div class="flex-grow-1">
									<h6 class="d-block fw-semibold mb-0" id="event-start-date-tag"> </h6>
								</div>
								<div class="flex-grow-1">
									<a id="status_rapat"></a>
								</div>
							</div>
						</div>
						<div class="d-flex align-items-center mb-2">
							<div class="flex-shrink-0 me-3">
								<i class="ri-user-line text-muted fs-16"></i>
							</div>
							<div class="flex-grow-1">
								<h6 class="d-block fw-semibold mb-0"> <span id="event-user"></span></h6>
							</div>
						</div>
						<div class="d-flex align-items-center mb-2">
							<div class="flex-shrink-0 me-3">
								<i class="ri-whatsapp-line text-muted fs-16"></i>
							</div>
							<div class="flex-grow-1">
								<h6 class="d-block fw-semibold mb-0"> <a href="" target="_blank" id="event-cp" class="btn btn-sm btn-soft-success"></a></h6>
							</div>
						</div>
						<div class="d-flex align-items-center mb-2">
							<div class="flex-shrink-0 me-3">
								<i class="ri-time-line text-muted fs-16"></i>
							</div>
							<div class="flex-grow-1">
								<h6 class="d-block fw-semibold mb-0"><span id="event-timepicker1-tag"></span> - <span id="event-timepicker2-tag"></span></h6>
							</div>
						</div> 
						<div class="d-flex align-items-center mb-2">
							<div class="flex-shrink-0 me-3">
								<i class="ri-map-pin-line text-muted fs-16"></i>
							</div>
							<div class="flex-grow-1">
								<h6 class="d-block fw-semibold mb-0"> <span id="event-location-tag"></span></h6>
							</div>
						</div>
						<div class="d-flex align-items-center mb-2">
							<div class="flex-shrink-0 me-3">
								<i class="ri-attachment-2 text-muted fs-16"></i>
							</div>
							<div class="flex-grow-1">
								<h6 class="d-block fw-semibold mb-0"> <a href="" target="_blank" id="event-file" class="btn btn-sm btn-soft-info"> Download File </a></h6>
							</div>
						</div>
						<div class="d-flex mb-3">
							<div class="flex-shrink-0 me-3">
								<i class="ri-discuss-line text-muted fs-16"></i>
							</div>
							<div class="flex-grow-1">
								<p class="d-block text-muted mb-0" id="event-description-tag"></p>
							</div>
						</div>
					</div>
					<div class="hstack gap-2 justify-content-end">
						<button type="button" class="btn btn-soft-danger" id="btn-delete-event"><i class="ri-close-line align-bottom"></i> Delete</button>
						<?php if($this->session->userdata('role')==1) { ?>
							<button type="button" class="btn btn-soft-success" id="btn-aktivasi" style="display: none;"><i class="ri-check-double-line align-bottom"></i> Aktifkan</button>
							<button type="button" class="btn btn-soft-warning" id="btn-nonaktif" style="display: none;"><i class="ri-close-circle-line align-bottom"></i> Non-Aktifkan</button>
						<?php } ?>
					</div>
				</form>
			</div>
		</div> <!-- end modal-content-->
	</div> <!-- end modal dialog-->
</div>