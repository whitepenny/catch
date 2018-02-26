<?php
$main_title = get_bloginfo( 'name' );

$login_link = get_field( 'global_staff_login_link', 'option' );
$donate_link = get_field( 'global_donate_link', 'option' );

$social_links = get_field( 'global_social_links', 'option' );
?>
        </main>
        <footer>
          <div class="footer">
            <div class="fs-row">
              <div class="fs-cell footer_logos">
                <a href="<?php echo get_home_url(); ?>" class="footer_logo">
                  <span class="icon logo_white"></span>
                  <span class="screenreader"><?php echo $main_title; ?></span>
                </a>
              </div>
              <div class="fs-cell">
                <nav class="footer_nav main_nav">
                  <?php catch_footer_navigation( 2 ); ?>
                  <?php if ( ! empty( $social_links ) ) : ?>
                  <div class="footer_social js-social_links">
                    <?php foreach ( $social_links as $social_link ) : ?>
                    <a href="<?php echo $social_link['link']; ?>" class="footer_social_link" target="_blank">
                      <span class="screenreader"><?php echo ucwords( $social_link['service'] ); ?></span>
                      <span class="icon social_<?php echo $social_link['service']; ?>"></span>
                    </a>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                </nav>
              </div>
            </div>
          </div>
          <div class="subfooter">
            <div class="fs-row">
              <div class="fs-cell fs-lg-8">
                <nav class="footer_nav subfooter_nav">
                  <?php catch_subfooter_navigation(); ?>
                </nav>
              </div>
              <div class="fs-cell fs-lg-4">
                <p class="subfooter_copyright">
                  Copyright &copy; <?php echo date( 'Y' ); ?> <?php echo $main_title; ?>. All Right Reserved.
                </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <?php
      $navigation_options = array(
        'type'     => 'overlay',
        'gravity'  => 'right',
        'label'    => false,
        'maxWidth' => '979px'
      );
    ?>
    <div class="mobile_nav_tray js-navigation" data-navigation-handle=".js-mobile_nav_handle" data-navigation-content=".js-mobile_nav_content" data-navigation-options="<?php echo catch_json_options( $navigation_options ); ?>" aria-hidden="true">
      <nav class="mobile_nav main_nav">
        <?php catch_main_navigation( 2 ); ?>
      </nav>
      <nav class="mobile_nav utility_nav">
        <?php if ( ! empty( $login_link ) ) : ?>
        <a href="<?php echo $login_link; ?>" class="utility_nav_link login" <?php echo catch_link_target( $login_link ); ?>>
          <span class="icon icon_lock"></span>
          Staff Login
        </a>
        <?php endif; ?>
        <?php if ( ! empty( $donate_link ) ) : ?>
        <a href="<?php echo $donate_link; ?>" class="utility_nav_link donate" <?php echo catch_link_target( $login_link ); ?>>Donate</a>
        <?php endif; ?>
      </nav>
    </div>

    <?php wp_footer(); ?>

  </body>
</html>
