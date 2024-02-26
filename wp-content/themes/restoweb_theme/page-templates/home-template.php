<?php /* Template Name: Home */?>

<?php get_header();?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
		<div class="error-404 not-found">
			<div class="page-content">
				
				<header class="page-header mb-5">
					<h1 class="page-title"><?php esc_html_e( 'Las mejores comidas encuentralas aqui', 'shopper' ); ?></h1>
				</header>

				<div class="row">

					<div class="custom-sidebar col-3">
						<?php //the_widget('WC_Widget_Product_Categories', array());?>

						<div class="site-main home-page-template" role="main">
							<!-- <a href="<?php //echo esc_url(home_url('/escanear')); ?>"><i class="vc_btn3-icon fa fa-qrcode"></i> Escanear código QR de la mesa </a>
							<a href="<?php //echo esc_url(home_url('/mesas')); ?>"><i class="vc_btn3-icon fa fa-th"></i> Abrir mesa manualmente </a> -->
							<!-- <a href="<?php //echo esc_url(home_url('/menu')); ?>"><i class="vc_btn3-icon fa fa-cutlery"></i> Ver la carta / menú </a> -->
							<!-- <a href="https://api.whatsapp.com/send?phone=5493541598993&text=Mozo podría venir?"><i class="vc_btn3-icon fa fa-whatsapp"></i> Llamar al mozo </a> -->
							<a href="<?php echo esc_url(home_url('/carro')); ?>"><i class="vc_btn3-icon fa fa-shopping-cart"></i> Ver Carrito </a>
							<a href="<?php echo esc_url(home_url('/finalizar-compra')); ?>"><i class="vc_btn3-icon fa fa-shopping-bag"></i> Finalizar Pedido </a>
							<a href="<?php echo esc_url(home_url('/mi-cuenta')); ?>"><i class="vc_btn3-icon fa fa-user-plus"></i> Mi cuenta </a>

							<div class="d-flex justify-content-center mb-5 mt-5">
								<?php echo do_shortcode('[dqr_code post_id="'.get_the_ID().'"]'); ?>
							</div>

							<div class="home-popular-products page-header" aria-label="Popular Products">
								<h1 class="page-title text-left"><?php echo esc_html__('Productos Populares', 'shopper'); ?></h1>
								<?php echo shopper_do_shortcode('restoweb_best_selling_products'); ?>
							</div>

						</div><!-- #main -->
						
					</div>

					<div class="col-md-12 col-lg-9">
						<div id="primary" class="content-area">
							<main id="main" class="site-main" role="main">

								<?php $terms = get_terms( 'product_cat', array('parent' => 0) ); ?>

								<div class="list-categ" id="js-menu-items">
									<?php if ( $terms ) : $i=0; 
										foreach ( $terms as $term ) : $i++; ?>
											<div class="item-categ <?php echo ($i==1)? 'active' : ''; ?>" id="<?php echo  $term->slug; ?>" onclick="getProducts('<?php echo  $term->slug; ?>');">
												<?php echo  $term->name; ?>
											</div>
										<?php endforeach; 
									endif; ?>
								</div>

								<div class="panel" id="js-restoweb-products">
									<?php 
									// Show products of first category
									$args = array(
										'post_type'      => 'product', 
										'product_cat' 	 => $terms[1]->slug,
										'posts_per_page' => '-1',
										'paged'          => 'no-paging',
									);
									$loop = new WP_Query( $args );
									
									if ( $loop->have_posts() ) : 
										while ( $loop->have_posts() ) : $loop->the_post();
											global $product, $woocommerce;
											set_query_var('ID', $loop->post->ID);
											get_template_part('/inc/custom-restoweb/partials/card-prod');
											echo "<script>slider('".$loop->post->ID."')</script>";
										endwhile;
									endif; ?>
								</div>
								
								<?php get_template_part('/inc/custom-restoweb/partials/modal-image'); ?>

							</main><!-- #main -->

						</div><!-- #primary -->

						<script>
							jQuery('form').each( function () {
								jQuery(this).attr('action', '');
							});
						</script>
	
						<!-- <section class="home-popular-products page-header" aria-label="Popular Products">
							<h1 class="page-title text-left"><?php //echo esc_html__('Productos Populares', 'shopper'); ?></h1>
							<?php //echo shopper_do_shortcode('best_selling_products', array('per_page' => 4, 'columns' => 4)); ?>
						</section> -->
					</div>


				</div>

			</div><!-- .page-content -->
		</div><!-- .error-404 -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();?>