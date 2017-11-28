<?php
function my_theme_enqueue_styles() {

    $parent_style = 'enfant-style'; // This is 'enfant-style' for the Enfant theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

function madeleine_post_types()
{

    register_post_type( 'newsletter',
        // CPT Options
            array(
                'labels' => array(
                    'name' => __( 'Newletters' ),
                    'singular_name' => __( 'Newsletter' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'newsletters'),
            )
        );
}

add_action('init', 'madeleine_post_types');
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

set_theme_mod( 'google_maps_api_key', 'AIzaSyDxt_hWGpy5L_y6Bh1mh20QzKXti4Do2ug' );

?>