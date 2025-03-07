<?php

namespace Inc\Api;

use \Inc\Base\BaseController;

class MetaBoxGenerator extends BaseController
{

    private $meta_boxes = []; // Store all configurations

    /**
     * Register meta boxes and the save_post action.
     */
    public function register()
    {
        add_action('add_meta_boxes', [$this, 'createMetaBoxes']);
        add_action('save_post', [$this, 'saveFields']);
    }

    /**
     * Set configuration for a meta box.
     *
     * @param string $cpt          Post type.
     * @param array  $fields       List of meta fields.
     * @param string $nonce_name   Nonce field name.
     * @param string $nonce_action Nonce action.
     * @param string $template_path Template file for meta box.
     * @param string $title        Meta box title.
     * @return $this
     */
    public function setConfig($cpt, $fields, $nonce_name, $nonce_action, $template_path, $title)
    {
        $this->meta_boxes[] = [
            'cpt'           => $cpt,
            'fields'        => $fields,
            'nonce_name'    => $nonce_name,
            'nonce_action'  => $nonce_action,
            'template_path' => $template_path,
            'title'         => $title,
        ];
        return $this;
    }

    /**
     * Create meta boxes based on configuration.
     */
    public function createMetaBoxes()
    {
        foreach ($this->meta_boxes as $meta_box)
        {
            add_meta_box(
                "{$meta_box['cpt']}_" . md5($meta_box['template_path']),
                $meta_box['title'],
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

    /**
     * Recursively sanitize data.
     */
    protected function recursive_sanitize($data)
    {
        if (is_array($data))
        {
            return array_map([$this, 'recursive_sanitize'], $data);
        }
        else
        {
            return sanitize_text_field($data);
        }
    }

    /**
     * Save meta fields on post save.
     */
    public function saveFields($post_id)
    {
        // Prevent autosave, revisions, or wrong post type.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'record') return;
        if (!current_user_can('edit_post', $post_id)) return;

        foreach ($this->meta_boxes as $meta_box)
        {
            // Validate nonce.
            if (!isset($_POST[$meta_box['nonce_name']]) || !wp_verify_nonce($_POST[$meta_box['nonce_name']], $meta_box['nonce_action']))
            {
                // error_log("Nonce validation failed for {$meta_box['nonce_name']}");
                continue;
            }
            foreach ($meta_box['fields'] as $field)
            {
                if (isset($_POST[$field]))
                {
                    if (is_array($_POST[$field]))
                    {
                        // For the _checkboxes field, flatten the array.
                        if ($field === '_checkboxes')
                        {
                            $data = $_POST[$field];
                            $flattened = [];
                            // Expecting a structure like: [ c2 => [ 0 => 'Option one', 6 => 'Option two' ] ]
                            foreach ($data as $key => $value)
                            {
                                if (is_array($value))
                                {
                                    // Flatten: ignore the outer key (which should match _checkbox_select) and keep the inner array.
                                    $flattened = $value;
                                    break;
                                }
                            }
                            $sanitized_array = $this->recursive_sanitize($flattened);
                            update_post_meta($post_id, '_' . $field, $sanitized_array);
                        }
                        else
                        {
                            $sanitized_array = $this->recursive_sanitize($_POST[$field]);
                            update_post_meta($post_id, '_' . $field, $sanitized_array);
                        }
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
