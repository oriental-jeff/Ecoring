$(document).ready(function() {  
  // Begin Slick 
  $('.item-slick').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: false,
    infinite: true,
    speed: 2000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          // centerPadding: '40px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          // centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });

  $(document).on('click', '.item-slick-new-prev', function() {
    $('.item-slick-new').slick('slickPrev');
  });

  $(document).on('click', '.item-slick-new-next', function() {
    $('.item-slick-new').slick('slickNext');
  });

  $(document).on('click', '.item-slick-bestsale-prev', function() {
    $('.item-slick-bestsale').slick('slickPrev');
  });

  $(document).on('click', '.item-slick-bestsale-next', function() {
    $('.item-slick-bestsale').slick('slickNext');
  });

  $('.brand-slick').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: false,
    infinite: true,
    speed: 2000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          // centerPadding: '40px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          // centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });

  $(document).on('click', '.brand-slick-prev', function() {
    $('.brand-slick').slick('slickPrev');
  });

  $(document).on('click', '.brand-slick-next', function() {
    $('.brand-slick').slick('slickNext');
  });

  if (is_mobile == 1) {
    $('.item-computer-slick,.item-mobile-slick').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      infinite: true,
      speed: 2000,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            // centerPadding: '40px',
            slidesToShow: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            // centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });
  }
});