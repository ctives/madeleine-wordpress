<?php

if (!defined('ABSPATH')) {
    die('-1');
}

add_shortcode('map_ztl', 'ztl_shortcode_map');
function ztl_shortcode_map($atts, $content = null)
{

    $atts = shortcode_atts(
        array(
            'coordinates' => '51.502188, -0.173143', //default
            'width' => '100%',
            'height' => '450px',
            'enable_scroll_wheel' => 'true',
            'zoom' => 15,
            'disable_controls' => 'false',
            'customization' => '[]',
            'marker' => ''
        ),
        $atts
    );

    //get API key
    $api_key = get_theme_mod('google_maps_api_key');
    wp_enqueue_script('google-maps-api', '//maps.google.com/maps/api/js?key=' . esc_attr($api_key), array( 'jquery' ), VERSION, true );

    if (empty($api_key)) {
        return esc_html__('This Google Map cannot be loaded because there is no API key loaded. Please check documentation.', 'zoutula');
    } elseif (empty($atts['coordinates'])) {
        return esc_html__('This Google Map cannot be loaded because there are no coordinates set. Please check documentation.', 'zoutula');
    } else {

        $map_id = uniqid('ztl_map_'); // generate a unique ID for this map

        $str = '
        <div class="ztl_map_canvas" id="' . esc_attr($map_id) . '"
             style="height:' . esc_attr($atts['height']) . '; width:' . esc_attr($atts['width']) . ';"></div>
             
        
            <script type="text/javascript">
			(function($){
                "use strict";
                var map;
                var mapId = "'.esc_js($map_id ).'";
                
                function initialize() {
		    		var featureOpts = '. urldecode(base64_decode($atts['customization'])) .';
									
					var mapOptions = {
						zoom: '.esc_js($atts['zoom']) .',
                        center: new google.maps.LatLng('.esc_js( $atts['coordinates'] ).'),
                        mapTypeId: mapId,
                        streetViewControl: false,
                        mapTypeControl: false,
                        panControl: false,
                        zoomControl: ' . esc_js('true' === strtolower($atts['disable_controls']) ? '0' : '1') . ',
                        scrollwheel: ' . esc_js('true' === strtolower($atts['enable_scroll_wheel']) ? '1' : '0') . ',
                        draggable:false,
                    };
                    
                    map = new google.maps.Map(document.getElementById("'.esc_js($map_id).'"), mapOptions);
                    var customMapType = new google.maps.StyledMapType(featureOpts);
                    map.mapTypes.set(mapId, customMapType);
                   
                    
                    var image = {
                        url: "'.esc_url(enfant_get_first(wp_get_attachment_image_src($atts['marker'],'full'))).'",
                        // This marker is 64 pixels wide by 64 pixels high.
                        scaledSize: new google.maps.Size(128, 128),
                        // The origin for this image is (0, 0).
                        origin: new google.maps.Point(0, 0),
                        // The anchor for this image is the base of the flagpole at (0, 32).
                        anchor: new google.maps.Point(64, 64)
                      };
                    
                    //add custom marker
                    var marker = new google.maps.Marker({
                        position: map.getCenter(),
                        map: map,
                        icon: image
                    });
                    
               
                    
                    google.maps.event.addDomListener(window, "resize", function() {
                        map.setCenter(mapOptions.center);
                    });
                    
                    map.addListener("bounds_changed", function() {
                        map.setCenter(mapOptions.center);
                    });
                    
                    }
                    $(document).ready(function(){
                        google.maps.event.addDomListener(window, "load", initialize);
                    });
                
                }(jQuery));
                </script>';

        return apply_filters('uds_shortcode_out_filter', $str);
    }
}


add_action('vc_before_init', 'ztl_map');
function ztl_map()
{
    vc_map(array(
        'name' => esc_html__('Map', 'zoutula'),
        'base' => 'map_ztl',
        'description' => esc_html__('Add Map', 'zoutula'),
        'show_settings_on_create' => true,
        'icon' => plugin_dir_url(__FILE__) . 'assets/images/map.png',
        'class' => '',
        'category' => esc_html__('Zoutula Shortcodes', 'zoutula'),
        'params' => array(
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Map coordinates', 'zoutula'),
                'param_name' => 'coordinates',
                'description' => esc_html__('Your coordinates should include latitude and longitude. E.g. 51.502188, -0.173143', 'zoutula')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Map width', 'zoutula'),
                'param_name' => 'width',
                'description' => esc_html__('Your map width. E.g. 100%', 'zoutula')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Map height', 'zoutula'),
                'param_name' => 'height',
                'description' => esc_html__('Your map width. E.g. 450px', 'zoutula')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable scroll wheel','zoutula'),
                'param_name' => 'enable_scroll_wheel',
                'value' => array(
                    esc_html__('Select', 'zoutula') => 'Select',
                    esc_html__('True', 'zoutula') => 'True',
                    esc_html__('False', 'zoutula') => 'False',
                    ),
                'description' => esc_html__('Enable map scroll wheel', 'zoutula')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Disable controls','zoutula'),
                'param_name' => 'disable_controls',
                'value' => array(
                    esc_html__('Select', 'zoutula') => 'Select',
                    esc_html__('True', 'zoutula') => 'True',
                    esc_html__('False', 'zoutula') => 'False',
                ),
                'description' => esc_html__('Disable map controls', 'zoutula')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => esc_html__('Map zoom', 'zoutula'),
                'param_name' => 'zoom',
                'description' => esc_html__('Our default zoom level is set to 15. You can increase or decrease up to your needs.', 'zoutula')
            ),
            array(
                'type' => 'attach_image',
                'class' => '',
                'heading' => esc_html__('Marker image', 'zoutula'),
                'param_name' => 'marker',
                'description' => esc_html__('Marker image', 'zoutula')
            ),
            array(
                'type' => 'textarea_raw_html',
                'class' => '',
                'heading' => esc_html__('Custom style', 'zoutula'),
                'param_name' => 'customization',
                'description' => esc_html__('You can add here a JavaScript style array. More on: https://snazzymaps.com', 'zoutula')
            ),
        )
    ));
}