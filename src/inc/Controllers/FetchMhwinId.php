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
     * Callback for fetching the latest MHWIN ID based on the member input.
     */
    public function fetchMhwinIds()
    {
// Check nonce for security.
        check_ajax_referer('fetch_mhwin_ids_nonce', 'security');

// Get the member input and sanitize it.
        $member_input = isset($_POST['member']) ? sanitize_text_field($_POST['member']) : '';
        $mhwin_option = null;

        if (!empty($member_input)) {

// Query for posts of type "record" where '__member' matches the input.
// WP_Query by default orders posts by date descending.
            $queryHandler = new CptQueryHandler();
            $results = $queryHandler
                ->setPostType('record')
                ->whereMeta('__member', $member_input, 'LIKE')
                ->getResults();

// Check if we have results. If so, pick the first result which we assume is the latest.
            if (!empty($results)) {
                $latest_result = $results[0];
                if (isset($latest_result['meta']['__mhwin_id']) && !empty($latest_result['meta']['__mhwin_id'])) {
                    $mhwin_option = [
                        'post_id' => $latest_result['ID'],
                        'mhwin_id' => $latest_result['meta']['__mhwin_id']
                    ];
                }
            }
        }

// Return the result wrapped in an array to maintain a consistent structure.
        wp_send_json_success($mhwin_option ? [$mhwin_option] : []);
    }
}
