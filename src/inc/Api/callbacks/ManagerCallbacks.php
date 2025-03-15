<?php

/**
 * @package TourBooking
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
    public function checkboxSanitize($input)
    {
        $output = [];
        foreach ($this->prec_settings as $key => $value)
        {
            $output[$key] = isset($input[$key]) ? true : false;
        }
        return $output;
    }

    public function adminSectionManager()
    {
        return 'Activate or Deactivate the Features of your Plugin';
    }

    public function checkboxField($args)
    {
        $name        = $args['label_for'];
        $classes     = $args['class'];
        $option_name = $args['option_name'];

        // Fetch saved options
        $checkbox  = get_option($option_name);
        $isChecked = isset($checkbox[$name]) && $checkbox[$name] ? 'checked' : '';

        $checkbox_field = <<<HTML
            <div class="$classes">
                <input type="checkbox" id="$name" name="{$option_name}[$name]" value="1" $isChecked>
                <label for="$name">
                    <div></div>
                </label>
            </div>
        HTML;

        echo $checkbox_field;
    }
}
