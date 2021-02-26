<?php

/**
 *
 * @link              https://arclabs.ca
 * @since             1.0.0
 * @package           ARClabs_WP_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       ARClabs Wordpress Plugin
 * Plugin URI:        https://arclabs.ca
 * Description:       Plugin is used for ARClabs Managed Wordpress Sites
 * Version:           1.0.0
 * Author:            ARC Labs
 * Author URI:        https://arclabs.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       arc-wp-plugin
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
define( 'ARCLABS_WP_VERSION', '1.0.0' );


// MUST BE LOGGED IN TO VIEW
 add_action( 'wp', 'restrict_access_if_logged_out', 3 );
    function restrict_access_if_logged_out(){
    $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    
    // if user is not logged in and page is not lost password page
    $wpLogin = strpos($host, home_url().'/wp-login.php');
    $lostPassword = strpos($host, home_url().'/my-account/lost-password/');
    $resetLink = home_url().'/my-account/lost-password/?reset-link-sent=true';
    $passwordReset = home_url().'/my-account/?password-reset=true';

    if (!is_user_logged_in() && $host == $wpLogin || !is_user_logged_in() && $host == $lostPassword || !is_user_logged_in() && $host == $resetLink || !is_user_logged_in() && $host == $passwordReset || is_user_logged_in()){
        return;      
        } else {
            //$redirect = home_url() . '/wp-login.php?redirect_to=' . esc_url($_SERVER["HTTP_HOST"] . urlencode($_SERVER["REQUEST_URI"]));
            $redirect = home_url().'/must-be-logged-in/';
            wp_redirect( $redirect );
            exit;
        }
    }


function arc_hide_function() {
    /**
      * Hides the following plugins in menu bar and plugins list 
      * - ARClabs WP Plugin
      * - Custom Facebook Feed
      * - All-In-One Migration / S3 Plugin 
    * */
    
  echo '<style>
            [data-plugin="arc-wp-plugin/arclabs-wp-plugins.php"], 
    
            #toplevel_page_cff-top,
            [data-slug="custom-facebook-feed-pro-developer"],
    
            #toplevel_page_ai1wm_export,
            [data-plugin="all-in-one-wp-migration/all-in-one-wp-migration.php"],
            [data-plugin="all-in-one-wp-migration-s3-extension/all-in-one-wp-migration-s3-extension.php"],
            
            li > a[href="options-general.php?page=cleantalk"],
            [data-slug="cleantalk-spam-protect"]
            {
              display: none !important;
            } 
        </style>';
}
function arc_admin_css() {
  echo '<style>
            [data-plugin="arc-wp-plugin/arclabs-wp-plugins.php"] * {
              background: #6fa5b0 !important;
            } 
        </style>';
}

add_action('init','check_user');
function check_user(){
      $current_user = wp_get_current_user();
      // if current user is not 'arclabs' run function
    if ( $current_user->user_login != 'arclabs' ) {
        // USER IS NOT ARCLABS
        add_action('admin_head', 'arc_hide_function');
    } else {
        // USER IS ARCLABS
        add_action('admin_head', 'arc_admin_css');
        
    }
}


