// Image widget
//jQuery(document).ready(function($) {
//	jQuery('"'+cisiw.var_id+'"').chainedTo('"'+cisiw.icon_id+'"');
//	jQuery('"'+cisiw.size_id+'"').chainedTo('"'+cisiw.icon_id+', '+cisiw.var_id+'"');
//});

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



	//Repeating icon fields
	if($('div[id*="ci_socials_ignited_fontawesome"]').length > 0) {

		$('div[id*="ci_socials_ignited_fontawesome"] .ci-socials-ignited-fonticons').sortable();

		$('#wpbody').on('click', 'div[id*="ci_socials_ignited_fontawesome"] .add-icon', function(e) {

			var fieldname = $(this).siblings('.hid_id').data('hidden-name');
			fieldname = fieldname + '[]';
			var field_icon = '<label>'+ cisiwWidget.icon_code +' <input type="text" class="widefat" name="' + fieldname + '" /></label>';
			var field_url = '<label>'+ cisiwWidget.icon_url +' <input type="text" class="widefat" name="' + fieldname + '" /></label>';
			var field_title = '<label>'+ cisiwWidget.icon_title +' <input type="text" class="widefat" name="' + fieldname + '" /></label>';
			var field_hidden = '<input type="hidden" name="' + fieldname + '" />';
			var remove_btn = '<a class="icon-remove" href="#">' + cisiwWidget.icon_remove + '</a>';

			var html = '<div class="cisiw-icon">' + field_icon + field_url + field_title + field_hidden + remove_btn + '</div>';

			$(html).hide().appendTo( $(this).prev('.ci-socials-ignited-fonticons') ).fadeIn();

			$('div[id*="ci_socials_ignited_fontawesome"] .ci-socials-ignited-fonticons').sortable({
				//update: renumberTracks
			});

			e.preventDefault();
		});
		$('#wpbody').on('click', 'div[id*="ci_socials_ignited_fontawesome"] .icon-remove', function(e) {
			$(this).parent('div.cisiw-icon').fadeOut(300, function() {
				$(this).remove();
			});

			e.preventDefault();
		});
	}

});


