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

	var repeating_fields = $('.cisiw-repeating-fields');
	repeating_fields.each(function(){
		var add_field = $(this).find('.cisiw-repeating-add-field');
		add_field.click(function(){
			var repeatable_area = $(this).siblings('.inner');
			var fields = repeatable_area.children('.field-prototype').clone(true).removeClass('field-prototype').removeAttr('style').appendTo(repeatable_area);
			return false;
		});
	});

	$('body').on('click', '.cisiw-repeating-remove-field', function() {
		var field = $(this).parents('.post-field');
		field.remove();
		return false;
	});

});

_sortable = function( selector ) {
	if( selector === undefined ) {
		jQuery('.cisiw-repeating-fields .inner').sortable({ placeholder: 'ui-state-highlight' });
	} else {
		jQuery('.cisiw-repeating-fields .inner', selector).sortable({ placeholder: 'ui-state-highlight' });
	}
}
