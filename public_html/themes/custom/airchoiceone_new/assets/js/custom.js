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
  
// Flight selection start
Drupal.behaviors.acoFlightSelection = {
  attach: function attach (context) {
    var form_selector = '[data-drupal-selector="aco-book-flight-flight-selection-form"]';
    var selector = 'input[type="radio"][name="departure_flight"], input[type="radio"][name="arrival_flight"]';
    var $form = $(form_selector);
    var $inputs = $(selector, context).once('acoFlightSelection');
    if ($form.length && $inputs.length) {
      var options = {
        style: 'currency',
        currency: 'USD'
      };
      var updateTicket = function() {
        var cost = 0;
        var fees = 0;
        var taxes = 0;
        var total = 0;
        $('input[type="radio"][name="departure_flight"]:checked, input[type="radio"][name="arrival_flight"]:checked').each(function(i, val) {
          cost += parseInt(this.dataset.cost, 10);
          fees += parseInt(this.dataset.fees, 10);
          taxes += parseInt(this.dataset.taxes, 10);
          total += parseInt(this.dataset.totalPrice, 10);
        });
        $('.book_ticket [data-cost]').text((cost / 100).toLocaleString('en-US', options));
        $('.book_ticket [data-fees]').text((fees / 100).toLocaleString('en-US', options));
        $('.book_ticket [data-taxes]').text((taxes / 100).toLocaleString('en-US', options));
        $('.book_ticket [data-total-price]').text((total / 100).toLocaleString('en-US', options));
      };
      updateTicket();
      $inputs.change(updateTicket);
    }
  }
};

// Flight selection end 





})(jQuery, Drupal);