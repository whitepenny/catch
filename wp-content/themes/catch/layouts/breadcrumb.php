<?php
global $catch_breadcrumb;

// Only draw it once
if ( empty( $catch_breadcrumb ) || ! $catch_breadcrumb ) :
  $catch_breadcrumb = true;
?>
<nav class="breadcrumb">
  <?php bcn_display(); ?>
</nav>
<?php
endif;
