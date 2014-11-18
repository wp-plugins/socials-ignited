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
	if($('div[id*="socials-ignited"]').length > 0) {

		$('div[id*="socials-ignited"] .ci-socials-ignited-fonticons').sortable();

		$('#wpbody').on('click', 'div[id*="socials-ignited"] .add-icon', function(e) {

			var fieldname = $(this).siblings('.hid_id').data('hidden-name');
			fieldname = fieldname + '[]';
			var field_icon = '<label>'+ cisiwWidget.icon_code +' <input type="text" class="widefat" name="' + fieldname + '" /></label>';
			var field_url = '<label>'+ cisiwWidget.icon_url +' <input type="text" class="widefat" value="http://" name="' + fieldname + '" /></label>';
			var field_title = '<label>'+ cisiwWidget.icon_title +' <input type="text" class="widefat" name="' + fieldname + '" /></label>';
			var field_hidden = '<input type="hidden" name="' + fieldname + '" />';
			var remove_btn = '<a class="ci-icon-remove button" href="#">' + cisiwWidget.icon_remove + '</a>';

			var html = '<div class="cisiw-icon">' + field_icon + field_url + field_title + field_hidden + remove_btn + '</div>';

			$(html).hide().appendTo( $(this).prev('.ci-socials-ignited-fonticons') ).fadeIn();

			$('div[id*="socials-ignited"] .ci-socials-ignited-fonticons').sortable({
				//callback
			});

			e.preventDefault();
		});
		$('#wpbody').on('click', 'div[id*="socials-ignited"] .ci-icon-remove', function(e) {
			$(this).parent('div.cisiw-icon').fadeOut(300, function() {
				$(this).remove();
			});

			e.preventDefault();
		});
	}

});


