(function ($, Drupal) {



  $(window).scroll(function () {
    if ($(window).scrollTop() >= 100) {
      $('header#header-menu').addClass('menuscroll');
    }
    else {
      $('header#header-menu').removeClass('menuscroll');
    }
  });
  // for place holder 
  $("#edit-pass").attr("placeholder", "Password");

  $("#edit-name").attr("placeholder", "User Name");

  $('.dash_side .openclose').click(function() {
    console.log('ff');
     $('.dash_side').toggleClass('dlclose'); 
  }) 
  

})(jQuery, Drupal);