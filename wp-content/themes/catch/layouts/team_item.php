<?php
$post_image = get_field( 'post_image' );
$position = get_field( 'bio_position' );
$image = get_field( 'bio_image' );
?>
<div class="team_item fs-cell fs-xs-full fs-sm-half fs-md-half fs-lg-half">
  <a href="<?php the_permalink(); ?>" class="team_item_link">
    <div class="team_item_image">
      <?php catch_responsive_image( catch_image_team_grid( $image['ID'] ), '' ); ?>
      <span class="team_item_overlay"></span>
    </div>
    <div class="team_item_content">
      <h2 class="team_item_name"><?php the_title(); ?></h2>
      <span class="team_item_position"><?php echo $position; ?></span>
    </div>
  </a>
</div>
