<?php

// Register Custom Post types

function catch_register_post_types() {
  // Blog / Posts
  unregister_taxonomy_for_object_type( 'post_tag', 'post' );
  unregister_taxonomy_for_object_type( 'category', 'post' );
  remove_post_type_support( 'post', 'comments' );

  $home_url = get_home_url();
  $bcn_options = get_option( 'bcn_options' );

  $story_root_id = $bcn_options['apost_story_root'];
  $story_slug = trim( str_ireplace( $home_url, '', get_permalink( $story_root_id ) ), '/' );

  $team_root_id = $bcn_options['apost_team_root'];
  $team_slug = trim( str_ireplace( $home_url, '', get_permalink( $team_root_id ) ), '/' );

  $slugs = array(
    'story' => $story_slug,
    'team' => $team_slug,

    'story_id' => $story_root_id,
    'team_id' => $team_root_id,
  );

  // Stories
  register_post_type( 'story', array(
    'labels'              => array(
      'name'              => 'Stories',
      'singular_name'     => 'Story',
      'add_new_item'      => 'Add New Story',
      'edit_item'         => 'Edit Story',
    ),
    'description'         => '',
    'menu_icon'           => 'dashicons-id-alt',
    'public'              => true,
    'show_ui'             => true,
    'has_archive'         => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'capabilities'        => array(),
    'supports'            => array( 'title', 'editor', 'revisions' ),
    'map_meta_cap'        => true,
    'map_meta_cap'        => true,
    'hierarchical'        => false,
    'rewrite'             => array(
      'slug'              => $slugs['story'],
      'with_front'        => false,
    ),
    'query_var'           => true,
  ) );

  // Team
  register_taxonomy( 'team_type', 'team', array(
    'labels'            => array(
      'name'            => 'Types',
      'add_new_item'    => 'Add New Type',
      'new_item_name'   => 'New Type',
    ),
    'show_ui'           => true,
    'show_tagcloud'     => false,
    'show_admin_column' => true,
    'hierarchical'      => true,
    'rewrite'           => array(
      'slug'            => $slugs['team'] . '/type',
      'with_front'      => false,
    ),
  ) );

  register_post_type( 'team', array(
    'labels'              => array(
      'name'              => 'Team',
      'singular_name'     => 'Team Member',
      'add_new_item'      => 'Add New Team Member',
      'edit_item'         => 'Edit Team Member',
    ),
    'description'         => '',
    'menu_icon'           => 'dashicons-groups',
    'public'              => true,
    'show_ui'             => true,
    'has_archive'         => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'capabilities'        => array(),
    'supports'            => array( 'title', 'editor', 'revisions' ),
    'map_meta_cap'        => true,
    'map_meta_cap'        => true,
    'hierarchical'        => false,
    'rewrite'             => array(
      'slug'              => $slugs['team'],
      'with_front'        => false,
    ),
    'query_var'           => true,
  ) );

  register_taxonomy_for_object_type( 'team_type', 'team' );

  // Callouts
  register_post_type( 'callout', array(
    'labels'              => array(
      'name'              => 'Callouts',
      'singular_name'     => 'Callout',
      'add_new_item'      => 'Add New Callout',
      'edit_item'         => 'Edit Callout',
    ),
    'description'         => '',
    'menu_icon'           => 'dashicons-format-aside',
    'public'              => true,
    'show_ui'             => true,
    'has_archive'         => false,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => false,
    'capability_type'     => 'post',
    'capabilities'        => array(),
    'supports'            => array( 'title' ),
    'map_meta_cap'        => true,
    'map_meta_cap'        => true,
    'hierarchical'        => false,
    'rewrite'             => false,
    'query_var'           => true,
  ) );

  $old_slugs = get_option( 'catch_post_type_slugs' );
  if ( empty( $old_slugs ) || (
    $slugs['story'] != $old_slugs['story'] ||
    $slugs['team'] != $old_slugs['team']
  ) ) {
    flush_rewrite_rules();
    update_option( 'catch_post_type_slugs', $slugs );
  }
}
add_action( 'init', 'catch_register_post_types', 5 );


//

function catch_save_casestudy_post( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  $post_type = get_post_type( $post_id );

  if ( $post_type == 'callout' ) {
    $type = get_field( 'type', $post_id );
    $title = get_field( 'title', $post_id );

    remove_action( 'save_post', 'catch_save_casestudy_post', 99 );
    wp_update_post( array(
      'ID'         => $post_id,
      'post_title' => ucwords( $type ) . ' - ' . $title,
    ) );
    add_action( 'save_post', 'catch_save_casestudy_post', 99 );
  }
}
add_action( 'save_post', 'catch_save_casestudy_post', 99 );


//

function catch_edit_callout_columns( $columns ) {
  $columns = array(
    'cb'    => '<input type="checkbox">',
    'title' => 'Title',
    'type'  => 'Type',
    'date'  => 'Date',
  );

  return $columns;
}
add_filter( 'manage_edit-callout_columns', 'catch_edit_callout_columns' );

function catch_manage_callout_columns( $column, $post_id ) {
  global $post;

  switch( $column ) {
    case 'type' :
      $type = get_field( 'type', $post_id );

      if ( empty( $type ) ) {
        echo '';
      } else {
        echo ucwords( $type );
      }

      break;
    default :
      break;
  }
}
add_action( 'manage_callout_posts_custom_column', 'catch_manage_callout_columns', 10, 2 );
