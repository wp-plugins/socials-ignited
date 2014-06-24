// Image widget
//jQuery(document).ready(function($) {
//	jQuery('"'+cisiw.var_id+'"').chainedTo('"'+cisiw.icon_id+'"');
//	jQuery('"'+cisiw.size_id+'"').chainedTo('"'+cisiw.icon_id+', '+cisiw.var_id+'"');
//});

// Font widget
jQuery(document).ready(function($) {
	//
	// ColorPickers
	//
	if( typeof($.fn.ColorPicker) === 'function' ){
		$('.colorpckr').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#'+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		}).bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
	}

	if( typeof($.fn.wpColorPicker) === 'function' ){
		$('.colorpckr').wpColorPicker();
	}

});
