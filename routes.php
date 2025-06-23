<?php
// Xử lý đường dẫn
use App\Controllers\HomeController;
use App\Controllers\AdminController;

require __DIR__ . '/app/controllers/AdminController.php';
require __DIR__ . '/app/controllers/HomeController.php';

$request = $_SERVER['REQUEST_URI'];

if ($request == '/') {
  $homeController = new HomeController();
  $homeController->index();

} elseif ($request == '/contact') {
  $homeController = new HomeController();
  $homeController->contact();
  
} elseif ($request == '/admin') {
  $adminController = new AdminController();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminController->login(); // Xử lý form login
  } else {
    $adminController->index(); // Hiển thị form login
  }

} elseif ($request == '/admin/dashboard') {
  $adminController = new AdminController();
  $adminController->dashboard();

} elseif ($request == '/admin/customers') {
  $adminController = new AdminController();
  $adminController->customers();
} elseif ($request == '/admin/customers/add') {
  $adminController = new AdminController();
  $adminController->addCustomer();

} elseif (preg_match('#^/admin/customers/(\d+)$#', $request, $matches)) {
  $id = $matches[1];
  $adminController = new AdminController();
  $adminController->customerDetail($id);

} elseif (preg_match('#^/admin/customers/(\d+)/update$#', $request, $matches)) {
  $id = $matches[1]; 
  $adminController = new AdminController();
  $adminController->updateCustomer($id);
} elseif (preg_match('#^/admin/customers/(\d+)/delete$#', $request, $matches)) {
  $id = $matches[1];
  $adminController = new AdminController();
  $adminController->deleteCustomer($id);

} elseif ($request == '/admin/projects') {
  $adminController = new AdminController();
  $adminController->projects();

} elseif ($request == '/admin/interactions') {
  $adminController = new AdminController();
  $adminController->interactions();
} elseif (preg_match('#^/admin/customers/(\d+)/interaction/add#', $request, $matches)) {
  $customer_id = $matches[1];
  $adminController = new AdminController();
  $adminController->addInteraction($customer_id);

} elseif (preg_match('#^/admin/interactions/(\d+)/delete$#', $request, $matches)) {
  $interaction_id = $matches[1];
  $adminController = new AdminController();
  $adminController->deleteInteraction($interaction_id);

} elseif ($request == '/admin/contacts') {
  $adminController = new AdminController();
  $adminController->contacts();

} elseif (preg_match('#^/admin/interactions/(\d+)$#', $request, $matches)) {
  $id = $matches[1];
  $adminController = new AdminController();
  $adminController->interactionDetail($id);

} elseif (preg_match('#^/admin/interactions/(\d+)/update$#', $request, $matches)) {
  $id = $matches[1];
  $adminController = new AdminController();
  $adminController->updateInteraction($id);

} elseif ($request == '/admin/profile') {
  $adminController = new AdminController();
  $adminController->profile();

} elseif ($request == '/admin/settings') {
  $adminController = new AdminController();
  $adminController->settings();
  
} elseif ($request == '/admin/site-content') {
  $adminController = new AdminController();
  $adminController->siteContent();
} elseif($request == '/admin/site-content/add') {
  $adminController = new AdminController();
  $adminController->addSiteContent();
  
} elseif (preg_match('#^/admin/site-content/(\d+)/update$#', $request, $matches)) {
  $id = $matches[1];
  $adminController = new AdminController();
  $adminController->updateSiteContent($id);
  
} elseif (preg_match('#^/admin/site-content/(\d+)/delete$#', $request, $matches)) {
  $id = $matches[1];
  $adminController = new AdminController();
  $adminController->deleteSiteContent($id);
  
} elseif ($request == '/admin/chatbot') {
  $adminController = new AdminController();
  $adminController->chatbot();
  
} elseif ($request == '/logout') {
  $adminController = new AdminController();
  $adminController->logout();
  
} elseif ($request == '/admin/test') {
  include __DIR__ . '/app/views/admin/test.php';
} else {
  http_response_code(404);
  echo "404 Not Found";
}