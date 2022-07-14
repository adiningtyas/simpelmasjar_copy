<script>
	var id_ruang_rapat = <?php echo $data_reservasi[0]->id = $data_reservasi[0]->id ?? 0;?>;
	var url_load_event = '<?= site_url('ReservasiCon/loadReservasi')?>/'+id_ruang_rapat;
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+'/';

	$(document).ready(function(){

		$('#reservasi_modal').on('hidden.bs.modal', function () {
			$("#reservasi_modal").find("input[name='indikator']").val('');
		})
		$('#detail_modal').on('hidden.bs.modal', function () {
			$("#detail_modal").find("a[id='status_rapat']").removeClass();
			$("#detail_modal").find("button[id='btn-aktivasi']").hide();
			$("#detail_modal").find("button[id='btn-nonaktif']").hide();
			$("#detail_modal").find("button[id='btn-delete-event']").off('click');
			$("#detail_modal").find("a[id='edit-event-btn']").off('click');
			$("#detail_modal").find("a[id='event-file']").text('Download File');
			$("#detail_modal").find("a[id='event-file']").removeAttr("href");
			$("#detail_modal").find("a[id='event-cp']").text('Belum Ada CP');
			$("#detail_modal").find("a[id='event-cp']").removeAttr("href");
		})

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

			////////////////////////////////////// INISIASI CALENDER

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
				eventClick: function(info) {
					event_klik(info);
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
					var tanggal_rapat = new Date(info.dateStr).toISOString().split('T')[0];
					var jam_convert = new Date(info.dateStr).toString().split(' ')[4];
					jam_mulai = jam_convert.split(':')[0]+':'+jam_convert.split(':')[1];
					
					$('#tanggal_rapat').val(tanggal_rapat);
					$('#jam_mulai').val(jam_mulai);
					$("#reservasi_modal").find("select[name='id_rr']").val(id_ruang_rapat);
					$('#reservasi_modal').modal('show');
				}
				else {
					console.log('Bukan TimeGridDay');
				}
			});

			//////////////////////////////////// FUNGSI UNTUK LOAD DETAIL EVENT

			function event_klik(info) {
				var val = info.event.extendedProps;
				var link_cp = "https://api.whatsapp.com/send?phone="+val.contact_person+"&text=Assalamualaikum";
				
				if(<?= $this->session->userdata('role')?> ==1 || val.id_user==<?= $this->session->userdata('userid')?>){
					console.log('user asli dan admin');
					$("#detail_modal").find("a[id='edit-event-btn']").show();
					$("#detail_modal").find("button[id='btn-delete-event']").show();
					$("#detail_modal").find("a[id='edit-event-btn']").click(function(){ edit_rapat(val); });
					$("#detail_modal").find("button[id='btn-delete-event']").click(function(){ delete_rapat(val); });
				}else{
					console.log('Bukan User Aslinya');
					$("#detail_modal").find("a[id='edit-event-btn']").hide();
					$("#detail_modal").find("button[id='btn-delete-event']").hide();
				}
				
				$("#detail_modal").find("h5[id='modal-title']").text(val.judul_rapat);
				$("#detail_modal").find("a[id='event-cp']").text(val.contact_person);
				$("#detail_modal").find("a[id='event-cp']").attr("href", link_cp);
				$("#detail_modal").find("h6[id='event-start-date-tag']").text(val.tanggal_rapat);
				$("#detail_modal").find("span[id='event-user']").text(val.nama_user);
				$("#detail_modal").find("span[id='event-timepicker1-tag']").text(val.jam_mulai);
				$("#detail_modal").find("span[id='event-timepicker2-tag']").text(val.jam_selesai);
				$("#detail_modal").find("span[id='event-location-tag']").text(val.nama_rr);
				if (val.filepath == null || val.filepath==""){
					$("#detail_modal").find("a[id='event-file']").text('Belum Upload File');
				}else{
					$("#detail_modal").find("a[id='event-file']").attr("href", baseUrl+val.filepath);
				}
				if (val.isActive == 0){
					$("#detail_modal").find("a[id='status_rapat']").addClass("btn btn-sm btn-soft-danger");
					$("#detail_modal").find("a[id='status_rapat']").text("Status Reservasi : Non-Aktif");
					$("#detail_modal").find("button[id='btn-aktivasi']").click(function(){ aktivasi_rapat(val); });
					$("#detail_modal").find("button[id='btn-aktivasi']").show();
				}else{
					$("#detail_modal").find("a[id='status_rapat']").addClass("btn btn-sm btn-soft-success");
					$("#detail_modal").find("a[id='status_rapat']").text("Status Reservasi : Aktif");
					$("#detail_modal").find("button[id='btn-nonaktif']").click(function(){ aktivasi_rapat(val); });
					$("#detail_modal").find("button[id='btn-nonaktif']").show();
				}
				$("#detail_modal").find("p[id='event-description-tag']").text(val.keterangan);

				$('#detail_modal').modal('show');

			}

		});


		/////////////////////////////////// FUNGSI UNTUK SAVE DATA RAPAT

		function save_rapat(){
			var indikator = $("#reservasi_modal").find("input[name='indikator']").val();
			var id_edit = $("#reservasi_modal").find("input[name='id_edit']").val();
			var id_rr = $("#reservasi_modal").find("select[name='id_rr']").val();
			var judul_rapat = $("#reservasi_modal").find("input[name='judul_rapat']").val();
			var contact_person = $("#reservasi_modal").find("input[name='contact_person']").val();
			var tanggal_rapat = $("#reservasi_modal").find("input[name='tanggal_rapat']").val();
			var jam_mulai = $("#reservasi_modal").find("input[name='jam_mulai']").val();
			var jam_selesai = $("#reservasi_modal").find("input[name='jam_selesai']").val();
			var keterangan = $("#reservasi_modal").find("textarea[name='keterangan']").val();
			var file = $("#reservasi_modal").find("input[name='file']")[0].files[0];

			console.log(indikator);

			if(indikator==69){
				url='<?= site_url('ReservasiCon/editData')?>';
			}
			else{
				url='<?= site_url('ReservasiCon/insertData')?>';
			}

			if(id_rr == "" || contact_person=="" || judul_rapat == "" || tanggal_rapat == "" || keterangan == "" || jam_mulai == "" || jam_selesai == "")
			{
				toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
			}
			else {
				var form_data = new FormData();
				form_data.append('id_edit', id_edit);
				form_data.append('id_rr', id_rr);
				form_data.append('judul_rapat', judul_rapat);
				form_data.append('contact_person', contact_person);
				form_data.append('tanggal_rapat', tanggal_rapat);
				form_data.append('jam_mulai', jam_mulai);
				form_data.append('jam_selesai', jam_selesai);
				form_data.append('keterangan', keterangan);
				form_data.append('file', file);

				$.ajax({
					dataType: 'json',
					type:'POST',
					url: url,
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
							$("#reservasi_modal").find("input[name='indikator']").val('');
							$("#reservasi_modal").find("input[name='id_edit']").val('');
							$("#reservasi_modal").find("input[name='tanggal_rapat']").val('');
							$("#reservasi_modal").find("input[name='judul_rapat']").val('');
							$("#reservasi_modal").find("input[name='contact_person']").val('');
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

		/////////////////// EDIT RAPAT

		function edit_rapat(val){
			$("#detail_modal").find("button[id='btn-delete-event']").off('click');
			$("#detail_modal").find("a[id='edit-event-btn']").off('click');
			$("#detail_modal").modal('hide');
			$("#reservasi_modal").find("input[name='indikator']").val(69);
			$("#reservasi_modal").find("input[name='id_edit']").val(val.id_reservasi);
			$("#reservasi_modal").find("select[id='id_rr']").val(val.id_rr);
			$("#reservasi_modal").find("input[name='judul_rapat']").val(val.judul_rapat);
			$("#reservasi_modal").find("input[name='contact_person']").val(val.contact_person);
			$("#reservasi_modal").find("input[name='tanggal_rapat']").val(val.tanggal_rapat_asli);
			$("#reservasi_modal").find("input[name='jam_mulai']").val(val.jam_mulai);
			$("#reservasi_modal").find("input[name='jam_selesai']").val(val.jam_selesai); 
			$("#reservasi_modal").find("textarea[name='keterangan']").val(val.keterangan);
			$('#reservasi_modal').modal('show');
		}

		function delete_rapat(val){
			var judul_rapat = val.judul_rapat;
			var id = val.id_reservasi;
			Swal.fire({
				title: 'Hapus Data',
				text: "Yakin Untuk Menghapus Permanen Rapat : "+judul_rapat,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Hapus!',
				cancelButtonText: 'Batal',
				showCloseButton: true,
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						dataType: 'json',
						type:'POST',
						url: '<?= site_url('ReservasiCon/delete/')?>'+id,
						data: { id:id },
						success: function(response) {
							Swal.fire({
								title: "Berhasil!",
								text: "Data Berhasil Dihapus",
								icon: "success",
								confirmButtonClass: "btn btn-primary w-xs mt-2",
								buttonsStyling: !1
							}).then(function(){
								window.location.reload();
							});
						},
						failure: function (response) {
							Swal.fire({
								title: "Gagal!",
								text: "Gagal Menghapus Data",
								icon: "warning",
								confirmButtonClass: "btn btn-primary w-xs mt-2",
								buttonsStyling: !1
							}).then(function(){
								window.location.reload();
							});
						}
					});
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
					) {
					Swal.fire(
						'Dibatalkan',
						'Batal Menghapus Data :)',
						'error'
						)
				}
			})
		}

		function aktivasi_rapat(val){
			console.log(val);
			var judul_rapat = val.judul_rapat;
			var id = val.id_reservasi;
			if(val.isActive==0){
				var text_alert = "Apakah Anda Yakin Aktifkan Rapat : ";
				var value_aktif = 1;
			}else{
				var text_alert = "Apakah Anda Yakin Non-Aktifkan Rapat : ";
				var value_aktif = 0;
			}
			Swal.fire({
				title: 'Hapus Data',
				text: text_alert+judul_rapat,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Update!',
				cancelButtonText: 'Batal',
				showCloseButton: true,
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						dataType: 'json',
						type:'POST',
						url: '<?= site_url('ReservasiCon/aktivasi/')?>'+id,
						data: {
							id:id,
							isActive:value_aktif
						},
						success: function(response) {
							Swal.fire({
								title: "Berhasil!",
								text: "Data Berhasil Diupdate",
								icon: "success",
								confirmButtonClass: "btn btn-primary w-xs mt-2",
								buttonsStyling: !1
							}).then(function(){
								window.location.reload();
							});
						},
						failure: function (response) {
							Swal.fire({
								title: "Gagal!",
								text: "Gagal Update Data",
								icon: "warning",
								confirmButtonClass: "btn btn-primary w-xs mt-2",
								buttonsStyling: !1
							}).then(function(){
								window.location.reload();
							});
						}
					});
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
					) {
					Swal.fire(
						'Dibatalkan',
						'Batal Menghapus Data :)',
						'error'
						)
				}
			})
		}

		// function cek_rapat(){
		// 	var id_edit = $("#reservasi_modal").find("input[name='id_edit']").val();
		// 	var id_rr = $("#reservasi_modal").find("select[name='id_rr']").val();
		// 	var judul_rapat = $("#reservasi_modal").find("input[name='judul_rapat']").val();
		// 	var tanggal_rapat = $("#reservasi_modal").find("input[name='tanggal_rapat']").val();
		// 	var jam_mulai = $("#reservasi_modal").find("input[name='jam_mulai']").val();
		// 	var jam_selesai = $("#reservasi_modal").find("input[name='jam_selesai']").val();
		// 	var keterangan = $("#reservasi_modal").find("textarea[name='keterangan']").val();

		// 	var form_data = new FormData();
		// 	form_data.append('id_edit', id_edit);
		// 	form_data.append('id_rr', id_rr);
		// 	form_data.append('judul_rapat', judul_rapat);
		// 	form_data.append('tanggal_rapat', tanggal_rapat);
		// 	form_data.append('jam_mulai', jam_mulai);
		// 	form_data.append('jam_selesai', jam_selesai);
		// 	form_data.append('keterangan', keterangan);

		// 	$.ajax({
		// 		dataType: 'json',
		// 		type:'POST',
		// 		url: '<?= site_url('ReservasiCon/cek_rapat')?>',
		// 		cache: false,
		// 		contentType: false,
		// 		processData: false,
		// 		data:form_data,
		// 		success : function (data)
		// 		{
		// 			if(data.status != 'error')
		// 			{
		// 				console.log(data);
		// 			}
		// 			else{
		// 				toastr.error(data, 'Error Alert', {timeOut: 5000});
		// 			}
		// 		}
		// 	})
		// }

	</script>