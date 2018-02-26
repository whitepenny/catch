<?php
$name = get_the_title( $page_id );
$position = get_field( 'bio_position' );

catch_template_part( 'layouts/partial-page_header', array(
  'page_title' => $name,
  'page_subtitle' => $position,
  // 'page_intro' => $page_intro,
  // 'page_type' => $page_type,
  // 'page_image' => $page_image,
  // 'page_icon' => $page_icon,
) );

/*
?>
<div class="page_header">
  <div class="fs-row page_header_row">
    <div class="fs-cell fs-lg-9 fs-xl-8">
      <?php get_template_part( 'layouts/breadcrumb' ); ?>
      <h1 class="page_title">
        <?php echo $name; ?>
      </h1>
      <span class="page_subtitle"><?php echo $position; ?></span>
    </div>
  </div>
</div>
<?php
*/
