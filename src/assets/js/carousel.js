var swiperBasic = new Swiper('.carousel--basic', {
  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});


var swiperLocationGallery = new Swiper('.location__gallery', {
  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  loop: true,
  autoHeight: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});

var swiperLogoCarousel = new Swiper('.logo-list__carousel--manufacturers', {
  // If we need pagination
  pagination: {
    el: '.swiper-pagination--manufacturers',
  },

  breakpoints: {
    425: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    640: {
      slidesPerView: 5,
      spaceBetween: 30
    }
  },
  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next--manufacturers',
    prevEl: '.swiper-button-prev--manufacturers',
  },
});

var swiperLogoCarousel = new Swiper('.logo-list__carousel--custom', {
  // If we need pagination
  pagination: {
    el: '.swiper-pagination--custom',
  },

  breakpoints: {
    425: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    640: {
      slidesPerView: 5,
      spaceBetween: 30
    }
  },
  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next--custom',
    prevEl: '.swiper-button-prev--custom',
  },
});

var swiperLogoCarousel = new Swiper('.logo-list__carousel--associations', {
  // If we need pagination
  pagination: {
    el: '.swiper-pagination--associations',
  },

  breakpoints: {
    425: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    640: {
      slidesPerView: 5,
      spaceBetween: 30
    }
  },
  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next--associations',
    prevEl: '.swiper-button-prev--associations',
  },
});

/**
 * ================================
 * Inline List to Grid Layout
 * ================================
 */
function gridHandler1Custom() {
  // console.log("off");
  swiperLogoCarousel.destroy();
  var container = document.querySelector('.logo-list__wrapper--custom');
  container.classList.add('logo-list__grid');
  // swiperLogoCarousel = undefined;
  $(this).one('click', gridHandler2Custom);
}

function gridHandler2Custom() {
  // console.log("on");
  var container = document.querySelector('.logo-list__wrapper--custom');
  container.classList.remove('logo-list__grid');
  swiperLogoCarousel = new Swiper('.logo-list__carousel--custom', {
    // If we need pagination
    pagination: {
      el: '.swiper-pagination--custom',
    },
  
    breakpoints: {
      425: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      640: {
        slidesPerView: 5,
        spaceBetween: 30
      }
    },
    loop: true,
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next--custom',
      prevEl: '.swiper-button-prev--custom',
    },
  });
  $(this).one('click', gridHandler1Custom);
}

$('#view-all--custom').one('click', gridHandler1Custom);

function gridHandler1Associations() {
  // console.log("off");
  swiperLogoCarousel.destroy();
  var container = document.querySelector('.logo-list__wrapper--associations');
  container.classList.add('logo-list__grid');
  // swiperLogoCarousel = undefined;
  $(this).one('click', gridHandler2Associations);
}

function gridHandler2Associations() {
  // console.log("on");
  var container = document.querySelector('.logo-list__wrapper--associations');
  container.classList.remove('logo-list__grid');
  swiperLogoCarousel = new Swiper('.logo-list__carousel--associations', {
    // If we need pagination
    pagination: {
      el: '.swiper-pagination--associations',
    },
  
    breakpoints: {
      425: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      640: {
        slidesPerView: 5,
        spaceBetween: 30
      }
    },
    loop: true,
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next--associations',
      prevEl: '.swiper-button-prev--associations',
    },
  });
  $(this).one('click', gridHandler1Associations);
}

$('#view-all--associations').one('click', gridHandler1Associations);

/**
 * ================================
 * TESTIMONIAL CAROUSELS
 * ================================
 */

var swiperCarouselTestimonialBasic = new Swiper('.carousel--testimonial', {
  slidesPerView: "auto",
  loop: true,
  centeredSlides: true,
  
  spaceBetween: 60,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination--testimonials',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});

var swiperCourselTestimonialHighlight = new Swiper('.carousel--highlight', {
  direction: 'vertical',
  freeMode: true,
  grabCursor: true,
  slidesPerView: 3,
  autoHeight: true,
  // loop: true,
  // autoplay: {
  //   delay: 15000,
  // },
  pagination: {
    el: '.swiper-pagination--highlight',
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  
});