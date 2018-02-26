<?php
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	function dps_sort()
	{
		global $dp_shortcodes;

		if (!isset($_POST["order"])) return false;
		
		$aSort = array();
		foreach($_POST["order"] as $item)
			$aSort[ $item ] = $dp_shortcodes[ $item ];
	
		$dp_shortcodes = $aSort;
		update_option("dps_shortcodes", json_encode($dp_shortcodes));
		header("Location: ?page=dpshortcodes&tab=sort");	
	}
	
	function dps_draw_shortcode($item, $key)
	{
		$image = (isset($item["icon"]) && strlen($item["icon"]) > 0) ? $item["icon"] : plugin_dir_url(__FILE__) . "icon.png";

		echo '<div class="postbox dp-shortcode-item">'; // item
		echo '<h3>'.$key.'<a class="dps-edit" href="?page=dpshortcodes&tab=edit&id='.$key.'"><i class="dashicons dashicons-edit"></i></a>';
		
		if ( !shortcode_exists( $key ) )
			echo ' <span class="dps-doesnt-exist">(Shortcode does not exist)</span>';
		
		echo '<a title="Delete button" class="dps-delete" href="?page=dpshortcodes&noheader=true&delete='.$key.'"><i class="dashicons dashicons-trash"></i></a></h3>';
		echo '<div class="inside">'; // inside
		
		echo '<table class="dps-item-icon">';
		echo '<tr>';		// icon
		echo '<td class="left-column">Icon:</td>';
		echo '<td class="right-column"><span class="img-wrap"><img src="'.$image.'"></span></td>';
		echo '</tr>';		// eo-icon
		echo '<tr>';		// title
		echo '<td>Title:</td>';
		echo '<td class="right-column">'.$item["title"].'</td>';
		echo '</tr>';		// eo-title
		
		echo '<tr>';
		echo '<td class="left-column">Enclosing shortcode:</td>';
		$multiS = (isset($item["body"]) && $item["body"] === "true") ? "Yes" : "No";
		echo '<td class="right-column">'.$multiS.'</td>';
		echo '</tr>';		
	
		if (sizeof($item["attributes"]))
		{
			echo '<tr>';		// attributes
			echo '<td colspan="2">';
			echo '<div class="dps-attributes">';
			echo '<div class="dps-attr-title">Attributes</div>';
		
			foreach($item["attributes"] as $attr)
			{
				echo '<table>';
			
				echo '<tr>';
				echo '<td class="left-column">Attribute:</td>';
				echo '<td class="right-column">'.$attr["attribute"].'</td>';
				echo '</tr>';
				
				echo '<tr>';
				echo '<td class="left-column">Label:</td>';
				echo '<td class="right-column">'.$attr["label"].'</td>';
				echo '</tr>';

				echo '<tr>';
				echo '<td class="left-column">Values:</td>';
				echo '<td class="right-column">'.$attr["values"].'</td>';
				echo '</tr>';

				echo '<tr>';
				echo '<td class="left-column">Multi:</td>';
				$multiS = (isset($attr["multi"]) && $attr["multi"] === "true") ? "Yes" : "No";
				echo '<td class="right-column">'.$multiS.'</td>';
				echo '</tr>';

				echo '<tr>';
				echo '<td class="left-column">SQL:</td>';
				echo '<td class="right-column">'.stripcslashes($attr["sql"]).'</td>';
				echo '</tr>';
				
				echo '</table>';
			}
		}

		echo '</div>';
		echo '</td>';
		echo '</tr>';		// eo-attributes	
		echo '</table>';

		echo '</div>'; // eo-inside
		echo '</div>'; // eo-item
	}
	
	function dps_add_shortcode()
	{
		$image = plugin_dir_url(__FILE__) . "icon.png";
	
		echo '<div class="postbox dp-shortcode-item">'; // item
		echo '<h3>Shortcode: <input name="key" value=""></a>';

		echo '</h3>';
		echo '<div class="inside">'; // inside
		
		echo '<table class="dps-item-icon">';
		echo '<tr>';		// icon
		echo '<td class="left-column">Icon:</td>';
		echo '<td class="right-column"><span class="img-wrap"><img src="'.$image.'"></span><br>
			<a class="add_icon" href="#">Change icon</a>
			<a class="remove_icon" href="#">Remove icon</a>
			<input type="hidden" name="icon" class="dps-icon-field" value="'.$image.'">
		</td>';
		echo '</tr>';		// eo-icon
		echo '<tr>';		// title
		echo '<td>Title:</td>';
		echo '<td class="right-column"><input name="title" size="35" value="">
			<i dpshint="hint-title" class="dashicons dashicons-info hint-trigger"></i></td>';
		echo '</tr>';		// eo-title
		
		echo '<tr>';  // body
		echo '<td class="left-column">Enclosing shortcode:</td>';
		echo '<td class="right-column">';
		
		echo '<select name="body">';
		echo '<option value="false" selected>No</option>';
		echo '<option value="true">Yes</option>';
		echo '</select>';
		
		echo '</td>';
		echo '</tr>';	// eo-body	
		
		echo '<tr>';		// attributes
		echo '<td colspan="2">';
		echo '<div class="dps-attributes">';
		echo '<div class="dps-attr-title">Attributes</div>';
		echo '<div class="dps-attr-new"><a href="#" class="add_attr">Add new attribute</a></div>';
		
		echo '</div>';
		echo '</td>';
		echo '</tr>';		// eo-attributes	
		echo '</table>';

		echo '</div>'; // eo-inside
		echo '</div>'; // eo-item		
	}
	
	function dps_edit_shortcode($item, $key)
	{
		$image = (isset($item["icon"]) && strlen($item["icon"]) > 0) ? $item["icon"] : plugin_dir_url(__FILE__) . "icon.png";

		echo '<div class="postbox dp-shortcode-item">'; // item
		echo '<h3>Shortcode: <input name="key" value="'.$key.'"></a>';
		
		if ( !shortcode_exists( $key ) )
			echo ' <span class="dps-doesnt-exist">(Shortcode does not exist)</span>';
		
		echo '</h3>';
		echo '<div class="inside">'; // inside
		
		echo '<table class="dps-item-icon">';
		echo '<tr>';		// icon
		echo '<td class="left-column">Icon:</td>';
		echo '<td class="right-column"><span class="img-wrap"><img src="'.$image.'"></span><br>
			<a class="add_icon" href="#">Change icon</a>
			<a class="remove_icon" href="#">Remove icon</a>
			<input type="hidden" name="icon" class="dps-icon-field" value="'.$image.'">
		</td>';
		echo '</tr>';		// eo-icon
		echo '<tr>';		// title
		echo '<td>Title:</td>';
		echo '<td class="right-column"><input name="title" size="35" value="'.$item["title"].'">
			<i dpshint="hint-title" class="dashicons dashicons-info hint-trigger"></i></td>';
		echo '</tr>';		// eo-title
		
		echo '<tr>';  // body
		echo '<td class="left-column">Enclosing shortcode:</td>';
		echo '<td class="right-column">';
		
		echo '<select name="body">';
		if ($item["body"] === "true") echo '<option value="false">No</option>';
		else echo '<option value="false" selected>No</option>';
		
		if ($item["body"] === "true") echo '<option selected value="true">Yes</option>';
		else echo '<option value="true">Yes</option>';
		echo '</select>';
		
		echo '</td>';
		echo '</tr>';	// eo-body	
		
		echo '<tr>';		// attributes
		echo '<td colspan="2">';
		echo '<div class="dps-attributes">';
		echo '<div class="dps-attr-title">Attributes</div>';
		echo '<div class="dps-attr-new"><a href="#" class="add_attr">Add new attribute</a></div>';
		
		$i = 0;
		foreach($item["attributes"] as $attr)
		{
			echo '<table class="tblitm-'.$attr["attribute"].'"><tbody>';
		
			echo '<tr>';
			echo '<td class="left-column">Attribute:</td>';
			echo '<td class="right-column"><input name="attributes['.$i.'][attribute]" size="35" value="'.$attr["attribute"].'">
				<i dpshint="hint-attr-name" class="dashicons dashicons-info hint-trigger"></i></td>';
			echo '</tr>';
			
			echo '<tr>';
			echo '<td class="left-column">Label:</td>';
			echo '<td class="right-column"><input name="attributes['.$i.'][label]" size="35" value="'.$attr["label"].'">
				<i dpshint="hint-attr-label" class="dashicons dashicons-info hint-trigger"></i></td>';
			echo '</tr>';

			echo '<tr>';
			echo '<td class="left-column">Values:</td>';
			echo '<td class="right-column"><input name="attributes['.$i.'][values]" size="35" value="'.$attr["values"].'">
				<i dpshint="hint-attr-values" class="dashicons dashicons-info hint-trigger"></i></td>';
			echo '</tr>';

			echo '<tr>';
			echo '<td class="left-column">Multi:</td>';
			echo '<td class="right-column">';
			
			echo '<select name="attributes['.$i.'][multi]">';
			if (isset($attr["multi"]) && $attr["multi"] === "true") echo '<option value="false">No</option>';
			else echo '<option value="false" selected>No</option>';
			
			if (isset($attr["multi"]) && $attr["multi"] === "true") echo '<option selected value="true">Yes</option>';
			else echo '<option value="true">Yes</option>';
			echo '</select><i dpshint="hint-attr-multi" class="dashicons dashicons-info hint-trigger"></i>';
			
			echo '</td>';
			echo '</tr>';

			echo '<tr>';
			echo '<td class="left-column">SQL:</td>';
			echo '<td class="right-column"><textarea cols="35" rows="5" name="attributes['.$i.'][sql]">'.stripcslashes($attr["sql"]).'</textarea><i dpshint="hint-attr-sql" class="dashicons dashicons-info hint-trigger"></i></td>';
			echo '</tr>';
			
			echo '<tr>';
			echo '<td class="left-column"></td>';
			echo '<td class="right-column"><a href="#" class="remove_attr">Remove attribute</a></td>';
			echo '</tr>';			
			
			echo '</tbody></table>';
			$i++;
		}

		echo '</div>';
		echo '</td>';
		echo '</tr>';		// eo-attributes	
		echo '</table>';

		echo '</div>'; // eo-inside
		echo '</div>'; // eo-item
	}	
	
	function dps_update()
	{	
		global $dp_shortcodes;
		$key = $_POST["key"];

		if (!isset($_POST["key"]) || strlen($_POST["key"]) < 1)
		{
			header("Location: ?page=dpshortcodes&tab=edit&error=1&id=" . $_GET["id"]);
			die;
		}		
			
		unset($_POST["key"]);	
		unset($_POST["update"]);	
		unset($_POST["submit"]);	
		
		$item = $_POST;
		$reIndex = array();
		
		if (isset($item["attributes"]))
		foreach($item["attributes"] as $attr)
			$reIndex[] = $attr;
			
		$item["attributes"] = $reIndex;
		
		if ($key != $_GET["id"])
		{	
			unset($dp_shortcodes[ $_GET["id"] ]);
			$dp_shortcodes[ $key ] = $item;
		}
		else
			$dp_shortcodes[ $_GET["id"] ] = $item;

		update_option("dps_shortcodes", json_encode($dp_shortcodes));
		header("Location: ?page=dpshortcodes&tab=edit&id=" . $key);
		die;
	}
	
	function dps_delete()
	{
		if (isset($_GET["delete"]))
		{
			global $dp_shortcodes;
		
			if (!isset($dp_shortcodes[ $_GET["delete"] ])) 
				return false;
			
			unset($dp_shortcodes[ $_GET["delete"] ]);
			update_option("dps_shortcodes", json_encode($dp_shortcodes));
			header("Location: ?page=dpshortcodes&tab=overview");
			die;
		}
	
	}
	
	function dps_add()
	{
		global $dp_shortcodes;

		if (!isset($_POST["key"]) || strlen($_POST["key"]) < 1)
		{
			header("Location: ?page=dpshortcodes&error=1&tab=add");	
			die;
		}
			
		$key = $_POST["key"];
		unset($_POST["add"]);	
	
		$item = $_POST;
		$reIndex = array();
		
		if (isset($item["attributes"]))
		foreach($item["attributes"] as $attr)
			$reIndex[] = $attr;
			
		$item["attributes"] = $reIndex;
		$dp_shortcodes[ $key ] = $item;

		update_option("dps_shortcodes", json_encode($dp_shortcodes));
		header("Location: ?page=dpshortcodes&tab=edit&id=" . $key);	
		die;
	}

	function dps_import()
	{
		$json = stripcslashes($_POST["json_import"]);
		if (is_null(json_decode($json)))
		{
			header("Location: ?page=dpshortcodes&tab=import&e");
			die;
		}

		update_option("dps_shortcodes", $json);
		header("Location: ?page=dpshortcodes&tab=overview");
		die;
	}
?>