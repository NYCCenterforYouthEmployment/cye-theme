<?php use Roots\Sage\Titles; ?>

<div class="page-header">
  <h1><?php
	echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent );?></h1>
  <?php //echo Titles\title($post->ID); ?>
</div>
