<?php

namespace Inc\Components;

use Inc\Base\BaseController;

class ViewPdf extends BaseController {

    /**
     * Constructor to initialize the shortcode.
     */
    public function register() {
        add_shortcode( 'pdf_view', [ $this, 'render_shortcode' ] );
    }

    /**
     * Renders the shortcode output.
     *
     * @return string HTML output of the shortcode.
     */
    public function render_shortcode(): string
    {
        ob_start();

        // Check if POST data is present
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            // Sanitize and retrieve POST data
            $data = [
                'post_id'   => absint( $_POST['post_id'] ?? 0 ),
                'member'    => sanitize_text_field( $_POST['member'] ?? '' ),
                'mhwin_id'  => sanitize_text_field( $_POST['mhwin_id'] ?? '' ),
                'post_data' => wp_unslash( $_POST['post_data'] ?? '' ),
            ];

            // Normalize post_data to JSON string if it's an array
            if ( is_array( $data['post_data'] ) ) {
                $data['post_data'] = wp_json_encode( $data['post_data'] );
            }

            $postData = json_decode( $data['post_data'], true );

            // Define the path to the template file
            $template_path = $this->plugin_path . 'src/templates/view.php';
            $template_path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $template_path);

            // Check if the template file exists before including
            if ( file_exists( $template_path ) ) {
                include $template_path;
            } else {
                echo '<p>Template file not found.</p>';
            }
        } else {
            echo '<p>No data received.</p>';
        }

        return ob_get_clean();
    }
}
