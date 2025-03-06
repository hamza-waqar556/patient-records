<?php

/**
 * Class CheckboxSelect
 *
 * Dynamically renders a select dropdown based on JSON data and outputs a list
 * of checkboxes for the chosen option. Each checkbox’s name is in the format:
 * check[{outer_key}][{index}], and its value is the inner "value" field.
 *
 * @package PatientRecords
 */

namespace Inc\Components;

class CheckboxSelect
{
    public $data = [];
    public $json;

    /**
     * Constructor.
     *
     * @param string $json Source JSON data as a string or a file path.
     * @param bool   $isFile If true, $json is treated as a file path.
     */
    public function __construct($json, $isFile = true)
    {
        if ($isFile && file_exists($json))
        {
            $jsonContent = file_get_contents($json);

            // save json into a variable
            $this->json = json_decode($jsonContent);
        }
        else
        {
            $jsonContent = $json;
        }
        $this->data = json_decode($jsonContent, true);
        if (!is_array($this->data))
        {
            $this->data = [];
        }
    }


    /**
     * Get outer keys (e.g., c1, c11, p1, p7).
     *
     * @return array
     */
    public function getOptions()
    {
        $options = [];
        foreach ($this->data as $item)
        {
            $options = array_merge($options, array_keys($item));
        }
        return $options;
    }

    /**
     * Get data by outer key.
     *
     * @param string $key
     * @return array
     */
    public function getDataByKey($key)
    {
        foreach ($this->data as $item)
        {
            if (isset($item[$key]))
            {
                return $item[$key];
            }
        }
        return [];
    }

    /**
     * Render the select dropdown.
     *
     * @param string $selected The currently selected outer key.
     * @param string $selectName The name attribute for the select element.
     * @return string HTML output.
     */
    public function renderSelect($selected = '', $selectName = 'select_key')
    {
        $options = $this->getOptions();
        $html = '<select name="' . esc_attr($selectName) . '" id="' . esc_attr($selectName) . ' value="' . esc_attr($selected) . '">';
        $html .= '<option value="" hidden>Select an option</option>';
        foreach ($options as $option)
        {
            $sel = ($option === $selected) ? 'selected' : '';
            $html .= '<option value="' . esc_attr($option) . '" ' . $sel . '>' . esc_html($option) . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    /**
     * Render checkboxes for the provided outer key.
     *
     * Each checkbox name is formatted as check[{$outer_key}][{index}].
     *
     * @param string $outerKey The outer key (e.g., c1).
     * @param string $checkboxPrefix The prefix for the checkbox names.
     * @return string HTML output.
     */
    public function renderCheckboxes($outerKey, $checkboxPrefix = 'check')
    {
        $data = $this->getDataByKey($outerKey);
        if (empty($data))
        {
            return '<p>No items available for this option.</p>';
        }
        $html = '<div class="tabs-container">';
        // We'll output one <div> with an id equal to the outer key.
        $html .= '<div id="' . esc_attr($outerKey) . '" class="tab-content active">';
        $html .= '<ul>';
        foreach ($data as $item)
        {
            // Each item is expected to have an "index" and "value".
            $index = isset($item['index']) ? intval($item['index']) : 0;
            $value = isset($item['value']) ? $item['value'] : '';
            $inputName = sprintf('%s[%s][%d]', esc_attr($checkboxPrefix), esc_attr($outerKey), $index);
            $inputId   = sprintf('%s-%s-%d', esc_attr($checkboxPrefix), esc_attr($outerKey), $index);
            $html .= '<li>';
            $html .= '<input type="checkbox" name="' . $inputName . '" id="' . $inputId . '" value="' . esc_attr($value) . '">';
            $html .= '<label for="' . $inputId . '">' . esc_html($value) . '</label>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>'; // close tab-content
        $html .= '</div>'; // close tabs-container
        return $html;
    }

    /**
     * Render the complete component.
     *
     * This outputs the select dropdown and, if a key is selected, the associated checkboxes.
     *
     * @param string $selectedKey The selected outer key.
     * @param string $selectName  The name attribute for the select element.
     * @param string $checkboxPrefix The prefix for checkbox names.
     * @return string HTML output.
     */
    public function renderComponent($selectedKey = '', $selectName = 'select_key', $checkboxPrefix = 'check')
    {
        $html  = '<div class="meta-box-select-component">';
        $html .= '<div class="select-wrapper">';
        $html .= $this->renderSelect($selectedKey, $selectName);
        $html .= '</div>';
        if (!empty($selectedKey))
        {
            $html .= '<div class="tabs-wrapper">';
            $html .= $this->renderCheckboxes($selectedKey, $checkboxPrefix);
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
}
