<?php
/*
 * Plugin Name:       ! Patient Records
 * Description:       Handle patient services and checkups.
 * Version:           0.01
 * Author:            Anonymous
 * Text Domain:       patient-records
 * Domain Path:       /languages
 * Prefix:       prec
 */

// Prevent direct access to the file
defined('ABSPATH') or die;

// Add Composer autoload
require_once dirname(__FILE__) . '/vendor/autoload.php';


/**
 * The code that runs during plugin activation
 */
function activatePrecPlugin()
{
    Inc\Base\Activate::activate();
}

register_activation_hook(__FILE__, 'activatePrecPlugin');

/**
 * The code that runs during plugin deactivation
 */
function deactivatePrecPlugin()
{
    Inc\Base\Deactivate::deactivate();
}

register_deactivation_hook(__FILE__, 'deactivatePrecPlugin');

// Initialize all the core classes of the plugin
if (class_exists('Inc\\Init')) {
    Inc\Init::registerServices();
}

if (is_admin()) {
    function removeMenusForSubscribers()
    {
        if (current_user_can('subscriber')) {
            remove_menu_page('index.php');                   // Dashboard
            remove_menu_page('edit.php');                      // Posts
            remove_menu_page('upload.php');                    // Media
            remove_menu_page('edit.php?post_type=page');         // Pages
            remove_menu_page('edit-comments.php');             // Comments
            remove_menu_page('tools.php');                     // Tools
            remove_menu_page('options-general.php');           // Settings
        }
    }
    add_action('admin_menu', 'removeMenusForSubscribers', 999);
}
