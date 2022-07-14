<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover"
    data-layout-mode="dark">

<head>

    <meta charset="utf-8" />
    <title>SIMPELMASJAR | Kab.Nganjuk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url()?>ruangrapat-assets/assets/images/log.png">

    <!-- fullcalendar css -->
    <link href="<?= base_url()?>ruangrapat-assets/assets/libs/fullcalendar/main.min.css" rel="stylesheet"
        type="text/css" />

    <!-- jsvectormap css -->
    <link href="<?= base_url()?>ruangrapat-assets/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="<?= base_url()?>ruangrapat-assets/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet"
        type="text/css" />

    <!-- glightbox css -->
    <link rel="stylesheet" href="<?= base_url()?>ruangrapat-assets/assets/libs/glightbox/css/glightbox.min.css">

    <!-- Layout config Js -->
    <script src="<?= base_url()?>ruangrapat-assets/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url()?>ruangrapat-assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url()?>ruangrapat-assets/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url()?>ruangrapat-assets/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url()?>ruangrapat-assets/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- jquery confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <!--toaster-->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Sweet Alert css-->
    <link href="<?= base_url()?>ruangrapat-assets/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    <script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
        integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- dropzone css -->
    <link rel="stylesheet" href="<?= base_url()?>ruangrapat-assets/assets/libs/dropzone/dropzone.css" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt=""
                                        height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt=""
                                        height="17">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt=""
                                        height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt=""
                                        height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-md-block" style="display: none !important;">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                                    id="search-options" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex align-items-center">

                        <!-- ////////////// SENG BUAT NAMA USER ////////////////////////// -->
                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button" class="btn btn-soft-secondary"
                                id="btn-nonaktif"><?php echo $this->session->userdata('name');?></button>
                            <!-- <?php if($this->session->userdata('role')==1){?>
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class='bx bx-bell fs-22'></i>
								<span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3 <span class="visually-hidden">unread messages</span>
							</span>
						</button>
					<?php }?> -->
                        </div>
                        <!-- ////////////////// END NAMA USER /////////////////////////// -->

                        <div class="dropdown d-md-none topbar-head-dropdown header-item" style="display:none;">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..."
                                                aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                        src="<?= base_url()?>ruangrapat-assets/assets/images/users/user-dummy-img.jpg"
                                        alt="Header Avatar">
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Selamat Datang</h6>
                                <a class="dropdown-item" href="<?php echo site_url('auth/auth/logout'); ?>">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout">Logout</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>