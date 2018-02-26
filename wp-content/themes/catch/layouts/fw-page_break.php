<?php
global $block_class;

$content = get_sub_field( 'content' );
?>
<div class="page_break bg_white <?php echo $block_class; ?>">
  <div class="fs-row fs-all-justify-center">
    <div class="fs-cell fs-lg-10 fs-xl-8">
      <p class="page_break_content"><?php echo catch_format_content( $content ); ?></p>
    </div>
  </div>
</div>
