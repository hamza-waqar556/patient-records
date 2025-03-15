<?php

namespace Inc\Api;

use Inc\Base\BaseController;

/**
 * MetaBoxGenerator
 *
 * Generates meta boxes based on configuration and handles saving of meta data.
 */
class MetaBoxGenerator extends BaseController
{
    private $meta_boxes = [];

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
     * Create meta boxes.
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
                    require_once "{$this->plugin_path}/src/templates/meta-box/{$meta_box['template_path']}";
                },
                $meta_box['cpt'],
                'normal',
                'high'
            );
        }
    }

    /**
     * Recursively sanitize data.
     *
     * @param mixed $data Data to sanitize.
     * @return mixed Sanitized data.
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
     * Save meta fields.
     * For repeater groups, all data is saved under __progress_reports.
     * This method also flattens the checkboxes array if it was saved with an extra key.
     */
    public function saveFields($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'record') return;
        if (!current_user_can('edit_post', $post_id)) return;

        foreach ($this->meta_boxes as $meta_box)
        {
            if (
                !isset($_POST[$meta_box['nonce_name']]) ||
                !wp_verify_nonce($_POST[$meta_box['nonce_name']], $meta_box['nonce_action'])
            )
            {
                continue;
            }

            // Save repeater data if present.
            if (isset($_POST['progress_reports']))
            {
                $data = $_POST['progress_reports'];
                $sanitized = $this->recursive_sanitize($data);
                // Loop through each group and flatten the checkboxes if needed.
                foreach ($sanitized as &$group)
                {
                    if (isset($group['checkboxes']) && is_array($group['checkboxes']))
                    {
                        $keys = array_keys($group['checkboxes']);
                        // If the first key is non-numeric, assume it's nested.
                        if (!empty($keys) && !is_numeric($keys[0]))
                        {
                            // Flatten the array using the current checkbox_select value.
                            $group['checkboxes'] = isset($group['checkboxes'][$group['checkbox_select']]) ? $group['checkboxes'][$group['checkbox_select']] : [];
                        }
                    }
                }
                update_post_meta($post_id, '__progress_reports', $sanitized);
            }

            // Save other fields if defined.
            foreach ($meta_box['fields'] as $field)
            {
                if (isset($_POST[$field]))
                {
                    if (is_array($_POST[$field]))
                    {
                        $sanitized = $this->recursive_sanitize($_POST[$field]);
                        update_post_meta($post_id, '_' . $field, $sanitized);
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
