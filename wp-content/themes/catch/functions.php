<?php

require_once 'includes/config.php';
require_once 'includes/post-types.php';
require_once 'includes/utils.php';
require_once 'includes/utils-admin.php';
require_once 'includes/utils-images.php';

// Hide ACF on production

if ( ! CATCH_DEV ) {
  add_filter( 'acf/settings/show_admin', '__return_false' );
}

// Init

function catch_init() {
  add_theme_support( 'title-tag' );

  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();

  define( 'CATCH_THEME_DIR', $theme_dir );
  define( 'CATCH_THEME_URI', $theme_uri );

  // Disable rando feeds

  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
  remove_action( 'wp_head', 'wp_shortlink_wp_head' );
  remove_action( 'wp_head', 'wp_generator');
  remove_action( 'wp_head', 'rest_output_link_wp_head' );
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
  remove_action( 'wp_head', 'wp_oembed_add_host_js' );
  remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
  remove_action( 'wp_head', 'feed_links_extra', 3);

  // Menus
  register_nav_menu( 'main-navigation', __( 'Main Navigation' ) );
  register_nav_menu( 'footer-navigation', __( 'Footer Navigation' ) );
  register_nav_menu( 'subfooter-navigation', __( 'Sub-Footer Navigation' ) );

  // Images Sizes
  // Wide (16x9)
  catch_add_image_size( 'wide-xxsmall', 300, 169, true );
  catch_add_image_size( 'wide-xsmall',  500, 280, true );
  catch_add_image_size( 'wide-small',   740, 416, true );
  catch_add_image_size( 'wide-medium',  980, 551, true );
  catch_add_image_size( 'wide-large',   1220, 686, true );
  catch_add_image_size( 'wide-xlarge',  1440, 810, true );
  catch_add_image_size( 'wide-xxlarge', 1600, 900, true );

  // Full (3x2)
  catch_add_image_size( 'full-xxsmall', 300, 225, true );
  catch_add_image_size( 'full-xsmall',  500, 375, true );
  catch_add_image_size( 'full-small',   740, 555, true );
  catch_add_image_size( 'full-medium',  980, 735, true );
  catch_add_image_size( 'full-large',   1220, 915, true );
  catch_add_image_size( 'full-xlarge',  1440, 1080, true );
  catch_add_image_size( 'full-xxlarge', 1600, 1200, true );

  // Square
  catch_add_image_size( 'square-xxsmall', 50, 50, true );
  catch_add_image_size( 'square-xsmall',  100, 100, true );
  catch_add_image_size( 'square-small',   150, 150, true );
  catch_add_image_size( 'square-medium',  300, 300, true );
  catch_add_image_size( 'square-large',   500, 500, true );
  catch_add_image_size( 'square-xlarge',  740, 740, true );
  catch_add_image_size( 'square-xxlarge', 980, 980, true );

  // Tall
  catch_add_image_size( 'tall-xxsmall', 225, 300, true );
  catch_add_image_size( 'tall-xsmall',  375, 500, true );
  catch_add_image_size( 'tall-small',   555, 740, true );
  catch_add_image_size( 'tall-medium',  735, 980, true );
  catch_add_image_size( 'tall-large',   915, 1220, true );
  catch_add_image_size( 'tall-xlarge',  1080, 1440, true );
  catch_add_image_size( 'tall-xxlarge', 1200, 1600, true );

  // Scaled / Original
  catch_add_image_size( 'scaled-xxsmall', 300, 1000, false ); // Don't crop
  catch_add_image_size( 'scaled-xsmall',  500, 1000, false ); // Don't crop
  catch_add_image_size( 'scaled-small',   740, 1000, false ); // Don't crop
  catch_add_image_size( 'scaled-medium',  980, 2000, false ); // Don't crop
  catch_add_image_size( 'scaled-large',   1220, 2000, false ); // Don't crop
  catch_add_image_size( 'scaled-xlarge',  1440, 2000, false ); // Don't crop
  catch_add_image_size( 'scaled-xxlarge', 1600, 3000, false ); // Don't crop

  // Options Page
  if ( function_exists( 'acf_add_options_page' ) ) {
    $option_page = acf_add_options_page( array(
      'page_title' => 'Theme Settings',
      'menu_title' => 'Theme Settings',
      'menu_slug'  => 'theme-settings',
      'capability' => 'list_users',
      'redirect'   => false,
    ) );
  }
}
add_action( 'init', 'catch_init', 0 );

function catch_acf_init() {
	acf_update_setting( 'google_api_key', 'xxx' );
}
add_action( 'acf/init', 'catch_acf_init' );

function catch_enqueue_resources() {
  global $wp_styles, $wp_scripts;

  // Styles
  wp_enqueue_style( 'catch-site', CATCH_THEME_URI . '/public/css/site.css', array(), CATCH_VERSION, 'all' );

  // // Scripts - Head
  wp_enqueue_script( 'catch-modernizr', CATCH_THEME_URI . '/public/js/modernizr.js', array(), CATCH_VERSION, false );

  // Move jQuery to footer
  // wp_deregister_script( 'jquery' );
  // wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, true );
  // wp_enqueue_script( 'jquery' );
  wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, false );

  // Scripts - Foot
  wp_enqueue_script( 'catch-site', CATCH_THEME_URI . '/public/js/site.js', array( 'jquery' ), CATCH_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'catch_enqueue_resources' );


// Remove random Boilerplate

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

function catch_disable_wp_emojicons() {
  // remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  // remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  // remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  add_filter( 'emoji_svg_url', '__return_false' );
  // add_filter( 'tiny_mce_plugins', 'catch_disable_emojicons_tinymce' );
}
add_action( 'init', 'catch_disable_wp_emojicons' );


// Favicons

function catch_favicons() {
  $file = CATCH_THEME_DIR . '/assets/faviconData.json';

  if ( file_exists( $file ) ) {
    $json = json_decode( file_get_contents( $file ) , true);
    echo str_ireplace( 'public/', CATCH_THEME_URI . '/public/', $json['favicon']['html_code'] );
  }
}


// Remove Gravity Forms Styles/Scripts

function catch_deregister_gravity_forms_resources() {
  wp_deregister_style( 'gforms_formsmain_css' );
  wp_deregister_style( 'gforms_reset_css' );
  wp_deregister_style( 'gforms_ready_class_css' );
  wp_deregister_style( 'gforms_browsers_css' );

  wp_deregister_script( 'gforms_conditional_logic_lib' );
  wp_deregister_script( 'gforms_ui_datepicker' );
  wp_deregister_script( 'gforms_gravityforms' );
  wp_deregister_script( 'gforms_character_counter' );
  wp_deregister_script( 'gforms_json' );
  //wp_deregister_script("jquery");
}
add_action( 'gform_enqueue_scripts', 'catch_deregister_gravity_forms_resources' );

add_filter( 'gform_confirmation_anchor', '__return_true' );
add_filter( 'gform_init_scripts_footer', '__return_true' );


// Pagination

function catch_pagination( $echo = true ) {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'type'  => 'array',
		'prev_next'   => true,
		'prev_text'    => __('<span class="icon mint_arrow_left"></span> Previous'),
		'next_text'    => __('Next <span class="icon mint_arrow_right"></span>'),
	) );

	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		$pagination = '<div class="pagination">';
		foreach ( $pages as $page ) {
			$pagination .= "$page";
		}
		$pagination .= '</div>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
}


// Excerpt More

function catch_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'catch_excerpt_more' );


//  Pullquote Shortcode

function catch_shortcode_pullquote( $attributes, $quote = '' ) {
  extract( shortcode_atts( array(
    'author' => '',
    'image' => '',
  ), $attributes ) );

  ob_start();
  ?>
  <div class="breakout_full">
    <blockquote class="pullquote">
      <span class="pullquote_marker" style="background-image: url(<?php echo $image; ?>);">
        <span class="icon bubble_large"></span>
      </span>
      <div class="pullquote_header">
        <span class="pullquote_author"><?php echo $author; ?></span>
      </div>
      <p class="pullquote_quote"><?php echo $quote; ?></p>
    </blockquote>
  </div>
  <?php
  $html = ob_get_clean();

  return $html;
}
add_shortcode( 'pullquote', 'catch_shortcode_pullquote' );
