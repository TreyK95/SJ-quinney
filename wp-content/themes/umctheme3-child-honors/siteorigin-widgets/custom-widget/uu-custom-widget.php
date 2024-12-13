<?php
/*
Widget Name: U of U Custom Widget
Description: Custom Card Templates for The University of Utah
Author: Trey Kemp
Author URI: https://umc.utah.edu
*/

class Custom_Widget extends SiteOrigin_Widget {

    function __construct() {
        parent::__construct(
            'custom-widget', // Widget ID
            __('U of U Custom Card Honors Advising', 'custom-widget-text-domain'), // Widget Name
            array(
                'description' => __('Custom card template for Honors Advising Team.', 'custom-widget-text-domain'),
            ),
            array(),
            array(
                // Form fields
                'uu_card_layout' => array(
                    'type' => 'select',
                    'label' => __('Card Layout', 'custom-widget-text-domain'),
                    'description' => __('Choose a layout for the cards.', 'custom-widget-text-domain'),
                    'default' => 'vert-img-top',
                    'options' => array(
                        'vert-img-top' => __('Vertical with Image on Top', 'custom-widget-text-domain'),
                        'horz-img-left' => __('Horizontal with Image on Left', 'custom-widget-text-domain'),
                        'horz-img-right' => __('Horizontal with Image on Right', 'custom-widget-text-domain'),
                    ),
                ),
                'uu_card_per_row' => array(
                    'type' => 'select',
                    'label' => __('Cards Per Row', 'custom-widget-text-domain'),
                    'default' => '3col',
                    'options' => array(
                        '1col' => __('1 Card', 'custom-widget-text-domain'),
                        '2col' => __('2 Cards', 'custom-widget-text-domain'),
                        '3col' => __('3 Cards', 'custom-widget-text-domain'),
                        '4col' => __('4 Cards', 'custom-widget-text-domain'),
                    ),
                ),
                'uu_card_repeater' => array(
                    'type' => 'repeater',
                    'label' => __('Cards', 'custom-widget-text-domain'),
                    'item_name' => __('Card', 'custom-widget-text-domain'),
                    'fields' => array(
                        'uu_card_image' => array(
                            'type' => 'media',
                            'label' => __('Choose an Image', 'custom-widget-text-domain'),
                        ),
                        'uu_card_name' => array(
                            'type' => 'text',
                            'label' => __('Name (with Pronouns)', 'custom-widget-text-domain'),
                        ),
                        'uu_card_title' => array(
                            'type' => 'text',
                            'label' => __('Title or Designation', 'custom-widget-text-domain'),
                        ),
                        'uu_card_btn1_title' => array(
                            'type' => 'text',
                            'label' => __('Button 1 Title', 'custom-widget-text-domain'),
                        ),
                        'uu_card_btn1_url' => array(
                            'type' => 'link',
                            'label' => __('Button 1 URL', 'custom-widget-text-domain'),
                        ),
                        'uu_card_btn2_title' => array(
                            'type' => 'text',
                            'label' => __('Button 2 Title', 'custom-widget-text-domain'),
                        ),
                        'uu_card_btn2_url' => array(
                            'type' => 'link',
                            'label' => __('Button 2 URL', 'custom-widget-text-domain'),
                        ),
                    ),
                ),
            ),
            get_stylesheet_directory() . '/siteorigin-widgets/custom-widget'
        );

        // Register frontend and admin assets
        $this->initialize();
    }

    // Template name
    function get_template_name($instance) {
        return 'uu-custom-template';
    }

    // Initialize styles and scripts
    function initialize() {
        $this->register_frontend_scripts(
            array(
                array(
                    'uu-custom-widget-scripts',
                    get_stylesheet_directory_uri() . '/siteorigin-widgets/custom-widget/js/uu-custom-widget.js',
                    array('jquery'),
                    '1.0',
                    true
                ),
            )
        );
        $this->register_frontend_styles(
            array(
                array(
                    'uu-custom-widget-styles',
                    get_stylesheet_directory_uri() . '/siteorigin-widgets/custom-widget/css/uu-custom-widget.css',
                    array(),
                    '1.0'
                ),
            )
        );
    }
}

// Register the widget
siteorigin_widget_register('custom-widget', __FILE__, 'Custom_Widget');
