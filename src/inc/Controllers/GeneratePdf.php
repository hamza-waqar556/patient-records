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
        if (!$template_path || !file_exists($template_path))
        {
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
        if (empty($pdf_output))
        {
            error_log('Dompdf generated empty output.');
        }

        // Save the PDF in the uploads directory.
        $upload_dir = wp_upload_dir();
        $pdf_path   = trailingslashit($upload_dir['path']) . 'progress-note-' . time() . '.pdf';
        file_put_contents($pdf_path, $pdf_output);

        return $pdf_path;
    }
}
