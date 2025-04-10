<?php

/**
 * Template: Personal Care Meta Box (Looped)
 *
 * This template displays the Personal Care Objectives
 * using a loop. It assumes your meta field is saved with key '__p'
 * (because your save routine prepends an underscore).
 *
 * @package PatientRecords
 */

if (! defined('ABSPATH')) exit;

// Retrieve saved values as an array.
$saved_values = (array) get_post_meta($post->ID, '__p', true);

// Output nonce for security.
wp_nonce_field('record_personal_care_nonce_action', 'record_personal_care_nonce');

// Titles for each objective (start at index 1)
$titles = [
    "Eating/Feeding",
    "Toileting",
    "Showering/Bathing/Personal Hygiene",
    "Dressing",
    "Mobility/Transferring",
    "Medication Knowledge/Administration",
    "Complex Care",
];
?>

<div id="for-community">
    <!-- <div class="inner-heading">
        <h3>Community Living Supports Objectives</h3>
    </div> -->

    <?php
    // Loop through each objective.
    // We start at index 1 (since you want the numbering to start at 1)
    for ($i = 1; $i <= count($titles); $i++)
    {
        $title = $titles[$i - 1];
    ?>
        <div class="objective-group">
            <h3><?php echo esc_html('P' . $i . ' ' . $title); ?></h3>

            <div class="input-rows">
                <div class="input-wrapper w-16">
                    <label for="p<?php echo $i; ?>-am">AM</label>
                    <input type="text" name="_p[<?php echo $i; ?>][am]" id="p<?php echo $i; ?>-am" placeholder="AM" value="<?php echo isset($saved_values[$i]['am']) ? esc_attr($saved_values[$i]['am']) : ''; ?>">
                </div>
                <div class="input-wrapper w-16">
                    <label for="p<?php echo $i; ?>-am-min">mins</label>
                    <input type="text" name="_p[<?php echo $i; ?>][am-min]" id="p<?php echo $i; ?>-am-min" placeholder="Mins" value="<?php echo isset($saved_values[$i]['am-min']) ? esc_attr($saved_values[$i]['am-min']) : ''; ?>">
                </div>
                <div class="input-wrapper w-16">
                    <label for="p<?php echo $i; ?>-pm">PM</label>
                    <input type="text" name="_p[<?php echo $i; ?>][pm]" id="p<?php echo $i; ?>-pm" placeholder="PM" value="<?php echo isset($saved_values[$i]['pm']) ? esc_attr($saved_values[$i]['pm']) : ''; ?>">
                </div>
                <div class="input-wrapper w-16">
                    <label for="p<?php echo $i; ?>-pm-min">mins</label>
                    <input type="text" name="_p[<?php echo $i; ?>][pm-min]" id="p<?php echo $i; ?>-pm-min" placeholder="Mins" value="<?php echo isset($saved_values[$i]['pm-min']) ? esc_attr($saved_values[$i]['pm-min']) : ''; ?>">
                </div>
                <div class="input-wrapper w-16">
                    <label for="p<?php echo $i; ?>-mn">MN</label>
                    <input type="text" name="_p[<?php echo $i; ?>][mn]" id="p<?php echo $i; ?>-mn" placeholder="MN" value="<?php echo isset($saved_values[$i]['mn']) ? esc_attr($saved_values[$i]['mn']) : ''; ?>">
                </div>
                <div class="input-wrapper w-16">
                    <label for="p<?php echo $i; ?>-mn-min">mins</label>
                    <input type="text" name="_p[<?php echo $i; ?>][mn-min]" id="p<?php echo $i; ?>-mn-min" placeholder="Mins" value="<?php echo isset($saved_values[$i]['mn-min']) ? esc_attr($saved_values[$i]['mn-min']) : ''; ?>">
                </div>
            </div>

            <div class="input-rows">
                <div class="input-wrapper w-full">
                    <label for="p<?php echo $i; ?>-description">Description</label>
                    <input type="text" name="_p[<?php echo $i; ?>][description]" id="p<?php echo $i; ?>-description" placeholder="Description" value="<?php echo isset($saved_values[$i]['description']) ? esc_attr($saved_values[$i]['description']) : ''; ?>">
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>