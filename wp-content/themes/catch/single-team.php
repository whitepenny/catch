<?php
get_header();

if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();

    $email = get_field( 'bio_email' );
    $image = get_field( 'bio_image' );
?>
<?php get_template_part( 'layouts/page_header', 'team_member' ); ?>
<div class="page_main">
  <div class="fs-row">
    <div class="fs-cell fs-lg-4 page_sidebar_container">
      <?php get_template_part( 'layouts/sidebar', 'top' ); ?>
    </div>
    <div class="fs-cell fs-lg-8">
      <?php get_template_part( 'layouts/breadcrumb' ); ?>
      <div class="page_content">
        <?php catch_responsive_image( catch_image_team_bio( $image['id'] ), 'post_image' ); ?>
        <?php the_content(); ?>
        <?php if ( ! empty( $email ) ) : ?>
        <p class="bio_email">
          <span class="icon social_circle_email"></span>
          <a href="mailto:<?php echo $email; ?>" class="bio_email_text"><?php echo $email; ?></a>
        </span>
        <?php endif; ?>
      </div>
    </div>
    <div class="fs-cell fs-lg-4 fs-all-justify-end page_sidebar_container">
      <?php get_template_part( 'layouts/sidebar', 'bottom' ); ?>
    </div>
  </div>
</div>
<?php
  endwhile;
endif;

get_footer();
