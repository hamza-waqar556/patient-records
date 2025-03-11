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
$ami = get_post_meta($post->ID, '__ami', true);
$idd = get_post_meta($post->ID, '__idd', true);


$results = [
    'member' => esc_attr(get_post_meta($post->ID, '__member', true)),
    'mhwin_id'  => esc_attr(get_post_meta($post->ID, '__mhwin_id', true)),
    'date'      => esc_attr(get_post_meta($post->ID, '__date', true)),
    'crsp'      => esc_attr(get_post_meta($post->ID, '__crsp', true)),
    'facility'      => esc_attr(get_post_meta($post->ID, '__facility', true)),
    'goals'      => esc_textarea(get_post_meta($post->ID, '__goals', true)),
    'pc_hours'      => esc_attr(get_post_meta($post->ID, '__pc_hours', true)),
    'cls_hours'      => esc_attr(get_post_meta($post->ID, '__cls_hours', true)),
    'ami'      => esc_attr(get_post_meta($post->ID, '__ami', true)),
    'idd'      => esc_attr(get_post_meta($post->ID, '__idd', true)),
];

// Nonce for security
wp_nonce_field('record_patient_details_nonce_action', 'record_patient_details_nonce');
?>


<div class="form1-wrapper">
    <div class="input-rows">
        <div class="input-wrapper w-33">
            <label for="form1-member">member</label>
            <input type="text" name="_member" value="<?php echo esc_attr($results['member']); ?>" id="form1-member" placeholder="Member">
        </div>
        <div class="input-wrapper w-33">
            <label for="form1-mhwin-id">MHWIN ID#</label>
            <input type="text" name="_mhwin_id" value="<?php echo esc_attr($results['mhwin_id']); ?>" id="form1-mhwin-id" placeholder="MHWIN ID#">
        </div>
        <div class="input-wrapper w-33">
            <label for="form1-date">date</label>
            <input type="date" name="_date" value="<?php echo esc_attr($results['date']); ?>" id="form1-date" placeholder="Date">
        </div>
    </div>
    <div class="input-rows">
        <div class="input-wrapper w-70">
            <label for="form1-CRSP">CRSP SC / CM</label>
            <input type="text" name="_crsp" value="<?php echo esc_attr($results['crsp']); ?>" id="form1-CRSP" placeholder="CRSP SC / CM">
        </div>
        <div class="input-wrapper w-30">
            <label for="form1-facility">Facility</label>
            <input type="text" name="_facility" value="<?php echo esc_attr($results['facility']); ?>" id="form1-facility" placeholder="Facility">
        </div>
    </div>
    <div class="input-rows">
        <div class="input-wrapper w-full">
            <label for="form1-ipos-goals">Identified IPOS Goals</label>
            <textarea name="_goals" id="form1-ipos-goals" rows="4" placeholder="Identified IPOS Goals"><?php echo esc_textarea($results['goals']); ?></textarea>
        </div>
    </div>
    <div class="input-rows">
        <div class="input-wrapper w-half">
            <label for="form1-pc-hours">PC Hours</label>
            <input type="text" name="_pc_hours" value="<?php echo esc_attr($results['pc_hours']); ?>" id="form1-pc-hours" placeholder="PC Hours">
        </div>
        <div class="input-wrapper w-half">
            <label for="form1-cls-hours">CLS Hours</label>
            <input type="text" name="_cls_hours" value="<?php echo esc_attr($results['cls_hours']); ?>" id="form1-cls-hours" placeholder="CLS Hours">
        </div>
        <div class="w-16">
            <div class="">
                <input type="checkbox" name="_idd" id="_idd" value="1" <?php checked($results['idd'] , 1); ?>>
                <label for="_idd" style="font-size: 1rem;">IDD</label>
            </div>
            <div class="">
                <input type="checkbox" name="_ami" id="_ami" value="1" <?php checked($results['ami'] , 1); ?>>
                <label for="_ami" style="font-size: 1rem;">AMI</label>
            </div>
        </div>
    </div>
</div>