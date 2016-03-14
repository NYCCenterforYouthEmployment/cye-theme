<footer class="content-info">
  <?php if( !is_page_template( 'partners.php' )): ?>
	  <div class="container-full partners partners-footer">
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-12">
					<h3><?php _e( 'Our founding partners', 'sage' ); ?></h3>
					<?php $partners_page_id = '74' ?>
					<?php include(locate_template('templates/content-partners.php')); ?>
					<p>
						<a href="<?php echo get_post_permalink( $partners_page_id ); ?>"><?php _e( 'See all', 'sage' ); ?></a>
					</p>
				</div>
			</div>
		</div>
	  </div>
  <?php endif ?>
  <div class="container cye-footer">
  	<div class="row">
    	<div class="col-md-8">
			<?php dynamic_sidebar('sidebar-footer'); ?>
        </div>
        <div class="col-md-4 social">
        	<?php $sm_links = get_field('social_media_links', 'option'); ?>
              <?php if (!empty($sm_links)): ?>
                <ul>
				<?php foreach ($sm_links as $sm_link): ?>
                  <li><a target="_blank" title="<?php echo ucwords(str_replace('_', ' ', $sm_link['network'])) ?>" href="<?php echo $sm_link['social_network_url'] ?>" class="fa-<?php echo $sm_link['network'] ?>" onclick="ga('send','event','social',<?php echo ucwords(str_replace('_', ' ', $sm_link['network'])) ?>','CYE Website')"><span class="sr-only"><?php echo ucwords(str_replace('_', ' ', $sm_link['network'])) ?></span></a></li>
                <?php endforeach ?>
                </ul>
              <?php endif ?>
        </div>
     </div>
  </div>
  <?php get_template_part('templates/footer-nyc'); ?>
</footer>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74242603-1', 'auto');
  ga('send', 'pageview');

</script>
