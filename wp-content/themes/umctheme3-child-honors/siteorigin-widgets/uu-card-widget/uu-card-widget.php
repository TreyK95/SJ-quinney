<?php
/*
Widget Name: U of U Card Widget
Description: Custom Card Templates for The University of Utah
Author: James Tombs
Author URI: digital.utah.edu
Widget URI: digital.utah.edu
*/

class UU_Card_Widget extends SiteOrigin_Widget {

  // CONSTRUCT FIELDS
  function __construct() {

    // CALL PARENT WITH ARGS
		parent::__construct(

      // WIDGET ID, NAME, OPTIONS, AND FIELDS
      // ID
      'uu-card-widget',
      // NAME
			__('U of U Card Widget', 'uu-card-widget-text-domain'),
      // WIDGET OPTIONS
			array(
				'description' => __('Cards with different layouts.', 'uu-card-widget-text-domain'),
			),
      // CONTROL OPTIONS
			array(

			),
			//FIELDS (FORM OPTIONS)
			array(
        // CARD LAYOUT
        'uu_card_layout' => array(
          'type' => 'select',
          'label' => __( 'Card Layout', 'widget-form-fields-text-domain' ),
          'description' => __( 'Horizontal Cards look best with 1 card per row', 'widget-form-fields-text-domain' ),
          'default' => 'vert-img-top',
          'options' => array(
            'vert-img-top' => __( 'Vertical with Image on Top', 'widget-form-fields-text-domain' ),
            'horz-img-left' => __( 'Horizontal with Image on Left', 'widget-form-fields-text-domain' ),
            'horz-img-right' => __( 'Horizontal with Image on Right', 'widget-form-fields-text-domain' ),
          )
        ),
        // CARDS PER ROW
        'uu_card_per_row' => array(
          'type' => 'select',
          'label' => __( 'Cards Per Row', 'widget-form-fields-text-domain' ),
          'description' => __( '4 or more cards per row look best in full width stretched rows.', 'widget-form-fields-text-domain' ),
          'default' => '3col',
          'options' => array(
            '1col' => __( '1 Card', 'widget-form-fields-text-domain' ),
            '2col' => __( '2 Cards', 'widget-form-fields-text-domain' ),
            '3col' => __( '3 Cards', 'widget-form-fields-text-domain' ),
            '4col' => __( '4 Cards', 'widget-form-fields-text-domain' ),
            '5col' => __( '5 Cards', 'widget-form-fields-text-domain' ),
            '6col' => __( '6 Cards', 'widget-form-fields-text-domain' ),
          )
        ),
        // BORDER RADIUS
        'uu_card_border_radius' => array(
          'type' => 'select',
          'label' => __( 'Rounded Corners?', 'widget-form-fields-text-domain' ),
          'default' => 'square',
          'options' => array(
            'square' => __( 'Square', 'widget-form-fields-text-domain' ),
            'rounded' => __( 'Rounded', 'widget-form-fields-text-domain' ),
          )
        ),
        // MAKE ENTIRE CARD A LINK
        'uu_card_entire_card_link_bool' => array( 
          'type' => 'checkbox',
          'label' => __( 'Make entire card clickable. Note: Using this feature removes buttons from individual cards.', 'widget-form-fields-text-domain' ),
          'default' => false
        ),
        // ICON SIZE
        'uu_icon_padding' => array(
            'type' => 'slider',
            'label' => __( 'Add padding to icons.', 'widget-form-fields-text-domain' ),
            'default' => 0,
            'min' => 0,
            'max' => 100,
            'step' => 5,
            'integer' => true
        ),
        // CARD GAP
        'uu_card_gap' => array(
          'type' => 'slider',
          'label' => __( 'Spacing between cards', 'widget-form-fields-text-domain' ),
          'default' => 20,
          'min' => 10,
          'max' => 40,
          'step' => 5,
          'integer' => true
        ),////
        // CARD REPEATER
        'uu_card_repeater' => array(
          'type' => 'repeater',
          'label' => __( 'Cards' , 'widget-form-fields-text-domain' ),
          'item_name'  => __( 'Card', 'siteorigin-widgets' ),
          'item_label' => array(
            'selector'     => "[id*='uu_card_title']",
            'update_event' => 'change',
            'value_method' => 'val'
          ),
          'fields' => array(
            // CARD IMAGE
            'uu_card_image' => array(
              'type' => 'media',
              'label' => __( 'Choose an Image', 'widget-form-fields-text-domain' ),
              'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
              'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
              'library' => 'image',
              'fallback' => true
            ),
            // IS ICON
            'uu_card_is_icon' => array( 
              'type' => 'checkbox',
              'label' => __( 'Image is an Icon', 'widget-form-fields-text-domain' ),
              'default' => false
            ),
            // CARD TITLE
            'uu_card_title' => array(
              'type' => 'text',
              'label' => __('Card Title', 'widget-form-fields-text-domain'),
              'default' => ''
            ),
            // CARD TITLE COLOR
            'uu_card_title_color' => array(
              'type' => 'select',
              'label' => __( 'Title Color', 'widget-form-fields-text-domain' ),
              'default' => 'black',
              'options' => array(
                'red' => __( 'Red', 'widget-form-fields-text-domain' ),
                'black' => __( 'Black', 'widget-form-fields-text-domain' ),
              )
            ),
            // CARD COPY
            'uu_card_content' => array(
              'type' => 'textarea',
              'label' => __( 'Card Copy', 'widget-form-fields-text-domain' ),
              'default' => '',
              'rows' => 5
            ),
            // CARD BUTTON TITLE
            'uu_card_btn_title' => array(
              'type' => 'text',
              'label' => __('Button Title', 'widget-form-fields-text-domain'),
              'default' => ''
            ),
            // CARD BUTTON URL
            'uu_card_btn_url' => array(
              'type' => 'link',
              'label' => __('Button URL', 'widget-form-fields-text-domain'),
              'default' => '',
              'sanitize' => 'url'
            ),
            // CARD BUTTON NEW TAB
            'uu_card_btn_url_new_tab' => array(
              'type' => 'checkbox',
              'label' => __( 'Open Link in a New Tab?', 'widget-form-fields-text-domain' ),
              'default' => false
            ),
            // CARD BUTTON COLOR
            'uu_card_btn_color' => array(
              'type' => 'select',
              'label' => __( 'Button Color', 'widget-form-fields-text-domain' ),
              'default' => 'red',
              'options' => array(
                'red' => __( 'Red', 'widget-form-fields-text-domain' ),
                'black' => __( 'Black', 'widget-form-fields-text-domain' ),
                'gray' => __( 'Gray', 'widget-form-fields-text-domain' ),
              )
            ),
            // CARD ALIGNMENT
            'uu_card_alignment' => array(
              'type' => 'select',
              'label' => __( 'Title, Copy & Button Alignment', 'widget-form-fields-text-domain' ),
              'default' => 'left',
              'options' => array(
                'left' => __( 'Left', 'widget-form-fields-text-domain' ),
                'center' => __( 'Center', 'widget-form-fields-text-domain' ),
                'right' => __( 'Right', 'widget-form-fields-text-domain' ),
              )
            ),
          )
        )
        
			),
      // BASE FOLDER PATH
			plugin_dir_path(__FILE__)
		);

	}

  // GET TEMPLATE NAME
  function get_template_name($instance) {
      return 'uu-card-widget';
  }



  // INIT SCRIPTS & STYLES
  function initialize() {
    $this->register_frontend_scripts(
      array(
        array(
          'uu-card-widget-scripts',
        	plugin_dir_url(__FILE__) . '/js/uu-card-widget.js',
        	array( 'jquery' ),
        	 time(),
        	 true
        )
      )
    );
		$this->register_frontend_styles(
			array(
				array(
					'uu-card-widget-styles',
					plugin_dir_url(__FILE__) . '/css/uu-card-widget.css',
					array(),
					time()
				),
			)
		);
	}
}

siteorigin_widget_register('uu-card-widget', __FILE__, 'UU_Card_Widget');
