<?php
global $block_class;

$callout_id = get_sub_field( 'callout', null, false );

$type = get_field( 'type', $callout_id );
$icon = get_field( 'icon', $callout_id );
$color = get_field( 'color', $callout_id );
$label = get_field( 'label', $callout_id );
$title = get_field( 'title', $callout_id );
$blurb = get_field( 'blurb', $callout_id );
$link = get_field( 'link', $callout_id );

if ( ! empty( $type ) ) :
?>
<?php if ( $type == 'text' ) : ?>
<div class="text_callout theme_<?php echo $color; ?> <?php echo $block_class; ?>">
  <span class="text_callout_label"><?php echo $label; ?></span>
  <h3 class="text_callout_title"><?php echo $title; ?></h3>
  <p class="text_callout_content"><?php echo $blurb; ?></p>
  <?php if ( ! empty( $link ) ) : ?>
  <a href="<?php echo $link['url']; ?>" class="text_callout_link"><?php echo $link['title']; ?></a>
  <?php endif; ?>
</div>
<?php elseif ( $type == 'icon' ) : ?>
<div class="icon_callout <?php echo $block_class; ?>">
  <span class="icon_callout_label"><?php echo $label; ?></span>
  <div class="icon_callout_icon">
    <span class="icon large_<?php echo $icon; ?>"></span>
  </div>
  <div class="icon_callout_container">
    <h3 class="icon_callout_title"><?php echo $title; ?></h3>
    <p class="icon_callout_content"><?php echo $blurb; ?></p>
    <?php if ( ! empty( $link ) ) : ?>
    <a href="<?php echo $link['url']; ?>" class="icon_callout_link">
      <?php echo $link['title']; ?>
      <span class="icon icon_arrow_right"></span>
    </a>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>
<?php
endif;
