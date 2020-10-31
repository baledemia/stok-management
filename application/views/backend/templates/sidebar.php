<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" 
    href="<?=site_url('administrador/admin') ?>">
    <div class="sidebar-brand-icon">
      <img src="<?=base_url('assets/backend/') ?>img/boy.png">
    </div>
    <div class="sidebar-brand-text mx-3">PT. Sukses Setia</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item">
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
      <span>Bahan Material</span>
    </a>
    <div id="collapseBootstrap" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="">CU</a>
        <a class="collapse-item" href="">PVC</a>
      </div>
    </div>
  </li>

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