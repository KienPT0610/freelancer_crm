$(document).ready(function() {
  // Active class on nav link when scrolling
  $(window).scroll(function() {
      var scrollDistance = $(window).scrollTop() + 70; // Thêm offset bằng chiều cao header

      $('.navbar-nav .nav-link').each(function() {
          var sectionAttr = $(this).attr('href');
          var section = $(sectionAttr);

          if (section.length) {
              if (section.offset().top <= scrollDistance && section.offset().top + section.outerHeight() > scrollDistance) {
                  $('.navbar-nav .nav-link').removeClass('active');
                  $(this).addClass('active');
              }
          }
      });
  }).scroll(); // Kích hoạt scroll listener khi trang tải lần đầu

  // Smooth scrolling when clicking on nav links
  $('.navbar-nav .nav-link').on('click', function(event) {
      if (this.hash !== "") {
          event.preventDefault();

          var hash = this.hash;

          $('html, body').animate({
              scrollTop: $(hash).offset().top - 69 // Offset bằng chiều cao header
          }, 800, function(){
              window.location.hash = hash;
          });
      }
  });
});