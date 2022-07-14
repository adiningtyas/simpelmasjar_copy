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
                        <h4 class="mb-sm-0">Ruang Rapat</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Ruang Rapat</li>
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

                                    <div class="row gallery-wrapper">

                                        <?php
                                        foreach ($list_rr as $val) { ?>
                                            <!-- ---------- TEMPAT FOREACH GAMBAR --------------- -->
                                            <div class="element-item col-xxl-3 col-xl-4 col-sm-6" >
                                                <div class="gallery-box card">
                                                    <div class="gallery-container">
                                                        <a class="image-popup" href="<?= base_url();?>admin/reservasi/<?= $val->id;?>" title="">
                                                            <img class="gallery-img img-fluid mx-auto" src="<?= base_url().$val->filepath;?>" alt="" />
                                                            <div class="gallery-overlay">
                                                                <h5 class="overlay-caption"><?= $val->nama_rr;?></h5>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="box-content">
                                                        <div class="d-flex align-items-center mt-1">
                                                            <div class="flex-grow-1 text-muted"><a href="" class="text-body text-truncate"><?= $val->nama_rr;?></a></div>
                                                            <div class="flex-shrink-0">
                                                                <div class="d-flex gap-3">
                                                                    <button type="button" class="btn btn-sm btn-success btn-animation waves-effect waves-light" title="Deskripsi" 
                                                                    onclick="detail_foto(<?= $val->id;?>)"><i class="las la-atom"></i> Fasilitas</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <!-- -------------- END FOREACH --------------------- -->
                                        <?php }?>

                                    </div>
                                    <!-- end row -->

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

    <!-- Gambar Modal -->
    <div class="modal fade" id="modal_gambar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="myModalLabel">Fasilitas Ruang Rapat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <img id="gambar" src="" style="width: 100%; padding-right: 2rem; padding-bottom: 2rem">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="designation" class="form-label">FASILITAS :</label>
                            <span class="text-body text-truncate" id="deskripsi" name="deskripsi"></span>
                        </div>
                    </div>
                </div>
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->

    <?php $this->load->view('users/layout/new-footer'); ?>

    <script type="text/javascript">
        function detail_foto(id){
            var url_gambar="";
            var getUrl = window.location;
            var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
            $.ajax({
                dataType: 'json',
                url: 'admin/master-rr/ambil-data-by-id/'+id,
                success: function ( data) {
                    url_gambar=baseUrl+'/'+data.data[0].filepath;
                    deskripsi = data.data[0].deskripsi_rr;
                    $("#modal_gambar").find("#gambar").attr("src", url_gambar);
                    $("#modal_gambar").find("#deskripsi").html(deskripsi);
                    $('#modal_gambar').modal('show');
                },
                error: function ( data ) {
                    console.log('error');
                }
            });
        }
    </script>
