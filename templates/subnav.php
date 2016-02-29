 <!-- show child pages (if any) -->
  <?php
	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'post_parent'    => $post->ID,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	 );
	
	$current_page_id = $post->ID;
	$parent = new WP_Query( $args );
	
	   
    //if this is the child
    if ( $post->post_parent > 0) : ?>
		<ul class="subnav nav">
		<?php wp_list_pages( array( 'title_li' => '', 'child_of' => $post->post_parent ) ); ?>
		</ul>
	<?php endif; ?>
    
  
  <?php wp_reset_query(); ?>
  <!-- end subpage listing -->
  
  