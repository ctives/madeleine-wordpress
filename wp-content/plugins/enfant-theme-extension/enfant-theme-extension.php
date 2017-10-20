<?php
/**
 * Plugin Name: Enfant Theme Extension
 * Plugin URI: http://zoutula.com
 * Description: This plugin handles Enfant Theme custom content like staff, courses and shortcodes. It's activated/deactivated with the theme.
 * Version: 1.0.1
 * Author: Zoutula
 * Author URI: http://zoutula.com
 * Text Domain: zoutula
 * Domain Path: /languages
 */


function enfant_custom_data()
{

    //Member custom post

    $labels = array(
        'name' => esc_html(_x('Staff', 'Category name', 'zoutula')),
        'singular_name' => esc_html(_x('Staff', 'Category item', 'zoutula')),
        'all_items' => esc_html__('All Staff', 'enfant'),
        'parent_item_colon' => null,
        'add_new_item' => esc_html__('Add Staff Member', 'zoutula'),
        'add_new' => esc_html(_x('Add Staff Member', 'zoutula')),
        'menu_name' => esc_html__('Staff', 'zoutula'),
    );


    register_post_type('member',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'rewrite' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields'),
            'show_admin_column' => true,
            'has_archive' => 'staff'
        )
    );

    //Staff custom taxonomy
    register_taxonomy('staff_taxonomy',
        array('member'),
        array(
            'label' => esc_html__('Staff Categories', 'zoutula'),
            'singular_label' => esc_html__('Staff Category', 'zoutula'),
            'hierarchical' => true,
            'query_var' => true,
            'public' => true,
            'rewrite' => array(
                'slug' => 'staff',
            ),
        )
    );


    //Course custom post

    $labels = array(
        'name' => esc_html(_x('Courses', 'Category name', 'zoutula')),
        'singular_name' => esc_html(_x('Course', 'Category item', 'zoutula')),
        'all_items' => esc_html__('All Courses', 'zoutula'),
        'parent_item_colon' => null,
        'add_new_item' => esc_html__('Add Course', 'zoutula'),
        'add_new' => esc_html(_x('Add Course', 'zoutula')),
        'menu_name' => esc_html__('Courses', 'zoutula'),
    );


    //Course custom post

    register_post_type('course',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields'),
            'show_admin_column' => true,
            'has_archive' => 'courses'
        )
    );

    register_taxonomy('courses_taxonomy',
        array('course'),
        array(
            'label' => esc_html__('Courses Categories', 'zoutula'),
            'singular_label' => esc_html__('Course Category', 'zoutula'),
            'hierarchical' => true,
            'query_var' => true,
            'public' => true,
            'rewrite' => array(
                'slug' => 'courses',
            ),
        )
    );


    //Events
    $labels = array(
        'name' => esc_html(_x('Events', 'Category name', 'zoutula')),
        'singular_name' => esc_html(_x('Event', 'Category item', 'zoutula')),
        'all_items' => esc_html__('All Events', 'zoutula'),
        'parent_item_colon' => null,
        'add_new_item' => esc_html__('Add Event', 'zoutula'),
        'add_new' => esc_html(_x('Add Event', 'zoutula')),
        'menu_name' => esc_html__('Events', 'zoutula'),
    );

    //Event custom post

    register_post_type('event',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields'),
            'show_admin_column' => true,
            'has_archive' => 'events'
        )
    );

    register_taxonomy('events_taxonomy',
        array('event'),
        array(
            'label' => esc_html__('Events Categories', 'zoutula'),
            'singular_label' => esc_html__('Event Category', 'zoutula'),
            'hierarchical' => true,
            'query_var' => true,
            'public' => true,
            'rewrite' => array(
                'slug' => 'events',
            ),
        )
    );


}


add_action( 'plugins_loaded', 'enfant_load_textdomain' );
function enfant_load_textdomain() {
  // Load plugin textdomain. E.g.: wp-content/plugins/enfant-theme-extension/languages/zoutula-de_DE.mo
    load_plugin_textdomain( 'zoutula', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

}

add_action('init', 'enfant_custom_data');

//set number of posts for staff taxonomy and archive post type = member
function enfant_staff_posts_per_page($query)
{
    if (! is_admin() && ! is_search()) {
        if (($query->is_post_type_archive('member') || $query->is_tax('staff_taxonomy')) && $query->is_main_query()) {
            $query->set('posts_per_page', (int)get_theme_mod('staff_posts_per_page', '9'));
        }
    }
}
add_action('pre_get_posts', 'enfant_staff_posts_per_page');



//set number of posts for courses taxonomy and archive post type = course
function enfant_courses_posts_per_page($query)
{
    if (! is_admin() && ! is_search()) {
        if (($query->is_post_type_archive('course') || $query->is_tax('courses_taxonomy')) && $query->is_main_query()) {
            $query->set('posts_per_page', (int)get_theme_mod('courses_posts_per_page', '9'));
        }
    }
}
add_action('pre_get_posts', 'enfant_courses_posts_per_page');



//set number of posts for events taxonomy and archive post type = course
function enfant_events_posts_per_page($query)
{
    if (! is_admin() && ! is_search()) {
        if (($query->is_post_type_archive('event') || $query->is_tax('events_taxonomy')) && $query->is_main_query()) {
            $query->set('posts_per_page', (int)get_theme_mod('events_posts_per_page', '6'));
        }
    }
}
add_action('pre_get_posts', 'enfant_events_posts_per_page');




//Courses columns
add_filter('manage_edit-course_columns', 'enfant_edit_course_columns');

function enfant_edit_course_columns($columns)
{

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('Title'),
        'category' => esc_html__('Category'),
        'date' => esc_html__('Date')
    );

    return $columns;
}


add_action('manage_course_posts_custom_column', 'enfant_manage_course_columns', 10, 2);

function enfant_manage_course_columns($column, $post_id)
{
    global $post;
    switch ($column) {
        case 'category':
            echo get_the_term_list($post->ID, 'courses_taxonomy', '', ', ', '');
            break;
    }

}


//Staff columns
add_filter('manage_edit-member_columns', 'enfant_edit_member_columns');

function enfant_edit_member_columns($columns)
{

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('Title'),
        'category' => esc_html__('Category'),
        'date' => esc_html__('Date')
    );

    return $columns;
}


add_action('manage_member_posts_custom_column', 'enfant_manage_member_columns', 10, 2);

function enfant_manage_member_columns($column, $post_id)
{
    global $post;
    switch ($column) {
        case 'category':
            echo get_the_term_list($post->ID, 'staff_taxonomy', '', ', ', '');
            break;
    }

}


//Events columns
add_filter('manage_edit-event_columns', 'enfant_edit_event_columns');

function enfant_edit_event_columns($columns)
{

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => esc_html__('Title'),
        'category' => esc_html__('Category'),
        'date' => esc_html__('Date')
    );

    return $columns;
}


add_action('manage_event_posts_custom_column', 'enfant_manage_event_columns', 10, 2);

function enfant_manage_event_columns($column, $post_id)
{
    global $post;
    switch ($column) {
        case 'category':
            echo get_the_term_list($post->ID, 'events_taxonomy', '', ', ', '');
            break;
    }

}


//metaboxes
include ('metaboxes.php');

//widgets
include ('widgets/enfant-recent-posts-widget.php');

//shortcodes
include('shortcodes/divider_ztl.php');
include('shortcodes/announcement_ztl.php');
include('shortcodes/counter_ztl.php');
include('shortcodes/package_ztl.php');
include('shortcodes/countdown_ztl.php');
include('shortcodes/title_ztl.php');
include('shortcodes/posts_grid_ztl.php');
include('shortcodes/subscriber_ztl.php');
include('shortcodes/steps_ztl.php');
include('shortcodes/map_ztl.php');
include('shortcodes/pricing_plan_ztl.php');
include('shortcodes/testimonials_ztl.php');

//extend some VC functionality

add_action('vc_after_init', 'ztl_custom_font_icons');
add_action('vc_enqueue_font_icon_element', 'ztl_custom_icon_fonts_enqueue');


add_action('vc_backend_editor_enqueue_js_css', 'ztl_iconpicker_editor_jscss');
add_action('vc_frontend_editor_enqueue_js_css', 'ztl_iconpicker_editor_jscss');

/* Map for my custom icons */
add_filter('vc_iconpicker-type-flaticon', 'ztl_icon_font_list_flaticon');

function ztl_custom_font_icons()
{
    /* Add Extra Icon Fonts */
    $param = WPBMap::getParam('vc_icon', 'type');


    if (!is_array($param)) {
        return false;
    }

    $param['weight'] = 2;
    $param['value'] = array(esc_html__('Zoutula Icons', 'zoutula') => 'flaticon') + $param['value'];
    vc_update_shortcode_param('vc_icon', $param);


    /* Add Param Type */
    $attributes = array(
        'type' => 'iconpicker',
        'heading' => esc_html__('Icon', 'zoutula'),
        'param_name' => 'icon_flaticon',
        'weight' => 1,
        'settings' => array(
            'emptyIcon' => false,
            'type' => 'flaticon',
            'iconsPerPage' => -1,
        ),
        'dependency' => array(
            'element' => 'type',
            'value' => 'flaticon',
        ),
        'description' => esc_html__('Select icon from library.', 'zoutula'),
    );
    vc_add_param('vc_icon', $attributes);


    //Add one more size
    $param = WPBMap::getParam('vc_icon', 'size');
    $param['value'] = array(esc_html__('Large Zoutula', 'zoutula') => 'ztl-lg') + $param['value'];
    vc_update_shortcode_param('vc_icon', $param);


}


function ztl_custom_icon_fonts_enqueue($font)
{
    switch ($font) {
        case "flaticon":
            wp_enqueue_style('font-flaticon', plugin_dir_url(__FILE__) . 'shortcodes/assets/font-icons/flaticon.css');
            break;
    }
}

function ztl_iconpicker_editor_jscss()
{
    wp_enqueue_style('font-flaticon', plugin_dir_url(__FILE__) . 'shortcodes/assets/font-icons/flaticon.css');
}


function ztl_icon_font_list_flaticon($icons)
{
    $flaticons = array(
        array('flaticon-clock-2' => ' Clock 2',),
        array('flaticon-food-1' => ' Food 1',),
        array('flaticon-food' => ' Food',),
        array('flaticon-cake' => ' Cake',),
        array('flaticon-location-2' => ' Location 2',),
        array('flaticon-signs-1' => ' Signs 1',),
        array('flaticon-clock-1' => ' Clock 1',),
        array('flaticon-location-1' => ' Location 1',),
        array('flaticon-location' => ' Location',),
        array('flaticon-construction-1' => ' Construction 1',),
        array('flaticon-violin-1' => ' Violin 1',),
        array('flaticon-domra' => ' Domra',),
        array('flaticon-microphone-1' => ' Microphone 1',),
        array('flaticon-djembe' => ' Djembe',),
        array('flaticon-drum-4' => ' Drum 4',),
        array('flaticon-maracas-1' => ' Maracas 1',),
        array('flaticon-chimes' => ' Chimes',),
        array('flaticon-cymbals-1' => ' Cymbals 1',),
        array('flaticon-conga' => ' Conga',),
        array('flaticon-keyboard' => ' Keyboard',),
        array('flaticon-xylophone-2' => ' Xylophone 2',),
        array('flaticon-acoustic-guitar' => ' Acoustic Guitar',),
        array('flaticon-newborn' => ' Newborn',),
        array('flaticon-plane' => ' Plane',),
        array('flaticon-baby-1' => ' Baby 1',),
        array('flaticon-cradle-1' => ' Cradle 1',),
        array('flaticon-construction' => ' Construction',),
        array('flaticon-cradle' => ' Cradle',),
        array('flaticon-train' => ' Train',),
        array('flaticon-moon' => ' Moon',),
        array('flaticon-high-chair' => ' High Chair',),
        array('flaticon-socks' => ' Socks',),
        array('flaticon-crib-toy' => ' Crib Toy',),
        array('flaticon-drawing' => ' Drawing',),
        array('flaticon-bicycle-1' => ' Bicycle 1',),
        array('flaticon-teddy-bear-1' => ' Teddy Bear 1',),
        array('flaticon-paper-boat' => ' Paper Boat',),
        array('flaticon-body' => ' Body',),
        array('flaticon-doll-1' => ' Doll 1',),
        array('flaticon-diaper' => ' Diaper',),
        array('flaticon-sand-bucket' => ' Sand Bucket',),
        array('flaticon-bricks' => ' Bricks',),
        array('flaticon-alarm-clock-1' => ' Alarm Clock 1',),
        array('flaticon-briefcase' => ' Briefcase',),
        array('flaticon-set-square-1' => ' Set Square 1',),
        array('flaticon-paint-palette' => ' Paint Palette',),
        array('flaticon-eraser' => ' Eraser',),
        array('flaticon-clip' => ' Clip',),
        array('flaticon-compass' => ' Compass',),
        array('flaticon-bell-1' => ' Bell 1',),
        array('flaticon-earth-globe' => ' Earth Globe',),
        array('flaticon-abacus-1' => ' Abacus 1',),
        array('flaticon-test' => ' Test',),
        array('flaticon-bookshelf' => ' Bookshelf',),
        array('flaticon-school' => ' School',),
        array('flaticon-add' => ' Add',),
        array('flaticon-gift' => ' Gift',),
        array('flaticon-barbecue' => ' Barbecue',),
        array('flaticon-christmas-sock' => ' Christmas Sock',),
        array('flaticon-easter-eggs' => ' Easter Eggs',),
        array('flaticon-baubles' => ' Baubles',),
        array('flaticon-mittens' => ' Mittens',),
        array('flaticon-snowman' => ' Snowman',),
        array('flaticon-vinyls' => ' Vinyls',),
        array('flaticon-musical-note-1' => ' Musical Note 1',),
        array('flaticon-quaver' => ' Quaver',),
        array('flaticon-ipod' => ' Ipod',),
        array('flaticon-headphones' => ' Headphones',),
        array('flaticon-music-6' => ' Music 6',),
        array('flaticon-drumsticks' => ' Drumsticks',),
        array('flaticon-cymbals' => ' Cymbals',),
        array('flaticon-music-5' => ' Music 5',),
        array('flaticon-drum-3' => ' Drum 3',),
        array('flaticon-drum-2' => ' Drum 2',),
        array('flaticon-timpani' => ' Timpani',),
        array('flaticon-drum-1' => ' Drum 1',),
        array('flaticon-drum' => ' Drum',),
        array('flaticon-music-4' => ' Music 4',),
        array('flaticon-violin' => ' Violin',),
        array('flaticon-ukelele' => ' Ukelele',),
        array('flaticon-bass-guitar' => ' Bass Guitar',),
        array('flaticon-maracas' => ' Maracas',),
        array('flaticon-saxophone' => ' Saxophone',),
        array('flaticon-piccolo' => ' Piccolo',),
        array('flaticon-trumpet' => ' Trumpet',),
        array('flaticon-trombone' => ' Trombone',),
        array('flaticon-french-horn' => ' French Horn',),
        array('flaticon-music-3' => ' Music 3',),
        array('flaticon-music-2' => ' Music 2',),
        array('flaticon-music-1' => ' Music 1',),
        array('flaticon-music' => ' Music',),
        array('flaticon-triangle' => ' Triangle',),
        array('flaticon-xylophone-1' => ' Xylophone 1',),
        array('flaticon-turntable' => ' Turntable',),
        array('flaticon-microphone' => ' Microphone',),
        array('flaticon-amplifier' => ' Amplifier',),
        array('flaticon-equalizer' => ' Equalizer',),
        array('flaticon-workstation' => ' Workstation',),
        array('flaticon-baby' => ' Baby',),
        array('flaticon-wind' => ' Wind',),
        array('flaticon-youtube' => ' Youtube',),
        array('flaticon-twitter' => ' Twitter',),
        array('flaticon-skype' => ' Skype',),
        array('flaticon-linkedin' => ' Linkedin',),
        array('flaticon-google-plus' => ' Google Plus',),
        array('flaticon-facebook' => ' Facebook',),
        array('flaticon-pencil-2' => ' Pencil 2',),
        array('flaticon-draw-1' => ' Draw 1',),
        array('flaticon-draw' => ' Draw',),
        array('flaticon-set-square' => ' Set Square',),
        array('flaticon-rule' => ' Rule',),
        array('flaticon-watercolor' => ' Watercolor',),
        array('flaticon-agenda' => ' Agenda',),
        array('flaticon-sports' => ' Sports',),
        array('flaticon-american-football-1' => ' American Football 1',),
        array('flaticon-grades' => ' Grades',),
        array('flaticon-paper-plane' => ' Paper Plane',),
        array('flaticon-animals' => ' Animals',),
        array('flaticon-nature' => ' Nature',),
        array('flaticon-computer' => ' Computer',),
        array('flaticon-physics' => ' Physics',),
        array('flaticon-vision' => ' Vision',),
        array('flaticon-desk' => ' Desk',),
        array('flaticon-teacher-desk' => ' Teacher Desk',),
        array('flaticon-high-school' => ' High School',),
        array('flaticon-tray' => ' Tray',),
        array('flaticon-swimming-pool' => ' Swimming Pool',),
        array('flaticon-suitcase' => ' Suitcase',),
        array('flaticon-snowflake' => ' Snowflake',),
        array('flaticon-first-aid-kit' => ' First Aid Kit',),
        array('flaticon-map' => ' Map',),
        array('flaticon-forest' => ' Forest',),
        array('flaticon-signs' => ' Signs',),
        array('flaticon-clock' => ' Clock',),
        array('flaticon-bag' => ' Bag',),
        array('flaticon-girl' => ' Girl',),
        array('flaticon-joystick' => ' Joystick',),
        array('flaticon-house' => ' House',),
        array('flaticon-top' => ' Top',),
        array('flaticon-bucket' => ' Bucket',),
        array('flaticon-bicycle' => ' Bicycle',),
        array('flaticon-skipping-rope' => ' Skipping Rope',),
        array('flaticon-boomerang' => ' Boomerang',),
        array('flaticon-kindergarten' => ' Kindergarten',),
        array('flaticon-swing' => ' Swing',),
        array('flaticon-kite' => ' Kite',),
        array('flaticon-milk' => ' Milk',),
        array('flaticon-apple-2' => ' Apple 2',),
        array('flaticon-cutlery-1' => ' Cutlery 1',),
        array('flaticon-musical-note' => ' Musical Note',),
        array('flaticon-bell' => ' Bell',),
        array('flaticon-rattle' => ' Rattle',),
        array('flaticon-synthesizer' => ' Synthesizer',),
        array('flaticon-xylophone' => ' Xylophone',),
        array('flaticon-chair' => ' Chair',),
        array('flaticon-puzzle-1' => ' Puzzle 1',),
        array('flaticon-pencil-1' => ' Pencil 1',),
        array('flaticon-blocks' => ' Blocks',),
        array('flaticon-backpack' => ' Backpack',),
        array('flaticon-abacus' => ' Abacus',),
        array('flaticon-puzzle' => ' Puzzle',),
        array('flaticon-car' => ' Car',),
        array('flaticon-helicopter' => ' Helicopter',),
        array('flaticon-clown' => ' Clown',),
        array('flaticon-doll' => ' Doll',),
        array('flaticon-teddy-bear' => ' Teddy Bear',),
        array('flaticon-alarm-clock' => ' Alarm Clock',),
        array('flaticon-game' => ' Game',),
        array('flaticon-bacteria' => ' Bacteria',),
        array('flaticon-test-tube' => ' Test Tube',),
        array('flaticon-flasks' => ' Flasks',),
        array('flaticon-scientist' => ' Scientist',),
        array('flaticon-earth' => ' Earth',),
        array('flaticon-axis' => ' Axis',),
        array('flaticon-telescope' => ' Telescope',),
        array('flaticon-solar-system' => ' Solar System',),
        array('flaticon-petri-dish' => ' Petri Dish',),
        array('flaticon-molecular' => ' Molecular',),
        array('flaticon-statistics' => ' Statistics',),
        array('flaticon-apple-1' => ' Apple 1',),
        array('flaticon-rat' => ' Rat',),
        array('flaticon-molecule-1' => ' Molecule 1',),
        array('flaticon-three-test-tubes' => ' Three Test Tubes',),
        array('flaticon-water' => ' Water',),
        array('flaticon-zoom' => ' Zoom',),
        array('flaticon-square' => ' Square',),
        array('flaticon-tool' => ' Tool',),
        array('flaticon-school-bus-front' => ' School Bus Front',),
        array('flaticon-two-test-tubes' => ' Two Test Tubes',),
        array('flaticon-children-backpack' => ' Children Backpack',),
        array('flaticon-circle' => ' Circle',),
        array('flaticon-close-button' => ' Close Button',),
        array('flaticon-move-to-the-next-page-symbol' => ' Move To The Next Page Symbol',),
        array('flaticon-left-arrow-chevron' => ' Left Arrow Chevron',),
        array('flaticon-global' => ' Global',),
        array('flaticon-teacher' => ' Teacher',),
        array('flaticon-sharpener' => ' Sharpener',),
        array('flaticon-professor' => ' Professor',),
        array('flaticon-pencil' => ' Pencil',),
        array('flaticon-kindergarden' => ' Kindergarden',),
        array('flaticon-student-2' => ' Student 2',),
        array('flaticon-easel' => ' Easel',),
        array('flaticon-court' => ' Court',),
        array('flaticon-calculator' => ' Calculator',),
        array('flaticon-school-bus-1' => ' School Bus 1',),
        array('flaticon-student-1' => ' Student 1',),
        array('flaticon-mountain' => ' Mountain',),
        array('flaticon-bonfire' => ' Bonfire',),
        array('flaticon-open' => ' Open',),
        array('flaticon-tea' => ' Tea',),
        array('flaticon-cupcake' => ' Cupcake',),
        array('flaticon-chicken' => ' Chicken',),
        array('flaticon-cutlery' => ' Cutlery',),
        array('flaticon-salver' => ' Salver',),
        array('flaticon-ice-cream' => ' Ice Cream',),
        array('flaticon-book-1' => ' Book 1',),
        array('flaticon-open-book' => ' Open Book',),
        array('flaticon-book' => ' Book',),
        array('flaticon-board' => ' Board',),
        array('flaticon-blackboard' => ' Blackboard',),
        array('flaticon-student' => ' Student',),
        array('flaticon-diploma' => ' Diploma',),
        array('flaticon-medal' => ' Medal',),
        array('flaticon-glasses' => ' Glasses',),
        array('flaticon-mortarboard' => ' Mortarboard',),
        array('flaticon-american-football' => ' American Football',),
        array('flaticon-notebook' => ' Notebook',),
        array('flaticon-whistle' => ' Whistle',),
        array('flaticon-momentum' => ' Momentum',),
        array('flaticon-molecule' => ' Molecule',),
        array('flaticon-microscope' => ' Microscope',),
        array('flaticon-flask' => ' Flask',),
        array('flaticon-test-tubes' => ' Test Tubes',),
        array('flaticon-apple' => ' Apple',),
        array('flaticon-school-bus' => ' School Bus',),
        array('flaticon-light' => ' Light',),
    );

    return array_merge($icons, $flaticons);
}


/**
 * Enqueue scripts and styles.
 */
function zoutula_scripts()
{
    wp_enqueue_style('zoutula-style', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/shortcodes.css', false, VERSION);
    wp_enqueue_style('zoutula-responsive', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/responsive.css', false, VERSION);
    wp_enqueue_style('zoutula-font-icons', plugin_dir_url(__FILE__) . 'shortcodes/assets/font-icons/flaticon.css', false, VERSION);
    wp_enqueue_style('owl-carousel', plugin_dir_url(__FILE__) . 'shortcodes/assets/css/owl.carousel.min.css', false, VERSION);

    wp_enqueue_script('zoutula-counter', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/countUp.min.js', array('jquery'), VERSION, true);
    wp_enqueue_script('zoutula-countdown', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/jquery.countdown.js', array('jquery'), VERSION, true);
    wp_enqueue_script('zoutula-shortcodes', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/shortcodes.js', array('jquery'), VERSION, true);
    wp_enqueue_script('owl-carousel', plugin_dir_url(__FILE__) . 'shortcodes/assets/js/owl.carousel.min.js', array('jquery'), VERSION, true);


}
add_action('wp_enqueue_scripts', 'zoutula_scripts');



/* Predefined import settings */
function enfant_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           => 'Enfant Primary School',
            'import_file_url'            => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/primary-school/wordpress.xml',
            'import_widget_file_url'     => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/primary-school/widgets.wie',
            'import_customizer_file_url' => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/primary-school/customizer.dat',
            'import_preview_image_url'   => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/primary-school/preview.jpg',
            'import_notice'              => esc_html__( 'After you import this demo, you will have to import the Revolution Slider and Essential Grid data separately.', 'zoutula' ),
            'preview_url'                => 'http://demo.zoutula.com/enfant-primary-school',
        ),
        array(
            'import_file_name'           => 'Enfant Kindergarten',
            'import_file_url'            => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/kindergarten/wordpress.xml',
            'import_widget_file_url'     => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/kindergarten/widgets.wie',
            'import_customizer_file_url' => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/kindergarten/customizer.dat',
            'import_preview_image_url'   => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/kindergarten/preview.jpg',
            'import_notice'              => esc_html__( 'After you import this demo, you will have to import the Revolution Slider and Essential Grid data separately.', 'zoutula' ),
            'preview_url'                => 'http://demo.zoutula.com/enfant-kindergarten',

        ),
        array(
            'import_file_name'           => 'Enfant Music School',
            'import_file_url'            => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/music-school/wordpress.xml',
            'import_widget_file_url'     => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/music-school/widgets.wie',
            'import_customizer_file_url' => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/music-school/customizer.dat',
            'import_preview_image_url'   => 'http://www.zoutula.com/repository/enfant/vLhPoCelq3/imports/music-school/preview.jpg',
            'import_notice'              => esc_html__( 'After you import this demo, you will have to import the Revolution Slider and Essential Grid data separately.', 'zoutula' ),
            'preview_url'                => 'http://demo.zoutula.com/enfant-music-school',

        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'enfant_ocdi_import_files' );

/* Remove Branding*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/* Setup the homepage and primary menu */
function enfant_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );

    // Update date format as in demo
    update_option( 'date_format', 'j / F' );

}
add_action( 'pt-ocdi/after_import', 'enfant_ocdi_after_import_setup' );

