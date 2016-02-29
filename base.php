<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
	  $content_wrapper = "";
      do_action('get_header');
      if ( is_page_template( 'home.php' ) ) {
	  	get_template_part('templates/header-home');
		$content_wrapper = "";
	  } else {
		  get_template_part('templates/header');
		  $content_wrapper = "container";
	  }
    ?>
    <div class="wrap" role="document">
      <div class="content wrapper">
        <main class="main">
        	<div class="<?php echo  $content_wrapper; ?>">
        		<?php include Wrapper\template_path(); ?>
            </div>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
