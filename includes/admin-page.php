<?php
if( !function_exists('cisiw_options_page') ):
function cisiw_options_page() {
	
	$cisiw_options = get_option('cisiw_settings');
	$cisiw_options = $cisiw_options !== false ? $cisiw_options : array();

	$services = cisiw_get_services();

	$cisiw_options['custom_css'] = empty($cisiw_options['custom_css']) ? '' : $cisiw_options['custom_css'];

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


	// Let's initialize the rest of the values.
	$cisiw_options['f_color'] = !empty($cisiw_options['f_color']) ? $cisiw_options['f_color'] : '#000000';
	$cisiw_options['f_size'] = !empty($cisiw_options['f_size']) ? $cisiw_options['f_size'] : 32;

	?>
	<div class="wrap">
		<?php echo sprintf( __('<h2>Socials Ignited</h2><h3>by <a href="%s">CSSIgniter</a></h3>', 'cisiw'), 'http://www.cssigniter.com' ); ?>
		<form method="post" action="options.php">
 			<?php settings_fields('cisiw_settings_group'); ?>

			<h3><?php _e('Font widget settings', 'cisiw'); ?></h3>
			<table class="form-table" id="cisiw-fontwidget-options">
				<tbody>
					<tr>
						<th scope="row"><label for="cisiw_settings[f_color]"><?php _e('Default color', 'cisiw'); ?></label></th>
						<td colspan="2">
							<input id="cisiw_settings[f_color]" type="text" name="cisiw_settings[f_color]" value="<?php echo esc_attr($cisiw_options['f_color']); ?>" class="colorpckr" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="cisiw_settings[f_size]"><?php _e('Default size', 'cisiw'); ?></label></th>
						<td colspan="2">
							<input id="cisiw_settings[f_size]" type="number" name="cisiw_settings[f_size]" value="<?php echo esc_attr($cisiw_options['f_size']); ?>" />
						</td>
					</tr>
<!--					<tr>-->
<!--						<th scope="row"><label for="cisiw_settings[custom_css]">--><?php //_e('Custom CSS', 'cisiw'); ?><!--</label></th>-->
<!--						<td>-->
<!--							<textarea id="cisiw_settings[custom_css]" name="cisiw_settings[custom_css]" rows="9" cols="80">--><?php //echo esc_textarea($cisiw_options['custom_css']); ?><!--</textarea>-->
<!--							--><?php
//								$sample_output = "<div class=\"widget_ci_socials_ignited widget\" id=\"ci_socials_ignited-6\">\n  <div class=\"ci-socials-ignited ci-socials-ignited-32\">\n    <a href=\"#\">\n      <img src=\"http://www.example.com/.../square/default/32/apple.png\">\n    </a>\n  </div>\n</div>";
//							?>
<!--						</td>-->
<!--						<td>-->
<!--							--><?php //_e('Sample widget HTML output:', 'cisiw'); ?>
<!--							<br>-->
<!--							<pre>--><?php //echo esc_html($sample_output); ?><!--</pre>-->
<!--						</td>-->
<!--					</tr>-->
					<tr>
						<td colspan="4">
							<p class="submit">
								<input type="submit" class="button-primary" value="<?php _e('Save Options', 'cisiw'); ?>" />
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			<p></p>

			<h3><?php _e('Image widget settings (deprecated)', 'cisiw'); ?></h3>
			<table class="form-table" id="cisiw-admin-options">
				<tbody>
					<tr>
						<th scope="row"><label for="cisiw_settings[new_window]"><?php _e('Open links in a new window?', 'cisiw'); ?></label></th>
						<td colspan="2">
							<input id="cisiw_settings[new_window]" type="checkbox" name="cisiw_settings[new_window]" value="1" <?php isset($cisiw_options['new_window']) ? checked(1, $cisiw_options['new_window']) : '' ; ?> />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="cisiw_settings[custom_css]"><?php _e('Custom CSS', 'cisiw'); ?></label></th>
						<td>
							<textarea id="cisiw_settings[custom_css]" name="cisiw_settings[custom_css]" rows="9" cols="80"><?php echo esc_textarea($cisiw_options['custom_css']); ?></textarea>
							<?php
								$sample_output = "<div class=\"widget_ci_socials_ignited widget\" id=\"ci_socials_ignited-6\">\n  <div class=\"ci-socials-ignited ci-socials-ignited-32\">\n    <a href=\"#\">\n      <img src=\"http://www.example.com/.../square/default/32/apple.png\">\n    </a>\n  </div>\n</div>";
							?>
						</td>
						<td>
							<?php _e('Sample widget HTML output:', 'cisiw'); ?>
							<br>
							<pre><?php echo esc_html($sample_output); ?></pre>
						</td>
					</tr>

				</tbody>
			</table>
			<p></p>
			<p class="description"><?php _e('Just enter the URL for each social service you want to display. Then go to Widgets and drag the Socials Ignited widget to the sidebar(s) that you want. You will be able to select the icon set and sizes for each instance. Please note that not all icons are available in each set.', 'cisiw'); ?></p>
			<p class="description"><?php _e('You may rearrange the services by grabbing a row from its empty area and dragging it to the desired position. Services without a URL will not be displayed.', 'cisiw'); ?></p>

			<table class="form-table" id="cisiw-admin-table">
				<thead>
					<tr>
						<?php 
							$icon_sets = cisiw_get_icon_sets();
							$icon_set_names = cisiw_get_icon_set_names();
							$lookup_paths = cisiw_get_lookup_paths();
							$icon_set_paths = cisiw_get_lookup_paths();
						?>
						
						<?php foreach($icon_sets as $key => $val): ?>
							<th scope="col" class="icon"><?php echo $icon_set_names[$key]; ?></th>
						<?php endforeach; ?>
						<th scope="col" class="iconname"><?php _ex('Service name', 'social service name', 'cisiw'); ?></th>
						<th scope="col" class="url"><?php _ex('Value', 'social service url value', 'cisiw'); ?></th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($user_set as $key => $value): ?>
						<?php $cisiw_url = $key . "_url"; ?>
						<tr valign="top">
							<?php foreach($icon_sets as $set => $set_info): ?>
								<td class="icon">
									<?php 
										// Let's get the first variation available so that we'll have
										// something to show on the settings screen.
										$first_variation = array_slice($set_info, 0, 1, true);

										// So, this will run only once per icon set.
										foreach($first_variation as $variation => $var_sizes)
										{
											if ($set == 'square' and $variation == 'default') {
												$icon = $set.'/'.$variation.'/'.$var_sizes[2].'/'.$key.'.png';
											}
											else {
												$icon = $set.'/'.$variation.'/'.$var_sizes[0].'/'.$key.'.png';
											}

											$icon_url = cisiw_get_icon_path($icon);

											if($icon_url===false)
											{
												$icon_url = CISIW_PLUGIN_URL.'images/placeholder.png';
											}

										}
									?>
									<img align="middle" width="32" height="32" src="<?php echo esc_url($icon_url); ?>" /> 
								</td>
							<?php endforeach; ?>

							<th scope="row" class="iconname"><strong><?php echo $services[$key]; ?></strong></th>

							<td class="url">
								<p>
									<input id="cisiw_settings[<?php echo $cisiw_url; ?>]" name="cisiw_settings[<?php echo $cisiw_url; ?>]" type="text" value="<?php if (isset($cisiw_options[$cisiw_url])) { echo esc_attr($cisiw_options[$cisiw_url]); } ?>"/>
									<?php if($key!='email'): ?>
										<label class="description" for="cisiw_settings[<?php echo $cisiw_url; ?>]"><?php _e('Enter your URL <em>(Include http://</em>)', 'cisiw'); ?></label>
									<?php endif; ?>		
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
								<input type="submit" value="<?php _e('Reset custom order', 'cisiw'); ?>" class="button" name="cisiw-reset-order">
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
	register_setting('cisiw_settings_group', 'cisiw_settings', 'cisiw_validate_settings');
}
endif;

if( !function_exists('cisiw_validate_settings') ):
function cisiw_validate_settings($input) {
	if(!empty($_POST['cisiw-reset-order']))
	{
		$services = cisiw_get_services();
		$cisiw_options = get_option('cisiw_settings');

		$defaults = array();
		foreach ($services as $service => $desc)	{
			$key = $service.'_url';
			$defaults[$key] = !empty($cisiw_options[$key]) ? $cisiw_options[$key] : '' ;
		}

		// Go through keys that are not in the list of services, e.g. "Open link in new window" setting.
		foreach ($cisiw_options as $key => $value)
		{
			if( !in_array($key, $services) )
			{
				$defaults[$key] = $value;
			}
		}

		return $defaults;
	}

	if(isset($input['f_color'])) $input['f_color'] = ci_sanitize_hex_color($input['f_color']);
	return $input;
}
endif;

add_action('admin_enqueue_scripts', 'cisiw_enqueue_admin_scripts');
if( !function_exists('cisiw_enqueue_admin_scripts') ):
function cisiw_enqueue_admin_scripts()
{
	global $pagenow;
	if($pagenow=='options-general.php' and isset($_GET['page']) and $_GET['page']=='cisiw-options')
	{
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );


		wp_enqueue_style('cisiw-admin', CISIW_PLUGIN_URL.'css/admin.css');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');

		wp_enqueue_script('cisiw-admin', CISIW_PLUGIN_URL.'js/admin.js');
	}
	
}
endif;

?>