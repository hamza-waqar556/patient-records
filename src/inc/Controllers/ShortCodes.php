<?php

/**
 * @package TourBooking
 */

namespace Inc\Controllers;

use \Inc\Base\BaseController;

class ShortCodes extends BaseController
{
    public function register()
    {
        $this->initializeShortcodes();
    }

    private function initializeShortcodes()
    {
        $shortcodeFiles = glob($this->plugin_path . 'src/templates/short-codes/*.php');

        foreach ($shortcodeFiles as $file)
        {
            $shortcodeName = basename($file, '.php');
            add_shortcode($shortcodeName, function () use ($file)
            {
                ob_start();
                include $file;
                return ob_get_clean();
            });
        }
    }
}
