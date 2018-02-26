<?php

if ( is_home() ) {
  $page_id = get_option( 'page_for_posts' );
  $page_title = get_field( 'page_title', $page_id );
  $page_subtitle = '';
  $page_intro = get_field( 'page_intro', $page_id );
  $page_type = '';
  $page_image = '';
  $page_icon = '';
} else {
  $page_title = get_field( 'page_title' );
  $page_subtitle = get_field( 'page_subtitle' );
  $page_intro = get_field( 'page_intro' );
  $page_type = get_field( 'page_type' );
  $page_image = get_field( 'page_image' );
  $page_icon = get_field( 'page_icon' );

  if ( empty( $page_title ) && ! is_home() ) {
    $page_title = get_the_title();
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
