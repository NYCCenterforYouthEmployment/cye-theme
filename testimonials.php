<?php
/**
 * Template Name: Testimonials
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php
    wp_nav_menu(['theme_location' => 'impact_benefits', 'menu_class' => 'nav']);
	?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
 <?php 
 //print the testimonials that exist
 $testimonials_page_id = $post->ID;
 include(locate_template('templates/content-testimonials.php'));
 
 ?>