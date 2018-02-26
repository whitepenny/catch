<?php

// Env

$catch_page_protocol = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
$catch_page_url      = $catch_page_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$catch_domain        = $catch_page_protocol . $_SERVER['HTTP_HOST'];

if ( strpos( $catch_page_url, '?') > -1 ) {
  $catch_page_url = substr( $catch_page_url, 0, strpos( $catch_page_url, '?') );
}

// Globals

define( 'CATCH_VERSION', '1.0.0' );
define( 'CATCH_DEBUG', true );
define( 'CATCH_DEV', ( strpos( $catch_page_url, '.test') !== false || strpos( $catch_page_url, 'localhost') !== false ) );
