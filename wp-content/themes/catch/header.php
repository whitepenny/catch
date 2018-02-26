<?php
$main_title = get_bloginfo( 'name' );
$tagline = str_ireplace( $main_title, '<strong>'.$main_title.'</strong>', get_bloginfo( 'description' ) );

$scripts_head = get_field( 'scripts_head', 'option' );
$scripts_body = get_field( 'scripts_body', 'option' );

$login_link = get_field( 'global_staff_login_link', 'option' );
$donate_link = get_field( 'global_donate_link', 'option' );
?><!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <?php wp_head(); ?>
    <?php catch_favicons(); ?>
    <?php echo $scripts_head; ?>
  </head>
  <body <?php body_class( 'fs-grid' ); ?> >
    <?php echo $scripts_body; ?>
    <div class="container js-mobile_nav_content">
      <div class="page_wrapper">
        <header class="header">
          <div class="fs-row header_row">
            <div class="fs-cell fs-sm-half fs-md-half fs-lg-3">
              <a href="<?php echo get_home_url(); ?>" class="header_logo">
                <span class="screenreader"><?php echo $main_title; ?></span>
              </a>
              <span class="header_tagline"><?php echo $tagline; ?></span>
            </div>
            <div class="fs-cell fs-sm-half fs-md-half fs-lg-9">
              <nav class="header_nav main_nav">
                <?php catch_main_navigation(); ?>
              </nav>
              <button type="button" class="mobile_nav_handle js-mobile_nav_handle">
                <span class="icon mobile_handle"></span>
                <span class="screenreader">Menu</span>
              </button>
            </div>
            <nav class="header_nav utility_nav">
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
        </header>
        <main class="main">
