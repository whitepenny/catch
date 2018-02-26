<?php
global $block_class;

if ( empty( $block_class ) ) {
  $block_class = 'services_slim js-service_grid';
}

$items = get_posts( array(
  'post_type' => 'page',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'asc',
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key' => '_wp_page_template',
      'value' => 'page-service.php',
    ),
    array(
      'key' => 'featured',
      'value' => 1,
    )
  )
) );

if ( ! empty( $items ) ) :
?>
<div class="services_grid bg_white <?php echo $block_class; ?>">
  <div class="fs-row">
    <?php
      foreach ( $items as $item ) :
        $link = get_the_permalink( $item->ID );
        $title = get_field( 'page_title', $item->ID );
        $color = get_field( 'grid_color', $item->ID );
        $image = get_field( 'grid_image', $item->ID );
        $blurb = get_field( 'grid_blurb', $item->ID );

        if ( empty( $title ) ) {
          $title = get_the_title( $item->ID );
        }
    ?>
    <div class="fs-cell fs-md-half fs-lg-half">
      <a href="<?php echo $link; ?>" class="services_grid_item theme_<?php echo $color; ?>">
        <?php catch_responsive_image( catch_image_services_grid( $image['id'] ), 'services_grid_image' ); ?>
        <div class="services_grid_content">
          <h3 class="services_grid_title"><?php echo $title; ?></h3>
          <span class="services_grid_label"><?php echo $blurb; ?></span>
          <span class="icon circle_white_arrow_right"></span>
        </div>
      </a>
    </div>
    <?php
      endforeach;
    ?>
  </div>
</div>
<?php
endif;
