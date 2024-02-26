<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shopper
 */

?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="manifest" href="<?php echo IMAGES; ?>/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="float-logo">
        <img src="<?php echo IMAGES .'/logo.png'; ?>" alt="Restoweb">
    </div>

    <!-- Navbar -->
    <?php wp_nav_menu( array( 
                'theme_location' => 'landing-custom-menu', 
                'container_class' => 'custom-menu-class',
                'container_id' => 'navbar'
            ) 
        ); ?>