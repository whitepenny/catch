<?php
global $block_class;

if ( empty( $block_class ) ) {
  $block_class = 'js-programs_list';
}

$page_id = get_the_ID();
$items = get_posts( array(
  'post_type' => 'page',
  'posts_per_page' => -1,
  'post_parent' => $page_id,
  'orderby' => 'menu_order',
  'order' => 'asc',
) );

if ( ! empty( $items ) ) :
?>
<div class="programs_list <?php echo $block_class; ?>">
  <?php
    foreach ( $items as $item ) :
      $link = get_the_permalink( $item->ID );
      $title = get_field( 'page_title', $item->ID );
      $intro = get_field( 'page_intro', $item->ID );

      if ( empty( $title ) ) {
        $title = get_the_title( $item->ID );
      }
  ?>
  <div class="programs_list_item">
    <h3 class="programs_list_title"><?php echo $title; ?></h3>
    <?php if ( ! empty( $intro ) ) : ?>
    <div class="programs_list_content">
      <p><?php echo $intro; ?></p>
    </div>
    <?php endif; ?>
    <a href="<?php echo $link; ?>" class="programs_list_link">Learn More</a>
  </div>
  <?php
    endforeach;
  ?>
</div>
<?php
endif;
