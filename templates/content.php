<div class="row">
    <div class="col-sm-5">
    <?php
	// check if the post has a Post Thumbnail assigned to it.
	if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	} ?>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-6">
        <article <?php post_class(); ?>>
          <header>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <?php //get_template_part('templates/entry-meta'); ?>
          </header>
          <div class="read-more">
          	<a href="<?php the_permalink(); ?>" class="button"><?php _e( 'Read', 'sage' ); ?></a>
          </div>
          <!--
          <div class="entry-summary">
            <?php //the_excerpt(); ?>
          </div>-->
        </article>
     </div>
</div>