<?php
require_once get_stylesheet_directory() . '/newell-lectures-shortcode.php';

// Enqueue styles and scripts
add_action('wp_enqueue_scripts', 'umctheme3_enqueue_styles');
function umctheme3_enqueue_styles() {
	wp_enqueue_style('uu-umctheme3-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('uu-umctheme3-custom-style', get_stylesheet_directory_uri() . '/css/custom.css', array(), time(), 'all');
	wp_enqueue_style('newell-lectures-shortcode-style', get_stylesheet_directory_uri() . '/css/newell-lectures-shortcode.css', array(), time(), 'all');
	wp_enqueue_script('gsap-script', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js', array(), null, true);
	wp_enqueue_script('scroll-trigger-script', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js', array(), null, true);
	wp_enqueue_script('scroll-to-script', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollToPlugin.min.js', array(), null, true);
	wp_enqueue_script('uu-umctheme3-custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), time(), true);
}

// Allow SVG uploads
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

// Customize excerpt length
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);
function wpdocs_custom_excerpt_length($length) {
	return 20;
}

// Register meta boxes for Praxis Labs
add_filter('rwmb_meta_boxes', 'honors_register_meta_boxes');
function honors_register_meta_boxes($meta_boxes) {
	$meta_boxes[] = array(
		'post_types' => array('post', 'page'),
		'title' => __('Praxis Lab Fields', 'praxis'),
		'fields' => array(
			array(
				'name' => __('Summary', 'praxis'),
				'id' => 'summary_praxislab',
				'type' => 'wysiwyg',
				'label_description' => 'This will be displayed in the lightbox',
			),
			array(
				'name' => 'Full Report Link',
				'id' => 'file_report',
				'type' => 'file_input',
				'label_description' => 'Link to Full Report',
				'max_file_uploads' => 1,
			),
		),
	);
	return $meta_boxes;
}

// Enqueue Newell Lecture scripts
add_action('wp_enqueue_scripts', 'enqueue_newell_lecture_scripts');
function enqueue_newell_lecture_scripts() {
	wp_enqueue_script('newell-lecture-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}

// Include SiteOrigin widgets
require_once get_stylesheet_directory() . '/siteorigin-widgets/load-widgets.php';

// Register Newell Lecture Custom Post Type

?>
