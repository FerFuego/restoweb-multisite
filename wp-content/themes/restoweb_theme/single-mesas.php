<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shopper
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post();
				
				//do_action( 'shopper_single_post_before' );

				echo do_shortcode('[restoweb_open_table]');

				get_template_part( 'template-parts/content', 'single-mesa' );

				//do_action( 'shopper_single_post_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->


<?php get_footer(); ?>
