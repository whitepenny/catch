<?php
$cpt = catch_get_cpt();

if ( $cpt !== 'story' ) :
  $navigation_options = array(
    'labels' => array(
      'closed' => 'In This Section',
      'open' => 'Close Menu',
    ),
  );
?>
<div class="subnav_container">
  <button class="subnav_handle js-subnav_handle">Menu</button>
  <div class="subnav js-navigation" data-navigation-handle=".js-subnav_handle" data-navigation-options="<?php echo catch_json_options( $navigation_options ); ?>">
    <?php catch_sub_navigation( 10 ); ?>
  </div>
</div>
<?php
endif;
