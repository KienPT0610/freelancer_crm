<?php
// Set variables for the layout
$page_title = 'Dự Án';
$active_page = 'projects';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Quản Lý Dự Án</h4>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
    <i class="fas fa-plus me-2"></i> Thêm Dự Án
  </button>
</div>

<!-- Projects Search and Filter -->
<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm dự án...">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option value="">Tất Cả Trạng Thái</option>
          <option value="Pending">Chờ Xử Lý</option>
          <option value="InProgress">Đang Tiến Hành</option>
          <option value="Completed">Hoàn Thành</option>
          <option value="Cancelled">Đã Hủy</option>
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

<!-- Projects List -->
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Danh Sách Dự Án</span>
    <div>
      <button class="btn btn-sm btn-outline-primary me-2">
        <i class="fas fa-download me-1"></i> Xuất Excel
      </button>
      <div class="dropdown d-inline-block">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-cog me-1"></i> Thao Tác
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> Tạo Báo Cáo PDF</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-2"></i> Lưu Trữ</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
              </div>
            </th>
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
          <?php foreach ($projects as $project) : ?>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox">
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="project-icon rounded-circle bg-primary text-white me-2">
                  <i class="fas fa-globe"></i>
                </div>
                <div>
                  <div class="fw-bold"><?php echo $project['project_name']; ?></div>
                  <div class="small text-muted">PRID0<?php echo $project['project_id']; ?></div>
                </div>
              </div>
            </td>
            <td><span class="badge bg-info"><?php echo $project['customer_name']; ?></span></td>
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
            <td>₫<?php echo number_format($project['value'], 0, ',', '.'); ?></td>
            <td>
              <?php if ($project['status'] == 'Pending') : ?>
              <span class="badge bg-warning">Chờ Xử Lý</span>
              <?php elseif ($project['status'] == 'InProgress') : ?>
              <span class="badge bg-info">Đang Tiến Hành</span>
              <?php elseif ($project['status'] == 'Completed') : ?>
              <span class="badge bg-success">Hoàn Thành</span>
              <?php elseif ($project['status'] == 'Cancelled') : ?>
              <span class="badge bg-danger">Đã Hủy</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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

<!-- Modal thêm dự án mới -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProjectModalLabel">Thêm Dự Án Mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="projectName" class="form-label">Tên Dự Án <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="projectName" required>
          </div>
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
            <label for="projectDescription" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="projectDescription" rows="3"></textarea>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="startDate" class="form-label">Ngày Bắt Đầu</label>
              <input type="date" class="form-control" id="startDate">
            </div>
            <div class="col-md-6">
              <label for="endDate" class="form-label">Ngày Kết Thúc</label>
              <input type="date" class="form-control" id="endDate">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="projectValue" class="form-label">Giá Trị Dự Án (VNĐ)</label>
              <input type="number" class="form-control" id="projectValue" min="0" step="500000">
            </div>
            <div class="col-md-6">
              <label for="projectStatus" class="form-label">Trạng Thái</label>
              <select class="form-select" id="projectStatus">
                <option value="Pending">Chờ Xử Lý</option>
                <option value="InProgress">Đang Tiến Hành</option>
                <option value="Completed">Hoàn Thành</option>
                <option value="Cancelled">Đã Hủy</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary">Lưu Dự Án</button>
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
</style>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>