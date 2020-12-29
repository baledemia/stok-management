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

  <?php $role_id = $this->session->userdata('role_id');

    $queryMenu = "SELECT menu.id, menu.menu_name
      FROM menu JOIN user_access_menu
      ON menu.id = user_access_menu.menu_id
      WHERE user_access_menu.role_id = $role_id
      ORDER BY menu.numrow ASC";

    $menus = $this->db->query($queryMenu)->result_array() ?>

  <!-- Heading -->
  <?php foreach($menus as $menu) : ?>
    <div class="sidebar-heading">
      <?=$menu['menu_name'] ?>
    </div>

    <!-- Sub Menu -->
    <?php $menu_id = $menu['id'];
    $querySubMenu = "SELECT *
        FROM submenu
        WHERE menu_id = $menu_id 
        AND active = 1";

    $submenus = $this->db->query($querySubMenu)->result_array(); ?>

    <?php foreach($submenus as $submenu) : ?>
      <li class="nav-item <?=($title == $submenu['title'] ? 'active' : '') ?>">
        
        <?php $link = $submenu['url']; ?>

        <a class="nav-link" href="<?=site_url($link) ?>">
          <i class="<?=$submenu['icon'] ?>"></i>
          <span><?=$submenu['title'] ?></span></a>
      </li>
    <?php endforeach ?>
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
  <?php endforeach ?>

  <!-- <li class="nav-item">
    <a class="nav-link" href="index.html">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
  </li>
  
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Data Master
  </div>
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
      aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="far fa-fw fa-window-maximize"></i>
      <span>Material</span>
    </a>
    <div id="collapseBootstrap" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?=site_url('administrador/category') ?>">Raw Material</a>
        <a class="collapse-item" href="<?=site_url('administrador/machine') ?>">Machine</a>
        <a class="collapse-item" href="<?=site_url('administrador/type_kawat') ?>">Wire Type</a>
      </div>
    </div>
  </li>
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterGeneral"
      aria-expanded="true" aria-controls="collapseMasterCable">
      <i class="fas fa-table"></i>
      <span>Data General</span>
    </a>
    <div id="collapseMasterGeneral" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?=site_url('administrador/supplier') ?>">Supplier</a>
        <a class="collapse-item" href="<?=site_url('administrador/color') ?>">Color</a>
        <a class="collapse-item" href="<?=site_url('administrador/size') ?>">Size</a>
        <a class="collapse-item" href="<?=site_url('administrador/warehouse') ?>">Warehouse</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterCable"
      aria-expanded="true" aria-controls="collapseMasterCable">
      <i class="fas fa-ethernet"></i>
      <span>Master Cable</span>
    </a>
    <div id="collapseMasterCable" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?=site_url('administrador/type') ?>">Type</a>
        <a class="collapse-item" href="<?=site_url('administrador/cable') ?>">Local Cable</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImportCable"
      aria-expanded="true" aria-controls="collapseImportCable">
      <i class="fas fa-file-import"></i>
      <span>Master Import Cable</span>
    </a>
    <div id="collapseImportCable" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?=site_url('administrador/merk') ?>">Merk</a>
        <a class="collapse-item" href="<?=site_url('administrador/cable-import') ?>">Import Cable</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    User Management
  </div>

  <li class="nav-item">
    <a class="nav-link" href="<?=site_url('administrador/admin/role') ?>">
    <i class="fas fa-users-cog"></i>
    <span>Role</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?=site_url('administrador/user') ?>">
      <i class="far fa-user"></i>
      <span>User</span></a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Menu Management
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
    Order
  </div>

  <li class="nav-item">
    <a class="nav-link" href="<?=site_url('administrador/order-stok') ?>">
    <i class="fas fa-fw fa-book-open"></i>
    <span>Transaksi Baru</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?=site_url('administrador/material-stok') ?>">
    <i class="fas fa-fw fa-hdd"></i>
    <span>Laporan Material</span></a>
  </li> -->

  <hr class="sidebar-divider">
  <li class="nav-item">
    <?php $logout = 'administrador/auth/logout' ?>
    <a class="nav-link" href="<?=site_url($logout) ?>">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <div class="version" id="version-ruangadmin"></div>
</ul>