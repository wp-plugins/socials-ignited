<?php 
//
// Font widget
//
if( !class_exists('CI_Socials_Ignited_FontAwesome') ):
class CI_Socials_Ignited_FontAwesome extends WP_Widget {

	function CI_Socials_Ignited_FontAwesome(){
		$widget_ops = array('description' => __('Social Icons widget, FontAwesome edition','cisiw'));
		$control_ops = array(/*'width' => 300, 'height' => 400*/);
		parent::WP_Widget('ci_socials_ignited_fontawesome', $name='-= CI Socials Ignited =-', $widget_ops, $control_ops);
		add_action('wp_enqueue_scripts', array($this, 'enqueue_css'));
	}

	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$new_win = $instance['new_win']=='on' ? ' target="_blank" ' : '';
		$icons = !empty($instance['icons']) ? $instance['icons'] : array();


		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;

		echo '<div class="ci-socials-ignited-fa">';

		if( !empty($icons) )
		{
			for( $i = 0; $i < count($icons); $i+=3 )
			{

				$code = esc_attr($icons[$i]);
				$url = esc_url($icons[$i + 1]);
				$title = esc_attr($icons[$i + 2]);
				$title = !empty($title) ? ' title="'.$title.'" ' : '';

				echo '<a href="'.$url.'" '.$new_win.'><i class="fa '.$code.'" '.$title.'></i></a>';
			}
		}

		echo "</div>";

		echo $after_widget;

	} // widget

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['color'] = ci_sanitize_hex_color($new_instance['color']);
		$instance['size'] = absint_or_empty($new_instance['size']);
		$instance['new_win'] = ci_sanitize_checkbox($new_instance['new_win']);
		$instance['icons'] = is_array( $new_instance['icons'] ) ? $new_instance['icons'] : array();
		return $instance;
	} // save

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title'   => '',
			'color'   => '',
			'size'    => '',
			'new_win' => '',
			'icons'   => array()
		));
		extract($instance);

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cisiw'); ?></label><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" class="widefat" /></p>
		<p><label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color:', 'cisiw'); ?></label><input id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php echo esc_attr($color); ?>" class="colorpckr widefat" /></p>
		<p><label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:', 'cisiw'); ?></label><input id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="number" value="<?php echo esc_attr($size); ?>" class="widefat" /></p>
		<p><label><input id="<?php echo $this->get_field_id('new_win'); ?>" name="<?php echo $this->get_field_name('new_win'); ?>" type="checkbox" value="on" <?php checked('on', $new_win); ?> /><?php _e('Open in new window', 'cisiw'); ?></label></p>
		<span class="hid_id" data-hidden-name="<?php echo $this->get_field_name('icons'); ?>"></span><?php

		echo '<div class="icons ci-socials-ignited-fonticons">';
		if (!empty($icons) and (count($icons) > 0))
		{
			for( $i = 0; $i < count($icons); $i+=3 )
			{
				?>
				<div class="cisiw-icon">
					<label><?php _e('Icon code:', 'ci_theme'); ?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('icons'); ?>[]" value="<?php echo esc_attr($icons[$i]); ?>" /></label>
					<label><?php _e('Link URL:', 'ci_theme'); ?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('icons'); ?>[]" value="<?php echo esc_attr($icons[$i+1]); ?>" /></label>
					<label><?php _e('Title text (optional):', 'ci_theme'); ?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('icons'); ?>[]" value="<?php echo esc_attr($icons[$i+2]); ?>" /></label>
					<a class="icon-remove" href="#"><?php _e('Remove icon...', 'ci_theme'); ?></a>
				</div>
				<?php
			}
		}
		echo '</div>';

		?><a class="button add-icon" href="#"><?php _e('Add Icon', 'ci_theme'); ?></a><?php

	} // form

	function enqueue_css()
	{
		$instance = $this->get_settings();
		$instance = $instance[$this->number];
		$cisiw_options = get_option('cisiw_settings');
		$cisiw_options = $cisiw_options !== false ? $cisiw_options : array();

		$color = !empty($instance['color']) ? $instance['color'] : $cisiw_options['f_color'];
		$size = !empty($instance['size']) ? $instance['size'] : $cisiw_options['f_size'];

		$widget_style = '#'.$this->id.' a { color: '.$color.'; font-size: '.$size.'px;  }';
		wp_add_inline_style('socials-ignited', $widget_style);

	}
} // class

function CI_SocialsIgnited_FontAwesome_Action() {
	register_widget('CI_Socials_Ignited_FontAwesome');
}
add_action('widgets_init', 'CI_SocialsIgnited_FontAwesome_Action');

endif; //class_exists





//
// Image widget
//
if( !class_exists('CI_Socials_Ignited') ):
class CI_Socials_Ignited extends WP_Widget {

	function CI_Socials_Ignited(){
		$widget_ops = array('description' => __('Social Icons widget placeholder (deprecated)','cisiw'));
		$control_ops = array(/*'width' => 300, 'height' => 400*/);
		parent::WP_Widget('ci_socials_ignited', $name='Socials Ignited (deprecated)', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$icon_set = isset($instance['icon_set']) ? $instance['icon_set'] : 'square';
		$variation = isset($instance['variation']) ? $instance['variation'] : 'default';
		$size = isset($instance['size']) ? $instance['size'] : '32';
		
		$cisiw_options = get_option('cisiw_settings');
		$cisiw_options = $cisiw_options !== false ? $cisiw_options : array();

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		
		$new_window = "";
		$target = "";
		
		if (!empty($cisiw_options['new_window']) and $cisiw_options['new_window']==1)
			$new_window = true;

		if ($new_window)
			$target = "target='_blank'";
		
		echo '<div class="ci-socials-ignited ci-socials-ignited-'. esc_attr($size) .'">';

		$names = cisiw_get_services();

		foreach($cisiw_options as $option => $value) 
		{ 
			// Make sure the current option is a social service
			if(substr($option, -4)=='_url')
			{	
				$key = str_replace('_url', '', $option);

				if(!empty($value))
				{
					$icon = $icon_set.'/'.$variation.'/'.$size.'/'.$key.'.png';

					$icon_url = cisiw_get_icon_path($icon);
	
					if($icon_url!==false)
					{
						echo '<a href="'. esc_url($value) .'" '. $target .'><img alt="' . $names[$key] . '" src="' . $icon_url . '"/></a>'."\n";
					}

				}
			}
		}

		echo "</div>";

		echo $after_widget;
	} // widget

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['icon_set'] = sanitize_key($new_instance['icon_set']);
		$instance['variation'] = sanitize_key($new_instance['variation']);
		$instance['size'] = sanitize_key($new_instance['size']);
		return $instance;
	} // save
	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'size' => 32,
			'icon_set' => 'square',
			'variation' => 'default'
		));
		extract($instance);

		echo '<p>'.__('This widget is now deprecated and it will be removed ina future plugin update. Please use the <strong>-= CI Socials Ignited =-</strong> widget instead.', 'cisiw').'</p>';
		echo '<p>'.__('This widget is a placeholder for Social Media icons. You may configure those icons from <strong>Settings</strong> menu, <strong>Socials Ignited</strong> sub-menu.', 'cisiw').'</p>';
		echo '<p><label for="'.$this->get_field_id('title').'">' . __('Title:', 'cisiw') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';
		?>
		

		<?php
			// The classes on <option> elements, are needed for the chained dropdown effect, 
			// and they must match the value="" of the element they are chained to.

			$icon_sets = cisiw_get_icon_sets();
			$icon_set_names = cisiw_get_icon_set_names();
			$icon_set_paths = cisiw_get_lookup_paths();
		?>
		<p>
			<label for="<?php echo $this->get_field_id('icon_set'); ?>"><?php _e('Icon set:', 'cisiw'); ?></label>
			<select name="<?php echo $this->get_field_name('icon_set'); ?>" class="widefat" id="<?php echo $this->get_field_id('icon_set'); ?>">
				<?php foreach($icon_set_names as $set => $name): ?>
					<option value="<?php echo $set; ?>" <?php selected($set, $icon_set); ?>><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<?php if($this->number != '__i__'): ?>
			<p>
				<label for="<?php echo $this->get_field_id('variation'); ?>"><?php _e('Color Variation:', 'cisiw'); ?></label>
				<select name="<?php echo $this->get_field_name('variation'); ?>" class="widefat" id="<?php echo $this->get_field_id('variation'); ?>">
					<?php foreach($icon_sets as $set => $variations): ?>
						<?php foreach($variations as $var => $sizes): ?>
							<option class="<?php echo $set; ?>" value="<?php echo $var; ?>" <?php selected($set.$var, $icon_set.$variation); ?>><?php echo $var; ?></option>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Icon Size:', 'cisiw'); ?></label>
				<select name="<?php echo $this->get_field_name('size'); ?>" class="widefat" id="<?php echo $this->get_field_id('size'); ?>">
					<?php foreach($icon_sets as $set => $variations): ?>
						<?php foreach($variations as $var => $sizes): ?>
							<?php foreach($sizes as $s): ?>
								<option class="<?php echo $set.'\\'.$var; ?>" value="<?php echo $s; ?>" <?php selected($set.$var.$s, $icon_set.$variation.$size); ?>><?php echo $s.'x'.$s; ?></option>
							<?php endforeach; ?>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</select>
			</p>
		<?php else: ?>
			<p><?php _e('Please save the widget first, in order to be able to choose more options.', 'cisiw'); ?></p>
		<?php endif; ?>
		<?php
			$var_id = '#'.$this->get_field_id('variation');
			$icon_id = '#'.$this->get_field_id('icon_set');
			$size_id = '#'.$this->get_field_id('size');
		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				jQuery("<?php echo $var_id; ?>").chainedTo("<?php echo $icon_id; ?>");
				jQuery("<?php echo $size_id; ?>").chainedTo("<?php echo $icon_id; ?>, <?php echo $var_id; ?>");
			});
		</script>

		<?php
		
	} // form

} // class

function CI_SocialsIgnited_Action() {
	register_widget('CI_Socials_Ignited');
}
add_action('widgets_init', 'CI_SocialsIgnited_Action');

endif; //class_exists





add_action('wp_enqueue_scripts', 'cisiw_widget_scripts');
function cisiw_widget_scripts()
{
	if(is_active_widget('', '', 'ci_socials_ignited_fontawesome'))
	{
		wp_enqueue_style('font-awesome', CISIW_PLUGIN_URL.'css/font-awesome.css', array(), '4.1.0');
	}

	wp_enqueue_style('socials-ignited', CISIW_PLUGIN_URL.'css/style.css');

	$cisiw_options = get_option('cisiw_settings');
	if( !empty( $cisiw_options['custom_css'] ) )
	{
		wp_add_inline_style('socials-ignited', $cisiw_options['custom_css']);
	}
}

add_action('admin_enqueue_scripts', 'cisiw_widget_admin_scripts');
function cisiw_widget_admin_scripts()
{
	global $pagenow;

	if( in_array($pagenow, array('widgets.php', 'customize.php')) )
	{
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script('jquery-chained', CISIW_PLUGIN_URL.'js/jquery.chained.js', array('jquery'), '0.9.10' );
		wp_enqueue_script('cisiw-widget-admin', CISIW_PLUGIN_URL.'js/admin_widget.js', array('jquery-chained') );
		wp_enqueue_style('cisiw-widget-admin', CISIW_PLUGIN_URL.'css/admin_widget.css');

		$params['icon_code'] = __('Icon code:', 'cisiw');
		$params['icon_title'] = __('Title text (optional):', 'cisiw');
		$params['icon_url'] = __('Link URL:', 'cisiw');
		$params['icon_remove'] = __('Remove icon...', 'cisiw');
		wp_localize_script('cisiw-widget-admin', 'cisiwWidget', $params);
	}
}
?>