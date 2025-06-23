<?php
require __DIR__ . '/vendor/autoload.php';

// Lấy đường dẫn từ URL
session_start();
$request = $_SERVER['REQUEST_URI'];

// Gọi file routes để xử lý điều hướng
require_once __DIR__ . '/routes.php';