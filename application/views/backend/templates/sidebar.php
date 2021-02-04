<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" 
    href="<?=site_url('administrador/admin') ?>">
    <div class="sidebar-brand-icon">
      <img src="<?=base_url('assets/backend/') ?>img/boy.png">
    </div>
    <div class="sidebar-brand-text mx-3">PT. Sukses Setia</div>
  </a>

  <hr class="sidebar-divider mt-0">

  <?php #$role_id = $this->session->userdata('role_id');

    /*$queryMenu = "SELECT user_menu.id, user_menu.menu_name
      FROM user_menu JOIN user_access_menu
      ON user_menu.id = user_access_menu.menu_id
      WHERE user_access_menu.role_id = $role_id
      ORDER BY user_menu.numrow ASC";*/

    #$menus = $this->db->query($queryMenu)->result_array() ?>

  <!-- Heading -->
  <?php #foreach($menus as $menu) : ?>
    <div class="sidebar-heading">
      <?php #$menu['menu_name'] ?>
    </div>

    <!-- Sub Menu -->
    <?php #$menu_id = $menu['id'];
    /*$querySubMenu = "SELECT *
        FROM user_submenu
        WHERE menu_id = $menu_id 
        AND active = 1";*/

    #$submenus = $this->db->query($querySubMenu)->result_array(); ?>

    <?php #foreach($submenus as $submenu) : ?>
      <li class="nav-item <?php#($title == $submenu['title'] ? 'active' : '') ?>">
        
        <?php #$link = $submenu['url']; ?>

        <a class="nav-link" href="<?php#site_url($link) ?>">
          <i class="<?php #$submenu['icon'] ?>"></i>
          <span><?php#$submenu['title'] ?></span></a>
      </li>
    <?php #endforeach ?>
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
  <?php #endforeach ?>

  <li class="nav-item">
    <a class="nav-link" href="index.html">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
  </li>
  
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Master Data 
  </div>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-warehouse"></i>
      <span>Mesin</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="far fa-user"></i>
      <span>Supplier</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-user-friends"></i>
      <span>Customer</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fill"></i>
      <span>Warna</span>
    </a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Bahan Baku
  </div>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-bookmark"></i>
      <span>Kategori Material</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-newspaper"></i>
      <span>Type Kawat</span>
    </a>
  </li>


  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Barang Setengah Jadi
  </div>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Barang Jadi
  </div>
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi">
      <i class="fas fa-table"></i>
      <span>Kabel</span>
    </a>
    <div id="collapseTransaksi" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="#">Gudang</a>
        <a class="collapse-item" href="#">Kantor</a>
        <a class="collapse-item" href="#">Barang Import</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-list-alt"></i>
      <span>Brand (merk)</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-paste"></i>
      <span>Tipe Kabel</span>
    </a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    User Setting
  </div>

  <li class="nav-item">
    <a class="nav-link" href="<?=site_url('administrador/admin/role') ?>">
      <i class="fas fa-user-tag"></i>
      <span>Role</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?=site_url('administrador/user') ?>">
      <i class="far fa-user-circle"></i>
      <span>User</span>
    </a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Menu Setting
  </div>

  <li class="nav-item">
    <a class="nav-link" href="<?=site_url('administrador/menu') ?>">
    <i class="fas fa-fw fa-folder"></i>
      <span>Menu</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
    <i class="fas fa-fw fa-folder-open"></i>
      <span>Sub Menu</span></a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Transaksi
  </div>

  <li class="nav-item">
    <a class="nav-link" href="#">
    <i class="fas fa-fw fa-store"></i>
    <span>Produksi</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
    <i class="fas fa-fw fa-cash-register"></i>
    <span>Purchase Order</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
    <i class="fas fa-fw fa-truck"></i>
    <span>Delivery</span></a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Laporan
  </div>

  <li class="nav-item">
    <a class="nav-link" href="#">
    <i class="fas fa-fw fa-clone"></i>
    <span>Bahan Baku</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
    <i class="fas fa-fw fa-clipboard-check"></i>
    <span>Pembelian</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
    <i class="fas fa-fw fa-chart-bar"></i>
    <span>Penjualan</span></a>
  </li>

  <hr class="sidebar-divider">
  <li class="nav-item">
    <?php $logout = 'administrador/auth/logout' ?>
    <a class="nav-link" href="<?=site_url($logout) ?>">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <div class="version" id="version-ruangadmin"></div>
</ul>