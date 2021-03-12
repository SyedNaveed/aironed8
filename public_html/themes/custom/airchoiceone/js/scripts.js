(function($, Drupal, undefined) {
  $(document).ready(function(){
    if (!!window.sessionStorage && typeof sessionStorage.getItem === 'function' && typeof sessionStorage.setItem === 'function' && typeof sessionStorage.removeItem === 'function') {
      var clicked = sessionStorage.getItem('is_news_icon_clicked');
      if (clicked === null) {
        $('.news_icon').addClass('flashing').click(function() {
          sessionStorage.setItem('is_news_icon_clicked', 'clicked');
          $(this).removeClass('flashing');
        });
      }
    }
    $(".hamburger").click(function(){
      $(this).toggleClass("is-active");
      $(".mobile_menu").toggleClass("is-active");
    });
    $(".shadow_bar_child_menu").click(function(){
      $(this).toggleClass("active");
    });
    $(".side_nav").click(function(){
      $(this).toggleClass("active");
    });
    $('.mm_dd').click(function(e){
      var $this = $(e.currentTarget);
      $('.mm_dd').not($this).filter('.is-active').removeClass('is-active');
      $this.toggleClass("is-active");
    });
    $('.mm_dd > a').click(function(e){
      var $parent = $(e.currentTarget).parent();
      $('.mm_dd').not($parent).filter('.is-active').removeClass('is-active');
      if (!$parent.hasClass('is-active')) {
        $parent.toggleClass('is-active');
        e.preventDefault();
      }
      e.stopPropagation();
    });
    $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
        $(".floating_icons").addClass("active");
    } else {
        $(".floating_icons").removeClass("active");
    }
    });
    $('.accordion .accordion_down').click(function(j) {
      var dropDown = $(this).closest('li').find('p');
      $(this).closest('.accordion').find('p').not(dropDown).slideUp();
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
      } else {
        $(this).closest('.accordion').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
      dropDown.stop(false, true).slideToggle();
      e.preventDefault();
    });

    // Destination single.
    if ($('body').hasClass('node-flight-destination-page')) {
      var socialFloat = document.querySelector('#myHeader');
      var footer = document.querySelector('#moredestinations');

      function checkOffset() {
        function getRectTop(el) {
          var rect = el.getBoundingClientRect();
          return rect.top;
        }

        if ((getRectTop(socialFloat) + document.body.scrollTop) + socialFloat.offsetHeight >= (getRectTop(footer) + document.body.scrollTop) - 0) {
          socialFloat.style.position = 'absolute';
          socialFloat.style.bottom = '90px';
          socialFloat.style.transition = '1s';
        }
        if (document.body.scrollTop + window.innerHeight < (getRectTop(footer) + document.body.scrollTop)) {
          socialFloat.style.position = 'fixed';
          socialFloat.style.bottom = '0vh';
        }
      }

      document.addEventListener("scroll", function() {
        checkOffset();
      });
    }
  });

  // Scroll to results.
  Drupal.behaviors.acoResults = {
    attach: function attach (context) {
      $flight_status = $('#block-airchoiceone-flight-statuses', context).once('acoResults');
      if ($flight_status.length && $flight_status.find('p, table').length) {
        $([document.documentElement, document.body]).animate({
          scrollTop: $flight_status.offset().top - 20
        }, 1500);
      }
    }
  };

  // Flight leg table.
  Drupal.behaviors.acoLegTableselect = {
    attach: function attach (context) {
      $radios = $('.leg-selection input[type="radio"]', context).once('acoLegTableselect');
      if ($radios.length) {
        $('.leg-selection tr').not($radios.filter(':checked').parents('tr')).find('table').hide();
        $radios.change(function(e) {
          var $tr = $(this).parents('tr');
          $(this).parents('table').find('tr').not($tr).find('table').hide();
          $tr.find('table').show();
        });
      }
    }
  };

  // Flight selection.
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

  // Additional services and items selection.
  Drupal.behaviors.acoAncillaryPurchasesSelection = {
    attach: function attach (context) {
      var form_selector = '[data-drupal-selector="aco-book-flight-additional-services-form"]';
      var $form = $(form_selector, context).once('acoAncillaryPurchasesSelection');
      if ($form.length) {
        var base_count = parseInt($form.data('count'), 10);
        var base_cost = parseInt($form.data('cost'), 10);
        var base_total = parseInt($form.data('total'), 10);
        $cost = $form.find('.book_ticket [data-cost]');
        $total = $form.find('.book_ticket [data-total-price]');
        var options = {
          style: 'currency',
          currency: 'USD'
        };
        // Saved checkboxes do not add to the total cost.
        $(form_selector + ' td input[type="checkbox"]:checked').addClass('js-checked');
        var updateTicket = function() {
          var cost = 0;
          var total = 0;
          $(form_selector + ' td input[type="checkbox"]:not(.js-checked):checked').each(function(i, val) {
            cost += parseInt($(this).parents('tr').get(0).dataset.price, 10);
          });
          $(form_selector + ' td input[type="checkbox"].js-checked:not(:checked').each(function(i, val) {
            cost -= parseInt($(this).parents('tr').get(0).dataset.price, 10);
          });
          total = base_total + cost;
          cost = base_cost + (cost / base_count);
          $cost.text((cost / 100).toLocaleString('en-US', options));
          $total.text((total / 100).toLocaleString('en-US', options));
        };
        updateTicket();
        $form.find('td input[type="checkbox"]').change(updateTicket);
      }
    }
  };

  // Copy values.
  Drupal.behaviors.acoDataCopy = {
    attach: function attach (context) {
      var $checkboxes = $('[data-copy-group]', context).once('acoDataCopy');

      if ($checkboxes.length) {
        $checkboxes.change(function(e) {
          var $this = $(this);
          var group = $this.data('copyGroup');
          var copy = $this.is(':checked');
          $('[data-' + group + ']').each(function(i, val) {
            var $el = $(this);
            $el.val(copy ? $el.data(group) : '');
          });
        });
      }
    }
  };

  // Setup Flickity.
  Drupal.behaviors.acoCarouselFlickitySetup = {
    attach: function attach (context) {
      var $carousel = $('.carousel', context).once('acoCarouselFlickitySetup');

      if ($carousel.length) {
        $carousel.flickity({
          "contain": true,
          "cellAlign": "left",
          "wrapAround": true,
          "pageDots": false
        });
      }
    }
  };

  // Flight selection: Purchasing and Refunds.
  Drupal.behaviors.acoFlightSelectionPopup = {
    opened: false,
    attach: function attach (context) {
      var selector = 'input[type="radio"][name="departure_flight"], input[type="radio"][name="arrival_flight"]';
      var $inputs = $(selector, context).once('acoFlightSelectionPopup');
      if ($inputs.length) {
        $inputs.click(function(event) {
          if (!Drupal.behaviors.acoFlightSelectionPopup.opened) {
            Drupal.behaviors.acoFlightSelectionPopup.opened = true;
            var $dialog = $('#dialog-purchasing-and-refunds');
            if ($dialog.length) {
              Drupal.dialog($dialog, {
                title: Drupal.t('Purchasing and Refunds'),
                width: '700',
              }).showModal();
            }
          }
        });
      }
    }
  };

}(jQuery, Drupal));
