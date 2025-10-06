<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Juri Digital AdminLTE 3</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin_template/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin_template/adminlte/dist/css/adminlte.min.css'); ?>">
  
  <style>
/* Style untuk dropdown yang invalid */
.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

/* Style untuk badge skor */
.badge {
    font-size: 0.9em;
    padding: 8px 12px;
}

/* Optional: Style untuk membuat dropdown lebih menarik */
.score-select {
    transition: all 0.3s ease;
}

.score-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Style untuk score display dengan background secondary */
.bg-secondary {
    background-color: #6c757d !important;
    color: white;
}

.bg-secondary .badge {
    background-color: #495057 !important;
    color: white;
}

/* Style untuk user icon di navbar */
.user-icon-navbar {
    width: 25px;
    height: 25px;
    background: #007bff;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    margin-right: 5px;
}

.user-icon-sidebar {
    width: 33px;
    height: 33px;
    background: #007bff;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE): ?>
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <div class="user-icon-navbar">
              <i class="fas fa-user"></i>
            </div>
            <span class="d-none d-md-inline"><?php echo $_SESSION['username']; ?>
            <?php if (isset($_SESSION['roles']) && is_array($_SESSION['roles'])): ?>
                (<?php echo implode(', ', $_SESSION['roles']); ?>)
            <?php endif; ?>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <div class="user-icon-sidebar">
                <i class="fas fa-user fa-2x"></i>
              </div>
              <p>
                <?php echo $_SESSION['username']; ?>
                <small>
                  <?php if (isset($_SESSION['roles']) && is_array($_SESSION['roles'])): ?>
                    <?php echo implode(', ', $_SESSION['roles']); ?>
                  <?php endif; ?>
                </small>
                <small>Member since <?php echo date('M. Y'); ?></small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-4 text-center">
                  <a href="#" class="text-muted">Profile</a>
                </div>
                <div class="col-4 text-center">
                  <a href="#" class="text-muted">Settings</a>
                </div>
                <div class="col-4 text-center">
                  <a href="#" class="text-muted">Help</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
              <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-default btn-flat float-right">Sign out</a>
            </li>
          </ul>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('auth/login'); ?>" role="button">
            <i class="fas fa-sign-in-alt mr-1"></i> Login
          </a>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
      <i class="fas fa-trophy brand-image elevation-3" style="opacity: .8; margin-left: 0.8rem; margin-right: 0.5rem;"></i>
      <span class="brand-text font-weight-light">Juri Digital</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE): ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <div class="user-icon-sidebar">
            <i class="fas fa-user"></i>
          </div>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username']; ?></a>
          <small class="text-light">
            <?php if (isset($_SESSION['roles']) && is_array($_SESSION['roles'])): ?>
              <?php echo implode(', ', $_SESSION['roles']); ?>
            <?php endif; ?>
          </small>
        </div>
      </div>
      <?php endif; ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <?php $controller = $this->router->fetch_class(); ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>" class="nav-link <?php echo ($controller == 'dashboard' || $controller == 'welcome') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dasbor</p>
            </a>
          </li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE && isset($_SESSION['role_ids']) && isset($_SESSION['administrator_role_id']) && in_array($_SESSION['administrator_role_id'], $_SESSION['role_ids'])) : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('users'); ?>" class="nav-link <?php echo ($controller == 'users') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Pengguna</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('kompetisi'); ?>" class="nav-link <?php echo ($controller == 'kompetisi') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-trophy"></i>
                <p>Kompetisi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('templat_penilaian'); ?>" class="nav-link <?php echo ($controller == 'templat_penilaian') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>Templat Penilaian</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('juri_assignment'); ?>" class="nav-link <?php echo ($controller == 'juri_assignment') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>Penugasan Juri</p>
              </a>
            </li>
          <?php endif; ?>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE && isset($_SESSION['role_ids']) && in_array(3, $_SESSION['role_ids'])) : ?>
            <li class="nav-item">
              <a href="<?php echo base_url('penilaian'); ?>" class="nav-link <?php echo ($controller == 'penilaian') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-gavel"></i>
                <p>Penilaian Saya</p>
              </a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Keluar</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-fluid">