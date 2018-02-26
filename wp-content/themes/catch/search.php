<?php
/*
$query = ( isset( $_GET['s'] ) ) ? $_GET['s'] : '';
$type = ( isset( $_GET['type'] ) ) ? $_GET['type'] : 'site';

get_header();

get_template_part( 'layouts/page_header', 'search' );

?>
<div class="filter_block" id="filter">
  <div class="filter_block_search">
    <div class="fs-row fs-all-justify-center">
      <div class="fs-cell fs-lg-10">
        <form action="<?php echo $catch_page_url; ?>#filter">
          <input type="text" name="s" class="filter_block_input" value="<?php echo $query; ?>" placeholder="Search...">
          <?php if ( $type == 'blog' ) : ?>
          <input type="hidden" name="type" value="blog">
          <?php endif; ?>
          <button type="submit" class="filter_block_button">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="page_container">
  <div class="fs-row fs-all-justify-center">
    <div class="fs-cell fs-lg-9 page_main">
      <?php get_template_part( 'layouts/post_list' ); ?>
    </div>
    <!-- <div class="fs-cell fs-lg-3 page_sidebar">
      <?php if ( $type == 'blog' ) : ?>
      <?php get_template_part( 'layouts/sidebar', 'post' ); ?>
      <?php endif; ?>
    </div> -->
  </div>
</div>
<?php

get_footer();
*/
