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
						<h4 class="mb-sm-0">Master Ruang Rapat</h4>

						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
								<li class="breadcrumb-item active">Master RR</li>
							</ol>
						</div>

					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-header align-items-center d-flex">
							<!-- <?php print("<pre>".print_r($data_rr,true)."</pre>");?> -->
							<h4 class="card-title mb-0 flex-grow-1">Data Master Ruang Rapat</h4>
							<div class="flex-shrink-0">
								<button class="btn btn-success btn-animation waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addmembers"><i class="ri-add-fill me-1 align-bottom"></i> Tambah</button>
							</div>
						</div><!-- end card header -->  

						<div class="card-body">
							<div class="live-preview">
								<div class="table-responsive">
									<table class="table table-striped table-nowrap align-middle mb-0">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Nama RR</th>
												<th scope="col">Fasilitas</th>
												<th scope="col">Foto/Gambar</th>
												<th scope="col">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count=0; 
											foreach ($data_rr as $val) { 
												$count=$count+1;
												?>
												<tr>
													<td style="width: 5%; vertical-align"><?php echo $count; ?></td>
													<td style="width: 20%; vertical-align"><?php echo $val->nama_rr; ?></td>
													<td style="width: 20%; vertical-align"><?php echo $val->deskripsi_rr; ?></td>
													<td style="width: 20%; vertical-align"><?php echo '<button type="button" class="btn btn-warning btn-animation waves-effect waves-light" title="Foto" onclick="detail_foto('."'".$val->id."'".')"><i class="las la-photo-video"></i></button> &nbsp;' ?></td>
													<td style="width: 10%; vertical-align"><?php echo '<button type="button" class="btn btn-info btn-animation waves-effect waves-light" title="Edit" onclick="update('."'".$val->id."'".')"><i class="las la-pen-fancy"></i></button> &nbsp;'.'<button type="button" class="btn btn-danger btn-animation waves-effect waves-light" title="Hapus" onclick="hapus('."'".$val->id."'".')"><i class="las la-trash"></i></button> &nbsp;'; ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
									<!-- end table -->
								</div>
								<!-- end table responsive -->
							</div>
						</div><!-- end card-body -->
					</div><!-- end card -->
				</div><!-- end col -->
			</div><!--end row-->

		</div>
		<!-- container-fluid -->
	</div>
	<!-- End Page-content -->
	<!-- End Page-content -->

	<!-- Save Modal -->
	<div class="modal fade" id="addmembers" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content border-0">
				<div class="modal-header p-3 bg-soft-info">
					<h5 class="modal-title" id="myModalLabel">Form Ruang Rapat</h5>
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
									<input type="text" class="form-control" id="nama_rr" name="nama_rr" placeholder="Nama Ruang Rapat">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="mb-3">
									<label for="designation" class="form-label">Deskripsi</label>
									<textarea name="deskripsi_rr" id="deskripsi_rr" rows="10" cols="80"></textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="mb-4">
									<label for="formFile" class="form-label">Upload Foto</label>
									<input class="form-control" type="file" id="file" name="file">
								</div>
							</div>
							<div class="col-lg-12">
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

	<!-- Gambar Modal -->
	<div class="modal fade" id="modal_gambar" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0">
				<div class="modal-header p-3 bg-soft-info">
					<h5 class="modal-title" id="myModalLabel">Detail Foto/Gambar</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="col-lg-12">
						<div class="mb-3">
							<img id="gambar" src="" style="width: 100%; padding-right: 2rem; padding-bottom: 2rem">
						</div>
					</div>
				</div>
			</div><!--end modal-content-->
		</div><!--end modal-dialog-->
	</div><!--end modal-->

	<?php $this->load->view('users/layout/new-footer'); ?>

	<script type="text/javascript">
		CKEDITOR.replace( 'deskripsi_rr' ); // inisiasi deskripsi/fasilitas

		$('#addmembers').on('hidden.bs.modal', function () {
			$("#addmembers").find("input[name='indikator']").val('');
		})

		function save_rr(){
			var indikator = $("#addmembers").find("input[name='indikator']").val();
			var id = $("#addmembers").find("input[name='id_edit']").val();
			var nama_rr = $("#addmembers").find("input[name='nama_rr']").val();
			var deskripsi_rr = CKEDITOR.instances.deskripsi_rr.getData();
			var file_gambar = $("#addmembers").find("input[name='file']")[0].files[0];
			var url='';

			if(indikator==69){
				url='master-rr/edit-data/'+id;
			}
			else{
				url='master-rr/insert-data';
			}


			if(nama_rr == "" || deskripsi_rr == "")
			{
				toastr.error('Harap Isi Semua Kolom', 'Error Alert', {timeOut: 5000});
			}
			else {
				var form_data = new FormData();
				form_data.append('id', id);
				form_data.append('nama_rr', nama_rr);
				form_data.append('deskripsi_rr', deskripsi_rr);
				form_data.append('file_gambar', file_gambar);

				$.ajax({
					dataType: 'json',
					type:'POST',
					url: url,
					cache: false,
					contentType: false,
					processData: false,
					data:form_data,
					success : function (data, status)
					{
						if(data.status != 'error')
						{
							$("#addmembers").find("input[name='id_edit']").val('');
							$("#addmembers").find("input[name='nama_rr']").val('');
							$("#addmembers").find("input[name='deskripsi_rr']").val(''); 
							$(".modal").modal('hide');
							location.reload();
							toastr.success(data.msg, 'Success Alert', {timeOut: 5000});
							toastr.success('Data Berhasil Disimpan', 'Success Alert', {timeOut: 5000});
						}
						else{
							toastr.error(data.msg, 'Error Alert', {timeOut: 5000});
						}
					},
				})
			}
		}

		function update(id){
			$.ajax({
				dataType: 'json',
				url: 'master-rr/ambil-data-by-id/'+id,
				success: function ( data) {
					console.log(data);
					$("#addmembers").find("input[name='indikator']").val(69);
					$("#addmembers").find("input[name='id_edit']").val(data.data[0].id);
					$("#addmembers").find("input[name='nama_rr']").val(data.data[0].nama_rr);
					CKEDITOR.instances.deskripsi_rr.setData(data.data[0].deskripsi_rr);
					$('#addmembers').modal('show');
				},
				error: function ( data ) {
					console.log('error');
				}
			});
		}

		function hapus(id){

			$.ajax({
				dataType: 'json',
				url: 'master-rr/ambil-data-by-id/'+id,
				success: function ( data) {
					var nama_rr = data.data[0].nama_rr;
					Swal.fire({
						title: 'Hapus Data',
						text: "Apakah Anda Yakin Untuk Menghapus : "+nama_rr,
						icon: 'warning',
						showCancelButton: true,
						confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
						cancelButtonClass: "btn btn-danger w-xs mt-2",
						confirmButtonText: 'Hapus!',
						cancelButtonText: 'Batal',
						showCloseButton: true,
						reverseButtons: true
					}).then((result) => {
						if (result.isConfirmed) {
							$.ajax({
								dataType: 'json',
								type:'POST',
								url: 'master-rr/remove/'+id,
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

		function detail_foto(id){
			var url_gambar="";
			var getUrl = window.location;
			var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
			$.ajax({
				dataType: 'json',
				url: 'master-rr/ambil-data-by-id/'+id,
				success: function ( data) {
					url_gambar=baseUrl+'/'+data.data[0].filepath;
					$("#modal_gambar").find("#gambar").attr("src", url_gambar);
					$('#modal_gambar').modal('show');
					console.log(url_gambar);
				},
				error: function ( data ) {
					console.log('error');
				}
			});
		}
	</script>