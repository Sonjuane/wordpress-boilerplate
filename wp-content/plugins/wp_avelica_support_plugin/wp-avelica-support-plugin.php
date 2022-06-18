<?php

/**
 *
 * @link              https://avelica.com
 * @since             1.0.0
 * @package           Avelica_Support_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Avelica Support/Development Plugin
 * Plugin URI:        https://avelica.com
 * Description:       Plugin is used for Avelica Managed Wordpress Sites
 * Version:           1.0.0
 * Author:            Sonny Juane
 * Author URI:        https://arclabs.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_avelica_support_plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('Avelica_Support_Plugin', '1.0.0');

$git_reponame = "";
$git_username = "";

// delcare global variables
$plugin_data;
$plugin_version;
$settings;
$license_key;

add_action('init', 'initializePlugin');
function initializePlugin()
{

    global $plugin_data, $plugin_version, $settings, $license_key;
    $plugin_data = get_plugin_data(__FILE__);
    $plugin_version = $plugin_data['Version'];
    $plugin_dir = WP_PLUGIN_DIR;
    $plugins_list = get_plugins();

    // GET PLUGIN SETTINGS
    $settings = get_option('avelica_ws_support_settings', array());
    $license_key = $settings['avelica_ws_support_licence'];

    //echo $license_key;
    //var_dump($plugins_list);

    wp_enqueue_style('avc-wp-styles', plugin_dir_url(__FILE__) . 'css/avelica_support_styles.css', array(), $plugin_version, 'all');
    wp_enqueue_script('avc-wp-script', plugin_dir_url(__FILE__) . 'js/avelica_support_plugin.js', array(), $plugin_version, 'all');
    wp_localize_script('avc-wp-script', 'plugin_data', $plugin_data); // make plugin data available to js file
    wp_localize_script('avc-wp-script', 'plugin_list', $plugins_list); // make plugin list data available to js file
}

// GET ALL WORDPRESS PAGES (with children) AND CREATE JS VARIABLE
add_action('init', 'getPagesArray');
function getPagesArray()
{
    // MORE EFFECTIVE WAY TO GET ALL PAGES WITH ID
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => array('draft', 'publish'),
    );
    $pages = get_pages($args);
    $pageArray = array('all' => $pages);
    wp_localize_script('avc-wp-script', 'pages', $pageArray); // where pages is the variable name
}

//EXECUTE FUNCTION WHEN ON ADMIN PAGE LOAD
add_action('admin_init', 'avelica_function');
function avelica_function()
{
    global $current_user;
    wp_get_current_user();
    $username = $current_user->user_login;
    $users = array("arclabs", "atomic", "Atomic"); // Usernames to check

    // ALL PRIVATE FUNCTIONS
    if (!in_array($username, $users)) { // CONDITIONAL IF CURRENT USERNAME DOES NOT EXISTS IN USERS ARRAY

        // HIDE ALL UPDATE NOTIFICATIONS
        function remove_core_updates()
        {
            global $wp_version;return (object) array('last_checked' => time(), 'version_checked' => $wp_version);
        }
        add_filter('pre_site_transient_update_core', 'remove_core_updates'); //hide updates for WordPress itself
        add_filter('pre_site_transient_update_plugins', 'remove_core_updates'); //hide updates for all plugins
        add_filter('pre_site_transient_update_themes', 'remove_core_updates'); //hide updates for all themes
        add_filter('site_transient_update_themes', 'remove_core_updates');

        remove_action('load-update-core.php', 'wp_update_plugins');
        add_filter('pre_site_transient_update_plugins', '__return_null');

        // HIDE PLUGINS
        // add_filter('all_plugins', 'hide_plugins');
        // function hide_plugins($plugins)
        // {
        //     $pluginsArray = array( // plugins to remove if not admin
        //         'wp_avelica_support_plugin/wp_avelica_support_plugin.php',
        //         'cleantalk-spam-protect/cleantalk.php',
        //         'all-in-one-wp-migration/all-in-one-wp-migration.php',
        //         'all-in-one-wp-migration-s3-extension/all-in-one-wp-migration-s3-extension.php',
        //         'all-in-one-wp-migration-multisite-extension/all-in-one-wp-migration-multisite-extension.php',
        //         'wp-staging/wp-staging.php');

        //     foreach ($pluginsArray as $plugin_) {
        //         // Hide Plugin from Plugin page
        //         if (is_plugin_active($plugin_)) {
        //             unset($plugins[$plugin_]);
        //         }
        //     }
        //     return $plugins;
        // }

        // HIDE FROM MENU (SIDE)
        // $menuItems = array( // hides menu items
        //     'ai1wm_export',
        //     'cleantalk',
        //     'wpstg_clone',
        //     'Wordfence',
        // );
        // foreach ($menuItems as $menuItem) {
        //     remove_menu_page('admin.php?page=' . $menuItem); // removes from menu
        //     remove_menu_page($menuItem);

        //     // in case it's an options page
        //     remove_menu_page('options-general.php?page=' . $menuItem); // removes options  items
        //     remove_submenu_page('options-general.php', $menuItem);
        // }

        //ADD ADMIN JS/CSS FOR NON-AUTH USER
        // add_action('admin_enqueue_scripts', 'admin_scripts_arc');
        // function admin_scripts_arc()
        // {
        //     wp_enqueue_style('arc-wp-styles', plugins_url() . '/arc-wp-plugin/css/arc-wp-hide.css');
        //     wp_enqueue_script('arc-wp-scripts', plugins_url() . '/arc-wp-plugin/js/arc-wp-hide.js');
        // }

        // REMOVE DASHBOARD WIDGETS
        //add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
        function remove_dashboard_widgets()
        {
            global $wp_meta_boxes;
            unset($wp_meta_boxes['dashboard']['normal']['core']['ct_dashboard_statistics_widget']); // CLEANTALK DASHBOARD
            unset($wp_meta_boxes['dashboard']['normal']['core']['wordfence_activity_report_widget']); // WORDFENCE WIDGET

            // CORE WIDGETS AVAILABLE FOR REMOVAL
            // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
            // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
            // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
            // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
            // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

        }

    } else {

    }

}

// LISTS ALL INSTALLED MENU ITEMS
// add_action( 'admin_init', function () {
//     echo '<pre>' . print_r( $GLOBALS[ 'menu' ], true) . '</pre>';
//     echo '<style> #adminmenuback {display: none !important}</style>';
// } );

// UPDATER
//https://getbutterfly.com/how-to-update-your-wordpress-plugin-from-github/
if ((string) get_option('avelica_ws_support_licence') !== '') {
    include_once plugin_dir_path(__FILE__) . '/PDUpdater.php';

    $updater = new PDUpdater(__FILE__);
    $updater->set_username($git_username);
    $updater->set_repository($git_reponame);
    $updater->authorize(get_option('avelica_ws_support_licence'));
    $updater->initialize();
}

require plugin_dir_path(__FILE__) . 'options.php';