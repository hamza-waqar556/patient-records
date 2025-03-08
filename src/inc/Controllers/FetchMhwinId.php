<?php

namespace Inc\Controllers;

use Inc\Api\CptQueryHandler;

class FetchMhwinId
{

    public function __construct()
    {
        // Register AJAX action for logged-in users.
        add_action('wp_ajax_fetch_mhwin_ids', [$this, 'fetchMhwinIds']);
    }

    /**
     * Callback for fetching MHWIN IDs based on the member input.
     */
    public function fetchMhwinIds()
    {
        // Check nonce for security.
        check_ajax_referer('fetch_mhwin_ids_nonce', 'security');

        // Get the member input and sanitize it.
        $member_input = isset($_POST['member']) ? sanitize_text_field($_POST['member']) : '';
        $mhwin_ids = [];

        if (! empty($member_input))
        {
            // Use your CptQueryHandler to query posts of type "record"
            // where the meta key '__member' matches the input.
            $queryHandler = new \Inc\Api\CptQueryHandler();
            $results = $queryHandler
                ->setPostType('record')
                ->whereMeta('__member', $member_input, 'LIKE')
                ->getResults();

            // Loop through the results to collect only the MHWIN IDs.
            foreach ($results as $result)
            {
                // Adjust the key as needed. Here we check for __mhwin_id.
                if (isset($result['meta']['__mhwin_id']) && !empty($result['meta']['__mhwin_id']))
                {
                    if (! in_array($result['meta']['__mhwin_id'], $mhwin_ids))
                    {
                        $mhwin_ids[] = $result['meta']['__mhwin_id'];
                    }
                }
            }
        }

        // Return the MHWIN IDs as a JSON response.
        wp_send_json_success($mhwin_ids);
    }
}
