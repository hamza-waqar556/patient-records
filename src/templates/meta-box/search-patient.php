<?php
// Get saved values
// $member    = get_post_meta($post->ID, '__search_member', true);
// $mhwin_id  = get_post_meta($post->ID, '__search_mhwin_id', true);

$post_id = get_the_ID();

use \Inc\Api\CptQueryHandler;

$query_class = new CptQueryHandler();


$results = $query_class
    ->setPostType('record')
    ->postId($post_id)
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

    <!-- This is the Hidden Data -->
    <div class="input-rows">
        <input type="hidden" name="_current_post_id" id="_current_post_id" value="<?php echo $post_id ?>">
        <input type="hidden" name="_post_data" id="_post_data" value="<?php echo esc_attr(json_encode($results)) ?>">
    </div>

    <!-- Search For AutoFill -->
    <div class="input-rows">
        <div class="input-wrapper w-half">
            <label for="_search_member">Member</label>
            <input type="text" name="_search_member" id="_search_member" placeholder="Member">
        </div>
        <div class="input-wrapper w-half">
            <label for="_search_mhwin_id">MHWIN ID#</label>
            <div class="select-wrapper">
                <select name="_search_mhwin_id" id="_search_mhwin_id">
                    <option disabled selected>Select MHWIN</option>
                </select>
            </div>
        </div>
    </div>



    <div class="input-rows">

        <div class="button-wrapper w-33">
            <button type="submit" id="auto-fill-button">Auto Fill</button>
        </div>

        <div class="button-wrapper w-33">
            <button id="generate-pdf-button">Send PDF</button>
        </div>

        <div class="button-wrapper w-33">
            <button type="button" id="_download_pdf" name="_download_pdf" class="btn">Download PDF</button>
        </div>
    </div>

</div>