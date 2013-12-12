<?php 
if( !class_exists('CI_Socials_Ignited') ):
class CI_Socials_Ignited extends WP_Widget {

	function CI_Socials_Ignited(){
		$widget_ops = array('description' => __('Social Icons widget placeholder','cisiw'));
		$control_ops = array(/*'width' => 300, 'height' => 400*/);
		parent::WP_Widget('ci_socials_ignited', $name='-= CI Socials Ignited =-', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = $instance['title'];
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
		$instance['title'] = htmlspecialchars($new_instance['title']);
		$instance['icon_set'] = htmlspecialchars($new_instance['icon_set']);
		$instance['variation'] = htmlspecialchars($new_instance['variation']);
		$instance['size'] = intval($new_instance['size']);
		return $instance;
	} // save
	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'size'=>32, 'icon_set'=>'square', 'variation'=>'default') );
		$title = htmlspecialchars($instance['title']);
		$icon_set = htmlspecialchars($instance['icon_set']);
		$variation = htmlspecialchars($instance['variation']);
		$size = intval($instance['size']);

		echo '<p>'.__('This widget is a placeholder for Social Media icons. You may configure those icons from <strong>Settings</strong> menu, <strong>Socials Ignited</strong> sub-menu, .', 'cisiw').'</p>';
		echo '<p><label>' . __('Title:', 'cisiw') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';
		?>
		

		<?php
			// The classes on <option> elements, are needed for the chained dropdown effect, 
			// and they must match the value="" of the element they are chained to.

			$icon_sets = cisiw_get_icon_sets();
			$icon_set_names = cisiw_get_icon_set_names();
			$icon_set_paths = cisiw_get_lookup_paths();
		?>
		<p>
			<label><?php _e('Icon set:', 'cisiw'); ?></label>
			<select name="<?php echo $this->get_field_name('icon_set'); ?>" class="widefat" id="<?php echo $this->get_field_id('icon_set'); ?>">
				<?php foreach($icon_set_names as $set => $name): ?>
					<option value="<?php echo $set; ?>" <?php selected($set, $icon_set); ?>><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label><?php _e('Color Variation:', 'cisiw'); ?></label>
			<select name="<?php echo $this->get_field_name('variation'); ?>" class="widefat" id="<?php echo $this->get_field_id('variation'); ?>">
				<?php foreach($icon_sets as $set => $variations): ?>
					<?php foreach($variations as $var => $sizes): ?>
						<option class="<?php echo $set; ?>" value="<?php echo $var; ?>" <?php selected($set.$var, $icon_set.$variation); ?>><?php echo $var; ?></option>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label><?php _e('Icon Size:', 'cisiw'); ?></label>
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
		
		<?php
			$var_id = '#'.$this->get_field_id('variation');
			$icon_id = '#'.$this->get_field_id('icon_set');
			$size_id = '#'.$this->get_field_id('size');
		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$("<?php echo $var_id; ?>").chainedTo("<?php echo $icon_id; ?>");
				$("<?php echo $size_id; ?>").chainedTo("<?php echo $icon_id; ?>, <?php echo $var_id; ?>");
			});
		</script>
		
		<?php
		
	} // form

} // class

function CI_SocialsIgnited_Action() {
	register_widget('CI_Socials_Ignited');
}
add_action('widgets_init', 'CI_SocialsIgnited_Action');

add_action('wp_enqueue_scripts', 'cisiw_widget_scripts');
function cisiw_widget_scripts()
{
	wp_enqueue_style('socials-ignited', CISIW_PLUGIN_URL.'css/style.css');
}

add_action('admin_enqueue_scripts', 'cisiw_widget_admin_scripts');
function cisiw_widget_admin_scripts()
{
	global $pagenow;
	
	if($pagenow=='widgets.php')
	{
		wp_enqueue_script('jquery-chained', CISIW_PLUGIN_URL.'js/jquery.chained.js', array('jquery'), '0.9.3' );
		wp_enqueue_script('cisiw-widget-admin', CISIW_PLUGIN_URL.'js/admin_widget.js', array('jquery-chained') );
	}
}

endif; //class_exists
?>