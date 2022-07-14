  <!-- ========== App Menu ========== -->
  <div class="app-menu navbar-menu">
  	<!-- LOGO -->
  	<div class="navbar-brand-box">
  		<!-- Dark Logo-->
  		<a href="#" class="logo logo-dark">
  			<span class="logo-sm">
  				<img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt="" height="22">
  			</span>
  			<span class="logo-lg">
  				<img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt="" height="37"> KABUPATEN NGANJUK
  			</span>
  		</a>
  		<!-- Light Logo-->
  		<a href="#" class="logo logo-light">
  			<span class="logo-sm">
  				<img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt="" height="22">
  			</span>
  			<span class="logo-lg">
  				<img src="<?= base_url()?>ruangrapat-assets/assets/images/log.png" alt="" height="37"> KABUPATEN NGANJUK
  			</span>
  		</a>
  		<button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
  			<i class="ri-record-circle-line"></i>
  		</button>
  	</div>

  	<div id="scrollbar">
  		<div class="container-fluid">
  			
  			<div id="two-column-menu">
  			</div>
  			<ul class="navbar-nav" id="navbar-nav">
  				<li class="menu-title"><span data-key="t-menu">Menu</span></li>
  				<li class="nav-item">
  					<a class="nav-link menu-link" href="<?= base_url();?>admin">
  						<i class="lab la-laravel"></i> <span data-key="t-landing">Reservasi</span>
  					</a>
  				</li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?= base_url();?>admin/pengajuan">
                        <i class="lab la-accusoft"></i> <span data-key="t-landing">Pengajuan Proposal</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link menu-link" href="<?= base_url();?>admin/list-rapat">
                        <i class="lab la-accusoft"></i> <span data-key="t-landing">List Rapat</span>
                    </a>
                </li>
                <?php if ($this->session->userdata('role')==1) { ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?= base_url();?>admin/master-rr">
                            <i class="las la-house-damage"></i> <span data-key="t-landing">Ruang Rapat</span>
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>