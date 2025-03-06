<?php

/**
 * @package TourBooking
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class FlightAirports extends BaseController
{

    // Classes
    public $settings;
    public $callbacks;
    public $callbacks_mngr;

    // Variables
    public $subpages = [  ];

    public function register()
    {

        // Classes
        $this->settings       = new SettingsApi();
        $this->callbacks      = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();

        // Methods
        $this->setSubpages();

        // Chaining Methods
        $this->settings->addSubPages( $this->subpages )->register();
    }

    public function setSubpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'edit.php?post_type=flight',
                'page_title'  => 'Airports',
                'menu_title'  => 'Flight Airports',
                'capability'  => 'manage_options',
                'menu_slug'   => 'flight_airports',
                'callback'    => [ $this->callbacks, 'flightAirports' ],
             ],
            [
                'parent_slug' => 'edit.php?post_type=flight',
                'page_title'  => 'Airlines',
                'menu_title'  => 'Flight Airlines',
                'capability'  => 'manage_options',
                'menu_slug'   => 'flight_airlines',
                'callback'    => [ $this->callbacks, 'flightAirlines' ],
             ],
         ];
    }

}
