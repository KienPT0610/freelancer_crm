<?php
// Set variables for the layout
$page_title = 'Hồ Sơ Cá Nhân';
$active_page = 'profile';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Thông Tin Tài Khoản</h4>
  <button class="btn btn-primary" id="saveChangesBtn">
    <i class="fas fa-save me-2"></i> Lưu Thay Đổi
  </button>
</div>

<div class="row">
  <!-- Profile Information -->
  <div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Thông Tin Cá Nhân</h5>
      </div>
      <div class="card-body">
        <form id="profileForm">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="fullName" class="form-label">Họ Tên</label>
              <input type="text" class="form-control" id="fullName" name="fullName" value="Admin User">
            </div>
            <div class="col-md-6">
              <label for="jobTitle" class="form-label">Chức Vụ</label>
              <input type="text" class="form-control" id="jobTitle" name="jobTitle" value="Quản Trị Viên">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="admin@example.com">
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Số Điện Thoại</label>
              <input type="text" class="form-control" id="phone" name="phone" value="0901234567">
            </div>
          </div>
          <div class="mb-3">
            <label for="bio" class="form-label">Giới Thiệu</label>
            <textarea class="form-control" id="bio" name="bio" rows="3">Quản trị viên hệ thống với hơn 5 năm kinh nghiệm trong lĩnh vực quản lý dự án và phát triển website.</textarea>
          </div>
        </form>
      </div>
    </div>

    <!-- Change Password -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Đổi Mật Khẩu</h5>
      </div>
      <div class="card-body">
        <form id="passwordForm">
          <div class="mb-3">
            <label for="currentPassword" class="form-label">Mật Khẩu Hiện Tại</label>
            <input type="password" class="form-control" id="currentPassword" name="currentPassword">
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="newPassword" class="form-label">Mật Khẩu Mới</label>
              <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <div class="col-md-6">
              <label for="confirmPassword" class="form-label">Xác Nhận Mật Khẩu</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>
          </div>
          <div class="password-requirements small text-muted">
            <p class="mb-1">Mật khẩu phải có ít nhất:</p>
            <ul class="mb-0">
              <li>8 ký tự</li>
              <li>Một chữ hoa</li>
              <li>Một chữ thường</li>
              <li>Một số</li>
              <li>Một ký tự đặc biệt</li>
            </ul>
          </div>
          <div class="mt-3">
            <button type="button" class="btn btn-outline-primary" id="changePasswordBtn">Đổi Mật Khẩu</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Notification Settings -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Cài Đặt Thông Báo</h5>
      </div>
      <div class="card-body">
        <form id="notificationForm">
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
            <label class="form-check-label" for="emailNotifications">Nhận thông báo qua email</label>
          </div>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="newContactNotifications" checked>
            <label class="form-check-label" for="newContactNotifications">Thông báo khi có liên hệ mới</label>
          </div>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="newProjectNotifications" checked>
            <label class="form-check-label" for="newProjectNotifications">Thông báo khi có dự án mới</label>
          </div>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="reminderNotifications" checked>
            <label class="form-check-label" for="reminderNotifications">Thông báo nhắc nhở</label>
          </div>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="marketingNotifications">
            <label class="form-check-label" for="marketingNotifications">Thông báo tiếp thị và cập nhật</label>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Profile Sidebar -->
  <div class="col-lg-4">
    <!-- Profile Photo -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Ảnh Đại Diện</h5>
      </div>
      <div class="card-body d-flex flex-column align-items-center text-center">
        <div class="position-relative mb-3">
          <img src="../../../public/assets/images/avatar.png" alt="Profile photo" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
          <div class="position-absolute bottom-0 end-0">
            <button class="btn btn-sm btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#changePhotoModal">
              <i class="fas fa-camera"></i>
            </button>
          </div>
        </div>
        <h5 class="mb-1">Admin User</h5>
        <p class="text-muted">Quản Trị Viên</p>
        <div class="mt-2">
          <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#removePhotoModal">
            <i class="fas fa-trash me-1"></i> Xóa Ảnh
          </button>
        </div>
      </div>
    </div>

    <!-- Account Information -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Thông Tin Tài Khoản</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Trạng Thái Tài Khoản</span>
            <span class="badge bg-success">Hoạt Động</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Ngày Tham Gia</span>
            <span>01/01/2023</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Đăng Nhập Cuối</span>
            <span>Hôm nay, 09:45</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            <span>Cấp Độ Tài Khoản</span>
            <span class="badge bg-primary">Admin</span>
          </li>
          <li class="list-group-item px-0">
            <button class="btn btn-sm btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#twoFactorModal">
              <i class="fas fa-shield-alt me-1"></i> Cài Đặt Xác Thực 2 Lớp
            </button>
          </li>
        </ul>
      </div>
    </div>

    <!-- Session Management -->
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Quản Lý Phiên Đăng Nhập</h5>
      </div>
      <div class="card-body">
        <div class="active-session mb-3 p-2 border rounded">
          <div class="d-flex align-items-center">
            <i class="fas fa-desktop me-2 text-primary"></i>
            <div>
              <div class="fw-bold">Windows - Chrome</div>
              <div class="small text-muted">Hiện tại • 192.168.1.1</div>
            </div>
          </div>
        </div>
        <div class="other-session mb-3 p-2 border rounded">
          <div class="d-flex align-items-center">
            <i class="fas fa-mobile-alt me-2"></i>
            <div>
              <div>Android - Chrome Mobile</div>
              <div class="small text-muted">Hôm qua • 192.168.1.10</div>
            </div>
            <button class="btn btn-sm btn-outline-danger ms-auto">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </div>
        </div>
        <button class="btn btn-outline-danger btn-sm w-100">
          <i class="fas fa-power-off me-1"></i> Đăng Xuất Tất Cả Thiết Bị Khác
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Change Photo -->
<div class="modal fade" id="changePhotoModal" tabindex="-1" aria-labelledby="changePhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePhotoModalLabel">Thay Đổi Ảnh Đại Diện</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="uploadPhotoForm">
          <div class="mb-3">
            <label for="photoUpload" class="form-label">Chọn Ảnh</label>
            <input class="form-control" type="file" id="photoUpload" accept="image/*">
          </div>
          <div class="mb-3 d-none" id="previewContainer">
            <label class="form-label">Xem Trước</label>
            <div class="text-center">
              <img id="photoPreview" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary" id="uploadPhotoBtn">Tải Lên</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Remove Photo -->
<div class="modal fade" id="removePhotoModal" tabindex="-1" aria-labelledby="removePhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removePhotoModalLabel">Xác Nhận Xóa Ảnh</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa ảnh đại diện hiện tại? Thao tác này không thể hoàn tác.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-danger">Xóa Ảnh</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Two Factor -->
<div class="modal fade" id="twoFactorModal" tabindex="-1" aria-labelledby="twoFactorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="twoFactorModalLabel">Xác Thực Hai Lớp</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-4">
          <div class="mb-3">
            <i class="fas fa-shield-alt display-1 text-primary"></i>
          </div>
          <h5>Tăng Cường Bảo Mật Tài Khoản</h5>
          <p class="text-muted">Xác thực hai lớp giúp bảo vệ tài khoản của bạn khỏi các truy cập trái phép.</p>
        </div>
        
        <div class="mb-4">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="twoFactorType" id="emailAuth" checked>
            <label class="form-check-label" for="emailAuth">
              <i class="fas fa-envelope me-2"></i> Xác thực qua Email
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="twoFactorType" id="smsAuth">
            <label class="form-check-label" for="smsAuth">
              <i class="fas fa-sms me-2"></i> Xác thực qua SMS
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="twoFactorType" id="appAuth">
            <label class="form-check-label" for="appAuth">
              <i class="fas fa-mobile-alt me-2"></i> Xác thực qua Ứng dụng (Google Authenticator)
            </label>
          </div>
        </div>
        
        <div class="alert alert-warning">
          <i class="fas fa-exclamation-triangle me-2"></i>
          Lưu ý: Sau khi bật xác thực hai lớp, bạn sẽ cần nhập mã xác nhận mỗi lần đăng nhập vào hệ thống.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary">Tiếp Tục</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Xử lý xem trước ảnh
  const photoUpload = document.getElementById('photoUpload');
  const photoPreview = document.getElementById('photoPreview');
  const previewContainer = document.getElementById('previewContainer');
  
  photoUpload.addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        photoPreview.src = e.target.result;
        previewContainer.classList.remove('d-none');
      }
      
      reader.readAsDataURL(e.target.files[0]);
    }
  });
  
  // Xử lý đổi mật khẩu
  const newPassword = document.getElementById('newPassword');
  const confirmPassword = document.getElementById('confirmPassword');
  const changePasswordBtn = document.getElementById('changePasswordBtn');
  
  changePasswordBtn.addEventListener('click', function() {
    // Kiểm tra mật khẩu hiện tại
    if (!document.getElementById('currentPassword').value) {
      alert('Vui lòng nhập mật khẩu hiện tại');
      return;
    }
    
    // Kiểm tra mật khẩu mới
    if (!newPassword.value) {
      alert('Vui lòng nhập mật khẩu mới');
      return;
    }
    
    // Kiểm tra xác nhận mật khẩu
    if (newPassword.value !== confirmPassword.value) {
      alert('Xác nhận mật khẩu không khớp');
      return;
    }
    
    // Đổi mật khẩu thành công
    alert('Đổi mật khẩu thành công');
    
    // Reset form
    document.getElementById('passwordForm').reset();
  });
  
  // Xử lý lưu thay đổi
  document.getElementById('saveChangesBtn').addEventListener('click', function() {
    alert('Thông tin cá nhân đã được cập nhật!');
  });
});
</script>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?> 