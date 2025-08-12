<?php
/*
 *
 * * Enqueue scripts on Wesmplfyite
 *
 *  */

namespace SMPLFY\appsimplifybiz;
function enqueue_appsimplifybiz_frontend_scripts()
{
    global $current_user;
    global $post;
    $current_user = wp_get_current_user();

    wp_enqueue_script('heartbeat');
    //Register script with the 'jquery' and 'heartbeat' to ensure those scripts are loaded before wp-heartbeat-example.js is executed
    wp_register_script('smplfy-demo-heartbeat-script', SMPLFY_NAME_PLUGIN_URL . 'public/js/wp-heartbeat-example.js', array(
        'jquery',
        'heartbeat'
    ), null, true);


    wp_register_style('smplfy-frontend-styles', SMPLFY_NAME_PLUGIN_URL . 'public/css/frontend.css');
    wp_enqueue_style('smplfy-frontend-styles');

    wp_register_script('smplfy-demo-frontend-script', SMPLFY_NAME_PLUGIN_URL . 'public/js/frontend.js', array('jquery'), null, true);
    wp_enqueue_script('smplfy-demo-frontend-script');

    wp_register_script('smplfy-hide-coach-edit-script', SMPLFY_NAME_PLUGIN_URL . 'public/js/hide_edit_for_coach.js', array('jquery'), null, true);
    wp_enqueue_script('smplfy-hide-coach-edit-script');
    //Ensure our heartbeat script only runs on the page we want it to, to avoid excessive computation on the client side
    if ($post->ID == 999) {
        wp_enqueue_script('smplfy-demo-heartbeat-script');
        // Localize the script with data. Gives our script on the client side data from the backend to use
        wp_localize_script('smplfy-demo-heartbeat-script', 'heartbeat_object',
            array(
                'user_id' => $current_user->ID,
                'page_id' => $post->ID
            )
        );
    }


}

add_action('wp_enqueue_scripts', 'SMPLFY\appsimplifybiz\enqueue_appsimplifybiz_frontend_scripts');
