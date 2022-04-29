/**
 * jquery function to serviceworker
 * for PWA
*/
window.onload = () => {
  'use strict';

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('/sw.js');
  }
};
/**
 * jquery function for admin serviceworker
 * for PWA
*/
window.onload = () => {
  'use strict';

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('/admin_sw.js');
  }
};
/**
 * jquery function for seller serviceworker
 * for PWA
*/
window.onload = () => {
  'use strict';

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('/seller_sw.js');
  }
};
/*
    ===========================================================*/
/**
 * jquery function to strick at top
 */
$(window).scroll(function () {
  if ($(this).scrollTop() > 1) {
    $("#myHeader").addClass("sticky");
  } else {
    $("#myHeader").removeClass("sticky");
  }
});

/*[ Show header dropdown ]
    ===========================================================*/
$(".js-show-header-dropdown").on("click", function () {
  $(this)
    .parent()
    .find(".header-dropdown");
});

var menu = $(".js-show-header-dropdown");
var sub_menu_is_showed = -1;

for (var i = 0; i < menu.length; i++) {
  $(menu[i]).on("click", function () {
    if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
      $(this)
        .parent()
        .find(".header-dropdown")
        .toggleClass("show-header-dropdown");
      sub_menu_is_showed = -1;
    } else {
      for (var i = 0; i < menu.length; i++) {
        $(menu[i])
          .parent()
          .find(".header-dropdown")
          .removeClass("show-header-dropdown");
      }

      $(this)
        .parent()
        .find(".header-dropdown")
        .toggleClass("show-header-dropdown");
      sub_menu_is_showed = jQuery.inArray(this, menu);
    }
  });
}

$(".js-show-header-dropdown, .header-dropdown").click(function (event) {
  event.stopPropagation();
});

$(window).on("click", function () {
  for (var i = 0; i < menu.length; i++) {
    $(menu[i])
      .parent()
      .find(".header-dropdown")
      .removeClass("show-header-dropdown");
  }
  sub_menu_is_showed = -1;
});

/*[ End of Show header dropdown ]
===========================================================*/

/*price range*/

// $('#sl2').slider();

var RGBChange = function () {
  $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
  $(function () {
    $.scrollUp({
      scrollName: 'scrollUp', // Element ID
      scrollDistance: 300, // Distance from top/bottom before showing element (px)
      scrollFrom: 'top', // 'top' or 'bottom'
      scrollSpeed: 300, // Speed back to top (ms)
      easingType: 'linear', // Scroll to top easing (see http://easings.net/)
      animation: 'fade', // Fade, slide, none
      animationSpeed: 200, // Animation in speed (ms)
      scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
      //scrollTarget: false, // Set a custom target element for scrolling to the top
      scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
      scrollTitle: false, // Set a custom <a> title if required.
      scrollImg: false, // Set true to use image
      activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
      zIndex: 2147483647 // Z-Index for the overlay
    });
  });
  /*[ End of scrollUP function ]
     ===========================================================*/
  //Password Strength  Script
  $('#password').passtrength({
    minChars: 8,
    passwordToggle: true,
    tooltip: true,
    //        eyeImg :"assets/public/images/eye.svg" // toggle icon
  });
  /*[ End of Password Strength  Script ]
  ===========================================================*/
});





