<?php
/**
 * Template Name: Impact & Benefits
 */
?>

<?php while (have_posts()) : the_post(); ?>
 <?php get_template_part('templates/page', 'header'); ?>
 <?php get_template_part('templates/subnav'); ?> 
 <?php get_template_part('templates/content', 'page'); ?>
 <?php endwhile; ?>
 
  <?php $impact_benefits_page_id = $post->ID; ?>

  <?php include(locate_template('templates/content-impact-and-benefits.php')); ?>
