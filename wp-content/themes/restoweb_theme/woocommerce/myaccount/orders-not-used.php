<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$allowed_html = array(
	'a' => array('href' => array(),)
);

$user = new WP_User( get_current_user_id()  );
$user_id = $user->ID;
$user_email = $user->user_email;
$title = get_user_meta( $user_id, 'user_company', true );

$args =  array(
        'orderby' 			=> 'ID',
        'order' 			=> 'DESC',
        'posts_per_page'	=> -1,
        'post_type' 		=> 'wpplugin_subscr',
        'meta_query' 		=> array(
            'relation'=>'or',
            array(
                'key' 		=> 'payer_email',
                'value' 	=> $user_email,
                'compare' 	=> 'LIKE',
            )
        )
    );

$subscriptions = get_posts($args);
?>

<h2>Suscripciones: <?php echo $title; ?></h2>

<?php
if ( ! empty( $subscriptions ) ) {
    ?>
    <table class="shop_table shop_table_responsive my_account_orders">
        <thead>
            <tr>
                <th class="order-number"><span class="nobr"><?php esc_html_e( 'Order', 'woocommerce' ); ?></span></th>
                <th class="order-date"><span class="nobr"><?php esc_html_e( 'Date', 'woocommerce' ); ?></span></th>
                <th class="order-status"><span class="nobr"><?php esc_html_e( 'Status', 'woocommerce' ); ?></span></th>
                <th class="order-total"><span class="nobr"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span></th>
                <th class="order-actions">&nbsp;</th>
            </tr>
        </thead>
        <tbody><?php
        //print_r($subscriptions);
            foreach ( $subscriptions as $subscription ) {
                $order      = wc_get_order( $subscription->get_id() );
                $item_count = $order->get_item_count();

                ?><tr class="order">
                    <td class="order-number" data-title="<?php esc_attr_e( 'Order Number', 'woocommerce' ); ?>">
                        <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                            <?php echo esc_attr( $order->get_order_number() ); ?>
                        </a>
                    </td>

                    <td class="order-date" data-title="<?php esc_attr_e( 'Date', 'woocommerce' ); ?>">
                        <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
                    </td>

                    <td class="order-status" data-title="<?php esc_attr_e( 'Status', 'woocommerce' ); ?>" style="text-align:left; white-space:nowrap;">
                        <?php echo wc_get_order_status_name( $order->get_status() ); ?>
                    </td>

                    <td class="order-total" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                        <?php echo sprintf( _n( '%s for %s item', '%s for %s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ); ?>
                    </td>

                    <td class="order-actions">
                        <?php
                        $actions = array();

                        if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_payment', array( 'pending', 'failed' ), $order ) ) ) {
                            $actions['pay'] = array(
                                'url'  => $order->get_checkout_payment_url(),
                                'name' => esc_html__( 'Pay', 'woocommerce' ),
                            );
                        }

                        if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) ) {
                            $actions['cancel'] = array(
                                'url'  => $order->get_cancel_order_url( wc_get_page_permalink( 'myaccount' ) ),
                                'name' => esc_html__( 'Cancel', 'woocommerce' ),
                            );
                        }

                        $actions['view'] = array(
                            'url'  => $order->get_view_order_url(),
                            'name' => esc_html__( 'View', 'woocommerce' ),
                        );

                        $actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );

                        if ( $actions ) {
                            foreach ( $actions as $key => $action ) {
                                echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
                            }
                        }
                        ?>
                    </td>
                </tr><?php
            }
        ?></tbody>
    </table>
    <?php
} else {
    echo '<p>' . esc_html__( 'No tienes suscripciones activas.', 'woocommerce' ) . '</p>';
}
?>

<?php if ($_GET['token']) : ?>
    <p>
        <?php echo sprintf(__('Te has suscrito con éxito a nuestra plataforma. <a href="%s">Click aqui</a> para ir a tu tienda.', 'woocommerce-subscriptions'), home_url()); ?>
    </p>
<?php else : ?>
    <p>
        <?php echo sprintf(__('Se ha dado de baja con éxito de nuestra plataforma. <a href="%s">Click aqui</a> para salir.', 'woocommerce-subscriptions'), home_url()); ?>
    </p>
<?php endif; ?>