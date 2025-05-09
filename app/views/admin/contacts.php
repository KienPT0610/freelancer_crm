<?php
// Set variables for the layout
$page_title = 'Liên Hệ';
$active_page = 'contacts';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Quản Lý Liên Hệ</h4>
  <div>
    <button class="btn btn-outline-primary me-2" id="markAsReadBtn" disabled>
      <i class="fas fa-check me-2"></i> Đánh Dấu Đã Đọc
    </button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyContactModal" disabled id="replyBtn">
      <i class="fas fa-reply me-2"></i> Trả Lời
    </button>
  </div>
</div>

<!-- Contacts Search and Filter -->
<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm liên hệ...">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option value="">Tất Cả Trạng Thái</option>
          <option value="unread">Chưa Đọc</option>
          <option value="read">Đã Đọc</option>
          <option value="replied">Đã Trả Lời</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option value="">Sắp Xếp Theo</option>
          <option value="newest">Mới Nhất</option>
          <option value="oldest">Cũ Nhất</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">Đặt Lại</button>
      </div>
    </div>
  </div>
</div>

<!-- Contacts List -->
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Danh Sách Liên Hệ</span>
    <div>
      <button class="btn btn-sm btn-outline-primary me-2">
        <i class="fas fa-download me-1"></i> Xuất Excel
      </button>
      <div class="dropdown d-inline-block">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-cog me-1"></i> Thao Tác
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Xóa Đã Chọn</a></li>
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
            <th>Tên</th>
            <th>Email</th>
            <th>Chủ Đề</th>
            <th>Nội Dung</th>
            <th>Ngày Gửi</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
          <tr class="unread-row">
            <td>
              <div class="form-check">
                <input class="form-check-input contact-checkbox" type="checkbox">
              </div>
            </td>
            <td>
              <div class="fw-bold">Nguyễn Văn A</div>
            </td>
            <td>nguyenvana@example.com</td>
            <td>Tư vấn dịch vụ</td>
            <td class="text-truncate" style="max-width: 200px;">Tôi muốn tìm hiểu về dịch vụ thiết kế website của công
              ty...</td>
            <td>2 giờ trước</td>
            <td><span class="badge bg-danger">Chưa đọc</span></td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-primary view-contact"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-info reply-contact"><i class="fas fa-reply"></i></a>
                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <tr class="unread-row">
            <td>
              <div class="form-check">
                <input class="form-check-input contact-checkbox" type="checkbox">
              </div>
            </td>
            <td>
              <div class="fw-bold">Trần Thị B</div>
            </td>
            <td>tranthib@example.com</td>
            <td>Giải pháp thương mại điện tử</td>
            <td class="text-truncate" style="max-width: 200px;">Cần tư vấn về giải pháp thương mại điện tử cho cửa hàng
              của tôi...</td>
            <td>5 giờ trước</td>
            <td><span class="badge bg-danger">Chưa đọc</span></td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-primary view-contact"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-info reply-contact"><i class="fas fa-reply"></i></a>
                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input contact-checkbox" type="checkbox">
              </div>
            </td>
            <td>
              <div>Công Ty XYZ</div>
            </td>
            <td>contact@xyz.com</td>
            <td>Tìm đối tác phát triển phần mềm</td>
            <td class="text-truncate" style="max-width: 200px;">Chúng tôi cần một đối tác phát triển phần mềm dài hạn
              cho dự án của công ty...</td>
            <td>1 ngày trước</td>
            <td><span class="badge bg-success">Đã đọc</span></td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-primary view-contact"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-info reply-contact"><i class="fas fa-reply"></i></a>
                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input contact-checkbox" type="checkbox">
              </div>
            </td>
            <td>
              <div>Lê Văn C</div>
            </td>
            <td>levanc@example.com</td>
            <td>Báo giá ứng dụng di động</td>
            <td class="text-truncate" style="max-width: 200px;">Tôi cần báo giá cho một dự án ứng dụng di động theo yêu
              cầu đính kèm...</td>
            <td>2 ngày trước</td>
            <td><span class="badge bg-primary">Đã trả lời</span></td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-primary view-contact"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-info reply-contact"><i class="fas fa-reply"></i></a>
                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input contact-checkbox" type="checkbox">
              </div>
            </td>
            <td>
              <div>Phạm Thị D</div>
            </td>
            <td>phamthid@example.com</td>
            <td>Dịch vụ quản trị website</td>
            <td class="text-truncate" style="max-width: 200px;">Tôi đang tìm kiếm dịch vụ quản trị website cho shop thời
              trang...</td>
            <td>4 ngày trước</td>
            <td><span class="badge bg-primary">Đã trả lời</span></td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-primary view-contact"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-info reply-contact"><i class="fas fa-reply"></i></a>
                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
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

<!-- Modal xem chi tiết liên hệ -->
<div class="modal fade" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewContactModalLabel">Chi Tiết Liên Hệ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-4">
          <div class="col-md-6">
            <h6>Thông Tin Người Gửi</h6>
            <table class="table table-sm">
              <tr>
                <th style="width: 120px;">Họ Tên:</th>
                <td id="contactName">Nguyễn Văn A</td>
              </tr>
              <tr>
                <th>Email:</th>
                <td id="contactEmail">nguyenvana@example.com</td>
              </tr>
              <tr>
                <th>Điện Thoại:</th>
                <td id="contactPhone">0901234567</td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <h6>Thông Tin Liên Hệ</h6>
            <table class="table table-sm">
              <tr>
                <th style="width: 120px;">Ngày Gửi:</th>
                <td id="contactDate">20/11/2023 14:30</td>
              </tr>
              <tr>
                <th>Trạng Thái:</th>
                <td id="contactStatus"><span class="badge bg-danger">Chưa đọc</span></td>
              </tr>
              <tr>
                <th>IP:</th>
                <td id="contactIP">123.45.67.89</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="mb-4">
          <h6>Chủ Đề</h6>
          <p id="contactSubject" class="p-2 border rounded bg-light">Tư vấn dịch vụ</p>
        </div>
        <div class="mb-4">
          <h6>Nội Dung</h6>
          <div id="contactMessage" class="p-3 border rounded bg-light" style="min-height: 120px;">
            Tôi muốn tìm hiểu về dịch vụ thiết kế website của công ty. Tôi đang có nhu cầu xây dựng một website
            giới thiệu sản phẩm cho công ty mới thành lập. Mong được tư vấn về các gói dịch vụ, chi phí và thời gian
            thực hiện.
            <br><br>
            Cảm ơn và mong sớm nhận được phản hồi!
          </div>
        </div>
        <div id="contactReplyHistory" class="mb-0">
          <h6>Lịch Sử Trả Lời</h6>
          <div class="alert alert-info">
            Chưa có phản hồi nào cho liên hệ này.
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-success" id="markReadBtn">Đánh Dấu Đã Đọc</button>
        <button type="button" class="btn btn-primary" id="quickReplyBtn">Trả Lời</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal trả lời liên hệ -->
<div class="modal fade" id="replyContactModal" tabindex="-1" aria-labelledby="replyContactModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="replyContactModalLabel">Trả Lời Liên Hệ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="replyTo" class="form-label">Người Nhận</label>
              <input type="text" class="form-control" id="replyTo" value="Nguyễn Văn A <nguyenvana@example.com>"
                readonly>
            </div>
            <div class="col-md-6">
              <label for="replyFrom" class="form-label">Từ</label>
              <input type="text" class="form-control" id="replyFrom" value="Support <support@yourcompany.com>" readonly>
            </div>
          </div>
          <div class="mb-3">
            <label for="replySubject" class="form-label">Chủ Đề</label>
            <input type="text" class="form-control" id="replySubject" value="Re: Tư vấn dịch vụ">
          </div>
          <div class="mb-3">
            <label for="replyTemplate" class="form-label">Mẫu Trả Lời</label>
            <select class="form-select" id="replyTemplate">
              <option value="">-- Chọn Mẫu --</option>
              <option value="template1">Xác Nhận Đã Nhận</option>
              <option value="template2">Thông Tin Báo Giá</option>
              <option value="template3">Lịch Hẹn Tư Vấn</option>
              <option value="template4">Cảm Ơn Liên Hệ</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="replyContent" class="form-label">Nội Dung</label>
            <textarea class="form-control" id="replyContent" rows="10">
Kính gửi Anh/Chị Nguyễn Văn A,

Cảm ơn Anh/Chị đã quan tâm đến dịch vụ của chúng tôi.

[Nội dung trả lời của bạn ở đây]

Mọi thắc mắc hoặc yêu cầu thêm, vui lòng liên hệ với chúng tôi qua email này hoặc số điện thoại 0901234567.

Trân trọng,
[Tên của bạn]
Freelancer CRM
            </textarea>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="sendMeCopy" checked>
              <label class="form-check-label" for="sendMeCopy">
                Gửi bản sao cho tôi
              </label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary">Gửi Trả Lời</button>
      </div>
    </div>
  </div>
</div>

<style>
.unread-row {
  font-weight: 500;
  background-color: rgba(13, 110, 253, 0.05);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Xử lý checkbox
  const selectAllCheckbox = document.getElementById('selectAll');
  const contactCheckboxes = document.querySelectorAll('.contact-checkbox');
  const markAsReadBtn = document.getElementById('markAsReadBtn');
  const replyBtn = document.getElementById('replyBtn');

  // Chọn tất cả
  selectAllCheckbox.addEventListener('change', function() {
    contactCheckboxes.forEach(checkbox => {
      checkbox.checked = this.checked;
    });
    updateButtonStates();
  });

  // Kiểm tra trạng thái từng checkbox
  contactCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      updateButtonStates();

      // Kiểm tra nếu tất cả đã được chọn
      const allChecked = Array.from(contactCheckboxes).every(cb => cb.checked);
      selectAllCheckbox.checked = allChecked;
    });
  });

  // Cập nhật trạng thái các nút
  function updateButtonStates() {
    const checkedCount = document.querySelectorAll('.contact-checkbox:checked').length;
    markAsReadBtn.disabled = checkedCount === 0;
    replyBtn.disabled = checkedCount !== 1;
  }

  // Mở modal xem chi tiết
  const viewButtons = document.querySelectorAll('.view-contact');
  viewButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const modal = new bootstrap.Modal(document.getElementById('viewContactModal'));
      modal.show();
    });
  });

  // Mở modal trả lời
  const replyButtons = document.querySelectorAll('.reply-contact');
  replyButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const modal = new bootstrap.Modal(document.getElementById('replyContactModal'));
      modal.show();
    });
  });

  // Nút trả lời nhanh trong modal xem chi tiết
  document.getElementById('quickReplyBtn').addEventListener('click', function() {
    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewContactModal'));
    viewModal.hide();

    setTimeout(() => {
      const replyModal = new bootstrap.Modal(document.getElementById('replyContactModal'));
      replyModal.show();
    }, 500);
  });

  // Xử lý template email
  document.getElementById('replyTemplate').addEventListener('change', function() {
    const templateId = this.value;
    let templateContent = '';

    if (templateId === 'template1') {
      templateContent = `Kính gửi Anh/Chị,

Chúng tôi đã nhận được thông tin liên hệ của Anh/Chị. 
Cảm ơn Anh/Chị đã quan tâm đến dịch vụ của chúng tôi.

Chúng tôi sẽ xem xét yêu cầu và phản hồi trong thời gian sớm nhất, thông thường trong vòng 24 giờ làm việc.

Trân trọng,
[Tên của bạn]
Freelancer CRM
Hotline: 0901234567`;
    } else if (templateId === 'template2') {
      templateContent = `Kính gửi Anh/Chị,

Cảm ơn Anh/Chị đã quan tâm đến dịch vụ của chúng tôi.

Dưới đây là thông tin báo giá cho dịch vụ mà Anh/Chị đã yêu cầu:

1. Gói cơ bản: X.XXX.XXX VNĐ
   - Tính năng 1
   - Tính năng 2
   - Tính năng 3

2. Gói nâng cao: XX.XXX.XXX VNĐ
   - Tất cả tính năng của gói cơ bản
   - Tính năng bổ sung 1
   - Tính năng bổ sung 2

Báo giá này có hiệu lực trong vòng 30 ngày.

Mọi thắc mắc, Anh/Chị vui lòng liên hệ với chúng tôi.

Trân trọng,
[Tên của bạn]
Freelancer CRM
Hotline: 0901234567`;
    }

    if (templateContent) {
      document.getElementById('replyContent').value = templateContent;
    }
  });
});
</script>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>