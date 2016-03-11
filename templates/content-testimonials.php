<div class="testimonials">
	 <?php
        $testimonials = get_field('testimonials',$testimonials_page_id);
        if($testimonials){
            shuffle( $testimonials );
            foreach($testimonials as $testimonial) {
                $testimonial_headshot = $testimonial['headshot'];
               
				echo "<div class=\"item\">";
				if ( is_page_template( 'home.php' ) ) {
                    echo '<h2>Testimonials</h2>';
                 }
				if( !empty($testimonial_headshot) ):
                    $url = $testimonial_headshot['url'];
                    $title = $testimonial_headshot['title'];
                    $alt = $testimonial_headshot['alt'];
                    $caption = $testimonial_headshot['caption'];
                                
                    // thumbnail
                    $size = 'thumbnail';
                    $thumb = $testimonial_headshot['sizes'][ $size ];
                    $width = $testimonial_headshot['sizes'][ $size . '-width' ];
                    $height = $testimonial_headshot['sizes'][ $size . '-height' ];
                                    
                    //print headshot
                    ?>
                    <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                    <?php
                 endif;
                 //print person's name
                 if ( !empty( $testimonial['name'] )):
                    echo "<div class=\"name\"><h2>";
                    echo $testimonial['name'];
                    echo "</h2></div>";
                 endif;
                                
                 //title
                 if ( !empty( $testimonial['business_title'] )):
                    echo "<div class=\"title\"><h3>";
                    echo $testimonial['business_title'];
                    echo "</h3></div>";
                 endif;

                 //company name
                 if ( !empty( $testimonial['company_name'] )):
                    echo "<div class=\"company-name\"><h3>";
                    echo $testimonial['company_name'];
                    echo "</h3></div>";
                 endif;

                 //involvement
                 if ( !empty( $testimonial['involvement'] )):
                    echo "<div class=\"involvement\"><h3>";
                    echo $testimonial['involvement'];
                    echo "</h3></div>";
                 endif;
                                
                 //print testimonial
                 if ( !empty( $testimonial['testimonial'] )):
                    echo "<div class=\"copy\">";
                    echo $testimonial['testimonial'];
                    echo "</div>";
                 endif;
				 
				  //close item
				  echo "</div>";	 
                                
                 //there is only space for 1 on homepage, so break after the one random was printed
                 //otherwise, keep going
                 if ( is_page_template( 'home.php' ) ) {
                    break;
                 }
           }
       }
    ?>
</div>