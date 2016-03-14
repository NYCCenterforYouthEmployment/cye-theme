<?php
/**
 * Template Name: Home
 */
?>

<div class="container-full gridder">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                
               
                <?php 
				//get callouts content
				$callout_one_image = get_field('callout_one_image');
				$callout_one_title = get_field('callout_one_title');
				$callout_one_link = get_field('callout_one_link');
				$callout_one_button_label = get_field('callout_one_button_label');
				
				$callout_two_image = get_field('callout_two_image');
				$callout_two_title = get_field('callout_two_title');
				$callout_two_link = get_field('callout_two_link');
				$callout_two_button_label = get_field('callout_two_button_label');
				?>
                <?php if (!empty($callout_one_image)): ?>
                <?php 		$url = $callout_one_image['url'];
                            $title = $callout_one_image['title'];
                            $alt = $callout_one_image['alt'];
                            $caption = $callout_one_image['caption'];
                            
                            // get size
                            $size = 'medium';
                            $bg_image = $callout_one_image['sizes'][ $size ];
                          
				?>
                <div class="row clearfix callout right" style="background-image:url(<?php echo $bg_image; ?>)">
                    
                    <div class="col-sm-6 callout-copy">
                        <h2><?php echo $callout_one_title; ?></h2>
                        <div>
                            <a href="<?php echo $callout_one_link; ?>" class="button"><?php echo $callout_one_button_label; ?></a>
                        </div>
                        
                    </div>
                    <div class="col-sm-6 callout-image">
                        <?php if (!empty($alt)):
									echo $alt;
								endif;
						?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($callout_two_image)): ?>
                 <?php 		$url = $callout_two_image['url'];
                            $title = $callout_two_image['title'];
                            $alt = $callout_two_image['alt'];
                            $caption = $callout_two_image['caption'];
                            
                            // get size
                            $size = 'medium';
                            $bg_image = $callout_two_image['sizes'][ $size ];
                          
				?>
                <div class="row clearfix callout left" style="background-image:url(<?php echo $bg_image; ?>)">
                    <div class="col-sm-6 callout-image">
                        <?php if (!empty($alt)):
									echo $alt;
								endif;
						?>
                    </div>
                    <div class="col-sm-6 callout-copy">
                        <h2><?php echo $callout_two_title; ?></h2>
                        <div>
                            <a href="<?php echo $callout_two_link; ?>" class="button"><?php echo $callout_two_button_label; ?></a>
                        </div>
                        
                    </div>
                </div>
                <?php endif; ?>
                
            </div>
        
            <div class="col-md-4">
                <?php 
                    //include testimonials row
					$testimonials_page_id = get_field('testimonials_page_id');
                    include(locate_template('templates/content-testimonials.php')); ?>
                 
                <div style="text-align:center;">
                    <a href="<?php echo get_post_permalink( $testimonials_page_id ); ?>" class="button"><?php _e( 'More', 'sage' ); ?></a>
                </div>
            </div>
        </div>  
    </div>
</div>

<div class="container-full twitter">
    <div class="container">
        <div class="row clearfix">
            <?php dynamic_sidebar('sidebar-twitter'); ?>
        </div>
    </div>
</div>

<!--
<div class="container-full partners">
	<div class="container">
        <div class="row clearfix">
        	<div class="col-md-12">
            	<h3><?php echo get_field('partners_section_header'); ?></h3>
				<?php $partners_page_id = get_field('partners_page_id'); ?>
                <?php include(locate_template('templates/content-partners.php')); ?>
                <p>
                    <a href="<?php echo get_post_permalink( $partners_page_id ); ?>"><?php _e( 'See all', 'sage' ); ?></a>
                </p>
            </div>
       
        </div>
    </div>
</div>-->
           
