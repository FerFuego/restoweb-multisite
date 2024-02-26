<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shopper
 */
?>

<?php get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

                <header class="page-header">

                    <h1 class="page-title">Mesas</h1>

					<h3><?php echo ( $_SESSION['mesa'] ) ? 'Orden ' . $_SESSION['mesa']['title'] : 'Debes dar de alta tu mesa'; ?></h3>

				</header><!-- .page-header -->
				
				<div class="container-mesa">

					<?php while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'mesa' );

					endwhile; // End of the loop. ?>

				</div>

			<?php else : ?>

			    <?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

        </main><!-- #main -->
        
	</div><!-- #primary -->

<?php get_footer(); ?>
