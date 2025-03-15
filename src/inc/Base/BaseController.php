<?php

/**
 * @package TourBooking
 */

namespace Inc\Base;

class BaseController
{
    public $plugin;
    public $plugin_url;
    public $plugin_path;
    public $ajax_url;

    public $prec_settings;

    public function __construct()
    {
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 3));
        $this->plugin_url  = plugin_dir_url(dirname(__FILE__, 3));
        $this->ajax_url      = admin_url('admin-ajax.php');
        $this->plugin      = plugin_basename(dirname(__FILE__, 4)) . '/patient-records.php';

        $this->settingsOptions();
    }

    public function settingsOptions()
    {
        $this->prec_settings = [
            'patient_records_cpt'       => 'Activate Patient Records CPT',
        ];
    }
}
