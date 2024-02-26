/**
 * Verify email
 */
 function doctorsVerifyEmail() {

    let email = $('#user_email').val();

    const emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    
    if (emailRegex.test(email)) {
        $("#js-register-messageForm").html('');
        $('#user_email').removeClass('styles-danger').addClass('styles-success');
    } else {
        $("#js-register-messageForm").html('<p class="text-danger">El email no es correcto</p>');
        $('#user_email').removeClass('styles-success').addClass('styles-danger');
        return;
    }
  
    var formData = new FormData();

        formData.append('action', 'verify_email_address' );
        formData.append('user_email',  email );

        jQuery.ajax({
            cache: false,
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData,
            contentType: false,
            processData: false,
  
        beforeSend: function () {
            $("#js-register-messageForm").fadeIn('fast');
            $("#js-register-messageForm").html('<p class="text-info">Validando....</p>');
        },
  
        success:  function (response) {
  
          if(response.data == 'error'){
              $('#user_email').removeClass('styles-success').addClass('styles-danger');
          }else{
              $('#user_email').removeClass('styles-danger').addClass('styles-success');
          }
          
          $("#js-register-messageForm").html(response.message);
        }
    });
}

/**
 * @param String name
 * @return String
 */
 function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
  
/**
 * Ajax
 */
jQuery( document ).ready( function() {

    var userEmail;

    if ( userEmail = getParameterByName('user_email') ) {
        $('#user_email').val(userEmail);
    }

    jQuery( '#js-register' ).submit( function ( event ) {

        event.preventDefault();

        if ( $('#user_name').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese nombre completo</p>');
            return;
        }
        if ( $('#user_phone').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese Telefono</p>');
            return;
        }
        if ( $('#user_country').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese Pais</p>');
            return;
        }
        if ( $('#user_state').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese Provincia/Estado</p>');
            return;
        }
        if ( $('#user_company').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese Nombre de la empresa</p>');
            return;
        }
        if ( $('#user_address').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese Direccion</p>');
            return;
        }
        if ( $('#user_email').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese Email</p>');
            return;
        }
        if ( $('#user_password').val() == '' ) {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor ingrese Contaseña</p>');
            return;
        }
        /* if ( $('#terms').is(':checked') ) {
            // Do something
        } else {
            $("#js-register-messageForm").html('<p class="text-danger">Por favor Accept Terms & Conditions</p>');
            return;
        } */
                
        var formData = new FormData();

        formData.append('action', 'account_register' );
        formData.append('user_name', $('#user_name').val() );
        formData.append('user_phone', $('#user_phone').val() );
        formData.append('user_country', $('#user_country').val() );
        formData.append('user_state', $('#user_state').val() );
        formData.append('user_company', $('#user_company').val() );
        formData.append('user_address', $('#user_address').val() );
        formData.append('user_email', $('#user_email').val() );
        formData.append('user_password', $('#user_password').val() );

        jQuery.ajax({
            cache: false,
            url: ajax_object.ajax_url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#js-register-messageForm").fadeIn('fast');
                $("#js-register-messageForm").html('<p class="text-info">Enviando....</p>');
            },
            success: function ( response ) {
                if ( response.success == true ) {
                    $("#js-register-messageForm").html('<p class="text-success">' + response.data + '</p>');
                    $(location).attr('href', 'wp-admin/');
                } else {
                    $("#js-register-messageForm").html('<p class="text-danger">' + response.data + '</p>');
                }
            }
        });
        return false;
    });

});