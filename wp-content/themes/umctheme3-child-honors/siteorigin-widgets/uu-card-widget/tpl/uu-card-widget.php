<?php 

// VARS
$uu_card_layout = $instance['uu_card_layout'] ?: 'vert-img-top';
$uu_card_per_row = $instance['uu_card_per_row'] ?: '3col';
$uu_is_card_clickable = $instance['uu_card_entire_card_link_bool'] ?: false;
$uu_icon_padding = $instance['uu_icon_padding'] ?: 0;
$uu_card_gap = $instance['uu_card_gap'] ?: 20;
$uu_card_border_radius = $instance['uu_card_border_radius'] ?: 'square';
if ( $uu_card_border_radius == 'rounded' ) {
  $border_radius_class = ' rounded-corners ';
}else{
  $border_radius_class = '';
}
$uu_cards = $instance['uu_card_repeater'];
$count = 1;

?>

<div id="uu-card-widget-container" 
  class="<?php if ( !empty($uu_card_per_row) ) { echo 'uu-card-widget-container-' . $uu_card_per_row; } ?> 
  <?php if ( !empty($uu_card_layout) ) { echo 'uu-card-widget-layout-' . $uu_card_layout; } ?>"
  style="<?php if ( !empty($uu_card_gap) ) { echo 'gap:' . $uu_card_gap . 'px;'; } ?>"
>

<?php if ( !empty($uu_cards) ) : ?>
  <?php foreach ($uu_cards as $card) : ?>
  <?php
    $card_img_id = intval($card['uu_card_image']); 
    if ( $card_img_id ) {
        $size = 'large'; // Specify the size, e.g., 'thumbnail', 'medium', 'large', or a custom size
        $image = wp_get_attachment_image_src( $card_img_id, $size );

        if ( $image ) {
            $image_url = $image[0]; // URL of the image
            $image_width = $image[1]; // Width of the image
            $image_height = $image[2]; // Height of the image
        }

        $card_img_url = isset($image_url) ? $image_url : ''; 
    }

    $card_is_icon =     wp_kses_post($card['uu_card_is_icon']);
    $card_title =       wp_kses_post($card['uu_card_title']);
    $card_title_color = wp_kses_post($card['uu_card_title_color']);
    $card_copy =        wp_kses_post($card['uu_card_content']);
    $card_btn_title =   wp_kses_post($card['uu_card_btn_title']);
    $card_btn_url =     wp_kses_post($card['uu_card_btn_url']);
    $card_btn_new_tab = wp_kses_post($card['uu_card_btn_url_new_tab']);
    $card_btn_color =   wp_kses_post($card['uu_card_btn_color']);
    $card_alignment =   wp_kses_post($card['uu_card_alignment']);

    //BUILD HTML FOR WRAPPER LINK
    if($uu_is_card_clickable) {
      if ($card_btn_new_tab == 1) {
        $card_link_open = '<a href="' . $card_btn_url . '" target="_blank">';
      } else {
        $card_link_open = '<a href="' . $card_btn_url . '">';
      }
      $card_link_close = '</a>';
    }
  ?>
  <!-- UU CARD WIDGET ITEM <?php echo $count; ?> -->
<?php 
  if($uu_is_card_clickable) echo '<a href="' . $card_btn_url . '">';
?>
  <div class="uu-card-widget-card <?php if ( !empty($card_alignment) ) { echo $card_alignment . '-align'; } echo $border_radius_class; ?>">
    <?php if ( !empty($card_img_url && $card_is_icon != true) ) : ?>
      <div class="uu-card-widget-card-img" style="background-image:url('<?php echo $card_img_url; ?>');"></div>
      <?php elseif ( $card_is_icon != false ) : ?>
        <div class="uu-card-widget-card-img-icon" style="<?php echo 'padding-left: ' . $uu_icon_padding . 'px; padding-right: ' . $uu_icon_padding . 'px;'?>">
          <img src="<?php echo $card_img_url; ?>" alt="<?php echo $card_title; ?>" >
        </div>
    <?php endif; ?>
    <div class="uu-card-widget-card-body">
      <?php if ( !empty($card_title) ) : ?>
        <div class="uu-card-widget-card-title<?php if ( !empty($card_title_color) ) { echo '-' . $card_title_color; } ?>"><?php echo $card_title; ?></div>
      <?php endif; ?>
      <?php if ( !empty($card_copy) ) : ?>
        <div class="uu-card-widget-card-copy">
          <?php echo $card_copy; ?>
        </div>
      <?php endif; ?>
      <?php if ( !empty($card_btn_title) && ($uu_is_card_clickable == 0) ) : ?>
        <a class="uu-btn small <?php if ( !empty($card_btn_color) ) { echo $card_btn_color; } ?>" href="<?php echo $card_btn_url; ?>" <?php if ( $card_btn_new_tab == 1 ) : ?><?php echo('target="_blank"'); ?><?php endif; ?>  aria-label="Link to <?php echo $card_title; ?>">
          <?php echo $card_btn_title; ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
<?php 
  if($uu_is_card_clickable) echo '</a>';
?>
  <!-- END UU CARD WIDGET ITEM <?php echo $count; ?> -->
  <?php
    ++$count;
    endforeach;
  ?>
<?php else : ?>
  <p style="text-align:center;">No Cards Found.</p>
<?php endif; ?>

</div>