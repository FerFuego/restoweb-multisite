<?php
/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */


if ( ! defined( 'THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'THEME_VERSION', '1.2.31' );
}

require 'inc/sign-up-alert.php';

/*------------------------------------*\
        Custom Global Variables
\*------------------------------------*/

define('TEMPPATH', get_bloginfo('stylesheet_directory'));
define('IMAGES', TEMPPATH."/images");

//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
//** Case Study Title Block Shortcodes ***********
//********************************
// Register Custom Post Type

require 'inc/template_function.php';

add_filter( 'woocommerce_package_rates', 'backup_all_shipping', 1 );

function backup_all_shipping($rates){
    $GLOBALS['backup_all_shipping'] = $rates;
    return $rates;
}

function gutenberg_can_edit_post_type_83744857( $can_edit, $post_type ) {
  $gutenberg_supported_types = array( 'page' );
  if ( ! in_array( $post_type, $gutenberg_supported_types, true ) ) {
    $can_edit = false;
  }
  $can_edit = false;
  var_dump($can_edit);
  return $can_edit;
}
//add_filter( 'gutenberg_can_edit_post_type', 'gutenberg_can_edit_post_type_83744857', 10, 2 );

function can_use_SEO() {
  global $current_screen;
    if (is_admin()) {

      var_dump($current_screen);

        $role = get_role( 'marketing' );

        if ( is_object( $role ) ) $role->add_cap( 'install_plugins' );
         //var_dump($role);
    }
}
//add_action( 'admin_init', 'can_use_SEO', 1 );





function custom_post_type_camp() {

  $labels = array(
    'name'                  => _x( 'Camp videos', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Camp video', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Camp videos', 'text_domain' ),
    'name_admin_bar'        => __( 'Camp videos', 'text_domain' ),
    'archives'              => __( 'Item Archives', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Items', 'text_domain' ),
    'add_new_item'          => __( 'Add New Item', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Item', 'text_domain' ),
    'edit_item'             => __( 'Edit Item', 'text_domain' ),
    'update_item'           => __( 'Update Item', 'text_domain' ),
    'view_item'             => __( 'View Item', 'text_domain' ),
    'view_items'            => __( 'View Items', 'text_domain' ),
    'search_items'          => __( 'Search Item', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Camp video', 'text_domain' ),
    'description'           => __( 'Post Type Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'camp_video', $args );

}
add_action( 'init', 'custom_post_type_camp', 0 );


// Register Custom Taxonomy
function custom_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Camp Type', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Camp Type', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Camp Type', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Item Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Item', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'taxonomy_camp_type', array( 'camp_video' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );


add_filter('avf_file_upload_capability', 'avia_file_upload_capability', 10, 1);
function avia_file_upload_capability($cap)
{
  $cap = 'edit_posts';
  return $cap;
}



add_filter( 'comment_form_default_fields', 'tu_filter_comment_fields', 20 );
function tu_filter_comment_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

    $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">Save my name, email in this browser next time I Comment</label></p>';

    return $fields;
}




add_action( 'woocommerce_cart_calculate_fees', 'custom_fee_based_on_cart_total', 10, 1 );
function custom_fee_based_on_cart_total( $cart ) {

    //if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;


    $quantity = 0;
    $product_id = array();
    $d_type = array();

    foreach( WC()->cart->get_cart() as $cart_item  ) {

       $_product = $cart_item[ 'data' ];
       //var_dump($_product->get_id());
       $parent_id = $_product->get_id();
       if($_product->get_type() == 'variation'){
         $variation = wc_get_product($_product->get_id());
          $parent_id = $variation->get_parent_id();

       }


        array_push($d_type,$_product->get_type());
       if($parent_id == '17425'){
        $quantity = $quantity + $cart_item[ 'quantity' ];
       }
       $product_id[] = $parent_id;

    }
    $product_id =  array_unique($product_id);
   // var_dump(count($product_id));
   //if(empty( $cart->recurring_cart_key)){
       if((in_array("17425", $product_id) && count($product_id) == 2 && !in_array("subscription", $d_type)) || (in_array("17425", $product_id) && count($product_id) >= 2 )){
         $d_price = $quantity * 9.99;
         if ( empty( $cart->recurring_cart_key ) ) {
             $cart->add_fee( 'Bake-A-Camp Shipping<br><span>Shipped in 5-7 business days</span>', $d_price );
         }
      }



}
//add_filter( 'woocommerce_subscriptions_is_recurring_fee', 'remove_function' ,999);

// function remove_function($data){
//     $data = true;
//     var_dump($data);
//     return $data;

// }


function d_change_flat_rates_cost_camp_baking_kit( $rates ) {

   $product_id = array();
   $d_type = array();
    $quantity = 0;
   //  $ex_id = 0;
    foreach( WC()->cart->get_cart() as $cart_item  ) {

       $_product = $cart_item[ 'data' ];
        array_push($d_type,$_product->get_type());
         $parent_id = $_product->get_id();
       if($_product->get_type() == 'variation'){
         $variation = wc_get_product($_product->get_id());
          $parent_id = $variation->get_parent_id();

       }
       // if($_product->get_id() == 12326 && isset($cart_item['price'])){
       //    $ex_id  += $cart_item[ 'quantity' ];
       //  }
       //var_dump($_product->get_id());
        if($parent_id == '17425'){
        $quantity = $quantity + $cart_item[ 'quantity' ];
       }
       $product_id[] = $parent_id;

    }
    $product_id =  array_unique($product_id);
   //  $quantity  = $quantity  -  $ex_id;
    if (in_array("17425", $product_id) && count($product_id) == 1){
          if($rates['flat_rate:4']){
           unset( $rates['flat_rate:4']);
         }
          if($rates['flat_rate:2']){
           unset( $rates['flat_rate:2']);
         }

          if($rates['flat_rate:5']){
           unset( $rates['flat_rate:5']);
         }
          if($rates['flat_rate:3']){
            $rates['flat_rate:3']->cost = $quantity * 9.99;
         }



    }

    if (in_array("17425", $product_id) && count($product_id) == 2  && in_array("subscription", $d_type) ){
         //unset( $rates['flat_rate:3']);

          $recurring_carts = WC()->cart->recurring_carts ;
          if( !$recurring_carts) {
            if ( isset( $rates['flat_rate:4'] ) ) {
             unset( $rates['flat_rate:4']);
           }
             if ( isset( $rates['flat_rate:5'] ) ) {
              unset( $rates['flat_rate:5']);
            }
          }
         if($rates['flat_rate:2']){
           unset( $rates['flat_rate:2']);
         }

          // if ( isset( $rates['flat_rate:6'] ) ) {
          //   unset( $rates['flat_rate:6']);
          // }

         if($rates['flat_rate:3']){
            $rates['flat_rate:3']->cost = 9.99;
         }

        // $rates['flat_rate:3']->taxes = 0;
    }


  return $rates;
}
//add_filter( 'woocommerce_package_rates', 'd_change_flat_rates_cost_camp_baking_kit', 999, 1 );

add_filter('woocommerce_subscriptions_frontend_view_subscription_script_parameters','d_script_params', 10 ,1);

function d_script_params($script_params){
  global $wp;
  $subscription   = wcs_get_subscription( $wp->query_vars['view-subscription'] );
  //var_dump($subscription);
  $script_params['auto_renew_nonce'] =  check_renew_toggle( $subscription ) ? wp_create_nonce( "toggle-auto-renew-{$subscription->get_id()}" ) : false;
 // $script_params['has_payment_gateway'] = true;
 // var_dump($script_params);
   return $script_params;
}


add_filter('wcs_view_subscription_actions','d_remove_cancel_action', 10, 2);

function d_remove_cancel_action($actions, $subscription ){
  unset($actions['cancel']);
  //var_dump($actions);
  return $actions;
}


function send_ajax_response_cs( $subscription ) {
    wp_send_json( array(
      'payment_method' => esc_attr( $subscription->get_payment_method_to_display( 'customer' ) ),
      'is_manual'      => wc_bool_to_string( $subscription->is_manual()),
    ) );
  }




add_action( 'wp_ajax_wcs_enable_auto_renew','d_enable_renew_cs', 1);

function d_enable_renew_cs(){
 // print_r($_REQUEST);
  //       exit;
    $subscription_id = absint( $_POST['subscription_id'] );
    check_ajax_referer( "toggle-auto-renew-{$subscription_id}", 'security' );

    $subscription = wcs_get_subscription( $subscription_id );

    if ( wc_get_payment_gateway_by_order( $subscription )  ) {
      $subscription->set_requires_manual_renewal( false );

      // $order = $subscription->get_related_orders();
      // $available_gateways   = WC()->payment_gateways->get_available_payment_gateways();
      // $order_payment_method = wcs_get_objects_property( $order, 'payment_method' );
      // $payment_method       = '' != $order_payment_method && isset( $available_gateways[ $order_payment_method ] ) ? $available_gateways[ $order_payment_method ] : false;

      // $subscription->set_payment_method($payment_method);


      $subscription->add_order_note( 'Payment changed from manual renewal to auto renewal',false);
      $subscription->save();

      send_ajax_response_cs( $subscription );
    }
}

add_action( 'wp_ajax_wcs_disable_auto_renew','disable_auto_renew_cs' , 1);

function disable_auto_renew_cs(){
    $subscription_id = absint( $_POST['subscription_id'] );
    check_ajax_referer( "toggle-auto-renew-{$subscription_id}", 'security' );

    $subscription = wcs_get_subscription( $subscription_id );

    if ( wc_get_payment_gateway_by_order( $subscription )  ) {
      $subscription->set_requires_manual_renewal( true );
      $subscription->set_payment_method('');

      //add_filter('woocommerce_subscriptions_frontend_view_subscription_script_parameters', 'd_change_has_payment_gateway', 100 , 1);

      $subscription->add_order_note( 'Payment changed from auto renewal to manual renewal',false);
      $subscription->save();

      send_ajax_response_cs( $subscription );
    }
}

function d_change_has_payment_gateway($script_params){
  $script_params['has_payment_gateway'] = false;
  return $script_params;
}


add_action('storefront_before_site','d_bar_nf');
function d_bar_nf(){
	if(get_field('enable','option') && !is_page_template('home-page-redesign.php')): ?>
        <div class="d-bar" style="<?php echo (wp_is_mobile()) ? 'padding: 5px;':'padding: 10px;'; ?>">
            <div class="d-bar-message col-full" style="text-align: center;">
                <?php echo get_field('message', 'option');?>
            </div>
        </div>
 <?php endif;
}

/**
 * Add floating PromoBar - bottom page
 */
add_action('storefront_before_site','floating_footer');
function floating_footer(){
	if(get_field('floating_footer_enable','option') == true):

        $from = get_field('visible_from', 'option') . " EST";
        $until = get_field('visible_until', 'option') . " EST";
        $from_time = strtotime($from);
        $until_time =  strtotime($until);
        $date = new DateTime("now", new DateTimeZone('US/Eastern') );
        $now = strtotime($date->format('F j Y H:i:s') . " EST");

        $link = get_field('floating_footer_link', 'option');
        $classes = get_field('where_to_display', 'option');


        if($from_time < $now and $until_time > $now){
            echo "<div id='floating-footer' class='".$classes."'>";
            echo "<a class='desktop_message' href='" . $link ."' target='blank'>".get_field('message_desktop','option')."</a>";
            echo "<a class='mobile_message' href='" . $link ."' target='blank'>".get_field('message_mobile','option')."</a>";
            echo "<div class='close-floating-footer'>X</div>";
            echo "</div>";
        }

	endif;
}


add_action( 'wp_enqueue_scripts','disable_cart_fragments', 999 );
function disable_cart_fragments() {
      global $wp_scripts;

      $handle = 'wc-cart-fragments';

      $load_cart_fragments_path = $wp_scripts->registered[ $handle ]->src;
      $wp_scripts->registered[ $handle ]->src = null;
      wp_add_inline_script(
        'woocommerce',
        '
        function optimocha_getCookie(name) {
          var v = document.cookie.match("(^|;) ?" + name + "=([^;]*)(;|$)");
          return v ? v[2] : null;
        }

        function optimocha_check_wc_cart_script() {
        var cart_src = "' . $load_cart_fragments_path . '";
        var script_id = "optimocha_loaded_wc_cart_fragments";

          if( document.getElementById(script_id) !== null ) {
            return false;
          }

          if( optimocha_getCookie("woocommerce_cart_hash") ) {
            var script = document.createElement("script");
            script.id = script_id;
            script.src = cart_src;
            script.async = true;
            document.head.appendChild(script);
          }
        }

        optimocha_check_wc_cart_script();
        document.addEventListener("click", function(){setTimeout(optimocha_check_wc_cart_script,1000);});
        '
      );
    }
add_action('init', 'function_to_add_author_woocommerce', 999 );

function function_to_add_author_woocommerce() {
add_post_type_support( 'product', 'author' );
}

add_filter('woocommerce_subscription_price_string','d_total', 10 ,2 );

function d_total($wcc, $cart){
 // if( WC()->cart->recurring_carts ) {
   //var_dump($cart);
 // }
 // var_dump($wcc['recurring_amount']);
  return $wcc;
}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
    $address_fields['address_2']['label'] = 'APT, SUITE #';
    $address_fields['address_2']['placeholder'] = 'Apt, Suite # Optional ';

    return $address_fields;
}


add_action( 'woocommerce_admin_order_data_after_shipping_address', 'bbloomer_shipping_phone_checkout_display' );

function bbloomer_shipping_phone_checkout_display( $order ){
    echo '<p><b>Shipping Phone:</b> ' . get_post_meta( $order->get_id(), '_shipping_phone', true ) . '</p>';
     echo '<p><b>Shipping Email:</b> ' . get_post_meta( $order->get_id(), '_shipping_email', true ) . '</p>';
}


//add_filter( 'woocommerce_cart_calculate_fees', 'add_recurring_postage_fees', 10, 1 );

function add_recurring_postage_fees( $cart ) {
    if ( ! empty( $cart->recurring_cart_key ) ) {
        remove_action( 'woocommerce_cart_totals_after_order_total', array( 'WC_Subscriptions_Cart', 'display_recurring_totals' ), 10 );
        remove_action( 'woocommerce_review_order_after_order_total', array( 'WC_Subscriptions_Cart', 'display_recurring_totals' ), 10 );
    }
}


//add_action('wcsg_add_recipient_fields','d_gift_message');

function d_gift_message(){
	?>
<p class="form-row form-row <?php echo esc_attr( implode( ' ', $email_field_args['class'] ) ); ?>"
    style="<?php echo esc_attr( implode( '; ', $email_field_args['style_attributes'] ) ); ?>">
    <label for="recipient_message[<?php echo esc_attr( $id ); ?>]">
        <?php esc_html_e( "Add a gift message", 'woocommerce-subscriptions-gifting' ); ?>
    </label>
    <input data-recipient="<?php echo esc_attr( $email ); ?>" type="text" class="input-text recipient_email"
        name="recipient_message[<?php echo esc_attr( $id ); ?>]" id="recipient_message[<?php echo esc_attr( $id ); ?>]"
        placeholder="<?php echo esc_attr( $email_field_args['placeholder'] ); ?>"
        value="<?php echo esc_attr( $email ); ?>" />
</p>
<?php
}

// Coinp form
// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// add_action('woocommerce_checkout_order_review','woocommerce_checkout_coupon_form', 10);

/** Disable Ajax Call from WooCommerce */

function wcs_cps_from_string( $price, $product ) {
	//var_dump($price);
	return $price;
}



//add_action('wp_head','d_google_js');


function d_google_js(){
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
}

//add_filter( 'woocommerce_get_price_html', 'wcs_cps_from_string', 10, 2 );


function filter_woocommerce_customer_default_location_array( $location ) {
    // make filter magic happen here...
    $location['state'] = null;
    return $location;
}

// add the filter
add_filter( 'woocommerce_customer_default_location_array', 'filter_woocommerce_customer_default_location_array', 10, 1 );



//add_filter('woocommerce_cart_shipping_method_full_label', 'custom_shipping_method_label', 10, 2);
function custom_shipping_method_label( $label, $method ){
    $rate_id = $method->id; // The Method rate ID (Method Id + ':' + Instance ID)
   // var_dump($rate_id );

    // Continue only if it is "flat rate"
    //if( $method->method_id !== 'flat_rate' ) return $label;

    switch ( $rate_id ) {
        case 'free_shipping:1':
            $label = __('Regular Shipping <br>(Each 10th of the month'); // <= Additional text
            break;
         // for case '2' and others 'flat rates' (in case of)
        default:
            $label =  __('Express Shipping <br>(Shipped in the next 2 days): '); // <= Additional text
    }
    return $label;
}



//add_filter( 'woocommerce_package_rates', 'change_shipping_methods_label_names', 10, 2 );
function change_shipping_methods_label_names( $rates, $package ) {

    foreach( $rates as $rate_key => $rate ) {
    	//var_dump($rate_key);

    	$rates[$rate_key]->label = str_replace('(','<br>(',$rates[$rate_key]->label);

        if ( 'free_shipping:1' == $rate_key )
            $rates[$rate_key]->label = __( 'Regular Shipping <br>(Each 10th of the month)', 'woocommerce' ); // New label name

        if ( 'flat_rate:2' == $rate_key )
            $rates[$rate_key]->label = __( 'Express Shipping<br> (Shipped in the next 2 days)', 'woocommerce' ); // New label name
    }
    //var_dump($rates);
    return $rates;
}


add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11);
function dequeue_woocommerce_cart_fragments() { if (is_front_page()) wp_dequeue_script('wc-cart-fragments'); }



function filter_woocommerce_product_get_rating_html( $rating_html, $rating, $count ) {
    $rating_html  = '<div class="star-rating">';
    $rating_html .= wc_get_star_rating_html( $rating, $count );
    $rating_html .= '</div>';

    return $rating_html;
};
add_filter( 'woocommerce_product_get_rating_html', 'filter_woocommerce_product_get_rating_html', 10, 3 );
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));



}

function wpa_filter_list_comments($args){
  $args['reverse_top_level'] = false;
  return $args;
}

add_filter( 'wc_product_reviews_pro_product_review_list_args', 'wpa_filter_list_comments' , 10 ,2 );

add_filter('vc_basic_grid_template_filter','add_icon_category', 10, 2);
function add_icon_category($attributes, $attribute ){
	ob_start();

	include( locate_template( 'vc-basicgridfilter.php', false, false ) );

	$output = ob_get_contents();
	
	ob_end_clean();

	return $output;
}


add_filter( 'vc_gitem_template_attribute_case_study_title','vc_gitem_template_attribute_case_study_title', 10, 2 );
function vc_gitem_template_attribute_case_study_title( $value, $data ) {
   extract( array_merge( array(
      'post' => null,
      'data' => '',
   ), $data ) );
  $atts_extended = array();
  parse_str( $data, $atts_extended );
  //$atts = $atts_extended['atts'];
  $product = new WC_Product($post->ID);

  // write all your widget code in here using queries etc
  $title = $product->get_slug();

  	 ob_start();
  	 $product = new WC_Product($post->ID);
    wc_get_template_part( 'content', 'product_grid' );
    return ob_get_clean();


}
add_filter('woocommerce_register_post_type_product', function($post_type) {
    $post_type['has_archive'] = false;
    return $post_type;
});
add_filter( 'vc_grid_item_shortcodes', 'case_study_title_shortcodes' );
function case_study_title_shortcodes( $shortcodes ) {
   $shortcodes['vc_case_study_title'] = array(
     'name' => __( 'Case Study Title', 'sage' ),
     'base' => 'vc_case_study_title',
     'icon' => get_template_directory_uri() . '/assets/images/icon.svg',
     'category' => __( 'Content', 'sage' ),
     'description' => __( 'Displays the case study title with correct icon', 'sage' ),
     'post_type' => Vc_Grid_Item_Editor::postType()
  );
  return $shortcodes;
 }

add_shortcode( 'vc_case_study_title', 'vc_case_study_title_render' );
function vc_case_study_title_render($atts){
   $atts = vc_map_get_attributes( 'vc_case_study_title', $atts );
   return '{{ case_study_title }}';
}

function alx_setup()
{

    add_image_size( 'thumb-medium', 530, 9999 ); // Crop to 520px width, unlimited height
    add_image_size( 'thumb-post-size', 530, 440, true ); // Crop to 520px width, unlimited height
    add_image_size( 'thumb-post-sidebar', 400, 400, true );
    add_image_size( 'thumb-cat-sidebar', 735, 425, true );
    add_image_size( 'variation-size', 80, 100, true );

}
add_action( 'after_setup_theme', 'alx_setup' );



// define the single_product_archive_thumbnail_size callback
function filter_single_product_archive_thumbnail_size( $size ) {
    // make filter magic happen here...
    $size = 'thumb-medium';
    return $size;
}

// add the filter
add_filter( 'single_product_archive_thumbnail_size', 'filter_single_product_archive_thumbnail_size', 10, 1 );
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}
add_action('woocommerce_before_single_product_summary','bbloomer_new_badge_shop_page', 3);


function bbloomer_new_badge_shop_page() {
   global $product;
   $newness_days = 30;
   $created = strtotime( $product->get_date_created() );
   if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
      echo '<span class="itsnew onsale">' . esc_html__( 'NEW', 'woocommerce' ) . '</span>';
   }
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */


add_action('wp_head','font_face');
function font_face(){
	# this is not the official method!
    # REMOVED BY FER CATALANO
	//echo '<link rel="stylesheet" href="https://use.typekit.net/fzp5fwz.css">';
    //echo '<link rel="stylesheet" href="https://baketivity.com/font.css">';
?>
<script>
(function(w, d, t, r, u) {
    var f, n, i;
    w[u] = w[u] || [], f = function() {
        var o = {
            ti: "17248558"
        };
        o.q = w[u], w[u] = new UET(o), w[u].push("pageLoad")
    }, n = d.createElement(t), n.src = r, n.async = 1, n.onload = n.onreadystatechange = function() {
        var s = this.readyState;
        s && s !== "loaded" && s !== "complete" || (f(), n.onload = n.onreadystatechange = null)
    }, i = d.getElementsByTagName(t)[0], i.parentNode.insertBefore(n, i)
})(window, document, "script", "//bat.bing.com/bat.js", "uetq");
</script>

<script type="text/javascript">
jQuery(document).ready(function() {
    //console.log(WCSViewSubscription.has_payment_gateway);
    jQuery(document).on('click', 'a.subscription-auto-renew-toggle', function() {

        if (jQuery(this).hasClass('subscription-auto-renew-toggle--off')) {
            WCSViewSubscription.has_payment_gateway = '';
            //console.log("off");
        }

    });
});
</script>
<?php

}

function wpcustom_inspect_scripts_and_styles() {
    global $wp_scripts;
    global $wp_styles;

    // Runs through the queue scripts
    foreach( $wp_scripts->queue as $handle ) :
        $scripts_list .= $handle . ' | ';
    endforeach;

    // Runs through the queue styles
    foreach( $wp_styles->queue as $handle ) :
        $styles_list .= $handle . ' | ';
    endforeach;

    printf('Scripts: %1$s  Styles: %2$s',
    $scripts_list,
    $styles_list);
}

//add_action( 'wp_print_scripts', 'wpcustom_inspect_scripts_and_styles' );


function child_theme_enqueue_scripts() {
    //add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_scripts', 100 );
}

add_action('init','modify_storefront_funcs');
function modify_storefront_funcs(){


	remove_action( 'storefront_post_header_before', 'storefront_post_meta', 10 );
	remove_action('storefront_loop_post','storefront_post_header',10);
	remove_action('storefront_loop_post','storefront_post_content',30);
	remove_action('storefront_header','storefront_product_search', 40);

  remove_action('storefront_header','storefront_secondary_navigation', 30);

  remove_action('storefront_header','storefront_header_cart', 60);

  add_action('storefront_top_header','storefront_header_cart', 60);

  add_action('storefront_top_header','storefront_secondary_navigation', 30);





	remove_action('storefront_single_post_bottom','storefront_display_comments', 20);
	//remove_action('storefront_header','storefront_primary_navigation_wrapper', 42);
	//aremove_action('storefront_header','storefront_header_container_close', 41);
	add_action( 'storefront_post_header_before', 'storefront_post_meta_tag', 20 );
	add_action( 'storefront_post_header_after', 'storefront_post_meta_author', 20 );

	//add_action('storefront_post_content_before','add_this_share_post', 15);

	add_action('storefront_single_post_bottom','storefront_post_meta_tag_open', 4);
	add_action('storefront_single_post_bottom','storefront_post_meta_tag', 5);
	add_action('storefront_single_post_bottom','storefront_post_meta_author_bottom', 6);
	add_action('storefront_single_post_bottom','storefront_post_meta_tag_close', 7);
	remove_action('storefront_single_post_bottom','storefront_post_nav', 10);

	remove_action('storefront_header','storefront_skip_links', 5);
	remove_action('storefront_before_content','woocommerce_breadcrumb', 10);
	add_action('storefront_loop_post','post_loop_in_cat', 20);
}

function s25_sharing_caring() {
  $post_type = get_post_type();
  $include = array('post');
  if(is_single() && in_array($post_type, $include)):
    ?>
<!-- end .share -->
<?php
  endif;
}


function storefront_post_content() {
		?>
<div class="entry-content">
    <?php

		/**
		 * Functions hooked in to storefront_post_content_before action.
		 *
		 * @hooked storefront_post_thumbnail - 10
		 */
		do_action( 'storefront_post_content_before' );
		echo '<div class="inner-post">';
    //echo s25_sharing_caring();
    ?>
    <div class="addthis_inline_share_toolbox 123">
        <div class="at-share-btn-elements">
            <a class="at-share-btn" target="_blank"
                href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"
                    version="1.1" role="img" aria-labelledby="at-svg-facebook-1" class="at-icon at-icon-facebook"
                    style="fill: rgb(255, 255, 255); width: 32px; height: 32px;">
                    <title id="at-svg-facebook-1">Facebook</title>
                    <g>
                        <path
                            d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z"
                            fill-rule="evenodd"></path>
                    </g>
                </svg></a>


            <a class="at-share-btn" target="_blank" href="https://twitter.com/share?url=<?php the_permalink();?> "><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"
                    version="1.1" role="img" aria-labelledby="at-svg-twitter-2" class="at-icon at-icon-twitter"
                    style="fill: rgb(255, 255, 255); width: 32px; height: 32px;">
                    <title id="at-svg-twitter-2">Twitter</title>
                    <g>
                        <path
                            d="M27.996 10.116c-.81.36-1.68.602-2.592.71a4.526 4.526 0 0 0 1.984-2.496 9.037 9.037 0 0 1-2.866 1.095 4.513 4.513 0 0 0-7.69 4.116 12.81 12.81 0 0 1-9.3-4.715 4.49 4.49 0 0 0-.612 2.27 4.51 4.51 0 0 0 2.008 3.755 4.495 4.495 0 0 1-2.044-.564v.057a4.515 4.515 0 0 0 3.62 4.425 4.52 4.52 0 0 1-2.04.077 4.517 4.517 0 0 0 4.217 3.134 9.055 9.055 0 0 1-5.604 1.93A9.18 9.18 0 0 1 6 23.85a12.773 12.773 0 0 0 6.918 2.027c8.3 0 12.84-6.876 12.84-12.84 0-.195-.005-.39-.014-.583a9.172 9.172 0 0 0 2.252-2.336"
                            fill-rule="evenodd"></path>
                    </g>
                </svg></a>

            <a class="at-share-btn" target="_blank"
                href="https://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php echo get_the_post_thumbnail_url();?>&description=<?php echo excerpt(20);?>"><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"
                    version="1.1" role="img" aria-labelledby="at-svg-pinterest_share-3"
                    class="at-icon at-icon-pinterest_share"
                    style="fill: rgb(255, 255, 255); width: 32px; height: 32px;">
                    <title id="at-svg-pinterest_share-3">Pinterest</title>
                    <g>
                        <path
                            d="M7 13.252c0 1.81.772 4.45 2.895 5.045.074.014.178.04.252.04.49 0 .772-1.27.772-1.63 0-.428-1.174-1.34-1.174-3.123 0-3.705 3.028-6.33 6.947-6.33 3.37 0 5.863 1.782 5.863 5.058 0 2.446-1.054 7.035-4.468 7.035-1.232 0-2.286-.83-2.286-2.018 0-1.742 1.307-3.43 1.307-5.225 0-1.092-.67-1.977-1.916-1.977-1.692 0-2.732 1.77-2.732 3.165 0 .774.104 1.63.476 2.336-.683 2.736-2.08 6.814-2.08 9.633 0 .87.135 1.728.224 2.6l.134.137.207-.07c2.494-3.178 2.405-3.8 3.533-7.96.61 1.077 2.182 1.658 3.43 1.658 5.254 0 7.614-4.77 7.614-9.067C26 7.987 21.755 5 17.094 5 12.017 5 7 8.15 7 13.252z"
                            fill-rule="evenodd"></path>
                    </g>
                </svg></a>
        </div>
    </div>

    <?php
	//	echo '<div class="addthis_inline_share_toolbox 123">'.s25_sharing_caring().'</div>';
		the_content(
			sprintf(
				/* translators: %s: post title */
				__( 'Continue reading %s', 'storefront' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		echo '</div>';

		do_action( 'storefront_post_content_after' );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
				'after'  => '</div>',
			)
		);
		?>
</div><!-- .entry-content -->
<?php
	}
function add_this_share_post(){
	echo '<div class="addthis_inline_share_toolbox 123"></div>';
}
function storefront_post_meta_tag_open(){

	echo '<div class="post-meta-bottom">';
}

function storefront_post_meta_tag_close(){
	echo '</div>';
}
function storefront_post_meta_tag(){

	echo get_the_tag_list('<p class="tag-css" style="position:static;">',' ','</p>');
}
function storefront_post_meta_author_bottom(){
	?>
<div class="post-meta">
    <div class="author-avatar">
        <?php $avatar_url = get_avatar_url ( get_the_author_meta('ID')); ?>

        <img src="<?php echo $avatar_url; ?>" alt="">
    </div>
    <span class="author-name">
        <?php echo get_the_author_meta('display_name');  ?>
        <span class="post-date">
            <?php echo get_the_date('M d, Y'); ?>
        </span>
    </span>


</div>

<?php
}

function storefront_post_meta_author(){
	?>
<div class="post-meta">
    <div class="author-avatar">
        <?php $avatar_url = get_avatar_url ( get_the_author_meta('ID')); ?>

        <img src="<?php echo $avatar_url; ?>" alt="avatar">
    </div>
    <span class="author-name">
        <?php echo get_the_author_meta('display_name');  ?>
    </span>
    <span class="post-date">
        - <?php echo get_the_date('M d, Y'); ?>
    </span>

</div>

<?php
}
function storefront_primary_navigation_wrapper() {
		echo '<div class="storefront-primary-navigation">';
}


add_filter('storefront_menu_toggle_text','d_remove_text');

function d_remove_text(){
  return false;
}

function storefront_site_branding() {
		?>
<div class="site-logo">
    <?php storefront_site_title_or_logo(); ?>

    <?php
}
/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 *
 * @return void
 * @since  1.0.0
 */
function storefront_cart_link() {
	global $woocommerce;
	$count = $woocommerce->cart->cart_contents_count;

	?>
    <a class="cart-contents 123" href="<?php echo esc_url( wc_get_cart_url() ); ?>"
        title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>"><span style="position: absolute;
    top: -10px;
    right: -10px;"><?php echo $count; ?></span>

    </a>

    <?php
}


add_action('storefront_top_header','member_menu_top', 55);
function member_menu_top(){
  ?>
    <div class="member">
        <button class="d-searc-open">
            <span class="d-none">Search</span>
            <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" viewBox="0 0 512.005 512.005" style="enable-background:new 0 0 512.005 512.005;"
                xml:space="preserve">
                <g>
                    <g>
                        <path
                            d="M505.749,475.587l-145.6-145.6c28.203-34.837,45.184-79.104,45.184-127.317c0-111.744-90.923-202.667-202.667-202.667
      S0,90.925,0,202.669s90.923,202.667,202.667,202.667c48.213,0,92.48-16.981,127.317-45.184l145.6,145.6
      c4.16,4.16,9.621,6.251,15.083,6.251s10.923-2.091,15.083-6.251C514.091,497.411,514.091,483.928,505.749,475.587z
       M202.667,362.669c-88.235,0-160-71.765-160-160s71.765-160,160-160s160,71.765,160,160S290.901,362.669,202.667,362.669z" />
                    </g>
                </g>

            </svg>
        </button>
        <a class="login no-border" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
            <span class="d-none">Login</span>
            <i class="user-icon" aria-hidden="true"></i>
        </a>
    </div>
    <?php
}


//add_action('storefront_header','member_menu', 55);
function member_menu(){
	?>
    <div class="member">
        <a class="sub" href="<?php echo home_url('subscribe') ?>">SUBSCRIBE</a>
        <!-- <?php if(!is_user_logged_in()): ?>
				<a class="login no-border" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><i class="user-icon" aria-hidden="true"></i>LOG IN | SIGN UP</a>
			<?php else: ?>
				<a class="login" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><i class="user-icon" aria-hidden="true"></i>My account</a>
			<?php endif; ?> -->

    </div>
    <?php
}

function register_my_menus() {
  register_nav_menus(
    array(
      'footer-menu' => __( 'Footer Menu' ),

    )
  );
}
add_action( 'init', 'register_my_menus' );


function storefront_credit() {

    if ( is_page_template('home-page-redesign.php') ) return;

		$links_output = '';

		if ( apply_filters( '', true ) ) {
			$links_output .= '<a href="https://woocommerce.com" target="_blank" title="' . esc_attr__( 'WooCommerce - The Best eCommerce Platform for WordPress', 'storefront' ) . '" rel="author">' . esc_html__( 'Built with Storefront &amp; WooCommerce', 'storefront' ) . '</a>.';
		}

		if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
			$separator = '<span role="separator" aria-hidden="true"></span>';
			$links_output = get_the_privacy_policy_link( '', ( ! empty( $links_output ) ? $separator : '' ) ) . $links_output;
		}

		$links_output = apply_filters( 'storefront_credit_links_output', $links_output );
		?>
    <div class="footer-menu">
        <?php
			// wp_nav_menu(
			// 	array(
			// 		'theme_location'  => 'footer-menu',
			// 		'container_class' => 'footer-menu-navigation',
			// 	)
			// );
      ?>
    </div>
    <div class="site-info">
        <p class="copyright">
            <?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; '. date( 'Y' ).' All rights reserved Baketivity. ' ) ); ?>
        </p>
        <div class="wpautoterms-footer">
            <a href="<?php echo home_url(); ?>/wpautoterms/return-policy/">Return Policy</a><span class="separator">
            </span><a href="<?php echo home_url(); ?>/wpautoterms/terms-and-conditions/">Terms and Conditions</a><span
                class="separator"> </span><a href="<?php echo home_url(); ?>/wpautoterms/privacy-policy/">Privacy
                Policy</a>
        </div>


        <!-- <p class="credit"><a style="color: inherit; text-decoration: none;" target="_blank" href="http://www.royalimageinc.com/">Credits: Royal Image Group Inc.</a></p> -->


    </div>

    <!-- .site-info -->
    <?php
}

function cc_mime_types($mimes) {
   $mimes['svg'] = 'image/svg+xml';
   $mimes['webp'] = 'image/webp';
   return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function my_text_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Search products&hellip;' :
            $translated_text = __( 'SEARCH BAKETIVITY', 'woocommerce' );
            break;
        case 'Shipping via %s' :
            $translated_text = __( '%s', 'woocommerce-subscriptions' );
            break;
        case 'Proceed to checkout' :
            $translated_text = __( 'Checkout', 'woocommerce-subscriptions' );
            break;
        case '%s months':
            $translated_text = __( '<b>%s months</b>', 'woocommerce-subscriptions' );
            break;


    }
    return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );


// Register Custom Post Type
function custom_post_type_testimonial() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Testimonials', 'text_domain' ),
		'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonial', $args );

}
add_action( 'init', 'custom_post_type_testimonial', 0 );


function testimonial_loop_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'type' => 'testimonial',
        'perpage' => 4
    ), $atts ) );

    $args = array(
        'post_type' => $type,
        'posts_per_page' => $perpage,
    );
    $andrew_query = new  WP_Query( $args );
    ob_start();

    echo'<div class="owl-carousel owl-theme testimonial">';
    while ( $andrew_query->have_posts() ) : $andrew_query->the_post(); ?>

    <div class="item">
        <img class="quote-photo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/np_quote_1615893_000000.svg"
            alt="">
        <div class="quote">
            <?php the_content(); ?>
        </div>
        <div class="des">
            <?php if(get_field('photo')): ?>
            <div class="photo">
                <img src="<?php echo get_field('photo'); ?>" alt="">
            </div>
            <?php endif; ?>
            <div class="bio">
                <h5><?php echo get_the_title();?><?php if(get_field('position')): ?>,
                    <span><?php echo get_field('position'); ?></span>
                    <?php endif; ?>
                </h5>
                <p><?php echo get_field('bio') ?></p>
            </div>
        </div>
    </div>

    <?php endwhile;
    wp_reset_postdata();
    echo '</div>';
    $output_string = ob_get_contents();
	  ob_end_clean();
	  return $output_string;


}
add_shortcode('testimonial', 'testimonial_loop_shortcode');


add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = -1; // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
}

//add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +
function woo_custom_single_add_to_cart_text( $var) {
    return $var;
}

//add_action( 'woocommerce_after_add_to_cart_quantity', 'custom_content_after_addtocart_button', 100 );
function custom_content_after_addtocart_button() {
	global $product;
	?>
    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
        class="buynow single_add_to_cart_button button alt" id="buy_now_button">
        <?php echo esc_html('Buy Now'); ?>
    </button>
    <input type="hidden" name="is_buy_now" id="is_buy_now" value="0" />
    <?php
}

add_action('woocommerce_after_add_to_cart_form', 'buy_now_submit_form');
function buy_now_submit_form() {
 ?>
    <script>
    jQuery(document).ready(function() {
        // listen if someone clicks 'Buy Now' button
        jQuery('#buy_now_button').click(function() {
            // set value to 1
            jQuery('#is_buy_now').val('1');
            //submit the form
            jQuery('form.cart').submit();
        });
    });
    </script>
    <?php
}


add_action('wp_footer','testimonial_script',200);
function testimonial_script(){

    if ( is_page_template('home-page-redesign.php')) return;

	if ( is_front_page()) {
	?>

    <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".owl-carousel.testimonial").vcOwlCarousel({
            loop: true,
            pagination: false,
            dots: false,
            margin: 0,
            nav: true,
            navText: ["<i class='fal fa-arrow-left'></i>", "<i class='fal fa-arrow-right'></i>"],
            items: 1
        })

    })
    </script>

    <?php
	}

	if ( is_category()) {
	?>

    <script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery(".slider-in-cat").owlCarousel({
            loop: true,
            pagination: false,
            dots: false,
            margin: 0,
            nav: true,
            navText: ["<i class='fal fa-arrow-left'></i>", "<i class='fal fa-arrow-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                },
                1100: {
                    items: 5
                },
                1200: {
                    items: 6
                }
            }
        })

    })
    </script>

    <?php
	}
	if ( is_singular('product')) {
	?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery(".single_variation_wrap").on("show_variation", function(event, variation) {
                jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('src', variation['image']['src']).change();
                jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('currentSrc', variation['image']['src']).change();
                jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('datasrc', variation['image']['src']).change();
                jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('srcset', variation['image']['src']).change();
                jQuery('a.venobox.vbox-item').attr('href', variation['image']['url']).change();
                // Fired when the user selects all the required dropdowns / attributes
                // and a final variation is selected / shown
            });

            jQuery('.flexslider ul').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                centerPadding: '40px',
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,

                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });
    </script>
    <?php
	}

	if ( is_singular('post')) {
	?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.related-post-in').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                centerPadding: '40px',
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,

                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });
    </script>
    <?php
	}
}
function is_realy_woocommerce_page () {
    if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
        return true;
    }
    $woocommerce_keys = array ( "woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" ) ;

    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
            return true ;
        }
    }
    return false;
}

function storefront_page_header() {
    if ( is_front_page() && is_page_template( 'template-fullwidth.php' ) ) {
        return;
    } ?>
    <div class="entry-header 123">
        <?php if(is_realy_woocommerce_page() == true ):
			//storefront_post_thumbnail( 'full' );
			the_title( '<h1 class="entry-title">', '</h1>' );
			endif;
			?>
    </div><!-- .entry-header -->
    <?php
}

function badge_shop_page_wrap_open(){
	echo '<div class="badges">';
}

//define the woocommerce_product_add_to_cart_text callback
function filter_woocommerce_product_add_to_cart_text( $var, $instance ) {
    // make filter magic happen here...
    $var = "<i class='fas fa-shopping-cart'></i><span>".$var."</span>";
    return $var;
};
 function bbloomer_redirect_checkout_add_cart( $url ) {
   $url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) );
   return $url;
}

//add_filter( 'woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart' );
// add the filter
//add_filter( 'woocommerce_product_add_to_cart_text', 'filter_woocommerce_product_add_to_cart_text', 10, 2 );

//dd_filter( 'woocommerce_loop_add_to_cart_link', 'filter_loop_add_to_cart_link', 20, 3 );
function filter_loop_add_to_cart_link( $button, $product, $args = array() ) {
	$button = "<i class='fas fa-shopping-cart'></i>".$button;
	return strip_tags( $button, '<i><a>'); ;
}

function badge_shop_page_wrap_close(){
	echo '</div>';
}

function product_button_details(){
	echo '<a href="'.get_permalink().'"><i class="fas fa-list"></i></a>';
}

function action_wrap_open(){
	echo '<div class="actions">';
}

function action_wrap_close(){
	echo '</div>';
}


function product_single_button_details(){
	echo '<a href="'.home_url('/shop/').'"><i class="fas fa-list"></i></a>';
}

function product_single_cart_page(){
	echo '<a href="'.get_permalink( wc_get_page_id( 'cart' )) .'"><i class="fas fa-shopping-cart"></i></a>';


}
add_filter( 'woocommerce_single_product_image_gallery_classes', 'bbloomer_5_columns_product_gallery' );

function bbloomer_5_columns_product_gallery( $wrapper_classes ) {
$columns = 3; // change this to 2, 3, 5, etc. Default is 4.
$wrapper_classes[2] = 'woocommerce-product-gallery--columns-' . absint( $columns );
return $wrapper_classes;
}

add_filter( 'woocommerce_single_product_carousel_options', 'ud_update_woo_flexslider_options' );
function ud_update_woo_flexslider_options( $options ) {
    $options['directionNav'] = true;
    return $options;
}


function des_shop_page_wrap_open(){
	echo '<div class="des-product">';
}

function des_shop_page_wrap_close(){
	echo '</div>';
}
function d_klaviyo_cs(){
	global $product,$loop;

	$ImageUrl = '';
	if(is_object($loop)) {
		$ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' )[0];
	}

	$ItemId = $product->id;
	$Title = $product-> get_title();
	$ProductUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$Price = $product->get_sale_price();
	$RegularPrice = $product->get_regular_price();
  $DiscountAmount = 0;
  if($Price){
    $DiscountAmount = $RegularPrice - $Price;
  }

	$terms = get_terms( 'product_tag' );
	?>

    <script>
    var Title = "<?php echo $Title; ?>";
    var ItemId = "<?php echo $ItemId; ?>";
    var ImageUrl = "<?php echo $ImageUrl; ?>";
    var ProductUrl = "<?php echo $ProductUrl; ?>";
    var Price = "<?php echo $Price; ?>";
    var DiscountAmount = "<?php echo $DiscountAmount; ?>";
    var RegularPrice = "<?php echo $RegularPrice; ?>";
    var _learnq = _learnq || [];

    _learnq.push(['track', 'Viewed Product', {
        Title: Title,
        ItemId: ItemId,
        ImageUrl: ImageUrl,
        Url: ProductUrl,
        Metadata: {
            Price: Price,
            DiscountAmount: DiscountAmount,
            RegularPrice: RegularPrice
        }
    }]);
    </script>
    <?php
}

add_filter('woocommerce_product_description_heading', function(){return false;});
add_action('init','modify_actions');
	function modify_actions(){

    add_action('woocommerce_single_product_summary','d_klaviyo_cs', 10);
	add_action( 'woocommerce_before_add_to_cart_button', 'action_wrap_open', 16, 0 );
	remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);

	add_action( 'woocommerce_before_add_to_cart_button', 'product_single_button_details', 20, 0 );
	add_action( 'woocommerce_before_add_to_cart_button', 'product_single_cart_page', 30, 0 );
	add_action( 'woocommerce_before_add_to_cart_button', 'action_wrap_close', 60, 0 );

	add_action( 'woocommerce_before_shop_loop_item_title', 'badge_shop_page_wrap_open', 3);
	add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_new_badge_shop_page', 4 );
	add_action('woocommerce_before_single_product_summary','des_shop_page_wrap_open', 1);
	add_action('woocommerce_before_single_product_summary','badge_shop_page_wrap_open', 2);

	add_action('woocommerce_single_product_summary','des_shop_page_wrap_close',70);
	remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash', 10);
	add_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash', 4);

	add_action('woocommerce_before_single_product_summary','badge_shop_page_wrap_close', 6);
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 5 );
	//add_action( 'woocommerce_before_shop_loop_item_title', 'product_button_details', 6);
	add_action( 'woocommerce_before_shop_loop_item_title', 'badge_shop_page_wrap_close', 7);

	//add_action( 'woocommerce_after_shop_loop_item', 'action_wrap_open', 5);
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 25 );
	//add_action( 'woocommerce_after_shop_loop_item', 'product_button_details', 20);
	//add_action( 'woocommerce_after_shop_loop_item', 'action_wrap_close', 30 );

	//remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open_cs', 8 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close_cs', 15 );

//	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 6 );
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
	add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 15);
}




function woocommerce_template_loop_product_link_open_cs(){
	global $product;
	echo '<div class="thumb-css">';
	echo '<svg class="prev-thumb" xmlns="http://www.w3.org/2000/svg" width="10.101" height="23.973" viewBox="0 0 10.101 23.973">
	<path id="Path_1877" data-name="Path 1877" d="M-1607,171.208l9.07,11.407-9.07,11.952" transform="translate(-1597.297 194.87) rotate(180)" fill="none" stroke="#4d4d4f" stroke-width="1"/>
  </svg>';
  echo '<a href="'.get_the_permalink().'" class="link-image">';
	$attachment_ids = $product->get_gallery_image_ids();
	if ( is_array( $attachment_ids ) && !empty($attachment_ids) ) {
        // Full image
	    //$first_image_url = wp_get_attachment_url( $attachment_ids[0] );
        // Change by Fer Catalano - Small image
        $first_image_url = wp_get_attachment_image_src( $attachment_ids[0], 'medium' )[0];
	   echo '<img class="on-hover-thumb" alt="'.get_the_title().'" src="'.$first_image_url.'">';

	}

}

function woocommerce_template_loop_product_link_close_cs(){
    echo '</a>';
	echo '<svg class="next-thumb" xmlns="http://www.w3.org/2000/svg" width="10.101" height="23.973" viewBox="0 0 10.101 23.973">
	<path id="Path_1875" data-name="Path 1875" d="M-1607,171.208l9.07,11.407-9.07,11.952" transform="translate(1607.399 -170.897)" fill="none" stroke="#4d4d4f" stroke-width="1"/>
  </svg>
  ';

	echo '</div>';
}
add_filter('woocommerce_format_sale_price', 'ss_format_sale_price', 100, 3);
function ss_format_sale_price( $price, $regular_price, $sale_price ) {
    $price = '<ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins><del>Reg.' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del> ';
    return $price;
}


// function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
//     global $post;
//     $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

//     if ( has_post_thumbnail() ) {
//         $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
//         return get_the_post_thumbnail( $post->ID, $image_size, array(
//             'title' => $props['title'],
//             'alt' => '123',
//  ) );
//     } elseif ( wc_placeholder_img_src() ) {
//         return wc_placeholder_img( $image_size );
//     }
// }
//add_filter( 'post_thumbnail_html', 'my_post_thumbnail_fallback', 20, 5 );
function my_post_thumbnail_fallback( $html, $post_id, $post_thumbnail_id, $size, $attr ) {

	//var_dump($post_id);
    if ( empty( $html ) ) {
        // return you fallback image either from post of default as html img tag.
    }
    return $html;
}

function woocommerce_template_loop_product_title() {
    echo '<h4 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h4>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}


// pricing table
function pricingtable_func( $atts ) {
   $atts = shortcode_atts(
        array(
            'title_tag' => 'h2',
        ), $atts, 'pricingtable_func' );
   extract($atts);
		$args = array(
      'title_tag' =>'$title_tag',
			'post_type' => 'product',
			'posts_per_page' => 4,
			'orderby' => 'date',
			'order' => 'ASC',
			'tax_query' => array(
				'relation' => 'OR',
		        array(
		            'taxonomy' => 'product_type',
		            'field'    => 'slug',
		            'terms'    => 'subscription',
		        ),
		         array(
		            'taxonomy' => 'product_type',
		            'field'    => 'slug',
		            'terms'    => 'variable-subscription',
		        ),
		    ),
			);

		$loop = new WP_Query( $args );
		ob_start();
		$buttonArr = array();
		$buttonLoopCount = 1;
		if ( $loop->have_posts() ) {

			echo "<div class='sub-product-list subscription-product-list-desk'>";
			while ( $loop->have_posts() ) : $loop->the_post();
				//var_dump($title_tag);
				$buttonArr[] = get_the_ID();
				set_query_var('title_tag', $title_tag);
				wc_get_template_part( 'content', 'product_sub' );
			endwhile;
			echo "</div>";

			if( !empty( $buttonArr ) ){ ?>
    <div class="subscription-product-list-mobile">
        <div class="tab">
            <?php foreach( $buttonArr as $buttonLoop ){ $defaultOpen = ( $buttonLoopCount == 1 ) ? 'id="defaultOpen"' : ''; ?>
            <button class="tablinks" <?php echo $defaultOpen; ?>
                onclick="openSubscrTab(event, '<?php echo 'subscription_tab_'.$buttonLoop; ?>')"><?php echo get_the_title( $buttonLoop ); ?></button>
            <?php $buttonLoopCount++; } ?>
        </div>

        <?php
				while ( $loop->have_posts() ) : $loop->the_post();
				?>
        <div id="<?php echo 'subscription_tab_'.get_the_ID(); ?>" class="tabcontent sub-product-list">
            <?php
					set_query_var('title_tag', $title_tag);
					wc_get_template_part( 'content', 'product_sub' );
					?>
        </div>
        <?php
				endwhile;
				?>
    </div>
    <script>
    function openSubscrTab(evt, subscrName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(subscrName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>
    <?php
			}

		} else {
			echo __( 'No products found' );
		}
    do_action('d_listen_add_to_cart_event');
		wp_reset_postdata();
		$output_string = ob_get_contents();
		ob_end_clean();
		return $output_string;


}
add_shortcode( 'pricingtable', 'pricingtable_func' );

add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
/**
* Custom text for 'woocommerce_product_add_to_cart_text' filter for all product types/ cases.
*
* @link   https://gist.github.com/deckerweb/cf466e017fd01d503469
*
* @global $product
*
* @return string String for add to cart text.
*/
function custom_woocommerce_product_add_to_cart_text($var) {
	global $product;
	$product_type = $product->get_type();
	switch ( $product_type ) {
		case 'external':
			return __( '<span>Buy product</span>', 'woocommerce' );
		break;
		case 'grouped':
			return __( '<span>View products</span>', 'woocommerce' );
		break;
		case 'simple':
			return __( '<span>Add to cart</span>', 'woocommerce' );
		break;
		case 'variable':
			return __( '<span>Select options</span>', 'woocommerce' );
		break;
		case 'subscription':
			return __( '<span>Select this plan</span>', 'woocommerce' );
		break;
		default:
			return __( '<span>Read more</span>', 'woocommerce' );
	}  // end switch
}  // end function

function my_assets() {
	wp_enqueue_script( 'flexslider_cs', get_stylesheet_directory_uri() .'/assets/js/flex-slider.js', array( 'jquery' ), WPB_VC_VERSION, true );
	wp_enqueue_script('jquery-modal-js', get_stylesheet_directory_uri() . '/assets/js/jquery.modal.min.js', array('jquery'));

	if(is_category() || is_singular('post') || is_singular('page')){
		wp_enqueue_script( 'owl-js', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'owl-js' );
		wp_enqueue_style( 'owl-css', get_stylesheet_directory_uri() . '/assets/owl.carousel.css' );
		//wp_enqueue_style( 'gfont-one', 'https://fonts.googleapis.com/css?family=Roboto:400,500,900&display=block', null ); Remove by Fer Catalano
		wp_enqueue_style( 'fa-one', get_stylesheet_directory_uri().'/assets/css/fontawesome-pro-5.8.1/css/all.css', null );
	}

    wp_enqueue_style('jquery-modal-css', get_stylesheet_directory_uri() . '/css/jquery.modal.min.css');

	wp_enqueue_script( 'app-js', get_stylesheet_directory_uri() . '/js/app.min.js', array( 'jquery' ), THEME_VERSION );
	wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() . '/style.min.css', array(), THEME_VERSION, 'all' );

	wp_localize_script('app-js', 'ajax', array(
		'url'    => admin_url('admin-ajax.php'),
		'nonce'  => wp_create_nonce('ajax-nonce'),
	));
}

add_action( 'wp_enqueue_scripts', 'my_assets' );


function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  $excerpt = preg_replace('#\[[^\]]+\]#', '',$excerpt);
  return $excerpt;
}



function content($limit) {

  $content = explode(' ', get_the_ex(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]>', $content);
  $content = preg_replace('#\[[^\]]+\]#', '',$content);

  return $content;
}



// add_filter('woocommerce_loop_add_to_cart_args','modify_loop_cart', 10 , 2);

// function modify_loop_cart( $args, $product ){
// 	var_dump($args['class']);

// 	 //ajax_add_to_cart
// 	return $args;

// }

// add_filter('pre_get_posts','better_editions_archive', 10 ,2);

// function better_editions_archive( $query ) {
// 	//var_dump($query);
//     if ( $query->is_main_query() && is_page(8) ) {

//        var_dump($query);
//         $query->set( 'tax_query', array(
//             'relation' => 'OR',
//             array(
//                 'taxonomy' => 'product_cat',
//                 'field' => 'slug',
//                 'terms' => 'subscriptions',
//                 'operator' => 'NOT IN'
//             )
//         ) );
//     }

//     return $query;
// }



function woocommerce_cart_item_subtotal_cs( $subtotal, $cart_item, $cart_item_key  ) {
//	var_dump($cart_item['product_id']);
	$_product =  wc_get_product($cart_item['product_id']);
	if($_product->is_type( 'subscription' )) {
		$price_sale =  WC_Subscriptions_Product::get_price( $_product );
		$get_regular_price =  WC_Subscriptions_Product::get_regular_price( $_product);
		$period = WC_Subscriptions_Product::get_period( $_product);
		$lenght   = WC_Subscriptions_Product::get_interval($_product);

		$target = in_category('local-msr') ? 'target="_blank"' : '';
		$none  = '';
		if($lenght > 1) {
			$none  = 's';
		}

		$subtotal =  wc_price($price_sale);
	}

	return $subtotal;
}
add_filter( 'woocommerce_cart_item_subtotal', 'woocommerce_cart_item_subtotal_cs', 10, 3 );



function sv_change_product_price_cart( $price, $cart_item, $cart_item_key ) {
	$_product =  wc_get_product($cart_item['product_id']);
	if($_product->is_type( 'subscription' )){
		$price_sale =  WC_Subscriptions_Product::get_price( $_product );
		$get_regular_price =  WC_Subscriptions_Product::get_regular_price( $_product);
		$period = WC_Subscriptions_Product::get_period( $_product);
		$lenght   = WC_Subscriptions_Product::get_interval($_product);

		$target = in_category('local-msr') ? 'target="_blank"' : '';
		$none  = '';
		if($lenght > 1) {
			$none  = 's';
		}

		$price = '<div class="first-payment-date">'.wc_price($price_sale).'<small class="d-renewed">auto renewed after '.$lenght .' '. $period.$none.'</small></div>';
	}

	return $price;
}
add_filter( 'woocommerce_cart_item_price', 'sv_change_product_price_cart', 10, 3 );



add_filter( 'manage_edit-shop_order_columns', 'custom_shop_order_column', 90 );
function custom_shop_order_column( $columns )
{
    $ordered_columns = array();

    foreach( $columns as $key => $column ){
        $ordered_columns[$key] = $column;
        if( 'order_date' == $key ){
            $ordered_columns['order_notes'] = __( 'Notes', 'woocommerce');
        }
    }

    return $ordered_columns;
}

add_action( 'manage_shop_order_posts_custom_column' , 'custom_shop_order_list_column_content', 10, 1 );
function custom_shop_order_list_column_content( $column )
{
    global $post, $the_order;

    $customer_note = $post->post_excerpt;

    if ( $column == 'order_notes' ) {

        if ( $the_order->get_customer_note() ) {
            echo '<span class="note-on customer tips" data-tip="' . wc_sanitize_tooltip( $the_order->get_customer_note() ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
        }

        if ( $post->comment_count ) {

            $latest_notes = wc_get_order_notes( array(
                'order_id' => $post->ID,
                'limit'    => 1,
                'orderby'  => 'date_created_gmt',
            ) );

            $latest_note = current( $latest_notes );

            if ( isset( $latest_note->content ) && 1 == $post->comment_count ) {
                echo '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip( $latest_note->content ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
            } elseif ( isset( $latest_note->content ) ) {
                // translators: %d: notes count
                echo '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip( $latest_note->content . '<br/><small style="display:block">' . sprintf( _n( 'Plus %d other note', 'Plus %d other notes', ( $post->comment_count - 1 ), 'woocommerce' ), $post->comment_count - 1 ) . '</small>' ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
            } else {
                // translators: %d: notes count
                echo '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip( sprintf( _n( '%d note', '%d notes', $post->comment_count, 'woocommerce' ), $post->comment_count ) ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
            }
        }
    }
}

// Set Here the WooCommerce icon for your action button
add_action( 'admin_head', 'add_custom_order_status_actions_button_css' );
function add_custom_order_status_actions_button_css() {
    echo '<style>
    td.order_notes > .note-on { display: inline-block !important;}
    span.note-on.customer { margin-right: 4px !important;}
    span.note-on.customer::after { font-family: woocommerce !important; content: "\e026" !important;}
    </style>';
}
function check_renew_toggle($subscription){

	// Cannot change to auto-renewal for a subscription with status other than active
		if ( ! $subscription->has_status( 'active' ) ) {
			return false;
		}
		// // Cannot change to auto-renewal for a subscription with 0 total
		// if ( 0 == $subscription->get_total() ) { // Not using strict comparison intentionally
		// 	return false;
		// }
		// Cannot change to auto-renewal for a subscription in the final billing period. No next renewal date.
		if ( 0 == $subscription->get_date( 'next_payment' ) ) { // Not using strict comparison intentionally
			return false;
		}
		// If it is not a manual subscription, and the payment gateway is PayPal Standard
		if ( ! $subscription->is_manual() && $subscription->payment_method_supports( 'gateway_scheduled_payments' ) ) {
			return false;
		}

		// Looks like changing to auto-renewal is indeed possible
		return true;

}

// add_action( 'restrict_manage_posts', 'admin_shop_order_by_product_type_filter' );
// function admin_shop_order_by_product_type_filter(){
//     global $pagenow, $post_type;

//     if( 'shop_order' === $post_type && 'edit.php' === $pagenow ) {
//         $domain     = 'woocommerce';
//         $filter_id  = 'filter_product_type';
//         $current    = isset($_GET[$filter_id])? $_GET[$filter_id] : '';
//         $query_args = ['taxonomy' => 'product_type', 'fields' => 'names', 'orderby' => 'order'];

//         echo '<select name="'.$filter_id.'">
//         <option value="">' . __('Filter by Product post type', $domain) . '</option>';

//         foreach ( get_terms($query_args) as $term_name ) {
//             printf( '<option value="%s"%s>%s</option>', $term_name,
//                 $term_name === $current ? '" selected="selected"' : '', ucfirst($term_name) );
//         }
//         echo '</select>';
//     }
// }

// add_action( 'pre_get_posts', 'process_admin_shop_order_product_type_filter' );
// function process_admin_shop_order_product_type_filter( $query ) {
//     global $pagenow, $post_type, $wpdb;

//     $filter_id = 'filter_product_type';

//     if ( $query->is_admin && 'edit.php' === $pagenow && 'shop_order' === $post_type
//          && isset( $_GET[$filter_id] ) && $_GET[$filter_id] != '' ) {

//         $order_ids = $wpdb->get_col( "
//             SELECT DISTINCT o.ID
//             FROM {$wpdb->prefix}posts o
//             INNER JOIN {$wpdb->prefix}woocommerce_order_items oi
//                 ON oi.order_id = o.ID
//             INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta oim
//                 ON oi.order_item_id = oim.order_item_id
//             INNER JOIN {$wpdb->prefix}term_relationships tr
//                 ON oim.meta_value = tr.object_id
//             INNER JOIN {$wpdb->prefix}term_taxonomy tt
//                 ON tr.term_taxonomy_id = tt.term_taxonomy_id
//             INNER JOIN {$wpdb->prefix}terms t
//                 ON tt.term_id = t.term_id
//             WHERE o.post_type = '$post_type'
//             AND oim.meta_key = '_product_id'
//             AND tt.taxonomy = 'product_type'
//             AND t.name = '{$_GET[$filter_id]}'
//         ");

//         $query->set( 'post__in', $order_ids ); // Set the new "meta query"

//         $query->set( 'posts_per_page', 25 ); // Set "posts per page"

//         $query->set( 'paged', ( get_query_var('paged') ? get_query_var('paged') : 1 ) ); // Set "paged"
//     }
// }
//define the woocommerce_email_order_details callback
function action_woocommerce_email_order_details($order,$sent_to_admin,$plain_text,$email) {
	if($email->id == 'customer_completed_order' || $email->id == 'recipient_completed_renewal_order'){

		$label_ids = get_posts( array(
			'posts_per_page' => -1,
			'post_type'      => 'wc_stamps_label',
			'post_parent'    => $order->get_id(),
		));

		if( ! empty( $label_ids ) ){
			$output = '<div><p>';
			foreach ( $label_ids as $p ){
				$tracking = $p->post_title;
				$date = esc_html( date_i18n( get_option( 'date_format' ), strtotime( $p->post_date) ) );
				$output .= 'Your order was shipped on '.$date .' .Tracking number ' .$tracking.'. ';
				$output .= '<a target="_blank" href="https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=' . esc_attr( $tracking) . '">Click here to track you shipment</a>';
			}
			$output .= '</p></div>';
			echo $output;
		}
    }
}

// add the action
add_action( 'woocommerce_email_order_details', 'action_woocommerce_email_order_details', 10, 4 );

add_action( 'woocommerce_subscriptions_email_order_details', 'action_woocommerce_email_order_details', 30, 4);
add_action( 'wcs_gifting_email_order_details', 'action_woocommerce_email_order_details', 10 ,4);


add_action( 'woocommerce_order_details_before_order_table', 'so_32457241_before_order_itemmeta', 10, 1);
function so_32457241_before_order_itemmeta( $order){

	$label_ids = get_posts( array(
		'posts_per_page' => -1,
		'post_type'      => 'wc_stamps_label',
		'post_parent'    => $order->get_id(),
	) );

	if( ! empty( $label_ids ) ){
		$output = '<div><p>';
		foreach ( $label_ids as $p ){
			$tracking = $p->post_title;
			$date = esc_html( date_i18n( get_option( 'date_format' ), strtotime( $p->post_date) ) );
			$output .= 'Your order was shipped on '.$date .' .Tracking number ' .$tracking.'. ';
			$output .= '<a target="_blank" href="https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=' . esc_attr( $tracking) . '">Click here to track you shipment</a>';
		}
		$output .= '</p></div>';
		echo $output;
	}
}


function remove_output_structured_data() {
  remove_action( 'wp_footer', array( WC()->structured_data, 'output_structured_data' ), 10 ); // Frontend pages
  remove_action( 'woocommerce_email_order_details', array( WC()->structured_data, 'output_email_structured_data' ), 30 ); // Emails
}
//add_action( 'init', 'remove_output_structured_data' );



function disable_media_comment( $open, $post_id ) {
	if( get_post_type( $post_id ) == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'disable_media_comment', 100 , 2 );


function categories_post_func( $atts ) {
    extract( shortcode_atts( array(
        'type' => 'testimonial',
        'perpage' => 4
    ), $atts ) );

    $partners_obj = get_terms( 'category', array('hide_empty' => false) );

    ob_start();

    echo'<div class="list-term-post">';

    foreach ($partners_obj as $term) {  ?>
    <div class="cat-item">
        <a href="<?php echo get_term_link( $term->slug, 'category' );?>" class="cat-item-link">
            <div class="cat-item-in">
                <?php
			 			$image = get_field('icon', $term);
						$color = get_field('background', $term);
					?>
                <div class="cat-item-icon" style="background-color: <?php echo $color; ?> ">
                    <img src="<?php echo $image; ?>" alt="">
                </div>
                <h3 class="cat-item-title">
                    <?php echo $term->name; ?>
                </h3>
                <span class="cat-item-count">
                    BROWSE COLLECTION (<?php echo  $term->count; ?>)
                </span>
            </div>
        </a>

    </div>

    <?php  }

    echo '</div>';
    $output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('categories_post', 'categories_post_func');



add_action('storefront_before_content','heade_single_post',10 );

function heade_single_post(){
	if(is_singular('post')){
		echo '<div class="post-header-banner"></div>';
	}
}

add_action('storefront_before_content','content_for_category_post',10 );


function content_for_category_post(){
	if(is_category()){
		$pterm = get_queried_object();
		$bg = get_field('banner_image',$pterm); ?>
            <div class="banner-cat" style="background-image: url('<?php echo $bg;  ?>');">
                <h1><?php echo $pterm->name; ?></h1>
            </div>
        <?php 
        $partners_obj = get_terms( 'category', array('hide_empty' => false) );
        echo'<div class="list-term-post owl-carousel owl-theme slider-in-cat" style="margin: 30px auto !important;">';
        foreach ($partners_obj as $term) {  ?>
            <div class="cat-item item" style="max-width: 166px !important;">
                <a href="<?php echo get_term_link( $term->slug, 'category' );?>" class="cat-item-link">
                    <div class="cat-item-in">
                        <?php
                                    $image = get_field('icon', $term);
                                    $color = get_field('background', $term);
                                ?>
                        <div class="cat-item-icon" style="background-color: <?php echo $color; ?> ">
                            <img src="<?php echo $image; ?>" alt="">
                        </div>
                        <h3 class="cat-item-title">
                            <?php echo $term->name; ?>
                        </h3>
                        <span class="cat-item-count">
                            BROWSE COLLECTION (<?php echo  $term->count; ?>)
                        </span>
                    </div>
                </a>

            </div>
        <?php  }
	    echo '</div>';
        echo'<div class="list-term-post-mobile" style="display:none;"> '; ?>
        <div class="d-default-cat cat-item-title">
            <?php
            $image = get_field('icon', $pterm);
            $color = get_field('background', $pterm); ?>
            <h3>
                <span class="cat-item-icon" style="background-color: <?php echo $color; ?> ">
                    <img src="<?php echo $image; ?>" alt="">
                </span><?php echo $pterm->name; ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="20.762" height="12.827" viewBox="0 0 20.762 12.827">
                    <path id="Op_component_1" data-name="Op component 1"
                        d="M4752.869,3947.608l9.5-9.228-9.5-9.228,2.169-1.153,10.657,10.381-10.657,10.381Z"
                        transform="translate(3948.762 -4752.869) rotate(90)" fill="#0aa8aa" />
                </svg>

            </h3>
        </div>
        <div class="d-option">

        <?php foreach ($partners_obj as $dterm) {
                $class= '';
                if($dterm->term_id == $pterm->term_id ){
                    $class= 'current';
                } ?>

            <div class="cat-item item">
                <a href="<?php echo get_term_link( $dterm->slug, 'category' );?>"
                    class="cat-item-link <?php echo $class; ?>">

                    <?php
                    $image = get_field('icon', $dterm);
                    $color = get_field('background', $dterm);
                    ?>

                    <h3 class="cat-item-title">
                        <span class="cat-item-icon" style="background-color: <?php echo $color; ?> ">
                            <img src="<?php echo $image; ?>" alt="">
                        </span>
                        <?php echo $dterm->name; ?>
                        <?php if($class == 'current'): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.762" height="12.827" viewBox="0 0 20.762 12.827">
                            <path id="Op_component_1" data-name="Op component 1"
                                d="M0,1.154l9.5,9.228L0,19.609l2.169,1.153L12.827,10.381,2.169,0Z"
                                transform="translate(0 12.827) rotate(-90)" fill="#0aa8aa" />
                        </svg>
                        <?php endif; ?>
                    </h3>
                </a>
            </div>
        <?php  }
      echo '</div></div>';
	}
}

function storefront_post_taxonomy(){
	return false;
}

function add_custom_body_class($classes){
   if(is_category()){
     $option = get_field('layout','option');

     switch ($option) {
     	case 'fullwidth':
     		$classes[] = 'full_widthcss';
     		break;

     	default:
     		$classes[] = 'right_sidebarcss';
     		break;
     }
   }
   return $classes;
}

function post_loop_in_cat(){
	?>
        <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('thumb-post-size'); ?></a>
        <a href="<?php echo the_permalink(); ?>">
            <h3><?php echo get_the_title(); ?></h3>
        </a>
        <p><?php echo excerpt(30); ?></p>
        <?php
}

function custom_excerpt_length( $length ) {
	return 10;
}
//add_filter( 'excerpt_length', 'custom_excerpt_length', 10,2);


function storefront_paging_nav() {
	global $wp_query;

	$args = array(
		'type'      => 'list',
		'mid_size' => 1,
		'next_text' => _x( '<i class="fas fa-chevron-right"></i>', 'Next post', 'storefront' ),
		'prev_text' => _x( '<i class="fas fa-chevron-left"></i>', 'Previous post', 'storefront' ),
	);

	the_posts_pagination( $args );
}


function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'BLog Sidebar',
		'id'            => 'blog_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


add_filter( 'widget_text', 'do_shortcode' );


function st_popular_posts_shortcode( $atts, $content ) {
		$pop_posts = get_transient( 'st_popular_posts' );
		if( false === $pop_posts ) {
			$args = apply_filters( 'showcase_filter_popular_posts', array(
				'orderby'					=> 'comment_count',
				'posts_per_page'	=> 5,
			) );
			$pop_posts = new WP_Query( $args );
			set_transient( 'st_popular_posts', $pop_posts, WEEK_IN_SECONDS );
		}
		$current_post_id = get_the_ID();
		ob_start(); ?>
        <div class="showcase-popular-posts">
            <div class="row">
                <?php if( $pop_posts->have_posts() ) {
					$count = 1;
					while ( $pop_posts->have_posts() ) : $pop_posts->the_post();
						global $post;
						if( get_the_ID() != $current_post_id ) {
							$class = array( 'blog-article', 'featured-article', 'col', 'col-xsmall-full', 'article-' . $count );
							$class[] = 'col-large-one-third';?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
                    <div class="article-inner-wrapper">
                        <div class="featured-image">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                                <?php the_post_thumbnail('thumb-post-sidebar'); ?>
                            </a>
                        </div>
                        <div class="entry-wrapper">
                            <div class="entry-header">
                                <?php
											the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                            </div><!-- .entry-header -->
                            <footer class="entry-footer">
                                <span><?php echo get_the_date('M d, Y'); ?></span>
                            </footer><!-- .entry-footer -->
                        </div><!-- .entry-wrapper -->
                    </div><!-- .article-inner-wrapper -->
                </article><!-- #post-## -->
                <?php $count++;
						}
					endwhile;
				} ?>
            </div><!-- .row -->
        </div><!-- .showcase-popular-posts -->
        <?php $return = ob_get_clean();
		wp_reset_query();
		return $return;
	}
add_shortcode( 'popular-posts', 'st_popular_posts_shortcode' );


function st_popular_category_shortcode( $atts, $content ) {
		$partners_obj = get_terms( 'category', array('hide_empty' => false,'number' => 4) );
		ob_start(); ?>
        <div class="showcase-popular-category">
            <?php foreach ($partners_obj as $term) {  ?>
            <div class="cat-item">
                <a href="<?php echo get_term_link( $term->slug, 'category' );?>" class="cat-item-link">
                    <div class="showcase-cat-item-in">
                        <?php
			 			$image = get_field('thumbnail', $term);

					?>

                        <div class="thumb-nail">
                            <span><img src="<?php echo $image; ?>" alt=""></span>
                        </div>

                        <h3 class="cat-item-title">
                            <?php echo $term->name; ?>
                            <span class="cat-item-count">
                                BROWSE COLLECTION (<?php echo  $term->count; ?>)
                            </span>
                        </h3>

                    </div>
                </a>

            </div>
            <?php } ?>
            <div class="btn-row" style="text-align: center;">
                <a href="<?php echo home_url('/blog/') ?>" class="btn">ALL COLLECTIONS</a>
            </div>

        </div><!-- .showcase-popular-posts -->
        <?php $return = ob_get_clean();
		wp_reset_query();
		return $return;
	}
add_shortcode( 'popular-category', 'st_popular_category_shortcode' );

function kc_widget_form_extend( $instance, $widget ) {
  if ( !isset($instance['classes']) )
		$instance['classes'] = null;
        $row = "<p>";
		$row .= "Class:\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/>\n";
		$row .= "</p>\n";

		echo $row;
	return $instance;
}
add_filter('widget_form_callback', 'kc_widget_form_extend', 10, 2);function kc_widget_update( $instance, $new_instance ) {
	$instance['classes'] = $new_instance['classes'];
return $instance;
}
add_filter( 'widget_update_callback', 'kc_widget_update', 10, 2 );
function kc_dynamic_sidebar_params( $params ) {
	global $wp_registered_widgets;
	$widget_id    = $params[0]['widget_id'];
	$widget_obj    = $wp_registered_widgets[$widget_id];
	$widget_opt    = get_option($widget_obj['callback'][0]->option_name);
	$widget_num    = $widget_obj['params'][0]['number'];

	if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
	return $params;
}
add_filter( 'dynamic_sidebar_params', 'kc_dynamic_sidebar_params' );



function my_limit_posts_per_cat_page( $query ){
    if( $query->is_main_query() && is_category() ){
    	$term = get_queried_object();

		$data = get_field('layout',$term);
		//var_dump($data);
		if( $data == 'righsider'){
 			$query->set( 'posts_per_page', 4);
		}else{
			 $query->set( 'posts_per_page', 12);
		}

    		return $query;

        // the rest of your code using $cat_id goes here...
    }
}
add_action( 'pre_get_posts', 'my_limit_posts_per_cat_page' );



function storefront_comment( $comment, $args, $depth ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
        <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
            id="comment-<?php comment_ID(); ?>">
            <div class="comment-body">
                <div class="comment-meta commentmetadata">
                    <div class="comment-author vcard">
                        <?php echo get_avatar( $comment, 128 ); ?>

                    </div>
                    <?php if ( '0' === $comment->comment_approved ) : ?>
                    <em
                        class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'storefront' ); ?></em>
                    <br />
                    <?php endif; ?>
                    <div class="comment-metabox">
                        <?php printf( wp_kses_post( '<cite class="fn">%s</cite>', 'storefront' ), get_comment_author_link() ); ?>
                        <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>"
                            class="comment-date">
                            <?php echo ' - <time datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>
                        </a>
                    </div>


                </div>
                <?php if ( 'div' !== $args['style'] ) : ?>
                <div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
                    <?php endif; ?>
                    <div class="comment-text">
                        <?php comment_text(); ?>
                    </div>
                    <div class="reply">
                        <?php
		comment_reply_link(
			array_merge(
				$args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
                        <?php edit_comment_link( __( 'Edit', 'storefront' ), '  ', '' ); ?>
                    </div>
                </div>
                <?php if ( 'div' !== $args['style'] ) : ?>
            </div>
            <?php endif; ?>
            <?php
	}


add_filter('comment_form_default_fields','comment_form_cs', 10 , 2 );

function comment_form_cs($fields){
	//var_dump($fields);
	unset($fields['url']);
	return $fields;
}



function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	$cookies = $fields['cookies'];
	unset( $fields['comment'] );
	unset( $fields['cookies'] );

	$fields['comment'] = $comment_field;
	$fields['cookies'] = $cookies;
	return $fields;
}

 //add_filter( 'gettext', 'theme_change_comment_field_names', 20, 3 );
/**
 * Change comment form default field names.
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function theme_change_comment_field_names( $translated_text, $text, $domain ) {

    //if ( is_singular() ) {

        switch ( $translated_text ) {

            case 'Leave a Reply ' :

                $translated_text = __( 'Leave your comment', 'theme_text_domain' );
                break;

        }

    //}

    return $translated_text;
}



add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

function my_update_comment_field( $comment_field ) {

  $comment_field =
    '<p class="comment-form-comment">
            <label for="comment"></label>
            <textarea required id="comment" name="comment" placeholder="' . esc_attr__( "Your comment", "text-domain" ) . '" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

  return $comment_field;
}
add_filter( 'comment_form_field_comment', 'my_update_comment_field' );




function my_update_comment_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$label     = $req ? '*' : ' ' . __( '(optional)', 'text-domain' );
	$aria_req  = $req ? "aria-required='true'" : '';

	$fields['author'] =
		'<p class="comment-form-author">
			<label for="author"><i class="fas fa-user"></i></label>
			<input id="author" name="author" type="text" placeholder="' . esc_attr__( "Name", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30" ' . $aria_req . ' />
		</p>';

	$fields['email'] =
		'<p class="comment-form-email">
			<label for="author"><i class="fa fa-envelope" aria-hidden="true"></i></label>
			<input id="email" name="email" type="email" placeholder="' . esc_attr__( "Email", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
		'" size="30" ' . $aria_req . ' />
		</p>';


	//var_dump($fields);
	return $fields;
}
add_filter( 'comment_form_default_fields', 'my_update_comment_fields' );



add_action('storefront_bottom_post','relate_post', 20);

function relate_post(){
	//for use in the loop, list 5 post titles related to first tag on current post
global $post;
//var_dump($post);
$tags = wp_get_post_categories($post->ID);
//var_dump($tags);
if ($tags) {
	echo '<div class="related-post-css">';
		echo '<h3>YOU MIGHT ALSO LIKE</h3>';
		echo '<div class="related-post-in col-full">';
			//$first_tag = $tags[0]->term_id;
				$args=array(
				'category__in' =>$tags,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> -1,
				'caller_get_posts'=>1
				);
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post(); ?>

            <div class="post-related-col-4 item">
                <div class="inner-item">

                    <?php echo get_the_tag_list('<p class="tag-css">',' ','</p>');?>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                        title="Permanent Link to <?php the_title_attribute(); ?>">


                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">


                    </a>
                    <a class="title" href="<?php the_permalink() ?>" rel="bookmark"
                        title="Permanent Link to <?php the_title_attribute(); ?>">


                        <?php the_title(); ?>


                    </a>
                    <p><?php echo excerpt(20); ?></p>
                </div>

            </div>


            <?php
			endwhile;
		echo '</div>';
	echo '</div>';

		}
	wp_reset_query();
	}
}


/*just show flat rate shipping method when only paper patterns are in the cart*/
// function only_show_flat_rate_shipping_with_patterns( $rates )	{

// 	$remove_shipping = false;
// 	$d_type = array();
//   $count = 0;
//     // Loop through cart items to find out if any hasn't the targetted shipping class
//     foreach( WC()->cart->cart_contents as $key => $values ) {

//     	$_product = $values[ 'data' ];
//     	 $count++;
// 		 	array_push($d_type,$_product->get_type());
//        if($_product->get_id() == 12326 && isset($values['price'])){
//          $remove_shipping = true;
//         //var_dump($remove_shipping);
//        }


//     }

//    // var_dump($d_type);
//     if (in_array("simple", $d_type) || in_array("pw-gift-card",$d_type) || in_array("grouped", $d_type) || in_array("variation", $d_type)) {
// 		    //continue;
//     //  unset( $rates['flat_rate:4']);
//       if ( isset( $rates['flat_rate:6'] ) && $remove_shipping = false && $count == 2 ) {
//             unset( $rates['flat_rate:6']);

//          }
//     	return $rates;

// 	}else{

// 		     if ( isset( $rates['flat_rate:3'] ) ) {
//             unset( $rates['flat_rate:3']);

//          }

//          if ( isset( $rates['flat_rate:2'] ) ) {
//             unset( $rates['flat_rate:2']);

//          }
//        //  $rates['flat_rate:2']->label = __( 'SUBSCRIPTION shipping', 'woocommerce' );
//         //$rates['flat_rate:5']->cost = 12;
//          return $rates;
// 	}


// 	return $rates;


// }
// add_filter( 'woocommerce_package_rates','only_show_flat_rate_shipping_with_patterns', 10, 2 );



// function wc_ninja_change_flat_rates_cost( $rates ) {

//    $numner= 0;
//    $d_sub_n = 0;
//    $ex_product = 0;
//     // Loop through cart items to find out if any hasn't the targetted shipping class
//     foreach( WC()->cart->get_cart() as $cart_item  ) {

//        $_product = $cart_item[ 'data' ];

//        $type = $_product->get_type();
//     //   var_dump($type);
//        if($type == 'simple' || $type == 'variable'){
//           $numner += $cart_item['quantity'];
//          // var_dump($numner);
//        }
//        if($type == 'subscription' || $type == 'variable-subscription'){
//           $d_sub_n += $cart_item['quantity'];
//          // var_dump($numner);
//        }
//         //new
//        if($_product->get_id() == 12326 && isset($cart_item['price'])){

//           $ex_product += $cart_item['quantity'];
//        }
//     }

//    // $numner = count($d_type);
//      // var_dump($d_sub_n);
//     $numner = $numner - $ex_product;
//    $d_rate =  ceil($numner / 3);
//     // var_dump($d_rate);

//      if($d_rate > 1){
//         if ( isset( $rates['flat_rate:3'] ) ) {
//     // Check if there are more than 10 products in the cart
//           $rates['flat_rate:3']->cost = $d_rate *  $rates['flat_rate:3']->cost;
//         }

//         if ( isset( $rates['flat_rate:2'] ) ) {
//       // Check if there are more than 10 products in the cart
//           $rates['flat_rate:2']->cost =  $d_rate *  $rates['flat_rate:2']->cost;
//         }
//          if ( isset( $rates['flat_rate:5'] ) ) {
//       // Check if there are more than 10 products in the cart
//           $rates['flat_rate:5']->cost =  $d_rate *  $rates['flat_rate:5']->cost;
//         }
//      }
//      if(isset( $rates['flat_rate:4'] )){
//       $rates['flat_rate:4']->cost =  $d_sub_n * 6.99 ;
//      }


//       if ( isset( $rates['flat_rate:6'] ) ) {
//     // Check if there are more than 10 products in the cart
//         $rates['flat_rate:6']->cost =  $d_sub_n * 15.99;
//      }


//   // }


//     // return $rates;
//    /// }

//  // var_dump($rates);
//   return $rates;
// }

// add_filter( 'woocommerce_package_rates', 'wc_ninja_change_flat_rates_cost', 100, 1 );


// define the woocommerce_shipping_chosen_method callback
function filter_woocommerce_shipping_chosen_method( $this_get_default_method_package_rates_false, $package_rates, $chosen_method ) {
    // make filter magic happen here...
   if ( empty( WC()->cart->recurring_cart_key ) ) {
        $this_get_default_method_package_rates_false = 'flat_rate:3';
    } else {
        $this_get_default_method_package_rates_false = 'flat_rate:4';
   }

    return $this_get_default_method_package_rates_false;
}
//add_filter( 'woocommerce_shipping_chosen_method', 'filter_woocommerce_shipping_chosen_method', 10, 3 );




// function only_show_flat_rate_shipping_with_patterns_cs( $rates )  {
//   //unset( $rates['flat_rate:3']);

//       $recurring_carts = WC()->cart->recurring_carts ;
//       if( $recurring_carts) {
//        //  unset( $rates['flat_rate:3']);
//         // unset( $rates['flat_rate:2']);
//         if($rates['flat_rate:3']){
//            unset( $rates['flat_rate:3']);
//         }

//         if($rates['flat_rate:2']){
//            unset( $rates['flat_rate:2']);
//         }


//         // $rates['flat_rate:3']->cost = 6.99;
//       }
//   return $rates;


// }

// add_filter( 'woocommerce_package_rates','only_show_flat_rate_shipping_with_patterns_cs', 10, 2 );





add_filter('wp_get_attachment_image_attributes', 'change_attachement_image_attributes', 20, 2);

function change_attachement_image_attributes( $attr, $attachment ){
    // Get post parent
    $parent = get_post_field( 'post_parent', $attachment);

    // Get post type to check if it's product
    $type = get_post_field( 'post_type', $parent);
    if( $type != 'product'  || $attr['class'] == 'custom-logo'){
        return $attr;
    }

    /// Get title
    $title = get_post_field( 'post_title', $parent);

    $attr['alt'] = $title;
    $attr['title'] = $title;

    return $attr;
}

add_filter( 'woocommerce_structured_data_product', 'd_structured_data_poduct', 10 ,2 );

function d_structured_data_poduct($markup, $product){
	//var_dump($markup);
	$gtin = get_post_meta( $product->get_id(), '_gtin', true );
    $markup['brand'] = 'Baketivity'; // Set sku to product id.
   //  $markup['isbn'] = '3ewrew';
   //   $markup['mpn'] = '3ewrew';
     $markup['gtin8'] = $gtin;
    return $markup;

}


function woocommerce_render_gtin_field() {
   $input   = array(
      'id'          => '_gtin',
      'label'       => sprintf(
         '<abbr title="%1$s">%2$s</abbr>',
         _x( 'Global Trade Identification Number', 'field label', 'my-theme' ),
         _x( 'GTIN', 'abbreviated field label', 'my-theme' )
      ),
      'value'       => get_post_meta( get_the_ID(), '_gtin', true ),
      'desc_tip'    => true,
      'description' => __( 'Enter the Global Trade Identification Number (UPC, EAN, ISBN, etc.)', 'my-theme' ),
   );
?>

            <div id="gtin_attr" class="options_group">
                <?php woocommerce_wp_text_input( $input ); ?>
            </div>

            <?php
}

add_action( 'woocommerce_product_options_inventory_product_data', 'woocommerce_render_gtin_field' );

/**
 * Save the product's GTIN number, if provided.
 *
 * @param int $product_id The ID of the product being saved.
 */
function woocommerce_save_gtin_field( $product_id ) {
   if (
      ! isset( $_POST['_gtin'], $_POST['woocommerce_meta_nonce'] )
      || ( defined( 'DOING_AJAX' ) && DOING_AJAX )
      || ! current_user_can( 'edit_products' )
      || ! wp_verify_nonce( $_POST['woocommerce_meta_nonce'], 'woocommerce_save_data' )
   ) {
      return;
   }

   $gtin = sanitize_text_field( $_POST['_gtin'] );

   update_post_meta( $product_id, '_gtin', $gtin );
}

add_action( 'woocommerce_process_product_meta','woocommerce_save_gtin_field' );



function my_custom_add_to_cart_redirect( $url ) {

	if ( ! isset( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
		return $url;
	}

	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );

	$_product = wc_get_product( $product_id );


	// Only redirect the product IDs in the array to the checkout
   $type = $_product->get_type();

	if (  $type == 'subscription' || $type == 'variable-subscription' ) {
		$url = WC()->cart->get_cart_url();
	}
	//var_dump($url);
	return $url;

}
//add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect', 100 , 1);




//add_action('woocommerce_after_cart_table','d_gift_loop_shortcode', 20);
/**
 * Replaced 12/07/2022 and improved in customize-cart.php
 * TASK: https://app.asana.com/0/1201630727858245/1201865329357893
 */
function d_gift_loop_shortcode() {

    $args = array(
		'post_type'   => 'product',
		'meta_key'    => 'personalized_card',
		'meta_value'  => true,
		'posts_per_page' => 3,
		'orderby' => 'rand'
    );

     $the_query = new WP_Query( $args );

     if( $the_query->have_posts() ) {
		echo '<div class="d-term-pro">';
		echo '<h4 class="related-title-new-design">Yum! make it even sweeter!</h4>';
		echo '<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents gfgt" cellspacing="0">';
		while( $the_query->have_posts() ) : $the_query->the_post();
			$product = $the_query->post;
			set_query_var( 'product', $product );
			get_template_part('woocommerce/cart/cart-related-product');
		endwhile;
		echo '</table>';
		echo '</div>';
    }
    wp_reset_query();
}
//add_shortcode('d_gift', 'd_gift_loop_shortcode');

// define the woocommerce_loop_add_to_cart_args callback
function filter_woocommerce_loop_add_to_cart_args( $wp_parse_args, $product ) {
    // make filter magic happen here...

    //var_dump($wp_parse_args['attributes']);
    $wp_parse_args['attributes']['product_name'] =  $product->get_name();
    $wp_parse_args['attributes']['product_price'] =  $product->get_price();
    $wp_parse_args['attributes']['product_type'] =  $product->get_type();

    return $wp_parse_args;
};

// add the filter
add_filter( 'woocommerce_loop_add_to_cart_args', 'filter_woocommerce_loop_add_to_cart_args', 10, 2 );




add_action('d_listen_add_to_cart_event','d_add_to_cart_event_fb');


function d_add_to_cart_event_fb(){

  ?>
            <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.sub-product-list a.button.product_type_subscription.add_to_cart_button').click(
                    function() {

                        var id = jQuery(this).data('product_id');
                        var name = jQuery(this).attr('product_name');
                        //var sku = jQuery(this).data('product_sku');
                        var price = jQuery(this).attr('product_price');
                        var type = jQuery(this).attr('product_type');
                        // console.log("'"+id+"'");

                        fbq('track', 'AddToCart', {
                            content_name: name,
                            content_ids: ["'" + id + "'"],
                            content_type: type,
                            value: price,
                            currency: 'USD'
                        });
                        // console.log('fbq fire');
                    })
            })
            </script>
            <?php
}

add_action( 'comment_post', 'baketivity_notify_my_mail', 15, 3 );
function baketivity_notify_my_mail( $comment_id, $comment_approved, $commentdata ) {
    if ( $commentdata['comment_type'] == 'review' ){
        $comment = get_comment( $comment_id );
        // $adminEmail = get_option( 'admin_email' );
        $adminEmail = 'meny@baketivity.com';
        $subject = sprintf( 'New Comment by: %s', $comment->comment_author );
        $message = sprintf( 'Hi admin, <br/>New comment added on %s <br/>Comment content : %s', get_the_title( $comment->comment_post_ID ), $comment->comment_content );
        wp_mail( $adminEmail, $subject, $message );
    }
}
require 'inc/vote_function.php';
require 'inc/shipping_functions.php';
require 'inc/payment_functions.php';
require 'inc/product_designer_functions.php';
require 'inc/checkout_functions.php';
require 'inc/invitation_functions.php';
require 'inc/restart_workflow.php';
require 'inc/errors/class-log-events.php';
//require 'inc/checkout-address-auto.php';

/////////////////////////////////////////////////////////////////////
add_action( 'woocommerce_thankyou', 'log_url', 40 );

function log_url( $order_id ){
    //write($_SERVER['REQUEST_URI'].' - ' . get_post_meta( $order_id, '_ga_tracked', true ));
}

function write($message){
    file_put_contents(
        get_theme_file_path() . '/checkout-log.log',
        date('d-M-Y H:i:s') . ' - ' . $message .PHP_EOL,
        FILE_APPEND
    );
}

function dumper($data, $die = false){
    if(in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '109.86.229.110', '134.249.136.215', '192.168.10.1'])){
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        if($die) die('---');
    }
}
/////////////////////////////////////////////////////////////////////


function createRecipeFromZapier($prepared_post) {
    $postData = array(
        'post_title' => $prepared_post->post_title,
        'post_status' => 'publish',
        'post_type' => 'recipe'
    );

    $postId = wp_insert_post($postData);

    if (!empty($prepared_post->post_excerpt)) {
        $postMetaKeys = [
            'email_address',
            'phone',
            'town__city',
            'state',
            'street_address',
            'zip',
            'country',
            'child_first_name',
            'child_last_name',
            'parentlegal_guardian_first_name',
            'parentlegal_last_name',
            'are_you_a_baketivity_subscriber',
            'child_birthday',
            'how_did_you_hear_about_this',
            'video_'
        ];

        $postMeta = explode(' || ', $prepared_post->post_excerpt);

        if (!empty($postMeta)) {
            foreach ($postMeta as $postMetaKey => $postMetaValue) {
                if ($postMetaKey != 15) {
                    if (!empty($postMetaKeys[$postMetaKey])) {
                        update_post_meta($postId, $postMetaKeys[$postMetaKey], trim($postMetaValue));
                    }
                } else {
                    $entryId = (int) $postMetaValue;

                    if (!empty($entryId)) {
                        $entry = RGFormsModel::get_lead($entryId);

                        if (!empty($entry) && !empty($entry[35])) {
                            $postData = [
                                'ID' => $postId,
                                'post_content' => $entry[35],
                            ];

                            wp_update_post($postData);
                        }
                    }

                    //file_put_contents('zapier.txt', print_r([], true) . PHP_EOL, FILE_APPEND);
                }
            }
        }
    }
}

add_filter('rest_pre_insert_post', 'rest_pre_insert_post_handler', 10, 2);

function rest_pre_insert_post_handler($prepared_post, $request) {
    if (!empty($prepared_post) && !empty($prepared_post->post_author) && $prepared_post->post_author == 2850) {
        createRecipeFromZapier($prepared_post);
    }

    return $prepared_post;
}

function woocommerce_after_add_to_cart_form_add_button_invite(  ) {
    global $product;
    if(in_array($product->get_id(), array(198943))){
        echo '<a href="/choose-your-template/"><button class="invite ubtn-normal">Send Invite</button></a>';
        echo '<style>button.invite {font-weight: normal;
            border-radius: 20px;
            border-width: 3px;
            border-color: #ee324d;
            border-style: solid;
            background: #ee324d;
            color: #ffffff;
            font-family: "smoothy";
            text-transform: uppercase;
            margin-top: 10px;
            width: 186px;
            font-size:24px;}
            button.invite:hover{
            background: #fff;
            color: #ee324d;
            }
            @media all and (max-width: 460px){
                button.invite{ width: 250px;}
            }

            </style>';
    }
};

add_action( 'woocommerce_after_add_to_cart_form', 'woocommerce_after_add_to_cart_form_add_button_invite', 10, 0 );

////// fixed shipping in subscription
add_action('woocommerce_checkout_create_subscription', 'filter_subscriber_shipping_payment');
function filter_subscriber_shipping_payment( $subscription ){
    $subscription_id = $subscription->id;
    fixed_shipping_subscription_from_order( $subscription_id );
}

add_action( 'wcs_webhook_subscription_updated', 'wcs_webhook_subscription_updated_callback');
function wcs_webhook_subscription_updated_callback( $subscription_id ){
    fixed_shipping_subscription_from_order( $subscription_id );
}

function fixed_shipping_subscription_from_order( $subscription_id ){
    $order = wc_get_order($subscription_id);
    $order_parent = wc_get_order($subscription_id);
    if(!$order || !$order_parent) return false;

    // backup
    if($order->get_shipping_address_1()) {
        update_post_meta($subscription_id, 'backup_shipping_address_1', $order->get_shipping_address_1());
		update_post_meta($subscription_id, '_shipping_address_1', $order->get_shipping_address_1());
    }
    if($order->get_shipping_address_2()) {
        update_post_meta($subscription_id, 'backup_shipping_address_2', $order->get_shipping_address_2());
		update_post_meta($subscription_id, '_shipping_address_2', $order->get_shipping_address_2());
    }
    if($order->get_shipping_city()) {
        update_post_meta($subscription_id, 'backup_shipping_city', $order->get_shipping_city());
		update_post_meta($subscription_id, '_shipping_city', $order->get_shipping_city());
    }
    if($order->get_shipping_state()) {
        update_post_meta($subscription_id, 'backup_shipping_state', $order->get_shipping_state());
		update_post_meta($subscription_id, '_shipping_state', $order->get_shipping_state());
    }
    if($order->get_shipping_postcode()) {
        update_post_meta($subscription_id, 'backup_shipping_postcode', $order->get_shipping_postcode());
		update_post_meta($subscription_id, '_shipping_postcode', $order->get_shipping_postcode());
    }
    if($order->get_shipping_country()) {
        update_post_meta($subscription_id, 'backup_shipping_country', $order->get_shipping_country());
		update_post_meta($subscription_id, '_shipping_country', $order->get_shipping_country());
    }
    if($order->get_shipping_first_name()) {
        update_post_meta($subscription_id, 'backup_shipping_first_name', $order->get_shipping_first_name());
		update_post_meta($subscription_id, '_shipping_first_name', $order->get_shipping_first_name());
    }
    if($order->get_shipping_last_name()) {
        update_post_meta($subscription_id, 'backup_shipping_last_name', $order->get_shipping_last_name());
		update_post_meta($subscription_id, '_shipping_last_name', $order->get_shipping_last_name());
    }

    // if empty subscription => get parent order value || if empty parent order value  => get backup
	/*
	if(!$order->get_shipping_address_1()){
	    if($order_parent->get_shipping_address_1()){
	        $order->set_shipping_address_1($order_parent->get_shipping_address_1());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_address_1', true)){
	        $order->set_shipping_address_1(get_post_meta($subscription_id, 'backup_shipping_address_1', true));
	    }
	}

	if(!$order->get_shipping_address_2()){
	    if($order_parent->get_shipping_address_2()){
	        $order->set_shipping_address_2($order_parent->get_shipping_address_2());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_address_2', true)){
	        $order->set_shipping_address_2(get_post_meta($subscription_id, 'backup_shipping_address_2', true));
	    }
	}

	if(!$order->get_shipping_city()){
	    if($order_parent->get_shipping_city()){
	        $order->set_shipping_city($order_parent->get_shipping_city());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_city', true)){
	        $order->set_shipping_city(get_post_meta($subscription_id, 'backup_shipping_city', true));
	    }
	}

	if(!$order->get_shipping_state()){
	    if($order_parent->get_shipping_state()){
	        $order->set_shipping_state($order_parent->get_shipping_state());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_state', true)){
	        $order->set_shipping_state(get_post_meta($subscription_id, 'backup_shipping_state', true));
	    }
	}

	if(!$order->get_shipping_postcode()){
	    if($order_parent->get_shipping_postcode()){
	        $order->set_shipping_postcode($order_parent->get_shipping_postcode());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_postcode', true)){
	        $order->set_shipping_postcode(get_post_meta($subscription_id, 'backup_shipping_postcode', true));
	    }
	}

	if(!$order->get_shipping_country()){
	    if($order_parent->get_shipping_country()){
	        $order->set_shipping_country($order_parent->get_shipping_country());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_country', true)){
	        $order->set_shipping_country(get_post_meta($subscription_id, 'backup_shipping_country', true));
	    }
	}

	if(!$order->get_shipping_first_name()){
	    if($order_parent->get_shipping_first_name()){
	        $order->set_shipping_first_name($order_parent->get_shipping_first_name());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_first_name', true)){
	        $order->set_shipping_first_name(get_post_meta($subscription_id, 'backup_shipping_first_name', true));
	    }
	}

	if(!$order->get_shipping_last_name()){
	    if($order_parent->get_shipping_last_name()){
	        $order->set_shipping_last_name($order_parent->get_shipping_last_name());
	    } else if(get_post_meta($subscription_id, 'backup_shipping_last_name', true)){
	        $order->set_shipping_last_name(get_post_meta($subscription_id, 'backup_shipping_last_name', true));
	    }
	}*/
}
////// fixed shipping in subscription


///// zeroing the coupon if a gift card is used
function pw_gift_card_prevent_coupons( $is_valid, $coupon ) {
    $gift_cards_applied = false;


    if ( defined( 'PWGC_SESSION_KEY' ) ) {
        $session_data = (array) WC()->session->get( PWGC_SESSION_KEY );
        if ( isset( $session_data['gift_cards'] ) && count( $session_data['gift_cards'] ) > 0 ) {
            $gift_cards_applied = true;
        }
    }

    if ( $gift_cards_applied ) {
        // Do not allow any coupon if there is a gift card applied.
        $is_valid = false;
    }

    return $is_valid;
}
add_filter( 'woocommerce_coupon_is_valid_for_cart', 'pw_gift_card_prevent_coupons', 99999, 2 );
add_filter( 'woocommerce_coupon_is_valid_for_product', 'pw_gift_card_prevent_coupons', 99999, 2 );
///// zeroing the coupon if a gift card is used

add_filter('fixed_shipping_total_received', 'fixed_shipping_total_received');
function fixed_shipping_total_received( $value ){
    if($value == 'Shipping') $value = 'Free Shipping';
    return $value;
}

////// rename Fee in subscription => Split order
add_filter('gettext', 'fixed_fees_translate', 20, 3);
function fixed_fees_translate( $translated_text, $text, $domain ) {
global $pagenow, $typenow;

    $current_text = "Fees:";
    $new_text     = "Split Order:";

    if( is_admin() && in_array($pagenow, ['post.php', 'post-new.php']) && 'shop_order' == $typenow && $current_text == $text ){
        if(isset($_GET['post']) && !empty($_GET['post'])){
            $post_id = intval($_GET['post']);
            $_save_base_shipping_total = get_post_meta($post_id, '_save_base_shipping_total', true);
            $_save_base_recurring_shipping_total = get_post_meta($post_id, '_save_base_recurring_shipping_total', true);
            if($_save_base_shipping_total !== false && $_save_base_recurring_shipping_total!==false){
                $translated_text =  __( $new_text, $domain );
            }
        }
    }
    return $translated_text;
}
////// end rename Fee in subscription => Split order



/*------------------------------------*\
        New Checkout Functions
\*------------------------------------*/
require_once( __DIR__ . '/inc/customize-checkout.php');
require_once( __DIR__ . '/inc/customize-cart.php');

function get_woocommerce_order_splitter_for_subscription_and_simple_products (){
    if (  class_exists( 'WooCommerceOrderSplitterForSubscriptionAndSimple' ) ){
        return WooCommerceOrderSplitterForSubscriptionAndSimple::get_woocommerce_order_splitter_for_subscription_and_simple_products();
    }
    return false;
}


//// get ACF image url by any get field result
function get_acf_image_url( $get_field_result ){
    if(is_array($get_field_result)){
        return $get_field_result['url'];
    } else if (is_int($get_field_result)){
        $image = wp_get_attachment_image_src($get_field_result, 'full');
        return isset($image[0]) ? $image[0] : false;
    } else {
        return $get_field_result;
    }
}


remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
function replace_link_open() {
	echo "<div class='woocommerce-LoopProduct-link woocommerce-loop-product__link'>";
}
add_action( 'woocommerce_before_shop_loop_item', 'replace_link_open', 10 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10 );
function replace_link_close() {
	echo "</div>";
}
add_action( 'woocommerce_after_shop_loop_item', 'replace_link_close', 10 );


remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
function link_title() {
    global $product;

    $link = apply_filters( 'woocommerce_template_loop_product_title', get_the_permalink(), $product );
    echo '<a href="' . esc_url( $link ) . '"class="link-title"><h4 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h4></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_action( 'woocommerce_shop_loop_item_title', 'link_title', 10, 2 );

add_action('init', function(){
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
});

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    }
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    function woocommerce_get_product_thumbnail( $size = 'thumb-medium' ) {
        global $post, $woocommerce;
        $output = '';

        if ( has_post_thumbnail() ) {
            $output .= get_the_post_thumbnail( $post->ID, $size );
        } else {
             $output .= wc_placeholder_img( $size );
             // Or alternatively setting yours width and height shop_catalog dimensions.
             // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
        }
        //$output .= '</div>';
        return $output;
    }
}

/**
 * Remove Module Notes by Error from JetPack
 * @author Fer Catalano
 */
add_action('admin_init', 'rm34_jetpack_deactivate_modules');
function rm34_jetpack_deactivate_modules() {
    if (class_exists('Jetpack') && Jetpack::is_module_active('notes')) {
        Jetpack::deactivate_module('notes');
    }
}

/**
 * Remove Zoom and fix lightbox - Single Product
 * @author Fer Catalano
 */
add_action( 'wp', 'bbloomer_remove_zoom_lightbox_theme_support', 99 );
function bbloomer_remove_zoom_lightbox_theme_support() { 
    remove_theme_support( 'wc-product-gallery-zoom' );
    //remove_theme_support( 'wc-product-gallery-lightbox' );
    //remove_theme_support( 'wc-product-gallery-slider' );
}

/**
 * Trim text, strip shortcodes and excerpt return 
 * 
 * @param Int $post - Post ID (optional)
 * @param String $text - Text or get_the_conten() (optional)
 * @param Int $words - Number of words to return
 * 
 * @return string - "Ex: This is my text trim and..."
 * 
 * Use: echo custom_trim_excerpt($post_id, '', 20 ); 
 * Use: echo custom_trim_excerpt('', get_the_content(), 20 ); 
 * Use: echo custom_trim_excerpt('', $my_text, 20 ); 
 * Print: "This is my text trim and..."
 */
function custom_trim_excerpt ( $post, $text, $words, $dots ) {

    if ( $post ) { $content = get_the_content('', false, $post); }
    if ( $text ) { $content = $text; }

    $content = excerpt_remove_blocks( $content );
    $content = apply_filters( 'the_content', $content);
    $content = strip_shortcodes( $content );
    $content = str_replace( ']]>',']]&gt;', $content);

    if ($dots) {$dots = '...';}

    if ($words) {
        $content = wp_trim_words( $content, $words, $dots );
    }

    return $content;
}