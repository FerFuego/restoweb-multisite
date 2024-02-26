<?php
/**
 * FC Delivery Module
 *
 * Plugin Name: FC Delivery Module
 * Plugin URI:  
 * Description: Enables the WordPress FC Delivery Module
 * Version:     1.0
 * Author:      WordPress Contributors
 * Author URI:  
 * License:     
 * License URI: 
 */
global $wpdb;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Delivery
{

    /**
     * A reference to an instance of this class.
     */
    private static $instance;

    /**
     * Returns an instance of this class.
     */
    public static function get_instance() {

        if (null == self::$instance) {
            self::$instance = new Delivery();
        }

        return self::$instance;
    }

    /**
     * Initializes the plugin by setting actions and administration functions.
     */
    private function __construct() {

        if ( ! is_admin() ) {
            return;
        }

        if ( ! is_user_logged_in() ) {
            return;
        }

        add_action('admin_menu', array($this, 'theme_options_menu'));
        add_action('admin_enqueue_scripts', array($this, 'admin_style'));
        add_action('init', $this->add_custom_acf());
        add_action('init', $this->register_roles());
        add_filter('acf/load_field/key=field_60c7a38a28e4c', array($this, 'acf_load_delivery_options'));
        add_filter('acf/load_field/key=field_6078678687688e4c', array($this, 'acf_load_mozo_options'));
    }

    /**
     * Register a custom menu page.
     */
    public function theme_options_menu() {
        
        add_menu_page( 
            __("Delivery",'fc_delivery_module'), 
            __("Delivery",'fc_delivery_module'), 
            'manage_options', 
            'fc-delivery-module/pages/delivery.php', 
            false, 
            'dashicons-buddicons-buddypress-logo', 
            '100' 
        );

        add_menu_page( 
            __("Mozo",'fc_delivery_module'), 
            __("Mozo",'fc_delivery_module'), 
            'manage_options', 
            'fc-delivery-module/pages/mozo.php', 
            false, 
            'dashicons-buddicons-buddypress-logo', 
            '100' 
        );
    }

    public function admin_style() {
        wp_enqueue_style('admin-styles', '/wp-content/plugins/fc-delivery-module/css/admin.css');
    }

    public function add_custom_acf() {

        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array(
                'key' => 'group_60c7a38757ba9',
                'title' => 'Envio',
                'fields' => array(
                    array(
                        'key' => 'field_60c7a38a28e4c',
                        'label' => '',
                        'name' => 'seleccionar_delivery',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                        ),
                        'default_value' => array(                            
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 1,
                        'ajax' => 0,
                        'return_format' => 'value',
                        'placeholder' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'shop_order',
                        ),
                    ),
                ),
                'menu_order' => 1,
                'position' => 'side',
                'style' => 'default',
                'label_placement' => 'left',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
            acf_add_local_field_group(array(
                'key' => 'group_60c7ai789789798ba9',
                'title' => 'Mozo',
                'fields' => array(
                    array(
                        'key' => 'field_6078678687688e4c',
                        'label' => '',
                        'name' => 'seleccionar_mozo',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                        ),
                        'default_value' => array(                            
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 1,
                        'ajax' => 0,
                        'return_format' => 'value',
                        'placeholder' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'shop_order',
                        ),
                    ),
                ),
                'menu_order' => 1,
                'position' => 'side',
                'style' => 'default',
                'label_placement' => 'left',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
        endif;
    }

    public function register_roles() {
        add_role( 'delivery', 'Delivery', array( 'read' => true, 'level_1' => true ) );
        add_role( 'mozo', 'Mozo', array( 'read' => true, 'level_1' => true ) );
    }

    public function acf_load_delivery_options( $field ) {

        $users = array();

        $blogusers = get_users( array( 'role__in' => array( 'delivery' ) ) );

        $field['choices']['Seleccionar Delivery'] = 'Seleccionar Delivery';

        foreach ( $blogusers as $user ):
            $field['choices'][ $user->ID ] = $user->display_name;
        endforeach;
    
        return $field;
    }

    public function acf_load_mozo_options( $field ) {

        $users = array();

        $blogusers = get_users( array( 'role__in' => array( 'mozo' ) ) );

        $field['choices']['Seleccionar Mozo'] = 'Seleccionar Mozo';

        foreach ( $blogusers as $user ):
            $field['choices'][ $user->ID ] = $user->display_name;
        endforeach;
    
        return $field;
    }

}

add_action('wp_loaded', array('Delivery', 'get_instance'));