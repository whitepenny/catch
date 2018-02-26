<?php

get_header();

if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();
?>
<?php get_template_part( 'layouts/page_header', 'story' ); ?>
<div class="page_main">
  <div class="fs-row">
    <div class="fs-cell fs-lg-4 page_sidebar_container">
      <?php get_template_part( 'layouts/sidebar', 'top' ); ?>
    </div>
    <div class="fs-cell fs-lg-8">
      <?php get_template_part( 'layouts/breadcrumb' ); ?>
      <div class="page_content">
        <?php the_content(); ?>
      </div>
    </div>
    <div class="fs-cell fs-lg-4 fs-all-justify-end page_sidebar_container">
      <?php get_template_part( 'layouts/sidebar', 'bottom' ); ?>
    </div>
  </div>
</div>
<?php
  endwhile;
endif;

get_footer();
