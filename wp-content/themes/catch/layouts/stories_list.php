<?php
global $block_class;

if ( empty( $block_class ) ) {
  $block_class = 'js-stories_list';
}

$items = get_posts( array(
  'post_type' => 'story',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'asc',
) );

if ( ! empty( $items ) ) :
?>
<div class="stories_list bg_white <?php echo $block_class; ?>">
  <div class="fs-row">
    <div class="fs-cell">
      <?php
        foreach ( $items as $item ) :
          $link = get_the_permalink( $item->ID );
          $title = get_field( 'page_title', $item->ID );
          $color = get_field( 'grid_color', $item->ID );
          $image = get_field( 'page_image', $item->ID );
          $blurb = get_field( 'grid_blurb', $item->ID );

          if ( empty( $title ) ) {
            $title = get_the_title( $item->ID );
          }
      ?>
      <div class="stories_list_item theme_<?php echo $color; ?>">
        <a href="<?php echo $link; ?>" class="stories_list_link">
          <?php catch_responsive_image( catch_image_stories_list( $image['id'] ), 'stories_list_image' ); ?>
          <div class="stories_list_content">
            <h3 class="stories_list_title"><?php echo $title; ?></h3>
            <span class="stories_list_label"><?php echo $blurb; ?></span>
            <?php if ( $color == 'white' ) : ?>
            <span class="icon circle_yellow_arrow_right"></span>
            <?php else : ?>
            <span class="icon circle_white_arrow_right"></span>
            <?php endif; ?>
          </div>
        </a>
      </div>
      <?php
        endforeach;
      ?>
    </div>
  </div>
</div>
<?php
endif;
