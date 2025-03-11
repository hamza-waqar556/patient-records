<?php

/**
 * @package TourBooking
 */

namespace Inc\Base;

class Activate
{
    /**
     * Plugin activation routine.
     *
     * Flushes rewrite rules, sets default options, and processes JSON imports.
     *
     * @return void
     */
    public static function activate()
    {
        flush_rewrite_rules();
    }
    
}
