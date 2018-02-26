<?php 
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	if (isset($_POST["update"]))
		dps_update();
	if (isset($_POST["sort"]))
		dps_sort();	
	if (isset($_POST["add"]))
		dps_add();				
	if (isset($_POST["import"]))
		dps_import();			

	global $dp_shortcodes;
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'overview';
	$action_url = ($active_tab == "edit") ? "?noheader=true&page=dpshortcodes&tab=edit&id=" . $_GET["id"] : "?noheader=true&page=dpshortcodes&tab=" . $active_tab;
?>
<script>
	var DEFAULT_ICON = "<?php echo plugin_dir_url(__FILE__) . "icon.png"; ?>";
</script>
<div class="wrap dp-shortcodes-edit">
	<h2>Editor Shortcode Buttons</h2>
	<div class="separator"></div>
	
	<h2 class="nav-tab-wrapper">
		<a href="?page=dpshortcodes&tab=overview" class="nav-tab <?php if ($active_tab == "overview") echo "nav-tab-active"; ?>">Overview</a>
		<a href="?page=dpshortcodes&tab=add" class="nav-tab <?php if ($active_tab == "add") echo "nav-tab-active"; ?>">Add button</a>
		<?php if ($active_tab == "edit"): ?>
			<a href="#" class="nav-tab nav-tab-active">Edit button</a>
		<?php endif; ?>
		<a href="?page=dpshortcodes&tab=sort" class="nav-tab <?php if ($active_tab == "sort") echo "nav-tab-active"; ?>">Sort buttons</a>
		<a href="?page=dpshortcodes&tab=import" class="nav-tab <?php if ($active_tab == "import") echo "nav-tab-active"; ?>">Import buttons</a>
		<a href="?page=dpshortcodes&tab=export" class="nav-tab <?php if ($active_tab == "export") echo "nav-tab-active"; ?>">Export buttons</a>
	</h2>
	
	<form method="POST" action="<?php echo $action_url; ?>">
	<?php 
		
		if ($active_tab == "overview"):

		if ($dp_shortcodes && sizeof($dp_shortcodes) > 0)
		{
			foreach($dp_shortcodes as $key => $item)
				dps_draw_shortcode($item, $key);
		}
		else
			echo '<p>No shortcodes. Click <strong>Add button</strong> to add new buttons.</p>';

		elseif ($active_tab == "edit"): 

			$item = false;
			if (isset($dp_shortcodes[ $_GET["id"] ])) $item = $dp_shortcodes[ $_GET["id"] ];
			
			if ($item)
			{
				dps_edit_shortcode($item, $_GET["id"]);
				echo '<input type="hidden" name="update" value="1">';
				submit_button();
				echo '<script>var dps_nr_attributes = '.sizeof($item["attributes"]).';</script>';
			}
			else
				echo '<p class="dps-not-exist">Shortcode does not exist.<p>';
	
		elseif ($active_tab == "add"): 
		
			dps_add_shortcode(); 
			echo '<script>var dps_nr_attributes = 0;</script>';
			echo '<input type="hidden" name="add" value="1">';
			submit_button(); 	
			
		elseif ($active_tab == "sort"): 
			echo '<div class="postbox dp-shortcode-item">'; // item
			echo '<div class="inside">'; // inside'
			echo '<h3>Sorting</h3>';

			echo '<p>Drag items to sort them.<p>';
			if (sizeof($dp_shortcodes) > 0)
			{
				echo '<input name="sort" type="hidden" value="1">';
				echo '<ul class="dps-sortable">';
				foreach($dp_shortcodes as $key => $item)
				{
					echo '<li class="dps-sort-item">
						<input type="hidden" name="order[]" value="'.$key.'">
						'.$key.'
					</li>';
				}
				echo '</ul>';
			}

			echo '</div>';
			echo '</div>';
		
			submit_button(); 

		elseif ($active_tab == "import"): 
			echo '<div class="postbox dp-shortcode-item">'; // item
			echo '<div class="inside">'; // inside'
			echo '<h3>Importing buttons</h3>';

			echo '<input type="hidden" name="import" value="1">';
			echo '<p>Enter your button configuration (.json string) in the input field below to import the buttons:</p>';
			echo '<p><textarea name="json_import" rows="6" cols="100"></textarea></p>';

			if (isset($_GET["e"]))
				echo '<p style="color: red; font-weight: bold; ">There was an error while decoding your JSON string.</p>';

			echo '</div>';		
			echo '</div>';		

			submit_button();

		elseif ($active_tab == "export"): 
			echo '<div class="postbox dp-shortcode-item">'; // item
			echo '<div class="inside">'; // inside'
			echo '<h3>Exporting buttons</h3>';

			echo '<p>Below is a JSON string of your settings, that you can save for future imports.</p>';
			echo '<p><textarea>'.stripslashes(stripslashes(dps_unicodeToText(get_option("dps_shortcodes")))).'</textarea></p>';

			echo '</div>';		
			echo '</div>';	
		endif; 
	?>
	</form>
</div>


<div class="dps-hint hint-title">Title will be shown in shortcode popup and when user hovers over the icon.</div>
<div class="dps-hint hint-attr-values">
	Attribute values can be:
	<ul>
		<li>Any registered post type (post, page, custom post types)</li>
		<li>Semicolon separated values (value1, value2, value3)</li>
		<li>Semicolon separated pairs of values and labels, separated with pipe (1|label 1, 2|label 2)</li>
		<li>Free input (leave empty)</li>
	</ul>
</div>
<div class="dps-hint hint-attr-name">Atribute name.</div>
<div class="dps-hint hint-attr-label">Label to be shown above the input.</div>
<div class="dps-hint hint-attr-multi">Defines if user can select multiple values.</div>
<div class="dps-hint hint-attr-sql">Custom values selected directly from database via SQL query.<br />
<b>NOTE:</b> Database <b>must</b> return VALUE and LABEL columns. Having SQL return values overwrites "Values" field.</div>
<div class="dps-hint-popup"></div>