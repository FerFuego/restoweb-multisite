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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	
	<?php do_action( 'shopper_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" style="<?php shopper_header_styles(); ?> background-image: url(<?php echo ( get_field('banner', 'option') ) ? get_field('banner', 'option')['url'] : IMAGES .'/bg.jpg'; ?>); height:200px;">

		<div class="col-full">
			<div class="header-middle clear">
				<div class="site-branding">
					<img src="<?php echo IMAGES .'/logo-white.png'; ?>" alt="logo" width="200px">
				</div>
				<div class="custom-product-search">
					<div class="dgwt-wcas-search-wrapp dgwt-wcas-no-submit woocommerce js-dgwt-wcas-layout-classic dgwt-wcas-layout-classic js-dgwt-wcas-mobile-overlay-enabled">
						<form class="dgwt-wcas-search-form" role="search" action="/buscar" method="get">
							<div class="dgwt-wcas-sf-wrapp">
								<svg version="1.1" class="dgwt-wcas-ico-magnifier" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 51.539 51.361" enable-background="new 0 0 51.539 51.361" xml:space="preserve">
		             			<path fill="#444" d="M51.539,49.356L37.247,35.065c3.273-3.74,5.272-8.623,5.272-13.983c0-11.742-9.518-21.26-21.26-21.26 S0,9.339,0,21.082s9.518,21.26,21.26,21.26c5.361,0,10.244-1.999,13.983-5.272l14.292,14.292L51.539,49.356z M2.835,21.082 c0-10.176,8.249-18.425,18.425-18.425s18.425,8.249,18.425,18.425S31.436,39.507,21.26,39.507S2.835,31.258,2.835,21.082z"></path>
								 </svg>
								<label class="screen-reader-text" for="dgwt-wcas-search-input-1f3c">Buscar</label>
								<input id="dgwt-wcas-search-input-1f3c" type="search" class="dgwt-wcas-search-input" name="search" value="" placeholder="Buscar..." autocomplete="off">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>		
	</header><!-- #masthead -->
