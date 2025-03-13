<?php

namespace Inc\Base;

class RoleCapabilities
{
    public function register()
    {
        // Grant subscribers basic editing/publishing capabilities on admin_init.
        add_action('admin_init', [$this, 'grantSubscriberCapabilities']);
        // Override capability checks to allow subscribers to edit, update, and publish CPT posts directly.
        add_filter('user_has_cap', [$this, 'allowSubscriberEditAndPublishForCpt'], 10, 4);
        // Optionally, remove the Trash link from the post list for subscribers.
        add_filter('post_row_actions', [$this, 'removeTrashLinkForSubscribers'], 10, 2);
    }
    
    /**
     * Grants subscribers the default editing and publishing capabilities.
     */
    public function grantSubscriberCapabilities()
    {
        $role = get_role('subscriber');
        if ($role) {
            // Subscribers normally have 'read' but not editing/publishing rights.
            $role->add_cap('read');
            $role->add_cap('edit_posts');    // Allow editing posts.
            $role->add_cap('publish_posts'); // Allow direct publishing.
        }
    }
    
    /**
     * Removes the Trash link from the post row actions for subscribers on CPT "record".
     *
     * @param array $actions Row actions.
     * @param \WP_Post $post The current post object.
     * @return array Modified row actions.
     */
    public function removeTrashLinkForSubscribers($actions, $post)
    {
        $user = wp_get_current_user();
        if (in_array('subscriber', (array) $user->roles) && $post->post_type === 'record') {
            unset($actions['trash']);
        }
        return $actions;
    }
    
    /**
     * Grants subscribers the ability to edit, update, and publish CPT posts.
     *
     * This filter checks if the requested capability is one of the editing or publishing keys
     * for a post of type "record". If so, and the user is a subscriber, it grants the requested
     * capability(s) so that the post can be directly published.
     *
     * @param array    $allcaps All capabilities for the user.
     * @param array    $caps    Capabilities being checked.
     * @param array    $args    Additional arguments (first element is the requested capability,
     *                          third element is the post ID).
     * @param \WP_User $user    The current user object.
     * @return array Modified capabilities.
     */
    public function allowSubscriberEditAndPublishForCpt($allcaps, $caps, $args, $user)
    {
        // Define the capabilities we want to override.
        $capabilitiesToOverride = [
            'edit_post', 
            'edit_page', 
            'edit_posts', 
            'edit_published_post', 
            'publish_posts'
        ];
        
        if (isset($args[0]) && in_array($args[0], $capabilitiesToOverride) && isset($args[2])) {
            $post = get_post($args[2]);
            if ($post && $post->post_type === 'record') {
                if (in_array('subscriber', (array)$user->roles)) {
                    // Grant all requested capabilities.
                    foreach ($caps as $cap) {
                        $allcaps[$cap] = true;
                    }
                }
            }
        }
        
        return $allcaps;
    }
}
