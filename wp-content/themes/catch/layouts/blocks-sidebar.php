<?php
global $block_index;
global $block_class;

if ( empty ( $block_index ) ) {
  $block_index = 0;
}

if ( ! post_password_required() ) :
  if ( have_rows( 'sidebar_blocks' ) ) :
    while ( have_rows( 'sidebar_blocks' ) ) :
      the_row();

      $block_index++;
      $block_class = 'js-block_' . $block_index;

      get_template_part( 'layouts/sb', get_row_layout() );
    endwhile;
  endif;
endif;
