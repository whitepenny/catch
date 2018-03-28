<?php

// Formatted content

function catch_get_the_content( $post_id = false ) {
  if ( ! empty( $post_id ) ) {
    $post = get_page( $post_id );
    $content = $post->post_content;
  } else {
    $content = get_the_content( '' );
  }

	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	return $content;
}


// Check external link

function catch_external_link( $link ) {
  global $catch_domain;

  return ( strpos( $link, $catch_domain ) === false );
}


// Draw Link Target

function catch_link_target( $link ) {
  return catch_external_link( $link ) ? ' target="_blank"' : '';
}


// Get Template Part w/ Variables

function catch_template_part( $template, $args ) {
  // $path = locate_template( $template . '.php', true, false );
  $path = CATCH_THEME_DIR . '/' . $template . '.php';

  if ( file_exists( $path ) ) {
    extract( $args );

    include $path;
  }
}


// Main Nav

function catch_main_navigation( $depth = 2 ) {
  $args = array(
    'theme_location' => 'main-navigation',
    'depth'          => $depth
  );

  wp_nav_menu( $args );
}


// Sub Nav

function catch_sub_navigation( $depth = 2 ) {
  $args = array(
    'theme_location' => 'main-navigation',
    'depth'          => $depth
  );

  wp_nav_menu( $args );
}


// Highlight CPTs in menu

function catch_get_cpt() {
  $types = array(
    'story',
    'team',
  );

  foreach ( $types as $type ) {
    if ( is_post_type_archive( $type ) || is_singular( $type ) ) {
      return $type;
    }
  }

  $taxonomies = array(
    'team_type' => 'team',
  );

  foreach ( $taxonomies as $tax => $type ) {
    if ( is_tax( $tax ) ) {
      return $type;
    }
  }

  return false;
}

//

function catch_menu_item_classes( $classes, $item, $args ) {
  global $catch_domain;
  global $catch_page_url;

  $cpt = catch_get_cpt();

  $cpts_in_nav = array(
    'service'
  );

  if ( ! empty( $cpt ) ) {
    $bcn_options = get_option( 'bcn_options' );
    $root_id = $bcn_options['apost_' . $cpt . '_root'];

    $item_path = str_ireplace( $catch_domain, '', $item->url );
    $current_path = str_ireplace( $catch_domain, '', $catch_page_url );

    if ( $item->object_id == $root_id ) {

      if ( in_array( $cpt, $cpts_in_nav ) ) {
        if ( is_singular( $cpt ) && $current_path == $item_path ) {
          $classes[] = 'current-menu-item';
        } elseif ( is_post_type_archive( $cpt ) ) {
          $classes[] = 'current-menu-item';
        }
      } else {
		    $classes[] = 'current-menu-item';
      }
    }

    // Custom team pages
    if ( $item->type == 'taxonomy' && $cpt == 'team' && is_single() ) {
      $term = get_term( $item->object_id, 'team_type' );
      $post_id = get_the_ID();

      if ( ! is_wp_error( $term ) && has_term( $item->object_id, 'team_type', $post_id ) ) {
        $classes[] = 'current-menu-item';
      }
    }

    if ( strpos( $catch_page_url, $item_path ) !== false ) {
      $classes[] = 'current-menu-ancestor';
    }
  }

	return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'catch_menu_item_classes', 10, 3 );


// Footer Nav

function catch_footer_navigation( $depth = 1 ) {
  $args = array(
    'theme_location' => 'footer-navigation',
    'depth'          => $depth
  );

  wp_nav_menu( $args );
}


// Sub Footer Nav

function catch_subfooter_navigation( $depth = 1 ) {
  $args = array(
    'theme_location' => 'subfooter-navigation',
    'depth'          => $depth
  );

  wp_nav_menu( $args );
}


// Format text content

function catch_format_content( $text = '', $echo = true ) {
  $find    = array( '[br]', '{', '}' );
  $replace = array( '<br>', '<strong>', '</strong>' );
  $string  = str_ireplace( $find, $replace, $text );

  if ( $echo ) {
    echo $string;
  } else {
    return $string;
  }
}


// JSON Options

function catch_json_options( $options = array(), $echo = true ) {
  $string = htmlspecialchars( json_encode( $options ) );

  if ( $echo ) {
    echo $string;
  } else {
    return $string;
  }
}


// Trim Length (alternative to wp_trim_words)

function catch_trim_length( $string = '', $length ) {
  $ns = '';
  $opentags = array();
  $string = trim( $string );
  if ( strlen( html_entity_decode( strip_tags( $string ) ) ) < $length ) {
    return $string;
  }
  if ( strpos( $string,' ' ) === false && strlen( html_entity_decode( strip_tags( $string ) ) ) > $length ) {
    return substr( $string,0,$length ).'&hellip;';
  }
  $x = 0;
  $z = 0;
  while ( $z < $length && $x <= strlen( $string ) ) {
    $char = substr( $string, $x, 1 );
    $ns .= $char; // Add the character to the new string.
    if ( '<' == $char ) {
      // Get the full tag -- but compensate for bad html to prevent endless loops.
      $tag = '';
      while ( '>' !== $char && false !== $char ) {
        $x++;
        $char = substr( $string, $x, 1 );
        $tag .= $char;
      }
      $ns .= $tag;

      $tagexp = explode( ' ',trim( $tag ) );
      $tagname = str_replace( '>','',$tagexp[0] );

      // If it's a self contained <br /> tag or similar, don't add it to open tags.
      if ( '/' != $tagexp[1] && '/>' != $tagexp[1] ) {
        // See if we're opening or closing a tag.
        if ( substr( $tagname,0,1 ) == '/' ) {
          $tagname = str_replace( '/','',$tagname );
          // We're closing the tag. Kill the most recently opened aspect of the tag.
          $done = false;
          reset( $opentags );
          while ( current( $opentags ) && ! $done ) {
            if ( current( $opentags ) == $tagname ) {
              unset( $opentags[ key( $opentags ) ] );
              $done = true;
            }
            next( $opentags );
          }
        } else {
          // Open a new tag.
          $opentags[] = $tagname;
        }
      }
    } elseif ( '&' == $char ) {
      $entity = '';
      while ( ';' != $char && ' ' != $char && '<' != $char ) {
        $x++;
        $char = substr( $string,$x,1 );
        $entity .= $char;
      }
      if ( ';' == $char ) {
        $z++;
        $ns .= $entity;
      } elseif ( ' ' == $char ) {
        $z += strlen( $entity );
        $ns .= $entity;
      } else {
        $z += strlen( $entity );
        $ns .= substr( $entity,0,-1 );
        $x -= 2;
      }
    } else {
      $z++;
    }
    $x++;
  }
  while ( $x < strlen( $string ) && ! in_array( substr( $string,$x,1 ), array( ' ', '!', '.', ',', '<', '&' ) ) ) {
    $ns .= substr( $string,$x,1 );
    $x++;
  }
  if ( strlen( strip_tags( $ns ) ) < strlen( strip_tags( $string ) ) ) {
    $ns .= '&hellip;';
  }
  $opentags = array_reverse( $opentags );
  foreach ( $opentags as $key => $val ) {
    $ns .= '</'.$val.'>';
  }
  return $ns;
}



function catch_bcn_after_fill( $trail ) {
  $index = null;

  foreach ( $trail->breadcrumbs as $i => &$bc ) {
    if ( in_array( 'team-root', $bc->get_types() ) ) {
      $index = $i;
      break;
    }
  }

  if ( ! empty( $index ) ) {
    $cpt = catch_get_cpt();

    // Custom team pages
    if ( $cpt == 'team' ) {
      if ( is_single() ) {
        $post_id = get_the_ID();
        $terms = get_the_terms( $post_id, 'team_type' );

        if ( ! empty( $terms ) ) {
          $term = $terms[0];
        }

        if ( ! empty( $term ) && ! is_wp_error( $term ) ) {
          $trail->breadcrumbs[ $index ] = new bcn_breadcrumb( $term->name, '', array(), get_term_link( $term ) );
        }
      } else if ( is_tax( 'team_type' ) ) {
        array_splice( $trail->breadcrumbs, $index, 1 );
      }
    }
  }
}
add_action( 'bcn_after_fill', 'catch_bcn_after_fill', 10, 1 );
