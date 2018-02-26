<?php
$slides = get_field( 'slides' );

?>
<div class="fs-row home_slider_container">
  <div class="fs-cell">
    <div class="home_slider js-home_slider owl-carousel">

      <?php
        foreach ( $slides as $slide ) :
      ?>
      <div class="home_slide">
        <?php echo catch_responsive_image( catch_image_home_slider( $slide['image']['ID'] ), 'home_slide_image' ); ?>
        <div class="home_slide_container">
          <h1 class="home_slide_title"><?php echo $slide['title']; ?></h1>
          <div class="home_slide_content">
            <p><?php echo catch_format_content( $slide['content'] ); ?></p>
            <?php if ( ! empty( $slide['link'] ) ) : ?>
            <a href="<?php echo $slide['link']['url']; ?>" class="home_slide_link">
              <?php echo $slide['link']['title']; ?>
              <span class="icon icon_arrow_right"></span>
            </a>
            <?php endif; ?>
          </div>
          <div class="home_slider_controls">
            <button class="home_slider_control js-slider_previous">
              <span class="screenreader">Previous</span>
              <span class="icon circle_arrow_left"></span>
            </button>
            <button class="home_slider_control js-slider_next">
              <span class="screenreader">Next</span>
              <span class="icon circle_arrow_right"></span>
            </button>
          </div>
        </div>
      </div>
      <?php
        endforeach;
      ?>
    </div>
  </div>
</div>
