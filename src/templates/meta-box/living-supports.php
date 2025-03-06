<?php

$saved_values = (array) get_post_meta($post->ID, '__c', true);

wp_nonce_field('record_living_support_nonce_action', 'record_living_support_nonce');
?>
<div>
    <?php
    echo "<pre>";
    print_r($saved_values);
    echo "</pre>";
    ?>
</div>
<div id="for-community">
    <div class="inner-heading">
        <h3>Community Living Supports Objectives</h3>
    </div>

    <div class="">
        <h4>
            C1 Meal Preparation/Kitchen Skills
        </h4>
        <input type="text" name="_c[0]" value="<?php echo esc_attr($saved_values[0]); ?>" id="c1" placeholder="C0">
        <input type="text" name="_c[54]" value="<?php echo esc_attr($saved_values[54] ?? $saved_values[54]); ?>" id="c1" placeholder="C00">
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c1-am">
                    AM
                </label>
                <input type="text" name="_c[1][am]" id="c1-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c1-am-min">
                    mins
                </label>
                <input type="text" name="_c[1][am-min]" id="c1-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c1-pm">
                    PM
                </label>
                <input type="text" name="_c[1][pm]" id="c1-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c1-pm-min">
                    mins
                </label>
                <input type="text" name="_c[1][pm-min]" id="c1-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c1-mn">
                    MN
                </label>
                <input type="text" name="_c[1][mn]" id="c1-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c1-mn-min">
                    mins
                </label>
                <input type="text" name="_c[1][mn-min]" id="c1-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c1-description">
                    Description
                </label>
                <input type="text" name="_c[1][description]" id="c1-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C2 Laundry
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c2-am">
                    AM
                </label>
                <input type="text" name="_c[2][am]" id="c2-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c2-am-min">
                    mins
                </label>
                <input type="text" name="_c[2][am-min]" id="c2-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c2-pm">
                    PM
                </label>
                <input type="text" name="_c[2][pm]" id="c2-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c2-pm-min">
                    mins
                </label>
                <input type="text" name="_c[2][pm-min]" id="c2-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c2-mn">
                    MN
                </label>
                <input type="text" name="_c[2][mn]" id="c2-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c2-mn-min">
                    mins
                </label>
                <input type="text" name="_c[2][mn-min]" id="c2-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c2-description">
                    Description
                </label>
                <input type="text" name="_c[2][description]" id="c2-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C3 Housekeeping Skills
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c3-am">
                    AM
                </label>
                <input type="text" name="_c[3][am]" id="c3-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c3-am-min">
                    mins
                </label>
                <input type="text" name="_c[3][am-min]" id="c3-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c3-pm">
                    PM
                </label>
                <input type="text" name="_c[3][pm]" id="c3-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c3-pm-min">
                    mins
                </label>
                <input type="text" name="_c[3][pm-min]" id="c3-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c3-mn">
                    MN
                </label>
                <input type="text" name="_c[3][mn]" id="c3-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c3-mn-min">
                    mins
                </label>
                <input type="text" name="_c[3][mn-min]" id="c3-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c3-description">
                    Description
                </label>
                <input type="text" name="_c[3][description]" id="c3-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C4 Behavioral Interventions Needed
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c4-am">
                    AM
                </label>
                <input type="text" name="_c[4][am]" id="c4-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c4-am-min">
                    mins
                </label>
                <input type="text" name="_c[4][am-min]" id="c4-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c4-pm">
                    PM
                </label>
                <input type="text" name="_c[4][pm]" id="c4-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c4-pm-min">
                    mins
                </label>
                <input type="text" name="_c[4][pm-min]" id="c4-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c4-mn">
                    MN
                </label>
                <input type="text" name="_c[4][mn]" id="c4-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c4-mn-min">
                    mins
                </label>
                <input type="text" name="_c[4][mn-min]" id="c4-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c4-description">
                    Description
                </label>
                <input type="text" name="_c[4][description]" id="c4-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C5 Total Shopping
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c5-am">
                    AM
                </label>
                <input type="text" name="_c[5][am]" id="c5-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c5-am-min">
                    mins
                </label>
                <input type="text" name="_c[5][am-min]" id="c5-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c5-pm">
                    PM
                </label>
                <input type="text" name="_c[5][pm]" id="c5-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c5-pm-min">
                    mins
                </label>
                <input type="text" name="_c[5][pm-min]" id="c5-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c5-mn">
                    MN
                </label>
                <input type="text" name="_c[5][mn]" id="c5-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c5-mn-min">
                    mins
                </label>
                <input type="text" name="_c[5][mn-min]" id="c5-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c5-description">
                    Description
                </label>
                <input type="text" name="_c[5][description]" id="c5-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C6 Money Management
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c6-am">
                    AM
                </label>
                <input type="text" name="_c[6][am]" id="c6-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c6-am-min">
                    mins
                </label>
                <input type="text" name="_c[6][am-min]" id="c6-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c6-pm">
                    PM
                </label>
                <input type="text" name="_c[6][pm]" id="c6-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c6-pm-min">
                    mins
                </label>
                <input type="text" name="_c[6][pm-min]" id="c6-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c6-mn">
                    MN
                </label>
                <input type="text" name="_c[6][mn]" id="c6-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c6-mn-min">
                    mins
                </label>
                <input type="text" name="_c[6][mn-min]" id="c6-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c6-description">
                    Description
                </label>
                <input type="text" name="_c[6][description]" id="c6-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C7 Community/Socialization Skills
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c7-am">
                    AM
                </label>
                <input type="text" name="_c[7][am]" id="c7-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c7-am-min">
                    mins
                </label>
                <input type="text" name="_c[7][am-min]" id="c7-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c7-pm">
                    PM
                </label>
                <input type="text" name="_c[7][pm]" id="c7-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c7-pm-min">
                    mins
                </label>
                <input type="text" name="_c[7][pm-min]" id="c7-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c7-mn">
                    MN
                </label>
                <input type="text" name="_c[7][mn]" id="c7-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c7-mn-min">
                    mins
                </label>
                <input type="text" name="_c[7][mn-min]" id="c7-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c7-description">
                    Description
                </label>
                <input type="text" name="_c[7][description]" id="c7-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C8 Attending Medical Appointments
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c8-am">
                    AM
                </label>
                <input type="text" name="_c[8][am]" id="c8-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c8-am-min">
                    mins
                </label>
                <input type="text" name="_c[8][am-min]" id="c8-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c8-pm">
                    PM
                </label>
                <input type="text" name="_c[8][pm]" id="c8-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c8-pm-min">
                    mins
                </label>
                <input type="text" name="_c[8][pm-min]" id="c8-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c8-mn">
                    MN
                </label>
                <input type="text" name="_c[8][mn]" id="c8-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c8-mn-min">
                    mins
                </label>
                <input type="text" name="_c[8][mn-min]" id="c8-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c8-description">
                    Description
                </label>
                <input type="text" name="_c[8][description]" id="c8-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C9 Medication Instruction Skills
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c9-am">
                    AM
                </label>
                <input type="text" name="_c[9][am]" id="c9-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c9-am-min">
                    mins
                </label>
                <input type="text" name="_c[9][am-min]" id="c9-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c9-pm">
                    PM
                </label>
                <input type="text" name="_c[9][pm]" id="c9-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c9-pm-min">
                    mins
                </label>
                <input type="text" name="_c[9][pm-min]" id="c9-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c9-mn">
                    MN
                </label>
                <input type="text" name="_c[9][mn]" id="c9-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c9-mn-min">
                    mins
                </label>
                <input type="text" name="_c[9][mn-min]" id="c9-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c9-description">
                    Description
                </label>
                <input type="text" name="_c[9][description]" id="c9-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C10 Health &amp; Safety/Medical Complexity
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c10-am">
                    AM
                </label>
                <input type="text" name="_c[10][am]" id="c10-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c10-am-min">
                    mins
                </label>
                <input type="text" name="_c[10][am-min]" id="c10-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c10-pm">
                    PM
                </label>
                <input type="text" name="_c[10][pm]" id="c10-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c10-pm-min">
                    mins
                </label>
                <input type="text" name="_c[10][pm-min]" id="c10-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c10-mn">
                    MN
                </label>
                <input type="text" name="_c[10][mn]" id="c10-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c10-mn-min">
                    mins
                </label>
                <input type="text" name="_c[10][mn-min]" id="c10-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c10-description">
                    Description
                </label>
                <input type="text" name="_c[10][description]" id="c10-description" placeholder="Description">
            </div>
        </div>
    </div>

    <div class="">
        <h4>
            C11 Symptoms/Stress Management Skills
        </h4>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c11-am">
                    AM
                </label>
                <input type="text" name="_c[11][am]" id="c11-am" placeholder="AM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c11-am-min">
                    mins
                </label>
                <input type="text" name="_c[11][am-min]" id="c11-am-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-25">
                <label for="c11-pm">
                    PM
                </label>
                <input type="text" name="_c[11][pm]" id="c11-pm" placeholder="PM">
            </div>
            <div class="input-wrapper w-25">
                <label for="c11-pm-min">
                    mins
                </label>
                <input type="text" name="_c[11][pm-min]" id="c11-pm-min" placeholder="Mins">
            </div>
        </div>
        <div class="input-rows">
            <div class="input-wrapper w-25">
                <label for="c11-mn">
                    MN
                </label>
                <input type="text" name="_c[11][mn]" id="c11-mn" placeholder="MN">
            </div>
            <div class="input-wrapper w-25">
                <label for="c11-mn-min">
                    mins
                </label>
                <input type="text" name="_c[11][mn-min]" id="c11-mn-min" placeholder="Mins">
            </div>
            <div class="input-wrapper w-half">
                <label for="c11-description">
                    Description
                </label>
                <input type="text" name="_c[11][description]" id="c11-description" placeholder="Description">
            </div>
        </div>
    </div>
</div>