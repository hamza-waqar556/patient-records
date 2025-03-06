<?php

namespace Inc\Api;

use \Inc\Base\BaseController;

class MetaBoxGenerator extends BaseController
{
    private $meta_boxes = []; // Store all configurations

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'createMetaBoxes']);
        add_action('save_post', [$this, 'saveFields']);
    }

    public function setConfig($cpt, $fields, $nonce_name, $nonce_action, $template_path, $title)
    {
        $this->meta_boxes[] = [
            'cpt' => $cpt,
            'fields' => $fields,
            'nonce_name' => $nonce_name,
            'nonce_action' => $nonce_action,
            'template_path' => $template_path,
            'title' => $title,
        ];

        return $this; // Enable method chaining
    }

    public function createMetaBoxes()
    {
        foreach ($this->meta_boxes as $meta_box)
        {
            add_meta_box(
                "{$meta_box['cpt']}_" . md5($meta_box['template_path']), // Unique ID
                $meta_box['title'], // Dynamic title
                function ($post) use ($meta_box)
                {
                    require_once "$this->plugin_path/src/templates/meta-box/{$meta_box['template_path']}";
                },
                $meta_box['cpt'],
                'normal',
                'high'
            );
        }
    }

    public function saveFields($post_id)
    {
        // Prevent autosave, revision, or wrong post type
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'record') return;
        if (!current_user_can('edit_post', $post_id)) return;

        foreach ($this->meta_boxes as $meta_box)
        {
            // Validate nonce for each meta box individually
            if (
                !isset($_POST[$meta_box['nonce_name']]) ||
                !wp_verify_nonce($_POST[$meta_box['nonce_name']], $meta_box['nonce_action'])
            )
            {
                continue;
            }

            foreach ($meta_box['fields'] as $field)
            {
                if (isset($_POST[$field]))
                {
                    if (is_array($_POST[$field]))
                    {
                        // Sanitize array values
                        $sanitized_array = array_map('sanitize_text_field', $_POST[$field]);
                        update_post_meta($post_id, '_' . $field, $sanitized_array);
                    }
                    else
                    {
                        update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
                    }
                }
                else
                {
                    delete_post_meta($post_id, '_' . $field);
                }
            }
        }
    }
}
