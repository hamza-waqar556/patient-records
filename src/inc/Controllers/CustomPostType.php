<?php

/**
 * @package TourBooking
 */

namespace Inc\Controllers;

use \Inc\Base\BaseController;

class CustomPostType extends BaseController
{
    public $custom_post_types = [];

    public function register()
    {
        // Store Custom Post Types Before Registering
        $this->storeCustomPostTypes();

        // Register Custom Post Types
        if (! empty($this->custom_post_types)) {
            add_action('init', [$this, 'registerCustomPostTypes']);
        }
    }

    public function storeCustomPostTypes()
    {

        $cpt_options = $this->prec_settings;

        $cpts = [
            // Hotels CPT with a custom menu position and hiding from nav menus
            'patient_records_cpt' => $this->createCptArgs('Patient Record', 'Patient Records', 'record', 'dashicons-list-view', []),
        ];

        foreach ($cpt_options as $option_key => $post_type) {
            $this->custom_post_types[$option_key] = $cpts[$option_key];
        }
    }

    public function registerCustomPostTypes()
    {
        foreach ($this->custom_post_types as $post_type) {
            register_post_type(
                $post_type['post_type'],
                [
                    'labels'              => [
                        'name'                  => $post_type['name'],
                        'singular_name'         => $post_type['singular_name'],
                        'menu_name'             => $post_type['menu_name'],
                        'name_admin_bar'        => $post_type['name_admin_bar'],
                        'archives'              => $post_type['archives'],
                        'attributes'            => $post_type['attributes'],
                        'parent_item_colon'     => $post_type['parent_item_colon'],
                        'all_items'             => $post_type['all_items'],
                        'add_new_item'          => $post_type['add_new_item'],
                        'add_new'               => $post_type['add_new'],
                        'new_item'              => $post_type['new_item'],
                        'edit_item'             => $post_type['edit_item'],
                        'update_item'           => $post_type['update_item'],
                        'view_item'             => $post_type['view_item'],
                        'view_items'            => $post_type['view_items'],
                        'search_items'          => $post_type['search_items'],
                        'not_found'             => $post_type['not_found'],
                        'not_found_in_trash'    => $post_type['not_found_in_trash'],
                        'featured_image'        => $post_type['featured_image'],
                        'set_featured_image'    => $post_type['set_featured_image'],
                        'remove_featured_image' => $post_type['remove_featured_image'],
                        'use_featured_image'    => $post_type['use_featured_image'],
                        'insert_into_item'      => $post_type['insert_into_item'],
                        'uploaded_to_this_item' => $post_type['uploaded_to_this_item'],
                        'items_list'            => $post_type['items_list'],
                        'items_list_navigation' => $post_type['items_list_navigation'],
                        'filter_items_list'     => $post_type['filter_items_list'],
                    ],
                    'label'               => $post_type['label'],
                    'description'         => $post_type['description'],
                    'supports'            => $post_type['supports'],
                    'taxonomies'          => $post_type['taxonomies'],
                    'hierarchical'        => $post_type['hierarchical'],
                    'public'              => $post_type['public'],
                    'show_ui'             => $post_type['show_ui'],
                    'show_in_menu'        => $post_type['show_in_menu'],
                    'menu_position'       => $post_type['menu_position'],
                    'show_in_admin_bar'   => $post_type['show_in_admin_bar'],
                    'show_in_nav_menus'   => $post_type['show_in_nav_menus'],
                    'can_export'          => $post_type['can_export'],
                    'has_archive'         => $post_type['has_archive'],
                    'exclude_from_search' => $post_type['exclude_from_search'],
                    'publicly_queryable'  => $post_type['publicly_queryable'],
                    'capability_type'     => $post_type['capability_type'],
                    'menu_icon'           => $post_type['menu_icon'],
                ],
            );
        }
    }

    /**
     * Generate custom post type arguments dynamically.
     *
     * This function helps in generating the arguments for registering custom post types.
     * It reduces code repetition by allowing dynamic insertion of singular and plural names.
     * Additionally, it supports overrides for any default argument, making it more flexible.
     *
     * @param string $singular   Singular name of the post type (e.g., "Hotel").
     * @param string $plural     Plural name of the post type (e.g., "Hotels").
     * @param string $post_type  The actual post type key (e.g., "hotel").
     * @param string $icon       Dashicon for the post type menu in the admin dashboard.
     * @param array  $overrides  Optional. Array of arguments to override default values.
     *
     * @return array The array of arguments for register_post_type().
     */
    function createCptArgs($singular, $plural, $post_type, $icon = 'dashicons-admin-post', $overrides = [])
    {
        // Default arguments for the CPT
        $args = [
            // Basic labels
            'post_type'             => $post_type,
            'name'                  => $plural,
            'singular_name'         => $singular,
            'menu_name'             => $plural,
            'name_admin_bar'        => $singular,
            'archives'              => "$singular Archives",
            'attributes'            => "$singular Attributes",
            'parent_item_colon'     => "Parent $singular",
            'all_items'             => "All $plural",
            'add_new_item'          => "Add New $singular",
            'add_new'               => 'Add New',
            'new_item'              => "New $singular",
            'edit_item'             => "Edit $singular",
            'update_item'           => "Update $singular",
            'view_item'             => "View $singular",
            'view_items'            => "View $plural",
            'search_items'          => "Search $plural",
            'not_found'             => "No $plural Found",
            'not_found_in_trash'    => "No $plural Found in Trash",

            // Featured image labels
            'featured_image'        => "$singular Featured Image",
            'set_featured_image'    => "Set $singular Featured Image",
            'remove_featured_image' => "Remove $singular Featured Image",
            'use_featured_image'    => "Use $singular Featured Image",

            // Item-related labels
            'insert_into_item'      => "Insert into $singular",
            'uploaded_to_this_item' => "Uploaded to this $singular",
            'items_list'            => "$plural List",
            'items_list_navigation' => "$plural List Navigation",
            'filter_items_list'     => "Filter $plural List",

            // General settings
            'label'                 => $singular,
            'description'           => "$plural Custom Post Type",
            'supports'              => ['title', 'thumbnail'], // Enable title & thumbnail support
            'taxonomies'            => [], // No default taxonomies
            'hierarchical'          => false, // Set to true for parent-child relationship

            // Visibility settings
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5, // Default position in admin menu
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true, // Enables archive pages
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type' => 'post',
            // Admin menu icon
            'menu_icon'             => $icon,
        ];


        // Merge default arguments with overrides (if provided)
        return array_merge($args, $overrides);
    }
}
