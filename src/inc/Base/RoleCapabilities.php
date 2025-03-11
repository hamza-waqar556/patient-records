<?php

namespace Inc\Base;

class RoleCapabilities
{
    public function register()
    {
        add_filter('user_has_cap', [$this, 'allowSubscriberEditForCpt'], 10, 4);
        add_filter('post_row_actions', [$this, 'removeTrashLinkForSubscribers'], 10, 2);
    }
    

    function removeTrashLinkForSubscribers($actions, $post)
    {
        $user = wp_get_current_user();
        // Check if the user has 'subscriber' as one of their roles and that the post type is 'record'
        if (in_array('subscriber', (array) $user->roles) && $post->post_type === 'record') {
            unset($actions['trash']);
        }
        return $actions;
    }


    function allowSubscriberEditForCpt($allcaps, $caps, $args, $user)
    {
        // Check if the requested capability is one of the edit capabilities
        // and that a post ID is being checked.
        if (isset($args[0]) && in_array($args[0], ['edit_post', 'edit_page']) && isset($args[2])) {
            $post = get_post($args[2]);
            if ($post && $post->post_type === 'record') { // change 'record' to your CPT slug if different
                // If the user is a subscriber, grant edit capability for this CPT post.
                if (in_array('subscriber', (array) $user->roles)) {
                    $allcaps[$caps[0]] = true;
                }
            }
        }
        return $allcaps;
    }
}
