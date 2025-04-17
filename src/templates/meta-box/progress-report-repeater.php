<?php

/**
 * progress-report-repeater.php
 *
 * Repeater template for the Progress Report meta box.
 * Retrieves saved repeater data (stored in __progress_reports) and outputs each group.
 * Each group includes a dynamic select and checkboxes with keyword replacement based on the member field.
 */

use \Inc\Components\CheckboxSelect;
use \Inc\Base\BaseController;




// Retrieve repeater data stored under the meta key __progress_reports.
$progress_reports = get_post_meta($post->ID, '__progress_reports', true);
if (!is_array($progress_reports) || empty($progress_reports))
{
    // If no data exists, create one empty group.
    $progress_reports = [
        [
            'member'          => '',
            'mhwin_id'        => '',
            'date'            => '',
            'staff_initials'  => '',
            'checkbox_select' => '',
            'checkboxes'      => [],  // expecting a flat array
            'task_id'         => '',
            'add_note'        => '',
            'staff_type'      => '',
            'progress_code'   => '',
        ],
        [
            'member'          => '',
            'mhwin_id'        => '',
            'date'            => '',
            'staff_initials'  => '',
            'checkbox_select' => '',
            'checkboxes'      => [],  // expecting a flat array
            'task_id'         => '',
            'add_note'        => '',
            'staff_type'      => '',
            'progress_code'   => '',
        ],
        [
            'member'          => '',
            'mhwin_id'        => '',
            'date'            => '',
            'staff_initials'  => '',
            'checkbox_select' => '',
            'checkboxes'      => [],  // expecting a flat array
            'task_id'         => '',
            'add_note'        => '',
            'staff_type'      => '',
            'progress_code'   => '',
        ],
        [
            'member'          => '',
            'mhwin_id'        => '',
            'date'            => '',
            'staff_initials'  => '',
            'checkbox_select' => '',
            'checkboxes'      => [],  // expecting a flat array
            'task_id'         => '',
            'add_note'        => '',
            'staff_type'      => '',
            'progress_code'   => '',
        ],
    ];
}

// Initialize the CheckboxSelect component (loads JSON from file).
$baseController    = new BaseController();
$jsonFilePath      = $baseController->plugin_path . 'src/assets/data/service-options.json';
$checkboxComponent = new CheckboxSelect($jsonFilePath, true);
$jsonData          = $checkboxComponent->json;

// Output nonce for security.
wp_nonce_field('record_progress_report_nonce_action', 'record_progress_report_nonce');
?>

<section>
    <?php
    // echo "<pre>";
    // print_r($progress_reports);
    // echo "</pre>";
    ?>
</section>


<div id="progress-report-repeater" style="position: relative; padding-bottom: 60px;">
    <?php foreach ($progress_reports as $index => $group):
        // Prepare and sanitize values for this group.
        $member          = isset($group['member']) ? sanitize_text_field($group['member']) : '';
        $mhwin_id        = isset($group['mhwin_id']) ? sanitize_text_field($group['mhwin_id']) : '';
        $date            = isset($group['date']) ? sanitize_text_field($group['date']) : '';
        $staff_initials  = isset($group['staff_initials']) ? sanitize_text_field($group['staff_initials']) : '';
        $checkbox_select = isset($group['checkbox_select']) ? sanitize_text_field($group['checkbox_select']) : '';
        $task_id         = isset($group['task_id']) ? sanitize_text_field($group['task_id']) : '';
        $add_note        = isset($group['add_note']) ? sanitize_textarea_field($group['add_note']) : '';
        $staff_type      = isset($group['staff_type']) ? sanitize_text_field($group['staff_type']) : '';
        $progress_code   = isset($group['progress_code']) ? sanitize_text_field($group['progress_code']) : '';
        // Expect a flat array for checkboxes.
        $savedCheckboxes = (isset($group['checkboxes']) && is_array($group['checkboxes'])) ? $group['checkboxes'] : [];
        // Use default selected key if not set.
        $selectedKey = !empty($checkbox_select) ? $checkbox_select : 'c1';

        // Set component values.
        $checkboxComponent->setSavedCheckboxes($savedCheckboxes);
        $checkboxComponent->setMember($member);
    ?>
        <div class="progress-report-group" data-index="<?php echo esc_attr($index); ?>">
            <h3>Progress Report <?php echo ($index + 1); ?></h3>
            <div class="input-rows">
                <!-- Member Field -->
                <div class="input-wrapper w-33">
                    <label for="form2-member-<?php echo $index; ?>">Member</label>
                    <input type="text" name="progress_reports[<?php echo $index; ?>][member]" id="form2-member-<?php echo $index; ?>" class="member-input" placeholder="Member" value="<?php echo esc_attr($member); ?>">
                </div>
                <!-- MHWIN ID -->
                <!-- <div class="input-wrapper w-33">
                    <label for="form2-mhwin_id-<?php echo $index; ?>">MHWIN ID#</label>
                    <input type="text" name="progress_reports[<?php echo $index; ?>][mhwin_id]" id="form2-mhwin_id-<?php echo $index; ?>" placeholder="MHWIN ID#" value="<?php echo esc_attr($mhwin_id); ?>">
                </div> -->
                <!-- Date -->
                <!-- <div class="input-wrapper w-33">
                    <label for="form2-date-<?php echo $index; ?>">Date</label>
                    <input type="date" name="progress_reports[<?php echo $index; ?>][date]" id="form2-date-<?php echo $index; ?>" placeholder="Date" value="<?php echo esc_attr($date); ?>">
                </div> -->
            </div>
            <div class="input-rows">
                <!-- Staff Initials -->
                <div class="input-wrapper w-33">
                    <label for="form2-staff_initials-<?php echo $index; ?>">Staff Initials</label>
                    <input type="text" name="progress_reports[<?php echo $index; ?>][staff_initials]" id="form2-staff_initials-<?php echo $index; ?>" placeholder="Staff Initials" value="<?php echo esc_attr($staff_initials); ?>">
                </div>
                <!-- CLS/PC (Dynamic Select) -->
                <div class="select-wrapper w-33">
                    <label for="checkbox_select-<?php echo $index; ?>">CLS/PC</label>
                    <?php
                    // Render the select field.
                    echo $checkboxComponent->renderSelect($selectedKey, "progress_reports[{$index}][checkbox_select]");
                    ?>
                </div>
                <!-- Task ID -->
                <div class="select-wrapper w-33">
                    <label for="form2-task_id-<?php echo $index; ?>">Task ID</label>
                    <select name="progress_reports[<?php echo $index; ?>][task_id]" id="form2-task_id-<?php echo $index; ?>">
                        <option value="H" <?php selected($task_id, 'H'); ?>>Hospitalization</option>
                        <option value="M" <?php selected($task_id, 'M'); ?>>Monitoring</option>
                        <option value="R" <?php selected($task_id, 'R'); ?>>Refusal</option>
                        <option value="ED" <?php selected($task_id, 'ED'); ?>>Education/Day Program</option>
                        <option value="TC" <?php selected($task_id, 'TC'); ?>>Total Care</option>
                        <option value="PA" <?php selected($task_id, 'PA'); ?>>Physical Assist</option>
                        <option value="VP" <?php selected($task_id, 'VP'); ?>>Verbal Prompts</option>
                        <option value="LOA" <?php selected($task_id, 'LOA'); ?>>Leave of Absence</option>
                        <option value="HOH" <?php selected($task_id, 'HOH'); ?>>Hand Over Hand</option>
                        <option value="I" <?php selected($task_id, 'I'); ?>>Independent</option>
                    </select>
                </div>
            </div>
            <!-- Dynamic Select & Checkboxes Component -->
            <div class="meta-box-select-component">
                <!-- 
                    The data-checkbox-prefix attribute is set flat (no extra nesting).
                    Also, we pass the saved checkboxes data via a data-saved attribute so that JavaScript can restore the checked state.
                -->
                <div class="tabs-wrapper" data-checkbox-prefix="progress_reports[<?php echo $index; ?>][checkboxes]" data-saved="<?php echo htmlspecialchars(json_encode($savedCheckboxes)); ?>">
                    <?php
                    // Render checkboxes with flat naming.
                    echo $checkboxComponent->renderCheckboxes($selectedKey, "progress_reports[{$index}][checkboxes]");
                    ?>
                </div>
            </div>
            <div class="input-rows">
                <!-- Add Note -->
                <div class="input-wrapper w-full">
                    <label for="form2-add_note-<?php echo $index; ?>">Add Note</label>
                    <textarea name="progress_reports[<?php echo $index; ?>][add_note]" id="form2-add_note-<?php echo $index; ?>" rows="4" placeholder="Add Note"><?php echo esc_textarea($add_note); ?></textarea>
                </div>
            </div>
            <div class="input-rows">
                <!-- Staff Type -->
                <div class="select-wrapper w-half">
                    <label for="form2-staff_type-<?php echo $index; ?>">Staff Type</label>
                    <select name="progress_reports[<?php echo $index; ?>][staff_type]" id="form2-staff_type-<?php echo $index; ?>">
                        <option value="AM" <?php selected($staff_type, 'AM'); ?>>AM</option>
                        <option value="PM" <?php selected($staff_type, 'PM'); ?>>PM</option>
                        <option value="MN" <?php selected($staff_type, 'MN'); ?>>MN</option>
                    </select>
                </div>
                <!-- Progress Code -->
                <div class="select-wrapper w-half">
                    <label for="form2-progress_code-<?php echo $index; ?>">Progress Code</label>
                    <select name="progress_reports[<?php echo $index; ?>][progress_code]" id="form2-progress_code-<?php echo $index; ?>">
                        <option value="IP" <?php selected($progress_code, 'IP'); ?>>Increased Progress</option>
                        <option value="DP" <?php selected($progress_code, 'DP'); ?>>Decreased Progress</option>
                        <option value="SP" <?php selected($progress_code, 'SP'); ?>>Same Progress</option>
                    </select>
                </div>
            </div>
            <div class="button-wrapper w-20">
                <button type="button" class="remove-group">Remove Group</button>
            </div>
            <hr>
        </div>
    <?php endforeach; ?>
    <div class="button-wrapper w-full" style="position: absolute; bottom: 0;">
        <button type="button" class="w-full" id="add-group">Add New Group</button>
    </div>
</div>

<!-- Pass JSON options to JavaScript for dynamic behavior -->
<script type="text/javascript">
    var metaOptions = <?php echo json_encode($jsonData); ?>;
</script>