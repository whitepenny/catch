<?php
$page_id = get_option( 'page_for_posts' );
$related = new WP_Query( array(
  'posts_per_page' => 3,
) );

if ( $related->have_posts() ) :
?>
<div class="related_posts">
  <div class="fs-row post_grid theme_white">
    <?php
      while ( $related->have_posts() ) :
        $related->the_post();
        get_template_part( 'layouts/post_item', 'slim' );
      endwhile;
    ?>
    <div class="fs-cell related_posts_footer">
      <a href="<?php echo get_permalink( $page_id ); ?>" class="related_posts_button">See All News</a>
    </div>
  </div>
</div>
<?php
endif;

wp_reset_query();
