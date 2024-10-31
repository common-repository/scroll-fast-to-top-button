<?php

/*
  Plugin Name:Scroll Fast To Top Button
  Description:Scroll Fast To Top Button  the simplest and lightweight Scroll Back To Top Button. Which display Scroll To Back Top Button on your web site.
  Version: 1.0
  Author: Md Miraj Khan
  Author URI: https://www.upwork.com/o/profiles/users/_~012282969fe4714e35/
  License: License: GPLv2 or later

 */
/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

  Copyright 2005-2015 Automattic, Inc.
 */


// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

if (!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php");
}

define('SCROLL_FAST_TO_TOP_PLUGIN_DIR', plugin_dir_path(__FILE__));




function scroll_fast_to_top_plugin_script() {
    
//    CSS

    wp_enqueue_style('scroll_fast_to_top_css', plugin_dir_url(__FILE__) . 'css/jquerysctipttop.css');
    wp_enqueue_style('ap-scroll-top', plugin_dir_url(__FILE__) . 'css/ap-scroll-top.css');
    wp_enqueue_style('scroll_fast_to_top_plugin-main', plugin_dir_url(__FILE__) . 'css/plugin-main.css');
        
//    JavaScript    
    wp_enqueue_script('jquery');
    wp_enqueue_script('ap-scroll-js', plugin_dir_url(__FILE__) . 'js/ap-scroll-top.js', array('jquery'), 3.0,true);
}
add_action('init', 'scroll_fast_to_top_plugin_script');


    
    
    function scroll_fast_to_top_footer_script() {

    ?>
 		<script type="text/javascript">
            // Setup plugin with default settings
            jQuery(document).ready(function() {

                jQuery.apScrollTop({
                    'onInit': function(evt) {
                        console.log('apScrollTop: init');
                    }
                });

                // Add event listeners
                jQuery.apScrollTop().on('apstInit', function(evt) {
                    console.log('apScrollTop: init');
                });

                jQuery.apScrollTop().on('apstToggle', function(evt, details) {
                    console.log('apScrollTop: toggle / is visible: ' + details.visible);
                });

                jQuery.apScrollTop().on('apstCssClassesUpdated', function(evt) {
                    console.log('apScrollTop: cssClassesUpdated');
                });

                jQuery.apScrollTop().on('apstPositionUpdated', function(evt) {
                    console.log('apScrollTop: positionUpdated');
                });

                jQuery.apScrollTop().on('apstEnabled', function(evt) {
                    console.log('apScrollTop: enabled');
                });

                jQuery.apScrollTop().on('apstDisabled', function(evt) {
                    console.log('apScrollTop: disabled');
                });

                jQuery.apScrollTop().on('apstBeforeScrollTo', function(evt, details) {
                    console.log('apScrollTop: beforeScrollTo / position: ' + details.position + ', speed: ' + details.speed);

                    // You can return a single number here, which means that to this position
                    // browser window scolls to
                    /*
                    return 100;
                    */

                    // .. or you can return an object, containing position and speed:
                    /*
                    return {
                        position: 100,
                        speed: 100
                    };
                    */

                    // .. or do not return anything, so the default values are used to scroll
                });

                jQuery.apScrollTop().on('apstScrolledTo', function(evt, details) {
                    console.log('apScrollTop: scrolledTo / position: ' + details.position);
                });

                jQuery.apScrollTop().on('apstDestroy', function(evt, details) {
                    console.log('apScrollTop: destroy');
                });

            });


            // Add change events for options
            jQuery('#option-enabled').on('change', function() {
                var enabled = $(this).is(':checked');
                $.apScrollTop('option', 'enabled', enabled);
            });

            jQuery('#option-visibility-trigger').on('change', function() {
                var value = $(this).val();
                if (value == 'custom-function') {
                    $.apScrollTop('option', 'visibilityTrigger', function(currentYPos) {
                        var imagePosition = $('#image-for-custom-function').offset();
                        return (currentYPos > imagePosition.top);
                    });
                }
                else {
                    $.apScrollTop('option', 'visibilityTrigger', parseInt(value));
                }
            });

            jQuery('#option-visibility-fade-speed').on('change', function() {
                var value = parseInt($(this).val());
                $.apScrollTop('option', 'visibilityFadeSpeed', value);
            });

            jQuery('#option-scroll-speed').on('change', function() {
                var value = parseInt($(this).val());
                $.apScrollTop('option', 'scrollSpeed', value);
            });

            jQuery('#option-position').on('change', function() {
                var value = $(this).val();
                $.apScrollTop('option', 'position', value);
            });
		</script>

     <?php
    
    }
    
    add_action('wp_footer', 'scroll_fast_to_top_footer_script');




