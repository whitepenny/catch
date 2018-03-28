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

// Custom team pages
if ( $cpt == 'team' && is_tax( 'team_type' ) ) {
  $term_slug = get_query_var( 'team_type' );

  if ( ! empty( $term_slug ) ) {
    $term = get_term_by( 'slug', $term_slug, 'team_type' );

    if ( ! is_wp_error( $term ) ) {
      $page_title = $term->name;
      $page_intro = '';
    }
  }
}

catch_template_part( 'layouts/partial-page_header', array(
  'page_title' => $page_title,
  'page_subtitle' => $page_subtitle,
  'page_intro' => $page_intro,
  'page_type' => $page_type,
  'page_image' => $page_image,
  'page_icon' => $page_icon,
) );
