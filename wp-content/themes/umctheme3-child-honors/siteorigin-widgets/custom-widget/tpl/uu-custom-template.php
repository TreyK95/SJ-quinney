<?php
// Fetch widget instance variables
$uu_card_layout = $instance['uu_card_layout'] ?: 'vert-img-top';
$uu_card_per_row = $instance['uu_card_per_row'] ?: '3col';
$uu_is_card_clickable = $instance['uu_card_entire_card_link_bool'] ?: false;
$uu_card_gap = $instance['uu_card_gap'] ?: 20;
$uu_card_border_radius = $instance['uu_card_border_radius'] ?: 'square';
$border_radius_class = ($uu_card_border_radius === 'rounded') ? ' rounded-corners ' : '';
$uu_cards = $instance['uu_card_repeater'] ?: [];
?>

<div id="custom-widget-container"
     class="custom-widget-container <?php echo esc_attr("custom-layout-{$uu_card_layout} custom-per-row-{$uu_card_per_row} {$border_radius_class}"); ?>"
     style="<?php echo 'gap:' . intval($uu_card_gap) . 'px;'; ?>">

    <?php if (!empty($uu_cards)) : ?>
        <?php foreach ($uu_cards as $card) : ?>
            <?php
            // Extract card data
            $card_img_id = intval($card['uu_card_image']);
            $card_img_url = $card_img_id ? wp_get_attachment_url($card_img_id) : '';
            $card_name = !empty($card['uu_card_name']) ? esc_html($card['uu_card_name']) : '';
            $card_title = !empty($card['uu_card_title']) ? esc_html($card['uu_card_title']) : '';
            $card_btn1_title = !empty($card['uu_card_btn1_title']) ? esc_html($card['uu_card_btn1_title']) : '';
            $card_btn1_url = !empty($card['uu_card_btn1_url']) ? esc_url($card['uu_card_btn1_url']) : '';
            $card_btn2_title = !empty($card['uu_card_btn2_title']) ? esc_html($card['uu_card_btn2_title']) : '';
            $card_btn2_url = !empty($card['uu_card_btn2_url']) ? esc_url($card['uu_card_btn2_url']) : '';

            // Handle clickable card
            $card_link_open = $uu_is_card_clickable && $card_btn1_url
                ? '<a href="' . esc_url($card_btn1_url) . '" target="_blank">'
                : '';
            $card_link_close = $uu_is_card_clickable && $card_btn1_url ? '</a>' : '';
            ?>

            <?php echo $card_link_open; ?>
            <div class="uu-card">
                <?php if ($card_img_url) : ?>
                    <div class="uu-card-image">
                        <img src="<?php echo esc_url($card_img_url); ?>" alt="<?php echo esc_attr($card_name); ?>">
                    </div>
                <?php endif; ?>

                <div class="uu-card-body">
                    <?php if ($card_name) : ?>
                        <h3 class="uu-card-name"><?php echo $card_name; ?></h3>
                    <?php endif; ?>

                    <?php if ($card_title) : ?>
                        <p class="uu-card-title"><?php echo $card_title; ?></p>
                    <?php endif; ?>

                    <p class="uu-card-schedule-header">Schedule an Appointment</p>

                    <div class="uu-card-buttons">
                        <?php if ($card_btn1_title && $card_btn1_url) : ?>
                            <a href="<?php echo $card_btn1_url; ?>" class="uu-btn uu-btn-1" target="_blank"><?php echo $card_btn1_title; ?></a>
                        <?php endif; ?>

                        <?php if ($card_btn2_title && $card_btn2_url) : ?>
                            <a href="<?php echo $card_btn2_url; ?>" class="uu-btn uu-btn-2" target="_blank"><?php echo $card_btn2_title; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php echo $card_link_close; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No cards found.</p>
    <?php endif; ?>

</div>
