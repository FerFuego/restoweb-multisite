<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$allowed_html = array(
	'a' => array('href' => array(),)
);
?>

<div class="wc-rss-importer-header d-flex flex-row flex-left align-center">
	<h2>
		<?php printf(
			wp_kses( __( 'Hola %1$s! ', 'woocommerce' ), $allowed_html ),
			'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
			esc_url( wc_logout_url() )
		); ?>
	</h2>
</div>

<?php if (in_array('delivery', $current_user->roles)): ?>
	<div class="wc-rss-importer-form">
		<div class="importer-container">
			<h3>Lista de envios</h3>
			<div class="form">
				<div class="group-fullwith" id="response">
					<?php 

						add_filter( 'woocommerce_get_wp_query_args', function( $wp_query_args, $query_vars ){
							if ( isset( $query_vars['meta_query'] ) ) {
								$meta_query = isset( $wp_query_args['meta_query'] ) ? $wp_query_args['meta_query'] : [];
								$wp_query_args['meta_query'] = array_merge( $meta_query, $query_vars['meta_query'] );
							}
							return $wp_query_args;
						}, 10, 2 );

						$args = array(
							'paginate' => true,
							'order' => 'DESC',
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key' => 'seleccionar_delivery',
									'value' => $current_user->ID,
									'compare' => '=',
								)
							)
						);
						$results = wc_get_orders( $args );
					?>
					<?php if ($results->total): ?>
						<table>
							<thead>
								<tr>
									<td>ID</td>
									<td>Fecha</td>
									<td>Nombre</td>
									<td>Direccion</td>
									<td>Telefono</td>
									<td>Total</td>
									<td>Estado</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($results->orders as $order): ?>
									<tr>
										<td><?php echo $order->get_id(); ?></td>
										<td><?php echo $order->order_date; ?></td>
										<td><?php echo $order->get_billing_first_name() .' '. $order->get_billing_last_name(); ?></td>
										<td><?php echo $order->shipping_address_1 .', '. $order->shipping_city .', '. $order->shipping_postcode; ?></td>
										<td><?php echo $order->get_billing_phone(); ?></td>
										<td><?php echo get_woocommerce_currency_symbol() .' '. $order->get_total(); ?></td>
										<td><?php echo $order->get_status(); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else : ?>
						<p>No hay envios</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if (in_array('mozo', $current_user->roles)): ?>
	<div class="wc-rss-importer-form">
		<div class="importer-container">
			<h3>Lista de pedidos</h3>
			<div class="form">
				<div class="group-fullwith" id="response">
					<?php 
						add_filter( 'woocommerce_get_wp_query_args', function( $wp_query_args, $query_vars ){
							if ( isset( $query_vars['meta_query'] ) ) {
								$meta_query = isset( $wp_query_args['meta_query'] ) ? $wp_query_args['meta_query'] : [];
								$wp_query_args['meta_query'] = array_merge( $meta_query, $query_vars['meta_query'] );
							}
							return $wp_query_args;
						}, 10, 2 );

						$args = array(
							'paginate' => true,
							'order' => 'DESC',
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key' => 'seleccionar_mozo',
									'value' => $current_user->ID,
									'compare' => '=',
								)
							)
						);
						$results = wc_get_orders( $args );
					?>
					<?php if ($results->total): ?>
						<table>
							<thead>
								<tr>
									<td>ID</td>
									<td>Fecha</td>
									<td>Nombre</td>
									<td>Direccion</td>
									<td>Telefono</td>
									<td>Total</td>
									<td>Estado</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($results->orders as $order): ?>
									<tr>
										<td><?php echo $order->get_id(); ?></td>
										<td><?php echo $order->order_date; ?></td>
										<td><?php echo $order->get_billing_first_name() .' '. $order->get_billing_last_name(); ?></td>
										<td><?php echo $order->shipping_address_1 .', '. $order->shipping_city .', '. $order->shipping_postcode; ?></td>
										<td><?php echo $order->get_billing_phone(); ?></td>
										<td><?php echo get_woocommerce_currency_symbol() .' '. $order->get_total(); ?></td>
										<td><?php echo $order->get_status(); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else : ?>
						<p>No hay pedidos</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if (in_array('subscriber', $current_user->roles)): ?>
	<?php
	$subscription_status = [];
	$subscriptions = Subscriptio_User::find_subscriptions(false, get_current_user_id());
	$blog_id = get_user_meta(get_current_user_id(), 'blog_id', true );
	$title = get_user_meta(get_current_user_id(), 'user_company', true );
	$new_site_name = sanitize_title($title); 

	foreach ($subscriptions as $subscription) :
		$subscription_status[] = $subscription->get_formatted_status(true);
	endforeach; ?>

	<table>
		<thead>
			<tr>
				<th colspan="2">Datos de la tienda</th>
			</tr>
		</thead>
		<tr>
			<td>ID Tienda:</td>
			<td><?php echo $blog_id; ?></td>
		</tr>
		<tr>
			<td>Nombre de la Tienda:</td>
			<td><?php echo $title; ?></td>
		</tr>
		<?php if ($subscription_status && in_array('Active', $subscription_status)) : ?>
			<tr>
				<td>Link a la Tienda:</td>
				<td><a href="<?php echo get_bloginfo('wpurl'). "/" . $new_site_name; ?>" target="_blank"><?php echo get_bloginfo('wpurl'). "/" . $new_site_name; ?></a></td>
			</tr>
			<tr>
				<td>Administración de la Tienda:</td>
				<td><a href="<?php echo get_bloginfo('wpurl'). "/" . $new_site_name . "/wp-admin"; ?>" target="_blank"><?php echo get_bloginfo('wpurl'). "/" . $new_site_name . "/wp-admin"; ?></a></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td>Estado de la Suscripción:</td>
			<td class="<?php echo ($subscription_status && in_array('Active', $subscription_status)) ? 'text-success':'text-danger'; ?>"><?php echo ($subscription_status && in_array('Active', $subscription_status)) ? 'Activo':'Cancelado'; ?></td>
		</tr>
	</table>
	

	<?php if ($subscription_status && in_array('Active', $subscription_status)) : ?>
		<br><br>
		<h4>Tu tienda ya esta lista para que la pongas en funcionamiento!</h4>
		<p>Puedes verla en este link: <a href="<?php echo get_bloginfo('wpurl'). "/" . $new_site_name; ?>" target="_blank"><?php echo get_bloginfo('wpurl'). "/" . $new_site_name; ?></a> <br>
			Puedes ingresar a ella en este link: <a href="<?php echo get_bloginfo('wpurl'). "/" . $new_site_name . "/wp-admin"; ?>" target="_blank"><?php echo get_bloginfo('wpurl'). "/" . $new_site_name . "/wp-admin"; ?></a></p>
	<?php endif; ?>

	
	<?php if (!in_array('Active', $subscription_status)) : ?>

		<section class="plans" id="planes">

			<div class="plans-header">
				<h3>Suscribete</h3>
				<h2>Suscribete a tu plan mensual</h2>
				<p>Nuestro servicio se proporciona a través de pagos mensuales para su conveniencia.</p>
			</div>
			
			<?php $location = get_user_location_by_ip()['country_name']; ?>

			<div class="plans-body">
				<?php echo do_shortcode('[products limit="8" columns="2" category="'.$location.'" cat_operator="AND"]'); ?>
			</div>
			
		</section>

	<?php endif; ?>

<?php endif; ?>