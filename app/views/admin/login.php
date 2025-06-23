<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Freelancer CRM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
  :root {
    --primary-color: #4e73df;
    --secondary-color: #224abe;
  }

  body {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    font-family: 'Poppins', sans-serif;
    height: 100vh;
  }

  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }

  .login-box {
    width: 450px;
    padding: 40px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
  }

  .login-header {
    text-align: center;
    margin-bottom: 30px;
  }

  .login-header h2 {
    margin-bottom: 5px;
    color: var(--primary-color);
    font-weight: 700;
  }

  .login-header p {
    color: #777;
  }

  .login-header .logo-icon {
    font-size: 50px;
    color: var(--primary-color);
    margin-bottom: 15px;
    display: inline-block;
  }

  .login-form .form-group {
    margin-bottom: 20px;
  }

  .login-form .form-control {
    height: 50px;
    border-radius: 5px;
    box-shadow: none;
    border: 1px solid #ddd;
    padding-left: 15px;
  }

  .login-form .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
  }

  .login-form .input-group-text {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
  }

  .login-form .btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    height: 50px;
    font-weight: 600;
    border-radius: 5px;
    transition: all 0.3s;
  }

  .login-form .btn-primary:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .login-form .form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
  }

  .login-footer {
    margin-top: 25px;
    text-align: center;
    color: #777;
  }

  .login-footer a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
  }

  .login-footer a:hover {
    color: var(--secondary-color);
    text-decoration: underline;
  }

  .alert {
    border-radius: 5px;
    font-size: 14px;
    padding: 15px;
    margin-bottom: 20px;
  }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <div class="login-header">
        <i class="fas fa-users-cog logo-icon"></i>
        <h2>Admin Login</h2>
        <p>Freelancer CRM System</p>
      </div>

      <?php if (isset($errors['error'])): ?>
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?php echo $errors['error']; ?>
      </div>
      <?php endif; ?>

      <?php if (isset($errors['success'])): ?>
      <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>
        <?php echo $errors['success']; ?>
      </div>
      <?php endif; ?>

      <form action="/admin" method="post" class="login-form">
        <div class="form-group">
          <label for="username" class="form-label">Email Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your email"
              required autofocus>
          </div>
        </div>

        <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password"
              required>
          </div>
        </div>

        <div class="d-flex justify-content-between mb-4">
          <div class="form-check">
            <input type="checkbox" id="remember" name="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Remember Me</label>
          </div>
          <div>
            <a href="/forgot-password" class="small">Forgot Password?</a>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-sign-in-alt me-2"></i>Login
          </button>
        </div>
      </form>

      <div class="login-footer">
        <p>© <?php echo date('Y'); ?> Freelancer CRM. All rights reserved.</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>