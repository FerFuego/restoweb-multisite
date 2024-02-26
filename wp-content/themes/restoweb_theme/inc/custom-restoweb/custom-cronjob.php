<?php
/*--------------------------------------------------
                    Schedule
---------------------------------------------------*/
add_action('init', 'init_function');
function init_function() {
    if ( !wp_next_scheduled('custom_updater_network_accounts') )
        wp_schedule_event(time(), 'every_minute', 'custom_updater_network_accounts');
}

register_deactivation_hook( __FILE__, 'my_deactivation' );
function my_deactivation() {
    wp_clear_scheduled_hook( 'custom_updater_network_accounts' );
}


/**
 * Cron Job function
 */
add_action( 'custom_updater_network_accounts', 'custom_updater_network_accounts' );

function custom_updater_network_accounts () {
    $subscription_status = [];
    // Array of WP_User objects.
    $blogusers = get_users([ 
        'role__in' => 'subscriber'
    ]);

    foreach ( $blogusers as $user ) :
        # Get blog of user
        $blog_id = get_user_meta($user->ID, 'blog_id', true);
        # Get Subscriptions by user 
        $subscriptions = Subscriptio_User::find_subscriptions(false, $user->ID);

        foreach ($subscriptions as $subscription) :
            $subscription_status[] = $subscription->get_formatted_status(true);
        endforeach;
        
        if ( in_array('Active', $subscription_status)) {
            # Assign user superadmin to new blog
		    add_user_to_blog ($blog_id, $user->ID, "administrator");
            # Restore live blog
            update_blog_status($blog_id, 'deleted', false );
            update_blog_status($blog_id, 'published', true );
             # Roles & Capabilities
            //switch_to_blog($blog_id);
            //$wp_user_object = new WP_User($user->ID);
            //$wp_user_object->set_role('administrator');
            //restore_current_blog();
        } else {
            // Desactive user blog
            update_blog_status($blog_id, 'deleted', true );
        }
    endforeach;
}