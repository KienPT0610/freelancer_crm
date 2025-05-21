<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Interaction;
use App\Models\SiteContent;

class AdminController {
  public function index() {
    // Nếu đã login thì redirect về home
    if (isset($_SESSION['user'])) {
      header('Location: /admin/dashboard');
      exit();
    }

    // Nếu chưa login, show form login
    $errors = [];
    include __DIR__ . '/../views/admin/login.php';
  }

  public function login() {
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $userModel = new User();
      $user = $userModel->login($username, $password);

      if ($user) {
        $_SESSION['user'] = $user;
        header('Location: /admin/dashboard');
        exit();
      } else {
        $errors['error'] = 'Invalid username or password';
      }
    }

    include __DIR__ . '/../views/admin/login.php';
  } 

  public function logout() {
    session_destroy();
    header('Location: /admin');
    exit();
  }

  public function dashboard() {
    include __DIR__ . '/../views/admin/dashboard.php';
  }

  public function customers() {
    // Load customer model
    $customerModel = new Customer();
    $customers = $customerModel->getAllCustomers();
    
    include __DIR__ . '/../views/admin/customers.php';
  }
  
  public function customerDetail($id = null) {
    // If no ID provided, redirect to customers list
    if (!$id) {
      header('Location: /admin/customers');
      exit();
    }
    
    // Load customer model
    $customerModel = new Customer();
    $customer = $customerModel->getCustomerById($id);
    $projectModel = new Project();
    $projects = $projectModel->getProjectByCustomerId($id);
    $interactionModel = new Interaction();
    $interactions = $interactionModel->getInteractionByCustomerId($id);
    
    // If customer not found, redirect to customers list
    if (!$customer) {
      header('Location: /admin/customers');
      exit();
    }
    include __DIR__ . '/../views/admin/customer-detail.php';
  }

  public function addCustomer() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerModel = new Customer();
        // Tạo mảng $data với tất cả các khóa cần thiết
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'company' => $_POST['company'] ?? '',
            'address' => $_POST['address'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'source' => $_POST['source'] ?? '',
            'status' => $_POST['status'] ?? '',
            'tags' => $_POST['tags'] ?? ''
        ];

        // Kiểm tra trường bắt buộc
        if (empty($data['name'])) {
            $_SESSION['error'] = "Tên khách hàng là bắt buộc.";
            header('Location: /admin/customers/add');
            exit();
        }

        try {
            $customerModel->addCustomer($data);
            $_SESSION['success'] = "Thêm khách hàng thành công!";
            header('Location: /admin/customers');
            exit();
        } catch (\PDOException $e) {
            $_SESSION['error'] = "Lỗi khi thêm khách hàng: " . $e->getMessage();
            header('Location: /admin/customers/add');
            exit();
        }
    }

    include __DIR__ . '/../views/admin/customers.php';
}

  public function updateCustomer($id) {
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      // If not POST, show the customer detail page
      $this->customerDetail($id);
      return;
    }
    
    $customerModel = new Customer();

    if (isset($_FILES['avatar_url']) && $_FILES['avatar_url']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = __DIR__ . './../../public/uploads/';
      if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0755, true);
      }
      $fileName = uniqid() . '-' . $_FILES['avatar_url']['name'];
      $uploadPath = $uploadDir . $fileName;

      $_POST['avatar_url'] = $fileName;

      if (move_uploaded_file($_FILES['avatar_url']['tmp_name'], $uploadPath)) {
          $data['avatar_url'] = "/uploads/$fileName";
      } else {
          $_SESSION['error'] = "Lỗi tải ảnh.";
          header("Location: /admin/customers/$id");
          exit();
      }
    }

    // Get POST data and filter out empty values
    $data = array_filter($_POST, function($value) {
      return $value !== '' && $value !== null;
    });
    
    // Remove any unnecessary fields that shouldn't be in the database
    unset($data['submit']);
    
    if (empty($data)) {
      // Handle case when no data was submitted
      header('Location: /admin/customers/' . $id);
      exit();
    }
    
    $success = $customerModel->updateCustomer($id, $data);

    if (!$success) {
      // Handle update failure
      $_SESSION['error'] = 'Failed to update customer.';
    } else {
      $_SESSION['success'] = 'Customer updated successfully.';
    }

    // Redirect back to the customer detail page
    header('Location: /admin/customers/' . $id);
    exit();
  }

  public function deleteCustomer($id) {
    $customerModel = new Customer();
    $success = $customerModel->deleteCustomer($id);
    
    if ($success) {
      $_SESSION['success'] = 'Customer deleted successfully.';
    } else {
      $_SESSION['error'] = 'Failed to delete customer.';
    }
    
    header('Location: /admin/customers');
    exit();
  }

  public function projects() {
    $projectModel = new Project();
    $projects = $projectModel->getAllProjects();
    include __DIR__ . '/../views/admin/projects.php';
  }

  public function interactions() {
    $interactionModel = new Interaction();
    $customerModel = new Customer();
    $customers = $customerModel->getAllCustomers();
    $interactions = $interactionModel->getAllInteractions();
    $selectedInteraction = null;
    include __DIR__ . '/../views/admin/interactions.php';
  }

  public function addInteraction($customer_id) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $interactionModel = new Interaction();
      $interactionModel->addInteraction(
        $customer_id,
        $_POST['type'] ?? '',
        $_POST['date'] ?? '',
        $_POST['summary'] ?? ''
      );
      header('Location: /admin/customers/' . $customer_id);
      exit();
    }
    
    include __DIR__ . '/../views/admin/interactions.php';
  }

  public function deleteInteraction($interaction_id) {
    $interactionModel = new Interaction();
    $interactionModel->deleteInteraction($interaction_id);
    header('Location: /admin/interactions');
    exit();
  }

  public function contacts() {
    $contactModel = new Contact();
    $contacts = $contactModel->getAllContacts();
    include __DIR__ . '/../views/admin/contacts.php';
  }

  public function profile() {
    include __DIR__ . '/../views/admin/profile.php';
  }

  public function settings() {
    include __DIR__ . '/../views/admin/settings.php';
  }

  public function interactionDetail($id = null) {
    // If no ID provided, redirect to interactions list
    if (!$id) {
      header('Location: /admin/interactions');
      exit();
    }
    
    // Load interaction model
    $interactionModel = new Interaction();
    $interaction = $interactionModel->getInteractionById($id);
    
    // If interaction not found, redirect to interactions list
    if (!$interaction) {
      $_SESSION['error'] = 'Tương tác không tồn tại.';
      header('Location: /admin/interactions');
      exit();
    }
    
    // Get customer details
    $customerModel = new Customer();
    $customer = $customerModel->getCustomerById($interaction['customer_id']);
    
    // Get related interactions (same customer)
    $relatedInteractions = $interactionModel->getInteractionByCustomerId($interaction['customer_id']);
    
    // Render the view
    include __DIR__ . '/../views/admin/interaction-detail.php';
  }

  public function updateInteraction($id) {
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      // If not POST, show the interaction detail page
      $this->interactionDetail($id);
      return;
    }
    
    $interactionModel = new Interaction();

    // Get POST data and filter out empty values
    $data = [
      'interaction_type' => $_POST['interaction_type'] ?? '',
      'interaction_date' => $_POST['interaction_date'] ?? '',
      'summary' => $_POST['summary'] ?? ''
    ];

    // Remove any unnecessary fields that shouldn't be in the database
    unset($data['submit']);
    
    if (empty($data)) {
      // Handle case when no data was submitted
      header('Location: /admin/interactions/' . $id);
      exit();
    }

    $success = $interactionModel->updateInteraction($id, $data);

    if (!$success) {
      // Handle update failure
      $_SESSION['error'] = 'Failed to update interaction.';
    } else {
      $_SESSION['success'] = 'Interaction updated successfully.';
    }

    // Redirect back to the interaction detail page
    header('Location: /admin/interactions/' . $id);
    exit();
  }

  public function siteContent() {
    $siteContentModel = new SiteContent();
    $contents = $siteContentModel->getAllContent();
    include __DIR__ . '/../views/admin/site-content.php';
  }

  public function addSiteContent() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $siteContentModel = new SiteContent();
      $data = [
        'content_key' => $_POST['content_key'] ?? '',
        'content_title' => $_POST['content_title'] ?? '',
        'content_value' => $_POST['content_value'] ?? '',
        'is_active' => $_POST['is_active'] ?? 1
      ];

      $siteContentModel->addContent($data);
      header('Location: /admin/site-content');
      exit();
    }

    include __DIR__ . '/../views/admin/add-site-content.php';
  }

  public function updateSiteContent($id) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $siteContentModel = new SiteContent();
      $data = [
        'content_key' => $_POST['content_key'] ?? '',
        'content_title' => $_POST['content_title'] ?? '',
        'content_value' => $_POST['content_value'] ?? '',
        'is_active' => $_POST['is_active']
      ];

      $siteContentModel->updateContent($id, $data);
      header('Location: /admin/site-content');
      exit();
    }

    include __DIR__ . '/../views/admin/update-site-content.php';
  }

}

?>