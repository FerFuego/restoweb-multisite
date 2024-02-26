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

	<header id="masthead" class="site-header" role="banner" style="<?php shopper_header_styles(); ?> background-image: url(<?php echo ( get_field('banner', 'option') ) ? get_field('banner', 'option')['url'] : IMAGES .'/bg.jpg'; ?>); position:relative; <?php echo (wp_is_mobile()) ? 'height: auto;':''; ?>">

		<div class="col-full">
			<?php do_action( 'shopper_header' ); ?>
		</div>

		<?php 
			$telefono = get_field('telefono','option');
			$direccion = get_field('direccion','option'); 
			$horarios = get_field('horarios','option');
			$email = get_field('email','option');
			$dias_de_atencion = get_field('dias_de_atencion','option');
			$delivery = get_field('delivery','option');
		?>
		
		<?php if ($telefono || $direccion || $horarios || $email || $delivery) : ?>
			
			<?php if (wp_is_mobile()) : ?>
				<div class="toggle-me" id="js-toggle-menu">
					<img src="https://img.icons8.com/ios-filled/50/000000/menu-rounded.png"/>
				</div>
			<?php endif; ?>
			
			<div class="menu-header col-ful d-flex align-items-center text-center" id="js-data-menu">
				<div class="close-me" id="js-close-menu">
				<img src="https://img.icons8.com/ios-filled/48/000000/delete-sign--v2.png"/>
				</div>
				<?php if ($telefono): ?>
					<div class="d-flex flex-column">
						<b>Teléfono</b>
						<a href="tel:<?php echo $telefono; ?>"><?php echo $telefono; ?></a>
					</div>
				<?php endif; ?>
				<?php if ($email): ?>
					<div class="d-flex flex-column">
						<b>Email</b>
						<a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
					</div>
				<?php endif; ?>
				<?php if ($direccion): ?>
					<div class="d-flex flex-column">
						<b>Dirección</b>
						<a href="https://goo.gl/maps/<?php echo str_replace(' ', '-', $direccion); ?>" target="_blank"><?php echo $direccion; ?></a>
					</div>
				<?php endif; ?>
				<?php if ($horarios || $dias_de_atencion): ?>
					<div class="d-flex flex-column">
						<b>Horario</b>
						<a href="#"><?php echo $dias_de_atencion . ' ' . $horarios; ?></a>
					</div>
				<?php endif; ?>
				<?php if ($delivery): ?>
					<div class="d-flex flex-column">
						<b>Delivery/Envios</b>
						<a href="#"><?php echo $delivery; ?></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->

	<script>
		$('#js-toggle-menu').on('click', function () {
			$('#js-data-menu').toggleClass('active');
		});
		$('#js-close-menu').on('click', function () {
			$('#js-data-menu').toggleClass('active');
		});
	</script>

	<?php do_action( 'shopper_before_content' ); ?>

	<div id="content" class="site-content">

		<div class="col-full">

		<?php do_action( 'shopper_content_top' ); ?>
