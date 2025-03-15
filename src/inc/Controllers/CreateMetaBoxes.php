<?php

namespace Inc\Controllers;

use Inc\Base\BaseController;
use Inc\Api\MetaBoxGenerator;

/**
 * CreateMetaBoxes
 *
 * Registers meta boxes for the plugin and defines configuration for each.
 */
class CreateMetaBoxes extends BaseController
{
    public $mb_generator;
    public $meta_boxes = [];

    /**
     * Register meta boxes.
     */
    public function register()
    {
        $this->mb_generator = new MetaBoxGenerator();
        $this->setMetaBoxes();
        $this->mb_generator->register();
    }

    /**
     * Set meta box configurations.
     */
    public function setMetaBoxes()
    {
        $this->meta_boxes = [
            [
                'cpt'           => 'record',
                'fields'        => [
                    '_search_member',
                    '_search_mhwin_id',
                    '_download_pdf',
                ],
                'nonce_name'    => 'search_record_nonce',
                'nonce_action'  => 'search_record_nonce_action',
                'template_path' => 'search-patient.php',
                'title'         => 'Search to autofill patient data',
            ],
            [
                'cpt'           => 'record',
                'fields'        => [
                    '_member',
                    '_mhwin_id',
                    '_date',
                    '_crsp',
                    '_facility',
                    '_goals',
                    '_pc_hours',
                    '_cls_hours',
                    '_idd',
                    '_ami'
                ],
                'nonce_name'    => 'record_patient_details_nonce',
                'nonce_action'  => 'record_patient_details_nonce_action',
                'template_path' => 'patient-details.php',
                'title'         => 'Patient Details',
            ],
            [
                'cpt'           => 'record',
                'fields'        => ['_c'],
                'nonce_name'    => 'record_living_support_nonce',
                'nonce_action'  => 'record_living_support_nonce_action',
                'template_path' => 'living-supports.php',
                'title'         => 'Community Living Support Objectives',
            ],
            [
                'cpt'           => 'record',
                'fields'        => ['_p'],
                'nonce_name'    => 'record_personal_care_nonce',
                'nonce_action'  => 'record_personal_care_nonce_action',
                'template_path' => 'personal-care.php',
                'title'         => 'Personal Care Objectives',
            ],
            [
                'cpt'           => 'record',
                'fields'        => [],
                'nonce_name'    => 'record_progress_report_nonce',
                'nonce_action'  => 'record_progress_report_nonce_action',
                'template_path' => 'progress-report-repeater.php',
                'title'         => 'Progress Report',
            ],
        ];

        foreach ($this->meta_boxes as $meta_box)
        {
            $this->mb_generator->setConfig(
                $meta_box['cpt'],
                $meta_box['fields'],
                $meta_box['nonce_name'],
                $meta_box['nonce_action'],
                $meta_box['template_path'],
                $meta_box['title']
            );
        }
    }
}
