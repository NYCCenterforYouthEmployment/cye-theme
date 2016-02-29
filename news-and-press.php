<?php
/**
 * Template Name: News & Press
 */
?>

<?php while (have_posts()) : the_post(); ?>
	 <?php get_template_part('templates/page', 'header'); ?>
     <?php get_template_part('templates/subnav'); ?> 
     <?php get_template_part('templates/content' , 'page'); ?>
     
     <?php $args = array(
		'posts_per_page'   => 5,
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'	   		   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true 
	);
	$posts = get_posts( $args );
    foreach ( $posts as $post ) : setup_postdata( $post );
		get_template_part('templates/content');
	endforeach; 
	wp_reset_postdata();?>
     
 <?php endwhile; ?>
