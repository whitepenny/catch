<?php
$cpt = catch_get_cpt();

if ( ! empty( $cpt ) && is_post_type_archive( $cpt ) ) {
  $bcn_options = get_option( 'bcn_options' );

  $page_id = $bcn_options['apost_' . $cpt . '_root'];
  $page_image = get_field( 'page_image', $page_id );
} else {
  $page_image = get_field( 'page_image' );
}

$class = ( ! empty( $page_image ) && $cpt !== 'story' ) ? ' has_header_image' : '';
?>
<div class="page_sidebar page_sidebar_top <?php echo $class; ?>">
  <?php get_template_part( 'layouts/subnav' ); ?>
  <div class="js-sidebar_top"></div>
</div>
