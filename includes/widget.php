<?php 
if( !class_exists('CI_Socials_Ignited') ):
class CI_Socials_Ignited extends WP_Widget {

	function CI_Socials_Ignited(){
		$widget_ops = array('description' => __('Social Icons widget placeholder','cisiw'));
		$control_ops = array('width' => 300, 'height' => 400);
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

		foreach($cisiw_options as $option => $value) 
		{ 
			// Make sure the current option is a social service
			if(substr($option, -4)=='_url')
			{	
				$key = str_replace('_url', '', $option);

				if(!empty($value))
				{
					$icon = 'images/'.$icon_set.'/'.$variation.'/'.$size.'/'.$key.'.png';
					
					if( file_exists( CISIW_PLUGIN_PATH.$icon ) )
					{
						$icon_url = CISIW_PLUGIN_URL.$icon;
						
						echo '<a href="'. esc_url($value) .'" '. $target .'><img align="middle" src="' . $icon_url . '"/></a>'."\n";
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
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'size'=>'32', 'icon_set'=>'square', 'variation'=>'default') );
		$title = htmlspecialchars($instance['title']);
		$icon_set = htmlspecialchars($instance['icon_set']);
		$variation = htmlspecialchars($instance['variation']);
		$size = intval($instance['size']);

		echo '<p>'.__('This widget is a placeholder for Social Media icons. You may configure those icons from <strong>Settings</strong> menu, <strong>Socials Ignited</strong> sub-menu, .', 'cisiw').'</p>';
		echo '<p><label>' . __('Title:', 'cisiw') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';
		?>
		

		<?php
			// The classes om <option> elements, are needed for the chained dropdown effect, 
			// and they must match the value="" of the element they are chained to.
		?>
		<p>
			<label><?php _e('Icon set:','cisiw'); ?></label>
			<select name="<?php echo $this->get_field_name('icon_set'); ?>" class="widefat" id="<?php echo $this->get_field_id('icon_set'); ?>">
				<option value="square" <?php selected('square', $icon_set); ?>><?php _ex('Square', 'icons set name', 'cisiw'); ?></option>
				<option value="round" <?php selected('round', $icon_set); ?>><?php _ex('Round', 'icons set name', 'cisiw'); ?></option>
			</select>
		</p>
		
		<p>
			<label><?php _e('Color Variation:','cisiw'); ?></label>
			<select name="<?php echo $this->get_field_name('variation'); ?>" class="widefat" id="<?php echo $this->get_field_id('variation'); ?>">
				<option class="square" value="default" <?php selected('default', $variation); ?>><?php _ex('Default', 'color variation name', 'cisiw'); ?></option>
				<option class="round" value="dark" <?php selected('dark', $variation); ?>><?php _ex('Dark', 'color variation name', 'cisiw'); ?></option>
				<option class="round" value="light" <?php selected('light', $variation); ?>><?php _ex('Light', 'color variation name', 'cisiw'); ?></option>
			</select>
		</p>
		
		<p>
			<label><?php _e('Icon Size:','cisiw'); ?></label>
			<select name="<?php echo $this->get_field_name('size'); ?>" class="widefat" id="<?php echo $this->get_field_id('size'); ?>">
				<option class="square round" value="32" <?php selected('32', $size); ?>><?php _e('32x32', 'cisiw'); ?></option>
				<option class="square" value="48" <?php selected('48', $size); ?>><?php _e('48x48', 'cisiw'); ?></option>
				<option class="square" value="64" <?php selected('64', $size); ?>><?php _e('64x64', 'cisiw'); ?></option>
			</select>
		</p>
		
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$("#<?php echo $this->get_field_id('variation'); ?>").chainedTo("#<?php echo $this->get_field_id('icon_set'); ?>");
				$("#<?php echo $this->get_field_id('size'); ?>").chainedTo("#<?php echo $this->get_field_id('icon_set'); ?>");
			});
		</script>

		<?
		
	} // form

} // class

function CI_SocialsIgnited_Action() {
	register_widget('CI_Socials_Ignited');
}
add_action('widgets_init', 'CI_SocialsIgnited_Action');

add_action('admin_enqueue_scripts', 'cisiw_widget_admin_scripts');
function cisiw_widget_admin_scripts()
{
	global $pagenow;
	
	if($pagenow=='widgets.php')
	{
		wp_enqueue_script('jquery-chained', CISIW_PLUGIN_URL.'js/jquery.chained.js', array('jquery'), '0.9.1' );
		wp_enqueue_script('cisiw-widget-admin', CISIW_PLUGIN_URL.'js/admin_widget.js', array('jquery-chained') );
	}
}

endif; //class_exists
?>