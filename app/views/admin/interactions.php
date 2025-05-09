<?php
// Set variables for the layout
$page_title = 'Tương Tác';
$active_page = 'interactions';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Quản Lý Tương Tác</h4>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInteractionModal">
    <i class="fas fa-plus me-2"></i> Thêm Tương Tác
  </button>
</div>

<!-- Interactions Search and Filter -->
<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm tương tác...">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option value="">Tất Cả Loại</option>
          <option value="Email">Email</option>
          <option value="Call">Cuộc Gọi</option>
          <option value="Meeting">Cuộc Họp</option>
          <option value="Note">Ghi Chú</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option value="">Tất Cả Khách Hàng</option>
          <option value="1">Công Ty TNHH ABC</option>
          <option value="2">Shop XYZ</option>
          <option value="3">Startup Tech</option>
          <option value="4">Cửa Hàng Online</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">Đặt Lại</button>
      </div>
    </div>
  </div>
</div>

<!-- Interactions Timeline -->
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Lịch Sử Tương Tác</span>
    <div>
      <button class="btn btn-sm btn-outline-primary me-2">
        <i class="fas fa-download me-1"></i> Xuất Excel
      </button>
      <div class="dropdown d-inline-block">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-cog me-1"></i> Thao Tác
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> Tạo Báo Cáo</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-filter me-2"></i> Lọc Nâng Cao</a></li>
        </ul>
      </div>
    </div>
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
            <div>
              <span class="badge bg-primary me-2"><?php echo $interaction['interaction_type']; ?></span>
              <a href="#" class="fw-bold text-decoration-none"><?php echo $interaction['customer_name']; ?></a>
            </div>
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
  <div class="card-footer">
    <nav>
      <ul class="pagination justify-content-center mb-0">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Trước</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Sau</a>
        </li>
      </ul>
    </nav>
  </div>
</div>

<!-- Modal thêm tương tác mới -->
<div class="modal fade" id="addInteractionModal" tabindex="-1" aria-labelledby="addInteractionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInteractionModalLabel">Thêm Tương Tác Mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="customerId" class="form-label">Khách Hàng <span class="text-danger">*</span></label>
            <select class="form-select" id="customerId" required>
              <option value="">-- Chọn Khách Hàng --</option>
              <option value="1">Công Ty TNHH ABC</option>
              <option value="2">Shop XYZ</option>
              <option value="3">Startup Tech</option>
              <option value="4">Cửa Hàng Online</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="interactionType" class="form-label">Loại Tương Tác <span class="text-danger">*</span></label>
            <select class="form-select" id="interactionType" required>
              <option value="">-- Chọn Loại --</option>
              <option value="Email">Email</option>
              <option value="Call">Cuộc Gọi</option>
              <option value="Meeting">Cuộc Họp</option>
              <option value="Note">Ghi Chú</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="interactionDate" class="form-label">Ngày Tương Tác <span class="text-danger">*</span></label>
            <input type="datetime-local" class="form-control" id="interactionDate" required>
          </div>
          <div class="mb-3">
            <label for="interactionSummary" class="form-label">Nội Dung <span class="text-danger">*</span></label>
            <textarea class="form-control" id="interactionSummary" rows="4" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary">Lưu Tương Tác</button>
      </div>
    </div>
  </div>
</div>

<style>
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
</style>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>