<div class="wc-rss-importer-header d-flex flex-row flex-left align-center">
    <h2><?php esc_html_e( 'Mozo', 'textdomain' ); ?></h2>
</div>

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
                                'compare' => 'EXISTS',
                            )
                        )
                    );
                    $results = wc_get_orders( $args );
                ?>
                <?php if ($results->total): ?>
                    <table class="wc-table-striped">
                        <thead>
                            <tr>
                                <td>ID Pedido</td>
                                <td>Fecha</td>
                                <td>Nombre</td>
                                <td>Direccion</td>
                                <td>Email</td>
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
                                    <td><?php echo $order->get_billing_email(); ?></td>
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

            <div class="group-right">
                <h3><?php echo $user->display_name; ?></h3>
                <p>Total de pedidos: <?php echo $results->total; ?></p>
            </div>
        </div>
    </div>
</div>