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


?>


<div class="page_header-slider owl-carousel ">
<?php $photos = get_field('photos'); ?>
<?php while(have_rows('photos')) : the_row(); ?>
  <?php $photo = get_sub_field('photo'); 
  $background_options = catch_image_background_page_header( $photo['ID'] ); ?>



<div class="page_header image_header js-background" data-background-options="<?php echo catch_json_options( $background_options ); ?>">

  <div class="fs-row page_header_row" >

    <div class="fs-cell fs-md-4 fs-lg-8 page_header_cell" >
      <h1 class="page_title">
        <?php echo catch_format_content( $page_title ); ?>
      </h1>
      
    </div>
    
    
  </div>

  
</div>
<?php endwhile; ?>
</div>


