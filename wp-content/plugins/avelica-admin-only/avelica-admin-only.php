<?php

/**
 *
 * @link              https://avelica.com
 * @since             1.0.0
 * @package           Avelica_Admin_Only_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Avelica Admin Only
 * Plugin URI:        https://avelica.com
 * Description:       Creates .admin-only class which will only be visibile to users with Admin roles.
 * Version:           1.0.0
 * Author:            Avelica / ARCLabs
 * Author URI:        https://avelica.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       avelica-admin-only
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
//add_action('wp_head', 'add_admin_only_style', 100);
function add_admin_only_style()
{
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
        add_action('wp_head', 'add_admin_only_style', 100);
    }
}

add_action('admin_head', 'adminarea_custom_styles');
function adminarea_custom_styles()
{
    echo '<style>
  [data-slug="avelica-admin-only"] > * {
    background: #fccdff !important;
  }
  </style>';
}