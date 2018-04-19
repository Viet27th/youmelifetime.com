try {
    window.$ = window.jQuery = require('jquery');

    // require('bootstrap');
} catch (e) {}
"use strict";
let windowWidth = $(window).width();

if(windowWidth <= 767) {
  $('#btn-toggle-menu').on('click', function () {
    $('#header-menu').toggleClass('mobile-menu-toggle')
  })
  let i = 0
  $('.arrow').on('click', function (e) {
    e.preventDefault()
    let that = $(this).closest('.xd-menu-li').children('.xd-submenu')
    if (i % 2) {
      that.slideUp()
      i++
    }
    else {
      that.slideDown()
      i++
    }
  })
}











