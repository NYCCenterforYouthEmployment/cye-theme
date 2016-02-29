<header class="banner navbar-fixed-top" <?php if (is_user_logged_in()): echo "style=\"top:45px\""; endif; ?>>
 
  <?php get_template_part('templates/nav-nyc'); ?>
  <div class="container clearfix">
    <?php get_template_part('templates/nav'); ?>
  </div>
</header>
