<?php
$cpt = catch_get_cpt();
$bcn_options = get_option( 'bcn_options' );

$page_id = $bcn_options['apost_' . $cpt . '_root'];

$page_title = get_field( 'page_title', $page_id );
$page_subtitle = get_field( 'page_subtitle', $page_id );
$page_intro = get_field( 'page_intro', $page_id );
$page_type = get_field( 'page_type', $page_id );
$page_image = get_field( 'page_image', $page_id );
$page_icon = get_field( 'page_icon', $page_id );

if ( empty( $page_title ) ) {
  $page_title = get_the_title( $page_id );
}

catch_template_part( 'layouts/partial-page_header', array(
  'page_title' => $page_title,
  'page_subtitle' => $page_subtitle,
  'page_intro' => $page_intro,
  'page_type' => $page_type,
  'page_image' => $page_image,
  'page_icon' => $page_icon,
) );

/*
?>
<div class="page_header">
  <div class="fs-row page_header_row">
    <div class="fs-cell fs-lg-9 fs-xl-8">
      <?php if ( empty( $page_image ) ) : ?>
      <?php get_template_part( 'layouts/breadcrumb' ); ?>
      <?php endif; ?>
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
<?php
*/
