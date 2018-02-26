<?php

get_header();

?>
<?php get_template_part( 'layouts/page_header', 'cpt' ); ?>
<div class="page_main">
  <div class="fs-row">
    <div class="fs-cell fs-lg-4 page_sidebar_container">
      <?php get_template_part( 'layouts/sidebar', 'top' ); ?>
    </div>
    <div class="fs-cell fs-lg-8">
      <?php get_template_part( 'layouts/team_grid' ); ?>
    </div>
    <div class="fs-cell fs-lg-4 fs-all-justify-end page_sidebar_container">
      <?php get_template_part( 'layouts/sidebar', 'bottom' ); ?>
    </div>
  </div>
</div>
<?php

get_footer();
