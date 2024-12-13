<?php
function newell_lectures_shortcode($atts) {
    // Enqueue styles and scripts
    wp_enqueue_style('newell-lectures-style', get_stylesheet_directory_uri() . '/assets/css/custom.css');
    wp_enqueue_script('newell-lectures-script', get_stylesheet_directory_uri() . '/assets/js/newell-lectures.js', array('jquery'), '1.0', true);


    ob_start();
    ?>
    <div class="lectures-container">
        <div class="lectures-filters">
            <h3>Search</h3>
            <?php echo do_shortcode('[facetwp facet="search"]'); ?>

            <h3>Lecturer Department</h3>
            <?php echo do_shortcode('[facetwp facet="lecturer_department"]'); ?>

            <h3>Lecture Date</h3>
            <?php echo do_shortcode('[facetwp facet="lecture_date"]'); ?>

            <button id="filter-button" class="filter-button">FILTER</button>

        </div>

        <div class="lectures-content">
            <div class="lectures-list facetwp-template">
                <?php
                $paged = get_query_var('paged', 1); // Get the current page number
                $args = array(
                    'post_type' => 'newell-lecture',
                    'posts_per_page' => 6, // Limit to 6 lectures per page
                    'paged' => $paged, // Current page
                    'orderby' => 'meta_value',
                    'meta_key' => 'lecture_year',
                    'order' => 'DESC',
                    'facetwp' => true // Enable FacetWP integration
                );

                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $lecture_year = get_post_meta(get_the_ID(), 'lecture_year', true);
                        $first_name = get_post_meta(get_the_ID(), 'lecturer_first_name', true);
                        $last_name = get_post_meta(get_the_ID(), 'lecturer_last_name', true);
                        $abstract = get_post_meta(get_the_ID(), 'abstract', true);
                        $short_description = get_post_meta(get_the_ID(), 'lecture_short_description', true);
                        $youtube_link = get_post_meta(get_the_ID(), 'lecture_youtube_link', true);
                        ?>
                        <div class="lecture-entry">
                            <div class="lecture-header">
                                <div class="lecture-image">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/placeholder.png'); ?>" alt="Placeholder">
                                    <?php endif; ?>
                                </div>
                                <div class="lecture-info">
                                    <div>
                                        <span class="year-label"><?php echo esc_html($lecture_year); ?>:</span>
                                        <h3><?php echo esc_html($first_name . ' ' . $last_name); ?></h3>
                                    </div>
                                    <div class="abstract"><?php echo wp_kses_post($abstract); ?></div>
                                </div>
                                <button class="expand-button" aria-label="Toggle details">⌄</button>
                            </div>
                            <div class="lecture-details">
                                <div class="description"><?php echo wp_kses_post($short_description); ?></div>
                                <?php if ($youtube_link): ?>
                                    <a href="<?php echo esc_url($youtube_link); ?>" class="uu-btn" target="_blank">
                                        LECTURE RECORDING
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p>No lectures found.</p>';
                endif;
                ?>
            </div>


            <?php echo do_shortcode('[facetwp facet="pager"]'); ?>


            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'format' => '?paged=%#%',
                    'prev_text' => __('&laquo; Previous'),
                    'next_text' => __('Next &raquo;'),
                ));
                ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// Register the shortcode
add_action('init', function() {
    add_shortcode('newell_lectures', 'newell_lectures_shortcode');
});
