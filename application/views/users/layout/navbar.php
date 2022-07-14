  <!-- Main Sidebar Container -->
  <?php
  $get_data = $this->db->get('kontak')->row();
  ?>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url();?>admin" class="brand-link">
      <img src="<?php echo base_url();?>assets/img/log.png" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-family: 'Philosopher'"><?php echo @$get_data->nama_opd; ?></span><span style="font-family: 'Baloo Tamma'; font-size: 75%;"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item has-treeview menu-open">
            <a href="<?= base_url();?>admin" class="nav-link <?php echo $this->uri->segment(2)=='' ? 'active':'';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <?php if($this->session->userdata('role')==1) { ?>
            <li class="nav-item has-treeview menusamping">
              <a href="#" class="nav-link">
                <i class="fas fa-file-signature"></i>
                <p>
                  Capaian Kinerja Makro
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview menusamping">

                <li class="nav-item menusamping">
                  <a href="<?php echo base_url(); ?>admin/susun-ckm-makro" class="nav-link <?php echo $this->uri->segment(2)=='susun-ckm-makro' ? 'active':'';?>">
                    <i class="fas fa-file-invoice"></i>
                    <p>Susun CKM</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item has-treeview menusamping">
              <a href="#" class="nav-link">
                <i class="fas fa-highlighter"></i>
                <p>
                  IKK Fungsi Penunjang
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview menusamping">

                <li class="nav-item menusamping">
                  <a href="<?php echo base_url(); ?>admin/susun-ikk" class="nav-link <?php echo $this->uri->segment(2)=='susun-ikk' ? 'active':'';?>">
                    <i class="fas fa-file-invoice"></i>
                    <p>Susun IKK Fungsi Penunjang</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item has-treeview menusamping">
              <a href="#" class="nav-link">
                <i class="fas fa-marker"></i>
                <p>
                  IKK Outcome & Output
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview menusamping">

                <li class="nav-item menusamping">
                  <a href="<?php echo base_url(); ?>admin/susun-ikk" class="nav-link <?php echo $this->uri->segment(2)=='susun-ikk' ? 'active':'';?>">
                    <i class="fas fa-file-invoice"></i>
                    <p>Susun IKK Outcome/Output</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item has-treeview menusamping">
              <a href="#" class="nav-link">
                <i class="fas fa-book"></i>
                <p>
                  Softcopy Buku LPPD 
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview menusamping">

                <li class="nav-item menusamping">
                  <a href="<?php echo base_url(); ?>admin/susun-ikk" class="nav-link <?php echo $this->uri->segment(2)=='susun-ikk' ? 'active':'';?>">
                    <i class="fas fa-file-invoice"></i>
                    <p>Susun Softcopy LPPD</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item has-treeview menusamping">
              <a href="#" class="nav-link">
                <i class="fas fa-subscript"></i>
                <p>
                  Bank Rumus
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview menusamping">

                <li class="nav-item menusamping">
                  <a href="<?php echo base_url(); ?>admin/rumus" class="nav-link <?php echo $this->uri->segment(2)=='rumus' ? 'active':'';?>">
                    <i class="fas fa-square-root-alt"></i>
                    <p>Susun Rumus</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item menusamping">
              <a href="<?php echo base_url(); ?>admin/kontak" class="nav-link <?php echo $this->uri->segment(2)=='kontak' ? 'active':'';?>">
               <i class="fas fa-address-book"></i>
               <p>
                Kontak
              </p>
            </a>
          </li>
        <?php } ?>

        <?php if($this->session->userdata('role')==2) { ?>
          <li class="nav-item has-treeview menusamping">
            <a href="#" class="nav-link">
              <i class="fas fa-highlighter"></i>
              <p>
                IKK 3.1
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview menusamping">

              <li class="nav-item menusamping">
                <a href="<?php echo base_url(); ?>admin/lengkapi-ikk31" class="nav-link <?php echo $this->uri->segment(2)=='lengkapi-ikk' ? 'active':'';?>">
                  <i class="fas fa-user-shield"></i>
                  <p>Lengkapi IKK 3.1</p>
                </a>
              </li>

            </ul>
          </li>
        <?php } ?>
        
      </ul>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>