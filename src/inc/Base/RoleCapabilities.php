<?php

namespace Inc\Base;

/**
 * Class EditorCapabilities
 *
 * Restricts the Editor role to only manage the custom post type 'record':
 *  - Removes all delete/trash capabilities on activation
 *  - Hides other admin menus
 *  - Redirects list screens to 'record'
 *  - Removes Trash links and bulk delete for 'record'
 */
class RoleCapabilities {
    /**
     * Register all hooks
     */
    public function register() {
        // Restrict menus for Editors
        add_action('admin_menu', [$this, 'restrictEditorMenus'], 999);
        // Force list screens to CPT 'record'
        add_action('pre_get_posts', [$this, 'forceRecordList'], 1);
        // Remove Trash link per row for 'record'
        add_filter('post_row_actions', [$this, 'removeTrashLinkForEditors'], 10, 2);
        // Remove bulk Trash action on 'record' list
        add_filter('bulk_actions-edit-record', [$this, 'removeBulkTrashAction'], 10, 1);
    }

    /**
     * Plugin activation: remove delete/trash capabilities from Editor
     */
    public static function activate() {
        $role = get_role('editor');
        if (! $role) {
            return;
        }

        // Capabilities to revoke
        $delete_caps = [
            // Built-in posts
            'delete_posts',
            'delete_others_posts',
            'delete_published_posts',
            'delete_private_posts',
            // Built-in pages
            'delete_pages',
            'delete_others_pages',
            'delete_published_pages',
            'delete_private_pages',
            // Custom post type 'record' (map_meta_cap => true)
            'delete_records',
            'delete_others_records',
            'delete_published_records',
            'delete_private_records',
        ];

        foreach ($delete_caps as $cap) {
            $role->remove_cap($cap);
        }
    }

    /**
     * Keep only the 'record' CPT menu for Editors
     */
    public function restrictEditorMenus() {
        if (! current_user_can('editor')) {
            return;
        }

        // Slugs of menus to remove
        $menus_to_remove = [
            'index.php',                // Dashboard
            'edit.php',                 // Posts
            'upload.php',               // Media
            'edit.php?post_type=page',  // Pages
            'edit-comments.php',        // Comments
            'themes.php',               // Appearance
            'plugins.php',              // Plugins
            'users.php',                // Users
            'tools.php',                // Tools
            'options-general.php',      // Settings
        ];

        foreach ($menus_to_remove as $slug) {
            remove_menu_page($slug);
        }
    }

    /**
     * Force Editors to the 'record' list screen
     *
     * @param \WP_Query $query
     */
    public function forceRecordList($query) {
        if (! is_admin() || ! $query->is_main_query()) {
            return;
        }

        if (! current_user_can('editor')) {
            return;
        }

        $screen = get_current_screen();
        if ($screen && $screen->post_type !== 'record') {
            wp_safe_redirect(admin_url('edit.php?post_type=record'));
            exit;
        }
    }

    /**
     * Remove the Trash link from each row for 'record' CPT
     *
     * @param array    $actions Row actions
     * @param \WP_Post $post    Current post object
     * @return array Modified row actions
     */
    public function removeTrashLinkForEditors($actions, $post) {
        if (current_user_can('editor') && $post->post_type === 'record') {
            unset($actions['trash']);
        }
        return $actions;
    }

    /**
     * Remove the Bulk Trash action from the 'record' list screen
     *
     * @param array $actions Bulk actions
     * @return array Modified bulk actions
     */
    public function removeBulkTrashAction($actions) {
        if (isset($actions['trash'])) {
            unset($actions['trash']);
        }
        return $actions;
    }
}

