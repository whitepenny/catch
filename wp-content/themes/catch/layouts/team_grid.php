<?php

$args = array(
  'post_type' => 'team',
  'numberposts' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC',
);

if ( is_tax( 'team_type' ) ) {
  $term = get_query_var( 'team_type' );

  if ( ! empty( $term ) ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'team_type',
        'field' => 'slug',
        'terms' => $term,
      )
    );
  }
}

$items = get_posts( $args );

if ( ! empty( $items ) ) :
?>
<div class="fs-row team_grid">
  <?php
    foreach ( $items as $post ) :
      setup_postdata($post);
      // the_post();
      get_template_part( 'layouts/team_item' );
    endforeach;
    wp_reset_postdata();
  ?>
</div>
<?php
else:
?>
<p>Sorry, no team members found.</p>
<?php
endif;
