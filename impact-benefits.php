<?php
/**
 * Template Name: Impact & Benefits
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php
    wp_nav_menu(['theme_location' => 'impact_benefits', 'menu_class' => 'nav']);
	?>
  <?php get_template_part('templates/content', 'page'); ?>
 <?php endwhile; ?>
 
  <?php $impact_benefits_page_id = $post->ID; ?>

  <?php include(locate_template('templates/content-impact-and-benefits.php')); ?>
