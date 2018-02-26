<?php
if ( ! empty( $form ) && function_exists( 'gravity_form' ) ) :
?>
<div class="gravityform_block">
  <?php if ( ! empty( $title ) || ! empty( $content ) ) : ?>
  <div class="gravityform_block_header">
    <?php if ( ! empty( $title ) ) : ?>
    <h2 class="gravityform_block_title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <?php if ( ! empty( $content ) ) : ?>
    <div class="gravityform_block_content">
      <?php echo $content; ?>
    </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>
  <div class="gravityform_block_container gravityform_container">
    <?php gravity_form( $form, false, false ); ?>
  </div>
</div>
<?php
endif;
