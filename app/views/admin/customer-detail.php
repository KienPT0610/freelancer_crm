<?php
// Set variables for the layout
$page_title = 'Chi Tiết Khách Hàng';
$active_page = 'customers';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Thông Tin Khách Hàng</h4>
  <div>
    <a href="/admin/customers" class="btn btn-outline-secondary me-2">
      <i class="fas fa-arrow-left me-2"></i> Quay Lại
    </a>
    <button type="submit" form="customerForm" class="btn btn-primary" id="saveCustomerBtn">
      <i class="fas fa-save me-2"></i> Lưu Thay Đổi
    </button>
  </div>
</div>

<div class="row">
  <!-- Customer Information -->
  <div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Thông Tin Cơ Bản</h5>
      </div>
      <div class="card-body">
        <form id="customerForm" method="post" action="/admin/customers/<?php echo $customer['customer_id']; ?>/update">
          <input type="hidden" id="customerId" name="customer_id" value="<?php echo $customer['customer_id'] ?? ''; ?>">

          <!-- Display success or error messages if they exist -->
          <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
          </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
          </div>
          <?php endif; ?>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="customerName" class="form-label">Tên Khách Hàng / Công Ty <span
                  class="text-danger">*</span></label>
              <input type="text" class="form-control" id="customerName" name="name"
                value="<?php echo $customer['name'] ?? 'Công Ty TNHH ABC'; ?>" required>
            </div>
            <div class="col-md-6">
              <label for="customerEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="customerEmail" name="email"
                value="<?php echo $customer['email'] ?? 'contact@abc.com'; ?>">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="customerPhone" class="form-label">Số Điện Thoại</label>
              <input type="text" class="form-control" id="customerPhone" name="phone"
                value="<?php echo $customer['phone'] ?? '0901234567'; ?>">
            </div>
            <div class="col-md-6">
              <label for="customerCompany" class="form-label">Tên Công Ty (nếu khác)</label>
              <input type="text" class="form-control" id="customerCompany" name="company"
                value="<?php echo $customer['company'] ?? ''; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="customerAddress" class="form-label">Địa Chỉ</label>
            <textarea class="form-control" id="customerAddress" name="address"
              rows="2"><?php echo $customer['address'] ?? '123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh'; ?></textarea>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="customerSource" class="form-label">Nguồn Khách Hàng</label>
              <select class="form-select" id="customerSource" name="source">
                <option value="">-- Chọn Nguồn --</option>
                <option value="Referral"
                  <?php echo (isset($customer['source']) && $customer['source'] === 'Referral') ? 'selected' : ''; ?>>
                  Giới Thiệu</option>
                <option value="LinkedIn"
                  <?php echo (isset($customer['source']) && $customer['source'] === 'LinkedIn') ? 'selected' : ''; ?>>
                  LinkedIn</option>
                <option value="Website"
                  <?php echo (isset($customer['source']) && $customer['source'] === 'Website') ? 'selected' : ''; ?>>
                  Website</option>
                <option value="Other"
                  <?php echo (isset($customer['source']) && $customer['source'] === 'Other') ? 'selected' : ''; ?>>Khác
                </option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="customerStatus" class="form-label">Trạng Thái</label>
              <select class="form-select" id="customerStatus" name="status">
                <option value="Potential"
                  <?php echo (isset($customer['status']) && $customer['status'] === 'Potential') ? 'selected' : ''; ?>>
                  Tiềm Năng</option>
                <option value="Active"
                  <?php echo (isset($customer['status']) && $customer['status'] === 'Active') ? 'selected' : ''; ?>>Đang
                  Hoạt Động</option>
                <option value="OnHold"
                  <?php echo (isset($customer['status']) && $customer['status'] === 'OnHold') ? 'selected' : ''; ?>>Tạm
                  Dừng</option>
                <option value="Completed"
                  <?php echo (isset($customer['status']) && $customer['status'] === 'Completed') ? 'selected' : ''; ?>>
                  Đã Hoàn Thành</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="customerTags" class="form-label">Thẻ</label>
            <input type="text" class="form-control" id="customerTags" name="tags"
              placeholder="Nhập thẻ, phân cách bằng dấu phẩy (VD: vip,SME,tech)"
              value="<?php echo $customer['tags'] ?? 'vip,tech'; ?>">
          </div>

          <div class="mb-3">
            <label for="customerNotes" class="form-label">Ghi Chú</label>
            <textarea class="form-control" id="customerNotes" name="notes"
              rows="3"><?php echo $customer['notes'] ?? 'Khách hàng quan tâm đến dịch vụ thiết kế website. Cần liên hệ lại trong tuần này.'; ?></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Customer Sidebar -->
  <div class="col-lg-4">
    <!-- Customer Stats -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Thống Kê</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Số Dự Án</span>
            <span class="badge bg-primary rounded-pill"><?php echo count($projects); ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Tổng Doanh Thu</span>
            <span class="fw-bold">₫25,500,000</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Số Tương Tác</span>
            <span class="badge bg-info rounded-pill"><?php echo count($interactions); ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Tương Tác Cuối</span>
            <span><?php echo $interactions[0]['created_at']; ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Ngày Tham Gia</span>
            <span><?php echo $customer['created_at']; ?></span>
          </li>
        </ul>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Thao Tác Nhanh</h5>
      </div>
      <div class="card-body">
        <div class="d-grid gap-2">
          <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addInteractionModal">
            <i class="fas fa-plus-circle me-2"></i> Thêm Tương Tác
          </button>
          <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addProjectModal">
            <i class="fas fa-project-diagram me-2"></i> Tạo Dự Án Mới
          </button>
          <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#sendEmailModal">
            <i class="fas fa-envelope me-2"></i> Gửi Email
          </button>
          <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal">
            <i class="fas fa-trash me-2"></i> Xóa Khách Hàng
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Customer Projects -->
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Dự Án</h5>
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
      <i class="fas fa-plus me-2"></i> Thêm Dự Án
    </button>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>Tên Dự Án</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Giá Trị</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($projects as $project) : ?>
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="project-icon rounded-circle bg-primary text-white me-2">
                  <i class="fas fa-globe"></i>
                </div>
                <div>
                  <div class="fw-bold"><?php echo $project['project_name']; ?></div>
                  <div class="small text-muted">ID: <?php echo $project['project_id']; ?></div>
                </div>
              </div>
            </td>
            <td><?php echo $project['start_date']; ?></td>
            <td>
              <?php if ($project['end_date'] == null) : ?>
              <span class="badge bg-secondary">
                Chưa Xác Định
              </span>
              <?php else : ?>
              <?php echo $project['end_date']; ?>
              <?php endif; ?>
            </td>
            <td>₫<?php echo $project['value']; ?></td>
            <td>
              <?php if ($project['status'] == 'Pending') : ?>
              <span class="badge bg-warning">Chờ Xử Lý</span>
              <?php elseif ($project['status'] == 'InProgress') : ?>
              <span class="badge bg-info">Đang Tiến Hành</span>
              <?php elseif ($project['status'] == 'Completed') : ?>
              <span class="badge bg-success">Hoàn Thành</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Recent Interactions -->
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Lịch Sử Tương Tác</h5>
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addInteractionModal">
      <i class="fas fa-plus me-2"></i> Thêm Tương Tác
    </button>
  </div>
  <div class="card-body p-4">
    <div class="timeline">
      <!-- Interaction 1 -->
      <?php foreach ($interactions as $interaction) : ?>
      <div class="timeline-item mb-4">
        <div class="timeline-item-marker">
          <?php if ($interaction['interaction_type'] == 'Call') : ?>
          <div class="timeline-item-marker-indicator bg-primary">
            <i class="fas fa-phone-alt text-white"></i>
          </div>
          <?php elseif ($interaction['interaction_type'] == 'Email') : ?>
          <div class="timeline-item-marker-indicator bg-warning">
            <i class="fas fa-envelope text-white"></i>
          </div>
          <?php elseif ($interaction['interaction_type'] == 'Meeting') : ?>
          <div class="timeline-item-marker-indicator bg-success">
            <i class="fas fa-handshake text-white"></i>
          </div>
          <?php endif; ?>
        </div>
        <div class="timeline-item-content">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="small text-muted">
              <i class="far fa-clock me-1"></i> <?php echo $interaction['created_at']; ?>
            </div>
          </div>
          <p class="mb-2"><?php echo $interaction['summary']; ?></p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="small text-muted">
              <i class="fas fa-user me-1"></i> Tạo bởi: Admin
            </div>
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="far fa-edit"></i></a>
              <a href="#" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="timeline-end-icon">
        <i class="fas fa-chevron-down"></i>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Interaction -->
<div class="modal fade" id="addInteractionModal" tabindex="-1" aria-labelledby="addInteractionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInteractionModalLabel">Thêm Tương Tác Mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addInteractionForm">
          <input type="hidden" name="customerId" value="<?php echo $customer['id'] ?? '1'; ?>">
          <div class="mb-3">
            <label for="interactionType" class="form-label">Loại Tương Tác <span class="text-danger">*</span></label>
            <select class="form-select" id="interactionType" name="type" required>
              <option value="">-- Chọn Loại --</option>
              <option value="Email">Email</option>
              <option value="Call">Cuộc Gọi</option>
              <option value="Meeting">Cuộc Họp</option>
              <option value="Note">Ghi Chú</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="interactionTitle" class="form-label">Tiêu Đề <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="interactionTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="interactionDate" class="form-label">Ngày Tương Tác <span class="text-danger">*</span></label>
            <input type="datetime-local" class="form-control" id="interactionDate" name="date" required>
          </div>
          <div class="mb-3">
            <label for="interactionSummary" class="form-label">Nội Dung <span class="text-danger">*</span></label>
            <textarea class="form-control" id="interactionSummary" name="summary" rows="4" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary" id="saveInteractionBtn">Lưu Tương Tác</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Customer -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCustomerModalLabel">Xác Nhận Xóa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa khách hàng này? Hành động này không thể hoàn tác và sẽ xóa tất cả dữ liệu liên
          quan.</p>
        <div class="alert alert-danger">
          <i class="fas fa-exclamation-triangle me-2"></i>
          Cảnh báo: Tất cả dự án, tương tác và hồ sơ của khách hàng này cũng sẽ bị xóa.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Xác Nhận Xóa</button>
      </div>
    </div>
  </div>
</div>

<style>
.project-icon {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
}

.timeline {
  position: relative;
  padding-left: 4rem;
}

.timeline-item {
  position: relative;
}

.timeline-item-marker {
  position: absolute;
  left: -4rem;
  top: 0;
  z-index: 1;
  width: 3rem;
}

.timeline-item-marker-indicator {
  width: 3rem;
  height: 3rem;
  border-radius: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.timeline-item-content {
  background-color: #fff;
  border-radius: 0.5rem;
  padding: 1rem;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.timeline:before {
  content: '';
  position: absolute;
  top: 0;
  left: 1.15rem;
  height: 100%;
  border-left: 2px dashed #e3e6f0;
}

.timeline-end-icon {
  position: relative;
  left: -4rem;
  width: 3rem;
  color: #a2acbd;
  text-align: center;
  font-size: 1.5rem;
}

.badge-status {
  display: inline-block;
  padding: 0.35em 0.65em;
  font-size: 0.75em;
  font-weight: 700;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
}

.badge-active {
  background-color: #4e73df;
}

.badge-completed {
  background-color: #1cc88a;
}

.badge-pending {
  background-color: #f6c23e;
}

.badge-cancelled {
  background-color: #e74a3b;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Save Customer Button
  document.getElementById('saveCustomerBtn').addEventListener('click', function() {
    alert('Thông tin khách hàng đã được cập nhật!');
  });

  // Save Interaction Button
  document.getElementById('saveInteractionBtn').addEventListener('click', function() {
    const form = document.getElementById('addInteractionForm');

    // Validate form
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    alert('Đã thêm tương tác mới!');

    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('addInteractionModal'));
    modal.hide();
  });

  // Delete Customer Button
  document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    alert('Đã xóa khách hàng!');
    window.location.href = '/admin/customers';
  });

  // Set current datetime for interaction date
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');

  document.getElementById('interactionDate').value = `${year}-${month}-${day}T${hours}:${minutes}`;
});
</script>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>