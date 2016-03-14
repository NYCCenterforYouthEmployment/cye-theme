<?php
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