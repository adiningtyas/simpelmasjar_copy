<script type="text/javascript">
	function edit_rapat(id,id_rr){
		$.ajax({
			dataType: 'json',
			url: '<?= site_url('ListRapatCon/getById/')?>'+id,
			success: function ( data) {
				console.log(data.data[0]);
				var jam_mulai=data.data[0].jam_mulai.substring(0,5);
				var jam_selesai=data.data[0].jam_selesai.substring(0,5);
				$("#reservasi_modal").find("input[name='indikator']").val(69);
				$("#reservasi_modal").find("input[name='id_edit']").val(data.data[0].id);
				$("#reservasi_modal").find("select[id='id_rr']").val(id_rr);
				$("#reservasi_modal").find("input[name='judul_rapat']").val(data.data[0].judul_rapat);
				$("#reservasi_modal").find("input[name='tanggal_rapat']").val(data.data[0].tanggal_rapat);
				$("#reservasi_modal").find("input[name='jam_mulai']").val(jam_mulai);
				$("#reservasi_modal").find("input[name='jam_selesai']").val(jam_selesai); 
				$("#reservasi_modal").find("textarea[name='keterangan']").val(data.data[0].keterangan);
				$('#reservasi_modal').modal('show');
			},
			error: function ( data ) {
				console.log('error');
			}
		});
	}

	function save_rapat(){
		var indikator = $("#reservasi_modal").find("input[name='indikator']").val();
		var id_edit = $("#reservasi_modal").find("input[name='id_edit']").val();
		var id_rr = $("#reservasi_modal").find("select[name='id_rr']").val();
		var judul_rapat = $("#reservasi_modal").find("input[name='judul_rapat']").val();
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

		if(id_rr == "" || judul_rapat == "" || tanggal_rapat == "" || keterangan == "" || jam_mulai == "" || jam_selesai == "")
		{
			toastr.error('Woops Something Wrong.', 'Error Alert', {timeOut: 5000});
		}
		else {
			var form_data = new FormData();
			form_data.append('id_edit', id_edit);
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

	function aktivasi_rapat(id){
		$.ajax({
			dataType: 'json',
			url: '<?= site_url('ListRapatCon/getById/')?>'+id,
			success: function ( data) {
				var val=data.data[0];

				var judul_rapat = val.judul_rapat;

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
			},
			error: function ( data ) {
				console.log('error');
			}
		});
	}

	function delete_rapat(id){
		$.ajax({
			dataType: 'json',
			url: '<?= site_url('ListRapatCon/getById/')?>'+id,
			success: function ( data) {
				console.log(data.data[0]);
				var val= data.data[0];
				var judul_rapat = val.judul_rapat;
			
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
			},
			error: function ( data ) {
				console.log('error');
			}
		});
	}
</script>