<?php
/*

Plugin Name: Custom latest tweets
Plugin URI: http://www.cloudred.com
Description: A widget that displays your latest tweets
Version: 3.1
Author: Mark Southard - ThemeZilla / Customized by Cloudred for CYE
Author URI: http://www.themezilla.com
*/

require_once('twitteroauth.php');

class Twitter_Widget extends WP_Widget {

	private $zilla_twitter_oauth = array();

	/* Constructor */
	public function __construct() {
		parent::__construct(
			'zilla-twitter-widget',
			__('Custom latest tweets', 'sage'),
			array(
				'classname' => 'zilla-tweet-widget',
				'description' => __('A new widget that displays your latest tweets', 'sage')
			)
		);
	} // end constructor

	/**
	 * Output widget content
	 * 
	 * @param array args Array of form elements
	 * @param array instance Current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo '<div class="col-md-4 follow">';
		if ( $title ) { echo $before_title . $title . $after_title; }
		?>
         <a href="https://twitter.com/<?php echo $instance['username']; ?>" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @<?php echo $instance['username']; ?></a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<?php
		echo '</div>';
		//echo '<span>'.$instance['hashtags'].'</span>';
		$result = $this->getTweets($instance['username'], $instance['count'], $instance['hashtags']);
		
		echo '<div class="col-md-8">';
		echo '<ul>';
		
		$counter=0;
		$max_tweets=$instance['count'];
		//var_dump($result);
		if( $result && is_array($result) ) {
			foreach( $result as $tweet ) {
				$text = $this->linkify($tweet['text']);
				
				echo '<li>';
					echo '<div class="divider"></div>';
					echo '<p class="tweet-text">'.$text.'</p>';
					echo '<p><a class="twitter-time-stamp" href="http://twitter.com/' . $instance['username'] . '/status/' . $tweet['id'] . '">' . $tweet['timestamp'] . '</a></p>';
				echo '</li>';
				$counter++;
				if ($counter==$max_tweets) {
					break;
				}
			}
		} else {
			echo '<li>' . __('There was an error processing the Twitter feed.', 'sage') . '</li>';
		}

		echo '</ul>';
		echo '</div>';

		/*if( !empty($instance['hashtags']) ) {
			echo '<a class="twitter-link" href="http://twitter.com/' . $instance['username'] . '">' . $instance['hashtags'] . '</a>';
		}*/

		echo $after_widget;
	} // end widget

	/**
	 * Process widget's options to be saved
	 *
	 * @param array new_instance New instance of values to be generated via the update
	 * @param array old_instance Previous instance of values before update
	 *
	 * @return array $instance Saved instance values.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['hashtags'] = strip_tags( $new_instance['hashtags'] );

		return $instance;
	} // end update

	/**
	 * Outputs admin form for widget
	 *
	 * @param array $instance Array of keys and values for the widget
	 */
	public function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance
		);

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Latest Tweets',
			'username' => '',
			'count' => '2',
			'hashtags' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$access_token = get_option('ztw_access_token');
		$access_token_secret = get_option('ztw_access_token_secret');
		$consumer_key = get_option('ztw_consumer_key');
		$consumer_key_secret = get_option('ztw_consumer_secret');

		if( empty($access_token) || empty($access_token_secret) || empty($consumer_key) || empty($consumer_key_secret) ) {
			echo '<p><a href="options-general.php?page=zilla-twitter-widget-settings">Configure Twitter Widget</a></p>'; 
		} else {
		
			/* Build our form -----------------------------------------------------------*/
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sage') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter username, for example "cloudred," leave out the @ sign.', 'sage') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of tweets', 'sage') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
				<small><?php _e('Feeds include replies and retweets', 'sage'); ?></small>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'hashtags' ); ?>"><?php _e('Filter by hashtag(s) "#YouthWorkforce #OpenData," separate multiple hashtags with a space, leave blank for latest tweets.', 'sage') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'hashtags' ); ?>" name="<?php echo $this->get_field_name( 'hashtags' ); ?>" value="<?php echo $instance['hashtags']; ?>" />
			</p>
			
			<p><em><?php _e('Tweets are cached for 5 minutes to improve performance', 'sage'); ?></em></p>
<?php
		} // end if

	} // end form

	/**
	 * Returns tweets from a transient or calls our private oauth function to get the tweets, parses them,
	 * and sets a transient if needed.
	 * 
	 * @param string $username The username to be used
	 * @param string $count Number of tweets to be returned
	 * @return array of the tweets
	 */
	public function getTweets($username, $count, $hashtags) {
		$config = array();
		$config['username'] = $username;
		$config['count'] = $count;
		$config['hashtags'] = $hashtags;
		$config['access_token'] = get_option('ztw_access_token');
		$config['access_token_secret'] = get_option('ztw_access_token_secret');
		$config['consumer_key'] = get_option('ztw_consumer_key');
		$config['consumer_key_secret'] = get_option('ztw_consumer_secret');

		$transname = 'zilla_tw_' . $username . '_' . $count;

		$result = get_transient( $transname );
		if( !$result ) {
			$result = $this->oauthGetTweets($config);

			if( isset($result['errors']) ){
				$result = NULL; 
			} else {
				if (!empty($hashtags)) {
					$result = $this->parseTweets( $result, true );
				} else {
					$result = $this->parseTweets( $result, false );
				}
				set_transient( $transname, $result, 300 );
			}
		} else {
			if( is_string($result) )
				unserialize($result);
		}
		//print_r($config);
		return $result;
	}

	/**
	 * Get the tweets feed from Twitter API 1.1
	 *
	 * @param array $config 
	 * @return array $results
	 */
	private function oauthGetTweets($config) {
		if( empty($config['access_token']) ) 
			return array('error' => __('Not properly configured, check settings', 'sage'));		
		if( empty($config['access_token_secret']) ) 
			return array('error' => __('Not properly configured, check settings', 'sage'));
		if( empty($config['consumer_key']) ) 
			return array('error' => __('Not properly configured, check settings', 'sage'));		
		if( empty($config['consumer_key_secret']) ) 
			return array('error' => __('Not properly configured, check settings', 'sage'));		

		$options = array(
			'trim_user' => true,
			'exclude_replies' => false,
			'include_rts' => true,
			'count' => $config['count'],
			'screen_name' => $config['username'],
		);
		
		//search options array
		$search_options = array(
			//'q' => urlencode('from:'.$config['username'].' '.$config['hashtags'])
			//'q' => '%23YouthWorkforce+from:NYCMayorsFund'
			'q' => '%23'.str_replace(' ','+',$config['hashtags']).'+from:'.$config['username'].''
		);
		
		$connection = new TwitterOAuth($config['consumer_key'], $config['consumer_key_secret'], $config['access_token'], $config['access_token_secret']);
		//if no hashtag passed, get the user timeline
		if (empty($config['hashtags'])):
			$result = $connection->get('statuses/user_timeline', $options);
		else:
		//if hashtag(s) present, do a search
			$result = $connection->get('search/tweets', $search_options);
		endif;
		return $result;
	}

	/**
	 * Parse the tweets to the needed information
	 *
	 * @param array $results of the tweets to be parsed
	 * @return array parsed tweets with timestamp, text, and id
	 */
	public function parseTweets($results = array(), $hashtags) {
		$tweets = array();
		
		if ($hashtags) {
			//the result is a search query set
			$results_set = $results['statuses'];
		} else {
			//if false, it's a user timeline
			$results_set = $results;
		}
		
		foreach($results_set as $result) {
			$temp = explode(' ', $result['created_at']);
			$timestamp = $temp[2] . ' ' . $temp[1] . ' ' . $temp[5];

			$tweets[] = array(
				'timestamp' => $timestamp,
				'text' => filter_var($result['text'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
				'id' => $result['id_str']
			);
		}
		return $tweets;
	}

	/**
	 * Changes text to links
	 *
	 * @param string $text text to be linkified
	 * @return string linkified text 
	 */
	private function zilla_text_links($matches) {
		return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	}

	/**
	 * Changes text to links
	 *
	 * @param string $text text to be linkified
	 * @return string linkified text 
	 */
	private function zilla_username_link($matches) {
		return '<a href="http://twitter.com/' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	}
	/**
	 * Changes text to links
	 *
	 * @param string $text text to be linkified
	 * @return string linkified text 
	 */
	public function linkify($text) {
		// convert links
		$string = preg_replace_callback(
			"/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/",
			array(&$this, 'zilla_text_links'),
			$text
		);

		// convert @usernames
		$string = preg_replace_callback(
			'/@([A-Za-z0-9_]{1,15})/', 
			array(&$this, 'zilla_username_link'), 
			$string
		);

		return $string;
	}

} // end Twitter_Widget class

add_action( 'widgets_init', create_function( '', 'register_widget("Twitter_Widget");' ) );


/**
 * Twitter Widget Settings
 */
function Twitter_Widget_settings() {
	add_options_page(
		__('Twitter Widget Settings', 'sage'),
		__('Twitter Widget Settings', 'sage'),
		'manage_options',
		'zilla-twitter-widget-settings',
		'Twitter_Widget_render_admin_page'
	);
}

add_action( 'admin_menu', 'Twitter_Widget_settings' );

/**
 * Create settings for widget
 */
add_action('admin_init', 'zilla_tw_register_settings');

function zilla_tw_settings() {
	$ztw = array();
	$ztw[] = array('label' => 'Twitter Application Consumer Key', 'name' => 'ztw_consumer_key');
	$ztw[] = array('label' => 'Twitter Application Consumer Secret', 'name' => 'ztw_consumer_secret');
	$ztw[] = array('label' => 'Account Access Token', 'name' => 'ztw_access_token');
	$ztw[] = array('label' => 'Account Access Token Secret', 'name' => 'ztw_access_token_secret');

	return $ztw;
}

function zilla_tw_register_settings() {
	$settings = zilla_tw_settings();
	foreach($settings as $setting) {
		register_setting('zilla_tw_settings', $setting['name']);
	}
}

/**
 * Render Twitter widget settings page
 */
function Twitter_Widget_render_admin_page() {
	if( ! current_user_can('manage_options') ) {
		wp_die( __('Insufficient permissions', 'sage') );
	}

	$settings = zilla_tw_settings();

	echo '<div class="wrap">';
	 	screen_icon();
		echo '<h2>Twitter Widget Settings</h2>';
		echo '<form method="post" action="options.php">';
			echo '<p><strong>' . __('Twitter requires that you register an application in order to utilize their API. Directions to get the Consumer Key, Consumer Secret, Access Token, and Access Token Secret.', 'sage' ) . '</strong></p>';
			echo '<ol>';
				echo '<li><a href="https://dev.twitter.com/apps/new" target="_blank">' . __( 'Create a new Twitter application', 'sage' ) . '</a></li>';
				echo '<li>' . __( 'Fill in all fields on the create application page.', 'sage' ) . '</li>';
				echo '<li>' . __( 'Agree to rules, fill out captcha, and submit your application', 'sage' ) . '</li>';
				echo '<li>' . __( 'Copy the Consumer Key, Consumer Secret, Access Token, and Access Token Secret into the fields below', 'sage' ) . '</li>';
				echo '<li>' . __( "Click the Save Changes button at the bottom of this page" ) . '</li>';
			echo '</ol>';

			settings_fields('zilla_tw_settings');

			echo '<table>';
				foreach($settings as $setting) {
					echo '<tr>';
						echo '<td>' . $setting['label'] . '</td>';
						echo '<td><input type="text" style="width: 300px;" name="'.$setting['name'].'" value="'.get_option($setting['name']).'" /></td>';
					echo '</tr>';
				}
			echo '</table>';

			submit_button();

		echo '</form>';
	echo '</div>';

}

?>