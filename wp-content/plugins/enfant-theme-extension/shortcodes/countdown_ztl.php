<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('countdown_ztl', 'ztl_shortcode_countdown');
function ztl_shortcode_countdown($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'date' => '',
         'show_days' => '',
         'show_hours' => '',
         'show_minutes' => '',
         'show_seconds' => '',
         'text_color' => '',
         'columns' => '',
      ), $atts);

   $str = '';

  //display columns
  $output_show_days = ( $atts['show_days'] != 'yes' ) ? 'ztl-display-none' : '';
  $output_show_hours = ( $atts['show_hours'] != 'yes' ) ? 'ztl-display-none' : '';
  $output_show_minutes = ( $atts['show_minutes'] != 'yes' ) ? 'ztl-display-none' : '';
  $output_show_seconds = ( $atts['show_seconds'] != 'yes' ) ? 'ztl-display-none' : '';

  //labels
  $text_days = esc_html__('Days','zoutula');
  $text_hours = esc_html__('Hours','zoutula');
  $text_minutes = esc_html__('Minutes','zoutula');
  $text_seconds = esc_html__('Seconds','zoutula');

  $countdown_id = 'countdown_' . uniqid();

  $script = '
    <script type="text/javascript">
    (function($) { "use strict"; 

      //variables
      var display_date = "' . $atts['date'] . '";
      var grid = "' . $atts['columns'] . '";
      var countdown_id = "' . $countdown_id . '";

      var display_days = "' . $output_show_days . '";
      var display_hours = "' . $output_show_hours . '";
      var display_minutes = "' . $output_show_minutes . '";
      var display_seconds = "' . $output_show_seconds . '";

      //call
      $(document).ready(function(){
          $("#"+countdown_id).countdown({
            date: display_date,
            render: function(data) {
              $(this.el).html(" <div class=\"grid "+ grid +" "+ display_days +" \"> <h1 style=\"color:' . $atts['text_color'] . '\">"+ this.leadingZeros(data.days, 0) +"</h1> <span style=\"color:' . $atts['text_color'] . '\">' . $text_days . '</span></div> <div class=\"grid "+ grid +" "+ display_hours +" \"> <h1 style=\"color:' . $atts['text_color'] . '\">"+ this.leadingZeros(data.hours, 2) +"</h1> <span style=\"color:' . $atts['text_color'] . '\">' . $text_hours . '</span></div> <div class=\"grid "+ grid +" "+ display_minutes +" \"> <h1 style=\"color:' . $atts['text_color'] . '\">"+ this.leadingZeros(data.min, 2) +"</h1> <span style=\"color:' . $atts['text_color'] . '\">' . $text_minutes . '</span> </div> <div class=\"grid "+ grid +" "+ display_seconds +" \"> <h1 style=\"color:' . $atts['text_color'] . '\">"+ this.leadingZeros(data.sec, 2) +"</h1> <span style=\"color:' . $atts['text_color'] . '\">' . $text_seconds . '</span></div>");
            }
          });
      });

    })(jQuery);
    </script>
  ';

  $str .= '<div id="' . $countdown_id . '" class="ztl-countdown"></div>'.$script.'';

  return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'ztl_countdown' );
function ztl_countdown() {
   vc_map( array(
      'name' => esc_html__( 'Countdown', 'zoutula' ),
      'base' => 'countdown_ztl',
      'description' => esc_html__( 'Add event countdown', 'zoutula' ),
      'show_settings_on_create' => true,
      'icon' => plugin_dir_url(__FILE__) . 'assets/images/countdown.png',
      'class' => '',
      'category' => esc_html__( 'Zoutula Shortcodes', 'zoutula'),
      'params' => array(

         array(
            'type' => 'textfield',
            'class' => '',
            'heading' => esc_html__( 'Date', 'zoutula' ),
            'param_name' => 'date',
            'admin_label' => true,
            'description' => esc_html__( 'Insert the Date E.g. May 23, 2018 12:14:20', 'zoutula' )
         ),
         array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show Days', 'zoutula' ),
            'param_name' => 'show_days',
            'description' => esc_html__( 'Check it for display days', 'zoutula' ),
            'value' => array(
              esc_html__( '', 'zoutula' ) => 'yes'
            )
          ),
         array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show Hours', 'zoutula' ),
            'param_name' => 'show_hours',
            'description' => esc_html__( 'Check it for display hours', 'zoutula' ),
            'value' => array(
                esc_html__( '', 'zoutula' ) => 'yes'
            )
          ),
         array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show Minutes', 'zoutula' ),
            'param_name' => 'show_minutes',
            'description' => esc_html__( 'Check it for display minutes', 'zoutula' ),
            'value' => array(
                esc_html__( '', 'zoutula' ) => 'yes'
            )
          ),

         array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show Seconds', 'zoutula' ),
            'param_name' => 'show_seconds',
            'description' => esc_html__( 'Check it for display seconds', 'zoutula' ),
            'value' => array(
                esc_html__( '', 'zoutula' ) => 'yes'
            )
          ),

         array(
          'type' => 'colorpicker',
          'heading' => esc_html__( 'Number Color', 'zoutula' ),
          'param_name' => 'text_color',
          'description' => esc_html__( 'Select the number color. E.g. #ff0000', 'zoutula' )
         ),

         array(
         'type' => 'dropdown',
          'heading' => esc_html__('Columns', 'zoutula'),
          'param_name' => 'columns',
          'value' => array( esc_html( 'Select', 'zoutula' ) => 'select',
                            esc_html__( '4 Columns', 'zoutula' ) => 'ztl-grid-3',
                            esc_html__( '3 Columns', 'zoutula' ) => 'ztl-grid-4',
                            esc_html__( '2 Columns', 'zoutula' ) => 'ztl-grid-6',
                            esc_html__( '1 Column', 'zoutula' ) => 'ztl-grid-12' ),
          'description' => esc_html__( 'Choose number of columns', 'zoutula' )
         ),

      )
   ) );
}
//end shortcode