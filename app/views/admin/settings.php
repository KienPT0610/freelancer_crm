<?php
// Set variables for the layout
$page_title = 'Cài Đặt Hệ Thống';
$active_page = 'settings';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Quản Lý Cài Đặt</h4>
  <button class="btn btn-primary" id="saveSettingsBtn">
    <i class="fas fa-save me-2"></i> Lưu Thay Đổi
  </button>
</div>

<!-- Settings Tabs -->
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">
          <i class="fas fa-cog me-2"></i> Cài Đặt Chung
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab" aria-controls="email" aria-selected="false">
          <i class="fas fa-envelope me-2"></i> Cài Đặt Email
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="system-tab" data-bs-toggle="tab" data-bs-target="#system" type="button" role="tab" aria-controls="system" aria-selected="false">
          <i class="fas fa-server me-2"></i> Cài Đặt Hệ Thống
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">
          <i class="fas fa-shield-alt me-2"></i> Bảo Mật
        </button>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="settingsTabsContent">
      <!-- General Settings Tab -->
      <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <h5 class="mb-3">Thông Tin Cơ Bản</h5>
        <form id="generalSettingsForm">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="siteName" class="form-label">Tên Trang Web</label>
              <input type="text" class="form-control" id="siteName" name="siteName" value="Freelancer CRM">
            </div>
            <div class="col-md-6">
              <label for="siteDescription" class="form-label">Mô Tả Ngắn</label>
              <input type="text" class="form-control" id="siteDescription" name="siteDescription" value="Hệ thống quản lý khách hàng và dự án cho freelancer">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="contactEmail" class="form-label">Email Liên Hệ</label>
              <input type="email" class="form-control" id="contactEmail" name="contactEmail" value="contact@example.com">
            </div>
            <div class="col-md-6">
              <label for="contactPhone" class="form-label">Số Điện Thoại Liên Hệ</label>
              <input type="text" class="form-control" id="contactPhone" name="contactPhone" value="0901234567">
            </div>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Địa Chỉ</label>
            <textarea class="form-control" id="address" name="address" rows="2">123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</textarea>
          </div>
          
          <hr class="my-4">
          
          <h5 class="mb-3">Cài Đặt Hiển Thị</h5>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="pageSize" class="form-label">Số Mục Trên Mỗi Trang</label>
              <select class="form-select" id="pageSize" name="pageSize">
                <option value="10">10</option>
                <option value="20" selected>20</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="dateFormat" class="form-label">Định Dạng Ngày Tháng</label>
              <select class="form-select" id="dateFormat" name="dateFormat">
                <option value="d/m/Y" selected>DD/MM/YYYY (30/12/2023)</option>
                <option value="m/d/Y">MM/DD/YYYY (12/30/2023)</option>
                <option value="Y-m-d">YYYY-MM-DD (2023-12-30)</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="timezone" class="form-label">Múi Giờ</label>
              <select class="form-select" id="timezone" name="timezone">
                <option value="Asia/Ho_Chi_Minh" selected>Asia/Ho_Chi_Minh (GMT+7)</option>
                <option value="Asia/Bangkok">Asia/Bangkok (GMT+7)</option>
                <option value="Asia/Singapore">Asia/Singapore (GMT+8)</option>
                <option value="America/New_York">America/New_York (GMT-5)</option>
                <option value="Europe/London">Europe/London (GMT+0)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="language" class="form-label">Ngôn Ngữ</label>
              <select class="form-select" id="language" name="language">
                <option value="vi" selected>Tiếng Việt</option>
                <option value="en">English</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      
      <!-- Email Settings Tab -->
      <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
        <h5 class="mb-3">Cấu Hình Máy Chủ Email</h5>
        <form id="emailSettingsForm">
          <div class="mb-3">
            <label for="mailDriver" class="form-label">Driver</label>
            <select class="form-select" id="mailDriver" name="mailDriver">
              <option value="smtp" selected>SMTP</option>
              <option value="sendmail">Sendmail</option>
              <option value="mailgun">Mailgun</option>
            </select>
          </div>
          <div id="smtpSettings">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="smtpHost" class="form-label">SMTP Host</label>
                <input type="text" class="form-control" id="smtpHost" name="smtpHost" value="smtp.gmail.com">
              </div>
              <div class="col-md-6">
                <label for="smtpPort" class="form-label">SMTP Port</label>
                <input type="text" class="form-control" id="smtpPort" name="smtpPort" value="587">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="smtpUsername" class="form-label">SMTP Username</label>
                <input type="text" class="form-control" id="smtpUsername" name="smtpUsername" value="your-email@gmail.com">
              </div>
              <div class="col-md-6">
                <label for="smtpPassword" class="form-label">SMTP Password</label>
                <input type="password" class="form-control" id="smtpPassword" name="smtpPassword" value="password">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="smtpEncryption" class="form-label">Mã Hóa</label>
                <select class="form-select" id="smtpEncryption" name="smtpEncryption">
                  <option value="">Không</option>
                  <option value="tls" selected>TLS</option>
                  <option value="ssl">SSL</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="smtpAuth" class="form-label">Xác Thực</label>
                <select class="form-select" id="smtpAuth" name="smtpAuth">
                  <option value="1" selected>Có</option>
                  <option value="0">Không</option>
                </select>
              </div>
            </div>
          </div>
          
          <hr class="my-4">
          
          <h5 class="mb-3">Cài Đặt Email</h5>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="fromName" class="form-label">Tên Người Gửi</label>
              <input type="text" class="form-control" id="fromName" name="fromName" value="Freelancer CRM">
            </div>
            <div class="col-md-6">
              <label for="fromEmail" class="form-label">Email Người Gửi</label>
              <input type="email" class="form-control" id="fromEmail" name="fromEmail" value="no-reply@example.com">
            </div>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-outline-info" id="testEmailBtn">
              <i class="fas fa-paper-plane me-2"></i> Gửi Email Kiểm Tra
            </button>
          </div>
        </form>
      </div>
      
      <!-- System Settings Tab -->
      <div class="tab-pane fade" id="system" role="tabpanel" aria-labelledby="system-tab">
        <h5 class="mb-3">Cài Đặt Hệ Thống</h5>
        <form id="systemSettingsForm">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="maintenanceMode" class="form-label">Chế Độ Bảo Trì</label>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="maintenanceMode" name="maintenanceMode">
                <label class="form-check-label" for="maintenanceMode">Bật chế độ bảo trì</label>
              </div>
              <small class="form-text text-muted">Khi bật, website sẽ hiển thị thông báo bảo trì cho người dùng.</small>
            </div>
            <div class="col-md-6">
              <label for="debugMode" class="form-label">Chế Độ Debug</label>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="debugMode" name="debugMode">
                <label class="form-check-label" for="debugMode">Bật chế độ debug</label>
              </div>
              <small class="form-text text-muted">Hiển thị lỗi chi tiết. Chỉ bật khi phát triển.</small>
            </div>
          </div>
          <div class="mb-3">
            <label for="backupFrequency" class="form-label">Tần Suất Sao Lưu Dữ Liệu</label>
            <select class="form-select" id="backupFrequency" name="backupFrequency">
              <option value="daily" selected>Hàng Ngày</option>
              <option value="weekly">Hàng Tuần</option>
              <option value="monthly">Hàng Tháng</option>
              <option value="never">Không Sao Lưu</option>
            </select>
          </div>
          
          <hr class="my-4">
          
          <h5 class="mb-3">Quản Lý Bộ Nhớ Đệm</h5>
          <div class="mb-3">
            <label for="cacheDriver" class="form-label">Driver Cache</label>
            <select class="form-select" id="cacheDriver" name="cacheDriver">
              <option value="file" selected>File</option>
              <option value="redis">Redis</option>
              <option value="memcached">Memcached</option>
            </select>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-outline-warning me-2" id="clearCacheBtn">
              <i class="fas fa-broom me-2"></i> Xóa Cache
            </button>
            <button type="button" class="btn btn-outline-danger" id="clearSessionBtn">
              <i class="fas fa-trash me-2"></i> Xóa Phiên Đăng Nhập
            </button>
          </div>
        </form>
      </div>
      
      <!-- Security Settings Tab -->
      <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
        <h5 class="mb-3">Bảo Mật Tài Khoản</h5>
        <form id="securitySettingsForm">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="loginAttempts" class="form-label">Số Lần Đăng Nhập Sai Tối Đa</label>
              <input type="number" class="form-control" id="loginAttempts" name="loginAttempts" value="5" min="1" max="10">
              <small class="form-text text-muted">Số lần đăng nhập sai trước khi khóa tài khoản.</small>
            </div>
            <div class="col-md-6">
              <label for="lockoutTime" class="form-label">Thời Gian Khóa (phút)</label>
              <input type="number" class="form-control" id="lockoutTime" name="lockoutTime" value="30" min="5" max="1440">
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6">
              <label for="passwordPolicy" class="form-label">Chính Sách Mật Khẩu</label>
              <select class="form-select" id="passwordPolicy" name="passwordPolicy">
                <option value="basic">Cơ bản (ít nhất 8 ký tự)</option>
                <option value="medium" selected>Trung bình (chữ hoa, chữ thường, số)</option>
                <option value="strong">Mạnh (chữ hoa, chữ thường, số, ký tự đặc biệt)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="passwordExpiry" class="form-label">Hết Hạn Mật Khẩu</label>
              <select class="form-select" id="passwordExpiry" name="passwordExpiry">
                <option value="0">Không bao giờ</option>
                <option value="30">30 ngày</option>
                <option value="60">60 ngày</option>
                <option value="90" selected>90 ngày</option>
              </select>
            </div>
          </div>
          
          <h5 class="mb-3">Bảo Mật Hệ Thống</h5>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="enableCaptcha" name="enableCaptcha" checked>
              <label class="form-check-label" for="enableCaptcha">Bật CAPTCHA</label>
            </div>
            <small class="form-text text-muted">Bảo vệ form đăng nhập và liên hệ khỏi bot.</small>
          </div>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="forceSSL" name="forceSSL" checked>
              <label class="form-check-label" for="forceSSL">Bắt buộc sử dụng HTTPS</label>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="enableXSRF" name="enableXSRF" checked>
              <label class="form-check-label" for="enableXSRF">Chống CSRF (Cross-Site Request Forgery)</label>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="enableXSS" name="enableXSS" checked>
              <label class="form-check-label" for="enableXSS">Chống XSS (Cross-Site Scripting)</label>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Test Email Modal -->
<div class="modal fade" id="testEmailModal" tabindex="-1" aria-labelledby="testEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="testEmailModalLabel">Gửi Email Kiểm Tra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="testEmailForm">
          <div class="mb-3">
            <label for="testEmailAddress" class="form-label">Email Nhận</label>
            <input type="email" class="form-control" id="testEmailAddress" placeholder="Nhập email để kiểm tra">
          </div>
          <div class="mb-3">
            <label for="testEmailSubject" class="form-label">Tiêu Đề</label>
            <input type="text" class="form-control" id="testEmailSubject" value="Kiểm tra cấu hình email">
          </div>
          <div class="mb-3">
            <label for="testEmailContent" class="form-label">Nội Dung</label>
            <textarea class="form-control" id="testEmailContent" rows="3">Đây là email kiểm tra từ hệ thống Freelancer CRM. Nếu bạn nhận được email này, cấu hình email đã hoạt động chính xác.</textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary" id="sendTestEmailBtn">Gửi Email</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toggle SMTP settings based on mail driver
  const mailDriver = document.getElementById('mailDriver');
  const smtpSettings = document.getElementById('smtpSettings');
  
  mailDriver.addEventListener('change', function() {
    if (this.value === 'smtp') {
      smtpSettings.style.display = 'block';
    } else {
      smtpSettings.style.display = 'none';
    }
  });
  
  // Test Email Button
  const testEmailBtn = document.getElementById('testEmailBtn');
  testEmailBtn.addEventListener('click', function() {
    const testEmailModal = new bootstrap.Modal(document.getElementById('testEmailModal'));
    testEmailModal.show();
  });
  
  // Send Test Email
  const sendTestEmailBtn = document.getElementById('sendTestEmailBtn');
  sendTestEmailBtn.addEventListener('click', function() {
    const testEmailAddress = document.getElementById('testEmailAddress').value;
    
    if (!testEmailAddress) {
      alert('Vui lòng nhập địa chỉ email');
      return;
    }
    
    // Giả lập gửi email
    alert('Đã gửi email kiểm tra đến ' + testEmailAddress);
    
    // Đóng modal
    const testEmailModal = bootstrap.Modal.getInstance(document.getElementById('testEmailModal'));
    testEmailModal.hide();
  });
  
  // Clear Cache Button
  const clearCacheBtn = document.getElementById('clearCacheBtn');
  clearCacheBtn.addEventListener('click', function() {
    if (confirm('Bạn có chắc chắn muốn xóa toàn bộ cache?')) {
      alert('Đã xóa cache thành công!');
    }
  });
  
  // Clear Session Button
  const clearSessionBtn = document.getElementById('clearSessionBtn');
  clearSessionBtn.addEventListener('click', function() {
    if (confirm('Bạn có chắc chắn muốn xóa tất cả phiên đăng nhập? Tất cả người dùng sẽ bị đăng xuất.')) {
      alert('Đã xóa tất cả phiên đăng nhập thành công!');
    }
  });
  
  // Save Settings Button
  const saveSettingsBtn = document.getElementById('saveSettingsBtn');
  saveSettingsBtn.addEventListener('click', function() {
    alert('Đã lưu cài đặt thành công!');
  });
});
</script>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?> 