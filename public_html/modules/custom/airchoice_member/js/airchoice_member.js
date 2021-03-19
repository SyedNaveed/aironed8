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
})(jQuery);