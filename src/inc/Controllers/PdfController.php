<?php

namespace Inc\Controllers;

use \Inc\Controllers\GeneratePdf;

class PdfController
{

    public function register()
    {
        add_action('wp_ajax_generate_pdf', [$this, 'handle_generate_pdf']);
        add_action('wp_ajax_nopriv_generate_pdf', [$this, 'handle_generate_pdf']);

        add_action('wp_ajax_nopriv_download_pdf', [$this, 'handle_download_pdf']);
        add_action('wp_ajax_download_pdf', [$this, 'handle_download_pdf']);
    }

    public function handle_generate_pdf()
    {
        // Verify nonce.
        if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'generate_pdf_nonce')) {
            wp_send_json_error('Invalid nonce');
            return;
        }

        // Collect data from POST (or use values from the DB as needed).
        $data = [
            'member'   => sanitize_text_field($_POST['member'] ?? ''),
            'mhwin_id' => sanitize_text_field($_POST['mhwin_id'] ?? ''),
            'ami' => sanitize_text_field($_POST['ami'] ?? ''),
            'post_data' => wp_unslash($_POST['post_data'] ?? ''),
            // You can add additional fields here.
            'post_id' => absint($_POST['post_id'] ?? '')
        ];

        // Generate the PDF.
        $pdf_generator = new GeneratePdf();
        $pdf_path = $pdf_generator->generate($data);

        // Prepare email details.
        $to      = 'chrislintherapy@gmail.com'; // Replace with the patient email dynamically if available.
        $subject = 'Your Progress Note';
        $message = 'Please find attached your progress note.';
        $headers = ['Content-Type: text/html; charset=UTF-8'];
        $attachments = [$pdf_path];

        if (wp_mail($to, $subject, $message, $headers, $attachments)) {
            wp_send_json_success('Email sent successfully.');
        } else {
            wp_send_json_error('Email sending failed.');
        }
        wp_die();
    }

    public function handle_download_pdf()
    {
        // Verify nonce
        if (! isset($_GET['nonce']) || ! wp_verify_nonce($_GET['nonce'], 'download_pdf_nonce')) {
            wp_die('Invalid nonce');
        }

        // Gather data from GET parameters (or adjust as needed)
        $data = [
            'member'   => sanitize_text_field($_GET['member'] ?? ''),
            'mhwin_id' => sanitize_text_field($_GET['mhwin_id'] ?? ''),
            // Add additional fields if needed.
            'post_data' => wp_unslash($_GET['post_data'] ?? ''),
            'post_id' => absint($_GET['post_id'] ?? 0)
        ];

        $pdf_generator = new GeneratePdf();
        $pdf_generator->outputPdf($data);
    }
}
