<?php /* Template Name: Sitios */ ?>

<?php get_header('search'); ?>

<main id="main" class="site-main" role="main">

    <section class="sites" id="clients">

        <div class="text-left">
            <?php echo (isset($_GET['search'])) ? '<h4>Busqueda: ' . $_GET['search'] . '</h4>': ''; ?>
        </div>

        <div class="sites-body">

            <?php echo getSites($_GET['search'], null); ?>   

        </div>

    </section>

</main>

<?php get_footer() ?>