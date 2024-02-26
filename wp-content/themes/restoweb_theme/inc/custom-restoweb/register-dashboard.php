<?php
add_action( 'wp_dashboard_setup', 'register_my_dashboard_widget' );
function register_my_dashboard_widget() {
	wp_add_dashboard_widget(
		'my_dashboard_widget',
		'Bienvenido a Resto Web',
		'my_dashboard_widget_display'
	);

}

function my_dashboard_widget_display() {
    echo '<h2>Primeros pasos en Resto Web</h2><br>';
    echo '<h4><b>AJUSTES</b></h4>'; 
    echo '<p><b>Comienza por personalizar tu tienda</b>: Configura con tu tienda con tu marca, logo, fondo, contacto, etc <a href="'.esc_url(home_url('/wp-admin/admin.php?page=theme-general-settings')).'" target="_blank">Personalizar</a></p>';
    echo '<p><b>Comienza por configurar tu tienda</b>: Configura con tu ubicacion, selecciona la moneda y demas opciones en la pestaña de <a href="'.esc_url(home_url('/wp-admin/admin.php?page=wc-settings')).'" target="_blank">General</a></p>';
    echo '<p><b>Configurar los envios</b>: Si realizas envios puedes configurar las zonas y agregarle un recargo al pedido segun las distancias - <a href="'.esc_url(home_url('/wp-admin/admin.php?page=wc-settings&tab=shipping')).'" target="_blank">Envios</a></p>';
    echo '<p><b>Configurar los metodos de pago</b>: Existen varios metodos de pago que puedes agregar a tu tienda, desde la pestaña de <a href="'.esc_url(home_url('/wp-admin/admin.php?page=wc-settings&tab=checkout')).'" target="_blank">Pagos</a> puedes habilitarlos, por defecto solo esta habilitado Transferencia Bancaria pero puedes agregar los que prefieras.</p>';
    echo '<p><b>El resto de las opciones de configuracion ya vienen precargadas por defecto para q la tienda funcione correctamente.</b></p>';
    echo '<br><h4><b>CATEGORIAS</b></h4>';
    echo '<p><a href="'.esc_url(home_url('/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product')).'" target="_blank">Categorias de Productos</a>: Se recomienda cargar primero las categorias, para luego en la pantalla de productos estas esten disponibles para ser agregadas a los productos. <b>Las categorias por defecto pueden ser eliminadas.</b></p>';
    echo '<br><h4><b>PRODUCTOS</b></h4>';
    echo '<p><a href="'.esc_url(home_url('/wp-admin/edit.php?post_type=product')).'" target="_blank">Productos</a>: En la pantalla de productos podras ver el estado de los productos, el inventario disponible entre otras muchas opciones.</p>';
    echo '<p><a href="'.esc_url(home_url('/wp-admin/post-new.php?post_type=product')).'" target="_blank">Agregar Productos</a>: En la pantalla de alta de productos, ofrecemos varias opciones para los productos.</p>';
    echo '<br><h4><b>PEDIDOS</b></h4>';
    echo '<p><a href="'.esc_url(home_url('/wp-admin/edit.php?post_type=shop_order')).'" target="_blank">Pedidos</a>: En esta pantalla podras gestionar y ver todos los pedidos.</p>';
    echo '<br><h4><b>CLIENTES</b></h4>';
    echo '<p><a href="'.esc_url(home_url('/wp-admin/admin.php?page=wc-admin&path=%2Fcustomers')).'" target="_blank">Clientes</a>: En la pestaña clientes podras ver todos los clientes q compraron en tu tienda, como asi tambien sus datos de contacto.</p>';
}