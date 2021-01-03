<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars text-secondary"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" data-toggle="dropdown">
          <i class="fas fa-search fa-fw text-secondary"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in">
          <form class="navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" style="border-color: #3f51b5;">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
          <i class="fas fa-bell fa-fw text-secondary"></i>
          <span class="badge badge-danger badge-counter">3+</span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
          <h6 class="dropdown-header">
            Alerts Center
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-primary">
                <i class="fas fa-file-alt text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 12, 2019</div>
              <span class="font-weight-bold">A new monthly report is ready to download!</span>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-success">
                <i class="fas fa-donate text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 7, 2019</div>
              $290.29 has been deposited into your account!
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-warning">
                <i class="fas fa-exclamation-triangle text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 2, 2019</div>
              Spending Alert: We've noticed unusually high spending for your account.
            </div>
          </a>
          <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
          <i class="fas fa-envelope fa-fw text-secondary"></i>
          <span class="badge badge-warning badge-counter">2</span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
          <h6 class="dropdown-header">
            Message Center
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="<?=base_url('assets/backend/') ?>img/man.png" style="max-width: 60px" alt="">
              <div class="status-indicator bg-success"></div>
            </div>
            <div class="font-weight-bold">
              <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                having.</div>
              <div class="small text-gray-500">Udin Cilok · 58m</div>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="<?=base_url('assets/backend/') ?>img/girl.png" style="max-width: 60px" alt="">
              <div class="status-indicator bg-default"></div>
            </div>
            <div>
              <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                say this to all dogs, even if they aren't good...</div>
              <div class="small text-gray-500">Jaenab · 2w</div>
            </div>
          </a>
          <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
          <i class="fas fa-tasks fa-fw text-secondary"></i>
          <span class="badge badge-success badge-counter">3</span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
          <h6 class="dropdown-header">
            Task
          </h6>
          <a class="dropdown-item align-items-center" href="#">
            <div class="mb-3">
              <div class="small text-gray-500">Design Button
                <div class="small float-right"><b>50%</b></div>
              </div>
              <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%"></div>
              </div>
            </div>
          </a>
          <a class="dropdown-item align-items-center" href="#">
            <div class="mb-3">
              <div class="small text-gray-500">Make Beautiful Transitions
                <div class="small float-right"><b>30%</b></div>
              </div>
              <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"></div>
              </div>
            </div>
          </a>
          <a class="dropdown-item align-items-center" href="#">
            <div class="mb-3">
              <div class="small text-gray-500">Create Pie Chart
                <div class="small float-right"><b>75%</b></div>
              </div>
              <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"></div>
              </div>
            </div>
          </a>
          <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
        </div>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$user['fullname'] ?></span>          
          <?php $avatar = $this->db->get_where('user_profile', array('user_id' => $user['id']))->row('avatar'); ?>
          <img class="img-profile rounded-circle" src="<?=base_url('assets') ?>/backend/img/profile/<?=$avatar?>">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
          <?php $link = 'administrador/user' ?>
          <a class="dropdown-item" href="<?=site_url($link) ?>">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          <?php if($this->session->userdata('role_id') == 1) : ?>
          <a class="dropdown-item" href="<?=site_url('administrador/setting') ?>">
            <i class="fas fa-tools fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
          </a>
          <?php endif ?>
          <a class="dropdown-item" target="_blank" href="">
            <i class="fas fa-fw fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Lihat Website
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>
  </nav>
  <!-- End of Topbar -->