<div class="page-content">
    <article <?php post_class(); ?>>
        <header>
            <h2 class="entry-title"><?php the_title(); ?></h2>
        </header>
        <div class="read-more">
            <?php
			$link = get_field('external_url'); 
			if (empty($link)): 
				$link = get_permalink();
			endif;
			
            $external_url_source = get_field('external_url_source'); 
			if (!empty($external_url_source)):
            	echo $external_url_source;
				echo "<br>";
			endif;
				get_template_part('templates/entry-meta');
			?>
			
				<p><a href="<?php echo $link; ?>" class="button"><?php _e( 'Read', 'sage' ); ?></a></p>
        </div>
        <!--
        <div class="entry-summary">
            <?php //the_excerpt(); ?>
        </div>-->
    </article>
</div>