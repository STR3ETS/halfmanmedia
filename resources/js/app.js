import './bootstrap';

$(document).ready(function() {
    var leftHeight = $('#home-hero-left').outerHeight();
    $('#home-hero-right').height(leftHeight);
});

$(document).on('scroll', function() {
  if($(document).scrollTop() > 100) {
    $('#navbar').css('background-color', '#241B12');
  } else {
    $('#navbar').css('background-color', 'transparent');
  }
})

$(document).ready(function(){
  $('#navbar-dropdown-diensten-content').hide();

  $('#navbar-dropdown-diensten-toggle').hover(
      function() {
          $('#navbar-dropdown-diensten-content').stop(true, true).fadeIn(200);
          $(this).css('background-color', '#36291B');
      },
      function() {
          setTimeout(() => {
              if (!$('#navbar-dropdown-diensten-content').is(':hover')) {
                  $('#navbar-dropdown-diensten-content').fadeOut(200);
                  $(this).css('background-color', '');
              }
          }, 200);
      }
  );

  $('#navbar-dropdown-diensten-content').hover(
      function() {
          $(this).stop(true, true).fadeIn(200);
      },
      function() {
          $(this).fadeOut(200);
          $('#navbar-dropdown-diensten-toggle').css('background-color', '');
      }
  );
});

$('.hamburger-menu-open-icon').on('click', function() {
  $('.hamburger-menu').toggleClass('active')
});
$('.hamburger-menu-close-icon').on('click', function() {
  $('.hamburger-menu').toggleClass('active')
});

gsap.from("body", { opacity: 0, duration: 0.3 });

document.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", (event) => {
        let href = link.getAttribute("href");
        if (href && !href.startsWith("#")) {
            event.preventDefault();
            gsap.to("body", { opacity: 0, duration: 0.3, onComplete: () => {
                window.location.href = href;
            }});
        }
    });
});