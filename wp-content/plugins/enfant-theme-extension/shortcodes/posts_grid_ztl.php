<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('posts_grid_ztl', 'ztl_shortcode_posts_grid');
function ztl_shortcode_posts_grid($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'post_grid_type' => '',
            'post_grid_number' => '',
            'post_grid_columns' => '',
            'post_grid_order' => '',
            'post_grid_order_by' => '',
            'post_grid_events_date' => '',
            'post_grid_categories' => '',
        ), $atts);


    if ($atts['post_grid_type'] == 'Events') {
        if ($atts['post_grid_events_date'] == 1) {
            //order by event start date
            $custom_order_by = 'enfant_event_start_date';
            $order_key = 'enfant_event_start_date';
            $post_type = 'event';
        } else {
            //order by user option
            $post_type = 'event';
            $custom_order_by = strtolower($atts['post_grid_order_by']);
        }
    }


    $args = array(
        'post_type' => '' . $post_type . '',
        'posts_per_page' => $atts['post_grid_number'],
        'orderby' => '' . $custom_order_by . '',
        'meta_key' => '' . $order_key . '',
        'order' => '' . $atts['post_grid_order'] . '',
        'category_name' => '' . $atts['post_grid_categories'] . '',
        'meta_query' => array(
            array(
                'key' => 'enfant_event_start_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
            )
        )
    );

    $query = new WP_Query($args);

    if ($atts['post_grid_type'] == 'Events') {
        include 'inc/loop/events.php';
    }

    wp_reset_postdata();


    return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action('vc_before_init', 'ztl_posts_grid');
function ztl_posts_grid()
{
    vc_map(array(
        'name' => esc_html__('Posts Grid', 'zoutula'),
        'base' => 'posts_grid_ztl',
        'description' => esc_html__('Insert Posts Grid', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/posts-grid.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(

            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html__('Post Type', 'zoutula'),
                'param_name' => 'post_grid_type',
                'admin_label' => true,
                'value' => array(
                    esc_html__('Select','zoutula') => 'Select',
                    esc_html__('Events', 'zoutula') => 'Events',
                    ),
                'description' => esc_html__('Choose the post type', 'zoutula')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Categories ', 'zoutula'),
                'param_name' => 'post_grid_categories',
                'dependency' => array('element' => 'post_grid_type', 'value' => array('post')),
                'description' => esc_html__('Insert the category (from current taxonomy) SLUG separated by comma without space. E.g. category1, category2 ', 'zoutula')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Posts per page ', 'zoutula'),
                'param_name' => 'post_grid_number',
                'description' => esc_html__('Insert the number of posts that you want to show. E.g. 3. Leave empty for show the default settings of WP (Settings -> Reading)', 'zoutula')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html__('Order By', 'zoutula'),
                'param_name' => 'post_grid_order_by',
                'value' => array(
                    esc_html__('Select','zoutula') => 'Select',
                    esc_html__('Date', 'zoutula') => 'Date',
                    esc_html__('Title', 'zoutula') => 'Title',
                    esc_html__('Rand', 'zoutula') => 'Rand',
                    esc_html__('Modified', 'zoutula') => 'Modified',
                    ),
                'description' => esc_html__('Choose the order of the visualization', 'zoutula')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html('Order', 'zoutula'),
                'param_name' => 'post_grid_order',
                'value' => array(
                        esc_html__('Select', 'zoutula') => 'Select',
                        esc_html__('Desc','zoutula') => 'Desc',
                        esc_html__('Asc', 'zoutula') => 'Asc',
                    ),
                'description' => esc_html__('Choose items order', 'zoutula')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html__('Columns', 'zoutula'),
                'param_name' => 'post_grid_columns',
                'admin_label' => true,
                'value' => array(
                        esc_html__('Select', 'zoutula') => 'select',
                        esc_html__('1 Column', 'zoutula') => 'ztl-grid-12'
                    ),
                'description' => esc_html__('Choose columns style', 'zoutula')
            ),

            array(
                'type' => 'checkbox',
                'class' => '',
                'heading' => esc_html__('Order by Event Date', 'zoutula'),
                'param_name' => 'post_grid_events_date',
                'value' => array(esc_html__('', 'zoutula') => '1'),
                'dependency' => array('element' => 'post_grid_type', 'value' => array('Events')),
                'description' => esc_html__('Check for order by EVENT date (overrides other ordering)', 'zoutula')
            ),
        )
    ));
}
