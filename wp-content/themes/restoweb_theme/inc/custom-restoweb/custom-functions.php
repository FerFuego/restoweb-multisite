<?php
/**
 * ELIMINACION DE CAMPOS DEL CHECKOUT WOOCOMMERCE
 */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_address_1']);
  unset($fields['billing']['billing_address_2']);
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_state']);
  /* unset($fields['order']['order_comments']); */
  return $fields;
}

/* 
* Add Comentario to items
*/
add_action( 'woocommerce_add_order_item_meta', function ( $itemId, $values, $key ) {
    if ( isset( $values['wpt_custom_message'] ) ) {
        wc_add_order_item_meta( $itemId, 'Comentario', $values['wpt_custom_message'] );
    }
}, 10, 3 );


/* 
* Register session
*/
add_action('init', 'register_my_session');
function register_my_session(){
  /* if( ! session_id() ) {
      session_start();
  } */
}

define('TEMPPATHC', get_bloginfo('stylesheet_directory'));
define( 'JSON', TEMPPATHC .'/assets/js' );
define( 'IMAGES', TEMPPATHC.'/assets/images' );

/**
 * Añade el campo Mesa a la página de checkout de WooCommerce
 */
add_action( 'woocommerce_after_order_notes', 'agrega_mi_campo_personalizado' );
function agrega_mi_campo_personalizado( $checkout ) {
 
    woocommerce_form_field( 'mesa', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('MESA'),
        'placeholder'   => __('Ej: 99999999D'),
    ), $_SESSION['mesa']['title']);
}

/**
 * Actualiza la información del pedido con el nuevo campo
 */
add_action( 'woocommerce_checkout_update_order_meta', 'actualizar_info_pedido_con_nuevo_campo' );
function actualizar_info_pedido_con_nuevo_campo( $order_id ) {
    if ( ! empty( $_SESSION['mesa'] ) ) {
		update_post_meta( $order_id, 'mesa', $_SESSION['mesa']['title'] );
    }
}

/**
 * Muestra el valor del nuevo campo mesa en la página de edición del pedido
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'mostrar_campo_personalizado_en_admin_pedido', 10, 1 );
function mostrar_campo_personalizado_en_admin_pedido($order){
    echo '<p><strong>'.__('MESA').':</strong> ' . get_post_meta( $order->id, 'mesa', true ) . '</p>';
}

/**
 * Incluye el campo mesa en el email de notificación del cliente
 */
add_filter('woocommerce_email_order_meta_keys', 'muestra_campo_personalizado_email');
function muestra_campo_personalizado_email( $keys ) {
    $keys[] = 'mesa';
    return $keys;
}


/**
 * Esconder el Short By de la tienda
 */
add_action( 'init', 'bbloomer_remove_default_sorting_storefront' );
function bbloomer_remove_default_sorting_storefront() {
   remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
}

/**
 * Ocultar admin bar a todos
 */
add_action('after_setup_theme', 'bld_ocultar_admin_bar');
function bld_ocultar_admin_bar() {
    add_filter( 'show_admin_bar', '__return_false' );
}

/**
 * Remove Editor Clasico de WP
 */
add_action('admin_init', 'remove_textarea');
function remove_textarea() {
    remove_post_type_support( 'page', 'editor' );
}

/**
 * Hide Wordpress Logo
 */
function eliminar_logo_wp() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'eliminar_logo_wp');

/**
 * Add Custom Logo
 */
/* Cambiar logo barra admin */
/* function ayudawp_cambiar_logo_admin() {
    echo '<style type="text/css">
        #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
            background-image: url('.IMAGES.'/logo.png) !important;
            background-position: 0 0;
            color:rgba(0, 0, 0, 0);
            background-size: 100%;
        }
        #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
            background-position: 0 0;
        }
    </style>';
}
add_action('wp_before_admin_bar_render', 'ayudawp_cambiar_logo_admin'); */

/**
 * Change Login Logo
 */
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            width: auto !important;
            background-image: url("<?php echo IMAGES .'/logo.png';?>") !important;
            background-size: 50% !important;
            height: 130px !important;
        }
        .wrap .nosubsub {
            margin-top: 80px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**
 * Remove Notifications
 */
function remove_core_updates(){
    global $wp_version;
    return (object) array('last_checked' => time(), 'version_checked' => $wp_version);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

function hide_notices_dashboard() {
    global $wp_filter;

    if ( is_network_admin() and isset($wp_filter['network_admin_notices']) ) {
        unset( $wp_filter['network_admin_notices'] );
    } elseif( is_user_admin() && isset($wp_filter['user_admin_notices']) ) {
        unset( $wp_filter['user_admin_notices'] );
    } else {
        if ( isset($wp_filter['admin_notices']) ) {
            unset( $wp_filter['admin_notices'] );
        }
    }

    if ( isset($wp_filter['all_admin_notices']) ) {
        unset( $wp_filter['all_admin_notices'] );
    }
}
add_action( 'admin_init', 'hide_notices_dashboard' );


/**
 * Register Custom Menu
 */
function wpb_custom_new_menu() {
    register_nav_menu('landing-custom-menu',__( 'Landing Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );


/**
 * Register Custom Styles Admin
 */
function adminStylesCss() {
    $url = get_option('siteurl');
    $url = $url . '/wp-content/themes/restoweb_theme/admin-style.css';
    echo '<!-- Admin CSS styles -->
          <link rel="stylesheet" type="text/css" href="' . $url . '" />
          <!-- /end Admin CSS styles -->';
}
add_action('admin_head', 'adminStylesCss');

/**
 * Custom Logo
 */
function custom_logo_url ( $html ) {
    
    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
        esc_url(home_url('/')),
        '<img src="'. ((get_field('logo', 'option')) ? get_field('logo', 'option')['url'] : IMAGES .'/logo-white.png').'" class="custom-logo" itemprop="logo">'
    );
    return $html;    
}
add_filter( 'get_custom_logo',  'custom_logo_url' );


/**
 * Trim text, strip shortcodes and excerpt return 
 * 
 * @param Int $post - Post ID (optional)
 * @param String $text - Text or get_the_conten() (optional)
 * @param Int $words - Number of words to return
 * 
 * @return string - "Ex: This is my text trim and..."
 */
function custom_trim_excerpt ( $post = null, $text = null, $words = null ) {

    if ( $post ) {
        $content = get_the_content('', false, $post);
    }

    if ( $text ) {
        $content = $text;
    }

    $content = excerpt_remove_blocks( $content );
    $content = apply_filters( 'the_content', $content);
    $content = strip_shortcodes( $content );
    $content = str_replace( ']]>',']]&gt;', $content);

    if ($words) {
        $content = wp_trim_words( $content, $words, '...' );
    }

    return $content;
}


/**
 * Custom Logo
 */
if ( ! function_exists( 'shopper_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @since 1.0.0
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function shopper_site_title_or_logo( $echo = true ) {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$logo = get_custom_logo();
			$html = is_home() ? '<h1 class="logo"><img src="' . get_field('logo', 'option')['url'] . '"></h1>' : $logo;
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			// Copied from jetpack_the_site_logo() function.
			$logo    = site_logo()->logo;
			$logo_id = get_theme_mod( 'custom_logo' ); // Check for WP 4.5 Site Logo
			$logo_id = $logo_id ? $logo_id : $logo['id']; // Use WP Core logo if present, otherwise use Jetpack's.
			$size    = site_logo()->theme_size();
			$html    = sprintf( '<a href="%1$s" class="site-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image(
					$logo_id,
					$size,
					false,
					array(
						'class'     => 'site-logo attachment-' . $size,
						'data-size' => $size,
						'itemprop'  => 'logo'
					)
				)
			);

			$html = apply_filters( 'jetpack_the_site_logo', $html, $logo, $size );
		} else {
			$tag = is_home() ? 'h1' : 'div';

			$html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . '<img src="' . get_field('logo', 'option')['url'] . '">' . '</a></' . esc_attr( $tag ) .'>';

		}

		if ( ! $echo ) {
			return $html;
		}

		echo $html;
	}
}

//Modificar texto del botón Añadir al carrito
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text() {

    global $product;
    $product_type = $product->product_type;
    
    switch ( $product_type ) {
        case 'external':
        return __( 'Ir', 'woocommerce' );
        break;
        case 'grouped':
        return __( 'Ver detalles', 'woocommerce' );
        break;
        case 'simple':
        return __( 'Agregar al Pedido', 'woocommerce' );
        break;
        case 'variable':
        return __( 'Ver opciones', 'woocommerce' );
        break;
        default:
        return __( 'Ver detalles', 'woocommerce' );
    }
}

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
    return bloginfo('url');
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );


/**
 * Add function to write log event
 */
if ( ! function_exists('write_log')) {
    function write_log ( $log )  {
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( print_r( $log, true ) );
        } else {
            error_log( $log );
        }
    }
}

/**
 * Get My Location object
 * Request to API endpoint https://geolocation-db.com
 * @param REMOTE_ADDR
 */
function get_user_location_by_ip() {
    $response = file_get_contents('https://geolocation-db.com/json/'.$_SERVER['REMOTE_ADDR']);
    $location = json_decode($response, true);
    return $location;
}

/**
* Corregir en WooCommerce - Lo siento, este tipo de archivo no está permitido por motivos de seguridad.
*
* @since 1.0.0
*/
add_filter("mime_types", "add_csv_plain");
function add_csv_plain($mime_types)
{
    unset($mime_types['txt|asc|c|cc|h|srt']);
    $mime_types['txt|asc|c|cc|h|srt|csv'] = 'text/plain';
    return $mime_types;
}
add_filter("woocommerce_csv_product_import_valid_filetypes", "add_csv_plain_woocommerce");
function add_csv_plain_woocommerce()
{
    return [
        'txt|csv' => 'text/plain',
        'csv' => 'text/csv',
    ];
}