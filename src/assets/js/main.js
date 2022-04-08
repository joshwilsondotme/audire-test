$('.wp-block-image img').addClass('lazyload');

/*-----------------------------------------------------------------------------------*/
/*  Scroll To Top Button
/*-----------------------------------------------------------------------------------*/

  function initGoToTop() {

  // fade in #top_button
  $(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $('.backtotop-btn').addClass("active");
      } else {
        $('.backtotop-btn').removeClass("active");
      }
    });

    // scroll body to 0px on click
    $('.backtotop-btn').click(function () {
      $('body,html').animate({
        scrollTop: 0
      },700);
      return false;
      });
    });

    if ($(window).scrollTop() > 100) {
      $('.backtotop-btn').addClass("active");
    }
  }
  initGoToTop();
