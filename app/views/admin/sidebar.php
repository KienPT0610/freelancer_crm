<!-- Sidebar -->
<div class="col-lg-2 p-0 sidebar">
  <div class="sidebar-brand">
    <i class="fas fa-briefcase"></i>
    <span>Freelancer CRM</span>
  </div>

  <div class="sidebar-menu">
    <div class="sidebar-heading">Core</div>
    <a class="sidebar-item <?php echo $active_page == 'dashboard' ? 'active' : ''; ?>" href="/admin/dashboard">
      <i class="fas fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>

    <div class="sidebar-heading">Quản lý</div>
    <a class="sidebar-item <?php echo $active_page == 'customers' ? 'active' : ''; ?>" href="/admin/customers">
      <i class="fas fa-building"></i>
      <span>Khách Hàng</span>
    </a>
    <a class="sidebar-item <?php echo $active_page == 'projects' ? 'active' : ''; ?>" href="/admin/projects">
      <i class="fas fa-project-diagram"></i>
      <span>Dự Án</span>
    </a>
    <a class="sidebar-item <?php echo $active_page == 'interactions' ? 'active' : ''; ?>" href="/admin/interactions">
      <i class="fas fa-comments"></i>
      <span>Tương Tác</span>
    </a>
    <a class="sidebar-item <?php echo $active_page == 'contacts' ? 'active' : ''; ?>" href="/admin/contacts">
      <i class="fas fa-envelope"></i>
      <span>Liên Hệ</span>
    </a>

    <div class="sidebar-heading">Trang</div>
    <a class="sidebar-item <?php echo $active_page == 'reports' ? 'active' : ''; ?>" href="/home">
      <i class="fas fa-chart-bar"></i>
      <span>Trang chủ</span>
    </a>

    <div class="sidebar-heading">Cài Đặt</div>
    <a class="sidebar-item <?php echo $active_page == 'settings' ? 'active' : ''; ?>" href="/admin/settings">
      <i class="fas fa-cog"></i>
      <span>Cài Đặt</span>
    </a>
    <a class="sidebar-item <?php echo $active_page == 'profile' ? 'active' : ''; ?>" href="/admin/profile">
      <i class="fas fa-user"></i>
      <span>Tài Khoản</span>
    </a>

    <a class="sidebar-item" href="/logout">
      <i class="fas fa-sign-out-alt"></i>
      <span>Đăng Xuất</span>
    </a>
  </div>
</div>