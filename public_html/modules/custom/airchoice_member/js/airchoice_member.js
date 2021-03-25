(function($) {
    // Argument passed from InvokeCommand.
    $.fn.reloadPage = function(url, external) {
      if(url)
      {
        window.location.href = external?url : drupalSettings.path.baseUrl+url;
      }else{
        window.location.href = window.location.href;
      }
    };
    // show filghts detail and logs 
    $('.useradded-mem .members_bar .user-options .member_view').click(function( event ) {
      event.preventDefault();
      $(this).parents('.members_bar').find('.activity').removeClass("active");
       $(this).parents('.members_bar').find('.members_flights_list').toggleClass("active");
       
    });
    $('.useradded-mem .members_bar .user-options .member_activity').click(function( event ) {
      event.preventDefault();
      $(this).parents('.members_bar').find('.members_flights_list').removeClass("active");
       $(this).parents('.members_bar').find('.activity').toggleClass("active");
       
    });

   


})(jQuery);