(function ($, Drupal) {



  $(window).scroll(function () {
 
      if ($(window).scrollTop() >= 100) {
        $('header#header-menu').addClass('menuscroll');
      }
      else {
        $('header#header-menu').removeClass('menuscroll');
      }
  });
  $('.sign_in_page .sign_in_left').scroll(function () {
 
    if ($('.sign_in_page .sign_in_left').scrollTop() >= 100) {
      // $('header#header-menu').addClass('menuhide');
    }
    else {
      // $('header#header-menu').removeClass('menuhide');
    }
    });

  

  // for place holder 
  $("#edit-pass").attr("placeholder", "Password");

  $("#edit-name").attr("placeholder", "User Name");

  $('.dash_side .openclose').click(function() {
    console.log('ff');
    //  $('.dash_side').toggleClass('dlclose'); 
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
          console.log(this);
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


  // Seat selection.
  Drupal.behaviors.acoSeatSelection = {
    attach: function attach (context) {
      // Tabs.
      var $buttons = $('[data-tab-controller]', context).once('acoSeatSelection');
      if ($buttons.length) {
        $('[data-tab]', context).hide();
        $buttons.first().addClass('red_btn');
        $('[data-tab="0"]', context).show();
        $buttons.click(function(e) {
          $buttons.removeClass('red_btn');
          var $this = $(e.currentTarget).addClass('red_btn');
          var tab = parseInt($this.data('tabController'), 10);
          $('[data-tab]').hide();
          $('[data-tab="' + tab + '"]').show();
        });
      }

      // Seats.
      var $seats = $('.is-standard', context).once('acoSeatSelection');
      if ($seats.length) {
        $seats.click(function(e) {
          var $this = $(e.currentTarget);
          var row = $this.data('row');
          var seat = $this.data('seat');
          var price = $this.data('price');
          var journey = parseInt($this.data('journey'), 10);
          var segment = parseInt($this.data('segment'), 10);
          var segment_selector = '[data-journey="' + journey + '"][data-segment="' + segment + '"]';
          var $radio = $(':input' + segment_selector + ':checked');
          if ($radio.length) {
            var passenger = parseInt($radio.data('passenger'), 10);
            var passenger_selector = segment_selector + '[data-passenger="' + passenger + '"]';
            if (!$this.hasClass('is-selected')) {
              // Clear previous selection.
              $('.is-selected' + passenger_selector).removeClass('is-selected');
              $this.addClass('is-selected').attr('data-passenger', passenger);
              $('.upgrade-price' + passenger_selector).html(price);
              $('.selected_seat' + passenger_selector).html(row + seat);
              $('input.row' + passenger_selector).val(row);
              $('input.seat' + passenger_selector).val(seat);
              // Auto-select next passenger.
              var $next_radio = $(':input' + segment_selector + '[data-passenger="' + (passenger + 1) + '"]');
              if ($next_radio.length <= 0) {
                $next_radio = $(':input' + segment_selector + '[data-passenger="1"]');
              }
              $next_radio.prop('checked', true);
            // Only clear the selection if the selected passenger matches this
            // seat selection.
            } else if (passenger === parseInt($this.attr('data-passenger'), 10)) {
              $this.removeClass('is-selected').removeAttr('data-passenger');
              $('.upgrade-price' + passenger_selector).html('0');
              $('.selected_seat' + passenger_selector).html('&nbsp;');
            }
          }
        });
      }
    }
  };





})(jQuery, Drupal);