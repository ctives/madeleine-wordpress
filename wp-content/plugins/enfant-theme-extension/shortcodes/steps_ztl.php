<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('steps_ztl', 'ztl_shortcode_steps');

function ztl_shortcode_steps($atts, $content)
{
    $atts = shortcode_atts(
        array(
            'autoplay' => 0,
            'loop' => false,
            'navigation' => false,
            'class' => '',
        ), $atts
    );

    $id = 'steps_' . uniqid();

    $script = '
        <script type="text/javascript">
        (function($) { "use strict";


         var steps_no = 0;
         var steps_id = "' . esc_attr($id) . '";
         var loop_items = "' . esc_attr((bool)$atts['loop']) . '";
         var navigation_items = "' . esc_attr((bool)$atts['navigation']) . '";
         var autoplay_items = "' . esc_attr((bool)$atts['autoplay']) . '";
         var autoplay_items_timeout = "' . esc_attr((int)$atts['autoplay']) . '";
         var breakpoints;


          //call
          $(document).ready(function(){
            // determine steps no
            steps_no = $("#" + steps_id +" .item-step").length;
            // set responsive behavior

            switch(steps_no){
                case 3:
                    breakpoints = { 0:{ items:1 }, 480:{ items:2 }, 768:{ items:3 } };
                    break;
                case 2:
                    breakpoints = { 0:{ items:1 }, 480:{ items:2 } };
                    break;
                case 1:
                    breakpoints = { 0:{ items:1 } };
                    break;

                default:
                    breakpoints = { 0:{ items:1 }, 480:{ items:2 }, 768:{ items:3 }, 1000:{ items:4 } }
             }



            $("#" + steps_id).owlCarousel({
                loop:loop_items,
                nav:navigation_items,
                autoplay:autoplay_items,
                autoplayTimeout:autoplay_items_timeout,
                responsive:breakpoints
            });
          });

        })(jQuery);
        </script>
  ';

    $class = $atts['class'];


    $str = '<div class="ztl-steps-carousel ' . esc_attr($class) . '">
                <div class="owl-steps-list" id="' . esc_attr($id) . '">
                   ' . $content . '
                </div>
            </div>'. $script;

    $str = apply_filters('ztl_shortcode_filter', $str);
    $str = apply_filters('uds_shortcode_out_filter', $str);

    return $str;
}


add_action('vc_before_init', 'ztl_steps');
function ztl_steps()
{
    vc_map(
        array(
            'name' => esc_html__('Steps', 'zoutula'),
            'base' => 'steps_ztl', //container
            'content_element' => true,
            'is_container' => true,
            'as_parent' => array('only' => 'step_ztl'),
            'description' => esc_html__('Add steps box', 'zoutula'),
            'show_settings_on_create' => true,
            'icon' => plugin_dir_url(__FILE__) . 'assets/images/steps.png',
            'class' => '',
            'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Slider autoplay', 'zoutula'),
                    'param_name' => 'autoplay',
                    'value' => 0,
                    'description' => esc_html__('Duration of animation between slides (in ms). Enter the value is 0 or empty if you want the slider not auto-play', 'zoutula'),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Enable navigation', 'zoutula'),
                    'param_name' => 'navigation',
                    'value' => array(esc_html__('Yes', 'zoutula') => true),
                    'description' => esc_html__('If "YES" prev / next control will be enabled. ', 'zoutula'),
                ),

                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Enable the Items Loop', 'zoutula'),
                    'param_name' => 'loop',
                    'value' => array(esc_html__('Yes', 'zoutula') => true),
                    'description' => esc_html__('If "YES" carousel will loop the items. ', 'zoutula'),
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Class', 'zoutula'),
                    'param_name' => 'class',
                    'description' => esc_html__('Custom Class', 'zoutula'),
                ),
            ),
            'js_view' => 'VcColumnView',
        )
    );

    // Needed for "Container/Content" functionality
    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_steps_ztl extends WPBakeryShortCodesContainer
        {
        }
    }

}


/* Step Child Item  */

add_shortcode('step_ztl', 'ztl_shortcode_step');

function ztl_shortcode_step($atts, $content)
{
    $atts = shortcode_atts(
        array(
            'number' => '',
            'title' => '',
            'number_color' =>'#ffffff',
            'number_background' =>'#ff0000'
        ), $atts
    );

    $str = '';

    if ($atts['number']) {
        $str .= '<div class="number-step" style="background-color:'.esc_attr($atts['number_background']).'; color:'.esc_attr($atts['number_color']).'">' . esc_html($atts['number']) . '</div>';
    }

    if ($atts['title']) {
        $str .= '<h3 class="title"> ' . esc_html($atts['title']) . ' </h3>';
    }

    if ($content) {
        $str .= '<div class="desc">' . $content . '</div>';
    }

    $str = apply_filters('uds_shortcode_out_filter', $str);

    return '<div class="item-step"> ' . $str . ' </div>';
}


add_action('vc_before_init', 'ztl_step');
function ztl_step()
{

    vc_map(
        array(
            'name' => esc_html__('Step', 'zoutula'),
            'base' => 'step_ztl', //content
            'icon' => plugin_dir_url(__FILE__) . 'assets/images/steps.png',
            'show_settings_on_create' => true,
            'content_element' => true,
            'as_child' => array('only' => 'steps_ztl'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Number', 'zoutula'),
                    'param_name' => 'number',
                    'value' => '',
                    'description' => esc_html__('Enter the number of step', 'zoutula'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Number color', 'zoutula'),
                    'param_name' => 'number_color',
                    'value' => '#ffffff',
                    'description' => esc_html__( 'Select the number color. E.g. #ff0000', 'zoutula' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Number background color', 'zoutula'),
                    'param_name' => 'number_background',
                    'value' => '#ff0000',
                    'description' => esc_html__( 'Select the number backgroun color. E.g. #ff0000', 'zoutula' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'zoutula'),
                    'param_name' => 'title',
                    'value' => '',
                    'description' => esc_html__('Enter the title of content', 'zoutula'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html__('Description', 'zoutula'),
                    'param_name' => 'content',
                    'value' => '',
                    'description' => esc_html__('Enter the content of this box', 'zoutula'),
                ),
            )
        )
    );

    // Needed for "Container/Content" functionality
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_step_ztl extends WPBakeryShortCode
        {
        }
    }

}

?>