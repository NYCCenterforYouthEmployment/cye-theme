<div class="page-content">
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