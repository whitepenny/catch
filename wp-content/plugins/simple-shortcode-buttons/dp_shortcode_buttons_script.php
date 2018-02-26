<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>

function objType(obj)
{
	console.log(Object.prototype.toString.call( obj ) + " | " + obj);

	if (Object.prototype.toString.call( obj ) == "[object Array]")
		return "array";
		
	if (Object.prototype.toString.call( obj ) == "[object String]")
		return "string";
}

function insertShortcode()
{

}

function showPopup(ed, html, shortcode, enclosing)
{
	jQuery('.dp-shortcodes-popup').remove();
	jQuery('body').append(html);
	
	jQuery('.dp-shortcode-cancel').click(function(){
		jQuery('.dp-shortcodes-popup').remove();
	});
	
	jQuery('.dp-shortcode-insert').click(function(){
		console.log("shortcode: " + shortcode);
		var shortcodeStr = '[' + shortcode;
	
		jQuery.each( jQuery('.dp-shortcode-input'), function(index, value){
			var attribute = jQuery(this).data("attribute");
			var values = jQuery(this).val();
			
			if (objType(values) == "array")
				shortcodeStr += ' ' + attribute + '="' + values.join(",") + '"';
			else if (objType(values) == "string")
				shortcodeStr += ' ' + attribute + '="' + values + '"';
		});

		shortcodeStr += ']';
		
		if (enclosing)
		{
			shortcodeStr += jQuery('.dp-shortcodes-popup .body').val();
			shortcodeStr += '[/' + shortcode + ']';
		}
		
		ed.execCommand('mceInsertContent', 0, shortcodeStr);
		jQuery('.dp-shortcodes-popup').remove();
	});	
}

function addButtons(ed, url)
{
<?php 
	foreach($dp_shortcodes as $key => $item) // main shortcodes foreach (all defined in shortcodes.js)
	{ 	
		$image = (isset($item["icon"]) && strlen($item["icon"]) > 0) ? $item["icon"] : $url . "/wp-content/plugins/dp-shortcode-buttons/icon.png";
		$title = (isset($item["title"]) && strlen($item["title"]) > 0) ? $item["title"] : "Insert " . $key;
?>
	ed.addButton('<?php echo $key; ?>', {
		title : '<?php echo $title; ?>',
		cmd : '<?php echo $key; ?>',
		image : '<?php echo $image; ?>'
	});
	
	ed.addCommand('<?php echo $key; ?>', function(){
		<?php if (!isset($item["attributes"]) || sizeof($item["attributes"]) < 1) { ?>
		ed.execCommand('mceInsertContent', 0, '[<?php echo $key; ?>]') });
		<?php 
			continue; } 
		?>
		var popup = '';
		popup += '<div class="dp-shortcodes-popup">';
		popup += '<div class="inner">';
		popup += '<div class="title"><?php echo $title; ?></div>';
	
		<?php
		foreach($item["attributes"] as $attribute)
		{	
			if (!isset($attribute["attribute"]))
				continue; 

			if (isset($attribute["sql"]) && strlen($attribute["sql"]) > 0)
			{
				global $wpdb;
				$result = $wpdb->get_results(stripcslashes($attribute["sql"]), OBJECT);
				$multi = (isset($attribute["multi"]) && $attribute["multi"] === "true") ? "multiple" : "";
				?> 
				popup += '<div class="label"><?php echo $attribute["label"]; ?></div>'; 
				popup += '<select class="dp-shortcode-input" data-attribute="<?php echo $attribute["attribute"] ?>" <?php echo $multi; ?>>'; <?php
				foreach($result as $array_item)
				{
					?> popup += '<option value="<?php echo $array_item->value; ?>"><?php echo $array_item->label; ?></option>'; <?php		
				}
				?> popup += '</select>';<?php
			}
			else if (isset($attribute["values"]) && is_array($attribute["values"]))
			{
				$multi = (isset($attribute["multi"]) && $attribute["multi"] === "true") ? "multiple" : "";
				?> 
				popup += '<div class="label"><?php echo $attribute["label"]; ?></div>'; 
				popup += '<select class="dp-shortcode-input" data-attribute="<?php echo $attribute["attribute"] ?>" <?php echo $multi ?>>'; <?php
				foreach($attribute["values"] as $array_item)
				{
					?> popup += '<option value="<?php echo $array_item["value"]; ?>"><?php echo $array_item["value"]; ?></option>'; <?php		
				}
				?> popup += '</select>';<?php
			}
			else if (isset($attribute["values"]) && post_type_exists( $attribute["values"] ))
			{
				$multi = (isset($attribute["multi"]) && $attribute["multi"] === "true") ? "multiple" : "";
				?> 
				popup += '<div class="label"><?php echo $attribute["label"]; ?></div>';
				popup += '<select class="dp-shortcode-input" data-attribute="<?php echo $attribute["attribute"] ?>" <?php echo $multi ?>>'; <?php
				
				$args = array(
					'orderby'          => 'date',
					'order'            => 'DESC',
					'post_type'        => $attribute["values"],
					'post_status'      => 'publish',
					'posts_per_page'   => -1
				);

				$posts_array = get_posts( $args );

				foreach($posts_array as $array_item)
				{
					?> popup += '<option value="<?php echo $array_item->ID; ?>"><?php echo $array_item->post_title; ?></option>'; <?php		
				}
				?> popup += '</select>';<?php
			}
			else if (isset($attribute["values"]) && strpos($attribute["values"], ";") !== false)
			{
				$values = explode(";", $attribute["values"]);
				$multi = (isset($attribute["multi"]) && $attribute["multi"] === "true") ? "multiple" : "";
				?>
				popup += '<div class="label"><?php echo $attribute["label"]; ?></div>';
				popup += '<select class="dp-shortcode-input" data-attribute="<?php echo $attribute["attribute"] ?>" <?php echo $multi ?>>'; <?php

				foreach($values as $array_item)
				{
					$id = $array_item;
					$label = $array_item;
					if (strpos($array_item, "|") !== false)
					{
						$pair = explode("|", $array_item);
						$id = $pair[0];
						$label = isset($pair[1]) ? $pair[1] : "No label";
					}
					?> popup += '<option value="<?php echo $id; ?>"><?php echo $label; ?></option>'; <?php		
				}
				?> popup += '</select>';<?php
			}
			else
			{
				?> 
				popup += '<div class="label"><?php echo $attribute["label"]; ?></div>';
				popup += '<input class="dp-shortcode-input" type="text" data-attribute="<?php echo $attribute["attribute"] ?>">'; 
				<?php
			}
		}	
		?>
		
		<?php if (isset($item["body"]) && $item["body"] === "true"): ?>
		popup += '<div class="label">Shortcode content:</div>';
		popup += '<textarea class="body"></textarea>';
		<?php endif; ?>
			
		
		popup += '<div class="button-holder">';
		popup += '<div class="button button-primary dp-shortcode-cancel">Cancel</div>';
		popup += '<div class="button button-primary dp-shortcode-insert">Insert</div>';
		popup += '</div>';
		popup += '</div>';
		popup += '</div>';
<?php
		$enclosing = (isset($item["body"]) && $item["body"] === "true") ? "true" : "false";
?>
		console.log("add button <?php echo $key; ?>");
		showPopup(ed, popup, "<?php echo $key; ?>", <?php echo $enclosing; ?>);
	});
<?php } // end of main foreach ?>
}
