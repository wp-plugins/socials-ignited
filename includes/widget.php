<?php 
//
// Font widget
//
if( !class_exists('Socials_Ignited_Widget') ):
class Socials_Ignited_Widget extends WP_Widget {

	function Socials_Ignited_Widget() {
		$widget_ops = array(
			'description' => __( 'Social Icons widget, FontAwesome edition', 'cisiw' ),
			'classname'   => 'widget_socials_ignited'
		);
		$control_ops = array(/*'width' => 300, 'height' => 400*/);
		parent::WP_Widget('socials-ignited', $name='-= CI Socials Ignited =-', $widget_ops, $control_ops);
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_css'));
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$new_win  = $instance['new_win'] == 'on' ? 'target="_blank"' : '';
		$nofollow = $instance['nofollow'] == 'on' ? 'rel="nofollow"' : '';
		$icons    = ! empty( $instance['icons'] ) ? $instance['icons'] : array();
		$icons    = $this->convert_repeating_icons_from_unnamed( $icons );

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo '<div class="ci-socials-ignited ci-socials-ignited-fa">';

		if ( ! empty( $icons ) ) {
			foreach( $icons as $field ) {
				echo sprintf( '<a href="%s" %s %s %s><i class="fa %s"></i></a>',
					esc_url( $field['url'] ),
					$new_win,
					$nofollow,
					! empty( $field['title'] ) ? sprintf( 'title="%s"',	esc_attr( $field['title'] ) ) : '',
					esc_attr( $field['icon'] )
				);
			}
		}

		echo "</div>";

		echo $after_widget;

	} // widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']            = sanitize_text_field( $new_instance['title'] );
		$instance['color']            = cisiw_sanitize_hex_color( $new_instance['color'] );
		$instance['background_color'] = cisiw_sanitize_hex_color( $new_instance['background_color'] );
		$instance['size']             = cisiw_absint_or_empty( $new_instance['size'] );
		$instance['background_size']  = cisiw_absint_or_empty( $new_instance['background_size'] );
		$instance['border_radius']    = cisiw_absint_or_empty( $new_instance['border_radius'] );
		$instance['opacity']          = round( floatval( $new_instance['opacity'] ), 1 );
		$instance['new_win']          = cisiw_sanitize_checkbox( $new_instance['new_win'] );
		$instance['nofollow']         = cisiw_sanitize_checkbox( $new_instance['nofollow'] );
		$instance['icons']            = $this->sanitize_repeating_icons( $new_instance );

		return $instance;
	} // save

	function form($instance){
		$cisiw = get_option('cisiw_settings');
		$cisiw = $cisiw !== false ? $cisiw : array();

		$instance = wp_parse_args( (array) $instance, array(
			'title'            => '',
			'color'            => isset( $cisiw['f_color'] ) ? $cisiw['f_color'] : '',
			'background_color' => isset( $cisiw['f_background_color'] ) ? $cisiw['f_background_color'] : '',
			'border_radius'    => isset( $cisiw['f_border_radius'] ) ? $cisiw['f_border_radius'] : 50,
			'size'             => isset( $cisiw['f_size'] ) ? $cisiw['f_size'] : 17,
			'background_size'  => isset( $cisiw['f_background_size'] ) ? $cisiw['f_background_size'] : 30,
			'opacity'          => isset( $cisiw['f_opacity'] ) ? $cisiw['f_opacity'] : 1,
			'new_win'          => '',
			'nofollow'         => '',
			'icons'            => array()
		) );
		extract( $instance );

		?>
		<p class="cisiw-icon-instructions"><small><?php echo sprintf(__('To add icons click on "Add Icon" at the bottom of the widget and then insert the <em>Icon code</em> and its <em>Link URL</em>. Icon codes can be found <a target="_blank" href="%s">here</a>, type them exactly as they are shown (with fa- in front), e.g. <strong>fa-facebook</strong>. You can also drag and drop the boxes to rearrange the icons.', 'cisiw'), 'http://fontawesome.io/icons/#brand'); ?></small></p>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'cisiw' ); ?></label><input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat"/></p>
		<p><label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Icon Color:', 'cisiw' ); ?></label><input id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" type="text" value="<?php echo esc_attr( $color ); ?>" class="colorpckr widefat"/></p>
		<p><label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Icon Background Color:', 'cisiw' ); ?></label><input id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" type="text" value="<?php echo esc_attr( $background_color ); ?>" class="colorpckr widefat"/></p>
		<p><label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Icon Size (single integer in pixels):', 'cisiw' ); ?></label><input id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" type="number" value="<?php echo esc_attr( $size ); ?>" class="widefat"/></p>
		<p><label for="<?php echo $this->get_field_id( 'background_size' ); ?>"><?php _e( 'Background Size (single integer in pixels):', 'cisiw' ); ?></label><input id="<?php echo $this->get_field_id( 'background_size' ); ?>" name="<?php echo $this->get_field_name( 'background_size' ); ?>" type="number" value="<?php echo esc_attr( $background_size ); ?>" class="widefat"/></p>
		<p><label for="<?php echo $this->get_field_id( 'border_radius' ); ?>"><?php _e( 'Border Radius (single integer in pixels):', 'cisiw' ); ?></label><input id="<?php echo $this->get_field_id( 'border_radius' ); ?>" name="<?php echo $this->get_field_name( 'border_radius' ); ?>" type="number" value="<?php echo esc_attr( $border_radius ); ?>" class="widefat"/></p>
		<p><label for="<?php echo $this->get_field_id( 'opacity' ); ?>"><?php _e( 'Opacity (0.1 up to 1):', 'cisiw' ); ?></label><input id="<?php echo $this->get_field_id( 'opacity' ); ?>" name="<?php echo $this->get_field_name( 'opacity' ); ?>" type="number" min="0.1" max="1" step="0.1" value="<?php echo esc_attr( $opacity ); ?>" class="widefat"/></p>
		<p><label><input id="<?php echo $this->get_field_id( 'new_win' ); ?>" name="<?php echo $this->get_field_name( 'new_win' ); ?>" type="checkbox" value="on" <?php checked( 'on', $new_win ); ?> /> <?php _e( 'Open in new window.', 'cisiw' ); ?></label></p>
		<p><label><input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" type="checkbox" value="on" <?php checked( 'on', $nofollow ); ?> /> <?php _e( 'Add <code>rel="nofollow"</code> to links.', 'cisiw' ); ?></label></p>

		<span class="hid_id" data-hidden-name="<?php echo $this->get_field_name('icons'); ?>"></span><?php

		?>
		<fieldset class="cisiw-repeating-fields">
			<div class="inner">
				<?php
					$icons = $this->convert_repeating_icons_from_unnamed( $icons );
					if ( ! empty( $icons ) ) {
						foreach ( $icons as $field ) {
							?>
							<div class="post-field">
								<label><?php _e( 'Icon Code:', 'cisiw' ); ?> <input type="text" name="<?php echo $this->get_field_name( 'icon_code' ); ?>[]" value="<?php echo esc_attr( $field['icon'] ); ?>" class="widefat"/></label>
								<label><?php _e( 'Link URL:', 'cisiw' ); ?> <input type="text" name="<?php echo $this->get_field_name( 'icon_url' ); ?>[]" value="<?php echo esc_url( $field['url'] ); ?>" class="widefat"/></label>
								<label><?php _e( 'Title text (optional):', 'cisiw' ); ?> <input type="text" name="<?php echo $this->get_field_name( 'icon_title' ); ?>[]" value="<?php echo esc_attr( $field['title'] ); ?>" class="widefat"/></label>
								<p class="cisiw-repeating-remove-action"><a href="#" class="button cisiw-repeating-remove-field"><i class="dashicons dashicons-dismiss"></i><?php _e( 'Remove me', 'ci_theme' ); ?></a></p>
							</div>
							<?php
						}
					}
				?>
				<div class="post-field field-prototype" style="display: none;">
					<label><?php _e( 'Icon Code:', 'cisiw' ); ?> <input type="text" name="<?php echo $this->get_field_name( 'icon_code' ); ?>[]" value="" class="widefat"/></label>
					<label><?php _e( 'Link URL:', 'cisiw' ); ?> <input type="text" name="<?php echo $this->get_field_name( 'icon_url' ); ?>[]" value="" class="widefat"/></label>
					<label><?php _e( 'Title text (optional):', 'cisiw' ); ?> <input type="text" name="<?php echo $this->get_field_name( 'icon_title' ); ?>[]" value="" class="widefat"/></label>
					<p class="cisiw-repeating-remove-action"><a href="#" class="button cisiw-repeating-remove-field"><i class="dashicons dashicons-dismiss"></i><?php _e( 'Remove me', 'ci_theme' ); ?></a></p>
				</div>
			</div>
			<a href="#" class="cisiw-repeating-add-field button"><i class="dashicons dashicons-plus-alt"></i><?php _e('Add Field', 'ci_theme'); ?></a>
		</fieldset>
		<?php
	} // form

	function enqueue_css() {
		$settings = $this->get_settings();

		if ( empty( $settings ) ) {
			return;
		}

		foreach ( $settings as $instance_id => $instance ) {
			$id = $this->id_base . '-' . $instance_id;

			if ( ! is_active_widget( false, $id, $this->id_base ) ) {
				continue;
			}

			$color            = $instance['color'];
			$background_color = $instance['background_color'];
			$size             = $instance['size'];
			$background_size  = $instance['background_size'];
			$border_radius    = $instance['border_radius'];
			$opacity          = $instance['opacity'];

			$css          = '';
			$css_hover    = '';
			$widget_style = '';

			if ( ! empty( $color ) ) {
				$css .= 'color: ' . $color . '; ';
			}
			if ( ! empty( $background_color ) ) {
				$css .= 'background: ' . $background_color . '; ';
			}
			if ( ! empty( $size ) ) {
				$css .= 'font-size: ' . $size . 'px; ';
			}
			if ( ! empty( $background_size ) ) {
				$css .= 'width: ' . $background_size . 'px; ';
				$css .= 'height: ' . $background_size . 'px; ';
				$css .= 'line-height: ' . $background_size . 'px; ';
			}
			if ( ! empty( $border_radius ) ) {
				$css .= 'border-radius: ' . $border_radius . 'px; ';
			}
			if ( ! empty( $opacity ) ) {
				$css .= 'opacity: ' . $opacity . '; ';
				if ( $opacity < 1 ) {
					$css_hover = '#' . $id . ' a:hover i { opacity: 1; }' . PHP_EOL;
				}
			}

			if ( ! empty( $css ) ) {
				$css          = '#' . $id . ' i { ' . $css . ' } ' . PHP_EOL;
				$widget_style = $css . $css_hover;
				wp_add_inline_style( 'socials-ignited', $widget_style );
			}

		}

	}

	function sanitize_repeating_icons( $POST_array ) {
		if ( empty( $POST_array ) || !is_array( $POST_array ) ) {
			return array();
		}

		$codes     = $POST_array['icon_code'];
		$urls      = $POST_array['icon_url'];
		$titles    = $POST_array['icon_title'];

		$count = max(
			count( $codes ),
			count( $urls ),
			count( $titles )
		);

		$new_fields = array();

		$records_count = 0;

		for ( $i = 0; $i < $count; $i ++ ) {
			if ( empty( $codes[ $i ] ) && empty( $urls[ $i ] ) ) {
				continue;
			}

			$new_fields[ $records_count ]['icon']     = sanitize_key( $codes[ $i ] );
			$new_fields[ $records_count ]['url']      = esc_url_raw( $urls[ $i ] );
			$new_fields[ $records_count ]['title']    = sanitize_text_field( $titles[ $i ] );

			$records_count++;
		}
		return $new_fields;
	}

	function convert_repeating_icons_from_unnamed( $fields ) {

		// This array must match the order of the old numeric parameters, e.g. [0] will map to 'title', etc.
		$names = array( 'icon', 'url', 'title', 'reserved_field' );

		if( ! is_array( $fields ) ) {
			return $fields;
		}

		$first_value = reset( $fields );

		if( ! is_array( $first_value ) && !empty( $fields ) ) {
			$new_fields = array();

			for( $t = 0; $t < count( $fields ); $t += count( $names ) ) {
				$new_icon = array();

				for( $tf = 0; $tf < count( $names ); $tf++ ) {
					if( isset( $fields[ $t + $tf ] ) ) {
						$new_icon[ $names[ $tf ] ] = $fields[ $t + $tf ];
					}
				}
				unset( $new_icon['reserved_field'] );
				$new_fields[] = $new_icon;
			}
			$fields = $new_fields;
		}

		return $fields;
	}

} // class

function CI_SocialsIgnited_FontAwesome_Action() {
	register_widget( 'Socials_Ignited_Widget' );
}

add_action( 'widgets_init', 'CI_SocialsIgnited_FontAwesome_Action' );

endif; //class_exists





//
// Image widget
//
if( !class_exists('CI_Socials_Ignited') ):
class CI_Socials_Ignited extends WP_Widget {

	function CI_Socials_Ignited(){
		$widget_ops  = array( 'description' => __( 'Social Icons widget placeholder (deprecated)', 'cisiw' ) );
		$control_ops = array(/*'width' => 300, 'height' => 400*/ );
		parent::WP_Widget('ci_socials_ignited', $name='Socials Ignited (deprecated)', $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title     = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$icon_set  = isset( $instance['icon_set'] ) ? $instance['icon_set'] : 'square';
		$variation = isset( $instance['variation'] ) ? $instance['variation'] : 'default';
		$size      = isset( $instance['size'] ) ? $instance['size'] : '32';
		
		$cisiw_options = get_option('cisiw_settings');
		$cisiw_options = $cisiw_options !== false ? $cisiw_options : array();

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$new_window = '';
		$target     = '';

		if ( ! empty( $cisiw_options['new_window'] ) and $cisiw_options['new_window'] == 1 ) {
			$new_window = true;
		}

		if ( $new_window ) {
			$target = "target='_blank'";
		}

		echo '<div class="ci-socials-ignited ci-socials-ignited-' . esc_attr( $size ) . '">';

		$names = cisiw_get_services();

		foreach ( $cisiw_options as $option => $value ) {
			// Make sure the current option is a social service
			if ( substr( $option, - 4 ) == '_url' ) {
				$key = str_replace( '_url', '', $option );

				if ( ! empty( $value ) ) {
					$icon = $icon_set . '/' . $variation . '/' . $size . '/' . $key . '.png';

					$icon_url = cisiw_get_icon_path( $icon );

					if ( $icon_url !== false ) {
						echo '<a href="' . esc_url( $value ) . '" ' . $target . '><img alt="' . $names[ $key ] . '" src="' . $icon_url . '"/></a>' . "\n";
					}

				}
			}
		}

		echo "</div>";

		echo $after_widget;
	} // widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['icon_set']  = sanitize_key( $new_instance['icon_set'] );
		$instance['variation'] = sanitize_key( $new_instance['variation'] );
		$instance['size']      = sanitize_key( $new_instance['size'] );

		return $instance;
	} // save

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'     => '',
			'size'      => 32,
			'icon_set'  => 'square',
			'variation' => 'default'
		) );
		extract($instance);

		echo '<p>'.__('This widget is now deprecated and it will be removed in a future plugin update (v2.0). Please use the <strong>-= CI Socials Ignited =-</strong> widget instead.', 'cisiw').'</p>';
		echo '<p>'.__('This widget is a placeholder for Social Media icons. You may configure those icons from <strong>Settings</strong> menu, <strong>Socials Ignited</strong> sub-menu.', 'cisiw').'</p>';
		echo '<p><label for="'.$this->get_field_id('title').'">' . __('Title:', 'cisiw') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" class="widefat" /></p>';
		?>
		

		<?php
			// The classes on <option> elements, are needed for the chained dropdown effect, 
			// and they must match the value="" of the element they are chained to.

			$icon_sets      = cisiw_get_icon_sets();
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
			$var_id  = '#' . $this->get_field_id( 'variation' );
			$icon_id = '#' . $this->get_field_id( 'icon_set' );
			$size_id = '#' . $this->get_field_id( 'size' );
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
	register_widget( 'CI_Socials_Ignited' );
}

add_action( 'widgets_init', 'CI_SocialsIgnited_Action' );

endif; //class_exists

add_filter( 'kses_allowed_protocols', 'cisiw_kses_allowed_protocols' );
function cisiw_kses_allowed_protocols( $protocols ) {
	if ( ! in_array( 'skype', $protocols ) ) {
		$protocols[] = 'skype';
	}

	return $protocols;
}


add_action('wp_enqueue_scripts', 'cisiw_widget_scripts');
function cisiw_widget_scripts() {
	if ( is_active_widget( '', '', 'socials-ignited' ) ) {
		wp_deregister_style( 'font-awesome' );
		wp_enqueue_style( 'font-awesome', CISIW_PLUGIN_URL . 'css/font-awesome.css', array(), '4.3.0' );
	}

	wp_enqueue_style( 'socials-ignited', CISIW_PLUGIN_URL . 'css/style.css' );

	$cisiw_options = get_option( 'cisiw_settings' );
	if ( ! empty( $cisiw_options['custom_css'] ) ) {
		wp_add_inline_style( 'socials-ignited', $cisiw_options['custom_css'] );
	}
}

add_action('admin_enqueue_scripts', 'cisiw_widget_admin_scripts');
function cisiw_widget_admin_scripts() {
	global $pagenow;

	if ( in_array( $pagenow, array( 'widgets.php', 'customize.php' ) ) ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-chained', CISIW_PLUGIN_URL . 'js/jquery.chained.js', array( 'jquery' ), '0.9.10' );
		wp_enqueue_script( 'cisiw-widget-admin', CISIW_PLUGIN_URL . 'js/admin_widget.js', array( 'jquery-chained' ) );
		wp_enqueue_style( 'cisiw-repeating-fields', CISIW_PLUGIN_URL . 'css/repeating-fields.css' );
		wp_enqueue_style( 'cisiw-widget-admin', CISIW_PLUGIN_URL . 'css/admin_widget.css' );
	}
}
?>