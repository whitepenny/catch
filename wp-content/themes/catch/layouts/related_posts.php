<?php
$post_id = get_the_ID();
$related = new WP_Query( array(
  'posts_per_page' => 3,
  'post__not_in' => array( $post_id ),
) );

if ( $related->have_posts() ) :
?>
<div class="related_posts">
  <div class="fs-row post_grid theme_white">
    <div class="fs-cell related_posts_header">
      <h2 class="related_posts_label">Recent News</h2>
    </div>
    <?php
      while ( $related->have_posts() ) :
        $related->the_post();
        get_template_part( 'layouts/post_item', 'slim' );
      endwhile;
    ?>
  </div>
</div>
<?php
endif;

wp_reset_query();
