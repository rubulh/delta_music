//Site Switcher
$(document).ready(function() {
  $(".swither_header").hover(function () {
    if ($("#links").is(":hidden")) {
      $("#links").show();
      $('.swither_header').css({'background-position' : '0 -25px'});
    }
  });	
	$(".switcher_wrap").hover(function () {},
    function () {
      $("#links").hide();
      $('.swither_header').css({'background-position' : '0 0'});
    }
  ); 
});