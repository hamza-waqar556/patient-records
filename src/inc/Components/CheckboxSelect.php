<?php

namespace Inc\Components;

class CheckboxSelect
{
    public $data = [];
    public $json;
    // Holds saved (flat) checkbox values, e.g. [0 => 'Option one', 6 => 'Option two']
    public $savedCheckboxes = [];

    /**
     * Constructor.
     *
     * @param string $json Source JSON data or file path.
     * @param bool   $isFile Whether to treat $json as a file path.
     */
    public function __construct($json, $isFile = true)
    {
        if ($isFile && file_exists($json))
        {
            $jsonContent = file_get_contents($json);
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
     * Set saved checkbox values.
     *
     * @param array $data Flat array of saved checkbox values.
     */
    public function setSavedCheckboxes($data)
    {
        $this->savedCheckboxes = $data;
    }

    /**
     * Get available outer keys (e.g., "c1", "c2", "p5") from the JSON data.
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
     * Get data for a given outer key.
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
     * @param string $selected The currently selected key.
     * @param string $selectName The name attribute for the select.
     * @return string HTML output.
     */
    public function renderSelect($selected = '', $selectName = 'select_key')
    {
        $options = $this->getOptions();
        $html = '<select name="' . esc_attr($selectName) . '" id="' . esc_attr($selectName) . '" value="' . esc_attr($selected) . '">';
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
     * The checkbox input names will be in the format:
     * _checkboxes[<outerKey>][<index>]
     *
     * @param string $outerKey The outer key (e.g., "c2").
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
        // Output a div with id equal to the outer key
        $html .= '<div id="' . esc_attr($outerKey) . '" class="tab-content active">';
        $html .= '<ul>';
        // Retrieve saved checkbox data. Since we save a flat array, use it directly.
        $saved = $this->savedCheckboxes;
        foreach ($data as $item)
        {
            // Each item must have an "index" and a "value"
            $index = isset($item['index']) ? intval($item['index']) : 0;
            $value = isset($item['value']) ? trim($item['value']) : '';
            $inputName = sprintf('%s[%s][%d]', esc_attr($checkboxPrefix), esc_attr($outerKey), $index);
            $inputId   = sprintf('%s-%s-%d', esc_attr($checkboxPrefix), esc_attr($outerKey), $index);
            // Check if the flat saved data has an entry at this index that equals the checkbox value.
            $checked = (isset($saved[$index]) && $saved[$index] == $value) ? 'checked' : '';
            $html .= '<li>';
            $html .= '<input type="checkbox" name="' . esc_attr($inputName) . '" id="' . esc_attr($inputId) . '" value="' . esc_attr($value) . '" ' . $checked . '>';
            $html .= '<label for="' . esc_attr($inputId) . '">' . esc_html($value) . '</label>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>'; // close tab-content
        $html .= '</div>'; // close tabs-container
        return $html;
    }

    /**
     * Render the complete component (select + checkboxes).
     *
     * @param string $selectedKey The selected outer key.
     * @param string $selectName The name attribute for the select.
     * @param string $checkboxPrefix The prefix for checkbox names.
     * @return string HTML output.
     */
    public function renderComponent($selectedKey = '', $selectName = 'select_key', $checkboxPrefix = 'check')
    {
        $html  = '<div class="meta-box-select-component">';
        $html .= '<div class="select-wrapper">' . $this->renderSelect($selectedKey, $selectName) . '</div>';
        if (!empty($selectedKey))
        {
            $html .= '<div class="tabs-wrapper">' . $this->renderCheckboxes($selectedKey, $checkboxPrefix) . '</div>';
        }
        $html .= '</div>';
        return $html;
    }
}
