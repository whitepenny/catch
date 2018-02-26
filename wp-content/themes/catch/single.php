<?php
get_header();

if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();

    $post_image = get_field( 'post_image' );
?>
<?php get_template_part( 'layouts/page_header' ); ?>
<div class="page_main">
  <div class="fs-row fs-all-justify-center">
    <div class="fs-cell fs-xl-10 post_detail">
      <?php catch_responsive_image( catch_image_post_detail( $post_image['id'] ), 'post_image' ); ?>
      <div class="fs-row">
        <div class="fs-cell fs-lg-3">
          <span class="post_date">
            <span><?php the_date( 'n.j.y' ); ?></span>
          </span>
          <div class="post_social addthis_toolbox">
            <a class="post_social_link addthis_button_facebook">
              <span class="icon social_circle_facebook"></span>
              <span class="screenreader">Share on Facebook</span>
            </a>
            <a class="post_social_link addthis_button_twitter">
              <span class="icon social_circle_twitter"></span>
              <span class="screenreader">Share on Twitter</span>
            </a>
            <a class="post_social_link addthis_button_linkedin">
              <span class="icon social_circle_linkedin"></span>
              <span class="screenreader">Share on LinkedIn</span>
            </a>
            <a class="post_social_link addthis_button_email">
              <span class="icon social_circle_email"></span>
              <span class="screenreader">Share via Email</span>
            </a>
          </div>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid="></script>
        </div>
        <div class="fs-cell fs-lg-8 fs-all-justify-end">
          <div class="page_content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_template_part( 'layouts/related_posts' ); ?>
<?php
  endwhile;
endif;

get_footer();
