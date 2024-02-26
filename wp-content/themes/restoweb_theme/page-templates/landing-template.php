<?php /* Template Name: Landing */ ?>

<?php get_header('clean'); ?>

<main id="main" class="site-main" role="main">

    <section class="header" id="inicio">

        <div class="header-container">

            <div class="header-content">

                <!-- <h1>Restoweb</h1> -->
                <h1><img src="<?php echo IMAGES .'/logo-white.png'; ?>" alt="Restoweb"></h1>

                <h2>tu bar o restaurant en una aplicación</h2>

                <p>Contratá uno de nuestros planes y relanza tu negocio a una nueva modalidad.</p>

                <div class="header-content-cta">

                    <a href="#servicios" class="jumper cta-white">Servicios</a>

                    <a href="#planes" class="jumper cta-red">Planes</a>

                </div>

            </div>

        </div>

        <div class="header-container-mobile">

            <div class="header-image">

                <div class="header-image-content">

                    <img src="<?php echo IMAGES .'/landing/restoweb-top-1.png'; ?>" alt="Restoweb">
                    
                    <div class="header-image-cta">

                        <span></span>
    
                        <a href="#contacto" class="jumper">Contactanos</a>
    
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="services" id="servicios">

        <div class="services-header">

            <h3>Que hacemos</h3>

            <h2>Nuestros Servicios</h2>

        </div>

        <div class="services-body">

            <article class="service-box">

              <div class="service-box-media">

                <i class="fas fa-network-wired fa-4x"></i>

                <span></span>

              </div>

              <p class="service-box-title">Subdominio y Alojamiento</p>

              <div class="service-box-text">

                <p>Creamos un subdominio con tu marca y alojamos en nuestros servidores tu plataforma web.</p>

              </div>

            </article>

            <article class="service-box">

              <div class="service-box-media">

                <i class="fas fa-palette fa-4x"></i>

                <span></span>

              </div>

              <p class="service-box-title">Look and Feel de tu Web y Aplicación</p>

              <div class="service-box-text">

                <p>Tu plataforma web y tu aplicacion tendrán tu marca y todos tus distintivos.</p>

              </div>

            </article>

            <article class="service-box">

              <div class="service-box-media">

                <i class="fas fa-server fa-4x"></i>

                <span></span>

              </div>

              <p class="service-box-title">Carga de Datos</p>

              <div class="service-box-text">

                <p>Sino tenes tiempo para cargar los productos, nosotros nos encargamos de todo.</p>

              </div>

            </article>

            <article class="service-box">

              <div class="service-box-media">

                <i class="fas fa-mobile-alt  fa-4x"></i>

                <span></span>

              </div>

              <p class="service-box-title">Aplicación Móvil PWA para tus Clientes</p>

              <div class="service-box-text">

                <p>Tus clientes tendrá en su móvil acceso a tu negocio y a todos tus productos.</p>

              </div>

            </article>            

        </div>

    </section>

    <section class="sites" id="clients">

        <div class="sites-header">

            <h3>Clientes</h3>

            <h2>Sitios que forman parte de la red de Restoweb</h2>

        </div>

        <div class="sites-body">

          	<?php echo getSites(null, 4); ?>   

        </div>

        <div class="sites-footer">

          <a href="<?php echo esc_url(home_url('/buscar')); ?>" class="sites-cta-red">Ver todos</a>

        </div>

    </section>

    <section class="demo" id="demo">

        <div class="demo-container-super">

            <div class="demo-container">
    
                <div class="demo-header">
        
                    <h3>Demo</h3>
        
                    <h2>Prueba Nuestra Aplicación</h2>
        
                </div>
        
                <div class="demo-body">
        
                    <p>Te damos la posibilidad de probar nuestra plataforma antes de contratar el servicio. Aquí podras ver como se verá en una pc de escritorio como en la aplicación móvil.</p>
        
                    <div class="demo-cta">
        
                        <a href="<?php echo esc_url(home_url('/demo')); ?>" class="demo-cta-white">Ver Demo</a>
                        
                        <a href="#planes" class="demo-cta-red">Contratar Servicio</a>
        
                    </div>
        
                </div>
    
            </div>
    
            <div class="demo-container-mobile">
    
                <div class="demo-image">
    
                    <div class="demo-image-content">
    
                        <img src="<?php echo IMAGES .'/landing/mobile-test.png'; ?>" alt="Restoweb">
    
                    </div>
    
                </div>
    
            </div>

        </div>

    </section>

    <section class="plans" id="planes">

      <div class="plans-header">

        <h3>Suscribete</h3>

        <h2>Suscribete a tu plan mensual</h2>

        <?php //echo get_user_location_by_ip()['country_name']; ?>

        <!-- <p>Ofrecemos tres planes diferentes que cubren las necesidades de los restaurantes y bares modernos. Se proporcionan a través de pagos mensuales para su conveniencia.</p> -->

        <p>Nuestro servicio se proporciona a través de pagos mensuales para su conveniencia.</p>

      </div>

      <div class="plans-body">
        <?php 
          $location = get_user_location_by_ip()['country_name'];
          $args = array(
            'category' => array($location)
          );
          $products = wc_get_products( $args );
          
          foreach ( $products as $product) : //print_r($product)?>

          <article class="plans-box">

            <div class="plans-box-header">

              <h2 class="plans-box-title"><?= $product->name ?></h2>

              <div class="plans-box-media">
                
                <p><?= $product->price; ?> <?= get_woocommerce_currency_symbol(); ?></p>
                
                  <span></span>
                  
                </div>

                <div class="plans-box-divider"></div>

              </div>

              <div class="plans-box-text">

                <ul class="plans-list">

                  <li>Aplicación móvil PWA</li>
                  
                  <li>Página web con tu marca</li>

                  <li>Reserva de Mesa</li>
                  
                  <li>Panel Administración</li>

                  <li>Carga de productos</li>

                  <li>Pedidos con el móvil</li>

                  <li>Pedidos desde casa con delivery</li>

                  <li>Cobros por MercadoPago</li>

                  <li>Panel de Cliente</li>

                  <li>Panel de Mozo</li>

                  <li>Panel de Delivery</li>

                </ul>

              </div>

              <div class="plans-box-cta">

                <a href="/registro">Seleccionar Plan</a>
                <?php //echo do_shortcode('[wpeppsub id="278" align="center"]'); ?>

              </div>

          </article>    

        <?php endforeach; ?>

      </div>

    </section>

    <section class="contact" id="contacto">

      <div class="contact-container">

        <div class="contact-info">

            <div class="plans-header">

              <h3>Contacto</h3>

              <h2>¿Qué hago?</h2>

              <p>Completá el formulario de contacto, nos comunicaremos lo antes posible con vos, en 24 hs tenés tu negocio en una aplicación móvil.</p>

            </div>

            <div>

              <p><b>Email:</b> info@restoweb.com.ar</p>

              <p><b>Tel: </b> +54 9 11 3856-9993</p>

            </div>

            <img src="<?php echo IMAGES .'/logo-white.png'; ?>" alt="RestoWeb" width="230px">

        </div>

        <div class="contact-form">

          <div class="contact-container">

            <?php //echo do_shortcode('[wpforms id="201" title="false" description="false"]'); ?>

            <form action="">
  
              <div>
  
                <input type="text" name="name" placeholder="Nombre Completo">
  
                <input type="text" name="email" placeholder="Email">
  
              </div>
  
              <div>
  
                <input type="text" name="phone" placeholder="Teléfono">
  
                <input type="text" name="rubro" placeholder="Rubro">
  
              </div>
  
              <div class="contact-form-textarea">
  
                <textarea name="message" id="message" cols="30" rows="10" placeholder="Mensaje"></textarea>
  
                <input type="hidden" name="control">
                
              </div>
              
              <div class="contact-form-submit">
  
                <input type="submit" name="submit" value="Enviar">
                
              </div>
  
            </form>

          </div>

        </div>

      </div>

    </section>

</main><!-- #main -->

<?php get_footer();?>