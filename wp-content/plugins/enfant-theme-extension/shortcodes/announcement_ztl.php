<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('announcement_ztl', 'ztl_shortcode_announcement');


function ztl_shortcode_announcement($atts, $content = null)
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
            'subtitle' => '',
            'color' => '',
            'button_link' => '',
            'button_style' => '',
            'class' => ''

        ), $atts);

    //extract link
    $atts['button_link'] = vc_build_link( $atts['button_link'] );
    $a_href = $atts['button_link']['url'];
    $a_title = $atts['button_link']['title'];
    $a_target = $atts['button_link']['target'] ? $atts['button_link']['target']: '_self';


    $first_column ='ztl-col ' . enfant_get_bc('9', '9', '9', '12');
    $second_column = 'ztl-col ' . enfant_get_bc('3', '3', '3', '12');
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
    //button style
    switch ($atts['button_style']) {
        case 'Primary':
            $button_style = 'ztl-button-one';
            break;
        case 'Secondary':
            $button_style = 'ztl-button-two';
            break;

        default:
            $button_style = 'ztl-button-one';
    }

    //enqueue font used
    vc_icon_element_fonts_enqueue($atts['tabicon']);


    $str = '';
    $str .= '<div class="ztl-announcement ' . esc_attr(strtolower($atts['class'])) . ' ">
            <div class="row table-row">
                <div class="' . esc_attr(strtolower($first_column)) . '">
                    <div class="ztl-flex ztl-mobile-container">
                        <div class="ztl-icon left" style="background-color:' . esc_attr(strtolower($atts['icon_background_color'])) . '">
                            <span class="' . esc_attr($icon_name) . '" style="color:' . esc_attr(strtolower($atts['icon_color'])) . '"></span>
                        </div>
                        <div class="content" style="color:' . esc_attr(strtolower($atts['color'])) . '">
                            <div class="line-1">
                                <h3>' . esc_html($atts['title']) . '</h3>
                            </div>
                            <div class="line-2">
                             ' . esc_html($atts['subtitle']) . '
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ztl-action ' . esc_attr(strtolower($second_column)) . '">
                    <div class="'.esc_attr($button_style).'"><a href="' . esc_url($a_href) . '" target="'. esc_attr($a_target) .'">' . esc_html($a_title) . '</a></div>
                </div>
            </div>
	</div>';

    return apply_filters('uds_shortcode_out_filter', $str);
}


add_action('vc_before_init', 'ztl_announcement');
function ztl_announcement()
{
    vc_map(array(
        'name' => esc_html__('Announcement', 'zoutula'),
        'base' => 'announcement_ztl',
        'description' => esc_html__('Add announcement', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/announcement.png',
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
                'heading' => esc_html__('Icon Color', 'zoutula'),
                'param_name' => 'icon_color',
                'value' => '#ff000', //Default Red
                'description' => esc_html__('Choose icon color', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Icon Background Color', 'zoutula'),
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
                'heading' => esc_html__('Subtitle', 'zoutula'),
                'param_name' => 'subtitle',
                'description' => esc_html__('Select announcement subtitle', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text Color', 'zoutula'),
                'param_name' => 'color',
                'value' => '#fffff', //Default White
                'description' => esc_html__('Choose color for this particular element.', 'zoutula')
            ),

            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Button Link', 'zoutula'),
                'param_name' => 'button_link',
                'description' => esc_html__('Set button link', 'zoutula')
            ),

            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style', 'zoutula'),
                'param_name' => 'button_style',
                'value' => array( esc_html( 'Select', 'zoutula' ) => 'Select',
                                esc_html__( 'Primary', 'zoutula' ) => 'Primary',
                                esc_html__( 'Secondary', 'zoutula' ) => 'Secondary',
                ),
                'description' => esc_html__('Select button style', 'zoutula')
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
