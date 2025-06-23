<?php
// Set variables for the layout
$page_title = 'Quản Lý Nội Dung';
$active_page = 'site_content';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Quản Lý Nội Dung Website</h4>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContentModal">
    <i class="fas fa-plus me-2"></i> Thêm Nội Dung Mới
  </button>
</div>

<?php if (isset($_SESSION['success'])): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fas fa-check-circle me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fas fa-exclamation-circle me-2"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Content Search and Filter -->
<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-8">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm nội dung...">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <div class="col-md-3">
        <select class="form-select" id="statusFilter">
          <option value="">Tất Cả Trạng Thái</option>
          <option value="1">Đang Hoạt Động</option>
          <option value="0">Không Hoạt Động</option>
        </select>
      </div>
      <div class="col-md-1">
        <button class="btn btn-outline-secondary w-100" id="resetFilters">
          <i class="fas fa-redo"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Content List -->
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Danh Sách Nội Dung</span>
    <div>
      <button class="btn btn-sm btn-outline-primary me-2">
        <i class="fas fa-download me-1"></i> Xuất CSV
      </button>
      <div class="dropdown d-inline-block">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-cog me-1"></i> Thao Tác
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#"><i class="fas fa-check-square me-2"></i> Kích Hoạt Hàng Loạt</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-ban me-2"></i> Vô Hiệu Hóa Hàng Loạt</a></li>
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
            <th>Mã Nội Dung</th>
            <!-- <th>Tiêu Đề</th> -->
            <th>Khóa (Key)</th>
            <th>Giá Trị</th>
            <th>Trạng Thái</th>
            <th>Cập Nhật Lần Cuối</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($contents)): ?>
          <tr>
            <td colspan="8" class="text-center py-4">
              <div class="text-muted mb-1"><i class="fas fa-info-circle me-2"></i> Không có nội dung nào.</div>
              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addContentModal">
                Thêm Nội Dung Mới
              </button>
            </td>
          </tr>
          <?php else: ?>
          <?php foreach ($contents as $content): ?>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php echo $content['content_id']; ?>">
              </div>
            </td>
            <td>
              <span class="fw-bold">#<?php echo str_pad($content['content_id'], 4, '0', STR_PAD_LEFT); ?></span>
            </td>
            <td>
              <span class="badge bg-secondary"><?php echo htmlspecialchars($content['content_key']); ?></span>
            </td>
            <td>
              <?php 
                // Display a preview of content value
                $value = htmlspecialchars($content['content_value']);
                echo strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value;
              ?>
            </td>
            <td>
              <?php if ($content['is_active'] == 1): ?>
              <span class="badge bg-success">Đang Hoạt Động</span>
              <?php else: ?>
              <span class="badge bg-danger">Không Hoạt Động</span>
              <?php endif; ?>
            </td>
            <td><?php echo date('d/m/Y H:i', strtotime($content['last_updated'] ?? $content['created_at'])); ?></td>
            <td>
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                  data-bs-target="#editContentModal" data-content-id="<?php echo $content['content_id']; ?>"
                  data-content-key="<?php echo htmlspecialchars($content['content_key']); ?>"
                  data-content-value="<?php echo htmlspecialchars($content['content_value']); ?>"
                  data-is-active="<?php echo $content['is_active']; ?>">
                  <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                  data-bs-target="#viewContentModal" data-content-id="<?php echo $content['content_id']; ?>"
                  data-content-key="<?php echo htmlspecialchars($content['content_key']); ?>"
                  data-content-value="<?php echo htmlspecialchars($content['content_value']); ?>"
                  data-is-active="<?php echo $content['is_active']; ?>"
                  data-created-at="<?php echo date('d/m/Y H:i', strtotime($content['last_updated'])); ?>"
                  data-updated-at="<?php echo !empty($content['last_updated']) ? date('d/m/Y H:i', strtotime($content['last_updated'])) : 'Chưa cập nhật'; ?>">
                  <i class="fas fa-eye"></i>
                </button>
                <a href="/admin/site-content/<?php echo $content['content_id']; ?>/delete"
                  class="btn btn-sm btn-outline-danger"
                  onclick="return confirm('Bạn có chắc chắn muốn xóa nội dung này?');">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
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

<!-- Modal Add Content -->
<div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addContentModalLabel">Thêm Nội Dung Mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addContentForm" action="/admin/site-content/add" method="POST">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="contentTitle" class="form-label">Tiêu Đề Nội Dung <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="contentTitle" name="content_title" required>
            </div>
            <div class="col-md-6">
              <label for="contentKey" class="form-label">Khóa (Key) <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="contentKey" name="content_key" required>
              <small class="text-muted">Sử dụng ký tự latin, số và dấu gạch dưới. Ví dụ: home_banner_title</small>
            </div>
          </div>
          <div class="mb-3">
            <label for="contentValue" class="form-label">Nội Dung <span class="text-danger">*</span></label>
            <textarea class="form-control" id="contentValue" name="content_value" rows="6" required></textarea>
            <small class="text-muted">Hỗ trợ HTML cơ bản cho định dạng văn bản</small>
          </div>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="contentActive" name="is_active" value="1" checked>
              <label class="form-check-label" for="contentActive">Kích Hoạt Nội Dung</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" form="addContentForm" class="btn btn-primary">Lưu Nội Dung</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Content -->
<div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editContentModalLabel">Chỉnh Sửa Nội Dung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editContentForm" action="/admin/site-content/update" method="POST">
          <input type="hidden" id="editContentId" name="content_id">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="editContentKey" class="form-label">Khóa (Key) <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="editContentKey" name="content_key" required>
              <small class="text-muted">Sử dụng ký tự latin, số và dấu gạch dưới. Ví dụ: home_banner_title</small>
            </div>
          </div>
          <div class="mb-3">
            <label for="editContentValue" class="form-label">Nội Dung <span class="text-danger">*</span></label>
            <textarea class="form-control" id="editContentValue" name="content_value" rows="6" required></textarea>
            <small class="text-muted">Hỗ trợ HTML cơ bản cho định dạng văn bản</small>
          </div>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="editContentActive" name="is_active" value="1">
              <label class="form-check-label" for="editContentActive">Kích Hoạt Nội Dung</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" form="editContentForm" class="btn btn-primary">Lưu Thay Đổi</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal View Content -->
<div class="modal fade" id="viewContentModal" tabindex="-1" aria-labelledby="viewContentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewContentModalLabel">Chi Tiết Nội Dung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-4">
          <div class="col-md-6">
            <h6 class="fw-bold mb-2">Thông Tin Cơ Bản</h6>
            <table class="table table-sm">
              <tr>
                <td class="text-muted">Mã Nội Dung:</td>
                <td class="fw-bold" id="viewContentId"></td>
              </tr>
              <tr>
                <td class="text-muted">Tiêu Đề:</td>
                <td id="viewContentTitle"></td>
              </tr>
              <tr>
                <td class="text-muted">Khóa (Key):</td>
                <td><code id="viewContentKey"></code></td>
              </tr>
              <tr>
                <td class="text-muted">Trạng Thái:</td>
                <td id="viewContentStatus"></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <h6 class="fw-bold mb-2">Thông Tin Thời Gian</h6>
            <table class="table table-sm">
              <tr>
                <td class="text-muted">Ngày Tạo:</td>
                <td id="viewContentCreated"></td>
              </tr>
              <tr>
                <td class="text-muted">Cập Nhật Lần Cuối:</td>
                <td id="viewContentUpdated"></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="mb-3">
          <h6 class="fw-bold mb-2">Nội Dung</h6>
          <div class="border rounded p-3 bg-light">
            <div id="viewContentValueDisplay"></div>
          </div>
        </div>
        <div class="mb-3">
          <h6 class="fw-bold mb-2">Mã Sử Dụng</h6>
          <div class="border rounded p-3 bg-dark text-light">
            <pre
              class="mb-0"><code>&lt;?php echo getSiteContent('<span id="viewContentKeyCode"></span>'); ?&gt;</code></pre>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary edit-content-btn">Chỉnh Sửa</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Select all checkbox
  const selectAllCheckbox = document.getElementById('selectAll');
  if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', function() {
      const checkboxes = document.querySelectorAll('tbody .form-check-input');
      checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
      });
    });
  }

  // Edit Content Modal
  const editContentModal = document.getElementById('editContentModal');
  if (editContentModal) {
    editContentModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const contentId = button.getAttribute('data-content-id');
      const contentTitle = button.getAttribute('data-content-title');
      const contentKey = button.getAttribute('data-content-key');
      const contentValue = button.getAttribute('data-content-value');
      const isActive = button.getAttribute('data-is-active');

      const modalContentId = editContentModal.querySelector('#editContentId');
      const modalContentTitle = editContentModal.querySelector('#editContentTitle');
      const modalContentKey = editContentModal.querySelector('#editContentKey');
      const modalContentValue = editContentModal.querySelector('#editContentValue');
      const modalContentActive = editContentModal.querySelector('#editContentActive');

      modalContentId.value = contentId;
      modalContentTitle.value = contentTitle;
      modalContentKey.value = contentKey;
      modalContentValue.value = contentValue;
      modalContentActive.checked = isActive == '1';

      // Update form action
      const form = editContentModal.querySelector('#editContentForm');
      form.action = `/admin/site-content/${contentId}/update`;
      form.querySelector('button[type="submit"]').addEventListener('click', function() {
        form.submit();
      });
    });
  }

  // View Content Modal
  const viewContentModal = document.getElementById('viewContentModal');
  if (viewContentModal) {
    viewContentModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const contentId = button.getAttribute('data-content-id');
      const contentTitle = button.getAttribute('data-content-title');
      const contentKey = button.getAttribute('data-content-key');
      const contentValue = button.getAttribute('data-content-value');
      const isActive = button.getAttribute('data-is-active');
      const createdAt = button.getAttribute('data-created-at');
      const updatedAt = button.getAttribute('data-updated-at');

      viewContentModal.querySelector('#viewContentId').textContent = '#' + contentId.padStart(4, '0');
      viewContentModal.querySelector('#viewContentTitle').textContent = contentTitle;
      viewContentModal.querySelector('#viewContentKey').textContent = contentKey;
      viewContentModal.querySelector('#viewContentKeyCode').textContent = contentKey;
      viewContentModal.querySelector('#viewContentValueDisplay').innerHTML = contentValue;
      viewContentModal.querySelector('#viewContentCreated').textContent = createdAt;
      viewContentModal.querySelector('#viewContentUpdated').textContent = updatedAt;

      const statusEl = viewContentModal.querySelector('#viewContentStatus');
      if (isActive == '1') {
        statusEl.innerHTML = '<span class="badge bg-success">Đang Hoạt Động</span>';
      } else {
        statusEl.innerHTML = '<span class="badge bg-danger">Không Hoạt Động</span>';
      }

      // Setup edit button
      const editBtn = viewContentModal.querySelector('.edit-content-btn');
      editBtn.addEventListener('click', function() {
        // Hide view modal
        const viewModal = bootstrap.Modal.getInstance(viewContentModal);
        viewModal.hide();

        // Show edit modal with pre-filled data
        const editModal = new bootstrap.Modal(document.getElementById('editContentModal'));

        // Pre-fill the edit modal
        const editForm = document.getElementById('editContentForm');
        editForm.querySelector('#editContentId').value = contentId;
        editForm.querySelector('#editContentTitle').value = contentTitle;
        editForm.querySelector('#editContentKey').value = contentKey;
        editForm.querySelector('#editContentValue').value = contentValue;
        editForm.querySelector('#editContentActive').checked = isActive == '1';
        editForm.action = `/admin/site-content/${contentId}/update`;

        // Show edit modal
        editModal.show();
      });
    });
  }

  // Reset filters
  const resetBtn = document.getElementById('resetFilters');
  if (resetBtn) {
    resetBtn.addEventListener('click', function() {
      document.querySelector('input[type="text"]').value = '';
      document.getElementById('statusFilter').value = '';
    });
  }
});
</script>

<style>
pre {
  margin-bottom: 0;
  white-space: pre-wrap;
}

code {
  font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  font-size: 0.875em;
}
</style>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>