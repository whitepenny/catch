<?php
/*
Template Name: Contact
*/

get_header();

if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();

    $phone = get_field( 'contact_phone' );
    $email = get_field( 'contact_email' );
    $address = get_field( 'contact_address' );
    $form = get_field( 'gravity_form' );
?>
<?php get_template_part( 'layouts/page_header' ); ?>
<div class="page_main">
  <div class="fs-row">
    <div class="fs-cell fs-lg-4 page_sidebar_container">
      <?php get_template_part( 'layouts/sidebar', 'top' ); ?>
    </div>
    <div class="fs-cell fs-lg-8">
      <?php get_template_part( 'layouts/breadcrumb' ); ?>
      <div class="page_content">
        <?php the_content(); ?>
      </div>
      <div class="fs-row fs-sm-align-center page_content contact_row">
        <div class="fs-cell fs-xs-full fs-sm-half fs-md-half fs-lg-half">
          <div class="responsive_image">
            <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3058.8437187212994!2d-75.16799038461836!3d39.944885279422806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c6c624ae8c7933%3A0xf90498d24217f375!2sCatch+Inc+Community+Services!5e0!3m2!1sen!2sus!4v1521550696020" width="500" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="fs-cell fs-xs-full fs-sm-half fs-md-half fs-lg-half contact_info">
          <?php if ( ! empty( $phone ) ) : ?>
          <div class="contact_item">
            <h3 class="contact_item_label">Phone:</h3>
            <p class="contact_item_content">
              <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
            </p>
          </div>
          <?php endif; ?>
          <?php if ( ! empty( $phone ) ) : ?>
          <div class="contact_item">
            <h3 class="contact_item_label">Email:</h3>
            <p class="contact_item_content">
              <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
            </p>
          </div>
          <?php endif; ?>
          <?php if ( ! empty( $address ) ) : ?>
          <div class="contact_item">
            <h3 class="contact_item_label">Location:</h3>
            <p class="contact_item_content">
              <?php echo $address; ?>
            </p>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php
        catch_template_part( 'layouts/gravity_form', array(
          'form' => $form,
        ) );
      ?>
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
