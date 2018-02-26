<?php
global $block_class;

$form = get_sub_field( 'gravity_form' );
$title = get_sub_field( 'title' );
$content = get_sub_field( 'content' );

catch_template_part( 'layouts/gravity_form', array(
  'form' => $form,
  'title' => $title,
  'content' => $content,
) );
