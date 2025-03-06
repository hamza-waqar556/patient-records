<?php

/**
 * @package TourBooking
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{

    // Classes
    public $settings;
    public $callbacks;
    public $callbacks_mngr;

    // Variables
    public $pages = [];
    // public $subpages = [  ];

    public function register()
    {

        // Classes
        $this->settings       = new SettingsApi();
        $this->callbacks      = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();

        // Methods
        $this->setPages();
        // $this->setSubpages();
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        // Chaining Methods
        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->register();
    }

    // public function setSubpages()
    // {
    //     $this->subpages = [
    //         [
    //             'parent_slug' => 'tour_booking',
    //             'page_title'  => 'Custom Post Types',
    //             'menu_title'  => 'CPT',
    //             'capability'  => 'manage_options',
    //             'menu_slug'   => 'tour_cpt',
    //             'callback'    => [ $this->callbacks, 'cpt' ],
    //          ],
    //         [
    //             'parent_slug' => 'tour_booking',
    //             'page_title'  => 'Custom Taxonomy',
    //             'menu_title'  => 'Taxonomies',
    //             'capability'  => 'manage_options',
    //             'menu_slug'   => 'tour_taxonomies',
    //             'callback'    => [ $this->callbacks, 'taxonomies' ],
    //          ],
    //         [
    //             'parent_slug' => 'tour_booking',
    //             'page_title'  => 'Testing  Page',
    //             'menu_title'  => 'Testing',
    //             'capability'  => 'manage_options',
    //             'menu_slug'   => 'tour_testing',
    //             'callback'    => [ $this->callbacks, 'taxonomies' ],
    //          ],
    //      ];
    // }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'AIOB Settings',
                'menu_title' => 'AIOB Settings',
                'capability' => 'manage_options',
                'menu_slug'  => 'prec_settings',
                'callback'   => [$this->callbacks, 'dashboard'],
                'icon_url'   => 'dashicons-store',
                'position'   => 110,
            ],
        ];
    }

    public function setSettings()
    {

        $args = [[
            'option_group' => 'prec_settings',
            'option_name'  => 'prec_settings',
            'callback'     => [$this->callbacks_mngr, 'checkboxSanitize'],
        ]];

        $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = [
            [
                'id'       => 'prec_admin_index',
                'title'    => 'AIOB Settings',
                'callback' => [$this->callbacks_mngr, 'adminSectionManager'],
                'page'     => 'prec_settings',

            ],
        ];

        $this->settings->setSections($args);
    }

    public function setFields()
    {

        $args = [];

        foreach ($this->prec_settings as $key => $value)
        {
            $args[] = [
                'id'       => $key,
                'title'    => $value,
                'callback' => [$this->callbacks_mngr, 'checkboxField'],
                'page'     => 'prec_settings', // Page slug (must match setSections())
                'section'  => 'prec_admin_index', // Must match setSections() -> id
                'args'     => [
                    'option_name' => 'prec_settings', // Must match setSettings() -> option_name
                    'label_for'   => $key,
                    'class'       => 'ui-toggle',
                ],
            ];
        }

        $this->settings->setFields($args);
    }
}
