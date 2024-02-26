<?php /* Template Name: Menu */ ?>

<?php get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php $terms = get_terms( 'product_cat', array('parent' => 0) ); ?>
			
			<?php if ( $terms ) : ?>
				
				<?php foreach ( $terms as $term ) : ?>

					<button class="accordion">

						<?php echo  $term->name; ?>

						<img src="<?php echo IMAGES . '/triangle.svg'; ?>" class="icon --active">
					
					</button>

					<div class="panel">

						<?php //get product
							$args = array(
								'post_type'      => 'product', 
								'product_cat' 	 => $term->slug,
								'posts_per_page' => '-1',
								'paged'          => 'no-paging',
							);
							$query = new WP_Query( $args ); ?>

						<?php if ( $query->have_posts() ) : ?>

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>

								<?php do_action( 'woocommerce_shop_loop' ); ?>
								
								<?php wc_get_template_part( 'content', 'single-product' ); ?>

							<?php endwhile; ?>

							<?php wp_reset_postdata(); ?>

						<?php endif; ?>
					
					</div>																			
		
				<?php endforeach; ?>
			
			<?php endif; ?>

		</main><!-- #main -->

	</div><!-- #primary -->

	<script>
		jQuery('form').each( function () {
			jQuery(this).attr('action', '');
		});
	</script>

<?php get_footer(); ?>