	<a id="menulink" href="#">
        <div class="hamburger-wrapper">
            <i class="fa fa-bars hamburger"><span class="sr-only"><?php _e( 'Menu', 'sage' ); ?></i>
        </div>
    </a>
    
    <div class="brand">
    	<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
    </div>
    
       
    <nav class="nav-primary">
      <div class="nav-primary-wrapper clearfix">
		  <?php
          if (has_nav_menu('primary_navigation_left')) :
            wp_nav_menu(['theme_location' => 'primary_navigation_left', 'menu_class' => 'nav']);
          endif;
          ?>
          <?php
          if (has_nav_menu('primary_navigation_right')) :
            wp_nav_menu(['theme_location' => 'primary_navigation_right', 'menu_class' => 'nav']);
          endif;
          ?>
       </div>
    </nav>
    <nav class="nav-supplemental ">
      <?php
      if (has_nav_menu('supplemental_navigation')) :
        wp_nav_menu(['theme_location' => 'supplemental_navigation', 'menu_class' => 'nav-supplemental']);
      endif;
      ?>
    </nav>
    
    