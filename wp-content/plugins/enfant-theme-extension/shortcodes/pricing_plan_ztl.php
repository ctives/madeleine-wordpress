<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('pricing_plan_ztl', 'ztl_shortcode_pricing_plan');
function ztl_shortcode_pricing_plan($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'style'=>'plan-primary',
            'title' => '',
            'subtitle' => '',
            'description_text' => '',
            'price_text' => '',
            'currency' => '',
            'time' => '',
            'accent_color' => '#ff000',
            'main_color' => '#00ff00',
            'header_text_color' => '#ffffff',
            'background_color' => '#f2f2f2',
            'description_text_color' => '#545454',
            'button_link' => '',
            'button_style' => 'ztl-button-one',
            'button_show' => '',
            'max_width' => '100%',
            'class' => ''
        ), $atts);


    $str = '';
    $button = '';

    //extract link
    $atts['button_link'] = vc_build_link( $atts['button_link'] );
    $a_href = $atts['button_link']['url'];
    $a_title = $atts['button_link']['title'];
    $a_target = $atts['button_link']['target'];


    if ($atts['button_show']){
        $button='<div class="plan-button '.esc_attr($atts['button_style']).'">
                    <a href="' . esc_url($a_href) . '" title="' . esc_attr($a_title) . '" target="' . esc_attr($a_target) . '">' . esc_html($a_title) . '</a>
                </div>';
    }

    //primary style
    if ($atts['style']=='plan-primary') {
        $str .= '<div style="background-color:' . esc_attr($atts['background_color']) . '; max-width: ' . esc_attr($atts['max_width']) . '" class="ztl-pricing-plan ' . esc_attr($atts['class']) . ' ' . esc_attr($atts['style']) . '">
                <div class="plan-header" style="background-color:' . esc_attr($atts['main_color']) . '; color:' . esc_attr($atts['header_text_color']) . ';">
                    <span class="plan-title ztl-accent-font">' . esc_attr($atts['title']) . '</span>
                    <span class="plan-subtitle">' . esc_attr($atts['subtitle']) . '</span>
                    <span class="plan-price-wrapper" style="background-color:' . esc_attr($atts['accent_color']) . '; color:' . esc_attr($atts['header_text_color']) . '; border-color:' . esc_attr($atts['background_color']) . '; ">
                        <span class="plan-currency ztl-accent-font">' . esc_attr($atts['currency']) . '</span>
                        <span class="plan-price ztl-accent-font">' . esc_attr($atts['price_text']) . '</span>
                        <span class="plan-time ztl-accent-font">' . esc_attr($atts['time']) . '</span>
                    </span>
                </div>
                <div class="plan-features">
                    ' . urldecode(base64_decode($atts['description_text'])) . '
                </div>
                ' . $button . '
            </div>';
    }


    //second style
    if ($atts['style']=='plan-secondary'){
        $str .= '<div style="background-color:' . esc_attr($atts['background_color']) . '; max-width: ' . esc_attr($atts['max_width']) . '" class="ztl-pricing-plan ' . esc_attr($atts['class']) . ' ' . esc_attr($atts['style']) . '">
                <div class="plan-header" style="background-color:' . esc_attr($atts['main_color']) . '; color:' . esc_attr($atts['header_text_color']) . ';">
                    <span class="plan-title ztl-accent-font" style="background-color:' . esc_attr($atts['accent_color']) . ';">' . esc_attr($atts['title']) . '</span>
                    <span class="plan-currency ztl-accent-font">' . esc_attr($atts['currency']) . '</span>
                    <span class="plan-price ztl-accent-font">' . esc_attr($atts['price_text']) . '</span>
                    <span class="plan-time ztl-accent-font">' . esc_attr($atts['time']) . '</span>
                    <span class="plan-subtitle">' . esc_attr($atts['subtitle']) . '</span>
                    <div class="plan-arrow" style="border-bottom-color:' . esc_attr($atts['background_color']) .';"></div>
                </div>
                <div class="plan-features">
                    ' . urldecode(base64_decode($atts['description_text'])) . '
                </div>
                ' . $button . '
            </div>';
    }

    //tertiary style
    if ($atts['style']=='plan-tertiary'){
        $str .= '<div style="background-color:' . esc_attr($atts['background_color']) . '; max-width: ' . esc_attr($atts['max_width']) . '" class="ztl-pricing-plan ' . esc_attr($atts['class']) . ' ' . esc_attr($atts['style']) . '">
                <div class="plan-header">
                    <span class="plan-title-wrapper" style="background-color:' . esc_attr($atts['accent_color']) . '; color:' . esc_attr($atts['header_text_color']) . ';">
                        <span class="plan-title ztl-accent-font">' . esc_attr($atts['title']) . '</span>
                        <span class="plan-subtitle">' . esc_attr($atts['subtitle']) . '</span>
                    </span>
                    <div class="plan-arrow" style="border-top-color:' . esc_attr($atts['accent_color']) .';"></div>
                    <span class="plan-currency ztl-accent-font" style="color:' . esc_attr($atts['main_color']) . ';">' . esc_attr($atts['currency']) . '</span>
                    <span class="plan-price ztl-accent-font" style="color:' . esc_attr($atts['main_color']) . ';">' . esc_attr($atts['price_text']) . '</span>
                    <span class="plan-time ztl-accent-font" style="color:' . esc_attr($atts['main_color']) . ';">' . esc_attr($atts['time']) . '</span>
                </div>
                <div class="plan-features">
                    ' . urldecode(base64_decode($atts['description_text'])) . '
                </div>
                ' . $button . '
            </div>';
    }

    return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action('vc_before_init', 'ztl_pricing_plan');
function ztl_pricing_plan()
{
    vc_map(array(
        'name' => esc_html__('Pricing plan', 'zoutula'),
        'base' => 'pricing_plan_ztl',
        'description' => esc_html__('Add pricing plan', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/pricing.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(

            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style', 'zoutula'),
                'param_name' => 'style',
                'value' => array(esc_html__('Select', 'zoutula') => 'select',
                    esc_html__('Primary', 'zoutula') => 'plan-primary',
                    esc_html__('Secondary', 'zoutula') => 'plan-secondary',
                    esc_html__('Tertiary', 'zoutula') => 'plan-tertiary'),
                'description' => esc_html__('Select style', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Title', 'zoutula'),
                'param_name' => 'title',
                'admin_label' => true,
                'description' => esc_html__('Insert the title', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Subtitle', 'zoutula'),
                'param_name' => 'subtitle',
                'admin_label' => true,
                'description' => esc_html__('Insert the subtitle', 'zoutula')
            ),

            array(
                'type' => 'textarea_raw_html',
                'class' => '',
                'heading' => esc_html__('Description', 'zoutula'),
                'param_name' => 'description_text',
                'description' => esc_html__('Insert the description', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Price text', 'zoutula'),
                'param_name' => 'price_text',
                'admin_label' => true,
                'description' => esc_html__('Set the price for this plan. E.g. 23', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Currency', 'zoutula'),
                'param_name' => 'currency',
                'admin_label' => true,
                'description' => esc_html__('Enter currency symbol or text E.g. $ or USD.', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Time', 'zoutula'),
                'param_name' => 'time',
                'admin_label' => true,
                'description' => esc_html__('Choose time span for you plan E.g. /mo, month or /yr', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Description Text Color', 'zoutula'),
                'param_name' => 'description_text_color',
                'description' => esc_html__('Select the description text color. E.g. #545454', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Main Color', 'zoutula'),
                'param_name' => 'main_color',
                'description' => esc_html__('Select the main color. E.g. #00ff00', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Accent Color', 'zoutula'),
                'param_name' => 'accent_color',
                'description' => esc_html__('Select the accent color. E.g. #ff0000', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Header Text Color', 'zoutula'),
                'param_name' => 'header_text_color',
                'description' => esc_html__('Select the header text color (for title and subtitle) E.g. #ffffff', 'zoutula')
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Plan Background Color', 'zoutula'),
                'param_name' => 'background_color',
                'description' => esc_html__('Select the plan background color E.g. #f2f2f2', 'zoutula')
            ),

            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Button Link', 'zoutula'),
                'param_name' => 'button_link',
                'description' => esc_html__('Set button link', 'zoutula')
            ),

            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button Style', 'zoutula'),
                'param_name' => 'button_style',
                'value' => array(esc_html__('Select', 'zoutula') => 'select',
                    esc_html__('Style One', 'zoutula') => 'ztl-button-one',
                    esc_html__('Style Two', 'zoutula') => 'ztl-button-two',
                    esc_html__('Style Three', 'zoutula') => 'ztl-button-three',
                    esc_html__('Style Four', 'zoutula') => 'ztl-button-four'),
                'description' => esc_html__('Select button style', 'zoutula')
            ),

            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Show Button', 'zoutula' ),
                'param_name' => 'button_show',
                'description' => esc_html__( 'Check it for button to show', 'zoutula' ),
                'value' => array(
                    esc_html__( '', 'zoutula' ) => 'yes'
                )
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Max width', 'zoutula'),
                'param_name' => 'max_width',
                'description' => esc_html__('Max width E.g.: 90% or 300px', 'zoutula')
            ),

            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Custom Class', 'zoutula'),
                'param_name' => 'class',
                'description' => esc_html__('Insert custom class Eg. signature', 'zoutula')
            ),


        )
    ));
}