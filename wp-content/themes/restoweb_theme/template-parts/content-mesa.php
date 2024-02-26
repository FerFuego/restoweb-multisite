<div class="content-mesa-box mb-3">

    <div>

        <a href="<?php echo get_the_permalink(); ?>">

            <img src="<?php echo get_the_post_thumbnail_url(); ?>">
            
        </a>
        
        <h3><?php the_title(); ?> - <?php echo ( get_field('estado') == 'Abierta' ) ? 'Ocupada' : 'Libre'; ?></h3>

        <p><?php echo ( get_field('cantidad_lugares') ) ? 'Lugares: ' . get_field('cantidad_lugares') . ' personas.' : ''; ?></p>
        
        <p><?php echo ( get_field('descripcion') ) ? get_field('descripcion') : ''; ?></p>

    </div>

    <div class="content-mesa-box-cta">

        <a href="<?php echo get_the_permalink(); ?>">Ver Mesa</a>

        <a href="<?php echo add_query_arg( 'open', 'true', get_the_permalink() )?>">Abrir Mesa</a>

    </div>

</div>