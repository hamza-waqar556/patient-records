<?php

/**
 * @package TourBooking
 */

namespace Inc\Api\Callbacks;

class CptCallbacks
{
    public function cptSanitize( $input )
    {

        $output = get_option( 'tour_booking_cpt' );

        // If user wants to remove a CPT || Data from the CPT will not be removed
        if ( isset( $_POST[ 'remove' ] ) ) {
            unset( $output[ $_POST[ 'remove' ] ] );
            return $output;
        }

        // If the option is empty || foreach wont work in this scenario
        if ( count( $output ) == 0 ) {
            $output[ $input[ 'post_type' ] ] = $input;
            return $output;
        }

        // Check if already exists in array if does update the value else add new
        foreach ( $output as $key => $value ) {
            if ( $input[ 'post_type' ] === $key ) {
                $output[ $key ] = $input;
            } else {
                $output[ $input[ 'post_type' ] ] = $input;
            }
        }

        return $output;
    }

    public function cptSectionManager()
    {
        echo 'Create as many Custom Post Types as you want.';
    }

    public function textField( $args )
    {
        $name        = $args[ 'label_for' ];
        $placeholder = $args[ 'placeholder' ];
        $option_name = $args[ 'option_name' ];
        $value       = '';
        $isDisabled  = 'required';

        if ( isset( $_POST[ 'edit_post' ] ) ) {
            $input = get_option( $option_name );
            $value = $input[ $_POST[ 'edit_post' ] ][ $name ];

            if ( 'post_type' == $name ) {
                $isDisabled = 'disabled';
            }
        }

        $text_field = <<<HTML
            <input type="text" id="$name" name="{$option_name}[$name]" value="$value" placeholder="Enter $placeholder" $isDisabled>
        HTML;

        echo $text_field;
    }

    public function checkboxField( $args )
    {
        $name        = $args[ 'label_for' ];
        $classes     = $args[ 'class' ];
        $option_name = $args[ 'option_name' ];
        $isChecked   = false;

        if ( isset( $_POST[ 'edit_post' ] ) ) {

            $checkbox  = get_option( $option_name );
            $isChecked = isset( $checkbox[ $_POST[ 'edit_post' ] ][ $name ] ) ? 'checked' : false;

        }

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
