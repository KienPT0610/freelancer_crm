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

} elseif (preg_match('#^/admin/customers/(\d+)$#', $request, $matches)) {
  $id = $matches[1];
  $adminController = new AdminController();
  $adminController->customerDetail($id);

} elseif (preg_match('#^/admin/customers/(\d+)/update$#', $request, $matches)) {
  $id = $matches[1]; 
  $adminController = new AdminController();
  $adminController->updateCustomer($id);

} elseif ($request == '/admin/projects') {
  $adminController = new AdminController();
  $adminController->projects();

} elseif ($request == '/admin/interactions') {
  $adminController = new AdminController();
  $adminController->interactions();

} elseif ($request == '/admin/contacts') {
  $adminController = new AdminController();
  $adminController->contacts();

} elseif ($request == '/admin/profile') {
  $adminController = new AdminController();
  $adminController->profile();

} elseif ($request == '/admin/settings') {
  $adminController = new AdminController();
  $adminController->settings();

} elseif ($request == '/logout') {
  $adminController = new AdminController();
  $adminController->logout();

} else {
  http_response_code(404);
  echo "404 Not Found";
}