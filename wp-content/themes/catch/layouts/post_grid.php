<?php
if ( have_posts() ) :
?>
<div class="fs-row post_grid theme_gray">
  <?php
    while ( have_posts() ) :
      the_post();
      get_template_part( 'layouts/post_item' );
    endwhile;
  ?>
  <?php get_template_part( 'layouts/post_pagination' ); ?>
</div>
<?php
else:
?>
<p>Sorry, no posts found.</p>
<?php
endif;
