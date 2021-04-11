<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://arclabs.ca
 * @since             1.0.0
 * @package           Boilerplate_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Boilerplate Plugin
 * Plugin URI:        https://arclabs.ca
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Applied Research & Consulting
 * Author URI:        https://arclabs.ca
 * AuthorTest:            Applied Research & Consulting
 * AuthorTest URI:        https://arclabs.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       boilerplate-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BOILERPLATE_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-boilerplate-plugin-activator.php
 */
function activate_boilerplate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-plugin-activator.php';
	Boilerplate_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-boilerplate-plugin-deactivator.php
 */
function deactivate_boilerplate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-plugin-deactivator.php';
	Boilerplate_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_boilerplate_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_boilerplate_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-boilerplate-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_boilerplate_plugin() {

	$plugin = new Boilerplate_Plugin();
	$plugin->run();

}
run_boilerplate_plugin();




/*
add_action( 'admin_menu', 'lmic_rais_options_page' );
function lmic_rais_options_page() {
 
	add_options_page(
		'Rais Dashboard', // page <title>Title</title>
		null,//'Rais Dashboard', // menu link text
		'manage_options', // capability to access the page
		'lmic-rais-settings', // page URL slug
		'options_page_content', // callback function with content
		2 // priority
	);
 
}
function options_page_content(){
 ?>

<div class="wrap">
    <h1>RAIS DASHBOARD COMOPNENT</h1>
<p>
    RAIS Dashboard component development for LMIC-CIMT.ca
</p>

    <div class="clear"></div>
</div>

 <?php
}
*/


// SHOWS ALL ADMIN MENU
// add_action( 'admin_init', 'wpse_136058_debug_admin_menu' );

// function wpse_136058_debug_admin_menu() {

//     echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
// }
/**
 * Removes some menus by page.
 */

add_action('init', 'admin_only'); // runs during init
    function admin_only() {
    add_action( 'admin_menu', 'wpdocs_remove_menus' ); // hide menu items
}

function wpdocs_remove_menus(){
   
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit.php?post_type=page' );    //Pages
  
  remove_menu_page('admin.php?page=ai1wm_export'); // removes all in migration panel
  remove_menu_page('ai1wm_export');
  
//   remove_menu_page( 'edit-comments.php' );          //Comments
//   remove_menu_page( 'themes.php' );                 //Appearance
//   remove_menu_page( 'plugins.php' );                //Plugins
//   remove_menu_page( 'users.php' );                  //Users
//   remove_menu_page( 'tools.php' );                  //Tools
   remove_menu_page( 'options-general.php' );        //Settings
   
}




// function that runs when shortcode is called
function rais_shortcode() { 
// Things that you want to do. 
$message = '<div id="lmic-rais"></div>'; 
// Output needs to be return
return $message;
} 
// register shortcode
add_shortcode('rais-dashboard', 'rais_shortcode'); 

// ADD SETTING LINKS
function my_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=lmic-rais-settings">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'my_plugin_settings_link' );
