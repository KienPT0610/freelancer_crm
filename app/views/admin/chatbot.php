<?php
// Set variables for the layout
$page_title = 'Chatbot';
$active_page = 'chatbot';

// Start output buffering to capture content
ob_start();
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="mb-0">Chatbot Tư Vấn Khách Hàng</h4>
  <div>
    <a href="/admin/dashboard" class="btn btn-outline-secondary me-2">
      <i class="fas fa-arrow-left me-2"></i> Quay Lại Dashboard
    </a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#settingsModal">
      <i class="fas fa-cog me-2"></i> Cài Đặt
    </button>
  </div>
</div>

<div class="row">
  <!-- Chat Area -->
  <div class="col-md-8">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="fas fa-robot me-2"></i> Assistant CRM
          <span class="badge bg-success ms-2">Online</span>
        </h5>
        <div>
          <button class="btn btn-sm btn-outline-secondary me-2" id="clearChatBtn">
            <i class="fas fa-eraser me-1"></i> Xóa Trò Chuyện
          </button>
          <button class="btn btn-sm btn-outline-primary" id="exportChatBtn">
            <i class="fas fa-download me-1"></i> Xuất Trò Chuyện
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="chat-container p-3" id="chatContainer">
          <!-- Welcome Message -->
          <div class="chat-message bot-message mb-3">
            <div class="message-avatar">
              <img src="/public/assets/images/logo.png" alt="Bot" class="rounded-circle">
            </div>
            <div class="message-content">
              <div class="message-bubble">
                <p class="mb-0">Xin chào! Tôi là trợ lý ảo của hệ thống CRM. Tôi có thể giúp gì cho bạn hôm nay?</p>
              </div>
              <div class="message-info">
                <small class="text-muted">Hôm nay, <?php echo date('H:i'); ?></small>
              </div>
            </div>
          </div>

          <!-- Sample User Message -->
          <div class="chat-message user-message mb-3">
            <div class="message-content">
              <div class="message-bubble">
                <p class="mb-0">Tôi muốn biết thông tin về khách hàng có mã KH001</p>
              </div>
              <div class="message-info">
                <small class="text-muted">Hôm nay, <?php echo date('H:i'); ?></small>
              </div>
            </div>
            <div class="message-avatar">
              <img src="/public/assets/images/avatar.png" alt="User" class="rounded-circle">
            </div>
          </div>

          <!-- Sample Bot Response with data -->
          <div class="chat-message bot-message mb-3">
            <div class="message-avatar">
              <img src="/public/assets/images/logo.png" alt="Bot" class="rounded-circle">
            </div>
            <div class="message-content">
              <div class="message-bubble">
                <p class="mb-0">Đây là thông tin khách hàng có mã KH001:</p>
                <div class="data-card mt-2">
                  <div class="data-card-header">
                    <h6 class="mb-0">Công Ty TNHH ABC</h6>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                  </div>
                  <div class="data-card-body">
                    <p><strong>Email:</strong> contact@abc.com</p>
                    <p><strong>Điện thoại:</strong> 0901234567</p>
                    <p><strong>Địa chỉ:</strong> 123 Đường ABC, Q.1, TP.HCM</p>
                    <p><strong>Dự án:</strong> 2 dự án đang hoạt động</p>
                  </div>
                  <div class="data-card-footer">
                    <a href="/admin/customers/1" class="btn btn-sm btn-outline-primary">Xem Chi Tiết</a>
                  </div>
                </div>
              </div>
              <div class="message-info">
                <small class="text-muted">Hôm nay, <?php echo date('H:i'); ?></small>
              </div>
            </div>
          </div>

          <!-- Sample Bot Response with options -->
          <div class="chat-message bot-message mb-3">
            <div class="message-avatar">
              <img src="/public/assets/images/logo.png" alt="Bot" class="rounded-circle">
            </div>
            <div class="message-content">
              <div class="message-bubble">
                <p class="mb-0">Bạn muốn thực hiện thao tác nào với khách hàng này?</p>
                <div class="option-buttons mt-2">
                  <button class="btn btn-sm btn-outline-primary mb-1 me-1">Xem Chi Tiết</button>
                  <button class="btn btn-sm btn-outline-success mb-1 me-1">Tạo Tương Tác</button>
                  <button class="btn btn-sm btn-outline-info mb-1 me-1">Tạo Dự Án</button>
                  <button class="btn btn-sm btn-outline-warning mb-1">Gửi Email</button>
                </div>
              </div>
              <div class="message-info">
                <small class="text-muted">Hôm nay, <?php echo date('H:i'); ?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <form id="chatForm" class="chat-input-form">
          <div class="input-group">
            <input type="text" class="form-control" id="messageInput" placeholder="Nhập câu hỏi hoặc yêu cầu..."
              autocomplete="off">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
          <div class="d-flex align-items-center mt-2">
            <div class="form-check form-switch me-3">
              <input class="form-check-input" type="checkbox" id="useSuggestionsSwitch" checked>
              <label class="form-check-label small" for="useSuggestionsSwitch">Gợi ý câu trả lời</label>
            </div>
            <button type="button" class="btn btn-sm btn-link text-muted p-0" id="voiceInputBtn">
              <i class="fas fa-microphone me-1"></i> Nhập bằng giọng nói
            </button>
            <div class="ms-auto">
              <span class="small text-muted" id="typingIndicator"></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Knowledge Base & Suggestions -->
  <div class="col-md-4">
    <div class="card mb-3">
      <div class="card-header">
        <h5 class="mb-0">Câu Hỏi Thường Gặp</h5>
      </div>
      <div class="card-body p-0">
        <div class="list-group list-group-flush">
          <button class="list-group-item list-group-item-action suggestion-item">
            Danh sách khách hàng tiềm năng?
          </button>
          <button class="list-group-item list-group-item-action suggestion-item">
            Hiển thị dự án sắp hết hạn trong tuần này
          </button>
          <button class="list-group-item list-group-item-action suggestion-item">
            Tương tác gần đây với khách hàng Công ty XYZ
          </button>
          <button class="list-group-item list-group-item-action suggestion-item">
            Tạo tương tác mới với khách hàng mã KH010
          </button>
          <button class="list-group-item list-group-item-action suggestion-item">
            Tổng doanh thu từ dự án trong tháng này?
          </button>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Thông Tin Hữu Ích</h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <h6><i class="fas fa-info-circle text-primary me-2"></i> Trạng Thái Chatbot</h6>
          <div class="d-flex align-items-center mt-2">
            <div class="progress flex-grow-1 me-2" style="height: 8px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
            </div>
            <span class="badge bg-success">Hoạt động tốt</span>
          </div>
        </li>
        <li class="list-group-item">
          <h6><i class="fas fa-chart-line text-success me-2"></i> Số Liệu Thống Kê</h6>
          <div class="row mt-2">
            <div class="col-6">
              <div class="small text-muted">Cuộc trò chuyện</div>
              <div class="fw-bold">1,234</div>
            </div>
            <div class="col-6">
              <div class="small text-muted">Độ chính xác</div>
              <div class="fw-bold">95%</div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <h6><i class="fas fa-plug text-warning me-2"></i> Kết Nối Hệ Thống</h6>
          <div class="mt-2">
            <span class="badge bg-success me-1">CRM</span>
            <span class="badge bg-success me-1">Calendar</span>
            <span class="badge bg-success me-1">Email</span>
            <span class="badge bg-secondary me-1">Marketing</span>
          </div>
        </li>
        <li class="list-group-item">
          <h6><i class="fas fa-lightbulb text-info me-2"></i> Lời Khuyên</h6>
          <p class="small text-muted mb-0">Bạn có thể hỏi chatbot về dữ liệu khách hàng, tình trạng dự án, và thêm tương
            tác mới.</p>
        </li>
      </ul>
    </div>
  </div>
</div>

<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="settingsModalLabel">Cài Đặt Chatbot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
              type="button" role="tab">
              Cài Đặt Chung
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="knowledge-tab" data-bs-toggle="tab" data-bs-target="#knowledge" type="button"
              role="tab">
              Cơ Sở Kiến Thức
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button"
              role="tab">
              Giao Diện
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button" role="tab">
              Nhật Ký
            </button>
          </li>
        </ul>
        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="settingsTabsContent">
          <!-- General Settings -->
          <div class="tab-pane fade show active" id="general" role="tabpanel">
            <div class="mb-3">
              <label class="form-label">Chế Độ Trả Lời</label>
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="responseMode" id="autoMode" value="auto" checked>
                <label class="form-check-label" for="autoMode">
                  Tự động - Chatbot trả lời tất cả câu hỏi
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="responseMode" id="assistMode" value="assist">
                <label class="form-check-label" for="assistMode">
                  Hỗ trợ - Chatbot đề xuất câu trả lời cho admin
                </label>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Quyền Truy Cập Dữ Liệu</label>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="dataAccessCustomers" checked>
                <label class="form-check-label" for="dataAccessCustomers">
                  Khách hàng
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="dataAccessProjects" checked>
                <label class="form-check-label" for="dataAccessProjects">
                  Dự án
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="dataAccessInteractions" checked>
                <label class="form-check-label" for="dataAccessInteractions">
                  Tương tác
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="dataAccessFinancial">
                <label class="form-check-label" for="dataAccessFinancial">
                  Tài chính (Yêu cầu quyền admin)
                </label>
              </div>
            </div>

            <div class="mb-3">
              <label for="apiKey" class="form-label">API Key Chatbot</label>
              <div class="input-group">
                <input type="password" class="form-control" id="apiKey"
                  value="sk_test_123456789abcdefghijklmnopqrstuvwxyz">
                <button class="btn btn-outline-secondary" type="button" id="showApiKey">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              <div class="form-text">API key để kết nối với dịch vụ chatbot.</div>
            </div>
          </div>

          <!-- Knowledge Base Settings -->
          <div class="tab-pane fade" id="knowledge" role="tabpanel">
            <div class="mb-3">
              <label class="form-label">Nguồn Dữ Liệu</label>
              <div class="table-responsive">
                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                      <th>Tên Nguồn</th>
                      <th>Loại</th>
                      <th>Trạng Thái</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Dữ liệu CRM</td>
                      <td><span class="badge bg-primary">Cơ sở dữ liệu</span></td>
                      <td><span class="badge bg-success">Đã kết nối</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary">Cấu hình</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Tài liệu hướng dẫn</td>
                      <td><span class="badge bg-info">Tài liệu</span></td>
                      <td><span class="badge bg-success">Đã kết nối</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary">Cấu hình</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Mẫu email</td>
                      <td><span class="badge bg-warning">Mẫu</span></td>
                      <td><span class="badge bg-secondary">Không kết nối</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary">Kết nối</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <button class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Thêm Nguồn Mới
              </button>
            </div>

            <div class="mb-3">
              <label class="form-label">Cập Nhật Cơ Sở Kiến Thức</label>
              <div class="input-group">
                <select class="form-select">
                  <option value="daily">Hàng ngày</option>
                  <option value="weekly" selected>Hàng tuần</option>
                  <option value="monthly">Hàng tháng</option>
                  <option value="manual">Thủ công</option>
                </select>
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-sync-alt me-1"></i> Cập Nhật Ngay
                </button>
              </div>
              <div class="form-text">Lần cập nhật cuối: 20/05/2025 14:30</div>
            </div>
          </div>

          <!-- Appearance Settings -->
          <div class="tab-pane fade" id="appearance" role="tabpanel">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Giao Diện Chatbot</label>
                  <div class="d-flex gap-2">
                    <div class="form-check appearance-option">
                      <input class="form-check-input" type="radio" name="appearance" id="lightTheme" checked>
                      <label class="form-check-label p-2 border rounded text-center" for="lightTheme">
                        <div class="theme-preview light-theme mb-2"></div>
                        Sáng
                      </label>
                    </div>
                    <div class="form-check appearance-option">
                      <input class="form-check-input" type="radio" name="appearance" id="darkTheme">
                      <label class="form-check-label p-2 border rounded text-center" for="darkTheme">
                        <div class="theme-preview dark-theme mb-2"></div>
                        Tối
                      </label>
                    </div>
                    <div class="form-check appearance-option">
                      <input class="form-check-input" type="radio" name="appearance" id="systemTheme">
                      <label class="form-check-label p-2 border rounded text-center" for="systemTheme">
                        <div class="theme-preview system-theme mb-2"></div>
                        Theo hệ thống
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Màu Sắc Chính</label>
                  <div class="d-flex gap-2">
                    <div class="form-check appearance-option">
                      <input class="form-check-input" type="radio" name="colorTheme" id="blueTheme" checked>
                      <label class="form-check-label p-2 border rounded text-center" for="blueTheme">
                        <div class="color-preview blue-theme mb-2"></div>
                        Xanh
                      </label>
                    </div>
                    <div class="form-check appearance-option">
                      <input class="form-check-input" type="radio" name="colorTheme" id="greenTheme">
                      <label class="form-check-label p-2 border rounded text-center" for="greenTheme">
                        <div class="color-preview green-theme mb-2"></div>
                        Lục
                      </label>
                    </div>
                    <div class="form-check appearance-option">
                      <input class="form-check-input" type="radio" name="colorTheme" id="purpleTheme">
                      <label class="form-check-label p-2 border rounded text-center" for="purpleTheme">
                        <div class="color-preview purple-theme mb-2"></div>
                        Tím
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="fontSizeRange" class="form-label">Kích Thước Chữ</label>
              <input type="range" class="form-range" min="12" max="20" step="1" value="14" id="fontSizeRange">
              <div class="d-flex justify-content-between">
                <small>Nhỏ</small>
                <small>Trung bình</small>
                <small>Lớn</small>
              </div>
            </div>

            <div class="mb-3">
              <label for="chatbotName" class="form-label">Tên Chatbot</label>
              <input type="text" class="form-control" id="chatbotName" value="Assistant CRM">
            </div>

            <div class="mb-3">
              <label for="chatbotAvatar" class="form-label">Hình Đại Diện Chatbot</label>
              <div class="d-flex align-items-center">
                <img src="/public/assets/images/logo.png" alt="Bot Avatar" class="me-3"
                  style="width: 48px; height: 48px; border-radius: 50%;">
                <input type="file" class="form-control" id="chatbotAvatar">
              </div>
            </div>
          </div>

          <!-- Logs Tab -->
          <div class="tab-pane fade" id="logs" role="tabpanel">
            <div class="mb-3">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label mb-0">Nhật Ký Hoạt Động</label>
                <div>
                  <button class="btn btn-sm btn-outline-secondary me-2">
                    <i class="fas fa-download me-1"></i> Xuất
                  </button>
                  <button class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash me-1"></i> Xóa
                  </button>
                </div>
              </div>
              <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-sm table-hover">
                  <thead class="table-light sticky-top">
                    <tr>
                      <th>Thời Gian</th>
                      <th>Người Dùng</th>
                      <th>Hành Động</th>
                      <th>Trạng Thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>22/05/2025 14:30</td>
                      <td>admin</td>
                      <td>Truy vấn thông tin khách hàng KH001</td>
                      <td><span class="badge bg-success">Thành công</span></td>
                    </tr>
                    <tr>
                      <td>22/05/2025 14:28</td>
                      <td>admin</td>
                      <td>Tạo tương tác mới</td>
                      <td><span class="badge bg-success">Thành công</span></td>
                    </tr>
                    <tr>
                      <td>22/05/2025 14:25</td>
                      <td>admin</td>
                      <td>Truy vấn danh sách dự án đang hoạt động</td>
                      <td><span class="badge bg-success">Thành công</span></td>
                    </tr>
                    <tr>
                      <td>22/05/2025 14:20</td>
                      <td>admin</td>
                      <td>Cập nhật cấu hình chatbot</td>
                      <td><span class="badge bg-success">Thành công</span></td>
                    </tr>
                    <tr>
                      <td>22/05/2025 14:15</td>
                      <td>admin</td>
                      <td>Truy vấn thông tin không có quyền truy cập</td>
                      <td><span class="badge bg-danger">Thất bại</span></td>
                    </tr>
                    <tr>
                      <td>22/05/2025 14:10</td>
                      <td>hethong</td>
                      <td>Cập nhật cơ sở kiến thức tự động</td>
                      <td><span class="badge bg-success">Thành công</span></td>
                    </tr>
                    <tr>
                      <td>22/05/2025 14:05</td>
                      <td>admin</td>
                      <td>Đăng nhập vào hệ thống</td>
                      <td><span class="badge bg-success">Thành công</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Cài Đặt Nhật Ký</label>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="logUserQueries" checked>
                <label class="form-check-label" for="logUserQueries">
                  Ghi lại truy vấn người dùng
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="logBotResponses" checked>
                <label class="form-check-label" for="logBotResponses">
                  Ghi lại phản hồi của chatbot
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="logErrors" checked>
                <label class="form-check-label" for="logErrors">
                  Ghi lại lỗi
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="logSystemEvents" checked>
                <label class="form-check-label" for="logSystemEvents">
                  Ghi lại sự kiện hệ thống
                </label>
              </div>
            </div>

            <div class="mb-3">
              <label for="logRetentionPeriod" class="form-label">Thời Gian Lưu Trữ Nhật Ký</label>
              <select class="form-select" id="logRetentionPeriod">
                <option value="7">7 ngày</option>
                <option value="30" selected>30 ngày</option>
                <option value="90">90 ngày</option>
                <option value="180">180 ngày</option>
                <option value="365">365 ngày</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary">Lưu Thay Đổi</button>
      </div>
    </div>
  </div>
</div>

<style>
.chat-container {
  height: calc(100vh - 280px);
  overflow-y: auto;
  background-color: #f8f9fa;
}

.chat-message {
  display: flex;
  margin-bottom: 15px;
}

.bot-message {
  align-items: flex-start;
}

.user-message {
  align-items: flex-start;
  flex-direction: row-reverse;
}

.message-avatar {
  width: 40px;
  height: 40px;
  flex-shrink: 0;
}

.message-avatar img {
  width: 40px;
  height: 40px;
  object-fit: cover;
}

.message-content {
  max-width: 80%;
  margin: 0 12px;
}

.message-bubble {
  padding: 12px 16px;
  border-radius: 18px;
  background-color: #ffffff;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.user-message .message-bubble {
  background-color: #0d6efd;
  color: white;
  border-top-right-radius: 4px;
}

.bot-message .message-bubble {
  background-color: #ffffff;
  border-top-left-radius: 4px;
}

.message-info {
  margin-top: 4px;
  padding: 0 8px;
}

.data-card {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
}

.data-card-header {
  padding: 8px 12px;
  background-color: rgba(0, 0, 0, 0.03);
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.data-card-body {
  padding: 12px;
}

.data-card-body p {
  margin-bottom: 6px;
}

.data-card-body p:last-child {
  margin-bottom: 0;
}

.data-card-footer {
  padding: 8px 12px;
  background-color: rgba(0, 0, 0, 0.03);
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  text-align: right;
}

.suggestion-item {
  cursor: pointer;
  transition: all 0.2s;
}

.suggestion-item:hover {
  background-color: #f0f7ff;
}

.chat-input-form {
  position: relative;
}

.option-buttons {
  display: flex;
  flex-wrap: wrap;
}

/* Appearance Settings Styles */
.appearance-option .form-check-input {
  position: absolute;
  opacity: 0;
}

.appearance-option .form-check-label {
  cursor: pointer;
  transition: all 0.2s;
}

.appearance-option .form-check-input:checked+.form-check-label {
  border-color: #0d6efd !important;
  background-color: #f0f7ff;
}

.theme-preview,
.color-preview {
  width: 60px;
  height: 40px;
  border-radius: 6px;
  border: 1px solid rgba(0, 0, 0, 0.1);
}

.light-theme {
  background-color: #ffffff;
}

.dark-theme {
  background-color: #212529;
}

.system-theme {
  background: linear-gradient(to right, #ffffff 50%, #212529 50%);
}

.blue-theme {
  background-color: #0d6efd;
}

.green-theme {
  background-color: #198754;
}

.purple-theme {
  background-color: #6f42c1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const chatContainer = document.getElementById('chatContainer');
  const chatForm = document.getElementById('chatForm');
  const messageInput = document.getElementById('messageInput');
  const clearChatBtn = document.getElementById('clearChatBtn');
  const exportChatBtn = document.getElementById('exportChatBtn');
  const suggestionItems = document.querySelectorAll('.suggestion-item');
  const typingIndicator = document.getElementById('typingIndicator');
  const voiceInputBtn = document.getElementById('voiceInputBtn');

  // Scroll to bottom of chat
  function scrollToBottom() {
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }

  // Initialize chat
  scrollToBottom();

  // Add user message to chat
  function addUserMessage(message) {
    const messageElement = document.createElement('div');
    messageElement.className = 'chat-message user-message mb-3';
    messageElement.innerHTML = `
      <div class="message-content">
        <div class="message-bubble">
          <p class="mb-0">${message}</p>
        </div>
        <div class="message-info">
          <small class="text-muted">Hôm nay, ${new Date().getHours()}:${String(new Date().getMinutes()).padStart(2, '0')}</small>
        </div>
      </div>
      <div class="message-avatar">
        <img src="/public/assets/images/avatar.png" alt="User" class="rounded-circle">
      </div>
    `;
    chatContainer.appendChild(messageElement);
    scrollToBottom();
  }

  // Show bot is typing
  function showBotTyping() {
    typingIndicator.textContent = 'Đang trả lời...';
    scrollToBottom();
  }

  // Hide bot typing indicator
  function hideBotTyping() {
    typingIndicator.textContent = '';
  }

  // Add bot message to chat (simplified for this example)
  function addBotMessage(message) {
    const messageElement = document.createElement('div');
    messageElement.className = 'chat-message bot-message mb-3';
    messageElement.innerHTML = `
      <div class="message-avatar">
        <img src="/public/assets/images/logo.png" alt="Bot" class="rounded-circle">
      </div>
      <div class="message-content">
        <div class="message-bubble">
          <p class="mb-0">${message}</p>
        </div>
        <div class="message-info">
          <small class="text-muted">Hôm nay, ${new Date().getHours()}:${String(new Date().getMinutes()).padStart(2, '0')}</small>
        </div>
      </div>
    `;
    chatContainer.appendChild(messageElement);
    scrollToBottom();
  }

  // Simulated bot response
  function simulateBotResponse(userMessage) {
    showBotTyping();

    // Simulate network delay
    setTimeout(() => {
      hideBotTyping();

      // Simple response logic (for demonstration only)
      let botResponse = "Tôi không chắc về câu hỏi này. Bạn có thể nói rõ hơn được không?";

      if (userMessage.toLowerCase().includes('xin chào') || userMessage.toLowerCase().includes('chào')) {
        botResponse = "Xin chào! Tôi có thể giúp gì cho bạn hôm nay?";
      } else if (userMessage.toLowerCase().includes('khách hàng')) {
        botResponse = "Bạn muốn biết thông tin về khách hàng nào? Vui lòng cung cấp mã khách hàng hoặc tên.";
      } else if (userMessage.toLowerCase().includes('dự án')) {
        botResponse = "Hiện tại có 12 dự án đang hoạt động. Bạn muốn xem thông tin chi tiết về dự án nào?";
      } else if (userMessage.toLowerCase().includes('tương tác')) {
        botResponse = "Bạn muốn xem tương tác gần đây hay tạo tương tác mới?";
      } else if (userMessage.toLowerCase().includes('báo cáo') || userMessage.toLowerCase().includes(
          'thống kê')) {
        botResponse =
          "Tôi có thể giúp bạn tạo các báo cáo sau: Báo cáo khách hàng, Báo cáo dự án, Báo cáo doanh thu.";
      }

      addBotMessage(botResponse);
    }, 1000);
  }

  // Handle chat form submission
  chatForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const message = messageInput.value.trim();
    if (message) {
      addUserMessage(message);
      messageInput.value = '';
      simulateBotResponse(message);
    }
  });

  // Handle clear chat button
  clearChatBtn.addEventListener('click', function() {
    if (confirm('Bạn có chắc chắn muốn xóa toàn bộ cuộc trò chuyện?')) {
      // Remove all messages except the welcome message
      while (chatContainer.children.length > 1) {
        chatContainer.removeChild(chatContainer.lastChild);
      }
    }
  });

  // Handle export chat button
  exportChatBtn.addEventListener('click', function() {
    alert('Chức năng xuất trò chuyện đang được phát triển.');
  });

  // Handle suggestion items
  suggestionItems.forEach(item => {
    item.addEventListener('click', function() {
      const suggestionText = this.textContent.trim();
      addUserMessage(suggestionText);
      simulateBotResponse(suggestionText);
    });
  });

  // Handle voice input button
  voiceInputBtn.addEventListener('click', function() {
    alert('Chức năng nhập bằng giọng nói đang được phát triển.');
  });

  // Toggle API key visibility
  const showApiKeyBtn = document.getElementById('showApiKey');
  const apiKeyInput = document.getElementById('apiKey');

  if (showApiKeyBtn && apiKeyInput) {
    showApiKeyBtn.addEventListener('click', function() {
      if (apiKeyInput.type === 'password') {
        apiKeyInput.type = 'text';
        showApiKeyBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
      } else {
        apiKeyInput.type = 'password';
        showApiKeyBtn.innerHTML = '<i class="fas fa-eye"></i>';
      }
    });
  }
});
</script>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>