<?php
/**
 * Plugin Name: Madeleine Theme Extension
 * Plugin URI: http://schoolofthemadeleine.com
 * Description: This plugin handles customization for the School of the Madeleine website
 * Version: 1.0.1
 * Author: Tyler Ives
 * Author URI: http://schoolofthemadeleine.com
 * Text Domain: schoolofthemadeleine
 * Domain Path: /languages
 */

function madeleine_custom_data()
{

    //Newsletter custom post

    $labels = array(
        'name' => esc_html(_x('Newsletters', 'Category name', 'zoutula')),
        'singular_name' => esc_html(_x('Newsletter', 'Category item', 'zoutula')),
        'all_items' => esc_html__('All Newsletters', 'zoutula'),
        'parent_item_colon' => null,
        'add_new_item' => esc_html__('Add Newsletter', 'zoutula'),
        'add_new' => esc_html(_x('Add Newsletter', 'zoutula')),
        'menu_name' => esc_html__('Newsletter', 'zoutula'),
    );

    register_post_type('newsletter',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'rewrite' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields'),
            'show_admin_column' => true,
            'has_archive' => 'newsletters'
        )
    );

     register_taxonomy('newsletters_taxonomy',
            array('newsletter'),
            array(
                'label' => esc_html__('Newsletters Categories', 'zoutula'),
                'singular_label' => esc_html__('Newsletter Category', 'zoutula'),
                'hierarchical' => true,
                'query_var' => true,
                'public' => true,
                'rewrite' => array(
                    'slug' => 'newsletters',
                ),
            )
     );

     //set number of newsletters for courses taxonomy and archive post type = course
     function madaleine_newsletters_posts_per_page($query)
     {
         if (! is_admin() && ! is_search()) {
             if (($query->is_post_type_archive('newsletter') || $query->is_tax('newsletters_taxonomy')) && $query->is_main_query()) {
                 $query->set('newsletters_per_page', (int)get_theme_mod('newsletters_posts_per_page', '9'));
             }
         }
     }
     add_action('pre_get_newsletters', 'madaleine_newsletters_posts_per_page');


     //Newsletter columns
     add_filter('manage_edit-newsletter_columns', 'madeleine_edit_newsletter_columns');

     function madeleine_edit_newsletter_columns($columns)
     {

         $columns = array(
             'cb' => '<input type="checkbox" />',
             'title' => esc_html__('Title'),
             'category' => esc_html__('Category'),
             'date' => esc_html__('Date')
         );

         return $columns;
     }

     add_action('manage_newsletter_posts_custom_column', 'madeleine_manage_newsletter_columns', 10, 2);

     function madeleine_manage_newsletter_columns($column, $post_id)
     {
         global $post;
         switch ($column) {
             case 'category':
                 echo get_the_term_list($post->ID, 'newsletters_taxonomy', '', ', ', '');
                 break;
         }

     }

}

 add_action('init', 'newsletter');

?>