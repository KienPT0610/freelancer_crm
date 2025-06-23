<?php
// Set variables for the layout
$page_title = 'Chi Tiết Tương Tác';
$active_page = 'interactions';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="mb-1">Chi Tiết Tương Tác</h4>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/interactions">Tương Tác</a></li>
        <li class="breadcrumb-item active">Chi Tiết</li>
      </ol>
    </nav>
  </div>
  <div>
    <a href="/admin/interactions" class="btn btn-outline-secondary me-2">
      <i class="fas fa-arrow-left me-1"></i> Quay Lại
    </a>
    <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cog me-1"></i> Thao Tác
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editInteractionModal"><i
              class="fas fa-edit me-2"></i> Chỉnh Sửa</button></li>
        <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteInteractionModal"><i
              class="fas fa-trash me-2"></i> Xóa</button></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> Xuất PDF</a></li>
      </ul>
    </div>
  </div>
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

<div class="row">
  <!-- Interaction Details -->
  <div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thông Tin Tương Tác</h5>
        <span class="badge <?php 
          if ($interaction['interaction_type'] == 'email') echo 'bg-warning';
          elseif ($interaction['interaction_type'] == 'phone') echo 'bg-primary';
          elseif ($interaction['interaction_type'] == 'meeting') echo 'bg-success';
          else echo 'bg-secondary';
        ?> p-2">
          <i class="fas <?php 
            if ($interaction['interaction_type'] == 'email') echo 'fa-envelope';
            elseif ($interaction['interaction_type'] == 'phone') echo 'fa-phone-alt';
            elseif ($interaction['interaction_type'] == 'meeting') echo 'fa-handshake';
            else echo 'fa-comment';
          ?> me-1"></i>
          <?php echo ucfirst($interaction['interaction_type']); ?>
        </span>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3 text-muted">Mã Tương Tác:</div>
          <div class="col-md-9 fw-bold">#<?php echo str_pad($interaction['interaction_id'], 5, '0', STR_PAD_LEFT); ?>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 text-muted">Khách Hàng:</div>
          <div class="col-md-9">
            <a href="/admin/customers/<?php echo $interaction['customer_id']; ?>" class="text-decoration-none fw-bold">
              <?php echo $customer['name']; ?>
            </a>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 text-muted">Ngày Tương Tác:</div>
          <div class="col-md-9"><?php echo date('d/m/Y', strtotime($interaction['interaction_date'])); ?></div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 text-muted">Loại Tương Tác:</div>
          <div class="col-md-9"><?php 
            if ($interaction['interaction_type'] == 'email') echo 'Email';
            elseif ($interaction['interaction_type'] == 'phone') echo 'Cuộc Gọi';
            elseif ($interaction['interaction_type'] == 'meeting') echo 'Cuộc Họp';
            else echo 'Khác';
          ?></div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 text-muted">Người Tạo:</div>
          <div class="col-md-9">
            <span class="d-inline-flex align-items-center">
              <img src="/public/assets/images/avatar.png" alt="Admin" class="rounded-circle me-2" width="30">
              Admin
            </span>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 text-muted">Thời Gian Tạo:</div>
          <div class="col-md-9"><?php echo date('d/m/Y H:i', strtotime($interaction['created_at'])); ?></div>
        </div>

        <hr class="my-4">

        <div class="row mb-4">
          <div class="col-md-12">
            <h6 class="fw-bold mb-3">Nội Dung Chi Tiết:</h6>
            <div class="p-3 bg-light rounded">
              <?php echo nl2br(htmlspecialchars($interaction['summary'])); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Related Interactions -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Tương Tác Liên Quan Với Khách Hàng Này</h5>
      </div>
      <div class="card-body p-0">
        <div class="list-group list-group-flush">
          <?php foreach ($relatedInteractions as $relatedInteraction): ?>
          <?php if ($relatedInteraction['interaction_id'] != $interaction['interaction_id']): ?>
          <a href="/admin/interactions/<?php echo $relatedInteraction['interaction_id']; ?>"
            class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between align-items-center">
              <div>
                <span class="badge <?php 
                      if ($relatedInteraction['interaction_type'] == 'email') echo 'bg-warning';
                      elseif ($relatedInteraction['interaction_type'] == 'phone') echo 'bg-primary';
                      elseif ($relatedInteraction['interaction_type'] == 'meeting') echo 'bg-success';
                      else echo 'bg-secondary';
                    ?> me-2"><?php echo ucfirst($relatedInteraction['interaction_type']); ?></span>
                <span
                  class="fw-semibold"><?php echo mb_strimwidth($relatedInteraction['summary'], 0, 50, '...'); ?></span>
              </div>
              <small
                class="text-muted"><?php echo date('d/m/Y', strtotime($relatedInteraction['interaction_date'])); ?></small>
            </div>
          </a>
          <?php endif; ?>
          <?php endforeach; ?>

          <?php if (count($relatedInteractions) <= 1): ?>
          <div class="list-group-item text-center text-muted py-4">
            <i class="fas fa-info-circle me-2"></i> Không có tương tác nào khác với khách hàng này.
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Sidebar -->
  <div class="col-lg-4">
    <!-- Customer Info -->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thông Tin Khách Hàng</h5>
        <a href="/admin/customers/<?php echo $customer['customer_id']; ?>" class="btn btn-sm btn-outline-primary">
          <i class="fas fa-external-link-alt me-1"></i> Xem
        </a>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <div class="flex-shrink-0">
            <div class="avatar-circle bg-primary text-white">
              <?php echo strtoupper(substr($customer['name'], 0, 1)); ?>
            </div>
          </div>
          <div class="ms-3">
            <h6 class="fw-bold mb-0"><?php echo $customer['name']; ?></h6>
            <div class="small text-muted"><?php echo $customer['company'] ?? 'Không có'; ?></div>
          </div>
        </div>

        <?php if (!empty($customer['email'])): ?>
        <div class="mb-2">
          <i class="fas fa-envelope text-muted me-2"></i> <?php echo $customer['email']; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($customer['phone'])): ?>
        <div class="mb-2">
          <i class="fas fa-phone text-muted me-2"></i> <?php echo $customer['phone']; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($customer['address'])): ?>
        <div class="mb-2">
          <i class="fas fa-map-marker-alt text-muted me-2"></i> <?php echo $customer['address']; ?>
        </div>
        <?php endif; ?>

        <hr>

        <div class="mb-2">
          <span class="text-muted">Trạng Thái:</span>
          <span class="badge <?php 
            if ($customer['status'] == 'Active') echo 'bg-success';
            elseif ($customer['status'] == 'Potential') echo 'bg-warning';
            elseif ($customer['status'] == 'OnHold') echo 'bg-secondary';
            else echo 'bg-primary';
          ?>">
            <?php 
              if ($customer['status'] == 'Active') echo 'Đang Hoạt Động';
              elseif ($customer['status'] == 'Potential') echo 'Tiềm Năng';
              elseif ($customer['status'] == 'OnHold') echo 'Tạm Dừng';
              else echo $customer['status'];
            ?>
          </span>
        </div>

        <?php if (!empty($customer['tags'])): ?>
        <div class="mt-3">
          <?php foreach (explode(',', $customer['tags']) as $tag): ?>
          <span class="badge bg-light text-dark me-1"><?php echo trim($tag); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Thao Tác Nhanh</h5>
      </div>
      <div class="card-body">
        <div class="d-grid gap-2">
          <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addFollowupModal">
            <i class="fas fa-reply me-2"></i> Tạo Tương Tác Tiếp Theo
          </button>

          <a href="/admin/customers/<?php echo $customer['customer_id']; ?>" class="btn btn-outline-info">
            <i class="fas fa-user me-2"></i> Xem Hồ Sơ Khách Hàng
          </a>

          <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addProjectModal">
            <i class="fas fa-project-diagram me-2"></i> Tạo Dự Án
          </button>

          <button class="btn btn-outline-secondary">
            <i class="fas fa-file-export me-2"></i> Xuất Thông Tin
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Interaction Modal -->
<div class="modal fade" id="editInteractionModal" tabindex="-1" aria-labelledby="editInteractionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editInteractionModalLabel">Chỉnh Sửa Tương Tác</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editInteractionForm" action="/admin/interactions/<?php echo $interaction['interaction_id']; ?>/update"
          method="POST">
          <div class="mb-3">
            <label for="editInteractionType" class="form-label">Loại Tương Tác</label>
            <select class="form-select" id="editInteractionType" name="interaction_type" required>
              <option value="Email" <?php if ($interaction['interaction_type'] == 'Email') echo 'selected'; ?>>Email
              </option>
              <option value="Phone" <?php if ($interaction['interaction_type'] == 'Call') echo 'selected'; ?>>Call
              </option>
              <option value="Meeting" <?php if ($interaction['interaction_type'] == 'Meeting') echo 'selected'; ?>>
                Meeting</option>
              <option value="Other" <?php if ($interaction['interaction_type'] == 'Other') echo 'selected'; ?>>Khác
              </option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editInteractionDate" class="form-label">Ngày Tương Tác</label>
            <input type="date" class="form-control" id="editInteractionDate" name="interaction_date"
              value="<?php echo date('Y-m-d', strtotime($interaction['interaction_date'])); ?>" required>
          </div>
          <div class="mb-3">
            <label for="editInteractionSummary" class="form-label">Nội Dung</label>
            <textarea class="form-control" id="editInteractionSummary" name="summary" rows="5"
              required><?php echo htmlspecialchars($interaction['summary']); ?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" form="editInteractionForm" class="btn btn-primary">Lưu Thay Đổi</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Interaction Modal -->
<div class="modal fade" id="deleteInteractionModal" tabindex="-1" aria-labelledby="deleteInteractionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="deleteInteractionModalLabel">Xóa Tương Tác</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning">
          <i class="fas fa-exclamation-triangle me-2"></i> Bạn có chắc chắn muốn xóa tương tác này không? Hành động này
          không thể hoàn tác.
        </div>
        <p>Tương tác sẽ bị xóa vĩnh viễn khỏi hệ thống và sẽ không thể khôi phục được. Hãy đảm bảo rằng bạn đã lưu tất
          cả thông tin quan trọng trước khi xóa.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <a href="/admin/interactions/<?php echo $interaction['interaction_id']; ?>/delete" class="btn btn-danger">Xóa
          Tương Tác</a>
      </div>
    </div>
  </div>
</div>

<!-- Add Follow-up Interaction Modal -->
<div class="modal fade" id="addFollowupModal" tabindex="-1" aria-labelledby="addFollowupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFollowupModalLabel">Tạo Tương Tác Tiếp Theo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addFollowupForm" action="/admin/customers/<?php echo $customer['customer_id']; ?>/interactions/add"
          method="POST">
          <div class="mb-3">
            <label for="followupType" class="form-label">Loại Tương Tác</label>
            <select class="form-select" id="followupType" name="interaction_type" required>
              <option value="email">Email</option>
              <option value="phone">Cuộc Gọi</option>
              <option value="meeting">Cuộc Họp</option>
              <option value="other">Khác</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="followupDate" class="form-label">Ngày Tương Tác</label>
            <input type="date" class="form-control" id="followupDate" name="interaction_date"
              value="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <div class="mb-3">
            <label for="followupSummary" class="form-label">Nội Dung</label>
            <textarea class="form-control" id="followupSummary" name="summary" rows="5" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" form="addFollowupForm" class="btn btn-primary">Tạo Tương Tác</button>
      </div>
    </div>
  </div>
</div>

<style>
.avatar-circle {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}
</style>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>