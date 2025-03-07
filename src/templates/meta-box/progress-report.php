<?php

/**
 * progress-report.php
 *
 * Template file for the Progress Report meta box.
 * Retrieves saved meta values, renders form fields including a dynamic select and checkboxes,
 * and passes JSON data & saved checkbox data to JavaScript.
 */

use \Inc\Components\CheckboxSelect;
use \Inc\Base\BaseController;

// Retrieve saved meta values
$mhwin_id       = get_post_meta($post->ID, '__mhwin_id', true);
$date           = get_post_meta($post->ID, '__date', true);
$staff_initials = get_post_meta($post->ID, '__staff_initials', true);
$task_id        = get_post_meta($post->ID, '__task_id', true);
$add_note       = get_post_meta($post->ID, '__add_note', true);
$staff_type     = get_post_meta($post->ID, '__staff_type', true);
$progress_code  = get_post_meta($post->ID, '__progress_code', true);
$member         = get_post_meta($post->ID, '__member', true);
$checkbox_select = get_post_meta($post->ID, '__checkbox_select', true);
$checkboxes     = (array) get_post_meta($post->ID, '__checkboxes', true);

// Build a results array with proper sanitization
$results = [
    'mhwin_id'        => !empty($mhwin_id) ? sanitize_text_field($mhwin_id) : '',
    'date'            => !empty($date) ? sanitize_text_field($date) : '',
    'staff_initials'  => !empty($staff_initials) ? sanitize_text_field($staff_initials) : '',
    'task_id'         => !empty($task_id) ? sanitize_text_field($task_id) : '',
    'add_note'        => !empty($add_note) ? sanitize_textarea_field($add_note) : '',
    'staff_type'      => !empty($staff_type) ? sanitize_text_field($staff_type) : '',
    'progress_code'   => !empty($progress_code) ? sanitize_text_field($progress_code) : '',
    'member'          => !empty($member) ? sanitize_text_field($member) : '',
    // The select value (e.g. "c2")
    'checkbox_select' => !empty($checkbox_select) ? sanitize_text_field($checkbox_select) : '',
    // Here we expect a flat array (indexes => checkbox value) from the saving routine.
    'checkboxes'      => array_map('sanitize_text_field', $checkboxes),
];

// Output a nonce for security
wp_nonce_field('record_progress_report_nonce_action', 'record_progress_report_nonce');

// Initialize the CheckboxSelect component (loads JSON from file)
$baseController = new BaseController();
$jsonFilePath   = $baseController->plugin_path . 'src/assets/data/service-options.json';
$component      = new CheckboxSelect($jsonFilePath, true);
$jsonData       = $component->json;

// Determine the selected key from the select field; default to 'c1' if not set.
$selectedKey = !empty($results['checkbox_select']) ? $results['checkbox_select'] : 'c1';

// Pass the saved (flat) checkbox data to the component for pre-checking.
$component->setSavedCheckboxes($results['checkboxes']);
?>

<div>
    <!-- Debug output (remove in production) -->
    <pre><?php // print_r($results);
            ?></pre>
</div>

<div>
    <div class="input-rows">
        <!-- Member -->
        <div class="input-wrapper w-33">
            <label for="form2-member">Member</label>
            <input type="text" name="_member" id="form2-member" placeholder="Member" value="<?php echo esc_attr($results['member']); ?>">
        </div>
        <!-- MHWIN ID# -->
        <div class="input-wrapper w-33">
            <label for="form2-mhwin-id">MHWIN ID#</label>
            <input type="text" name="_mhwin_id" id="form2-mhwin-id" placeholder="MHWIN ID#" value="<?php echo esc_attr($results['mhwin_id']); ?>">
        </div>
        <!-- Date -->
        <div class="input-wrapper w-33">
            <label for="form2-date">Date</label>
            <input type="date" name="_date" id="form2-date" placeholder="Date" value="<?php echo esc_attr($results['date']); ?>">
        </div>
    </div>

    <!-- Row 2 -->
    <div class="input-rows">

        <!-- Staff Initials -->
        <div class="input-wrapper w-33">
            <label for="_staff_initials">
                Staff Initials
            </label>
            <input type="text" name="_staff_initials" id="_staff_initials" placeholder="Staff Initials" value="<?php echo esc_attr($results['staff_initials']); ?>">
        </div>

        <!-- Checkboxes Select -->
        <div class="select-wrapper w-33">
            <label for="_checkbox_select">
                CLS/PC
            </label>
            <?php
            // Render the select field (name="_checkbox_select")
            echo $component->renderSelect($selectedKey, '_checkbox_select');
            ?>
        </div>

        <!-- Task ID -->
        <div class="select-wrapper w-33">
            <label for="_task_id">
                Task ID
            </label>
            <select name="_task_id" id="_task_id">
                <option value="H" <?php selected($results['task_id'], 'H'); ?>>Hospitalization</option>
                <option value="M" <?php selected($results['task_id'], 'M'); ?>>Monitoring</option>
                <option value="R" <?php selected($results['task_id'], 'R'); ?>>Refusal</option>
                <option value="ED" <?php selected($results['task_id'], 'ED'); ?>>Education/Day Program</option>
                <option value="TC" <?php selected($results['task_id'], 'TC'); ?>>Total Care</option>
                <option value="PA" <?php selected($results['task_id'], 'PA'); ?>>Physical Assist</option>
                <option value="VP" <?php selected($results['task_id'], 'VP'); ?>>Verbal Prompts</option>
                <option value="LOA" <?php selected($results['task_id'], 'LOA'); ?>>Leave of Absence</option>
                <option value="HOH" <?php selected($results['task_id'], 'HOH'); ?>>Hand Over Hand</option>
                <option value="I" <?php selected($results['task_id'], 'I'); ?>>Independent</option>
            </select>
        </div>

    </div>

    <!-- Dynamic Select & Checkboxes Component -->
    <div class="meta-box-select-component">
        <div class="tabs-wrapper">
            <?php
            // Render the checkboxes for the selected key with names like _checkboxes[c2][0]
            echo $component->renderCheckboxes($selectedKey, '_checkboxes');
            ?>
        </div>
    </div>

    <!-- Row 3 -->
    <!-- Text Area Add Note -->
    <div class="input-rows">
        <div class="input-wrapper w-full">
            <label for="_add_note">
                Add Note
            </label>
            <textarea name="_add_note" id="_add_note" rows="4" placeholder="Add Note"><?php echo esc_textarea($results['add_note']); ?></textarea>
        </div>
    </div>

    <!-- Row 4 -->
    <div class="input-rows">

        <!-- Staff Type -->
        <div class="select-wrapper w-half">
            <label for="_staff_type">
                Staff Type
            </label>
            <select name="_staff_type" id="_staff_type">
                <option value="AM" <?php selected($results['staff_type'], 'AM'); ?>>AM</option>
                <option value="PM" <?php selected($results['staff_type'], 'PM'); ?>>PM</option>
                <option value="MN" <?php selected($results['staff_type'], 'MN'); ?>>MN</option>
            </select>
        </div>

        <!-- Progress Code -->
        <div class="select-wrapper w-half">
            <label for="_progress_code">
                Progress Code
            </label>
            <select name="_progress_code" id="_progress_code">
                <option value="IP" <?php selected($results['progress_code'], 'IP'); ?>>Increased Progress</option>
                <option value="DP" <?php selected($results['progress_code'], 'DP'); ?>>Decreased Progress</option>
                <option value="SP" <?php selected($results['progress_code'], 'SP'); ?>>Same Progress</option>
            </select>
        </div>

    </div>
</div>

<script>
    // Pass JSON options and saved checkboxes to JavaScript
    var metaOptions = <?php echo json_encode($jsonData); ?>;
    var savedCheckboxes = <?php echo json_encode($results['checkboxes']); ?>;
</script>