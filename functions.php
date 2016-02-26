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
<div class="col-sm-4" style="padding-top:12px;">
<label for="donation_amount">I am donating: $ </label>
</div>
<div class="col-sm-8">
<input type="number" class="donation-amount" value="" min="5" name="ssl_amount" id="donation_amount">
<p><input type="submit" value="Submit" class="button"></p>
</div></div>
</form>';
	return $donate_form;
}
function register_shortcodes(){
   add_shortcode('donate-form', 'donate_function');
}
add_action( 'init', 'register_shortcodes');