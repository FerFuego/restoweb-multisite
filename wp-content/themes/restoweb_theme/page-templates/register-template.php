<?php /* Template Name: Registro */ ?>

<?php get_header('clean'); ?>

<main id="main" class="site-main" role="main">

    <section class="register" id="contacto">

      <div class="register-container">

        <div class="register-info">

            <div class="plans-header">

              <h3>Registro</h3>

              <h2>¿Qué hago?</h2>

              <p>Completá el formulario de registro y empeza a vender facil y rapido desde la web.</p>

            </div>

            <div>

              <p><b>Email:</b> info@restoweb.com.ar</p>

              <p><b>Tel: </b> +54 9 11 3856-9993</p>

            </div>

            <img src="<?php echo IMAGES .'/logo-white.png'; ?>" alt="RestoWeb" width="230px">

        </div>

        <div class="register-form">

          <div class="register-container">

            <form id="js-register">

                <h3>Datos Personales:</h3>
  
                <div>
                    <input type="text" name="user_name" id="user_name" placeholder="Nombre Completo">
                </div>
                
                <div>
                    <input type="text" name="user_phone" id="user_phone" placeholder="Teléfono">  
                </div>

                <div>
                    <input type="text" name="user_country" id="user_country" placeholder="Pais">  
                </div>

                <div>
                    <input type="text" name="user_state" id="user_state" placeholder="Provincia">  
                </div>

                <br>

                <h3>Datos de la Empresa:</h3>

                <div>
                    <input type="text" name="user_company" id="user_company" placeholder="Nombre de Fantasia">
                </div>

                <div>
                    <input type="text" name="user_address" id="user_address" placeholder="Dirección">
                </div>

                <br>

                <h3>Datos de la cuenta:</h3>

                <div>
                    <input type="text" name="user_email" id="user_email" placeholder="Email" onchange="doctorsVerifyEmail();" autocomplete="off">
                </div>

                <div>
                    <input type="password" name="user_password" id="user_password" placeholder="Contraseña">
                </div>
  
                <div class="register-form-textarea">
                    <input type="hidden" name="control">
                </div>
              
                <div class="register-form-submit">
                    <input type="submit" name="submit" value="Registrarme">
                </div>

                <div id="js-register-messageForm"></div>
  
            </form>

          </div>

        </div>

      </div>

    </section>

</main><!-- #main -->

<?php get_footer(); ?>