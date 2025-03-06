<?php
/**
 * @package TourBooking
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class SettingsLinks extends BaseController
{

    public function register()
    {
        add_filter( "plugin_action_links_$this->plugin", [ $this, 'settings_link' ] );
    }

    public function settings_link( $links )
    {
        $settings_link = '<a style="color:green" href="admin.php?page=tour_booking">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }
}
