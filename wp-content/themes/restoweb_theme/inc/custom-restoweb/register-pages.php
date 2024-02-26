<?php
/**
 * Create Home Page
 */
function create_home_page() {
  
    // Setup custom vars
    $author_id = 1;
    $slug = 'inicio';
    $title = 'Inicio';
    $content = '';

    // Check if page exists, if not create it
    if ( null == get_page_by_title( $title ) ) {

        $uploader_page = array(
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_author'           => $author_id,
            'post_name'             => $slug,
            'post_title'            => $title,
            'post_content'          => $content,
            'post_status'           => 'publish',
            'post_type'             => 'page',
            'post_parent'           => false,
            'hierarchical '         => true,
            'page_template'         => 'page-templates/home-template.php'
        );

        $post_id = wp_insert_post( $uploader_page );

        if ( !$post_id ) {
            
            wp_die( 'Error creating template page' );
            
        } else {

			update_post_meta( $post_id, '_wp_page_template', 'page-templates/home-template.php' );
			update_option( 'page_on_front', $post_id );
			update_option( 'show_on_front', 'page' );
        }

    } // end check if

}
add_action( 'init', 'create_home_page' );


/**
 * Create Scan Page
 */
function create_scan_page() {
  
    // Setup custom vars
    $author_id = 1;
    $slug = 'escanear';
    $title = 'Escanear';
    $content = '';

    // Check if page exists, if not create it
    if ( null == get_page_by_title( $title ) ) {

        $uploader_page = array(
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_author'           => $author_id,
            'post_name'             => $slug,
            'post_title'            => $title,
            'post_content'          => $content,
            'post_status'           => 'publish',
            'post_type'             => 'page',
            'post_parent'           => false,
            'hierarchical '         => true,
            'page_template'         => 'page-templates/escanear-template.php'
        );

        $post_id = wp_insert_post( $uploader_page );

    } // end check if

}
add_action( 'init', 'create_scan_page' );

/**
 * Create Menu Page
 */
function create_menu_page() {
  
    // Setup custom vars
    $author_id = 1;
    $slug = 'menu';
    $title = 'Menu';
    $content = '';

    // Check if page exists, if not create it
    if ( null == get_page_by_title( $title ) ) {

        $uploader_page = array(
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_author'           => $author_id,
            'post_name'             => $slug,
            'post_title'            => $title,
            'post_content'          => $content,
            'post_status'           => 'publish',
            'post_type'             => 'page',
            'post_parent'           => false,
            'hierarchical '         => true,
            'page_template'         => 'page-templates/menu-template.php'
        );

        $post_id = wp_insert_post( $uploader_page );

    } // end check if

}
add_action( 'init', 'create_menu_page' );