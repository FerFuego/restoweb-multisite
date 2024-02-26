<?php
/**
 * Get Table State
 */
function shortcode_restoweb_open_table () {

    global $post;

    ob_start(); 

    if ( isset($_GET['open']) && $_GET['open'] == 'true') : ?>

        <?php if ( get_field('estado') == 'Abierta') : ?>

            <h2>Esta mesa ya a sido ocupada, sino fuiste tu llama al mozo para que cierre la mesa.</h2>

        <?php else :

            $_SESSION['mesa'] = array(
                'ID' => $post->ID,
                'title' => get_the_title()
            );

            update_post_meta( $post->ID, 'estado', 'Abierta' ); ?>
    
            <h2>Mesa abierta correctamente! <a href="<?php echo esc_url( home_url('/menu')); ?>"> -> Hacer pedido</a></h2>

        <?php endif;

    endif; 
    
    return ob_get_clean();
}

add_shortcode('restoweb_open_table','shortcode_restoweb_open_table');


/**
 * GET Best Sell Products
 */
function shortcode_restoweb_best_products() {
    $args = array(
        'post_type' => 'product',
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
        'posts_per_page' => 4,
    );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post(); 
        global $product, $woocommerce; ?>
        <div class="reastoweb-sidebar-products">
            <?php echo (has_post_thumbnail( $loop->post->ID )) ? get_the_post_thumbnail($loop->post->ID, 'thumbnail') : '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />'; ?>
            <div class="reastoweb-sidebar-products-content">
                <h3><?php the_title(); ?></h3>
                <p><?php echo get_woocommerce_currency_symbol(); ?>
                    <?php if ($product->get_sale_price()) { 
                            echo $product->get_sale_price();
                        } else {
                            if ($product->get_regular_price()) { 
                                echo $product->get_regular_price();
                            } else {
                                echo $product->get_price();
                            }
                        } ?>
                </p>
                <form class="cart" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" name="add-to-cart" value="<?php echo $product->get_ID(); ?>" class="single_add_to_cart_button button alt">Agregar al pedido</button>
                </form>
            </div>
        </div>
    <?php endwhile;
    wp_reset_query();
}

add_shortcode('restoweb_best_selling_products','shortcode_restoweb_best_products');