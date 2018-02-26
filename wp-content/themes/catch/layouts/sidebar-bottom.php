<?php
if ( have_rows( 'sidebar_blocks' ) ) :
?>
<div class="page_sidebar page_sidebar_bottom">
  <div class="js-sidebar_bottom">
    <?php get_template_part( 'layouts/blocks', 'sidebar' ); ?>
  </div>
</div>
<?php
endif;
