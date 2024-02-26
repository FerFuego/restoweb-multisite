<?php
function getSites($site_query = '', $limit) {

    $pos = 0;
    $back = 999;
    $tmp = explode(' ', trim($site_query));
    $types_1 = []; // Make search combinations per word

    foreach ( $tmp as $param ) {
        $types_1[] = trim($param);
        $types_1[] = ucwords($param);
        $types_1[] = str_replace(' ', '', $param);
    }

    // Complete search combinations
    $types_2 = [ 
        trim($site_query),
        ucwords($site_query), 
        str_replace(' ', '', $site_query),
        trim($site_query), 
        ucwords($site_query),
        str_replace(' ', '', $site_query)
    ];

    $types_3 = [];
    $types_3[] = str_replace(' ', '-', $site_query);
    $types_3[] = str_replace(' ', '-', strtolower($site_query) );
    
    // Union of all combinations
    $types = array_merge( $types_1, $types_2 );
    $types = array_unique( array_merge( $types, $types_3 ), SORT_REGULAR );

    foreach ( $types as $t ) {

        $args = array(
            'search'            => esc_attr($t),
            'search_columns'    => array( 'domain', 'path' ),
            'order'             => 'ASC',
            'orderby'           => 'id',
            'deleted'           => 0,
            'limit'             => $limit
        );
    
        $site_results[] =  wp_get_sites( $args );
    }
    
    $site_query = array_unique( $site_results[0], SORT_REGULAR );
    
    foreach( $site_query as $standort){
        $blog_order = get_blog_option( $standort["blog_id"], 'blog_order', 0);
        $site_query[$pos]['blog_order'] = ( $blog_order == 0 ) ? $back : $blog_order;
        $pos++;
        $back++;        
    }

    // Sort Sites by Custom Order
    function sort_sites_by_order($a, $b){
        return $a['blog_order'] - $b['blog_order']; // ascending 
        // return $b['blog_order'] - $a['blog_order']; // descending
    }

    usort( $site_query, 'sort_sites_by_order');

    ob_start();

    if ( ! empty( $site_query) ) : ?>

        <?php foreach ( $site_query as $site ) : ?>
            <?php switch_to_blog($site["blog_id"]); // switch to each blog to get the posts ?>
                <!-- Card item -->
                <article class="sites-box" id="<?php echo $site["blog_id"]; ?>" data-order="<?php echo $site['blog_order']; ?>">
                    <div class="sites-box-media" style="background-image: url(<?php echo (get_field( 'banner', 'option')) ? get_field( 'banner', 'option')['url'] : IMAGES .'/bg.jpg'; ?>);">
                        <img src="<?php echo (get_field( 'logo', 'option')) ? get_field( 'logo', 'option')['url'] : IMAGES .'/logo-white.png'; ?>" alt="logo">
                    </div>
                    <div class="sites-box-text">
                        <h1 class="mt-3"><a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="sites-box-title"><?php echo (get_field('titulo_principal', 'option')) ? get_field('titulo_principal', 'option') : get_blog_details( $site["blog_id"] )->blogname; ?></a></h1>
                        <p><?php echo (get_field('descripcion_corta', 'option')) ? custom_trim_excerpt(null, get_field('subtitulo_principal', 'option'), 20) : 'Sitio de la red de Restoweb, el portal de de restobares mas grande de Argentina'; ?></p>
                    </div>
                </article>
                <!-- End Card item -->
            <?php restore_current_blog(); ?>
        <?php endforeach; ?>
    
    <?php else : ?>

        <div class="container pt-5 d-flex d-inline-flex justify-content-between text-center">
            <h3>No results found</h3>
            <a href="<?php echo esc_url( home_url( '/' ) ) . 'restaurant-browse' ?>"> <img src="<?php echo CONS_IMAGES_URL; ?>/icons/close-black.svg" alt="close"> </a>
        </div>

    <?php endif; ?>

    <?php return ob_get_clean();
}