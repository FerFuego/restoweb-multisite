/**
 * Custom Menu stiky
 */
 (function ($) {
  $(document).ready(function() {    
    var altura = $('#navbar').offset().top;
    
    $(window).on('scroll', function(){
      if ( $(window).scrollTop() > altura + 50 ){
        $('#navbar').addClass('sticky');
        $('.float-logo').removeClass('d-none');
      } else {
        $('#navbar').removeClass('sticky');
        $('.float-logo').addClass('d-none');
      }
    });
  });
})(jQuery);

/**
 * Open image in modal
 */
function previewImage(obj) {
  $('#imagepreview').attr('src', $(obj).attr('src'));
}