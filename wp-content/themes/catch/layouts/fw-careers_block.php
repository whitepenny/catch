<?php
global $block_class;

$background = get_sub_field( 'background' );
$label = get_sub_field( 'label' );
$content = get_sub_field( 'content' );
$link = get_sub_field( 'link' );

$background_options = catch_image_background_large_callout( $background['ID'] );
?>
<div class="careers_block <?php echo $block_class; ?> js-background" data-background-options="<?php echo catch_json_options( $background_options ); ?>">
  <div class="fs-row careers_block_row">
    <div class="fs-cell fs-md-4 fs-lg-8 fs-xl-7 careers_block_cell">
      <div class="careers_block_header">
        <h2 class="careers_block_label"><?php echo $label; ?></h2>
      </div>
      <p class="careers_block_content"><?php echo catch_format_content( $content ); ?></p>
      <a href="<?php echo $link['url']; ?>" class="careers_block_button"><?php echo $link['title']; ?></a>
    </div>
    <div class="fs-cell fs-md-2 fs-lg-4 fs-all-justify-end careers_block_diagram">
      <span class="icon large_vendiagram"></span>
    </div>
  </div>
</div>
