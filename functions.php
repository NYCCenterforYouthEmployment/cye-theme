<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

//include twitter widget files
require_once('includes/widgets/widget-tweets.php');

//options page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Social media',
		'menu_title'	=> 'Social media',
		'menu_slug' 	=> 'social-media',
	));
}

//Donate form shortcode
function donate_function() {
	$donate_form='<form action="https://www.myvirtualmerchant.com/VirtualMerchant/process.do" method="post" id="form-donation-form" class="fund-donation-form">
<input type="hidden" value="false" name="ssl_test_mode">
<input type="hidden" value="mayorsfund" name="fundName" id="fundName">
<input type="hidden" value="NZDHIPYDK1E3MTYMQ1Z88DSDERFOT3RX55ZJZ4AC7JNDT1UGDIMTUF21RT6BSPAP" name="ssl_pin">
<input type="hidden" value="641156" name="ssl_merchant_id">
<input type="hidden" value="webpage" name="ssl_user_id">
<input type="hidden" value="CCSALE" name="ssl_transaction_type">
<input type="hidden" value="The Center for Youth Employment" name="ssl_description">
<input type="hidden" value="HTML" name="ssl_result_format">
<input type="hidden" value="http://www1.nyc.gov/site/fund/about/about.page" name="ssl_receipt_link_url">
<div class="row">
<div class="col-sm-3" style="padding-top:12px;">
<label for="donation_amount">I am donating: $ </label>
</div>
<div class="col-sm-9">
<input type="number" class="donation-amount" value="" min="5" name="ssl_amount" id="donation_amount">
<p><input type="submit" value="Submit" class="button"></p>
</div></div>
</form>';
	return $donate_form;
}

//register the shortcode for the documents
function docs_function() {
	global $post;
   	$docs = get_field('documents',$post->ID);
	$output="";
	if( $docs ): 
		foreach( $docs as $doc ):
			$doc_params = $doc['document_file'];
			// vars
			$url = $doc_params['url'];
			$title = $doc_params['title'];
			$caption = $doc_params['caption'];
			
			$output = '<div class="doc-container">';
				$output .= '<div class="row">';
					$output .= '<div class="col-xs-2">';
						$output .= '<i class="fa fa-file-text-o"></i>';
					$output .= '</div>';
					$output .= '<div class="col-xs-10">';
						$output .= '<h3><a href="'.$url.'">'.$title.'</a></h3>';
						$output .= '<span>'.$caption.'</span>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		endforeach;
	endif;
	return $output; 
}


function register_shortcodes(){
   add_shortcode('donate-form', 'donate_function');
   add_shortcode('docs', 'docs_function');
}
add_action( 'init', 'register_shortcodes');

//change the default WP login screen logo
function my_login_logo() { ?>
    <style type="text/css">
        #login {
			width:50%;
		}
		.login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/images/logo_en.png);
            padding-bottom: 30px;
			background-size:100% auto;
			width:340px;
			height:45px;
        }
		@media (max-width: 768px) {
		  #login { width:100%;}
		  .login h1 a {
		  	width:240px;
		  }
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//remove WP version from header
remove_action('wp_head', 'wp_generator');


/********************************************
/* Adding open graph sharing meta tags *****/
add_action('wp_head','hook_meta');
function hook_meta() {
	global $post;
	$featured_img_url = get_stylesheet_directory_uri().'/dist/images/cye-on-facebook.jpg';
	$output='<meta property="og:type" content="blog">';
	$output.='<meta property="og:site_name" content="'.get_bloginfo("name").'">';
	//if single post or page, use the content of the post
	if (is_single()) {
		//check if feartued image is set
		$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
		if( $featured ) {
			$featured_img_url = $featured[0];
		} 
		$output.='<meta property="og:title" content="'.get_the_title($post->ID).'">';
		$output.='<meta property="og:url" content="'.get_post_permalink($post->ID).'">';
		$output.='<meta property="og:image" content="'.$featured_img_url.'">';
		$output.='<meta property="og:description" content="'.substr(strip_tags(get_post($post->ID)->post_content),0,157).'...">';
	} else {
	//otherwise show general blog description and image
		$output.='<meta property="og:title" content="'.get_bloginfo("name").'">';
		$output.='<meta property="og:url" content="'.get_bloginfo("url").'">';
		$output.='<meta property="og:image" content="'.$featured_img_url.'">';
		$output.='<meta property="og:description" content="'.get_bloginfo("description").'">';
	}
	
	echo $output;
}

/* END meta tags ****************************/