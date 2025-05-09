<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Customer;
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
    
    // If customer not found, redirect to customers list
    if (!$customer) {
      header('Location: /admin/customers');
      exit();
    }
    include __DIR__ . '/../views/admin/customer-detail.php';
  }

  public function updateCustomer($id) {
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      // If not POST, show the customer detail page
      $this->customerDetail($id);
      return;
    }
    
    $customerModel = new Customer();

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

  public function projects() {
    include __DIR__ . '/../views/admin/projects.php';
  }

  public function interactions() {
    include __DIR__ . '/../views/admin/interactions.php';
  }

  public function contacts() {
    include __DIR__ . '/../views/admin/contacts.php';
  }

  public function profile() {
    include __DIR__ . '/../views/admin/profile.php';
  }

  public function settings() {
    include __DIR__ . '/../views/admin/settings.php';
  }

}

?>