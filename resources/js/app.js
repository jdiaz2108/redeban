/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import $ from 'jquery'
import slick from 'slick-carousel'

window.$ = window.jQuery = $;
require('./bootstrap');


//sidemenu
$("#btn-custom-sidemenu").click(function(){
  var val = $("#val_sidemenu").val();
  if(val == 0) {
    $("#custom-sidemenu").removeClass('d-none');
    $("#val_sidemenu").val(1);
} else {
    $("#custom-sidemenu").addClass('d-none');
    $("#val_sidemenu").val(0);
}
});

$("#btn-custom-sidemenu-close").click(function(){
  var val = $("#val_sidemenu").val();
  if(val == 0) {
    $("#custom-sidemenu").removeClass('d-none');
    $("#val_sidemenu").val(1);
} else {
    $("#custom-sidemenu").addClass('d-none');
    $("#val_sidemenu").val(0);
}
});

//slider catalog
$('#slider').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
