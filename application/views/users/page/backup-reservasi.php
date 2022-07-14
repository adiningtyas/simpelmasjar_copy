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
						<h4 class="mb-sm-0">Reservasi</h4>

						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
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
									<button type="button" class="btn btn-warning" onclick="get_data()"><i class="las la-server"></i> Get Data</button>
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

	<!-- RESERVASI Modal -->
	<div class="modal fade" id="reservasi_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
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
									<input type="hidden" class="form-control" id="id_edit" name="id_edit">
									<select class="form-control" name="id_rr" id="id_rr" required>
										<option value="" selected disabled>Ruang Rapat</option>
										<?php
										foreach($data_rr as $val){?>
											<option value="<?= $val->id;?>" <?=$data_reservasi[0]->id == $val->id ? ' selected="selected"' : '';?>><?= $val->nama_rr;?></option>;
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
									<button type="button" class="btn btn-success" onclick="save_rr()"><i class="las la-save"></i> Simpan</button>
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="las la-times"></i> Batal</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div><!--end modal-content-->
		</div><!--end modal-dialog-->
	</div><!--end modal-->

	<?php $this->load->view('users/layout/new-footer'); ?>
	<script>
		var id_ruang_rapat = <?php echo $data_reservasi = $data_reservasi[0]->id ?? 0;?>;
		var url_load_event = '<?= site_url('ReservasiCon/loadReservasi')?>/'+id_ruang_rapat;

		$(document).ready(function(){
			
			$("#tanggal_rapat").flatpickr({
				locale:'id',
				disableMobile: "true"
			});
			$("#jam_mulai").flatpickr({
				locale:'id',
				enableTime: true,
				noCalendar: true,
				dateFormat: "H:i",
				time_24hr: true,
				disableMobile: "true"
			});
			$("#jam_selesai").flatpickr({
				locale:'id',
				enableTime: true,
				noCalendar: true,
				dateFormat: "H:i",
				time_24hr: true,
				disableMobile: "true"
			});

			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				navLinks: true,
				events: {
					url: url_load_event,
					method: 'POST',
					success : function (data)
					{
						console.log(data);
					},
					failure: function() {
						alert('Error load data Rapat');
					}
				},
				headerToolbar: {
					left  : 'prev,next',
					center: 'title',
					right : 'dayGridMonth,timeGridDay'
				},
				locale: 'id',
				themeSystem: 'bootstrap',
				editable  : true,
				dateClick: function(info) {
					calendar.changeView('timeGridDay', info.dateStr);					
				}
			});
			calendar.render();
			calendar.on('dateClick', function(info) {
				if (info.view.type=='timeGridDay'){
					var tanggal = new Date(info.dateStr).toISOString().split('T')[0];
					var jam_convert = new Date(info.dateStr).toString().split(' ')[4];
					jam_mulai = jam_convert.split(':')[0]+':'+jam_convert.split(':')[1];
					console.log(jam_mulai);
					$('#tanggal_rapat').val(tanggal);
					$('#jam_mulai').val(jam_mulai);
					$('#reservasi_modal').modal('show');
				}
				else {
					console.log('Bukan TimeGridDay');
				}
			});
		});

		

		function save_rr(){
			var id_rr = $("#reservasi_modal").find("select[name='id_rr']").val();
			var judul_rapat = $("#reservasi_modal").find("input[name='judul_rapat']").val();
			var tanggal_rapat = $("#reservasi_modal").find("input[name='tanggal_rapat']").val();
			var jam_mulai = $("#reservasi_modal").find("input[name='jam_mulai']").val();
			var jam_selesai = $("#reservasi_modal").find("input[name='jam_selesai']").val();
			var keterangan = $("#reservasi_modal").find("textarea[name='keterangan']").val();
			var file = $("#reservasi_modal").find("input[name='file']")[0].files[0];

			// console.log(id_rr+'---'+tanggal_rapat+'---'+jam_mulai+'---'+jam_selesai+'---'+keterangan);

			if(id_rr == "" || judul_rapat == "" || tanggal_rapat == "" || keterangan == "" || jam_mulai == "" || jam_selesai == "")
			{
				toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
			}
			else {
				var form_data = new FormData();
				form_data.append('id_rr', id_rr);
				form_data.append('judul_rapat', judul_rapat);
				form_data.append('tanggal_rapat', tanggal_rapat);
				form_data.append('jam_mulai', jam_mulai);
				form_data.append('jam_selesai', jam_selesai);
				form_data.append('keterangan', keterangan);
				form_data.append('file', file);

				$.ajax({
					dataType: 'json',
					type:'POST',
					url: '<?= site_url('ReservasiCon/insertData')?>',
					cache: false,
					contentType: false,
					processData: false,
					data:form_data,
					beforeSend: function () { 
						$("#progress").show();
						$("#tombol").hide();
					},
					success : function (data, status)
					{
						if(data.status != 'error')
						{
							$("#reservasi_modal").find("input[name='tanggal_rapat']").val('');
							$("#reservasi_modal").find("input[name='jam_mulai']").val('');
							$("#reservasi_modal").find("input[name='jam_selesai']").val(''); 
							$("#reservasi_modal").find("textarea[name='keterangan']").val('');
							$("#reservasi_modal").find("input[name='file']").val(''); 
							$(".modal").modal('hide');
							location.reload();
							toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
							toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
						}
						else{
							toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
						}
					},
					complete: function () { 
						$("#progress").hide();
						$("#tombol").show();
					}
				})
			}

		}

		function get_data(){
			console.log(url_load_event);
			// var form_data = new FormData();
			// $.ajax({
			// 	dataType: 'json',
			// 	type:'POST',
			// 	url: '<?= site_url('ReservasiCon/loadReservasi')?>/'+id,
			// 	cache: false,
			// 	contentType: false,
			// 	processData: false,
			// 	data:form_data,
			// 	success : function (data)
			// 	{
			// 		return data;
			// 	}
			// })
		}

	</script>