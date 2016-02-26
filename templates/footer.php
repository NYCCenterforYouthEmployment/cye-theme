<footer class="content-info">
  <div class="container">
  	<div class="row">
    	<div class="col-md-8">
			<?php dynamic_sidebar('sidebar-footer'); ?>
        </div>
        <div class="col-md-4 social">
        	<?php $sm_links = get_field('social_media_links', 'option'); ?>
              <?php if (!empty($sm_links)): ?>
                <ul>
				<?php foreach ($sm_links as $sm_link): ?>
                  <li><a target="_blank" title="<?php echo ucwords(str_replace('_', ' ', $sm_link['network'])) ?>" href="<?php echo $sm_link['social_network_url'] ?>" class="fa-<?php echo $sm_link['network'] ?>" onclick="ga('send','social','<?php echo ucwords(str_replace('_', ' ', $sm_link['network'])) ?>','click','<?php echo $_SERVER['HTTP_HOST']; ?>')"><span class="sr-only"><?php echo ucwords(str_replace('_', ' ', $sm_link['network'])) ?></span></a></li>
                <?php endforeach ?>
                </ul>
              <?php endif ?>
        </div>
     </div>
  </div>
</footer>
