<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('testimonials_ztl', 'ztl_shortcode_testimonials');

function ztl_shortcode_testimonials($atts, $content)
{
    $atts = shortcode_atts(
        array(
            'autoplay' => 0,
            'loop' => false,
            'navigation' => false,
            'dots' => false,
            'class' => '',
        ), $atts
    );

    $id = 'testimonials_' . uniqid();


    $script = '
        <script type="text/javascript">
        (function($) { "use strict";


         var testimonials_no = 0;
         var testimonials_id = "' . esc_attr($id) . '";
         var loop_items = "' . esc_attr((bool)$atts['loop']) . '";
         var navigation_items = "' . esc_attr((bool) $atts['navigation']) . '";
         var navigation_dots = "' . esc_attr((bool) $atts['dots']) . '";
         var autoplay_items = "' . esc_attr((bool)$atts['autoplay']) . '";
         var autoplay_items_timeout = "' . esc_attr((int)$atts['autoplay']) . '";
         

          //call
          $(document).ready(function(){
            // determine items no
            testimonials_no = $("#" + testimonials_id +" .item-testimonial").length;

            var owl = $("#" + testimonials_id).owlCarousel({
                items: 1,
                dotsEach: true,
                loop:loop_items,
                nav:navigation_items,
                autoplay:autoplay_items,
                autoplayTimeout:autoplay_items_timeout,
                dots:navigation_dots,
            });
          });

        })(jQuery);
        </script>
  ';

    $class = $atts['class'];


    $str = '<div class="ztl-testimonials-carousel ' . esc_attr($class) . '">
                <div class="owl-testimonials-list" id="' . esc_attr($id) . '">
                   ' . $content . '
                </div>
            </div>'. $script;

    $str = apply_filters('ztl_shortcode_filter', $str);
    $str = apply_filters('uds_shortcode_out_filter', $str);

    return $str;
}


add_action('vc_before_init', 'ztl_testimonials');
function ztl_testimonials()
{
    vc_map(
        array(
            'name' => esc_html__('Testimonials', 'zoutula'),
            'base' => 'testimonials_ztl', //container
            'content_element' => true,
            'is_container' => true,
            'as_parent' => array('only' => 'testimonial_ztl'),
            'description' => esc_html__('Add testimonial box', 'zoutula'),
            'show_settings_on_create' => true,
            'icon' => plugin_dir_url(__FILE__) . 'assets/images/testimonials.png',
            'class' => '',
            'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Slider Autoplay', 'zoutula'),
                    'param_name' => 'autoplay',
                    'value' => 0,
                    'description' => esc_html__('Duration of animation between slides (in ms). Enter the value is 0 or empty if you want the slider not auto-play', 'zoutula'),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Enable Navigation', 'zoutula'),
                    'param_name' => 'navigation',
                    'value' => array(esc_html__('Yes', 'zoutula') => true),
                    'description' => esc_html__('If "YES" prev / next control will be enabled. ', 'zoutula'),
                ),

                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Enable Dots Navigation', 'zoutula'),
                    'param_name' => 'dots',
                    'value' => array(esc_html__('Yes', 'zoutula') => true),
                    'description' => esc_html__('If "YES" navigation dots will be enabled. ', 'zoutula'),
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
        class WPBakeryShortCode_testimonials_ztl extends WPBakeryShortCodesContainer
        {
        }
    }

}


/* Testimonial Child Item  */

add_shortcode('testimonial_ztl', 'ztl_shortcode_testimonial');

function ztl_shortcode_testimonial($atts, $content)
{
    $atts = shortcode_atts(
        array(
            'title' => '',
            'title_color' =>'#ffffff',
            'description_color' =>'#545454',
            'author_image' => '',
            'author_name' => '',
            'border_color' =>'#ffffff',
            'quote_before' =>'',
            'quote_after' =>'',
        ), $atts
    );

    $str = '';
    $quote_before ='';
    $quote_after ='';

    if ($atts['quote_before']){
        $quote_before = '<img style="margin-right:20px;" src="'.esc_attr(enfant_get_first(wp_get_attachment_image_src($atts['quote_before']))).'" />';
    }

    if ($atts['quote_after']){
        $quote_after = '<img style="margin-left:20px;" src="'.esc_attr(enfant_get_first(wp_get_attachment_image_src($atts['quote_after']))).'" />';
    }

    if ($atts['title']) {
        $str .= '<h2 class="title ztl-accent-font" style="color:'.esc_attr($atts['title_color']).'"> ' . $quote_before . esc_html($atts['title']) . $quote_after .' </h2>';
    }

    if ($content) {
        $str .= '<div class="desc"><p>' . $content . '</p></div>';
    }

    if ($atts['author_image']){
        $author_image = wp_get_attachment_image_src($atts['author_image']);

        $str.= '<div class="author-image">
                    <img style="border-color:'.esc_attr($atts['border_color']).';"  alt="" width="100" src="'.esc_url($author_image[0]).'">
                </div>';
    }

    if ($atts['author_name']){
        $str.= '<div class="author-name" style="color:'.esc_attr($atts['title_color']).'">'.esc_html($atts['author_name']).'</div>';
    }

    $str = apply_filters('uds_shortcode_out_filter', $str);

    return '<div class="item-testimonial"> ' . $str . ' </div>';
}


add_action('vc_before_init', 'ztl_testimonial');
function ztl_testimonial()
{

    vc_map(
        array(
            'name' => esc_html__('Testimonial', 'zoutula'),
            'base' => 'testimonial_ztl', //content
            'icon' => plugin_dir_url(__FILE__) . 'assets/images/testimonials.png',
            'show_settings_on_create' => true,
            'content_element' => true,
            'as_child' => array('only' => 'testimonials_ztl'),
            'params' => array(
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Title Color', 'zoutula'),
                    'param_name' => 'title_color',
                    'value' => '#ff0000',
                    'description' => esc_html__( 'Select the title color. E.g. #ff0000', 'zoutula' ),
                    'admin_label' => true,
                ),

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Before Title Quote', 'zoutula' ),
                    'param_name' => 'quote_before',
                    'description' => esc_html__('This image will be displayed before title (min 128px x 128px)', 'zoutula' )
                ),

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('After Title Quote', 'zoutula' ),
                    'param_name' => 'quote_after',
                    'description' => esc_html__('This image will be displayed after title (min 128px x 128px)', 'zoutula' )
                ),

                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Description Color', 'zoutula'),
                    'param_name' => 'description_color',
                    'value' => '#ff0000',
                    'description' => esc_html__( 'Select the description color. E.g. #ff0000', 'zoutula' ),
                    'admin_label' => true,
                ),

                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Author Image Border Color', 'zoutula'),
                    'param_name' => 'border_color',
                    'value' => '#ff0000',
                    'description' => esc_html__( 'Select the author image border color. E.g. #ff0000', 'zoutula' ),
                    'admin_label' => true,
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'zoutula'),
                    'param_name' => 'title',
                    'value' => '',
                    'description' => esc_html__('Enter the testimonial title', 'zoutula'),
                    'admin_label' => true,
                ),

                array(
                    'type' => 'textarea_html',
                    'heading' => esc_html__('Description', 'zoutula'),
                    'param_name' => 'content',
                    'value' => '',
                    'description' => esc_html__('Enter the testimonial content', 'zoutula'),
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Author Name', 'zoutula'),
                    'param_name' => 'author_name',
                    'value' => '',
                    'description' => esc_html__('Enter the author name', 'zoutula'),
                ),

                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Image Author', 'zoutula' ),
                    'param_name' => 'author_image',
                    'description' => esc_html__('Select images from media library.', 'zoutula' )
                ),

            )
        )
    );

    // Needed for "Container/Content" functionality
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_testimonial_ztl extends WPBakeryShortCode
        {
        }
    }

}

?>