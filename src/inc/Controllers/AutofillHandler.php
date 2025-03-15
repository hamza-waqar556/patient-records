<?php

namespace Inc\Controllers;

use \Inc\Api\CptQueryHandler;

class AutofillHandler
{

    public $query_class;

    public function register()
    {
        $this->query_class = new CptQueryHandler();

        // Register AJAX action for logged-in users.
        add_action('wp_ajax_autofill_post_data', [$this, 'handleAutofillPostData']);
    }

    /**
     * AJAX callback to handle the auto fill post data.
     */
    public function handleAutofillPostData()
    {
        check_ajax_referer('autofill_nonce', 'security');

        $current_post_id = isset($_POST['current_post_id']) ? absint($_POST['current_post_id']) : 0;
        $selected_post_id = isset($_POST['selected_post_id']) ? absint($_POST['selected_post_id']) : 0;

        if (!$current_post_id)
        {
            wp_send_json_success(['message' => "Could not get the POST ID's"]);
        }


        $data = $this->fetchSelectedPostData($selected_post_id);

        // Patient Details
        update_post_meta($current_post_id, '__member', $data['__member']);
        update_post_meta($current_post_id, '__mhwin_id', $data['__mhwin_id']);
        update_post_meta($current_post_id, '__date', $data['__date']);
        update_post_meta($current_post_id, '__crsp', $data['__crsp']);
        update_post_meta($current_post_id, '__facility', $data['__facility']);
        update_post_meta($current_post_id, '__goals', $data['__goals']);
        update_post_meta($current_post_id, '__pc_hours', $data['__pc_hours']);
        update_post_meta($current_post_id, '__cls_hours', $data['__cls_hours']);

        // Community Living Support Objectives
        update_post_meta($current_post_id, '__c', $data['__c']);

        // Personal Care Objectives
        update_post_meta($current_post_id, '__p', $data['__p']);



        // Now process $post_id as needed.
        // For now, we'll just return it.
        wp_send_json_success($data);
    }

    public function fetchSelectedPostData($post_id)
    {
        $results = $this->query_class
            ->setPostType('record')
            ->postId($post_id)
            ->getResults();

        $patient_records = get_post_meta($post_id, '__progress_reports', false);

        $results[0]['meta']['__progress_reports'] = $patient_records;

        $results = $results[0]['meta'];

        return $results;
    }
}
