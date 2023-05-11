$(document).ready(function () {

  // var swiper = new Swiper('.MainSlider-container', {
  //   // spaceBetween: 0,
  //   // loop: true,
  //   pagination: {
  //     el: '.swiper-pagination',
  //     clickable: true,
  //   },
  //   effect: 'fade',
  //   speed: 500,
  //   autoplay: {
  //     delay: 5000,
  //     disableOnInteraction: false,
  //   },
  //   navigation: {
  //     nextEl: '.main-slider-next',
  //     prevEl: '.main-slider-prev',
  //   },
  //   slidesPerView: 1,
  // });

  var swiper = new Swiper('.garminProducts', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    speed: 1000,
    autoplay: {
      delay: 3900,
      disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      600: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 3,
      },
    }
  });
  var swiper = new Swiper('.tacxProducts', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    speed: 1000,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      600: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 3,
      },
    }
  });

});





////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////
//////////////////  main  //////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////
  
$(document).ready(function () {

  new WOW().init();
  // dropify

  $('.dropify').dropify();


  // select2

  $('.select2').select2();

  //spinner
  // $(".spinner ").fadeOut("slow");

  $(window).on('load', function() {
	
		"use strict";
						
		/*----------------------------------------------------*/
		/*	Preloader
		/*----------------------------------------------------*/
		
		var preloader = $('#loader-wrapper'),
			loader = preloader.find('.loade r-inner');
			loader.fadeOut();
			preloader.delay(400).fadeOut('slow');
				
		// $(window).stellar({});
		
	});

    /* 24. Star Rating Js
/*----------------------------------------*/
$(function () {
  $('.star-rating').barrating({
    theme: 'fontawesome-stars'
  });
});
/*----------------------------------------*/

  //SmoothScroll js
  var scroll = new SmoothScroll('a[href*="#"]');

  //AOS js
  AOS.init({
    offset: 30,
    duration: 500,
  });

  // SideNav Default Options
  $('.button-collapse').sideNav({
    edge: 'right',
    breakpoint: 992,
    menuWidth: 240,
  });

  // img gallery
  $('[data-fancybox]').fancybox({

    buttons: [
      "zoom",
      // "share",
      "slideShow",
      "fullScreen",
      "download",
      "thumbs",
      "close"
    ],
    transitionEffect: "slide",
  });


  //navbar ainmation
  $(window).scroll(function () {
    var appScroll = $(document).scrollTop();

    if ((appScroll > 60) && (appScroll < 99999999999)) {
      $(".navbar").addClass("navAnimate");

    };
    if ((appScroll > 0) && (appScroll < 60)) {
      $(".navbar").removeClass("navAnimate");
    };
  });

  ;
  $('.odometer').appear(function (e) {
    var odo = $(".odometer");
    odo.each(function () {
      var countNumber = $(this).attr("data-count");
      $(this).html(countNumber);
    });
  });
  $('.home-slides')



  

});