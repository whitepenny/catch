<?php
	/*
	Plugin Name: Simple shortcode buttons
	Plugin URI: http://davidp.net/simple-shortcode-buttons
	Description: Add shortcode buttons to your WordPress editor to make shortcode inserting really easy.
	Version: 1.3.2
	Author: davidp
	Author URI: http://davidp.net
	License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
	*/

	global $dp_shortcodes;

	add_option("dps_shortcodes", "[]");

	$dp_shortcodes = json_decode(get_option("dps_shortcodes"), true);
	if (!$dp_shortcodes) $dp_shortcodes = array();

	function dp_shortcode_admin_inline_js(){
		global $dp_shortcodes; 

		echo "<script type='text/javascript'>";
		echo 'var DP_SITE_URL = "'.get_site_url() . '"; ';
		echo 'var DP_PLUGIN_URL = "'.plugin_dir_url(__FILE__) . '"; ';
		$url = get_site_url();
		include(dirname(__FILE__) . '/dp_shortcode_buttons_script.php');
		echo "</script>";
	}

	add_action( 'admin_print_scripts', 'dp_shortcode_admin_inline_js' );
		
	function dp_shortcode_buttons_scripts($hook) {
		wp_enqueue_style( 'dp_shortcode_buttons_style', plugin_dir_url(__FILE__) . 'dp_shortcode_buttons_style.css' );
		wp_enqueue_script( 'dp_shortcode_buttons_admin', plugin_dir_url(__FILE__) . 'dp_shortcode_buttons_admin.js', array("jquery") );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_media();
	}
	
	add_action( 'admin_enqueue_scripts', 'dp_shortcode_buttons_scripts' );	

	function dp_shortcode_buttons_init() {
		add_filter( "mce_external_plugins", "dp_shortcode_buttons" );
		add_filter( 'mce_buttons', 'dp_shortcode_buttons_register' );
	}
	
	function dp_shortcode_buttons( $plugin_array ) {
		$plugin['dpsb'] = plugin_dir_url(__FILE__) . "dp_shortcode_buttons.js";
		return $plugin;
	}
	
	function dp_shortcode_buttons_register( $buttons ) {
		global $dp_shortcodes;
		
		foreach($dp_shortcodes as $key => $item)
			array_push( $buttons, $key );
		
		return $buttons;
	}	
	
	add_action( 'init', 'dp_shortcode_buttons_init' );

	function dp_shortcode_buttons_page()
	{
		dps_delete();
		include("dp_shortcodes_edit.php");
	}

	function dp_shortcode_admin_page()
	{
		include(plugin_dir_path(__FILE__) . "core.php");
		add_menu_page( "Editor shortcode buttons", "Editor shortcode buttons", "manage_options", "dpshortcodes", "dp_shortcode_buttons_page", "dashicons-info" );	
	}
	
	add_action( 'admin_menu', 'dp_shortcode_admin_page' );

	function dps_uttcallback($match)
	{
		return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
	}

	function dps_unicodeToText($str)
	{
		$str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', "dps_uttcallback", $str);
		return $str;
	}
?>