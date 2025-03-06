<?php

function customMetaBoxes()
{
    add_meta_box(
        'hotels_cpt_fields', // Meta Box ID
        'Additional Information', // Title
        'addHotelsFields', // Callback Function
        'hotel', // Change this to your CPT slug
        'normal',
        'high'
    );
}

add_action( 'add_meta_boxes', 'custom_meta_boxes' );

function addHotelsFields( $post )
{
    // Get saved values
    $status          = get_post_meta( $post->ID, '_status', true );
    $featured        = get_post_meta( $post->ID, '_featured', true );
    $feature_img     = get_post_meta( $post->ID, '_feature_img', true );
    $check_in        = get_post_meta( $post->ID, '_check_in', true );
    $check_out       = get_post_meta( $post->ID, '_check_out', true );
    $currency        = get_post_meta( $post->ID, '_currency', true );
    $user_email      = get_post_meta( $post->ID, '_user_email', true );
    $refundable      = get_post_meta( $post->ID, '_refundable', true );
    $rating          = get_post_meta( $post->ID, '_rating', true );
    $hotel_amenities = get_post_meta( $post->ID, '_hotel_amenities', true );
    $booking_age     = get_post_meta( $post->ID, '_booking_age', true );

    // Get all users
    $users = get_users( [ 'fields' => [ 'ID', 'user_email' ] ] );

    // Nonce for security
    wp_nonce_field( 'custom_meta_box_nonce_action', 'custom_meta_box_nonce' );

    ?>
    <p>
        <label>Status:</label>
        <input type="checkbox" name="status" value="1" <?php checked( $status, 1 ); ?> />
    </p>

    <p>
        <label>Featured:</label>
        <input type="checkbox" name="featured" value="1" <?php checked( $featured, 1 ); ?> />
    </p>

    <p>
        <label>Feature Image:</label>
        <input type="text" name="feature_img" id="feature_img" value="<?php echo esc_attr( $feature_img ); ?>" />
        <button type="button" class="upload-image button">Upload Image</button>
    </p>

    <p>
        <label>Check In:</label>
        <input type="date" name="check_in" value="<?php echo esc_attr( $check_in ); ?>" />
    </p>

    <p>
        <label>Check Out:</label>
        <input type="date" name="check_out" value="<?php echo esc_attr( $check_out ); ?>" />
    </p>

    <p>
        <label>Currency:</label>
        <select name="currency">
            <option value="USD" <?php selected( $currency, 'USD' ); ?>>USD</option>
            <option value="EUR" <?php selected( $currency, 'EUR' ); ?>>EUR</option>
            <option value="GBP" <?php selected( $currency, 'GBP' ); ?>>GBP</option>
        </select>
    </p>

    <p>
        <label>User Email:</label>
        <select name="user_email">
            <?php foreach ( $users as $user ): ?>
                <option value="<?php echo esc_attr( $user->user_email ); ?>" <?php selected( $user_email, $user->user_email ); ?>>
                    <?php echo esc_html( $user->user_email ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label>Refundable:</label>
        <input type="checkbox" name="refundable" value="1" <?php checked( $refundable, 1 ); ?> />
    </p>

    <p>
        <label>Rating:</label>
        <select name="rating">
            <?php for ( $i = 0; $i <= 5; $i++ ): ?>
                <option value="<?php echo $i; ?>" <?php selected( $rating, $i ); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </p>

    <p>
        <label>Hotel Amenities:</label>
        <select name="hotel_amenities[]" multiple>
            <option value="wifi" <?php echo in_array( 'wifi', (array) $hotel_amenities ) ? 'selected' : ''; ?>>WiFi</option>
            <option value="pool" <?php echo in_array( 'pool', (array) $hotel_amenities ) ? 'selected' : ''; ?>>Pool</option>
            <option value="parking" <?php echo in_array( 'parking', (array) $hotel_amenities ) ? 'selected' : ''; ?>>Parking</option>
        </select>
    </p>

    <p>
        <label>Booking Age Requirement:</label>
        <input type="number" name="booking_age" value="<?php echo esc_attr( $booking_age ); ?>" />
    </p>

    <?php
}

