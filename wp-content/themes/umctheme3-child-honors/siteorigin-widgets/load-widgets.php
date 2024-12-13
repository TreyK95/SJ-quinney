<?php
function load_custom_siteorigin_widgets() {
    if ( class_exists( 'SiteOrigin_Widget' ) ) {
        // Load each widget file explicitly
        include_once get_stylesheet_directory() . '/siteorigin-widgets/custom-widget/uu-custom-widget.php';
        include_once get_stylesheet_directory() . '/siteorigin-widgets/honors-hero-widget/uu-honors-hero-widget.php';
        // Register the widgets using the exact class names

        if (class_exists('Custom_Widget')) {
            register_widget('Custom_Widget');
        }
        if (class_exists('Honors_Hero_Widget')) {
            register_widget('Honors_Hero_Widget');
        }

    } 
}
add_action('init', 'load_custom_siteorigin_widgets');