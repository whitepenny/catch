<?php
global $block_class;

$icon = get_sub_field( 'icon' );
$content = get_sub_field( 'content' );
?>
<div class="icon_break bg_gray <?php echo $block_class; ?>">
  <div class="fs-row fs-all-justify-center fs-all-align-center">
    <div class="fs-cell fs-md-2 fs-lg-3 icon_break_icon">
      <span class="icon large_<?php echo $icon; ?>"></span>
    </div>
    <div class="fs-cell fs-md-4 fs-lg-9 fs-xl-8 icon_break_container">
      <p class="icon_break_content"><?php echo catch_format_content( $content ); ?></p>
    </div>
  </div>
</div>
