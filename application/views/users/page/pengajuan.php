<?php $this->load->view('users/layout/new-header');?>
<?php $this->load->view('users/layout/new-navbar');?>
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
                        <h4 class="mb-sm-0">Pengajuan Izin</h4>
                        <div>
                        <a href="<?= site_url('Word/index')?>" class="btn btn-info btn-animation waves-effect waves-light" title="Download"><i class="las la-print"></i></a>
                        </div>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                                <li class="breadcrumb-item active">Pengajuan Izin</li>
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
                            <!-- <?php print("<pre>" . print_r($data_rr, true) . "</pre>");?> -->
                            <h4 class="card-title mb-0 flex-grow-1">Data Pengajuan Izin</h4>
                            <div class="flex-shrink-0">
                                <button class="btn btn-success btn-animation waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#addmembers"><i
                                        class="ri-add-fill me-1 align-bottom"></i> Tambah</button>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Keperluan</th>
                                                <th scope="col">Tanggal Mulai</th>
                                                <th scope="col">Tanggal Selesai</th>
                                                <th scope="col">Judul Penelitian</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Dokumen</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $count = 0;
                                                foreach ($data_izin as $val) {
                                                $count = $count + 1;
                                            ?>
                                            <tr>
                                                <td style="width: 5%; vertical-align"><?php echo $count; ?></td>
                                                <td style="width: 5%; vertical-align">
                                                    <?php echo help_nama_user($val->id_user); ?></td>
                                                <td style="width: 20%; vertical-align">
                                                    <?php echo help_nama_kategori($val->id_kategori); ?></td>
                                                <td style="width: 20%; vertical-align">
                                                    <?php echo $val->mulai_penelitian; ?></td>
                                                <td style="width: 20%; vertical-align">
                                                    <?php echo $val->selesai_penelitian; ?></td>
                                                <td style="width: 20%; vertical-align">
                                                    <?php echo $val->judul_penelitian; ?>
                                                <td style="width: 20%; vertical-align"><?php echo $val->perihal; ?>
                                                </td>
                                                <td style="width: 20%; vertical-align">
                                                    <?php echo '<button type="button" class="btn btn-warning btn-animation waves-effect waves-light" title="Foto" onclick="detail_foto(' . "'" . $val->id . "'" . ')"><i class="las la-photo-video"></i></button> &nbsp;' ?>
                                                </td>
                                                <td style="width: 10%; vertical-align">
                                                    <?php echo '<button type="button" class="btn btn-info btn-animation waves-effect waves-light" title="Edit" onclick="update(' . "'" . $val->id . "'" . ')"><i class="las la-pen-fancy"></i></button> &nbsp;' . '<button type="button" class="btn btn-danger btn-animation waves-effect waves-light" title="Hapus" onclick="hapus(' . "'" . $val->id . "'" . ')"><i class="las la-trash"></i></button> &nbsp;'; ?>
                                                </td>
                                                <td style="width: 10%; vertical-align">
                                                    <?php echo '<button type="button" class="btn btn-info btn-animation waves-effect waves-light" title="Download" onclick="preview(' . "'" . $val->id . "'" . ')"><i class="las la-print"></i></button> &nbsp;'; ?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                    <!-- end table -->
                                </div>
                                <!-- end table responsive -->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <!--end row-->



        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- End Page-content -->


    <!-- PENGAJUAN IZIN -->
    <div class="modal fade" id="addmembers" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="myModalLabel">Form Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="form_input">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Keperluan</label>
                                    <input type="hidden" class="form-control" id="id_edit" name="id_edit">
                                    <input class="form-control" id="indikator" name="indikator">
                                    <select class="form-control" name="id_kategori" id="id_kategori" required>
                                        <option value="" selected disabled>Kategori</option>
                                        <?php
                                            foreach ($data_kategori as $val) {?>
                                        <option value="<?=$val->id;?>" ;?>
                                            <?=$val->kategori;?></option>;
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Judul Penelitian</label>
                                    <input type="text" class="form-control" id="judul_penelitian"
                                        name="judul_penelitian" placeholder="Judul Penelitian">
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Nama Pejabat</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="nama_pejabat"
                                                name="nama_pejabat" placeholder="Nama Pejabat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">No. Surat</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="no_surat"
                                                name="no_surat" placeholder="Nomor Surat">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Status Pemohon</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="status_pemohon"
                                                name="status_pemohon" placeholder="Status Pemohon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">No. Whatsapp</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="no_wa"
                                                name="no_wa" placeholder="No. Whatsapp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Lokasi Kegiatan</label>
                                    <input type="text" class="form-control" id="lokasi"
                                        name="lokasi" placeholder="Lokasi Kegiatan">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Alamat Pemohon</label>
                                    <input type="text" class="form-control" id="alamat"
                                        name="alamat" placeholder="Alamat Pemohon">
                                </div>
                            </div>

                            
                            <!--
                            <div class="col-12">
                                < +++++++++ TANGGAL RAPAT +++++++++++ -->
                            <!-- <div class="mb-3">
                                    <label class="form-label">Lama Kegiatan</label>
                                    <div class="input-group">
                                        <input type="text" id="tanggal_rapat" name="tanggal_rapat"
                                            class="form-control flatpickr flatpickr-input" placeholder="Select date"
                                            readonly required>
                                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                    </div>
                                </div>
                            </div> -->
                            <!-- end col -->

                            <div class="col-12">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Lama Kegiatan</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="lama_kegiatan"
                                                name="lama_kegiatan" placeholder="Lama Kegiatan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Jumlah Anggota</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="jumlah_anggota"
                                                name="jumlah_anggota" placeholder="Jumlah Anggota">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" id="event-time">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mulai</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="date" id="mulai_penelitian" name="mulai_penelitian"
                                                    class="form-control flatpickr flatpickr-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Selesai</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_selesai" name="jam_selesai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select end time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="date" id="selesai_penelitian" name="selesai_penelitian"
                                                    class="form-control flatpickr flatpickr-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Perihal Surat</label>
                                    <input type="text" class="form-control" id="perihal"
                                        name="perihal" placeholder="Perihal Surat">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Surat Pengantar</label>

                                    <input class="form-control" type="file" id="file" name="file">
                                    <div style="margin-top: 1rem;">
                                        <a href="" id="link_download" target="_blank"
                                            class="btn btn-warning btn-label waves-effect waves-light"><i
                                                class=" ri-download-cloud-2-fill label-icon align-middle fs-16 me-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12" id="progress" style="display:none">
                                <div class="progress animated-progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"> Harap Tunggu</div>
                                </div>
                            </div>

                            <div class="col-lg-12" id="tombol">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-success" onclick="save_pengajuan()"><i
                                            class="las la-save"></i> Simpan</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                            class="las la-times"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end pengajuan izin-->

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
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end modal-->

    <div class="modal fade" id="download" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="myModalLabel">Form Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="form_input">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Keperluan</label>
                                    <input type="hidden" class="form-control" id="id_edit" name="id_edit">
                                    <input class="form-control" id="indikator" name="indikator">
                                    <select class="form-control" name="id_kategori" id="id_kategori" required>
                                        <option value="" selected disabled>Kategori</option>
                                        <?php
                                            foreach ($data_kategori as $val) {?>
                                        <option value="<?=$val->id;?>" ;?>
                                            <?=$val->kategori;?></option>;
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Judul Penelitian</label>
                                    <input type="text" class="form-control" id="judul_penelitian"
                                        name="judul_penelitian" placeholder="Judul Penelitian">
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Nama Pejabat</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="nama_pejabat"
                                                name="nama_pejabat" placeholder="Nama Pejabat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">No. Surat</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="no_surat"
                                                name="no_surat" placeholder="Nomor Surat">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Status Pemohon</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="status_pemohon"
                                                name="status_pemohon" placeholder="Status Pemohon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">No. Whatsapp</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="no_wa"
                                                name="no_wa" placeholder="No. Whatsapp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Lokasi Kegiatan</label>
                                    <input type="text" class="form-control" id="lokasi"
                                        name="lokasi" placeholder="Lokasi Kegiatan">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Alamat Pemohon</label>
                                    <input type="text" class="form-control" id="alamat"
                                        name="alamat" placeholder="Alamat Pemohon">
                                </div>
                            </div>

                            
                            <!--
                            <div class="col-12">
                                < +++++++++ TANGGAL RAPAT +++++++++++ -->
                            <!-- <div class="mb-3">
                                    <label class="form-label">Lama Kegiatan</label>
                                    <div class="input-group">
                                        <input type="text" id="tanggal_rapat" name="tanggal_rapat"
                                            class="form-control flatpickr flatpickr-input" placeholder="Select date"
                                            readonly required>
                                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                    </div>
                                </div>
                            </div> -->
                            <!-- end col -->

                            <div class="col-12">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Lama Kegiatan</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="lama_kegiatan"
                                                name="lama_kegiatan" placeholder="Lama Kegiatan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Jumlah Anggota</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="text" class="form-control" id="jumlah_anggota"
                                                name="jumlah_anggota" placeholder="Jumlah Anggota">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" id="event-time">
                                <!-- ++++++++++ JAM RAPAT +++++++++++++++ -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mulai</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_mulai" name="jam_mulai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select start time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="date" id="mulai_penelitian" name="mulai_penelitian"
                                                    class="form-control flatpickr flatpickr-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Selesai</label>
                                            <div class="input-group">
                                                <!-- <input id="jam_selesai" name="jam_selesai" type="text"
                                                    class="form-control flatpickr flatpickr-input"
                                                    placeholder="Select end time" readonly>
                                                <span class="input-group-text"><i class="ri-time-line"></i></span> -->
                                                <input type="date" id="selesai_penelitian" name="selesai_penelitian"
                                                    class="form-control flatpickr flatpickr-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Perihal Surat</label>
                                    <input type="text" class="form-control" id="perihal"
                                        name="perihal" placeholder="Perihal Surat">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Surat Pengantar</label>

                                    <input class="form-control" type="file" id="file" name="file">
                                    <div style="margin-top: 1rem;">
                                        <a href="" id="link_download" target="_blank"
                                            class="btn btn-warning btn-label waves-effect waves-light"><i
                                                class=" ri-download-cloud-2-fill label-icon align-middle fs-16 me-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12" id="progress" style="display:none">
                                <div class="progress animated-progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"> Harap Tunggu</div>
                                </div>
                            </div>

                            <div class="col-lg-12" id="tombol">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-success" onclick="save_pengajuan()"><i
                                            class="las la-save"></i> Simpan</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                            class="las la-times"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>

    <?php $this->load->view('users/layout/new-footer');?>

    <script type="text/javascript">
    // inisiasi deskripsi/fasilitas
    //memanggil url file gambar di upload_file
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/';

    $('#addmembers').on('hidden.bs.modal', function() {
        $("#addmembers").find("input[name='indikator']").val('');
        $("#addmembers").find("input[name='id_edit']").val('');
        $("#addmembers").find("input[name='judul_penelitian']").val('');
        $("#addmembers").find("input[name='mulai_penelitian']").val('');
        $("#addmembers").find("input[name='selesai_penelitian']").val('');
        $("#addmembers").find("input[name='nama_pejabat']").val('');
        $("#addmembers").find("input[name='no_surat']").val('');
        $("#addmembers").find("input[name='status_pemohon']").val('');
        $("#addmembers").find("input[name='no_wa']").val('');
        $("#addmembers").find("input[name='lokasi']").val('');
        $("#addmembers").find("input[name='alamat']").val('');
        $("#addmembers").find("input[name='lama_kegiatan']").val('');
        $("#addmembers").find("input[name='jumlah_anggota']").val('');
        $("#addmembers").find("input[name='perihal']").val('');
        $("#addmembers").find("select[name='kategori']").val('');
        $("#addmembers").find("input[name='file_gambar']").val('');
        //menambah preview file gambar
        $("#addmembers").find("a[id='link_download']").text('');
        $("#addmembers").find("a[id='link_download']").removeAttr("href");
    })

    function save_pengajuan() {
        var indikator = $("#addmembers").find("input[name='indikator']").val();
        var id = $("#addmembers").find("input[name='id_edit']").val();
        var judul_penelitian = $("#addmembers").find("input[name='judul_penelitian']").val();
        var mulai_penelitian = $("#addmembers").find("input[name='mulai_penelitian']").val();
        var selesai_penelitian = $("#addmembers").find("input[name='selesai_penelitian']").val();
        var nama_pejabat = $("#addmembers").find("input[name='nama_pejabat']").val();
        var no_surat = $("#addmembers").find("input[name='no_surat']").val();
        var status_pemohon = $("#addmembers").find("input[name='status_pemohon']").val();
        var no_wa = $("#addmembers").find("input[name='no_wa']").val();
        var lokasi = $("#addmembers").find("input[name='lokasi']").val();
        var alamat = $("#addmembers").find("input[name='alamat']").val();
        var lama_kegiatan = $("#addmembers").find("input[name='lama_kegiatan']").val();
        var jumlah_anggota = $("#addmembers").find("input[name='jumlah_anggota']").val();
        var kategori = $("#addmembers").find("select[name='id_kategori']").val();
        var perihal = $("#addmembers").find("input[name='perihal']").val();
        var file_gambar = $("#addmembers").find("input[name='file']")[0].files[0];
        var url = '';


        // console.log(judul_penelitian+'--'+mulai_penelitian+'--'+kategori);

        if (indikator == 69) {
            url = 'pengajuan/edit-data/' + id;
        } else {
            url = 'pengajuan/insert-data';
        }


        if (judul_penelitian == "" || perihal == "") {
            toastr.error('Harap Isi Semua Kolom', 'Error Alert', {
                timeOut: 5000
            });
        } else {
            var form_data = new FormData();
            form_data.append('id_edit', id);
            form_data.append('judul_penelitian', judul_penelitian);
            form_data.append('mulai_penelitian', mulai_penelitian);
            form_data.append('selesai_penelitian', selesai_penelitian);
            form_data.append('file_gambar', file_gambar);
            form_data.append('id_kategori', kategori);
            form_data.append('nama_pejabat', nama_pejabat);
            form_data.append('no_surat', no_surat);
            form_data.append('status_pemohon', status_pemohon);
            form_data.append('no_wa', no_wa);
            form_data.append('lokasi', lokasi);
            form_data.append('alamat', alamat);
            form_data.append('lama_kegiatan', lama_kegiatan);
            form_data.append('jumlah_anggota', jumlah_anggota);
            form_data.append('perihal', perihal);

            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data, status) {
                    if (data.status != 'error') {
                        $("#addmembers").find("input[name='id_edit']").val('');
                        $("#addmembers").find("input[name='judul_penelitian']").val('');
                        $("#addmembers").find("input[name='mulai_penelitian']").val('');
                        $("#addmembers").find("input[name='selesai_penelitian']").val('');
                        $("#addmembers").find("select[name='kategori']").val('');
                        $("#addmembers").find("input[name='file_gambar']").val('');
                        $("#addmembers").find("input[name='nama_pejabat']").val('');
                        $("#addmembers").find("input[name='no_surat']").val('');
                        $("#addmembers").find("input[name='status_pemohon']").val('');
                        $("#addmembers").find("input[name='no_wa']").val('');
                        $("#addmembers").find("input[name='lokasi']").val('');
                        $("#addmembers").find("input[name='alamat']").val('');
                        $("#addmembers").find("input[name='lama_kegiatan']").val('');
                        $("#addmembers").find("input[name='jumlah_anggota']").val('');
                        $("#addmembers").find("input[name='perihal']").val('');

                        $(".modal").modal('hide');
                        location.reload();
                        toastr.success(data.msg, 'Success Alert', {
                            timeOut: 5000
                        });
                        toastr.success('Data Berhasil Disimpan', 'Success Alert', {
                            timeOut: 5000
                        });
                    } else {
                        toastr.error(data.msg, 'Error Alert', {
                            timeOut: 5000
                        });
                    }
                },
            })
        }
    }

    function update(id) {
        $.ajax({
            dataType: 'json',
            url: 'pengajuan/ambil-data-by-id/' + id,
            success: function(data) {
                console.log(data);
                var filename = data.data[0].upload_file.split('/').pop();

                $("#addmembers").find("input[name='indikator']").val(69);
                $("#addmembers").find("input[name='id_edit']").val(data.data[0].id);
                $("#addmembers").find("input[name='judul_penelitian']").val(data.data[0].judul_penelitian);
                $("#addmembers").find("input[name='mulai_penelitian']").val(data.data[0].mulai_penelitian);
                $("#addmembers").find("input[name='selesai_penelitian']").val(data.data[0].selesai_penelitian);
                $("#addmembers").find("input[name='nama_pejabat']").val(data.data[0].mulai_penelitian);
                $("#addmembers").find("input[name='no_surat']").val(data.data[0].no_surat);
                $("#addmembers").find("input[name='status_pemohon']").val(data.data[0].status_pemohon);
                $("#addmembers").find("input[name='no_wa']").val(data.data[0].no_wa);
                $("#addmembers").find("input[name='lokasi']").val(data.data[0].lokasi);
                $("#addmembers").find("input[name='alamat']").val(data.data[0].alamat);
                $("#addmembers").find("input[name='lama_kegiatan']").val(data.data[0].lama_kegiatan);
                $("#addmembers").find("input[name='jumlah_anggota']").val(data.data[0].jumlah_anggota);
                $("#addmembers").find("input[name='perihal']").val(data.data[0].perihal);
                $("#addmembers").find("select[name='id_kategori']").val(data.data[0].id_kategori);
                $("#addmembers").find("a[id='link_download']").attr("href", baseUrl + data.data[0].upload_file);
                $("#addmembers").find("a[id='link_download']").text('' + filename);
                $("#addmembers").find("input[name='perihal']").val(data.data[0].perihal);
                $('#addmembers').modal('show');
            },
            error: function(data) {
                console.log('error');
            }
        });
    }

    function preview(id) {
        $.ajax({
            dataType: 'json',
            url: 'pengajuan/ambil-data-by-id/' + id,
            success: function(data) {
                console.log(data);
                var filename = data.data[0].upload_file.split('/').pop();

                $("#download").find("input[name='indikator']").val(69);
                $("#download").find("input[name='id_edit']").val(data.data[0].id);
                $("#download").find("input[name='judul_penelitian']").val(data.data[0].judul_penelitian);
                $("#download").find("input[name='mulai_penelitian']").val(data.data[0].mulai_penelitian);
                $("#download").find("input[name='selesai_penelitian']").val(data.data[0].selesai_penelitian);
                $("#download").find("input[name='nama_pejabat']").val(data.data[0].mulai_penelitian);
                $("#download").find("input[name='no_surat']").val(data.data[0].no_surat);
                $("#download").find("input[name='status_pemohon']").val(data.data[0].status_pemohon);
                $("#download").find("input[name='no_wa']").val(data.data[0].no_wa);
                $("#download").find("input[name='lokasi']").val(data.data[0].lokasi);
                $("#download").find("input[name='alamat']").val(data.data[0].alamat);
                $("#download").find("input[name='lama_kegiatan']").val(data.data[0].lama_kegiatan);
                $("#download").find("input[name='jumlah_anggota']").val(data.data[0].jumlah_anggota);
                $("#download").find("input[name='perihal']").val(data.data[0].perihal);
                $("#download").find("select[name='id_kategori']").val(data.data[0].id_kategori);
                $("#download").find("a[id='link_download']").attr("href", baseUrl + data.data[0].upload_file);
                $("#download").find("a[id='link_download']").text('' + filename);
                $("#download").find("input[name='perihal']").val(data.data[0].perihal);
                $('#download').modal('show');
            },
            error: function(data) {
                console.log('error');
            }
        });
    }

    function hapus(id) {

        $.ajax({
            dataType: 'json',
            url: 'pengajuan/ambil-data-by-id/' + id,
            success: function(data) {
                var judul_penelitian = data.data[0].judul_penelitian;
                Swal.fire({
                    title: 'Hapus Data',
                    text: "Apakah Anda Yakin Untuk Menghapus : " + judul_penelitian,
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
                            type: 'POST',
                            url: 'pengajuan/remove/' + id,
                            data: {
                                id: id
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Data Berhasil Dihapus",
                                    icon: "success",
                                    confirmButtonClass: "btn btn-primary w-xs mt-2",
                                    buttonsStyling: !1
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            failure: function(response) {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: "Gagal Menghapus Data",
                                    icon: "warning",
                                    confirmButtonClass: "btn btn-primary w-xs mt-2",
                                    buttonsStyling: !1
                                }).then(function() {
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
            error: function(data) {
                console.log('error');
            }
        });
    }

    function detail_foto(id) {
        var url_gambar = "";
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
        $.ajax({
            dataType: 'json',
            url: 'pengajuan/ambil-data-by-id/' + id,
            success: function(data) {
                url_gambar = baseUrl + '/' + data.data[0].upload_file;
                $("#modal_gambar").find("#gambar").attr("src", url_gambar);
                $('#modal_gambar').modal('show');
                console.log(url_gambar);
            },
            error: function(data) {
                console.log('error');
            }
        });
    }

    function download(id){
        $.ajax({
            dataType: 'json',
            url: 'pengajuan/download/' + id,
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log('error');
            }
        });
    }
    </script>