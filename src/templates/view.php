
<?php

/**
 * @ ShortCode = [pdf_view]
 *
 * $data
 * $postData
 *
 * These two will be available when we click the preview button
 */

?>


<?php

//echo '<pre>';
//print_r($postData);
//echo '</pre>';
//
//return;

// Get the first item (top-level object)
$item = $postData[0];

// top checkboxes
$idd = isset($item['meta']['__idd']) ? $item['meta']['__idd'] : null;
$ami = isset($item['meta']['__ami']) ? $item['meta']['__ami'] : null;


// Save top-level fields
$ID        = isset($item['ID']) ? $item['ID'] : '';
$title     = isset($item['title']) ? $item['title'] : '';
$thumbnail = isset($item['thumbnail']) ? $item['thumbnail'] : '';

// Get meta data
$meta = isset($item['meta']) ? $item['meta'] : array();
$edit_last = isset($meta['_edit_last']) ? $meta['_edit_last'] : '';
$edit_lock = isset($meta['_edit_lock']) ? $meta['_edit_lock'] : '';

// Save the progress reports (which are nested inside an array)
// __progress_reports is an array whose first element contains the actual reports
$progressReports = isset($meta['__progress_reports'][0]) ? $meta['__progress_reports'][0] : array();

// Save header info from the first progress report
$headerReport = count($progressReports) > 0 ? $progressReports[0] : array();
$member_field   = isset($headerReport['member']) ? $headerReport['member'] : '';
$mhwin_id_field = isset($headerReport['mhwin_id']) ? $headerReport['mhwin_id'] : '';
$date     = isset($headerReport['date']) ? $headerReport['date'] : '';

// Save additional meta fields
$search_member    = isset($meta['__search_member']) ? $meta['__search_member'] : '';
$search_mhwin_id  = isset($meta['__search_mhwin_id']) ? $meta['__search_mhwin_id'] : '';
$member_meta      = isset($meta['__member']) ? $meta['__member'] : '';
$mhwin_id_meta    = isset($meta['__mhwin_id']) ? $meta['__mhwin_id'] : '';
$date_meta        = isset($meta['__date']) ? $meta['__date'] : '';
$crsp             = isset($meta['__crsp']) ? $meta['__crsp'] : '';
$facility         = isset($meta['__facility']) ? $meta['__facility'] : '';
$goals            = isset($meta['__goals']) ? $meta['__goals'] : '';
$pc_hours         = isset($meta['__pc_hours']) ? $meta['__pc_hours'] : '';
$cls_hours        = isset($meta['__cls_hours']) ? $meta['__cls_hours'] : '';

// Save the __c and __p objects (these are additional meta data objects)
$cObj = isset($meta['__c']) ? $meta['__c'] : array();
$pObj = isset($meta['__p']) ? $meta['__p'] : array();

// Optionally, loop through each progress report and store its fields into an array
$progressReportVars = array();
foreach ($progressReports as $index => $report) {
    // For the checkboxes fields, if it's an array, try to get the 'text' key; otherwise, implode its contents.
    $checkboxText = '';
    if (isset($report['checkboxes'])) {
        if (is_array($report['checkboxes'])) {
            $checkboxText = isset($report['checkboxes']['text'])
                ? $report['checkboxes']['text']
                : implode(' ', $report['checkboxes']);
        } else {
            $checkboxText = $report['checkboxes'];
        }
    }

    $progressReportVars[$index] = array(
        'member'          => isset($report['member']) ? $report['member'] : '',
        'mhwin_id'        => isset($report['mhwin_id']) ? $report['mhwin_id'] : '',
        'date'            => isset($report['date']) ? $report['date'] : '',
        'staff_initials'  => isset($report['staff_initials']) ? $report['staff_initials'] : '',
        'checkbox_select' => isset($report['checkbox_select']) ? $report['checkbox_select'] : '',
        'task_id'         => isset($report['task_id']) ? $report['task_id'] : '',
        'checkboxes'      => $checkboxText,
        'add_note'        => isset($report['add_note']) ? $report['add_note'] : '',
        'staff_type'      => isset($report['staff_type']) ? $report['staff_type'] : '',
        'progress_code'   => isset($report['progress_code']) ? $report['progress_code'] : ''
    );
}

// Define objective arrays for Community and Personal tables
$communityObjectives = array(
    'c1' => 'C1 Meal Preparation/Kitchen Skills',
    'c2' => 'C2 Laundry',
    'c3' => 'C3 Housekeeping Skills',
    'c4' => 'C4 Behavioral Interventions Needed',
    'c5' => 'C5 Total Shopping',
    'c6' => 'C6 Money Management',
    'c7' => 'C7 Community/Socialization Skills',
    'c8' => 'C8 Attending Medical Appointments',
    'c9' => 'C9 Medication Instruction Skills',
    'c10' => 'C10 Health & Safety/Medical Complexity',
    'c11' => 'C11 Symptoms/Stress Management Skills'
);
$personalObjectives = array(
    'p1' => 'P1 Eating/Feeding',
    'p2' => 'P2 Toileting',
    'p3' => 'P3 Showering/Bathing/Personal Hygiene',
    'p4' => 'P4 Dressing',
    'p5' => 'P5 Mobility/Transferring',
    'p6' => 'P6 Medication Knowledge/Administration',
    'p7' => 'P7 Complex Care'
);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Progress Note</title>
    <style>
        body {
            background-color: white;
            padding: 0;
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th,
        .report-table td {
            border: 1px solid black;
            padding: 6px;
            vertical-align: top;
        }

        .report-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: left;
        }





        .pdf-main-container {
            width: 740px;
            margin: 0 auto;
            text-align: left;
        }

        .page {
            /* margin-bottom: 10px; */
            width: 100%;
        }

        .heading {
            text-align: center;
            margin-bottom: 14px;
        }

        .heading h1,
        .heading h2 {
            margin: 0 0 8px 0;
            font-size: 16px;
            font-weight: 600;
        }

        .heading p {
            font-size: 12px;
            margin: 0;
        }

        .fields {
            padding: 4px;
            border-bottom: 1px solid #000;
            font-size: 10px;
            display: inline-block;
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px auto;
            table-layout: fixed;
        }

        table.layout {
            border: none;
        }

        table.layout td {
            border: none;
            padding: 4px 0;
            vertical-align: top;
        }

        th {
            font-weight: 600;
            background-color: #f2f2f2;
        }

        th,
        td {
            font-size: 10px;
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        tfoot td {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
        
        /* .wp-block-post-title{
            display: none !important;
        } */

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .pdf-main-container {
                width: 210mm;
                margin: 0 auto;
            }

            .page {
                width: 210mm;
                min-height: 350mm;
            }
        }
    </style>
</head>

<body>
<!-- Page 1: Header and Objectives Tables -->
<div class="pdf-main-container">
    <div class="page">
        <div class="">
            <div class="heading" style="width: 90%; display: inline-block; vertical-align: middle;">
                <h2>Detroit Wayne Integrated Health Network Daily Progress Note</h2>
                <p>Specialized Licensed Settings for CPT Codes H2016 &amp; T1020</p>
            </div>
            <div style="width: 8%; display: inline-block; vertical-align: middle; text-align: end;">
                <div>
                    <input type="checkbox" name="idd_result" id="idd_result" value="1" <?php checked($idd, '1'); ?>>
                    <label for="idd_result" style="font-size: 12px; display: inline-block; vertical-align: middle;">IDD</label>
                </div>
                <div style="width: 100%;">
                    <input type="checkbox" name="ami_result" id="ami_result" value="1" <?php checked($ami, '1'); ?>>
                    <label for="ami_result" style="font-size: 12px; display: inline-block; vertical-align: middle;">AMI</label>
                </div>
            </div>

        </div>
        <!-- Header Information -->
        <table class="layout">
            <tr>
                <td style="width: 20%;"><strong>Member:</strong> <span class="fields"><?php echo $member_meta; ?></span></td>
                <td style="width: 20%;"><strong>MHWIN ID#:</strong> <span class="fields"><?php echo $mhwin_id_meta; ?></span></td>
                <td style="width: 20%;"><strong>Date:</strong> <span class="fields"><?php echo $date_meta; ?></span></td>
                <td style="width: 20%"><strong>CRSP SC / CM:</strong>
                    <span class="fields"><?php echo $crsp; ?></span>
                </td>
                <td style="width: 20%">
                    <strong>Facility:</strong>
                    <span class="fields">
                            <?php echo $facility; ?>
                        </span>
                </td>
            </tr>
        </table>
        <table class="layout">
            <tr>
                <td style="width: 78%;">
                    <strong>Identified IPOS Goals:</strong>
                    <div class="fields">
                        <?php echo $goals; ?><br>
                    </div>
                </td>
                <td style="width: 10%; vertical-align: bottom;">
                    <strong>CLS Hours:</strong>
                    <span class="fields">
                            <?php echo $cls_hours; ?>
                        </span>
                </td>
                <td style="width: 10%; vertical-align: bottom;">
                    <strong>PC Hours:</strong>
                    <span class="fields">
                            <?php echo $pc_hours; ?>
                        </span>
                </td>
            </tr>
        </table>
        <!-- Community Living Supports Table (Dynamic) -->
        <table>
            <thead>
            <tr>
                <th style="width:5%;">AM</th>
                <th style="width:5%;">Min</th>
                <th style="width:5%;">PM</th>
                <th style="width:5%;">Min</th>
                <th style="width:5%;">MN</th>
                <th style="width:5%;">Min</th>
                <th style="width:25%;" class="text-left">Community Living Supports Objectives</th>
                <th style="width:45%;" class="text-left">CLS Objective</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cObj as $key => $obj):
                $amMin = isset($obj['am-min']) ? (int)$obj['am-min'] : 0;
                $pmMin = isset($obj['pm-min']) ? (int)$obj['pm-min'] : 0;
                $mnMin = isset($obj['mn-min']) ? (int)$obj['mn-min'] : 0;
                $rowTotal = $amMin + $pmMin + $mnMin;
                $grandTotalC += $rowTotal;
                ?>
                <tr>
                    <td class="text-center"><?php echo isset($obj['am']) ? $obj['am'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['am-min']) ? $obj['am-min'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['pm']) ? $obj['pm'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['pm-min']) ? $obj['pm-min'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['mn']) ? $obj['mn'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['mn-min']) ? $obj['mn-min'] : ''; ?></td>
                    <td class="text-left"><?php echo isset($communityObjectives['c' . $key]) ? $communityObjectives['c' . $key] : ''; ?></td>
                    <td class="text-left"><?php echo isset($obj['description']) ? $obj['description'] : ''; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-right">Total CLS Mins:</td>
                <td colspan="3" class="text-center">
                    <?php echo $grandTotalC; ?>
                </td>
                <td colspan="2"></td>
            </tr>
            </tfoot>
        </table>
        <!-- Personal Care Objectives Table (Dynamic) -->
        <table>
            <thead>
            <tr>
                <th style="width:5%;">AM</th>
                <th style="width:5%;">Min</th>
                <th style="width:5%;">PM</th>
                <th style="width:5%;">Min</th>
                <th style="width:5%;">MN</th>
                <th style="width:5%;">Min</th>
                <th style="width:25%;" class="text-left">Personal Care Objectives</th>
                <th style="width:45%;" class="text-left">PC Objective</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pObj as $key => $obj):
                $amMin = isset($obj['am-min']) ? (int)$obj['am-min'] : 0;
                $pmMin = isset($obj['pm-min']) ? (int)$obj['pm-min'] : 0;
                $mnMin = isset($obj['mn-min']) ? (int)$obj['mn-min'] : 0;
                $rowTotal = $amMin + $pmMin + $mnMin;
                $grandTotalP += $rowTotal;
                ?>
                <tr>
                    <td class="text-center"><?php echo isset($obj['am']) ? $obj['am'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['am-min']) ? $obj['am-min'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['pm']) ? $obj['pm'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['pm-min']) ? $obj['pm-min'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['mn']) ? $obj['mn'] : ''; ?></td>
                    <td class="text-center"><?php echo isset($obj['mn-min']) ? $obj['mn-min'] : ''; ?></td>
                    <td class="text-left"><?php echo isset($personalObjectives['p' . $key]) ? $personalObjectives['p' . $key] : ''; ?></td>
                    <td class="text-left"><?php echo isset($obj['description']) ? $obj['description'] : ''; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-right">Total PC Mins:</td>
                <td colspan="3" class="text-center">
                    <?php echo $grandTotalP; ?>
                </td>
                <td colspan="2"></td>
            </tr>
            </tfoot>
        </table>
        <!-- Signature Section -->
        <table class="layout" style="border: 1px solid #000;">
            <tr>
                <td style="width:70%; border-right: 1px solid #000; padding: 6px;">
                    <strong>Provider Supervisory Signature:</strong> <span class="fields"></span>
                </td>
                <td style="width:30%; padding: 6px;">
                    <strong>Date:</strong> <span class="fields"></span>
                </td>
            </tr>
        </table>
    </div>

    <!-- page breaker -->
    <div style="page-break-after: always;"></div>

    <!-- Page 2: Task Codes and Staff Section -->
    <div class="page">
        <table class="layout">
            <tr>
                <td style="width: 40%;"><strong>Member:</strong> <span class="fields"><?php echo $member_meta; ?></span></td>
                <td style="width: 40%;"><strong>MHWIN ID#:</strong> <span class="fields"><?php echo $mhwin_id_meta; ?></span></td>
                <td style="width: 20%;"><strong>Date:</strong> <span class="fields"><?php echo $date_meta; ?></span></td>
            </tr>
        </table>
        <div class="heading">
            <h2>Detroit Wayne Integrated Health Network Daily Progress Note</h2>
            <p>Specialized Licensed Settings for CPT Codes H2016 &amp; T1020</p>
        </div>
        <!-- TASK ID CODES -->
        <div style="text-align: center; margin-bottom: 10px; font-size: 14px;"><strong>TASK ID CODES</strong></div>
        <table>
            <tr>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>H</strong> = Hospitalization</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>M</strong> = Monitoring</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>R</strong> = Refusal</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>ED</strong> = Education/Day Program</td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>TC</strong> = Total Care</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>PA</strong> = Physical Assist</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>VP</strong> = Verbal Prompts</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>LOA</strong> = Leave of Absence</td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;" colspan="1"></td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>HOH</strong> = Hand Over Hand</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>I</strong> = Independent</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;" colspan="1"></td>
            </tr>
        </table>
        <!-- PROGRESS CODES -->
        <div style="text-align: center; margin: 10px 0; font-size: 14px;"><strong>PROGRESS CODES</strong></div>
        <table>
            <tr>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>IP</strong> = Increased Progress</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>DP</strong> = Decreased Progress</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"><strong>SP</strong> = Same Progress</td>
                <td style="width:25%; border: 1px solid #000; padding: 4px; text-align: center;"></td>
            </tr>
        </table>
        <!-- Staff Section: List each progress report with its staff initials -->
        <?php foreach ($progressReports as $report):
            $cbText = '';
            if (is_array($report['checkboxes'])) {
                $cbText = isset($report['checkboxes']['text'])
                    ? $report['checkboxes']['text']
                    : implode(' ', $report['checkboxes']);
            } else {
                $cbText = $report['checkboxes'];
            }
            ?>
            <table class="report-table" style="margin-top: 10px;">

                <tr class="report-row">
                    <td class="label-cell" style="width:12%; vertical-align: top;">
                        <strong>Staff Initials:</strong>
                        <span class="fields" style="padding: 0; border:none; width:20%;">
                                <?php echo isset($report['staff_initials']) ? $report['staff_initials'] : ''; ?>
                            </span>
                    </td>
                    <td class="label-cell" style="width:10%; vertical-align: top;">
                        <div style="margin-bottom: 8px;">
                            <strong style="display:inline-block; width:76%; ">CLS/PC:</strong>
                            <span class="fields" style="padding: 0; border:none; width:20%;">
                                    <!-- <?php echo isset($report['checkbox_select']) ? $report['checkbox_select'] : ''; ?> -->
                                    <?php
                                    $text = isset($report['checkbox_select']) ? $report['checkbox_select'] : '';
                                    $firstWord = strtok($text, " ");
                                    echo $firstWord;
                                    ?>

                                </span>
                        </div>
                        <div>
                            <strong style="display:inline-block; width:76%; ">Task ID:</strong>
                            <span class="fields" style="padding: 0; border:none; width:20%;">
                                    <?php echo isset($report['task_id']) ? $report['task_id'] : ''; ?>
                                </span>
                        </div>
                    </td>
                    <!--                         <td class="label-cell" style="width:8%; vertical-align: top;">
                            <strong>Task ID:</strong>
                            <span class="fields" style="padding: 0;">
                                <?php echo isset($report['task_id']) ? $report['task_id'] : ''; ?>
                            </span>
                        </td> -->

                    <td class="label-cell" style="width:20%; vertical-align: top;">
                        <strong>Staff Signature:</strong>
                        <span class="fields" style="margin-top: 6px; padding: 0; border:none;"></span>
                    </td>

                    <td class="label-cell" style="width:20%; vertical-align: top;">
                        <strong>Print Name:</strong>
                        <span class="fields" style="margin-top: 6px; padding: 0; border:none;"></span>
                    </td>
                    <td class="label-cell" style="width:10%; vertical-align: top;">
                        <strong>Credentials:</strong>
                        <span class="fields" style="margin-top: 6px; padding: 0; border:none;"></span>
                    </td>
                    <td class="label-cell" style="width:10%; vertical-align: top;">
                        <div style="margin-bottom: 8px;">
                            <strong style="display:inline-block; width:76%;">Staff Type:</strong>
                            <span class="fields" style="display:inline-block; padding: 0; border:none; width:20%;">
                                    <?php echo isset($report['staff_type']) ? $report['staff_type'] : ''; ?>
                                </span>
                        </div>
                        <div>
                            <strong style="display:inline-block; width:76%;">Progress Code:</strong>
                            <span class="fields" style="display:inline-block; padding: 0; border:none; width:20%;">
                                    <?php echo isset($report['progress_code']) ? $report['progress_code'] : ''; ?>
                                </span>
                        </div>
                    </td>
                    <!--                         <td class="label-cell" style="width:12%; vertical-align: top;">
                            <strong style="display:inline-block;">Progress Code:</strong>
                            <span class="fields" style="display:inline-block; padding: 0;"><?php echo isset($report['progress_code']) ? $report['progress_code'] : ''; ?></span>
                        </td> -->
                </tr>
            </table>
            <table>
                <tr class="report-row">
                    <td class="content-cell" style="width:100%; vertical-align: top;">
                        <?php echo $cbText; ?>
                        <br>
                        <?php echo isset($report['add_note']) ? $report['add_note'] : ''; ?>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>


    </div>
</div>
</body>

</html>