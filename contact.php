<?php
/**
 * Template Name: Contact
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <div class="row">
  	<div class="col-md-6">
    	<?php get_template_part('templates/content', 'page'); ?>
    </div>
    <div class="col-md-6">
    	<?php 
		$form_key = get_field('form_key');
		$form_id = get_field('form_id');
		if ( !empty($form_key) && !empty($form_id)):
    		echo FrmFormsController::show_form($form_id, $key = $form_key, $title=false, $description=false); 
		endif;
		?>
  </div>
  
<?php endwhile; ?>
