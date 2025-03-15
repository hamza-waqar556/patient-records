<?php

/**
 * @package TourBooking
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);
    }

    public function enqueueAdmin()
    {

        wp_enqueue_style('admin', $this->plugin_url . 'src/assets/admin/scss/admin.min.css', [], '1.0.0');

        wp_enqueue_script('admin', $this->plugin_url . 'src/assets/admin/js/admin.min.js', ['jquery'], '1.0.0', false);

        wp_enqueue_script('html2pdf', $this->plugin_url . 'src/assets/lib/html2pdf/pdf.min.js', ['jquery'], '1.0.0', false);


        // Define jQuery ($) var as global
        wp_add_inline_script('jquery', 'var $ = jQuery;');

        $rest_routes = [];

        $plugin = [
            'path' => $this->plugin_path,
            'url'  => $this->plugin_url,
            'ajax_url' => $this->ajax_url,
        ];


        // wp_localize_script('admin', 'AIOB', [
        //     'routes' => $rest_routes,
        //     'plugin'   => $plugin,
        //     'nonce'    => wp_create_nonce('wp_rest'),
        // ]);

        wp_localize_script('admin', 'AIOB', [
            'routes'  => $rest_routes,
            'plugin'  => $plugin,
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('generate_pdf_nonce'),
            'nonce_mhwin'   => wp_create_nonce("fetch_mhwin_ids_nonce"),
            'autofill_nonce' => wp_create_nonce('autofill_nonce'),
            'download_pdf_nonce' => wp_create_nonce('download_pdf_nonce'),
        ]);
    }
}
