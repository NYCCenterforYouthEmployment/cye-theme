<?php if( is_page_template( 'partners.php' )): ?>
	<h2>Founding Partners</h2>
<?php endif; ?>
<ul class="partner-listing">
  <?php
       $partners = get_field('partner',$partners_page_id);
       $non_founding_partners = array();
       if($partners){
       		foreach($partners as $partner) {
            	$partner_name = $partner['partner_name'];
				$partner_status = $partner['partner_status'];
				$partner_link = $partner['partner_link'];
				$partner_logo = $partner['partner_logo'];
				//print if logo exists and this is a founding partner
				if( !empty($partner_logo) && !empty($partner_status)){
					include(locate_template('templates/partner-logo-list-item.php'));
                }
                if(empty($partner_status)){
					$non_founding_partners [] = $partner;
                }
			}
		}
	?>
</ul>
<?php if($non_founding_partners && is_page_template( 'partners.php' )): ?>
	<h2>Corporate Sponsors</h2>
	<ul class="partner-listing">
	  <?php
		foreach($non_founding_partners as $partner) {
			$partner_name = $partner['partner_name'];
			$partner_status = $partner['partner_status'];
			$partner_link = $partner['partner_link'];
			$partner_logo = $partner['partner_logo'];
			//print if logo exists and is not a founding partner
			if( !empty($partner_logo) ){
				include(locate_template('templates/partner-logo-list-item.php'));
			}
		}
		?>
	</ul>
<?php endif; ?>