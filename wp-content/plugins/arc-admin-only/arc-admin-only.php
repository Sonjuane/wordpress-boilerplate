<?php

/**
 *
 * @link              https://arclabs.ca
 * @since             1.0.0
 * @package           ARClabs_Admin_Only_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       ARClabs Admin Only
 * Plugin URI:        https://arclabs.ca
 * Description:       Creates .admin-only class which will only be visibile to users with Admin roles.
 * Version:           1.0.0
 * Author:            ARC Labs
 * Author URI:        https://arclabs.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       arc-admin-only
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
//add_action('wp_head', 'custom_frontend_styles', 100);
function custom_frontend_styles()
{
    // adds admin online class
    echo "<style>.admin-only {display: none !important;}</style>";
}
add_action('init', 'check_user_role');
function check_user_role()
{
    $current_user = wp_get_current_user();
    $user = wp_get_current_user(); // get current user
    $userroles = (array) $user->roles; // current user role(s)
    if (in_array("administrator", $userroles)) {
        // USER IS ADMIN
    } else {
        // USER IS NOT ADMIN - hide if not admin
        add_action('wp_head', 'custom_frontend_styles', 100);
    }
}

add_action('admin_head', 'custom_admin_styles');
function custom_admin_styles()
{
    echo '<style>
            [data-slug="arclabs-admin-only"] > * {
                background: #fccdff !important;
            }
            </style>';
}