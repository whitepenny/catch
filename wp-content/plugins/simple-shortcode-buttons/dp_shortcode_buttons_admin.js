function addAttribute()
{
	var html = '<table><tbody>';

	html += '<tr>';
	html += '<td class="left-column">Attribute:</td>';
	html += '<td class="right-column"><input name="attributes[' + dps_nr_attributes + '][attribute]" size="35" value="">';
	html += '<i dpshint="hint-attr-name" class="dashicons dashicons-info hint-trigger"></i></td>';
	html += '</tr>';
	
	html += '<tr>';
	html += '<td class="left-column">Label:</td>';
	html += '<td class="right-column"><input name="attributes[' + dps_nr_attributes + '][label]" size="35" value="">';
	html += '<i dpshint="hint-attr-label" class="dashicons dashicons-info hint-trigger"></i></td>';
	html += '</tr>';

	html += '<tr>';
	html += '<td class="left-column">Values:</td>';
	html += '<td class="right-column"><input name="attributes[' + dps_nr_attributes + '][values]" size="35" value="">';
	html += '<i dpshint="hint-attr-values" class="dashicons dashicons-info hint-trigger"></i></td>';
	html += '</tr>';

	html += '<tr>';
	html += '<td class="left-column">Multi:</td>';
	html += '<td class="right-column">';
	
	html += '<select name="attributes[' + dps_nr_attributes + '][multi]">';
	html += '<option value="false" selected>No</option>';
	html += '<option value="true">Yes</option>';
	html += '</select><i dpshint="hint-attr-multi" class="dashicons dashicons-info hint-trigger"></i>';
	
	html += '</td>';
	html += '</tr>';

	html += '<tr>';
	html += '<td class="left-column">SQL:</td>';
	html += '<td class="right-column"><textarea cols="35" rows="5" name="attributes[' + dps_nr_attributes + '][sql]"></textarea>';
	html += '<i dpshint="hint-attr-sql" class="dashicons dashicons-info hint-trigger"></i></td>';
	html += '</tr>';
	
	html += '<tr>';
	html += '<td class="left-column"></td>';
	html += '<td class="right-column"><a href="#" class="remove_attr">Remove attribute</a></td>';
	html += '</tr>';			
	
	html += '</tbody></table>';
	
	dps_nr_attributes++;
	return html;
}

jQuery(document).ready(function($){
	window.restore_send_to_editor = window.send_to_editor;

	$('body').on('click', '.add_icon', function(e){
		e.preventDefault();

		// If the media frame already exists, reopen it.
		if ( typeof file_frame != 'undefined' ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: "Select your icon...",
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			var selection = file_frame.state().get('selection');	
			var priponke = selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				// Do something with attachment.id and/or attachment.url here
				
				console.log(attachment.url);
				$('.dps-icon-field').val(attachment.url);
				$('.img-wrap img').attr("src", attachment.url);
			});
		});

		// Finally, open the modal
		file_frame.open();
	});
	
	$('body').on('click', '.remove_icon', function(e){
		e.preventDefault();
		$('.dps-icon-field').val("");
		$('.img-wrap img').attr("src", DEFAULT_ICON);
	});	
	
	$('body').on('click', '.add_attr', function(e){
		e.preventDefault();
		$('.dps-attributes').append( addAttribute() );
	});
	
	$('body').on('click', '.remove_attr', function(e){
		e.preventDefault();
		$(this).parent().parent().parent().parent().remove();
	});	
	
	$('body').on('mouseenter', '.hint-trigger', function(){
		var offset = $(this).offset();
		var top = offset.top - $(window).scrollTop();	
		var left = offset.left - $(window).scrollLeft() + 30;	
		var id = $(this).attr("dpshint");
		
		console.log(id);

		$('.dps-hint-popup').html( $('.' + id).html() );
		$('.dps-hint-popup').css({ top: top, left: left, display: "block" });
	});	
	
	$('body').on('mouseleave', '.hint-trigger',function(){
		$('.dps-hint-popup').hide();
	});	
	
	$('.dps-sortable').sortable();
});