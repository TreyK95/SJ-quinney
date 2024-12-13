<?php
$title_tag = !empty($instance['title_tag']) ? $instance['title_tag'] : 'h1';
$title = !empty($instance['title']) ? $instance['title'] : '';
$title_color = !empty($instance['title_color']) ? $instance['title_color'] : 'black';
$paragraph = !empty($instance['paragraph']) ? $instance['paragraph'] : '';
$paragraph_color = !empty($instance['paragraph_color']) ? $instance['paragraph_color'] : 'black';
$hero_image_url = !empty($instance['hero_image']) ? wp_get_attachment_url($instance['hero_image']) : '';
$overlay_image_url = !empty($instance['overlay_image']) ? wp_get_attachment_url($instance['overlay_image']) : '';
$arrow_icon_url = !empty($instance['arrow_icon']) ? wp_get_attachment_url($instance['arrow_icon']) : '';
$arrow_link = !empty($instance['arrow_link']) ? $instance['arrow_link'] : '';
$overlay_position = !empty($instance['overlay_position']) ? $instance['overlay_position'] : 'center center'; // Default to center center
?>

<div class="honors-hero-widget">
    <div class="hero-image" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');">

    </div>

    <div class="red-box" style="background-image: url('<?php echo esc_url($overlay_image_url); ?>'); background-position: <?php echo esc_attr($overlay_position); ?>;">
        <<?php echo esc_attr($title_tag); ?> class="hero-title" style="color: <?php echo esc_attr($title_color); ?>;">
        <?php echo esc_html($title); ?>
    </<?php echo esc_attr($title_tag); ?>>

    <?php if (!empty($instance['subtitle'])) : ?>
        <div class="hero-subtitle"><?php echo esc_html($instance['subtitle']); ?></div>
    <?php endif; ?>

    <p class="hero-paragraph" style="color: <?php echo esc_attr($paragraph_color); ?>;">
        <?php echo esc_html($paragraph); ?>
    </p>

    <?php if ($arrow_icon_url) : ?>
        <div class="arrow-icon">
            <?php if ($arrow_link) : ?>
                <a href="<?php echo esc_url($arrow_link); ?>" rel="noopener">
                    <img src="<?php echo esc_url($arrow_icon_url); ?>" alt="Arrow Icon">
                </a>
            <?php else : ?>
                <img src="<?php echo esc_url($arrow_icon_url); ?>" alt="Arrow Icon">
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
</div>
