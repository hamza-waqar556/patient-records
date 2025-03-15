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
        $mhwin_options = [];

        if (! empty($member_input))
        {
            // Use your CptQueryHandler to query posts of type "record"
            // where the meta key '__member' matches the input.
            $queryHandler = new CptQueryHandler();
            $results = $queryHandler
                ->setPostType('record')
                ->whereMeta('__member', $member_input, 'LIKE')
                ->getResults();

            // Loop through the results to collect the MHWIN IDs along with their post IDs.
            foreach ($results as $result)
            {
                if (isset($result['meta']['__mhwin_id']) && ! empty($result['meta']['__mhwin_id']))
                {
                    // Build an option with post_id as the value and mhwin_id as the text.
                    $mhwin_options[] = [
                        'post_id'  => $result['ID'],
                        'mhwin_id' => $result['meta']['__mhwin_id']
                    ];
                }
            }
        }

        // Return the MHWIN options as a JSON response.
        wp_send_json_success($mhwin_options);
    }
}
