<?php

$mhwin_id = get_post_meta($post->ID, '__mhwin_id', true);
$date = get_post_meta($post->ID, '__date', true);
$staff_initials = get_post_meta($post->ID, '__staff_initials', true);
$task_id = get_post_meta($post->ID, '__task_id', true);
$add_note = get_post_meta($post->ID, '__add_note', true);
$staff_type = get_post_meta($post->ID, '__staff_type', true);
$progress_code = get_post_meta($post->ID, '__progress_code', true);

$member = get_post_meta($post->ID, '__member', true);
$checkbox_select = get_post_meta($post->ID, '__checkbox_select', true);
$checkboxes = (array) get_post_meta($post->ID, '__checkboxes', true);

$results = [
    'mhwin_id'        => !empty(get_post_meta($post->ID, '__mhwin_id', true)) ? sanitize_text_field(get_post_meta($post->ID, '__mhwin_id', true)) : '',
    'date'            => !empty(get_post_meta($post->ID, '__date', true)) ? sanitize_text_field(get_post_meta($post->ID, '__date', true)) : '',
    'staff_initials'  => !empty(get_post_meta($post->ID, '__staff_initials', true)) ? sanitize_text_field(get_post_meta($post->ID, '__staff_initials', true)) : '',
    'task_id'         => !empty(get_post_meta($post->ID, '__task_id', true)) ? absint(get_post_meta($post->ID, '__task_id', true)) : 0,
    'add_note'        => !empty(get_post_meta($post->ID, '__add_note', true)) ? sanitize_textarea_field(get_post_meta($post->ID, '__add_note', true)) : '',
    'staff_type'      => !empty(get_post_meta($post->ID, '__staff_type', true)) ? sanitize_text_field(get_post_meta($post->ID, '__staff_type', true)) : '',
    'progress_code'   => !empty(get_post_meta($post->ID, '__progress_code', true)) ? sanitize_text_field(get_post_meta($post->ID, '__progress_code', true)) : '',
    'member'          => !empty(get_post_meta($post->ID, '__member', true)) ? sanitize_text_field(get_post_meta($post->ID, '__member', true)) : '',
    'checkbox_select' => !empty(get_post_meta($post->ID, '__checkbox_select', true)) ? sanitize_text_field(get_post_meta($post->ID, '__checkbox_select', true)) : '',
    'checkboxes'      => array_map('sanitize_text_field', (array) get_post_meta($post->ID, '__checkboxes', true)),
];

// ! --------------------->

use \Inc\Components\CheckboxSelect;
use \Inc\Base\BaseController;

$baseController = new BaseController();
$jsonFilePath = $baseController->plugin_path . 'src/assets/data/service-options.json';
$component = new CheckboxSelect($jsonFilePath, true);
$jsonData = $component->json;


$selectedKey = 'c5';




?>

<div>
    <?php

    echo "<pre>";
    print_r($results);
    echo "</pre>";

    ?>
</div>
<div>
    <div class="input-rows">
        <div class="input-wrapper w-33">
            <label for="form2-member"> member </label>
            <input type="text" name="_member" id="form2-member" placeholder="Member" value="<?php echo $results['member']; ?>">
        </div>
        <div class="input-wrapper w-33">
            <label for="form2-mhwin-id"> MHWIN ID# </label>
            <input type="text" name="_mhwin_id" id="form2-mhwin-id" placeholder="MHWIN ID#" value="<?php echo $results['mhwin_id']; ?>">
        </div>
        <div class="input-wrapper w-33">
            <label for="form2-date"> date </label>
            <input type="date" name="_date" id="form2-date" placeholder="Date" value="<?php echo $results['date']; ?>">
        </div>
    </div>

    <!-- Dynamic Select & Checkboxes -->
    <div class="meta-box-select-component">
        <div class="select-wrapper">
            <?php echo $component->renderSelect($selectedKey, '_checkbox_select'); ?>
        </div>
        <div class="tabs-wrapper">
            <?php echo $component->renderCheckboxes($selectedKey, '_checkboxes'); ?>
        </div>
    </div>
</div>


<script>
    var metaOptions = <?php echo json_encode($jsonData) ?>;
</script>