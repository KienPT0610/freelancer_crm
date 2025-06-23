<?php
/**
 * Template file for admin pages
 * 
 * To use this template:
 * 1. Copy this file to a new view file
 * 2. Change the $page_title and $active_page variables
 * 3. Replace the content section with your page-specific content
 */

// Set variables for the layout
$page_title = 'Page Title'; // Change this to your page title
$active_page = 'page_name'; // Change this to match the sidebar menu item (dashboard, freelancers, projects, clients, etc.)

// Optional features
$use_chart_js = false; // Set to true if you need Chart.js

// Start output buffering to capture content
ob_start();
?>

<!-- Your page content goes here -->
<div class="card">
  <div class="card-header">
    <h5>Content Header</h5>
  </div>
  <div class="card-body">
    <p>Replace this with your page content.</p>
  </div>
</div>

<?php
// Get content from buffer
$content = ob_get_clean();

// Include the layout template
include __DIR__ . '/layout.php';
?>