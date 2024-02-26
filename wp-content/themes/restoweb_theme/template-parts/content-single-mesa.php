<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shopper
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="content-mesa-box mb-3">

        <div>

            <img src="<?php echo get_the_post_thumbnail_url(); ?>">
            
            <h3><?php echo get_the_title(); ?> - <?php echo ( get_field('estado') == 'Abierta' ) ? 'Ocupada' : 'Libre'; ?></h3>

            <p><?php echo ( get_field('cantidad_lugares') ) ? 'Lugares: ' . get_field('cantidad_lugares') . ' personas.' : ''; ?></p>
            
            <p><?php echo ( get_field('descripcion') ) ? get_field('descripcion') : ''; ?></p>

        </div>

        <div class="content-mesa-box-cta">

            <a href="<?php echo add_query_arg( 'open', 'true', get_the_permalink() )?>">Abrir Mesa</a>

        </div>

    </div>

</article><!-- #post-## -->