<?php
$name = get_the_title( $page_id );
$position = get_field( 'bio_position' );

catch_template_part( 'layouts/partial-page_header', array(
  'page_title' => $name,
  'page_subtitle' => $position,
) );
