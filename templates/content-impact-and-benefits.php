<div class="row impact-and-benefits">
    <div class="impact-and-benefits-content clearfix">
        <ul class="stats">
			<?php if ( is_page_template( 'home.php' ) ) : ?>
				<li>
                <h2><?php echo get_the_title($impact_benefits_page_id); ?></h2>
				<p style="padding-right:15px;"><?php echo get_field('impact_and_benfits_subtitle',$impact_benefits_page_id); ?></p>
				<a href="<?php echo esc_url( get_permalink($impact_benefits_page_id) ); ?>" class="button"><?php _e( 'Get more facts', 'sage' ); ?></a>
                </li>
            <?php endif; ?>
       		
			<?php 
    
                $facts = get_field('facts',$impact_benefits_page_id);
                if($facts){
                    shuffle( $facts );
                    //if this is a homepage, there only space for 2, so count and stop after 2 have been printed
                    $counter=0;
                    if ( is_page_template( 'home.php' ) ) {
                        $max_facts = 2;
                    } else {
                        $max_facts = 999;
                    }
                   foreach($facts as $fact) {
                        $statistic = $fact['statistic'];
                        $statistic_description = $fact['statistic_description'];
                        $source = $fact['source'];
                        
                       
							echo "<li>";
                            echo "<div class=\"divider\"></div>";
                            echo "<div class=\"statistic\">";
                                echo $statistic;
                            echo "</div>";
                            echo "<div class=\"statistic_description\">";
                                echo $statistic_description;
                            echo "</div>";
                            echo "<div class=\"source\">";
                                echo $source;
                            echo "</div>";
							echo "</li>";
                        
                        $counter++;
                        if ($counter==$max_facts) {
                            break;
                        }
                    }
                }
                
            ?>
          </ul>  
     </div>
</div>