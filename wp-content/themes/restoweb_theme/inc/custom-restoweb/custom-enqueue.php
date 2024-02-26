<?php

/*------------------------------------*\
             Custom Scripts
\*------------------------------------*/
function restoweb_enqueue_scripts() {
	
	wp_deregister_script('Scripts');
	wp_enqueue_script('Scripts', get_template_directory_uri().'/assets/js/scripts.js' );

	/* wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'); */
	wp_enqueue_style('custom', get_template_directory_uri().'/custom.css');
    
    wp_deregister_script('QRcode-min');
	wp_enqueue_script('QRcode-min', get_template_directory_uri().'/resources/third_party/qrcode.min.js' );

	wp_deregister_script('QRcode');
	wp_enqueue_script('QRcode', get_template_directory_uri().'/resources/transpiled/html5-qrcode.js' );

	wp_deregister_script('simple-slider');
	wp_enqueue_script('simple-slider', get_template_directory_uri().'/assets/js/simple-slider.js' );

	wp_deregister_script('ajax-add-to-cart');
	wp_enqueue_script('ajax-add-to-cart', get_template_directory_uri().'/assets/js/ajax-add-to-cart.js' );

	wp_enqueue_script( 'menu-js', get_template_directory_uri().'/assets/js/menu.js', array('jquery') );
	wp_localize_script('menu-js', 'ajax_var', array(
        'url'    => admin_url( 'admin-ajax.php' ),
        'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
        'action' => 'get_products_menu'
    ));

}

add_filter( 'wp_enqueue_scripts', 'restoweb_enqueue_scripts', 100 );


/**
* Footer Scripts
*/
function my_footer_scripts() { ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="<?php echo get_template_directory_uri().'/assets/js/register.js'; ?>"></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		var ajax_object = {"ajax_url":"<?php echo bloginfo('url');?>\/wp-admin\/admin-ajax.php"};
		/* ]]> */
	</script>
<?php
}
add_action( 'wp_footer', 'my_footer_scripts' );