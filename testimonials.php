<?php
/**
 * Template Name: Testimonials
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/subnav'); ?> 
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
 <?php 
 //print the testimonials that exist
 $testimonials_page_id = $post->ID;
 include(locate_template('templates/content-testimonials.php'));
 ?>