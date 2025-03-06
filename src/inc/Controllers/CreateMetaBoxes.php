<?php

namespace Inc\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\MetaBoxGenerator;

class CreateMetaBoxes extends BaseController
{
    public $mb_generator;
    public $meta_boxes = [];

    public function register()
    {
        $this->mb_generator = new MetaBoxGenerator();
        $this->setMetaBoxes();
        $this->mb_generator->register(); // Register after all meta boxes are configured
    }

    public function setMetaBoxes()
    {
        $this->meta_boxes = [
            [
                'record',
                [
                    '_member',
                    '_mhwin_id',
                    '_date',
                    '_crsp',
                    '_facility',
                    '_goals',
                    '_pc_hours',
                    '_cls_hours'
                ],
                'record_patient_details_nonce',
                'record_patient_details_nonce_action',
                'patient-details.php',
                'Patient Details',
            ],
            [
                'record',
                [
                    '_c'
                ],
                'record_living_support_nonce',
                'record_living_support_nonce_action',
                'living-supports.php',
                'Community Living Support Objectives',
            ],
            [
                'record',
                [
                    '_p'
                ],
                'record_personal_care_nonce',
                'record_personal_care_nonce_action',
                'personal-care.php',
                'Personal Care Objectives',
            ],
            [
                'record',
                [
                    '_member',
                    '_mhwin_id',
                    '_date',
                    '_staff_initials',
                    '_checkbox_select',
                    '_task_id',
                    '_checkboxes',
                    '_add_note',
                    '_staff_type',
                    '_progress_code',
                ],
                'record_progress_report_nonce',
                'record_progress_report_nonce_action',
                'progress-report.php',
                'Progress Report',
            ],
        ];

        foreach ($this->meta_boxes as $meta_box)
        {
            list($cpt, $fields, $nonce_name, $nonce_action, $template_path, $title) = $meta_box;
            $this->mb_generator->setConfig($cpt, $fields, $nonce_name, $nonce_action, $template_path, $title);
        }
    }
}
