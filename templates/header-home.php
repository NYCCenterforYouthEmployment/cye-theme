<?php $hero_images= get_field('homepage_hero_gallery'); ?>
<?php 
	if ($hero_images):
		foreach( $hero_images as $image ): 
			$hero_image_url = $image['sizes']['large'];
			$hero_image_alt = $image['alt'];
		   break;
		endforeach;
	endif;	  
?>


<header class="banner home" <?php if ($hero_images): ?>style="background-image:url(<?php echo $hero_image_url; ?>)"<?php endif; ?>>
  <div class="scrim">
  	<?php if( $hero_images && $hero_image_alt ): ?><?php echo $hero_image_alt; ?><?php endif; ?>
  </div>
  <div class="container">
    <?php get_template_part('templates/nav'); ?>
    <div class="hero-content-wrapper">
    	<div class="site-title"><?php echo get_field('hero_title'); ?></div>
    	<div class="site-subtitle"><?php echo get_field('hero_subtitle'); ?></div>
        
        <div class="call-to-action-buttons clearfix">
        	<?php if( get_field('button_left_label') ): ?>
                <div class="button-left">
                    <a href="<?php echo get_field('button_left_link'); ?>"><?php echo get_field('button_left_label'); ?></a>
                </div>
            <?php endif; ?>
            <?php if( get_field('button_right_label') ): ?>
            <div class="button-right">
            	<a href="<?php echo get_field('button_left_link'); ?>"><?php echo get_field('button_right_label'); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="credit">
        <?php echo get_field('hero_image_credit'); ?>
    </div>
  </div>
</header>

<!-- impact and benefits row -->
<?php $impact_benefits_page_id = get_field('impact_benefits_page_id'); ?>
<?php include(locate_template('templates/content-impact-and-benefits.php')); ?>