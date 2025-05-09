<!-- Top Navigation -->
<nav class="navbar navbar-expand navbar-light">
  <div class="container-fluid">
    <h5 class="mb-0"><?php echo $page_title ?? 'Admin'; ?></h5>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown me-3">
        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            3+
          </span>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../../../public/assets/images/avatar.png" class="rounded-circle me-1" width="32" height="32">
          <span class="d-none d-md-inline-block">Admin User</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="/admin/profile"><i class="fas fa-user me-2"></i> Profile</a></li>
          <li><a class="dropdown-item" href="/admin/settings"><i class="fas fa-cog me-2"></i> Settings</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>