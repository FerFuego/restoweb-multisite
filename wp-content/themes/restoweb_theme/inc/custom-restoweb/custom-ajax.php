<?php
add_action('wp_ajax_get_products_menu', 'get_products_menu');
add_action( 'wp_ajax_nopriv_get_products_menu', 'get_products_menu' );
function get_products_menu() {

    $args = array(
        'post_type'      => 'product', 
        'product_cat' 	 => $_POST['categ'],
        'posts_per_page' => '-1',
        'paged'          => 'no-paging',
    );
    $loop = new WP_Query( $args );

    ob_start();
    
    if ( $loop->have_posts() ) : 
        while ( $loop->have_posts() ) : $loop->the_post();
            global $product, $woocommerce;
            //echo do_shortcode('[product_page id="'.$loop->post->ID.'"]');
            set_query_var('ID', $loop->post->ID);
            get_template_part('/inc/custom-restoweb/partials/card-prod');
            echo "<script>slider('".$loop->post->ID."')</script>";
        endwhile;
    endif;

    wp_die();
}


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
        
function woocommerce_ajax_add_to_cart() {

    $product_id         = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity           = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id       = absint($_POST['variation_id']);
    $passed_validation  = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status     = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}