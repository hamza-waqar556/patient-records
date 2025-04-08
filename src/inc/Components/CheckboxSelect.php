<?php

namespace Inc\Components;

/**
 * CheckboxSelect
 *
 * Loads JSON data for service options and renders a dynamic select and checkboxes.
 * Supports keyword replacement (e.g. replacing “client” or “consumer” with the member name)
 * and renders the checkboxes as a flat array (no extra nesting).
 */
class CheckboxSelect
{
    public $data = [];
    public $json;
    // Holds saved checkbox values for a group; expected as a flat array: [index => value]
    public $savedCheckboxes = [];
    // Holds the member value for keyword replacement.
    public $member = '';

    /**
     * Constructor.
     *
     * @param string $json Source JSON data or file path.
     * @param bool   $isFile Whether to treat $json as a file path.
     */
    public function __construct($json, $isFile = true)
    {
        if ($isFile && file_exists($json)) {
            $jsonContent = file_get_contents($json);
        } else {
            $jsonContent = $json;
        }
        $this->json = json_decode($jsonContent);
        $this->data = json_decode($jsonContent, true);
        if (!is_array($this->data)) {
            $this->data = [];
        }
    }

    /**
     * Set saved checkbox values.
     *
     * @param array $data Saved checkbox data for the current group (flat array expected).
     */
    public function setSavedCheckboxes($data)
    {
        $this->savedCheckboxes = $data;
    }

    /**
     * Set the member value for keyword replacement.
     *
     * @param string $member
     */
    public function setMember($member)
    {
        $this->member = $member;
    }

    /**
     * Get available outer keys from the JSON data.
     *
     * @return array List of keys.
     */
    public function getOptions()
    {
        $options = [];
        foreach ($this->data as $item) {
            $options = array_merge($options, array_keys($item));
        }
        return $options;
    }

    /**
     * Get data for a given outer key.
     *
     * @param string $key The outer key.
     * @return array Data for the key.
     */
    public function getDataByKey($key)
    {
        foreach ($this->data as $item) {
            if (isset($item[$key])) {
                return $item[$key];
            }
        }
        return [];
    }

    /**
     * Normalize text for comparison.
     *
     * Lowercases, trims, and collapses whitespace to ensure that differences
     * between the saved value and display value do not prevent a match.
     *
     * @param string $text The text to normalize.
     * @return string Normalized text.
     */
    private function normalizeText($text)
    {
        $text = trim($text);
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/\s+/', ' ', $text);
        return $text;
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
        $html = '<select name="' . esc_attr($selectName) . '" id="' . esc_attr($selectName) . '">';
        $html .= '<option value="" hidden>Select an option</option>';
        foreach ($options as $option) {
            $sel = ($option === $selected) ? 'selected' : '';
            $html .= '<option value="' . esc_attr($option) . '" ' . $sel . '>' . esc_html($option) . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    /**
     * Render checkboxes for the given outer key.
     *
     * The checkbox names will be generated as a flat array:
     * e.g. progress_reports[<group_index>][checkboxes][<index>]
     * (no extra nesting by the selected key is added).
     * Performs keyword replacement if a member is provided and uses normalization
     * to compare saved values to the generated display values.
     *
     * @param string $outerKey The outer key (e.g. "p3") used only for rendering.
     * @param string $checkboxPrefix The prefix for checkbox names (should include group index).
     * @return string HTML output.
     */
    // public function renderCheckboxes($outerKey, $checkboxPrefix = 'check')
    // {
    //     $data = $this->getDataByKey($outerKey);
    //     if (empty($data))
    //     {
    //         return '<p>No items available for this option.</p>';
    //     }
    //     $html = '<div class="tabs-container">';
    //     $html .= '<div id="' . esc_attr($outerKey) . '" class="tab-content active">';
    //     $html .= '<ul>';
    //     // Use the saved checkboxes as a flat array.
    //     $savedForKey = $this->savedCheckboxes;
    //     foreach ($data as $item)
    //     {
    //         $index = isset($item['index']) ? intval($item['index']) : 0;
    //         $value = isset($item['value']) ? trim($item['value']) : '';
    //         if (!empty($this->member))
    //         {
    //             $replacement = strtoupper($this->member);
    //             $value = preg_replace('/\b(the\s+)?(client|consumer)\b/i', $replacement, $value);
    //         }
    //         $savedValue   = isset($savedForKey[$index]) ? sanitize_text_field($savedForKey[$index]) : '';
    //         $displayValue = sanitize_text_field($value);
    //         $normalizedSaved   = $this->normalizeText($savedValue);
    //         $normalizedDisplay = $this->normalizeText($displayValue);
    //         $checked = ($normalizedSaved === $normalizedDisplay) ? 'checked' : '';

    //         // Generate input name as a flat array element.
    //         $inputName = sprintf('%s[%d]', esc_attr($checkboxPrefix), $index);
    //         // Use the outer key only in the ID for uniqueness.
    //         $inputId   = sprintf('%s-%s-%d', esc_attr($checkboxPrefix), esc_attr($outerKey), $index);

    //         $html .= '<li>';
    //         $html .= '<input type="checkbox" name="' . esc_attr($inputName) . '" id="' . esc_attr($inputId) . '" value="' . esc_attr($displayValue) . '" ' . $checked . '>';
    //         $html .= '<label for="' . esc_attr($inputId) . '">' . esc_html($displayValue) . '</label>';
    //         $html .= '</li>';
    //     }
    //     $html .= '</ul>';
    //     $html .= '</div>';
    //     $html .= '</div>';
    //     return $html;
    // }

    public function renderCheckboxes($outerKey, $checkboxPrefix = 'check')
    {
        $data = $this->getDataByKey($outerKey);
        if (empty($data)) {
            return '<p>No items available for this option.</p>';
        }
        $html = '<div class="tabs-container">';
        $html .= '<div id="' . esc_attr($outerKey) . '" class="tab-content active">';
        $html .= '<ul>';
        // Use the saved checkboxes as a flat array.
        $savedForKey = $this->savedCheckboxes;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        foreach ($data as $item) {
            $index = isset($item['index']) ? intval($item['index']) : 0;
            // Retrieve heading if it exists.
            $heading = isset($item['heading']) ? trim($item['heading']) : '';
            $value = isset($item['value']) ? trim($item['value']) : '';
            if (!empty($this->member)) {
                $replacement = strtoupper($this->member);
                $value = preg_replace('/\b(the\s+)?(client|consumer)\b/i', $replacement, $value);
            }
            $savedValue   = isset($savedForKey[$index]) ? sanitize_text_field($savedForKey[$index]) : '';
            $displayValue = sanitize_text_field($value);
            $normalizedSaved   = $this->normalizeText($savedValue);
            $normalizedDisplay = $this->normalizeText($displayValue);
            $checked = ($normalizedSaved === $normalizedDisplay) ? 'checked' : '';
            // Generate input name as a flat array element.
            $inputName = sprintf('%s[%d]', esc_attr($checkboxPrefix), $index);
            // Use the outer key only in the ID for uniqueness.
            $inputId   = sprintf('%s-%s-%d', esc_attr($checkboxPrefix), esc_attr($outerKey), $index);
            $html .= '<li>';
            // If a heading exists, render it as a separate element.
            if (!empty($heading)) {
                $html .= '<div style="display: block; font-size: 1rem; font-weight: 600; margin-bottom: 10px;">' . esc_html($heading) . '</div>';
            }
            $html .= '<div>';
            $html .= '<input type="checkbox" name="' . esc_attr($inputName) . '" id="' . esc_attr($inputId) . '" value="' . esc_attr($displayValue) . '" ' . $checked . '>';
            $html .= '<label for="' . esc_attr($inputId) . '">' . esc_html($displayValue) . '</label>';
            $html .= '</div>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
