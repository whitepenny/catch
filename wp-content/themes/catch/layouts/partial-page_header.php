<?php
if ( ! empty( $page_image ) /* $page_type == 'image' */ ) :
  $background_options = catch_image_background_page_header( $page_image['ID'] );
?>
<div class="page_header image_header js-background" data-background-options="<?php echo catch_json_options( $background_options ); ?>">
<?php
elseif ( ! empty( $page_icon ) /* $page_type == 'icon' */ ) :
?>
<div class="page_header icon_header">
<?php
else :
?>
<div class="page_header">
<?php
endif;
?>
  <div class="fs-row page_header_row">
    <?php if ( empty( $page_image ) ) : ?>
    <div class="fs-cell">
      <?php get_template_part( 'layouts/breadcrumb' ); ?>
    </div>
    <?php endif; ?>
    <div class="fs-cell fs-md-4 fs-lg-8 page_header_cell">
      <?php if(! empty ($page_title)): ?>
      <h1 class="page_title">
        <?php echo catch_format_content( $page_title ); ?>
      </h1>
      <?php else: ?>
      <h1 class="page_title">
        Sorry
      </h1>
      <?php endif; ?>
      <?php if ( ! empty( $page_subtitle ) ) : ?>
      <span class="page_subtitle"><?php echo $page_subtitle; ?></span>
      <?php endif; ?>
      <?php if ( ! empty( $page_intro ) ) : ?>
      <div class="page_content page_intro">
        <p><?php echo $page_intro; ?></p>
      </div>
      <?php endif; ?>
    </div>
    <?php if ( ! empty( $page_icon ) ) : ?>
    <div class="fs-cell fs-md-2 fs-lg-4 page_icon">
      <span class="icon large_<?php echo $page_icon; ?>"></span>
    </div>
    <?php endif; ?>
  </div>
</div>
