<?php
/**
 * Template Name: News & Press
 */
?>

<?php while (have_posts()) : the_post(); ?>
	 <?php get_template_part('templates/page', 'header'); ?>
     <?php get_template_part('templates/subnav'); ?> 
     <?php get_template_part('templates/content' , 'page'); ?>
     
     
	 <?php
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array( 
		'posts_per_page' 	=> 10,
		'post_type' 			=> 'post',
		'orderby'			=> 'date',
		'order'				=> 'DESC',
		'paged' 				=> $paged
		
	);
	// The Query
	$the_query = new WP_Query( $args );
	
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			get_template_part('templates/content');
		} 
		
		?>
		<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
              <nav class="prev-next-posts clearfix">
                <div class="prev-posts-link">
                  <?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
                </div>
                <div class="next-posts-link">
                  <?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
                </div>
              </nav>
		<?php } ?>
	<?php
	} else {
		// no posts found
	}
	
	?>
     
 <?php endwhile; ?>
