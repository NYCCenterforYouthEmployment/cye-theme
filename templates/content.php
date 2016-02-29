<div class="page-content">
    <article <?php post_class(); ?>>
        <header>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <?php //get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="read-more">
            <?php
			$link = get_field('external_url'); 
			if (empty($link)): 
				$link = the_permalink();
			endif;
			?>
            	<a href="<?php echo $link; ?>" class="button"><?php _e( 'Read', 'sage' ); ?></a>
        </div>
        <!--
        <div class="entry-summary">
            <?php //the_excerpt(); ?>
        </div>-->
    </article>
</div>