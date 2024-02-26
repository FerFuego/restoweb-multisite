<?php

/*------------------------------------*\
            ACF Custom Fields
\*------------------------------------*/

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Personalizar',
        'menu_title'	=> 'Personalizar',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}

if ( function_exists( 'acf_add_options_sub_page' )) {
    
    /* acf_add_options_sub_page(array(
        'page_title' 	=> 'Personalizar',
        'menu_title'	=> 'Personalizar',
        'menu_slug'	=> 'theme-general-settings',
    ));*/

    /* acf_add_options_sub_page(array(
        'page_title' 	=> 'Tracking Codes',
        'menu_title'	=> 'Tracking Codes',
        'parent_slug'	=> 'theme-general-settings',
    )); */
    
}