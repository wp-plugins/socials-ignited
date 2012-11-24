<?php
if( !function_exists('cisiw_options_page') ):
function cisiw_options_page() {
	
	$cisiw_options = get_option('cisiw_settings');
	$cisiw_options = $cisiw_options !== false ? $cisiw_options : array();

	$services = apply_filters('cisiw_services', array(
		'addthis'		=> _x('AddThis', 'website name', 'cisiw'),
		'amazon'		=> _x('Amazon', 'website name', 'cisiw'),
		'amazon_alt'	=> _x('Amazon (alternative icon)', 'website name', 'cisiw'),
		'apple'			=> _x('Apple', 'website name', 'cisiw'),
		'apple_alt'		=> _x('Apple (alternative icon)', 'website name', 'cisiw'),
		'blogger'		=> _x('Blogger', 'website name', 'cisiw'),
		'behance'		=> _x('Behance', 'website name', 'cisiw'),
		'delicious'		=> _x('Delicious', 'website name', 'cisiw'),
		'designfloat'	=> _x('Design Float', 'website name', 'cisiw'),
		'designbump'	=> _x('Design Bump', 'website name', 'cisiw'),
		'deviantart'	=> _x('DeviantArt', 'website name', 'cisiw'),
		'digg'			=> _x('Digg', 'website name', 'cisiw'),
		'dopplr'		=> _x('Dopplr', 'website name', 'cisiw'),
		'dribbble' 		=> _x('Dribbble', 'website name', 'cisiw'),
		'email'			=> _x('Email', 'website name', 'cisiw'),
		'evernote'		=> _x('Evernote', 'website name', 'cisiw'),
		'facebook' 		=> _x('Facebook', 'website name', 'cisiw'),
		'flickr' 		=> _x('Flickr', 'website name', 'cisiw'),
		'forrst'		=> _x('Forrst', 'website name', 'cisiw'),
		'friendfeed'	=> _x('FriendFeed', 'website name', 'cisiw'),
		'github'		=> _x('GitHub', 'website name', 'cisiw'),
		'github_alt'	=> _x('GitHub (alternative icon)', 'website name', 'cisiw'),
		'gplus' 		=> _x('Google+', 'website name', 'cisiw'),
		'grooveshark'	=> _x('Grooveshark', 'website name', 'cisiw'),
		'gtalk'			=> _x('Gtalk', 'website name', 'cisiw'),
		'instagram'		=> _x('Instagram', 'website name', 'cisiw'),
		'lastfm'		=> _x('LastFM', 'website name', 'cisiw'),
		'linkedin' 		=> _x('LinkedIn', 'website name', 'cisiw'),
		'myspace' 		=> _x('MySpace', 'website name', 'cisiw'),
		'netvibes'		=> _x('Netvibes', 'website name', 'cisiw'),
		'newsvine'		=> _x('Newsvine', 'website name', 'cisiw'),
		'orkut'			=> _x('Orkut', 'website name', 'cisiw'),
		'paypal'		=> _x('Paypal', 'website name', 'cisiw'),
		'picasa' 		=> _x('Picasa', 'website name', 'cisiw'),
		'pinterest' 	=> _x('Pinterest', 'website name', 'cisiw'),
		'posterous'		=> _x('Posterous', 'website name', 'cisiw'),
		'reddit'		=> _x('Reddit', 'website name', 'cisiw'),
		'rss'			=> _x('RSS', 'website name', 'cisiw'),
		'sharethis'		=> _x('ShareThis', 'website name', 'cisiw'),
		'skype'			=> _x('Skype', 'website name', 'cisiw'),
		'soundcloud'	=> _x('SoundCloud', 'website name', 'cisiw'),
		'spotify'		=> _x('Spotify', 'website name', 'cisiw'),
		'stumble'		=> _x('StumbleUpon', 'website name', 'cisiw'),
		'technorati'	=> _x('Technorati', 'website name', 'cisiw'),
		'tumblr'		=> _x('Tumblr', 'website name', 'cisiw'),
		'twitter' 		=> _x('Twitter', 'website name', 'cisiw'),
		'twitter_alt'	=> _x('Twitter (alternative icon)', 'website name', 'cisiw'),
		'viddler'		=> _x('Viddler', 'website name', 'cisiw'),
		'vimeo'			=> _x('Vimeo', 'website name', 'cisiw'),
		'virb'			=> _x('Virb', 'website name', 'cisiw'),
		'virb_alt'		=> _x('Virb (alternative icon)', 'website name', 'cisiw'),
		'yahoo'			=> _x('Yahoo', 'website name', 'cisiw'),
		'yahoo_alt'		=> _x('Yahoo (alternative icon)', 'website name', 'cisiw'),
		'youtube' 		=> _x('YouTube', 'website name', 'cisiw'),
		'youtube_alt' 	=> _x('YouTube (alternative icon)', 'website name', 'cisiw'),
		'windows'		=> _x('Windows', 'website name', 'cisiw'),
		'wordpress'		=> _x('WordPress', 'website name', 'cisiw'),
		'zerply'		=> _x('Zerply', 'website name', 'cisiw')
	));


	// Create default empty values for services.
	// It will be used to preserve user-ordering.
	$defaults = array();
	foreach($services as $service => $desc)	{ $defaults[$service]=''; }
	
	// Let's see what the user has stored. This order is significant.
	$user_set = array();
	foreach($cisiw_options as $url => $user_value) { 
		if(substr($url, -4)=='_url')
		{	
			$s = str_replace('_url', '', $url);
			if(array_key_exists($s, $services))
				$user_set[$s] = $user_value;
		}
	}
	
	// At this point we have a clean list of services, as current as the last save.
	// Let's check the (default) services against the user array, and add any newer services that may exist.
	foreach($defaults as $key => $value)
	{
		if( !array_key_exists($key, $user_set) )
			$user_set[$key] = $value;
	}
	// At this point we should have a complete, sorted and clean array of services and values.

	?>
	<div class="wrap">
		<div id="icon-plugins" class="icon32"><br /></div><h2>Socials Ignited</h2>
		<h3>by <a href="http://www.cssigniter.com">CSSIgniter</a></h3>
		<p class="description"><?php _e('Just enter the URL for each social service you want to display. Then go to Widgets and drag the Socials Ignited widget to the sidebar(s) that you want. You will be able to select the icon set and sizes for each instance. Please note that not all icons are available in each set.', 'cisiw'); ?></p>
		<p class="description"><?php _e('You may rearrange the services by grabbing a row from its empty area and dragging it to the desired position. Services without a URL will not be displayed.', 'cisiw'); ?></p>
		<form method="post" action="options.php">
 			<?php settings_fields('cisiw_settings_group'); ?>

			<table class="form-table">
				<thead>
					<tr>
						<th scope="row"><label for="cisiw_settings[new_window]"><?php _e('Open links in a new window?', 'cisiw'); ?></label></th>
						<td>
							<input id="cisiw_settings[new_window]" type="checkbox" name="cisiw_settings[new_window]" value="1" <?php isset($cisiw_options['new_window']) ? checked(1, $cisiw_options['new_window']) : '' ; ?> />
						</td>
					</tr>
				</thead>
			</table>
			<p></p>

			<table class="form-table" id="cisiw-admin-table">
				<thead>
					<tr>
						<th scope="col" class="icon"><?php _ex('Square', 'icons set name', 'cisiw'); ?></th>
						<th scope="col" class="icon"><?php _ex('Round', 'icons set name', 'cisiw'); ?></th>
						<th scope="col" class="iconname"><?php _ex('Service name', 'social service name', 'cisiw'); ?></th>
						<th scope="col" class="url"><?php _ex('Value', 'social service url value', 'cisiw'); ?></th>
					</tr>
				</thead>

				<tbody>

					<?php foreach($user_set as $key => $value): ?>
						<?php $cisiw_url = $key . "_url"; ?>
						<tr valign="top">
							<td class="icon">
								<?php 
									//
									// Square icon set
									//
									$icon = 'images/square/default/32/'.$key.'.png'; 
									if( file_exists( CISIW_PLUGIN_PATH.$icon ) )
										$icon_url = CISIW_PLUGIN_URL.$icon;
									else
										$icon_url = CISIW_PLUGIN_URL.'images/placeholder.png';
								?>
								<img align="middle" width="32" height="32" src="<?php echo esc_url($icon_url); ?>" /> 
							</td>

							<td class="icon">
								<?php 
									//
									// Round icon set
									//
									$icon = 'images/round/dark/32/'.$key.'.png'; 
									if( file_exists( CISIW_PLUGIN_PATH.$icon ) )
										$icon_url = CISIW_PLUGIN_URL.$icon;
									else
										$icon_url = CISIW_PLUGIN_URL.'images/placeholder.png';
								?>
								<img align="middle" width="32" height="32" src="<?php echo esc_url($icon_url); ?>" /> 
							</td>

							<th scope="row" class="iconname"><strong><?php echo $services[$key]; ?></strong></th>

							<td class="url">
								<p>
									<input id="cisiw_settings[<?php echo $cisiw_url; ?>]" name="cisiw_settings[<?php echo $cisiw_url; ?>]" type="text" value="<?php if (isset($cisiw_options[$cisiw_url])) { echo esc_attr($cisiw_options[$cisiw_url]); } ?>"/>
									<label class="description" for="cisiw_settings[<?php echo $cisiw_url; ?>]"><?php echo sprintf(__('Enter your %s URL <em>(Include http://</em>)', 'cisiw'), $value); ?></label>
									<?php 
										if($key=='rss')
										{
											if(function_exists('ci_rss_feed'))
												echo '<p>' . __('Recommended value:', 'cisiw') . ' <em>' . ci_rss_feed() . '</em></p>';
											else
												echo '<p>' . __('Recommended value:', 'cisiw') . ' <em>' . get_bloginfo('rss2_url') . '</em></p>';
										}
									?>
								</p>
							</td>
						</tr>
					<?php endforeach; ?>

					<tr>
						<td colspan="4">
							<p class="submit">
								<input type="submit" class="button-primary" value="<?php _e('Save Options', 'cisiw'); ?>" />
							</p>
						</td>	
					</tr>
					
				</tbody>
			</table>
 		</form>
	</div>
	<?php
}
endif;

add_action('admin_menu', 'cisiw_add_options_link');
if( !function_exists('cisiw_add_options_link') ):
function cisiw_add_options_link() {
	add_options_page(__('Socials Ignited Widget Options', 'cisiw'), _x('Socials Ignited', 'plugin name', 'cisiw'), 'manage_options', 'cisiw-options', 'cisiw_options_page');
}
endif;

add_action('admin_init', 'cisiw_register_settings');
if( !function_exists('cisiw_register_settings') ):
function cisiw_register_settings() {
	register_setting('cisiw_settings_group', 'cisiw_settings');
}
endif;

add_action('admin_enqueue_scripts', 'cisiw_enqueue_admin_scripts');
if( !function_exists('cisiw_enqueue_admin_scripts') ):
function cisiw_enqueue_admin_scripts()
{
	global $pagenow;
	
	if($pagenow=='options-general.php' and isset($_GET['page']) and $_GET['page']=='cisiw-options')
	{
		wp_enqueue_style('cisiw-admin', CISIW_PLUGIN_URL.'css/admin.css');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');

		wp_enqueue_script('cisiw-admin', CISIW_PLUGIN_URL.'js/admin.js');
	}
	
}
endif;

?>