// Font widget
jQuery(document).ready(function($){
	function ciPicker(){
		var ciColorPicker = $('#widgets-right .colorpckr, #wp_inactive_widgets .colorpckr');
		ciColorPicker.each(function(){
			$(this).wpColorPicker();
		});
	}

	ciPicker();

	$(document).ajaxSuccess(function(e, xhr, settings) {
		if(settings.data.search('action=save-widget') != -1 ) {
			ciPicker();
		}
	});


	_sortable();

	$('body').on('click', '.cisiw-repeating-add-field', function() {
		var repeatable_area = $(this).siblings('.inner');
		var fields = repeatable_area.children('.field-prototype').clone(true).removeClass('field-prototype').removeAttr('style').appendTo(repeatable_area);
		_sortable();
		return false;
	});

	$('body').on('click', '.cisiw-repeating-remove-field', function() {
		var field = $(this).parents('.post-field');
		field.remove();
		return false;
	});

	// Widget Actions on Save
	$(document).ajaxSuccess(function(e, xhr, options){
		if( options.data.search( 'action=save-widget' ) != -1 ) {
			var widget_id;

			if( ( widget_id = options.data.match( /widget-id=(socials-ignited-\d+)/ ) ) !== null ) {
				var widget = $("input[name='widget-id'][value='" + widget_id[1] + "']").parent();
				_sortable( widget );
			}

		}

	});

});

_sortable = function( selector ) {
	if( selector === undefined ) {
		jQuery('.cisiw-repeating-fields .inner').sortable({ placeholder: 'ui-state-highlight' });
	} else {
		jQuery('.cisiw-repeating-fields .inner', selector).sortable({ placeholder: 'ui-state-highlight' });
	}
}
