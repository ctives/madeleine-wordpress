<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('package_ztl', 'ztl_shortcode_package');


function ztl_shortcode_package($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'title' => '',
            'subtitle' => '',
            'text_color' => '',

            'price_value' => '',
            'time_period' => '',

            'bullet_text_color' => '',
            'bullet_background_color' => '',
            'class' => ''

        ), $atts);

    $str = '';
    $str .= '<div class="ztl-package '. esc_attr(strtolower($atts['class'])) .'">
                <div class="ztl-package-circle" style="background-color:'. esc_attr(strtolower($atts['bullet_background_color'])) .'">
                    <div class="item" style="color:'. esc_attr(strtolower($atts['bullet_text_color'])) .'"><h3>'. $atts['price_value'] .'</h3></div>
                    <div class="item period" style="color:'. esc_attr(strtolower($atts['bullet_text_color'])) .'">'. $atts['time_period'] .'</div>
                </div>
                <div class="ztl-package-description">
                    <div style="color:'. esc_attr(strtolower($atts['text_color'])) .'"><h4>'.$atts['title'].'</h4></div>
                    <div style="color:'. esc_attr(strtolower($atts['text_color'])) .'">'.$atts['subtitle'].'</div>
                </div>
	        </div>';

    return apply_filters('uds_shortcode_out_filter', $str);
}


add_action('vc_before_init', 'ztl_package');
function ztl_package()
{
    vc_map(array(
        'name' => esc_html__('Package', 'zoutula'),
        'base' => 'package_ztl',
        'description' => esc_html__('Add package', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/package.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(

            // Text
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'zoutula'),
                'admin_label' => true,
                'param_name' => 'title',
                'description' => esc_html__('Select package title', 'zoutula')
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Subtitle', 'zoutula'),
                'param_name' => 'subtitle',
                'description' => esc_html__('Select package subtitle', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text color', 'zoutula'),
                'param_name' => 'text_color',
                'value' => '#545454', //Default Dark Grey
                'description' => esc_html__('Choose text color', 'zoutula')
            ),


            // Bullet settings
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Price value', 'zoutula'),
                'param_name' => 'price_value',
                'description' => esc_html__('Set price value may contain decimals like: <sup>00</sup>', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__('Time period', 'zoutula'),
                'param_name' => 'time_period',
                'description' => esc_html__('Set time period', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Bullet text color', 'zoutula'),
                'param_name' => 'bullet_text_color',
                'value' => '#fff', //Default White
                'description' => esc_html__('Choose bullet text color', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Bullet background color', 'zoutula'),
                'param_name' => 'bullet_background_color',
                'value' => '#fff', //Default White
                'description' => esc_html__('Choose bullet background color', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Class', 'zoutula'),
                'param_name' => 'class',
                'description' => esc_html__('Custom Class', 'zoutula')
            )
        )
    ));
}
