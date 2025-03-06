<?php
// Get saved values
$member    = get_post_meta($post->ID, '__member', true);

$mhwin_id  = get_post_meta($post->ID, '__mhwin_id', true);
$date      = get_post_meta($post->ID, '__date', true);
$crsp      = get_post_meta($post->ID, '__crsp', true);
$facility  = get_post_meta($post->ID, '__facility', true);
$goals     = get_post_meta($post->ID, '__goals', true);
$pc_hours  = get_post_meta($post->ID, '__pc_hours', true);
$cls_hours = get_post_meta($post->ID, '__cls_hours', true);

// Nonce for security
wp_nonce_field('record_patient_details_nonce_action', 'record_patient_details_nonce');
?>


<div class="form1-wrapper">
    <div class="input-rows">
        <div class="input-wrapper w-33">
            <label for="form1-member">member</label>
            <input type="text" name="_member" value="<?php echo esc_attr($member); ?>" id="form1-member" placeholder="Member">
        </div>
        <div class="input-wrapper w-33">
            <label for="form1-mhwin-id">MHWIN ID#</label>
            <input type="text" name="_mhwin_id" value="<?php echo esc_attr($mhwin_id); ?>" id="form1-mhwin-id" placeholder="MHWIN ID#">
        </div>
        <div class="input-wrapper w-33">
            <label for="form1-date">date</label>
            <input type="date" name="_date" value="<?php echo esc_attr($date); ?>" id="form1-date" placeholder="Date">
        </div>
    </div>
    <div class="input-rows">
        <div class="input-wrapper w-70">
            <label for="form1-CRSP">CRSP SC / CM</label>
            <input type="text" name="_crsp" value="<?php echo esc_attr($crsp); ?>" id="form1-CRSP" placeholder="CRSP SC / CM">
        </div>
        <div class="input-wrapper w-30">
            <label for="form1-facility">Facility</label>
            <input type="text" name="_facility" value="<?php echo esc_attr($facility); ?>" id="form1-facility" placeholder="Facility">
        </div>
    </div>
    <div class="input-rows">
        <div class="input-wrapper w-full">
            <label for="form1-ipos-goals">Identified IPOS Goals</label>
            <textarea name="_goals" id="form1-ipos-goals" rows="4" placeholder="Identified IPOS Goals"><?php echo esc_textarea($goals); ?></textarea>
        </div>
    </div>
    <div class="input-rows">
        <div class="input-wrapper w-half">
            <label for="form1-pc-hours">PC Hours</label>
            <input type="text" name="_pc_hours" value="<?php echo esc_attr($pc_hours); ?>" id="form1-pc-hours" placeholder="PC Hours">
        </div>
        <div class="input-wrapper w-half">
            <label for="form1-cls-hours">CLS Hours</label>
            <input type="text" name="_cls_hours" value="<?php echo esc_attr($cls_hours); ?>" id="form1-cls-hours" placeholder="CLS Hours">
        </div>
    </div>
</div>