<?php
/**
 * Shopper functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shopper
 */

/**
 * Assign the shopper version to a var
 */
$shopper_theme   = wp_get_theme( 'shopper' );
$shopper_version = $shopper_theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$shopper = (object) array(
	'version' => $shopper_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-shopper.php',
	'customizer' => require 'inc/customizer/class-shopper-customizer.php',
);


require 'inc/shopper-functions.php';
require 'inc/shopper-template-hooks.php';
require 'inc/shopper-template-functions.php';

/**
 * All for WooCommerce functions
 */
if ( shopper_is_woocommerce_activated() ) {
	
	$shopper->woocommerce = require 'inc/woocommerce/class-shopper-woocommerce.php';

	require 'inc/woocommerce/shopper-wc-template-hooks.php';
	require 'inc/woocommerce/shopper-wc-template-functions.php';
}

/*------------------------------------*\
          Custom Enqueue
\*------------------------------------*/
require 'inc/custom-restoweb/custom-enqueue.php';

/*------------------------------------*\
          Custom Posttypes
\*------------------------------------*/
require 'inc/custom-restoweb/register-posttypes.php';

/*------------------------------------*\
          Custom Functions
\*------------------------------------*/
require 'inc/custom-restoweb/custom-functions.php';

/*------------------------------------*\
          Custom ACF
\*------------------------------------*/
require 'inc/custom-restoweb/register-acf.php';

/*------------------------------------*\
          Custom Shortcodes
\*------------------------------------*/
require 'inc/custom-restoweb/register-shortcodes.php';

/*------------------------------------*\
          Custom Pages
\*------------------------------------*/
require 'inc/custom-restoweb/register-pages.php';

/*------------------------------------*\
          Custom Options
\*------------------------------------*/
require 'inc/custom-restoweb/register-options.php';

/*------------------------------------*\
          Custom Get Sites
\*------------------------------------*/
require 'inc/custom-restoweb/custom-get-sites.php';

/*------------------------------------*\
          Custom MetaBoxes
\*------------------------------------*/
require 'inc/custom-restoweb/register-dashboard.php';

/*------------------------------------*\
          Custom Ajax
\*------------------------------------*/
require 'inc/custom-restoweb/custom-ajax.php';

/*------------------------------------*\
          Custom Classes
\*------------------------------------*/
require 'inc/custom-restoweb/classes/register_class.php';

/*------------------------------------*\
          Custom Cronjob
\*------------------------------------*/
require 'inc/custom-restoweb/custom-cronjob.php';