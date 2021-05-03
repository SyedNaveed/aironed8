(function ($, Drupal) {
  
  jQuery(function(){
    jQuery("#edit-submit.changemembership").prop("disabled", 1);
    jQuery("input.members-to-remove-checkbox").on('change', function(){

      let requiredCheckboxes = jQuery("#members-to-remove").attr("data-required-checkboxes");
      if(requiredCheckboxes)
      {
        
      let checked = jQuery("input.members-to-remove-checkbox:checked").length;
      
      if(checked == requiredCheckboxes)
      {
      let checked = jQuery("input.members-to-remove-checkbox:checked").length;
      jQuery("input.members-to-remove-checkbox:not(:checked)").prop("disabled", true);
      jQuery("#edit-submit").prop("disabled", 0);
    }else{
      jQuery("input.members-to-remove-checkbox").prop("disabled", false);
      jQuery("#edit-submit").prop("disabled", 0);
      }
    }

    });
  })
  // for color box 
  
  jQuery(".views-field-field-media img").each((i, e)=>{
    $e = jQuery(e);
    $e.wrap("<a class='gallery-link' href='"+e.src+"' />")
  });
  
  jQuery('a.gallery-link').colorbox({rel:'group1'});
  
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
  
  jQuery(".plan-links a.package-select-button").on("click", function(){
    
    //members in current package
    let currentMembersCount = +jQuery("#edit-members-added").val();
    
    //max members allowed in current package
    let currentPackageMax = +jQuery("#edit-members-added").val();


    
    
    
    let id = jQuery(this).attr("data-id");
   



    let $input = $( "#edit-package-"+id);
    $input[0].click();
    $(".form-item-package").css('display', 'none');

    //get new package max members
    let newPackageMax = +$input.parent().find(".confirm-membership-h2").attr("data-max-members")
    
    $input.parent().css('display', 'block');

    // currentMembersCount -= 1;

    console.log(newPackageMax, currentMembersCount, currentPackageMax);


    //logic to show checkboxes
    //hide checkboxes and no validation for remove users
    //all users will be removed from backend.
    if(newPackageMax == 0)
    {
      
      jQuery("#members-to-remove").addClass('hidden');

      jQuery("#edit-submit").prop("disabled", 0);
      jQuery("#members-to-remove").removeAttr("data-required-checkboxes");

    }//if newPackage allowed members are less greater or equal to currentPackageMax hide checkboxes and validation no need to remove users.
    else if(newPackageMax >= currentPackageMax)
    {
      
      jQuery("#members-to-remove").addClass('hidden');
      jQuery("#edit-submit").prop("disabled", 0);
      jQuery("#members-to-remove").removeAttr("data-required-checkboxes");
    }//show checkboxes and prevent form submit until required number of checkboxes are selected
    else{
      jQuery("#members-to-remove").removeClass('hidden');
      
      //number of checkboxes required to select
      let requiredCheckboxes = currentMembersCount - newPackageMax;
      jQuery("#members-to-remove").attr("data-required-checkboxes", requiredCheckboxes);
      jQuery("#members_to_remove_desc").text("Select "+requiredCheckboxes+" Users.");
      //disable the submit until required number of checbkoxes are selected 
      jQuery("#edit-submit").prop("disabled", 1);
    }

    
    
  });
  
  
  
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
          $('input[type="radio"][name="departure_flight"]:checked ').each(function(i, val) {
            console.log(this);
            cost += parseInt(this.dataset.cost, 10);
            fees += parseInt(this.dataset.fees, 10);
            taxes += parseInt(this.dataset.taxes, 10);
            total += parseInt(this.dataset.totalPrice, 10);
            
          });
          $('input[type="radio"][name="arrival_flight"]:checked').each(function(i, val) {
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