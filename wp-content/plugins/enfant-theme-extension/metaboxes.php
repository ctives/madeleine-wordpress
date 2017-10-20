<?php


/**
 * Event Location Metabox
 */


function enfant_event_location_add_meta_box() {

    $screens = array( 'event' );

    foreach ( $screens as $screen ) {
        add_meta_box( 'enfant_event_location_id',  esc_html__( 'Event Location', 'zoutula' ), 'enfant_event_location_add_meta_box_callback', $screen, 'side' );
    }
}
add_action( 'add_meta_boxes', 'enfant_event_location_add_meta_box');



function enfant_event_location_add_meta_box_callback($post ) {
    wp_nonce_field( 'enfant_meta_box', 'enfant_meta_box_nonce' );

    $enfant_event_location = get_post_meta( $post->ID, 'enfant_event_location', true );
    ?>
    <div class="custom_meta_box">
        <p>
            <label> <?php echo esc_html__( 'Add event location','zoutula' ); ?> </label> <br />
            <input class="widefat" type="text" name="enfant_event_location" value="<?php echo esc_attr( $enfant_event_location ); ?>"/>
        </p>
        <div class="clear"></div>
    </div>
    <?php
}



function enfant_save_meta_box_event_location_data($post_id ) {
    if ( ! isset( $_POST['enfant_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['enfant_meta_box_nonce'] ), 'enfant_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['enfant_event_location'] ) ) { // Input var okay.
        $enfant_event_location =  sanitize_text_field( wp_unslash( $_POST['enfant_event_location'] ) ) ; // Input var okay.
    }

    update_post_meta( $post_id, 'enfant_event_location', $enfant_event_location );
}
add_action( 'save_post', 'enfant_save_meta_box_event_location_data');



/**
 * Event Start Date Metabox
 */


function enfant_event_start_date_add_meta_box() {

    $screens = array( 'event' );

    foreach ( $screens as $screen ) {
        add_meta_box( 'enfant_event_start_date_id',  esc_html__( 'Event Date', 'zoutula' ), 'enfant_event_start_date_add_meta_box_callback', $screen, 'side' );
    }
    //add library and its CSS
    add_action( 'admin_enqueue_scripts', 'enfant_add_admin_scripts');
}
add_action( 'add_meta_boxes', 'enfant_event_start_date_add_meta_box');


function enfant_add_admin_scripts(){
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style('jquery-ui-style','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css',true);
}


function enfant_event_start_date_add_meta_box_callback($post ) {
    wp_nonce_field( 'enfant_meta_box', 'enfant_meta_box_nonce' );

    $enfant_event_start_date = get_post_meta( $post->ID, 'enfant_event_start_date', true );
    ?>
    <div class="custom_meta_box">
        <p>
            <label> <?php echo esc_html__( 'Add event date','zoutula' ); ?> </label> <br />
            <input class="widefat ztl-date-picker" type="text" name="enfant_event_start_date" value="<?php echo esc_attr( $enfant_event_start_date ); ?>"/>
        </p>
        <div class="clear"></div>
    </div>
    <script>
        (function( $ ) {
            'use strict';
            $(function() {
                $('.ztl-date-picker').datepicker({dateFormat : 'yy-mm-dd'});
            });
        })( jQuery );

    </script>
    <?php
}

function enfant_save_meta_box_event_start_date_data($post_id ) {
    if ( ! isset( $_POST['enfant_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['enfant_meta_box_nonce'] ), 'enfant_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['enfant_event_start_date'] ) ) { // Input var okay.
        $enfant_event_start_date =  sanitize_text_field( wp_unslash( $_POST['enfant_event_start_date'] ) ) ; // Input var okay.
    }

    update_post_meta( $post_id, 'enfant_event_start_date', $enfant_event_start_date );
}
add_action( 'save_post', 'enfant_save_meta_box_event_start_date_data');


/**
 * Event Duration Metabox
 */


function enfant_event_duration_add_meta_box() {

    $screens = array( 'event' );

    foreach ( $screens as $screen ) {
        add_meta_box( 'enfant_event_duration_id',  esc_html__( 'Event Duration', 'zoutula' ), 'enfant_event_duration_add_meta_box_callback', $screen, 'side' );
    }
}
add_action( 'add_meta_boxes', 'enfant_event_duration_add_meta_box');



function enfant_event_duration_add_meta_box_callback($post ) {
    wp_nonce_field( 'enfant_meta_box', 'enfant_meta_box_nonce' );

    $enfant_event_duration = get_post_meta( $post->ID, 'enfant_event_duration', true );
    ?>
    <div class="custom_meta_box">
        <p>
            <label> <?php echo esc_html__( 'Add event duration','zoutula' ); ?> </label> <br />
            <input class="widefat" type="text" name="enfant_event_duration" value="<?php echo esc_attr( $enfant_event_duration ); ?>"/>
        </p>
        <div class="clear"></div>
    </div>
    <?php
}



function enfant_save_meta_box_event_duration_data($post_id ) {
    if ( ! isset( $_POST['enfant_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['enfant_meta_box_nonce'] ), 'enfant_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['enfant_event_duration'] ) ) { // Input var okay.
        $enfant_event_duration =  sanitize_text_field( wp_unslash( $_POST['enfant_event_duration'] ) ) ; // Input var okay.
    }

    update_post_meta( $post_id, 'enfant_event_duration', $enfant_event_duration );
}
add_action( 'save_post', 'enfant_save_meta_box_event_duration_data');


function enfant_sidebar_options_add_meta_box() {

    $screens = array( 'post' );

    foreach ( $screens as $screen ) {
        add_meta_box( 'enfant_sidebar_options_id', esc_html__( 'Sidebar options', 'zoutula' ), 'enfant_sidebar_options_meta_box_callback', $screen , 'side' );
    }

}
add_action( 'add_meta_boxes', 'enfant_sidebar_options_add_meta_box' );




function enfant_sidebar_options_meta_box_callback( $post ) {
    wp_nonce_field( 'enfant_meta_box', 'enfant_meta_box_nonce' );
    $enfant_sidebar_option = get_post_meta( $post->ID, 'enfant_sidebar_option', true );
    if ( empty( $enfant_sidebar_option ) ) {
        $enfant_sidebar_option = 'right'; // default right if nothing has been set
    }
    ?>
    <div class="custom_meta_box">
        <p>
            <label><?php echo esc_html__( 'Select sidebar position:','zoutula' ); ?> </label> <br />
            <input type="radio" name="enfant_sidebar_option" <?php if ( 'right' == $enfant_sidebar_option  ) {echo 'checked'; } ?> value="right">Right<br />
            <input type="radio" name="enfant_sidebar_option" <?php if ( 'disabled' == $enfant_sidebar_option  ) {echo 'checked'; } ?> value="disabled">Disabled
        </p>
        <div class="clear"></div>
    </div>
    <?php
}


function enfant_save_sidebar_options( $post_id ) {
    if ( ! isset( $_POST['enfant_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['enfant_meta_box_nonce'] ), 'enfant_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $enfant_sidebar_option = '';
    if ( isset( $_POST['enfant_sidebar_option'] ) && in_array( wp_unslash( $_POST['enfant_sidebar_option'] ), array( 'right', 'disabled' ) ) ) { // Input var okay.
        $enfant_sidebar_option = sanitize_text_field( wp_unslash( $_POST['enfant_sidebar_option'] ) ); // Input var okay.
    }

    update_post_meta( $post_id, 'enfant_sidebar_option', $enfant_sidebar_option );
}
add_action( 'save_post', 'enfant_save_sidebar_options' );


//
// Display header option
//
function enfant_header_options_add_meta_box() {

    $screens = array( 'page','post' );
    global $post;

    foreach ( $screens as $screen ) {
        if ( ! empty( $post ) ) {
            add_meta_box( 'enfant_header_options_id', esc_html__( 'Show Header','zoutula' ), 'enfant_header_options_meta_box_callback', $screen, 'side' );
        }
    }

}
add_action( 'add_meta_boxes', 'enfant_header_options_add_meta_box' );

function enfant_header_options_meta_box_callback( $post ) {
    wp_nonce_field( 'enfant_meta_box', 'enfant_meta_box_nonce' );
    $enfant_header_option = get_post_meta( $post->ID, 'enfant_header_option', true );
    if ( empty( $enfant_header_option ) ) {
        $enfant_header_option = 'visible';
    }
    ?>
    <div class="custom_meta_box">
        <p>
            <label><?php echo esc_html__( 'Show Header','zoutula' ); ?> </label> <br />
            <input type="radio" name="enfant_header_option" <?php if ( 'visible' == $enfant_header_option  ) {echo 'checked'; } ?> value="visible">Visible<br />
            <input type="radio" name="enfant_header_option" <?php if ( 'hidden' == $enfant_header_option  ) {echo 'checked'; } ?> value="hidden">Hidden<br />
        </p>
        <div class="clear"></div>
    </div>
    <?php
}


function enfant_save_header_options( $post_id ) {
    if ( ! isset( $_POST['enfant_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['enfant_meta_box_nonce'] ), 'enfant_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $enfant_header_option = '';
    if ( isset( $_POST['enfant_header_option'] ) && in_array( wp_unslash( $_POST['enfant_header_option'] ), array( 'visible', 'hidden' ) ) ) { // Input var okay.
        $enfant_header_option = sanitize_text_field( wp_unslash( $_POST['enfant_header_option'] ) ); // Input var okay.

    }

    update_post_meta( $post_id, 'enfant_header_option', $enfant_header_option );
}
add_action( 'save_post', 'enfant_save_header_options' );