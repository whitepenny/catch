<?php
$page_title = get_field( 'page_title' );
$page_intro = get_field( 'page_intro' );
$page_image = get_field( 'page_image' );

$color = get_field( 'grid_color' );

if ( empty( $page_title ) ) {
  $page_title = get_the_title();
}

$background_options = catch_image_background_page_header( $page_image['ID'] );
?>
<div class="page_header story_header theme_<?php echo $color; ?>">
  <div class="page_header_background js-background" data-background-options="<?php echo catch_json_options( $background_options ); ?>"></div>
  <div class="fs-row fs-all-justify-end page_header_row">
    <div class="fs-cell fs-md-4 fs-lg-7 fs-xl-6 page_header_cell">
      <h1 class="page_title">
        <?php echo catch_format_content( $page_title ); ?>
      </h1>
      <?php if ( ! empty( $page_intro ) ) : ?>
      <div class="page_content page_intro">
        <p><?php echo $page_intro; ?></p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
