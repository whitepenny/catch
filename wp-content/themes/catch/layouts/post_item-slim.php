<?php
$post_image = get_field( 'post_image' );
?>
<div class="post_item fs-cell fs-md-half fs-lg-third">
  <?php if ( ! empty( $post_image ) ) : ?>
  <a href="<?php the_permalink(); ?>">
    <?php catch_responsive_image( catch_image_post_grid_slim( $post_image['ID'] ), 'post_item_image' ); ?>
  </a>
  <?php endif; ?>
  <div class="post_item_container">
    <span class="post_date post_item_date">
      <span><?php the_time( 'n.j.y' ); ?></span>
    </span>
    <h2 class="post_item_title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
  </div>
</div>
