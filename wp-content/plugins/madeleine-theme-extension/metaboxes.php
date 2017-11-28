<?php

/**
 * newsletter Start Date Metabox
 */


function madeleine_newsletter_start_date_add_meta_box() {

    $screens = array( 'newsletter' );

    foreach ( $screens as $screen ) {
        add_meta_box( 'madeleine_newsletter_start_date_id',  esc_html__( 'newsletter Date', 'zoutula' ), 'madeleine_newsletter_start_date_add_meta_box_callback', $screen, 'side' );
    }
    //add library and its CSS
    add_action( 'admin_enqueue_scripts', 'madeleine_add_admin_scripts');
}
add_action( 'add_meta_boxes', 'madeleine_newsletter_start_date_add_meta_box');


function madeleine_add_admin_scripts(){
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style('jquery-ui-style','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css',true);
}


function madeleine_newsletter_start_date_add_meta_box_callback($post ) {
    wp_nonce_field( 'madeleine_meta_box', 'madeleine_meta_box_nonce' );

    $madeleine_newsletter_start_date = get_post_meta( $post->ID, 'madeleine_newsletter_start_date', true );
    ?>
    <div class="custom_meta_box">
        <p>
            <label> <?php echo esc_html__( 'Add newsletter date','zoutula' ); ?> </label> <br />
            <input class="widefat ztl-date-picker" type="text" name="madeleine_newsletter_start_date" value="<?php echo esc_attr( $madeleine_newsletter_start_date ); ?>"/>
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
?>