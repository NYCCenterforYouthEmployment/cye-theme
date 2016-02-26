<?php if ( has_post_thumbnail() ) : ?>
    <div class="featured-image">
		<?php the_post_thumbnail('full'); ?>
    </div>
<?php endif; ?>
<div class="page-content">
	<?php the_content(); ?>
	<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>
