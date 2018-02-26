<?php

get_header();

?>
<?php get_template_part( 'layouts/page_header' ); ?>
<div class="page_main">
  <div class="fs-row">
    <div class="fs-cell">
      <?php get_template_part( 'layouts/post_grid' ); ?>
    </div>
  </div>
</div>
<?php

get_footer();
