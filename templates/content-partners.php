<ul class="partner-listing">
  <?php
       $partners = get_field('partner',$partners_page_id);
       if($partners){
       		shuffle( $partners );
       		foreach($partners as $partner) {
            	$partner_name = $partner['partner_name'];
				$partner_status = $partner['partner_status'];
				$partner_link = $partner['partner_link'];
				$partner_logo = $partner['partner_logo'];
				//print if logo exists and this is a founding partner
				if( !empty($partner_logo) && $partner_status ):
                	$url = $partner_logo['url'];
                    $title = $partner_logo['title'];
                    $alt = $partner_logo['alt'];
                    $caption = $partner_logo['caption'];
                           
                    // thumbnail
                    $size = 'thumbnail';
                    $thumb = $partner_logo['sizes'][ $size ];
                    $width = $partner_logo['sizes'][ $size . '-width' ];
                    $height = $partner_logo['sizes'][ $size . '-height' ];
                    //print logo
					?>
                    <li>
    					<?php if (!empty($partner_link)): ?>
    						<a href="<?php echo $partner_link; ?>" target="_blank">
    					<?php endif; ?>
    					<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
    					<?php if (!empty($partner_link)): ?>
    						</a>
    					<?php endif; ?>
  					</li>
  				<?php
                   endif;
				}
			}
        ?>
</ul>
