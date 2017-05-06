<?php

/**
 * Plugin Name: Simple Plugin
 * Description: This is simple plugin that shows a text box in post, page or widget using shortcodes
 * Version: 1.0
 * Author: Murtaza Bhurgri
 * Author URI: http://gmbhurgri.com
 * Requires at least: 4.7
 * Tested up to: 4.7
 * Text Domain : simple-plugin
 */

defined('ABSPATH') or die('No script kiddies please!');

function sp_activation_hook(){
	// Activation code here
	// Create database tables or entries etc
}

//Register activation hook
register_activation_hook(__FILE__, 'sp_activation_hook');

function sp_deactivation_hook(){
	// Deactivation code here
	//  Remove databsae entries or other settings if necessary 
}

//Register activation hook
register_deactivation_hook(__FILE__, 'sp_deactivation_hook');

// SP admin page
function sp_create_content_page(){

	// if user have submitted form
	if(isset($_POST['submit'])){
		update_option( 'sp_content', $_POST['content'] );
	}
?>
	<div class="wrap">
		<h2>Simple Plugin Page</h2>
		<form method="post" id="simple-plugin-form">
			<label><strong>Content</strong></label>
			<div>
				<textarea rows="10" cols="80" name="content" id="content"><?php echo get_option('sp_content') ?></textarea>
			</div>
			<div>
				<input type="submit" class="button button-primary button-large" name="submit" value="Save">
			</div>
		</form>
	</div>
<?php
}


// Register a Menu
function sp_register_menu(){
	add_menu_page( 'Simple Plugin', 'Simple Plugin', 'manage_options', 'simple-plugin', 'sp_create_content_page');
}

// Add action to admin_menu for page
add_action('admin_menu', 'sp_register_menu');

// Shortcode function
function sp_get_content(){
	return get_option('sp_content');
}

// Register shorcode
add_shortcode('sp_show_content', 'sp_get_content');

