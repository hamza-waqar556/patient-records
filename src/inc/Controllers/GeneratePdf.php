<?php

namespace Inc\Controllers;

use Dompdf\Dompdf;
use Inc\Base\BaseController;

class GeneratePdf extends BaseController
{
    /**
     * Generate a PDF file from a given data array.
     *
     * @param array $data Data to populate the template.
     * @return string Path to the saved PDF.
     */
    public function generate($data)
    {
        // Compute the template file path.
        $template_path = $this->plugin_path . 'src/templates/pdf.php';
        if (!$template_path || !file_exists($template_path)) {
            error_log('PDF template file not found: ' . plugin_dir_path(__FILE__) . '/../../templates/pdf.php');
            return '';
        }
        error_log('PDF template path: ' . $template_path);

        // Make $data available to the template
        ob_start();
        include $template_path;
        $html = ob_get_clean();
        error_log('PDF Template HTML: ' . $html);

        // Instantiate and configure Dompdf.
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();

        // Get PDF output.
        $pdf_output = $dompdf->output();
        if (empty($pdf_output)) {
            error_log('Dompdf generated empty output.');
        }

        // Save the PDF in the uploads directory.
        $upload_dir = wp_upload_dir();
        // $pdf_path   = trailingslashit($upload_dir['path']) . 'progress-note-' . time() . '.pdf';

        // addtion things
        $timestamp = date('Y-m-d_H-i-s'); // Example: 2025-03-11_14-30-00
        $member_id = isset($data['member']) ? sanitize_text_field($data['member']) : 'unknown';
        $mhwin_id = isset($data['mhwin_id']) ? sanitize_text_field($data['mhwin_id']) : 'NA';

        // Create a dynamic filename
        $pdf_filename = "progress-note_{$member_id}_{$mhwin_id}_{$timestamp}.pdf";
        $pdf_path = trailingslashit($upload_dir['path']) . $pdf_filename;


        file_put_contents($pdf_path, $pdf_output);

        return $pdf_path;
    }


    /**
     * Directly output a generated PDF to the browser.
     *
     * @param array $data Data to populate the template.
     */
    public function outputPdf($data)
    {
        $template_path = $this->plugin_path . 'src/templates/pdf.php';
        if (! file_exists($template_path)) {
            error_log('PDF template file not found: ' . $template_path);
            wp_die('Template not found');
        }
        ob_start();
        include $template_path;
        $html = ob_get_clean();
        error_log('PDF Template HTML: ' . $html);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();

        $pdf_output = $dompdf->output();
        if (empty($pdf_output)) {
            error_log('Dompdf generated empty output.');
            wp_die('Error generating PDF');
        }

        $timestamp = date('Y-m-d_H-i-s');
        $member_id = isset($data['member']) ? sanitize_text_field($data['member']) : 'unknown';
        $mhwin_id = isset($data['mhwin_id']) ? sanitize_text_field($data['mhwin_id']) : 'NA';
        $pdf_filename = "progress-note_{$member_id}_{$mhwin_id}_{$timestamp}.pdf";

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdf_filename . '"');
        header('Content-Length: ' . strlen($pdf_output));
        echo $pdf_output;
        exit;
    }
}
