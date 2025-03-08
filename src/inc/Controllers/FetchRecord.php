<?php

/**
 * @package TourBooking
 */

namespace Inc\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\CptQueryHandler;

class FetchRecord extends BaseController
{

    public $query_class;

    public function register()
    {
        // Class Variables
        $this->query_class = new CptQueryHandler();
        $results = $this->query_class
            ->setPostType('record')
            ->whereMeta('__member', 'rohan', 'LIKE')
            ->getResults();

        echo "<pre>";
        print_r($results);
        echo "</pre>";

        \wp_die();
    }
}
