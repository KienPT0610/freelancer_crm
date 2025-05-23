<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Chủ - Phạm Trung Kiên</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="./../../../public/assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#mainNav" data-offset="70">

  <header class="fixed-top bg-white shadow-sm" id="mainNav">
    <nav class="navbar navbar-expand-lg navbar-light container">
      <a class="navbar-brand" href="#">
        <img src="./../../../public/assets/images/logo.png" alt="Logo Phạm Trung Kiên" height="30"> [Freelancer] Phạm
        Trung Kiên
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#hero">Trang Chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">Về Tôi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Dịch Vụ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#portfolio">Dự Án</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#testimonials">Đánh Giá</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Liên Hệ</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <section class="hero py-10 bg-gradient-primary text-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
          <h1 class="display-4">Chào mừng bạn đến với thế giới Blockchain!</h1>
          <p class="lead"><?php echo $contents[0]['content_value']; ?></p>
          <a href="#contact" class="btn btn-light btn-lg">Liên hệ ngay</a>
        </div>
        <div class="col-md-6 animate__animated animate__fadeInRight">
          <img src="./../../../public/assets/images/hero-image.png" alt="Hình ảnh giới thiệu Blockchain"
            class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4 animate__animated animate__fadeInUp">Về Tôi</h2>
      <div class="row align-items-center">
        <div class="col-md-4 animate__animated animate__fadeInLeft">
          <img src="./../../../public/assets/images/avatar.png" alt="Avatar Phạm Trung Kiên"
            class="img-fluid rounded-circle shadow">
        </div>
        <div class="col-md-8 animate__animated animate__fadeInRight">
          <h3>Phạm Trung Kiên</h3>
          <p class="lead">Chuyên gia Blockchain Freelancer.</p>
          <p>Với niềm đam mê sâu sắc và kinh nghiệm nhiều năm trong lĩnh vực Blockchain, tôi, Phạm Trung Kiên, mang đến
            những giải pháp công nghệ tiên tiến và đáng tin cậy cho các dự án của bạn. Từ việc tư vấn chiến lược, phát
            triển ứng dụng phi tập trung (DApps), đến triển khai các giải pháp blockchain tùy chỉnh, tôi cam kết đồng
            hành cùng bạn để hiện thực hóa ý tưởng và đạt được thành công vượt trội trong kỷ nguyên số này. Sự tận tâm,
            kiến thức chuyên môn vững vàng và khả năng giải quyết vấn đề hiệu quả là những giá trị cốt lõi mà tôi luôn
            mang đến cho mọi dự án.</p>
          <div class="row mt-4">
            <div class="col-md-4">
              <div class="d-flex align-items-center">
                <i class="fas fa-tasks fa-2x mr-3 text-primary"></i>
                <div>
                  <h5 class="mb-0">100</h5>
                  <small class="text-muted">Đang thực hiện</small>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex align-items-center">
                <i class="fas fa-check-double fa-2x mr-3 text-success"></i>
                <div>
                  <h5 class="mb-0">75</h5>
                  <small class="text-muted">Đã hoàn thành</small>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex align-items-center">
                <i class="fas fa-trophy fa-2x mr-3 text-warning"></i>
                <div>
                  <h5 class="mb-0">74</h5>
                  <small class="text-muted">Thành công</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="services" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4 animate__animated animate__fadeInUp">Dịch Vụ Của Tôi</h2>
      <div class="row">
        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
          <div class="card shadow-sm border-left-primary border-left-thick h-100">
            <div class="card-body">
              <i class="fas fa-code fa-3x mb-2 text-primary"></i>
              <h5 class="card-title"><?php echo $contents[1]['content_value']; ?></h5>
              <p class="card-text"><?php echo $contents[2]['content_value']; ?></p>
              <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết <i
                  class="fas fa-arrow-right ml-1"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp animate__delay-1-5s">
          <div class="card shadow-sm border-left-success border-left-thick h-100">
            <div class="card-body">
              <i class="fas fa-paint-brush fa-3x mb-2 text-success"></i>
              <h5 class="card-title"><?php echo $contents[3]['content_value']; ?></h5>
              <p class="card-text"><?php echo $contents[4]['content_value']; ?></p>
              <a href="#" class="btn btn-outline-success btn-sm">Xem chi tiết <i
                  class="fas fa-arrow-right ml-1"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
          <div class="card shadow-sm border-left-info border-left-thick h-100">
            <div class="card-body">
              <i class="fas fa-chart-bar fa-3x mb-2 text-info"></i>
              <h5 class="card-title"><?php echo $contents[5]['content_value']; ?></h5>
              <p class="card-text"><?php echo $contents[6]['content_value']; ?></p>
              <a href="#" class="btn btn-outline-info btn-sm">Xem chi tiết <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="portfolio" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4 animate__animated animate__fadeInUp">Dự Án Nổi Bật</h2>
      <div class="row">
        <?php foreach (array_slice($projects, 0, 2) as $project): ?>
        <div class="col-md-6 mb-4 animate__animated animate__fadeInLeft animate__delay-0-5s">
          <div class="card shadow-sm">
            <img src="./../../../public/assets/images/project-1.jpg" alt="<?php echo $project['name']; ?>"
              class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?php echo $project['name']; ?></h5>
              <p class="card-text"><?php echo $project['description']; ?></p>
              <a href="<?php echo $project['link']; ?>" class="btn btn-primary btn-sm">Xem dự án <i
                  class="fas fa-external-link-alt ml-1"></i></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center mt-3 animate__animated animate__fadeInUp animate__delay-1s">
        <a href="#" class="btn btn-outline-secondary">Xem tất cả dự án <i class="fas fa-folder-open ml-1"></i></a>
      </div>
    </div>
  </section>

  <section id="testimonials" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4 animate__animated animate__fadeInUp">Khách Hàng Nói Về Tôi</h2>
      <div class="row">
        <div class="col-md-6 mb-4 animate__animated animate__fadeInLeft animate__delay-0-5s">
          <div class="card shadow-sm border-left-warning border-left-thick h-100">
            <div class="card-body d-flex">
              <img src="./../../../public/assets/images/avatar-client-1.png" alt="Avatar khách hàng 1"
                class="rounded-circle mr-3" width="60" height="60">
              <div>
                <p class="card-text"><i class="fas fa-quote-left text-muted mr-2"></i> [Lời chứng thực 1 từ khách hàng].
                  <i class="fas fa-quote-right text-muted ml-2"></i>
                </p>
                <h6 class="card-subtitle mb-2 text-muted">- [Tên Khách Hàng 1], [Công Ty/Vị Trí]</h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 animate__animated animate__fadeInRight animate__delay-0-5s">
          <div class="card shadow-sm border-left-warning border-left-thick h-100">
            <div class="card-body d-flex">
              <img src="./../../../public/assets/images/avatar-client-1.png" alt="Avatar khách hàng 2"
                class="rounded-circle mr-3" width="60" height="60">
              <div>
                <p class="card-text"><i class="fas fa-quote-left text-muted mr-2"></i> [Lời chứng thực 2 từ khách hàng].
                  <i class="fas fa-quote-right text-muted ml-2"></i>
                </p>
                <h6 class="card-subtitle mb-2 text-muted">- [Tên Khách Hàng 2], [Công Ty/Vị Trí]</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4 animate__animated animate__fadeInUp">Liên Hệ Với Tôi</h2>

      <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
        <i class="fas fa-exclamation-triangle mr-2"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
          <h3>Gửi tin nhắn cho tôi</h3>
          <form action="/contact" method="post">
            <div class="form-group">
              <label for="name">Tên của bạn:</label>
              <input type="text" class="form-control" id="name" name="name"
                value="<?php echo $_SESSION['form_data']['name'] ?? ''; ?>" required>
              <?php if (isset($_SESSION['form_errors']['name'])): ?>
              <small class="text-danger"><?php echo $_SESSION['form_errors']['name']; ?></small>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="email">Địa chỉ email:</label>
              <input type="email" class="form-control" id="email" name="email"
                value="<?php echo $_SESSION['form_data']['email'] ?? ''; ?>" required>
              <?php if (isset($_SESSION['form_errors']['email'])): ?>
              <small class="text-danger"><?php echo $_SESSION['form_errors']['email']; ?></small>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="phone">Số điện thoại:</label>
              <input type="tel" class="form-control" id="phone" name="phone"
                value="<?php echo $_SESSION['form_data']['phone'] ?? ''; ?>">
            </div>
            <div class="form-group">
              <label for="message">Lời nhắn:</label>
              <textarea class="form-control" id="message" name="message" rows="5"
                required><?php echo $_SESSION['form_data']['message'] ?? ''; ?></textarea>
              <?php if (isset($_SESSION['form_errors']['message'])): ?>
              <small class="text-danger"><?php echo $_SESSION['form_errors']['message']; ?></small>
              <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">Gửi tin nhắn <i
                class="fas fa-paper-plane ml-2"></i></button>
          </form>
          <?php 
            // Clear form data and errors after displaying
            if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']); 
            if (isset($_SESSION['form_errors'])) unset($_SESSION['form_errors']); 
          ?>
        </div>
        <div class="col-md-6 animate__animated animate__fadeInRight">
          <h3>Thông tin liên hệ</h3>
          <p><i class="fas fa-map-marker-alt mr-2 text-primary"></i> Chinh Kinh - Nhân Chính - Thanh Xuân</p>
          <p><i class="fas fa-envelope mr-2 text-primary"></i> fbkienpt@gmail.com</p>
          <p><i class="fas fa-phone mr-2 text-primary"></i> 0867576501</p>
          <div class="mt-4">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.675840829465!2d105.807009375876!3d21.0057882806067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad4fa5a71153%3A0xfa79a64133415485!2zTeG7biBCw6JuaCwgVGhhbmh XuXUsIEjDoCBOw6NuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1630538858749!5m2!1svi!2s"
              width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
      <p>© <?php echo date("Y"); ?> Phạm Trung Kiên. All rights reserved.</p>
      <div class="mt-2">
        <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f fa-lg"></i></a>
        <a href="#" class="text-white mr-3"><i class="fab fa-twitter fa-lg"></i></a>
        <a href="#" class="text-white mr-3"><i class="fab fa-linkedin-in fa-lg"></i></a>
        <a href="#" class="text-white"><i class="fab fa-github fa-lg"></i></a>
      </div>
    </div>
  </footer>
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
  (function() {
    var s1 = document.createElement("script"),
      s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/682f66ab16f3f4bfe08ee500/1irsii3jh';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();
  </script>
  <!--End of Tawk.to Script-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>