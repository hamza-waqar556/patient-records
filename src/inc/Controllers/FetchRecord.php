<?php

/**
 * @package TourBooking
 */

namespace Inc\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\CptQueryHandler;

class FetchRecord extends BaseController
{
    public function register()
    {
        $results = (new CptQueryHandler())
            ->setPostType('record')
            // ->postId(65)
            ->whereMeta('__mhwin_id', '')
            ->getResults();

        echo "<pre>";
        print_r($results);
        echo "</pre>";
        wp_die();
    }
}
