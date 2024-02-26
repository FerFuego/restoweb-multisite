<?php

class Blog_Register {

    private function __construct() {
        // Do nothing
    }

    public static function clean_input( $str ) {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
    
        return $str;
    }

    public function account_register () {  

        if ( $_SERVER["REQUEST_METHOD"] == "POST" ):

            if ( ! email_exists( $_POST['user_email'] ) ) {

                $username_tocheck = self::clean_input( $_POST['user_name'] );

                $i = 1;

                while ( username_exists( $username_tocheck ) ) {

                    $username_tocheck = self::clean_input( $_POST['user_name'] ) . $i++;

                }

                // Create the user
                $userdata = array(
                    'user_login'    => $username_tocheck,
                    'user_pass'     => self::clean_input( $_POST['user_password'] ),
                    'user_email'    => self::clean_input( $_POST['user_email'] ),
                    'nickname'      => $username_tocheck,
                    'display_name'  => self::clean_input( $_POST['user_name'] ),
                    'role'          => 'subscriber',
                    'user_order'    => 0
                );
                            
                $user_id = wp_insert_user( $userdata );

                // verify errors
                if ( is_wp_error( $user_id ) )
                    wp_send_json_error( 'Ups! algo salio mal, por favor intenta nuevamente.' );

                // Create Site
                $blog_id = self::create_new_site($user_id, $_POST['user_company']);

                // set meta values
                add_user_meta( $user_id, 'blog_id', $blog_id  );
                update_user_meta( $user_id, 'blog_id', $blog_id  );
                add_user_meta( $user_id, 'user_phone', $_POST['user_phone']  );
                update_user_meta( $user_id, 'user_phone', $_POST['user_phone']  );
                add_user_meta( $user_id, 'user_country', $_POST['user_country']  );
                update_user_meta( $user_id, 'user_country', $_POST['user_country']  );
                add_user_meta( $user_id, 'user_state', $_POST['user_state']  );
                update_user_meta( $user_id, 'user_state', $_POST['user_state']  );
                add_user_meta( $user_id, 'user_company', $_POST['user_company'] );
                update_user_meta( $user_id, 'user_company', $_POST['user_company'] );
                add_user_meta( $user_id, 'user_address', $_POST['user_address']  );
                update_user_meta( $user_id, 'user_address', $_POST['user_address']  );
                
                
                // send notification
                //self::admins_notification( $user_id );
                //self::sendNotification( $userdata );

                $creds = array(
                    'user_login'    =>  $username_tocheck,
                    'user_password' => self::clean_input( $_POST['user_password'] ),
                    'remember'      => true
                );

                setcookie('wp_restoweb', 'register', (time()+600), "/");
             
                wp_signon( $creds, true ); // Log In
                
                wp_send_json_success ( "Tu registro se realizo correctamente!</p>" );
            
            } else {

                wp_send_json_error( 'El email ya existe, por favor ingresa uno diferente.' );
            }
        
        else :

            wp_send_json_error( 'Ups! algo salio mal, por favor intenta nuevamente.' );
            
        endif;
        
    }

    /**
     * Create New Site
     */
    public function create_new_site ($user_id, $title) {
        
        # New site name
        //$title = get_user_meta( $user_id, 'user_company', true );
        $new_site_name = sanitize_title($title);

        # Multisite domain
        $protocols = array('http://', 'http://www.', 'www.', 'https://', 'https://www.');
        $main_site = str_replace($protocols, '', get_bloginfo('wpurl'));

        # Type of Multisite
        $subdomain_install = false;

        # Date
        $date = date();

        # Create site
        if( $subdomain_install ) {
            $newdomain = "{$new_site_name}.$main_site";
            $path = '/';
        } else {
            $newdomain = $main_site;
            $path = "/{$new_site_name}/";
        }

        $blog_id = wp_insert_site([
            'domain'       => $newdomain,
            'path'         => $path,
            'network_id'   => get_current_network_id(),
            'public'       => 1,
            'user_id'      => 1,
            'title'        => $title
        ]);

        
        //$blog_id = insert_blog($main_site, $path, 1);

        # set role admin to user
        //$user->set_role( 'administrator' );

        # Assign user superadmin to new blog
        //add_user_to_blog ($blog_id, 1, 'administrator');
        //add_user_to_blog ($blog_id, $user_id, 'administrator');

        return $blog_id;
    }

    /**
     * Notification to Admin
     */
    public function admins_notification ( $user_id ) {

        $user = new WP_User($user_id);
        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $headers[] = 'Content-Type: text/html';
        $headers[] = 'charset=UTF-8';
        $headers[] = 'From: RestoWeb <soporte@mirestoweb.com>';
        
        $message  = '<p><strong>Nuevo Usuario reistrado en '.get_option('blogname').'</strong></p>';
        $message .= '<p><strong>Usuario:</strong> '.$user_login.'</p>';
        $message .= '<p><strong>Email:</strong> '.$user_email.'</p>';

        foreach ( get_field('admins_notification','option') as $item) {
  
            @wp_mail($item['admin_notification'], sprintf(__('[%s] Nuevo Usuario Registrado'), get_option('blogname')), $message, $headers);

        }

        return true;
    }

    /**
     * Send Notification Email
     */
    public function sendNotification( $userdata ) {
        // Email login details to user
        $to = $userdata['user_email'];

        $subject  = 'Welcome to Restoweb!';

        $message ='<p>Welcome to Restoweb\'s platform!</p>';
        $message .="<p>You are now registered and can begin updating and uploading content to your innovative profile. <br> To log in to your account, please visit: <a href='https://www.Restoweb.com/platform-login/'>https://www.Restoweb.com/platform-login/</a></p>";
        $message .="<p>Once you enter in your username and password, you will be prompted to fill in your information. <br> You can publish articles and blogs, upload videos, review apps, and share your content with your patients,<br> the Restoweb community, and the world.</p>";
        
        $body = self::getHtmlWelcomeMail( $message );

        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: Restoweb <no-reply@Restoweb.com>');

        @wp_mail( $to, $subject, $body, $headers );

        return true;
    }

    /**
     * Render Email Notification
     */
    public function getHtmlWelcomeMail( $message ) {
        ob_start();
        ?>
        <!doctype html>
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
            <head>
                <title> </title>
                <!--[if !mso]><!-- -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <!--<![endif]-->
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <style type="text/css">
                    #outlook a {
                    padding: 0;
                    }
                
                    .ReadMsgBody {
                    width: 100%;
                    }
                
                    .ExternalClass {
                    width: 100%;
                    }
                
                    .ExternalClass * {
                    line-height: 100%;
                    }
                
                    body {
                    margin: 0;
                    padding: 0;
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                    }
                
                    table,
                    td {
                    border-collapse: collapse;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    }
                
                    img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                    -ms-interpolation-mode: bicubic;
                    }
                
                    p {
                    display: block;
                    margin: 13px 0;
                    }
                </style>
                <!--[if !mso]><!-->
                <style type="text/css">
                    @media only screen and (max-width:480px) {
                    @-ms-viewport {
                        width: 320px;
                    }
                    @viewport {
                        width: 320px;
                    }
                    }
                </style>
                <!--<![endif]-->
                <!--[if mso]>
                        <xml>
                        <o:OfficeDocumentSettings>
                        <o:AllowPNG/>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                        </xml>
                        <![endif]-->
                <!--[if lte mso 11]>
                        <style type="text/css">
                        .outlook-group-fix { width:100% !important; }
                        </style>
                        <![endif]-->
                <style type="text/css">
                    @media only screen and (min-width:480px) {
                    .mj-column-per-100 {
                        width: 100% !important;
                        max-width: 100%;
                    }
                    }
                </style>
                <style type="text/css">
                    @media only screen and (max-width:480px) {
                    table.full-width-mobile {
                        width: 100% !important;
                    }
                    td.full-width-mobile {
                        width: auto !important;
                    }
                    }
                </style>
            </head>
            
            <body>
                <div style="">
                    <!--[if mso | IE]>
                    <table
                        align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
                    >
                        <tr>
                        <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                    <![endif]-->
                    <div style="Margin:0px auto;max-width:600px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                        <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                            <!--[if mso | IE]>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                
                        <tr>
                    
                            <td
                            class="" style="vertical-align:top;width:600px;"
                            >
                        <![endif]-->
                            <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                <tr>
                                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                        <tbody>
                                        <tr>
                                            <td style="width:230px;"> <img height="auto" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;" width="100" /> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <p style="border-top:solid 4px #f08d92;font-size:1;margin:0px auto;width:100%;"> </p>
                                    <!--[if mso | IE]>
                        <table
                        align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 4px #f08d92;font-size:1;margin:0px auto;width:550px;" role="presentation" width="550px"
                        >
                        <tr>
                            <td style="height:0;line-height:0;">
                            &nbsp;
                            </td>
                        </tr>
                        </table>
                    <![endif]-->
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                        <div style="font-family:helvetica;font-size:20px;font-weight:300;line-height:1;text-align:left;color:#111111;">
                                            <?php echo $message ?>
                                        </div>
                                    </td>
                                </tr>
                                </table>
                            <!--[if mso | IE]>
                            </td>
                        
                        </tr>
                    
                                </table>
                                <![endif]-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    <!--[if mso | IE]>
                        </td>
                        </tr>
                    </table>
                    <![endif]-->
                </div>
            </body>
        
        </html>
        <?php 
    
        return ob_get_clean(); 
        
    }

    /**
     * Verify the email address
     */
    public function verify_email_address() {
        if ( ! email_exists( self::clean_input( $_POST['user_email'] ) ) ) {

            $data = array(
                'message' => '<p class="text-success">Email Disponible</p>',
                'data' =>'success',
            );
        
        } else {
        
            $data = array(
                'message' => '<p class="text-danger">El email ya existe, por favor ingresa uno diferente.</p>',
                'data' => 'error'
            );
        
        }
        
        wp_send_json( $data );
    }
    
}

add_action('wp_ajax_nopriv_account_register', array( 'Blog_Register', 'account_register' ) );
add_action('wp_ajax_account_register', array( 'Blog_Register', 'account_register' ) );

add_action('wp_ajax_nopriv_verify_email_address', array( 'Blog_Register', 'verify_email_address' ) );
add_action('wp_ajax_verify_email_address', array( 'Blog_Register', 'verify_email_address' ) );