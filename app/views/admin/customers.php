<?php
// Set variables for the layout
$page_title = 'Khách Hàng';
$active_page = 'customers'; // Cần thêm mục này vào sidebar

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Quản Lý Khách Hàng</h4>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
    <i class="fas fa-plus me-2"></i> Thêm Khách Hàng
  </button>
</div>

<!-- Customers Search and Filter -->
<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm khách hàng...">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option value="">Tất Cả Trạng Thái</option>
          <option value="Potential">Tiềm Năng</option>
          <option value="Active">Đang Hoạt Động</option>
          <option value="OnHold">Tạm Dừng</option>
          <option value="Completed">Đã Hoàn Thành</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option value="">Tất Cả Nguồn</option>
          <option value="Referral">Giới Thiệu</option>
          <option value="LinkedIn">LinkedIn</option>
          <option value="Website">Website</option>
          <option value="Other">Khác</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">Đặt Lại</button>
      </div>
    </div>
  </div>
</div>

<!-- Customers List -->
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Danh Sách Khách Hàng</span>
    <div>
      <button class="btn btn-sm btn-outline-primary me-2">
        <i class="fas fa-download me-1"></i> Xuất Excel
      </button>
      <div class="dropdown d-inline-block">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-cog me-1"></i> Thao Tác
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Email Hàng Loạt</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-tags me-2"></i> Gán Thẻ</a></li>
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
            <th>Tên</th>
            <th>Email</th>
            <th>Điện Thoại</th>
            <th>Công Ty</th>
            <th>Nguồn</th>
            <th>Tags</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($customers as $customer) : ?>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox">
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="avatar-initial rounded-circle bg-primary text-white me-2">CT</div>
                <div>
                  <div class="fw-bold"><?php echo $customer['name']; ?></div>
                  <div class="small text-muted"><?php echo $customer['created_at']; ?></div>
                </div>
              </div>
            </td>
            <td>
              <?php if ($customer['email'] == ''): ?>
              <span class="badge bg-secondary">Không Có Email</span>
              <?php else: ?>
              <a href="mailto:<?php echo $customer['email']; ?>"><?php echo $customer['email']; ?></a>
              <?php endif; ?>
            </td>
            <td>
              <?php if ($customer['phone'] == ''): ?>
              <span class="badge bg-secondary">Không Có Số Điện Thoại</span>
              <?php else: ?>
              <a href="tel:<?php echo $customer['phone']; ?>"><?php echo $customer['phone']; ?></a>
              <?php endif; ?>
            </td>
            <td>
              <?php if ($customer['company'] == ''): ?>
              <span class="badge bg-secondary">Không Có Công Ty</span>
              <?php else: ?>
              <span class="fw-bold"><?php echo $customer['company']; ?></span>
              <?php endif; ?>
            </td>
            <td><?php echo $customer['source']; ?></td>
            <td><span class="badge bg-primary"><?php echo $customer['tags']; ?></span></td>
            <td>
              <?php if ($customer['status'] == 'Active'): ?>
              <span class="badge bg-success">Đang Hoạt Động</span>
              <?php elseif ($customer['status'] == 'Potential'): ?>
              <span class="badge bg-primary">Tiềm Năng</span>
              <?php elseif ($customer['status'] == 'OnHold'): ?>
              <span class="badge bg-warning">Tạm Dừng</span>
              <?php elseif ($customer['status'] == 'Completed'): ?>
              <span class="badge bg-info">Đã Hoàn Thành</span>
              <?php else: ?>
              <span class="badge bg-secondary">Không Có Trạng Thái</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="btn-group">
                <a href="/admin/customers/<?php echo $customer['customer_id']; ?>"
                  class="btn btn-sm btn-outline-primary">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="/admin/customers/<?php echo $customer['customer_id']; ?>" class="btn btn-sm btn-outline-info">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="/admin/customers/<?php echo $customer['customer_id']; ?>/delete"
                  class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">
                  <i class="fas fa-trash"></i>
                </a>
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

<!-- Modal thêm khách hàng mới -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCustomerModalLabel">Thêm Khách Hàng Mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addCustomerForm" action="/admin/customers/add" method="POST">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="customerName" class="form-label">Tên Khách Hàng / Công Ty <span
                  class="text-danger">*</span></label>
              <input type="text" class="form-control" id="customerName" name="name" required>
            </div>
            <div class="col-md-6">
              <label for="customerEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="customerEmail" name="email">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="customerPhone" class="form-label">Số Điện Thoại</label>
              <input type="text" class="form-control" id="customerPhone" name="phone">
            </div>
            <div class="col-md-6">
              <label for="customerCompany" class="form-label">Tên Công Ty (nếu khác)</label>
              <input type="text" class="form-control" id="customerCompany" name="company">
            </div>
          </div>
          <div class="mb-3">
            <label for="customerAddress" class="form-label">Địa Chỉ</label>
            <textarea class="form-control" id="customerAddress" name="address" rows="2"></textarea>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="customerSource" class="form-label">Nguồn Khách Hàng</label>
              <select class="form-select" id="customerSource" name="source">
                <option value="">-- Chọn Nguồn --</option>
                <option value="Referral">Giới Thiệu</option>
                <option value="LinkedIn">LinkedIn</option>
                <option value="Website">Website</option>
                <option value="Other">Khác</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="customerStatus" class="form-label">Trạng Thái</label>
              <select class="form-select" id="customerStatus" name="status">
                <option value="Potential">Tiềm Năng</option>
                <option value="Active">Đang Hoạt Động</option>
                <option value="OnHold">Tạm Dừng</option>
                <option value="Completed">Đã Hoàn Thành</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="customerTags" class="form-label">Thẻ</label>
            <input type="text" class="form-control" id="customerTags" name="tags"
              placeholder="Nhập thẻ, phân cách bằng dấu phẩy (VD: vip,SME,tech)">
          </div>
          <div class="mb-3">
            <label for="customerNotes" class="form-label">Ghi Chú</label>
            <textarea class="form-control" id="customerNotes" name="notes" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" form="addCustomerForm" class="btn btn-primary">Lưu Khách Hàng</button>
      </div>
    </div>
  </div>
</div>





<style>
.avatar-initial {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}
</style>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>