<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('counter_ztl', 'ztl_shortcode_counter');


function ztl_shortcode_counter($atts, $content = null)
{
    $atts = shortcode_atts(
        array(
            'icon' => '',
            'icon_fontawesome' => '',
            'icon_openiconic' => '',
            'icon_typicons' => '',
            'icon_entypo' => '',
            'icon_linecons' => '',
            'icon_flaticon' => '',
            'icon_color' => '',
            'number' => '',
            'description' => '',
            'color' => '',
            'class' => '',
        ), $atts
    );

    $icon_name = '';

    //enqueue font used
    vc_icon_element_fonts_enqueue($atts['icon']);

    if (!empty($atts['icon_fontawesome'])) {
        $icon_name = $atts['icon_fontawesome'];
    } elseif (!empty($atts['icon_openiconic'])) {
        $icon_name = $atts['icon_openiconic'];
    } elseif (!empty($atts['icon_typicons'])) {
        $icon_name = $atts['icon_typicons'];
    } elseif (!empty($atts['icon_entypo'])) {
        $icon_name = $atts['icon_entypo'];
    } elseif (!empty($atts['icon_linecons'])) {
        $icon_name = $atts['icon_linecons'];
    } elseif (!empty($atts['icon_flaticon'])) {
        $icon_name = $atts['icon_flaticon'];
    }

    $random_id = 'counter_' . uniqid();
    $str = '';
    $str = '
        <div class="ztl-counter ' . esc_attr($atts['class']) . '">
            <div>
            <span class="ztl-icon">
                <span class="' . esc_attr($icon_name) . '" style="color:' . esc_attr(strtolower($atts['icon_color'])) . '"></span>
            </span>
            <div>
                <span id="' . esc_attr($random_id) . '" class="counter" style="color:' . esc_attr(strtolower($atts['color'])) . '" data-value_no="'.esc_attr($atts['number']) .'" data-count_up="0" >0</span>
                <div class="description" style="color:' . esc_attr(strtolower($atts['color'])) . '">' . esc_html($atts['description']) . '</div>
            </div>
            </div>
        </div> ';

    return apply_filters( 'uds_shortcode_out_filter', $str );
}


add_action('vc_before_init', 'ztl_counter');
function ztl_counter()
{
    vc_map(
        array(
            'name' => esc_html__('Counter', 'zoutula'),
            'base' => 'counter_ztl',
            'class' => '',
            'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
            'description' => esc_html__( 'Add counter', 'zoutula' ),
            'icon' => plugin_dir_url(__FILE__) . 'assets/images/counter.png',
            'params' => array(
                //Icon
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Icon library', 'zoutula'),
                    'value' => array(
                        esc_html__('Font Awesome', 'zoutula') => 'fontawesome',
                        esc_html__('Entypo', 'zoutula') => 'entypo',
                        esc_html__('Open Iconic', 'zoutula') => 'openiconic',
                        esc_html__('Typicons', 'zoutula') => 'typicons',
                        esc_html__('Linecons', 'zoutula') => 'linecons',
                        esc_html__('Zoutula Icons', 'zoutula') => 'flaticon',
                    ),
                    'admin_label' => true,
                    'param_name' => 'tabicon',
                    'description' => esc_html__('Select icon library.', 'zoutula'),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__('Icon', 'zoutula'),
                    'param_name' => 'icon_fontawesome',
                    'value' => '', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => true, // default true, display an "EMPTY" icon?
                        'type' => 'fontawesome',
                        'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    'dependency' => array(
                        'element' => 'tabicon',
                        'value' => 'fontawesome',
                    ),
                    'description' => esc_html__('Select icon from library.', 'zoutula'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'zoutula'),
                        'param_name' => 'icon_openiconic',
                        'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'openiconic',
                            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'tabicon',
                            'value' => 'openiconic',
                        ),
                        'description' => esc_html__('Select icon from library.', 'zoutula'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'zoutula'),
                        'param_name' => 'icon_typicons',
                        'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'typicons',
                            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'tabicon',
                            'value' => 'typicons',
                        ),
                        'description' => esc_html__('Select icon from library.', 'zoutula'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'zoutula'),
                        'param_name' => 'icon_entypo',
                        'value' => 'entypo-icon entypo-icon-user', // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'entypo',
                            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'tabicon',
                            'value' => 'entypo',
                        ),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'zoutula'),
                        'param_name' => 'icon_linecons',
                        'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'linecons',
                            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'tabicon',
                            'value' => 'linecons',
                        ),
                        'description' => esc_html__('Select icon from library.', 'zoutula'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'zoutula'),
                        'param_name' => 'icon_flaticon',
                        'value' => '',
                        'settings' => array(
                            'emptyIcon' => false,
                            'type' => 'flaticon',
                            'iconsPerPage' => 4000,
                        ),
                        'dependency' => array(
                            'element' => 'tabicon',
                            'value' => 'flaticon',
                        ),
                        'description' => esc_html__('Select icon from library.', 'zoutula'),
                    ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Number', 'zoutula'),
                    'param_name' => 'number',
                    'value' => '',
                    'description' => esc_html__('Enter the number of counter', 'zoutula'),
                ),

                array(
                    'type' => 'colorpicker',
                    'class' => '',
                    'heading' => esc_html__('Icon color', 'zoutula'),
                    'param_name' => 'icon_color',
                    'value' => '#ff000', //Default Red
                    'description' => esc_html__('Choose icon color', 'zoutula')
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Description', 'zoutula'),
                    'param_name' => 'description',
                    'value' => '',
                    'description' => esc_html__('Enter the description of counter', 'zoutula'),
                ),

                array(
                    'type' => 'colorpicker',
                    'class' => '',
                    'heading' => esc_html__('Text color', 'zoutula'),
                    'param_name' => 'color',
                    'value' => '#fffff', //Default White
                    'description' => esc_html__('Choose text color', 'zoutula')
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'zoutula'),
                    'param_name' => 'class',
                    'value' => '',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'zoutula')
                )
            ),
        )
    );
}
