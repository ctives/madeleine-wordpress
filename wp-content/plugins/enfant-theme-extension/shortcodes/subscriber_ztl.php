<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('subscriber_ztl', 'ztl_shortcode_subscriber');


function ztl_shortcode_subscriber($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'tabicon' => '',
            'icon_fontawesome' => '',
            'icon_openiconic' => '',
            'icon_typicons' => '',
            'icon_entypo' => '',
            'icon_linecons' => '',
            'icon_flaticon' => '',

            'icon_color' => '',
            'icon_background_color' => '',
            'title' => '',
            'color' => '',
            'form_id' => '',
            'class' => ''

        ), $atts);


    $first_column = 'ztl-col ' . enfant_get_bc('12', '12', '12', '12');
    $icon_name = '';

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

    //enqueue font used
    vc_icon_element_fonts_enqueue($atts['tabicon']);
    if (isset($atts['form_id']) && !empty($atts['form_id'])){
        $form_shortcode = ('[mc4wp_form id="' . (int) $atts['form_id'] . '"]');

    }


    $str = '';
    $str .= '<div class="ztl-subscriber ' . esc_attr(strtolower($atts['class'])) . ' ">
            <div class="row">
                <div class="' . esc_attr(strtolower($first_column)) . '">
                    <div class="ztl-icon" style="background-color:' . esc_attr(strtolower($atts['icon_background_color'])) . '">
                        <span class="' . esc_attr($icon_name) . '" style="color:' . esc_attr(strtolower($atts['icon_color'])) . '"></span>
                    </div>
                    <div class="content" style="color:' . esc_attr(strtolower($atts['color'])) . '">
                        <div class="line-1">
                            <h2>' . esc_html($atts['title']) . '</h2>
                        </div>
                        <div class="line-2">
                         ' . $form_shortcode . '
                        </div>
                    </div>
                </div>
            </div>
	</div>';
    $str = apply_filters('ztl_shortcode_filter', $str);
    $str = apply_filters('uds_shortcode_out_filter', $str);
    return $str;
}

add_action('vc_before_init', 'ztl_subscriber');
function ztl_subscriber()
{
    vc_map(array(
        'name' => esc_html__('Subscriber', 'zoutula'),
        'base' => 'subscriber_ztl',
        'description' => esc_html__('Add subscribe box', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/subscriber.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
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
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Icon color', 'zoutula'),
                'param_name' => 'icon_color',
                'value' => '#ff000', //Default Red
                'description' => esc_html__('Choose icon color', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Icon background color', 'zoutula'),
                'param_name' => 'icon_background_color',
                'value' => '#fffff', //Default White
                'description' => esc_html__('Choose icon background color', 'zoutula')
            ),

            // Text
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'zoutula'),
                'admin_label' => true,
                'param_name' => 'title',
                'description' => esc_html__('Select announcement title', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subscribe form ID', 'zoutula'),
                'param_name' => 'form_id',
                'description' => esc_html__('Choose your proffered form and add above the ID (E.g.: 2305) ', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text color', 'zoutula'),
                'param_name' => 'color',
                'value' => '#fffff', //Default White
                'description' => esc_html__('Choose color for this particular element.', 'zoutula')
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