<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title ?? 'Admin'; ?> - Freelancer CRM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <?php if(isset($use_chart_js) && $use_chart_js): ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?php endif; ?>
  <?php include __DIR__ . '/admin-styles.php'; ?>
  <?php if(isset($custom_css)): echo $custom_css; endif; ?>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php include __DIR__ . '/sidebar.php'; ?>

      <!-- Content -->
      <div class="col-lg-10 content-wrapper">
        <?php include __DIR__ . '/navbar.php'; ?>

        <!-- Page Content -->
        <?php echo $content ?? ''; ?>

        <?php include __DIR__ . '/footer.php'; ?>
      </div>
    </div>
  </div>

  <?php if(isset($custom_js)): echo $custom_js; endif; ?>
</body>

</html>