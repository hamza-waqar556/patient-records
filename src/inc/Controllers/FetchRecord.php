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

        // Calls

    }

    public function setArgs()
    {
    }

    public function fetchPostData()
    {
        $results = $this->query_class
            ->setPostType('record')
            // ->postId(65)
            ->whereMeta('__mhwin_id', '')
            ->getResults();
    }
}
