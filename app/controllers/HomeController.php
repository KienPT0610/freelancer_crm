<?php
namespace App\Controllers;

use App\Models\Contact;

class HomeController {
  public function index() {
    require __DIR__ . '/../views/home/index.php';
  }

  public function contact() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Filter and validate input data
      $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'message' => $_POST['message'] ?? ''
      ];
      
      // Simple validation
      $errors = [];
      if (empty($data['name'])) {
        $errors['name'] = 'Name is required';
      }
      if (empty($data['email'])) {
        $errors['email'] = 'Email is required';
      }
      if (empty($data['message'])) {
        $errors['message'] = 'Message is required';
      }
      
      if (empty($errors)) {
        $contactModel = new Contact();
        $contactId = $contactModel->createContact($data);
        
        if ($contactId) {
          $_SESSION['success'] = 'Your message has been sent. We will contact you soon!';
        } else {
          $_SESSION['error'] = 'There was an error sending your message. Please try again.';
        }
      } else {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $data;
      }
    }
    
    // Redirect back to the home page (PRG pattern)
    header('Location: /');
    exit();
  }
}

?>