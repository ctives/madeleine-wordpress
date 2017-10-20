<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('divider_ztl', 'ztl_shortcode_divider');
function ztl_shortcode_divider($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'align' => '',
            'style' => '',
            'color' => '',
            'class' => ''

        ), $atts);

    //Set default style
    if (empty($atts['style'])){
        $atts['style'] = 'primary';
    }

    $style_class = '';
    if (strtolower($atts['style']) == 'primary') {
        $style_class = 'circle';
    }

    $str = '';
    $str .= '<div class="ztl-divider ' . esc_attr(strtolower($atts['class'])) . ' ' . esc_attr(strtolower($atts['align'])) . ' ' . esc_attr(strtolower($atts['style'])) . ' ">
                <span style="border-color:' . esc_attr($atts['color']) . '; " class="' . esc_attr($style_class) . '">
                    <span style="background-color:' . esc_attr($atts['color']) . '; "></span>
                    <span style="background-color:' . esc_attr($atts['color']) . '; "></span>
                </span>
            </div>';

    return apply_filters('uds_shortcode_out_filter', $str);
}


add_action('vc_before_init', 'ztl_divider');
function ztl_divider()
{
    vc_map(array(
        'name' => esc_html__('Divider', 'zoutula'),
        'base' => 'divider_ztl',
        'description' => esc_html__('Add divider', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/divider.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style','zoutula'),
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Select','zoutula') => 'Select',
                    esc_html__('Primary','zoutula') => 'Primary',
                    esc_html__('Secondary', 'zoutula') => 'Secondary',
                ),
                'description' => esc_html__('Select element style', 'zoutula')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Alignment','zoutula'),
                'param_name' => 'align',
                'value' => array(
                    esc_html__('Select', 'zoutula') => 'Select',
                    esc_html__('Left', 'zoutula') => 'Left',
                    esc_html__('Right', 'zoutula') => 'Right',
                    esc_html__('Center', 'zoutula') => 'Center',
                    ),
                'description' => esc_html__('Select alignment', 'zoutula')
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'admin_label' => true,
                'heading' => esc_html__('Divider color', 'zoutula'),
                'param_name' => 'color',
                'value' => '', //Default Theme Color
                'description' => esc_html__('Choose color for this particular element.', 'zoutula')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Extra class name', 'zoutula'),
                'param_name' => 'class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'zoutula')
            )
        )
    ));
}