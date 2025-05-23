<?php
// Set variables for the layout
$page_title = 'Chatbot';
$active_page = 'chatbot';
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Múi giờ Việt Nam;
include(__DIR__ . '/prompt_training.php');

// Tạo session nếu chưa được khởi tạo
if (!isset($_SESSION)) {
    session_start();
}

// Khởi tạo các model cần thiết
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../models/Interaction.php';

// Thêm hàm helper để chuyển đổi thứ trong tuần sang tiếng Việt
function getVietnameseWeekday($date) {
    $weekdays = [
        'Monday' => 'Thứ Hai',
        'Tuesday' => 'Thứ Ba',
        'Wednesday' => 'Thứ Tư',
        'Thursday' => 'Thứ Năm',
        'Friday' => 'Thứ Sáu',
        'Saturday' => 'Thứ Bảy',
        'Sunday' => 'Chủ Nhật'
    ];
    return $weekdays[date('l', strtotime($date))];
}

// Thêm hàm helper để định dạng ngày tháng theo tiếng Việt
function getVietnameseDate($date) {
    $weekday = getVietnameseWeekday($date);
    return $weekday . ', ngày ' . date('d', strtotime($date)) . ' tháng ' . date('m', strtotime($date)) . ' năm ' . date('Y', strtotime($date));
}

// Handle clearing chat history
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clear_chat"])) {
    // Keep only the initial system message
    $system_message = isset($_SESSION['chat_messages'][0]) ? $_SESSION['chat_messages'][0] : $prompt;
    $_SESSION['chat_messages'] = $system_message;
    
    // Return success response and exit
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

// Initialize chat messages in session if not set
if (!isset($_SESSION['chat_messages'])) {
    $_SESSION['chat_messages'] = $prompt;
}

// API key for Gemini
$env = require __DIR__ . '/../../../env.php';
$gemini_api_key = $env['gemini_api_key'];

// Process chat request
$chat_reply = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_message"])) {
    $user_message = trim($_POST["user_message"]);
    
    if (!empty($user_message)) {
        // Add user message to history with current timestamp
        $_SESSION['chat_messages'][] = [
            "role" => "user", 
            "content" => $user_message, 
            "timestamp" => date('Y-m-d H:i:s')
        ];
        
        // Cập nhật system message với thời gian mới
        $currentTime = date('Y-m-d H:i:s');
        $systemMessage = $_SESSION['chat_messages'][0]['content'];
        $systemMessage = preg_replace(
            '/Thời gian hiện tại:.*?(?=\n|$)/s',
            'Thời gian hiện tại: ' . getVietnameseDate(date('Y-m-d')) . ', ' . date('H:i:s'),
            $systemMessage
        );
        $systemMessage = preg_replace(
            '/Ngày trong tuần:.*?(?=\n|$)/s',
            'Ngày trong tuần: ' . getVietnameseWeekday(date('Y-m-d')),
            $systemMessage
        );
        $systemMessage = preg_replace(
            '/Ngày trong tháng:.*?(?=\n|$)/s',
            'Ngày trong tháng: ' . date('d'),
            $systemMessage
        );
        $systemMessage = preg_replace(
            '/Tháng:.*?(?=\n|$)/s',
            'Tháng: ' . date('m'),
            $systemMessage
        );
        $systemMessage = preg_replace(
            '/Năm:.*?(?=\n|$)/s',
            'Năm: ' . date('Y'),
            $systemMessage
        );
        
        $_SESSION['chat_messages'][0]['content'] = $systemMessage;
        $_SESSION['chat_messages'][0]['timestamp'] = $currentTime;
        
        // Debug information
        error_log("User message: " . $user_message);
        error_log("Lowercase message: " . strtolower($user_message));
        error_log("String position check: " . strpos(strtolower($user_message), 'hiển thị danh sách khách hàng'));
        
        // Limit chat history to prevent excessive token usage
        if (count($_SESSION['chat_messages']) > 10) {
            $system_message = $_SESSION['chat_messages'][0];
            $_SESSION['chat_messages'] = array_slice($_SESSION['chat_messages'], -100);
            array_unshift($_SESSION['chat_messages'], $system_message);
        }

        // Xử lý các lệnh đặc biệt trước khi gọi API
        $customerModel = new \App\Models\Customer();
        $interactionModel = new \App\Models\Interaction();
        
        // Xử lý hiển thị danh sách khách hàng
        if (preg_match('/hiển\s*thị\s*danh\s*sách\s*khách\s*hàng/i', $user_message)) {
          try {
              $customers = $customerModel->getAllCustomers();
              error_log("Customers retrieved: " . print_r($customers, true));
              
              if (empty($customers)) {
                  $chat_reply = "Hiện tại chưa có khách hàng nào trong hệ thống.\n\nBạn có thể:\n1. Thêm khách hàng mới\n2. Xem hướng dẫn";
              } else {
                  $chat_reply = "Danh sách khách hàng:\n\n";
                  foreach ($customers as $index => $customer) {
                      $id = "KH0". $customer['customer_id'] ?? 'N/A';
                      $name = $customer['name'] ?? 'N/A';
                      $email = $customer['email'] ?? 'N/A';
                      $phone = $customer['phone'] ?? 'N/A';
                      $company = $customer['company'] ?? 'N/A';
                      $birthday = isset($customer['birthday']) ? date('d/m/Y', strtotime($customer['birthday'])) : 'N/A';
                      $tags = $customer['tags'] ?? 'N/A';
                      $address = $customer['address'] ?? 'N/A';
                      $chat_reply .= ($index + 1) .  ". {$id} - {$name}\n   - Email: {$email}\n   - Số điện thoại: {$phone}\n   - Công ty: {$company}\n   - Ngày sinh: {$birthday}\n   - Địa chỉ: {$address}\n   - Thẻ: {$tags}\n\n";
                  }
                  $chat_reply .= "Tổng số khách hàng: " . count($customers). " - Thời gian hiện tại: " . date('Y-m-d H:i:s');
              }
          } catch (Exception $e) {
              error_log("Database error: " . $e->getMessage());
              $chat_reply = "Lỗi khi lấy danh sách khách hàng: " . $e->getMessage();
        }
      } 
        // Xử lý thêm khách hàng mới
        elseif (strpos(strtolower($user_message), 'thêm khách hàng') !== false) {
            // Kiểm tra xem có dữ liệu khách hàng mới được truyền vào không
            if (!isset($_SESSION['new_customer']) || empty($_SESSION['new_customer'])) {
                $chat_reply = "Vui lòng cung cấp thông tin khách hàng theo định dạng:\n";
                $chat_reply .= "Tên: [tên khách hàng]\n";
                $chat_reply .= "Email: [email]\n";
                $chat_reply .= "Số điện thoại: [số điện thoại]\n";
                $chat_reply .= "Công ty: [tên công ty]\n";
                $chat_reply .= "Ngày sinh: [ngày/tháng/năm]";
                return;
            }

            $newCustomer = $_SESSION['new_customer'];
            $birthday = $newCustomer['birthday'] ? date('d/m/Y', strtotime($newCustomer['birthday'])) : 'N/A';
            
            $chat_reply = "Đã thêm khách hàng mới:\n";
            $chat_reply .= "Tên: {$newCustomer['name']}\n";
            $chat_reply .= "Email: {$newCustomer['email']}\n";
            $chat_reply .= "Số điện thoại: {$newCustomer['phone']}\n";
            $chat_reply .= "Công ty: {$newCustomer['company']}\n";
            $chat_reply .= "Ngày sinh: {$birthday}";
            
            // Xóa dữ liệu khách hàng mới khỏi session
            unset($_SESSION['new_customer']);
        }
        // Xử lý xem chi tiết khách hàng
        elseif (preg_match('/xem chi tiết khách hàng\s+(.+)/i', $user_message, $matches)) {
            $customerName = trim($matches[1]);
            $customers = $_SESSION['customer_list'] ?? [];
            $found = false;
            
            foreach ($customers as $customer) {
                if (stripos($customer['name'], $customerName) !== false) {
                    $found = true;
                    $birthday = $customer['birthday'] ? date('d/m/Y', strtotime($customer['birthday'])) : 'N/A';
                    
                    $chat_reply = "Thông tin chi tiết khách hàng:\n\n";
                    $chat_reply .= "Tên: {$customer['name']}\n";
                    $chat_reply .= "Email: {$customer['email']}\n";
                    $chat_reply .= "Số điện thoại: {$customer['phone']}\n";
                    $chat_reply .= "Công ty: {$customer['company']}\n";
                    $chat_reply .= "Ngày sinh: {$birthday}\n";
                    $chat_reply .= "Địa chỉ: {$customer['address']}\n";
                    $chat_reply .= "Nguồn: {$customer['source']}\n";
                    $chat_reply .= "Trạng thái: {$customer['status']}\n";
                    $chat_reply .= "Thẻ: {$customer['tags']}\n";
                    $chat_reply .= "Ghi chú: {$customer['notes']}";
                    break;
                }
            }
            
            if (!$found) {
                $chat_reply = "Không tìm thấy khách hàng với tên: {$customerName}";
            }
        }
        // Nếu không phải lệnh đặc biệt, sử dụng Gemini API
        else {
            // Chuẩn bị tin nhắn theo định dạng của Gemini API
            $messages = [];
            if (is_array($_SESSION['chat_messages'])) {
                foreach ($_SESSION['chat_messages'] as $message) {
                    if (is_array($message) && isset($message['role']) && isset($message['content'])) {
                        $role = $message['role'];
                        // Chuyển đổi 'role' từ định dạng của chúng ta sang định dạng của Gemini
                        if ($role === 'assistant') $role = 'model';
                        if ($role === 'system') $role = 'user'; // Gemini không có role system nên chuyển thành user
                        
                        $messages[] = [
                            'role' => $role,
                            'parts' => [
                              ['text' => $message['content']]
                            ]
                        ];
                    }
                }
            }

            // Định dạng dữ liệu theo yêu cầu của Gemini API
            $data = json_encode([
                'contents' => $messages,
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 2048,
                    'topP' => 0.8,
                    'topK' => 40
                ]
            ]);

            // Thiết lập cURL cho Gemini API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemma-3-27b-it:generateContent?key=$gemini_api_key");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json"
            ]);
            
            // Thiết lập timeout và thử lại
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            
            // Thực hiện yêu cầu API
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($http_code == 200) {
                $json = json_decode($response, true);
                if (isset($json['candidates']) && isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                    $chat_reply = $json['candidates'][0]['content']['parts'][0]['text'];
                } elseif (isset($json['error'])) {
                    $chat_reply = "Lỗi Gemini API: " . $json['error']['message'];
                } else {
                    $chat_reply = "Không thể phân tích phản hồi từ API. Định dạng JSON không khớp với cấu trúc mong đợi.";
                }
            } else {
                // Xử lý lỗi API chi tiết
                $error_message = "Lỗi từ Gemini API - HTTP Code: " . $http_code;
                
                if (!empty($error)) {
                    $error_message .= "<br>Chi tiết lỗi cURL: " . htmlspecialchars($error);
                }
                
                if (!empty($response)) {
                    $response_data = json_decode($response, true);
                    if (json_last_error() === JSON_ERROR_NONE && isset($response_data['error'])) {
                        $error_message .= "<br>Thông báo lỗi: " . htmlspecialchars($response_data['error']['message'] ?? json_encode($response_data['error']));
                    } else {
                        $error_message .= "<br>Phản hồi từ server: " . htmlspecialchars($response);
                    }
                }
                
                // Ghi log lỗi
                error_log("Gemini API Error: HTTP Code $http_code, Error: $error, Response: $response");
                
                $chat_reply = $error_message;
            }
        }
        
        // Save bot response to history
        $_SESSION['chat_messages'][] = ["role" => "assistant", "content" => $chat_reply];
        
        // Return JSON response for AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'chat_reply' => $chat_reply]);
            exit;
        }
    }
}

// Start output buffering
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
          <span class="badge bg-success ms-2" id="chatbotOnlineStatus">Online</span>
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

          <?php 
          // Display chat history, skipping the system message
          if (isset($_SESSION['chat_messages']) && is_array($_SESSION['chat_messages'])) {
              foreach ($_SESSION['chat_messages'] as $message) {
                  if (!isset($message['role']) || !isset($message['content'])) {
                      continue;
                  }
                  
                  if ($message['role'] === 'user') {
          ?>
          <!-- User Message -->
          <div class="chat-message user-message mb-3">
            <div class="message-content">
              <div class="message-bubble">
                <p class="mb-0"><?php echo nl2br(htmlspecialchars($message['content'])); ?></p>
              </div>
              <div class="message-info">
                <small class="text-muted">Hôm nay, <?php echo date('H:i'); ?></small>
              </div>
            </div>
            <div class="message-avatar">
              <img src="/public/assets/images/avatar.png" alt="User" class="rounded-circle">
            </div>
          </div>
          <?php } elseif ($message['role'] === 'assistant') { ?>
          <!-- Bot Response -->
          <div class="chat-message bot-message mb-3">
            <div class="message-avatar">
              <img src="/public/assets/images/logo.png" alt="Bot" class="rounded-circle">
            </div>
            <div class="message-content">
              <div class="message-bubble">
                <p class="mb-0"><?php echo nl2br(htmlspecialchars($message['content'])); ?></p>
              </div>
              <div class="message-info">
                <small class="text-muted">Hôm nay, <?php echo date('H:i'); ?></small>
              </div>
            </div>
          </div>
          <?php 
                  }
              }
          }
          ?>
        </div>
      </div>
      <div class="card-footer">
        <form id="chatForm" class="chat-input-form">
          <div class="input-group">
            <input type="text" class="form-control" id="messageInput" name="user_message"
              placeholder="Nhập câu hỏi hoặc yêu cầu..." autocomplete="off" required>
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
            Hiển thị danh sách khách hàng
          </button>
          <button class="list-group-item list-group-item-action suggestion-item">
            Trong 30 ngày tới có ai sinh nhật không?
          </button>
          <button class="list-group-item list-group-item-action suggestion-item">
            Khách hàng có tag VIP
          </button>
          <button class="list-group-item list-group-item-action suggestion-item">
            Thông tin khách hàng mã KH040
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
              <div class="progress-bar bg-success" id="chatbotStatusBar" role="progressbar" style="width: 100%"></div>
            </div>
            <span class="badge bg-success" id="chatbotStatusBadge">Hoạt động tốt</span>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="settingsModalLabel">Cài Đặt Chatbot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
          <label for="gemini_api_key" class="form-label">Gemini API Key</label>
          <div class="input-group">
            <input type="password" class="form-control" id="gemini_api_key" name="gemini_api_key"
              value="<?php echo htmlspecialchars($gemini_api_key); ?>">
            <button class="btn btn-outline-secondary" type="button" id="showGeminiKey">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-outline-primary" type="button" id="testGeminiKey">
              <i class="fas fa-check me-1"></i> Kiểm tra
            </button>
          </div>
          <div class="form-text">API key để kết nối với dịch vụ Google Gemini AI. <a
              href="https://makersuite.google.com/app/apikey" target="_blank">Lấy API key</a></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary" id="saveSettingsBtn">Lưu Thay Đổi</button>
      </div>
    </div>
  </div>
</div>

<!-- API Test Modal -->
<div class="modal fade" id="apiTestModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kiểm Tra API Key</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="apiTestResult">
          <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Đang kiểm tra...</span>
            </div>
          </div>
          <p class="text-center mt-3">Đang kiểm tra kết nối với API...</p>
        </div>
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

/* Typing animation */
.typing-animation span {
  opacity: 0;
  animation: typingDot 1.5s infinite;
}

.typing-animation span:nth-child(1) {
  animation-delay: 0s;
}

.typing-animation span:nth-child(2) {
  animation-delay: 0.5s;
}

.typing-animation span:nth-child(3) {
  animation-delay: 1s;
}

@keyframes typingDot {
  0% {
    opacity: 0;
  }

  50% {
    opacity: 1;
  }

  100% {
    opacity: 0;
  }
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
  const voiceInputBtn = document.getElementById('voiceInputBtn');
  const showGeminiKey = document.getElementById('showGeminiKey');
  const geminiApiKeyInput = document.getElementById('gemini_api_key');
  const testGeminiKeyBtn = document.getElementById('testGeminiKey');
  const saveSettingsBtn = document.getElementById('saveSettingsBtn');

  // Scroll to bottom of chat
  function scrollToBottom() {
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }

  // Add a message to the chat
  function addMessageToChat(sender, content) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `chat-message ${sender}-message mb-3`;
    const currentTime = new Date().toLocaleTimeString([], {
      hour: '2-digit',
      minute: '2-digit'
    });

    messageDiv.innerHTML = sender === 'user' ? `
      <div class="message-content">
        <div class="message-bubble">
          <p class="mb-0">${content.replace(/\n/g, '<br>')}</p>
        </div>
        <div class="message-info">
          <small class="text-muted">Hôm nay, ${currentTime}</small>
        </div>
      </div>
      <div class="message-avatar">
        <img src="/public/assets/images/avatar.png" alt="User" class="rounded-circle">
      </div>
    ` : `
      <div class="message-avatar">
        <img src="/public/assets/images/logo.png" alt="Bot" class="rounded-circle">
      </div>
      <div class="message-content">
        <div class="message-bubble">
          <p class="mb-0">${content.replace(/\n/g, '<br>')}</p>
        </div>
        <div class="message-info">
          <small class="text-muted">Hôm nay, ${currentTime}</small>
        </div>
      </div>
    `;

    chatContainer.appendChild(messageDiv);
    scrollToBottom();
  }

  // Show typing indicator
  function showTypingIndicator() {
    const typingIndicator = document.getElementById('typingIndicator');
    typingIndicator.innerHTML = 'Bot đang nhập...';
    const messageDiv = document.createElement('div');
    messageDiv.className = 'chat-message bot-message mb-3';
    messageDiv.id = 'typingMessage';
    messageDiv.innerHTML = `
      <div class="message-avatar">
        <img src="/public/assets/images/logo.png" alt="Bot" class="rounded-circle">
      </div>
      <div class="message-content">
        <div class="message-bubble">
          <p class="mb-0"><span class="typing-animation">Bot đang nhập<span>.</span><span>.</span><span>.</span></span></p>
        </div>
      </div>
    `;
    chatContainer.appendChild(messageDiv);
    scrollToBottom();
  }

  // Remove typing indicator
  function hideTypingIndicator() {
    const typingIndicator = document.getElementById('typingIndicator');
    typingIndicator.innerHTML = '';
    const typingMessage = document.getElementById('typingMessage');
    if (typingMessage) typingMessage.remove();
  }

  // Show quota exceeded error
  function showQuotaExceededError() {
    hideTypingIndicator();
    const errorMessage =
      'Lỗi: Hệ thống đã đạt giới hạn sử dụng API. Vui lòng thử lại sau hoặc liên hệ quản trị viên.';
    addMessageToChat('bot', errorMessage);
    const statusBadge = document.getElementById('chatbotStatusBadge');
    if (statusBadge) {
      statusBadge.className = 'badge bg-danger ms-2';
      statusBadge.textContent = 'Lỗi API';
    }
    const progressBar = document.getElementById('chatbotStatusBar');
    if (progressBar) {
      progressBar.className = 'progress-bar bg-danger';
      progressBar.style.width = '100%';
    }
  }

  // Initialize chat
  scrollToBottom();

  // Handle form submission with AJAX
  chatForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const userMessage = messageInput.value.trim();
    if (!userMessage) return;

    addMessageToChat('user', userMessage);
    messageInput.value = '';
    showTypingIndicator();

    fetch(window.location.href, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'user_message=' + encodeURIComponent(userMessage)
      })
      .then(response => response.json().catch(() => response.text()))
      .then(response => {
        hideTypingIndicator();
        if (typeof response === 'object' && response.chat_reply) {
          addMessageToChat('bot', response.chat_reply);
        } else if (typeof response === 'object' && response.error) {
          if (response.error.includes('quota exceeded') || response.error.includes('429') || response.error
            .includes('Hạn mức API') || response.error.includes('giới hạn')) {
            showQuotaExceededError();
          } else {
            addMessageToChat('bot', 'Lỗi: ' + response.error);
          }
        } else if (typeof response === 'string') {
          try {
            const parser = new DOMParser();
            const doc = parser.parseFromString(response, 'text/html');
            const sessionMessages = doc.querySelectorAll('.bot-message .message-bubble p');
            if (sessionMessages.length > 0) {
              const lastMessage = sessionMessages[sessionMessages.length - 1];
              const content = lastMessage.innerHTML.replace(/<br>/g, '\n');
              if (content) {
                addMessageToChat('bot', content);
                return;
              }
            }
            addMessageToChat('bot',
              'Xin lỗi, tôi không thể xử lý yêu cầu của bạn lúc này. Vui lòng thử lại sau.');
          } catch (error) {
            console.error('Error parsing HTML response:', error);
            addMessageToChat('bot', 'Xin lỗi, có lỗi khi xử lý phản hồi. Vui lòng thử lại sau.');
          }
        } else {
          addMessageToChat('bot',
            'Xin lỗi, tôi không thể xử lý yêu cầu của bạn lúc này. Vui lòng thử lại sau.');
        }
      })
      .catch(error => {
        console.error('AJAX Error:', error);
        hideTypingIndicator();
        addMessageToChat('bot', 'Đã xảy ra lỗi khi gửi tin nhắn. Vui lòng thử lại sau.');
      });
  });

  // Handle clear chat button
  clearChatBtn.addEventListener('click', function() {
    if (confirm('Bạn có chắc chắn muốn xóa toàn bộ cuộc trò chuyện?')) {
      fetch(window.location.href, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'clear_chat=1'
        })
        .then(() => {
          const messages = chatContainer.querySelectorAll('.chat-message');
          for (let i = 1; i < messages.length; i++) {
            messages[i].remove();
          }


        })
        .catch(error => {
          console.error('Lỗi khi xóa lịch sử trò chuyện:', error);
          alert('Không thể xóa lịch sử trò chuyện. Vui lòng thử lại.');
        });
    }
  });

  // Handle export chat button
  exportChatBtn.addEventListener('click', function() {
    const chatMessages = chatContainer.innerHTML;
    const blob = new Blob([chatMessages], {
      type: 'text/html'
    });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'chatbot-conversation-' + new Date().toISOString().slice(0, 10) + '.html';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  });

  // Handle suggestion items
  suggestionItems.forEach(item => {
    item.addEventListener('click', function() {
      const suggestionText = this.textContent.trim();
      messageInput.value = suggestionText;
      chatForm.dispatchEvent(new Event('submit', {
        bubbles: true,
        cancelable: true
      }));
    });
  });

  // Handle voice input
  voiceInputBtn.addEventListener('click', function() {
    if ('webkitSpeechRecognition' in window) {
      const recognition = new webkitSpeechRecognition();
      recognition.lang = 'vi-VN';
      recognition.interimResults = false;
      recognition.onresult = function(event) {
        messageInput.value = event.results[0][0].transcript;
      };
      recognition.onerror = function(event) {
        console.error('Speech recognition error', event.error);
        alert('Không thể nhận dạng giọng nói: ' + event.error);
      };
      recognition.start();
    } else {
      alert('Trình duyệt của bạn không hỗ trợ nhận dạng giọng nói.');
    }
  });

  // Toggle Gemini API key visibility
  if (showGeminiKey && geminiApiKeyInput) {
    showGeminiKey.addEventListener('click', function() {
      geminiApiKeyInput.type = geminiApiKeyInput.type === 'password' ? 'text' : 'password';
      showGeminiKey.innerHTML = geminiApiKeyInput.type === 'password' ? '<i class="fas fa-eye"></i>' :
        '<i class="fas fa-eye-slash"></i>';
    });
  }

  // Test Gemini API key
  if (testGeminiKeyBtn && geminiApiKeyInput) {
    testGeminiKeyBtn.addEventListener('click', function() {
      const apiKey = geminiApiKeyInput.value.trim();
      if (!apiKey) {
        alert('Vui lòng nhập Gemini API key để kiểm tra');
        return;
      }
      const apiTestModal = new bootstrap.Modal(document.getElementById('apiTestModal'));
      apiTestModal.show();
      fetch('https://generativelanguage.googleapis.com/v1beta/models?key=' + apiKey)
        .then(response => {
          if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
          return response.json();
        })
        .then(data => {
          document.getElementById('apiTestResult').innerHTML = `
            <div class="text-center">
              <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
              <h5>Kết nối thành công!</h5>
              <p>API key hợp lệ và sẵn sàng sử dụng.</p>
              <p class="text-muted small">Mô hình: ${data.models[0].name}</p>
            </div>
          `;
        })
        .catch(error => {
          document.getElementById('apiTestResult').innerHTML = `
            <div class="text-center">
              <i class="fas fa-times-circle text-danger fa-4x mb-3"></i>
              <h5>Kết nối thất bại</h5>
              <p>Không thể kết nối với Gemini API. Vui lòng kiểm tra lại API key.</p>
              <p class="text-muted small">Lỗi: ${error.message}</p>
            </div>
          `;
        });
    });
  }

  // Save settings
  if (saveSettingsBtn) {
    saveSettingsBtn.addEventListener('click', function() {
      const formData = new FormData();
      formData.append('action', 'save_settings');
      formData.append('gemini_api_key', geminiApiKeyInput.value.trim());
      formData.append('response_mode', document.querySelector('input[name="responseMode"]:checked').value);
      formData.append('data_access_customers', document.getElementById('dataAccessCustomers').checked ? '1' :
        '0');
      formData.append('data_access_projects', document.getElementById('dataAccessProjects').checked ? '1' :
        '0');
      formData.append('data_access_interactions', document.getElementById('dataAccessInteractions').checked ?
        '1' : '0');
      formData.append('data_access_financial', document.getElementById('dataAccessFinancial').checked ? '1' :
        '0');

      fetch(window.location.href, {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(() => {
          const settingsModal = bootstrap.Modal.getInstance(document.getElementById('settingsModal'));
          settingsModal.hide();
          alert('Cài đặt đã được lưu thành công!');
          window.location.reload();
        })
        .catch(error => {
          alert('Không thể lưu cài đặt: ' + error.message);
        });
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