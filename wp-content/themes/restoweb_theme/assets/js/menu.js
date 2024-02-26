$ = jQuery;
/**
 * Get Product by Category
 */
function getProducts(categ) {

  $('.item-categ').removeClass('active');
  $('#'+categ).addClass('active');

    var formData = new FormData();
        formData.append('action',ajax_var.action)
        formData.append('nonce', ajax_var.nonce)
        formData.append('categ',  categ );
        
    jQuery.ajax({
      cache: false,
      url: ajax_var.url,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function () {
        jQuery('#js-restoweb-products').html('<img src="/wp-content/themes/restoweb_theme/assets/images/loading.gif" width="15px">');
      },
      success: function ( response ) {
        jQuery( '#js-restoweb-products' ).html(response);
      }
    });
}

$(document).ready(function() {
  setTimeout(function() {
      $('#navbar ul li').removeClass('active');
    }, 1000);
});