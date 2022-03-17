<?php
/*
Plugin Name: WP Active Plugins Data
Plugin URI: http://mikeschinkel.com/wordpress-plugins/wp-active-plugins-data/
Description: Loads Plugin Data on Plugin Activation and Persists to wp_options for quick retrieval.
Version: 0.1
Author: Mike Schinkel
Author URI: http://mikeschinkel.com
Note: Written for http://wordpress.stackexchange.com/questions/361/is-there-a-way-for-a-plug-in-to-get-its-own-version-number
 */

require_once ABSPATH . 'wp-admin/includes/plugin.php';

add_action('init', 'getPluginData');
function getPluginData()
{

    function get_active_plugin_version($plugin_path_file, $sitewide = false)
    {
        return get_active_plugin_attribute($plugin_path_file, 'Version');
    }
    function get_active_plugin_attribute($plugin_path_file, $attribute)
    {
        $all_plugins_data = get_active_plugins_data($plugin_path_file, $sitewide);
        return (isset($all_plugins_data[$attribute]) ? $all_plugins_data[$attribute] : false);
    }
    function get_active_plugins_data($plugin_path_file, $sitewide = false)
    {
        $failsafe = false;
        $plugin = plugin_basename(trim($plugin_path_file));
        $sitewide = (is_multisite() && ($sitewide || is_network_only_plugin($plugin)));
        if ($sitewide) {
            $all_plugins_data = get_site_option('active_sitewide_plugin_data', array());
        } else {
            $all_plugins_data = get_option('active_plugin_data', array());
        }
        if (!$failsafe && !is_array($all_plugins_data) || count($all_plugins_data) == 0) {
            $failsafe = true; // Don't risk infinite recursion
            if ($sitewide) {
                $active_plugins = get_site_option('active_sitewide_plugins', array());
            } else {
                $active_plugins = get_option('active_plugins', array());
            }
            persist_active_plugin_data(null, $active_plugins, $sitewide);
            $all_plugins_data = get_active_plugin_version($plugin_path_file, $sitewide);
        }
        return $all_plugins_data[$plugin_path_file];
    }
    add_action('update_site_option_active_sitewide_plugins', 'persist_sitewide_active_plugin_data', 10, 2);
    function persist_sitewide_active_plugin_data($option, $plugins)
    {
        persist_active_plugin_data(null, $plugins, 'sitewide');
    }
    add_filter('update_option_active_plugins', 'persist_active_plugin_data', 10, 2);
    function persist_active_plugin_data($old_plugins, $new_plugins, $sitewide = false)
    {
        wp_enqueue_script('avc-wp-plugin', plugin_dir_url(__FILE__) . 'js/plugin_data.js', array());
        $active_plugin_data = array_flip($new_plugins);
        $plugin_dir = WP_PLUGIN_DIR;
        foreach ($new_plugins as $plugin) {
            $active_plugin_data[$plugin] = get_plugin_data("$plugin_dir/$plugin");
        }
        if ($sitewide) {
            // $testArray = array('siteWide' => $active_plugin_data);
            // wp_localize_script('avc-wp-script', 'pages', $testArray); // where pages is the variable name
            wp_localize_script('avc-wp-plugin', 'pluginData', $active_plugin_data); // where pages is the variable name
            //update_site_option('active_sitewide_plugin_data', $active_plugin_data);
        } else {
            //update_site_option('active_plugin_data', $active_plugin_data);
            wp_localize_script('avc-wp-plugin', 'pluginData', $active_plugin_data); // where pages is the variable name
        }

    }
};