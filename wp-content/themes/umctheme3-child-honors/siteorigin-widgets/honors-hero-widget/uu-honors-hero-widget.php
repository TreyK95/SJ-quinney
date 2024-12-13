<?php
/*
Widget Name: U of U Honors Hero Widget
Description: This is the Honors Hero Widget Template
Author: Trey Kemp
Author URI: https://umc.utah.edu
*/

class Honors_Hero_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'honors-hero-widget', // Widget ID
            __('Honors Hero Widget', 'text-domain'), // Widget Name
            array(
                'description' => __('Main Hero for Honors. Split with a textbox that overlaps a background image', 'text-domain')
            ),
            array(),
            array(
                'hero_image' => array(
                    'type' => 'media',
                    'label' => __('Hero Image', 'text-domain'),
                    'choose' => __('Choose image', 'text-domain'),
                    'update' => __('Set image', 'text-domain'),
                    'library' => 'image'
                ),
                'overlay_image' => array(
                    'type' => 'media',
                    'label' => __('Background Overlay', 'text-domain'),
                    'choose' => __('Choose overlay', 'text-domain'),
                    'update' => __('Set overlay', 'text-domain'),
                    'library' => 'image'
                ),
                'overlay_position' => array(
                    'type' => 'select',
                    'label' => __('Overlay Image Position', 'text-domain'),
                    'options' => array(
                        'top left' => 'Top Left',
                        'top center' => 'Top Center',
                        'top right' => 'Top Right',
                        'center left' => 'Center Left',
                        'center center' => 'Center Center',
                        'center right' => 'Center Right',
                        'bottom left' => 'Bottom Left',
                        'bottom center' => 'Bottom Center',
                        'bottom right' => 'Bottom Right'
                    ),
                    'default' => 'center center' // Default position
                ),
                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'text-domain')
                ),
                'title_tag' => array(
                    'type' => 'select',
                    'label' => __('Title Tag', 'text-domain'),
                    'options' => array(
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6'
                    ),
                    'default' => 'h1'
                ),
                'title_color' => array(
                    'type' => 'select',
                    'label' => __('Title Color', 'text-domain'),
                    'options' => array(
                        'black' => 'Black',
                        'white' => 'White'
                    ),
                    'default' => 'white'
                ),
                'paragraph' => array(
                    'type' => 'textarea',
                    'label' => __('Paragraph', 'text-domain')
                ),
                'paragraph_color' => array(
                    'type' => 'select',
                    'label' => __('Paragraph Color', 'text-domain'),
                    'options' => array(
                        'black' => 'Black',
                        'white' => 'White'
                    ),
                    'default' => 'white'
                ),
                'arrow_icon' => array(
                    'type' => 'media',
                    'label' => __('Arrow Icon', 'text-domain'),
                    'choose' => __('Choose icon', 'text-domain'),
                    'update' => __('Set icon', 'text-domain'),
                    'library' => 'image'
                ),
                'arrow_link' => array(
                    'type' => 'link',
                    'label' => __('Arrow Icon Link', 'text-domain'),
                    'description' => __('Enter a URL for the arrow icon link (optional).', 'text-domain')
                )
            ),
            get_stylesheet_directory() . '/siteorigin-widgets/honors-hero-widget'
        );

        // Register frontend and admin assets
        $this->register_assets();
    }

    function widget($args, $instance) {
        // Check if the template file exists and include it directly
        $template_path = get_stylesheet_directory() . '/siteorigin-widgets/honors-hero-widget/tpl/uu-honors-hero-template.php';

        if (file_exists($template_path)) {
            include $template_path;
        } else {
            echo '<div style="color: red;">Error: Template file not found at ' . esc_html($template_path) . '</div>';
        }
    }

    // REGISTER FRONTEND STYLES & SCRIPTS
    function register_assets() {
        wp_enqueue_style(
            'uu-honors-hero-widget-styles',
            get_stylesheet_directory_uri() . '/siteorigin-widgets/honors-hero-widget/css/uu-honors-hero-widget.css',
            array(),
            '1.0'
        );
        wp_enqueue_script(
            'uu-honors-hero-widget-scripts',
            get_stylesheet_directory_uri() . '/siteorigin-widgets/honors-hero-widget/js/uu-honors-hero-widget.js',
            array('jquery'),
            '1.0',
            true
        );
    }
}
