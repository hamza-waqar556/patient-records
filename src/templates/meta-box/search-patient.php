<?php
// Get saved values
$member    = get_post_meta($post->ID, '__search_member', true);
$mhwin_id  = get_post_meta($post->ID, '__search_mhwin_id', true);

$post_id = get_the_ID();

use \Inc\Api\CptQueryHandler;

$query_class = new CptQueryHandler();


$results = $query_class
    ->setPostType('record')
    ->postId(65)
    ->getResults();

$patient_records = get_post_meta($post->ID, '__progress_reports', false);

$results[0]['meta']['__progress_reports'] = $patient_records;


wp_nonce_field('search_record_nonce_action', 'search_record_nonce');
?>
<section>
    <?php
    // echo "<pre>";
    // print_r($results);
    // echo "</pre>";
    ?>
</section>

<div class="form1-wrapper">

    <div class="input-rows">
        <input type="hidden" name="_post_data" id="_post_data" value="<?php echo esc_attr(json_encode($results)) ?>">
    </div>

    <div class="input-rows">
        <div class="input-wrapper w-half">
            <label for="_search_member">member</label>
            <input type="text" name="_search_member" value="<?php echo esc_attr($member); ?>" id="_search_member" placeholder="Member">
        </div>
        <div class="input-wrapper w-half">
            <label for="_search_mhwin_id">MHWIN ID#</label>
            <input type="text" name="_search_mhwin_id" value="<?php echo esc_attr($mhwin_id); ?>" id="_search_mhwin_id" placeholder="MHWIN ID#">
        </div>
    </div>

    <div class="button-wrapper w-full">
        <button type="submit">Auto Fill</button>
    </div>

    <button id="generate-pdf-button">Generate & Email PDF</button>

</div>