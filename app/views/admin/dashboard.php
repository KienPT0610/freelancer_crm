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
        <div class="card-value"><?php echo count($customers); ?></div>
        <i class="fas fa-users"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card info-card success">
      <div class="card-body">
        <div class="card-title">Dự Án Đang Hoạt Động</div>
        <div class="card-value"><?php echo count($projects); ?></div>
        <i class="fas fa-project-diagram"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card info-card info">
      <div class="card-body">
        <div class="card-title">Tương Tác Mới</div>
        <div class="card-value"><?php echo count($interactions); ?></div>
        <i class="fas fa-comments"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card info-card warning">
      <div class="card-body">
        <div class="card-title">Liên Hệ Chưa Đọc</div>
        <div class="card-value">
          <?php
          // Count unread contacts
          $unread_contacts = array_filter($contacts, function($contact) {
            return !$contact['is_read'];
          });
          echo count($unread_contacts);
          ?>
        </div>
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
          <?php foreach (array_slice($projects, 0, min(count($projects), 4)) as $project): ?>
          <tr>
            <td><?php echo $project['project_name']; ?></td>
            <td><?php echo $project['customer_name']; ?></td>
            <td><?php echo $project['start_date']; ?></td>
            <td><?php echo $project['end_date']; ?></td>
            <td><?php echo number_format($project['value'], 0, ',', '.'); ?></td>
            <td>
              <?php
              switch ($project['status']) {
                case 'Pending':
                  echo '<span class="badge bg-warning">Chờ Xử Lý</span>';
                  break;
                case 'InProgress':
                  echo '<span class="badge bg-info">Đang Tiến Hành</span>';
                  break;
                case 'Completed':
                  echo '<span class="badge bg-success">Hoàn Thành</span>';
                  break;
                case 'Canceled':
                  echo '<span class="badge bg-danger">Đã Hủy</span>';
                  break;
                default:
                  echo '<span class="badge bg-secondary">Không xác định</span>';
              }
              ?>
            </td>
            <td>
              <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
              <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
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
          <?php foreach (array_slice($interactions, 0, min(count($interactions), 4)) as $interaction): ?>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">
                <?php echo $interaction['customer_name']; ?>
              </h6>
              <small class="text-muted">
                <?php echo date('d/m/Y H:i', strtotime($interaction['created_at'])); ?>
              </small>
            </div>
            <p class="mb-1 text-truncate">
              <?php echo $interaction['summary']; ?>
            </p>
            <small class="text-primary">Loại: <?php echo $interaction['interaction_type'] ?> | <span
                class="text-muted">bởi Admin</span></small>
          </div>
          <?php endforeach; ?>
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
          <?php foreach (array_slice($contacts, 0, min(count($contacts), 4)) as $contact): ?>
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1"><?php echo $contact['name']; ?></h6>
              <small class="text-danger"><?php echo $contact['status']; ?></small>
            </div>
            <p class="mb-1 text-truncate">
              <?php echo $contact['message']; ?>
            </p>
            <small class="text-muted"> <?php echo $contact['submission_date'] ?> | <a
                href="mailto:<?php echo $contact['email']; ?>"><?php echo $contact['email']; ?></a></small>
          </div>
          <?php endforeach; ?>
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