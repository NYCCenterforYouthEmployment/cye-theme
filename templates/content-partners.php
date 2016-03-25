<?php if( is_page_template( 'partners.php' )): ?>
	<h2><?php echo __('Founding Partners', 'sage'); ?></h2>
<?php endif; ?>
<ul class="partner-listing">
  <?php
       $partners = get_field('partner',$partners_page_id);
       $non_founding_partners = array();
	   $city_agency_partners = array();
       if($partners){
       		foreach($partners as $partner) {
            	$partner_name = $partner['partner_name'];
				$partner_type = $partner['partner_type'];
				$partner_status = $partner['partner_status'];
				$partner_link = $partner['partner_link'];
				$partner_logo = $partner['partner_logo'];
				//print if logo exists and this is a founding partner
				if( !empty($partner_logo) && !empty($partner_status)){
					include(locate_template('templates/partner-logo-list-item.php'));
                }
                if(empty($partner_status) && $partner_type == 'key-funder'){
					$non_founding_partners [] = $partner;
                }
				if($partner_type == 'city-agency'){
					$city_agency_partners [] = $partner;
				}
			}
		}
	?>
</ul>
<?php if($non_founding_partners && is_page_template( 'partners.php' )): ?>
	<h2><?php echo __('Key Funder and Employer Partners', 'sage'); ?></h2>
	<ul class="partner-listing">
	  <?php
		foreach($non_founding_partners as $partner) {
			$partner_name = $partner['partner_name'];
			$partner_status = $partner['partner_status'];
			$partner_link = $partner['partner_link'];
			$partner_logo = $partner['partner_logo'];
			//print if logo exists
			if( !empty($partner_logo) ){
				include(locate_template('templates/partner-logo-list-item.php'));
			}
		}
		?>
	</ul>
<?php endif; ?>

<?php if($city_agency_partners && is_page_template( 'partners.php' )): ?>
	<h2><?php echo __('City Agency Partners', 'sage'); ?></h2>
	<ul class="partner-listing">
	  <?php
		foreach($city_agency_partners as $partner) {
			$partner_name = $partner['partner_name'];
			$partner_status = $partner['partner_status'];
			$partner_link = $partner['partner_link'];
			$partner_logo = $partner['partner_logo'];
			//print if logo exists
			if( !empty($partner_logo) ){
				include(locate_template('templates/partner-logo-list-item.php'));
			}
		}
		?>
	</ul>
<?php endif; ?>