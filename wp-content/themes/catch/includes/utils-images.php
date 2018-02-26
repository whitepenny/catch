<?php

// Image Utils

// Map image sizing for on-the-fly generation

function catch_add_image_size( $name, $width, $height, $crop = false ) {
  if ( function_exists( 'fly_add_image_size' ) ) {
    fly_add_image_size( $name, $width, $height, $crop );
  } else {
    add_image_size( $name, $width, $height, true );
  }
}

function catch_get_image( $image, $size ) {
  if ( function_exists( 'fly_get_attachment_image_src' ) ) {
    $image = fly_get_attachment_image_src( $image, $size );

    if ( empty( $image['src'] ) ) {
      return array(
        'src'    => $image[0],
        'width'  => $image[1],
        'height' => $image[2],
      );
    } else {
      return $image;
    }
  } else {
    $image = wp_get_attachment_image_src( $image, $size );

    if ( empty( $image ) ) {
      return false;
    }

    return array(
      'src'    => $image[0],
      'width'  => $image[1],
      'height' => $image[2],
    );
  }
}


// Draw responsive image markup

function catch_responsive_image( $images, $class = '', $alt = '', $echo = true ) {
  $images = array_reverse( $images );
  $html_all = array();

  foreach ( $images as $media => $image ) {
    if ( 'fallback' !== $media ) {
      $html_all[] = '<source media="' . $media . '" srcset="' . $image . '">';
    } else {
      $fallback = $image;
      $html_all[] = '<source media="(min-width: 0px)" srcset="' . $image . '">';
    }
  }

  $html  = '';
  $html .= '<picture class="js-responsive responsive_image ' . $class . '">';
  $html .= '<!--[if IE 9]><video style="display: none;"><![endif]-->';
  $html .= implode( '', $html_all );

  $html .= '<!--[if IE 9]></video><![endif]-->';
  $html .= '<img src="' . $fallback . '" alt="' . $alt . '" draggable="false">';
  $html .= '</picture>';

  if ( $echo ) {
    echo $html;
  } else {
    return $html;
  }
}


// Get image orientation

function catch_get_image_orientation( $image_id ) {
  $path = get_attached_file( $image_id );

  if ( empty( $path ) ) {
    return false;
  }

  list( $width, $height ) = getimagesize( $path );

  $ratio = $height / $width;
  echo '<!-- ' . $ratio . ' -->';

  if ( $ratio < 0.2 ) {
    return 'wide';
  } else if ( $ratio < 0.4 ) {
    return 'landscape';
  } else if ( $ratio <= 0.7 ) {
    return 'squarish';
  } else if ( $ratio <= 1 ) {
    return 'square';
  } else {
    return 'portrait';
  }
}


// Check min image size

function catch_check_image_size( $image_id, $image_crop, $min_width = 0, $min_height = 0 ) {
  $details = catch_get_image( $image_id, $image_crop );

  return ( $details['width'] >= $min_width && $details['height'] >= $min_height );
}


// Responsive Images

function catch_image_services_grid( $image_id ) {
  $square_large = catch_get_image( $image_id, 'square-large' );
  $full_xsmall  = catch_get_image( $image_id, 'full-xsmall' );
  $full_small   = catch_get_image( $image_id, 'full-small' );
  $wide_small   = catch_get_image( $image_id, 'wide-small' );

  return array(
    'fallback'            => $square_large['src'],
    '(min-width: 400px)'  => $full_small['src'],
    '(min-width: 500px)'  => $wide_small['src'],
    '(min-width: 740px)'  => $full_xsmall['src'],
    '(min-width: 1220px)' => $full_small['src'],
  );
}

function catch_image_stories_list( $image_id ) {
  $square_large = catch_get_image( $image_id, 'square-large' );
  $full_xsmall  = catch_get_image( $image_id, 'full-xsmall' );
  $full_small   = catch_get_image( $image_id, 'full-small' );
  $wide_xsmall  = catch_get_image( $image_id, 'wide-xsmall' );
  $wide_small   = catch_get_image( $image_id, 'wide-small' );


  return array(
    'fallback'            => $wide_xsmall['src'],
    '(min-width: 500px)'  => $wide_small['src'],
    '(min-width: 740px)'  => $square_large['src'],
    '(min-width: 980px)'  => $full_xsmall['src'],
    '(min-width: 1220px)' => $full_small['src'],
  );
}

function catch_image_team_grid( $image_id ) {
  $tall_xsmall  = catch_get_image( $image_id, 'tall-xsmall' );

  return array(
    'fallback'            => $tall_xsmall['src'],
  );
}

function catch_image_post_grid( $image_id ) {
  $square_medium = catch_get_image( $image_id, 'square-medium' );
  $square_large  = catch_get_image( $image_id, 'square-large' );
  $full_xxsmall  = catch_get_image( $image_id, 'full-xxsmall' );
  $full_xsmall   = catch_get_image( $image_id, 'full-xsmall' );
  $wide_xsmall   = catch_get_image( $image_id, 'wide-xsmall' );

  return array(
    'fallback'            => $wide_xsmall['src'],
    '(min-width: 500px)'  => $full_xxsmall['src'],
    '(min-width: 740px)'  => $full_xsmall['src'],
    '(min-width: 980px)'  => $square_medium['src'],
    '(min-width: 1220px)' => $square_large['src'],
  );
}

function catch_image_post_grid_slim( $image_id ) {
  $full_xxsmall  = catch_get_image( $image_id, 'full-xxsmall' );
  $full_xsmall   = catch_get_image( $image_id, 'full-xsmall' );
  $wide_xsmall   = catch_get_image( $image_id, 'wide-xsmall' );

  return array(
    'fallback'            => $wide_xsmall['src'],
    '(min-width: 500px)'  => $full_xxsmall['src'],
    '(min-width: 740px)'  => $full_xsmall['src'],
    '(min-width: 980px)'  => $full_xsmall['src'],
    '(min-width: 1220px)' => $full_xsmall['src'],
  );
}

function catch_image_post_detail( $image_id ) {
  $wide_xsmall  = catch_get_image( $image_id, 'wide-xsmall' );
  $wide_small   = catch_get_image( $image_id, 'wide-small' );
  $wide_medium  = catch_get_image( $image_id, 'wide-medium' );

  return array(
    'fallback'            => $wide_xsmall['src'],
    '(min-width: 500px)'  => $wide_small['src'],
    '(min-width: 740px)'  => $wide_medium['src'],
  );
}

function catch_image_team_bio( $image_id ) {
  $wide_xsmall  = catch_get_image( $image_id, 'wide-xsmall' );
  $wide_small   = catch_get_image( $image_id, 'wide-small' );
  $wide_medium  = catch_get_image( $image_id, 'wide-medium' );

  return array(
    'fallback'            => $wide_xsmall['src'],
    '(min-width: 500px)'  => $wide_small['src'],
    '(min-width: 1220px)' => $wide_medium['src'],
  );
}

function catch_image_home_slider( $image_id ) {
  // $square_large  = catch_get_image( $image_id, 'square-large' );
  // $square_xlarge = catch_get_image( $image_id, 'square-xlarge' );
  $full_medium   = catch_get_image( $image_id, 'full-medium' );
  // $full_large    = catch_get_image( $image_id, 'full-large' );
  $wide_medium   = catch_get_image( $image_id, 'wide-medium' );
  $wide_large    = catch_get_image( $image_id, 'wide-large' );

  return array(
    'fallback'            => $wide_medium['src'],
    '(min-width: 500px)'  => $wide_medium['src'],
    '(min-width: 740px)'  => $full_medium['src'],
    '(min-width: 980px)'  => $wide_large['src'],
    '(min-width: 1220px)' => $wide_large['src'],
  );
}



// Background Images

function catch_image_background_page_header( $image_id ) {
  $square_large  = catch_get_image( $image_id, 'square-large' );
  $square_xlarge = catch_get_image( $image_id, 'square-xlarge' );
  $wide_medium   = catch_get_image( $image_id, 'wide-medium' );
  $wide_large    = catch_get_image( $image_id, 'wide-large' );

  return array(
    'source' => array(
      '0px'   => $square_large['src'],
      '500px' => $square_xlarge['src'],
      '740px' => $wide_medium['src'],
      '980px' => $wide_large['src'],
    ),
  );
}

function catch_image_background_large_callout( $image_id ) {
  $square_large  = catch_get_image( $image_id, 'square-large' );
  $square_xlarge = catch_get_image( $image_id, 'square-xlarge' );
  $wide_medium   = catch_get_image( $image_id, 'wide-medium' );
  $wide_large    = catch_get_image( $image_id, 'wide-large' );

  return array(
    'source' => array(
      '0px'   => $square_large['src'],
      '500px' => $square_xlarge['src'],
      '740px' => $wide_medium['src'],
      '980px' => $wide_large['src'],
    ),
  );
}
