<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('title_ztl', 'ztl_shortcode_title');
function ztl_shortcode_title($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'title' => '',
            'tag' => '',
            'line_height' =>'',
            'style' => '',
            'color' => '',
            'weight' => '',
            'align' => '',
            'class' => ''
        ), $atts);

    //alignment
    switch ($atts['align']) {
        case 'Left':
            $align = 'ztl-left';
            break;
        case 'Right':
            $align = 'ztl-right';
            break;
        case 'Center':
            $align = 'ztl-center';
            break;
        default:
            $align = 'ztl-left';
    }

    //line height
    $line_height = '';
    if (!empty($atts['line_height'])){
        $line_height =  'line-height:'. $atts['line_height'] .';';
    }


    $str = '';

    $str .= '<' . esc_attr($atts['tag']) . ' style="color:' . esc_attr($atts['color']) . ';'.  esc_attr($line_height) .'" class="' . esc_attr($atts['class']) . ' ' . esc_attr($atts['style']) . ' ' . esc_attr($align) . ' ' . esc_attr($atts['weight']) . '">' . $atts['title'] . '</' . esc_attr($atts['tag']) . '>';

    return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action('vc_before_init', 'ztl_title');
function ztl_title()
{
    vc_map(array(
        'name' => esc_html__('Title', 'zoutula'),
        'base' => 'title_ztl',
        'description' => esc_html__('Add title', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/title.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Title', 'zoutula'),
                'param_name' => 'title',
                'admin_label' => true,
                'description' => esc_html__('Insert the title', 'zoutula')
            ),

            array(
                'type' => 'dropdown',
                'heading' => 'Tag',
                'param_name' => 'tag',
                'value' => array('Select', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p'),
                'description' => esc_html__('Select your tag', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Line height', 'zoutula'),
                'param_name' => 'line_height',
                'admin_label' => true,
                'description' => esc_html__('Line height', 'zoutula')
            ),

            array(
                'type' => 'dropdown',
                'heading' => 'Style',
                'param_name' => 'style',
                'value' => array(esc_html__('Select', 'zoutula') => 'select',
                    esc_html__('Main Font', 'zoutula') => 'ztl-main-font',
                    esc_html__('Accent Font', 'zoutula') => 'ztl-accent-font'),
                'description' => esc_html__('Select your style (Fonts can be managed via Customizer)', 'zoutula')
            ),

            array(
                'type' => 'dropdown',
                'heading' => 'Weight',
                'param_name' => 'weight',
                'value' => array(esc_html__('Select', 'zoutula') => 'select',
                    esc_html__('Light', 'zoutula') => 'ztl-font-light',
                    esc_html__('Normal', 'zoutula') => 'ztl-font-normal',
                    esc_html__('Bold', 'zoutula') => 'ztl-font-bold'),
                'description' => esc_html__('Select your style (Fonts can be managed via Customizer)', 'zoutula')
            ),

            array(
                'type' => 'dropdown',
                'heading' => 'Align',
                'param_name' => 'align',
                'value' => array('Select', 'Left', 'Center', 'Right'),
                'description' => esc_html__('Choose the alignment', 'zoutula')
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Custom Color', 'js_composer'),
                'param_name' => 'color',
                'description' => esc_html__('Select the title color. E.g. #ff0000', 'zoutula')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Custom class', 'zoutula'),
                'param_name' => 'class',
                'description' => esc_html__('Insert custom class Eg. signature', 'zoutula')
            )

        )
    ));
}