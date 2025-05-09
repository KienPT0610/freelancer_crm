<?php
// Set variables for the layout
$page_title = 'Dashboard';
$active_page = 'dashboard';
$use_chart_js = true;

// Start output buffering to capture dashboard content
ob_start();
?>

<!-- Dashboard Cards -->
<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="card info-card primary">
      <div class="card-body">
        <div class="card-title">Tổng Khách Hàng</div>
        <div class="card-value">24</div>
        <i class="fas fa-users"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card info-card success">
      <div class="card-body">
        <div class="card-title">Dự Án Đang Hoạt Động</div>
        <div class="card-value">13</div>
        <i class="fas fa-project-diagram"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card info-card info">
      <div class="card-body">
        <div class="card-title">Tương Tác Mới</div>
        <div class="card-value">7</div>
        <i class="fas fa-comments"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card info-card warning">
      <div class="card-body">
        <div class="card-title">Liên Hệ Chưa Đọc</div>
        <div class="card-value">5</div>
        <i class="fas fa-envelope"></i>
      </div>
    </div>
  </div>
</div>

<!-- Chart Section -->
<div class="row mb-4">
  <div class="col-xl-8">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Dự Án Theo Tháng</span>
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-ellipsis-v"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Xuất báo cáo</a></li>
            <li><a class="dropdown-item" href="#">Tùy chỉnh</a></li>
          </ul>
        </div>
      </div>
      <div class="card-body">
        <canvas id="projectsChart" height="300"></canvas>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Trạng Thái Dự Án</span>
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-ellipsis-v"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Xuất báo cáo</a></li>
            <li><a class="dropdown-item" href="#">Tùy chỉnh</a></li>
          </ul>
        </div>
      </div>
      <div class="card-body">
        <canvas id="statusChart" height="260"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Recent Projects -->
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Dự Án Gần Đây</span>
    <a href="/admin/projects" class="btn btn-primary btn-sm">Xem Tất Cả</a>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>Tên Dự Án</th>
            <th>Khách Hàng</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Giá Trị</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Thiết Kế Website</td>
            <td>Công Ty TNHH ABC</td>
            <td>2023-10-15</td>
            <td>2023-11-30</td>
            <td>₫15,000,000</td>
            <td><span class="badge-status badge-active">Đang Tiến Hành</span></td>
            <td>
              <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
              <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          <tr>
            <td>Tích Hợp Thanh Toán</td>
            <td>Shop XYZ</td>
            <td>2023-10-01</td>
            <td>2023-10-25</td>
            <td>₫8,500,000</td>
            <td><span class="badge-status badge-completed">Hoàn Thành</span></td>
            <td>
              <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
              <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          <tr>
            <td>Ứng Dụng Di Động</td>
            <td>Startup Tech</td>
            <td>2023-11-01</td>
            <td>2024-01-15</td>
            <td>₫25,000,000</td>
            <td><span class="badge-status badge-pending">Chờ Xử Lý</span></td>
            <td>
              <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
              <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          <tr>
            <td>Tối Ưu Hóa SEO</td>
            <td>Cửa Hàng Online</td>
            <td>2023-09-15</td>
            <td>2023-10-15</td>
            <td>₫5,000,000</td>
            <td><span class="badge-status badge-cancelled">Đã Hủy</span></td>
            <td>
              <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
              <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Recent Activities & Customer List -->
<div class="row">
  <!-- Recent Interactions -->
  <div class="col-lg-7">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Tương Tác Gần Đây</span>
        <a href="/admin/interactions" class="btn btn-primary btn-sm">Xem Tất Cả</a>
      </div>
      <div class="card-body p-0">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Cuộc Gọi Với Công Ty TNHH ABC</h6>
              <small class="text-muted">Hôm nay</small>
            </div>
            <p class="mb-1 text-truncate">Thảo luận về quy trình triển khai dự án và tiến độ...</p>
            <small class="text-primary">Loại: Cuộc Gọi | <span class="text-muted">bởi Admin</span></small>
          </div>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Email Báo Giá Cho Startup Tech</h6>
              <small class="text-muted">Hôm qua</small>
            </div>
            <p class="mb-1 text-truncate">Gửi báo giá chi tiết cho dự án ứng dụng di động...</p>
            <small class="text-primary">Loại: Email | <span class="text-muted">bởi Admin</span></small>
          </div>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Cuộc Họp Với Shop XYZ</h6>
              <small class="text-muted">3 ngày trước</small>
            </div>
            <p class="mb-1 text-truncate">Thống nhất các yêu cầu cuối cùng và hoàn tất thanh toán...</p>
            <small class="text-primary">Loại: Cuộc Họp | <span class="text-muted">bởi Admin</span></small>
          </div>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Ghi Chú Về Cửa Hàng Online</h6>
              <small class="text-muted">1 tuần trước</small>
            </div>
            <p class="mb-1 text-truncate">Khách hàng quyết định tạm hoãn dự án do vấn đề ngân sách...</p>
            <small class="text-primary">Loại: Ghi Chú | <span class="text-muted">bởi Admin</span></small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Contact Submissions -->
  <div class="col-lg-5">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Liên Hệ Mới</span>
        <a href="/admin/contacts" class="btn btn-primary btn-sm">Xem Tất Cả</a>
      </div>
      <div class="card-body p-0">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Nguyễn Văn A</h6>
              <small class="text-danger">Chưa đọc</small>
            </div>
            <p class="mb-1 text-truncate">Tôi muốn tìm hiểu về dịch vụ thiết kế website...</p>
            <small class="text-muted">2 giờ trước | <a href="mailto:nguyenvana@example.com">nguyenvana@example.com</a></small>
          </div>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Trần Thị B</h6>
              <small class="text-danger">Chưa đọc</small>
            </div>
            <p class="mb-1 text-truncate">Cần tư vấn về giải pháp thương mại điện tử...</p>
            <small class="text-muted">5 giờ trước | <a href="mailto:tranthib@example.com">tranthib@example.com</a></small>
          </div>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Công Ty XYZ</h6>
              <small class="text-success">Đã đọc</small>
            </div>
            <p class="mb-1 text-truncate">Chúng tôi cần một đối tác phát triển phần mềm dài hạn...</p>
            <small class="text-muted">1 ngày trước | <a href="mailto:contact@xyz.com">contact@xyz.com</a></small>
          </div>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Lê Văn C</h6>
              <small class="text-success">Đã đọc</small>
            </div>
            <p class="mb-1 text-truncate">Tôi cần báo giá cho một dự án ứng dụng di động...</p>
            <small class="text-muted">2 ngày trước | <a href="mailto:levanc@example.com">levanc@example.com</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript for Charts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Projects by Month Chart
  var projectsCtx = document.getElementById('projectsChart').getContext('2d');
  var projectsChart = new Chart(projectsCtx, {
    type: 'line',
    data: {
      labels: ['Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
      datasets: [{
        label: 'Dự Án Mới',
        data: [3, 5, 4, 6, 5, 3],
        borderColor: '#4e73df',
        backgroundColor: 'rgba(78, 115, 223, 0.05)',
        pointBackgroundColor: '#4e73df',
        tension: 0.3,
        fill: true
      }, {
        label: 'Dự Án Hoàn Thành',
        data: [2, 3, 4, 3, 4, 2],
        borderColor: '#1cc88a',
        backgroundColor: 'rgba(28, 200, 138, 0.05)',
        pointBackgroundColor: '#1cc88a',
        tension: 0.3,
        fill: true
      }]
    },
    options: {
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: 'top'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });

  // Project Status Chart
  var statusCtx = document.getElementById('statusChart').getContext('2d');
  var statusChart = new Chart(statusCtx, {
    type: 'doughnut',
    data: {
      labels: ['Chờ Xử Lý', 'Đang Tiến Hành', 'Hoàn Thành', 'Đã Hủy'],
      datasets: [{
        data: [4, 8, 12, 2],
        backgroundColor: ['#f6c23e', '#4e73df', '#1cc88a', '#e74a3b'],
        hoverOffset: 4
      }]
    },
    options: {
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom'
        }
      },
      cutout: '70%'
    }
  });
});
</script>

<?php
// Get dashboard content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>