<div class="post-content">
    <article <?php post_class(); ?>>
        <header>
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
			?>
            <h2 class="entry-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
        </header>
        <div class="read-more">
            <?php
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