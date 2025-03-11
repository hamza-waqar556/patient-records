<?php
/*
 * Plugin Name:       Patient Records
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
