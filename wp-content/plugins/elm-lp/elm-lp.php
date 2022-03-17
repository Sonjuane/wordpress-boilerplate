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
 * @package           Elm_Lp
 *
 * @wordpress-plugin
 * Plugin Name:       LMIC ELM-LP CHART
 * Plugin URI:        https://arclabs.ca
 * Description:       Employment Labour Market (LP) Component developed for LMIC-CIMT.CA.
 * Version:           2.0.0
 * Author:            ARC Labs | Applied Research Concepts
 * Author URI:        https://arclabs.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       elm-lp
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
define('ELM_LP_VERSION', '2.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elm-lp-activator.php
 */
function activate_elm_lp()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-elm-lp-activator.php';
    Elm_Lp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elm-lp-deactivator.php
 */
function deactivate_elm_lp()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-elm-lp-deactivator.php';
    Elm_Lp_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_elm_lp');
register_deactivation_hook(__FILE__, 'deactivate_elm_lp');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-elm-lp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elm_lp()
{

    $plugin = new Elm_Lp();
    $plugin->run();

    // register shortcode
    add_shortcode('elm-lp', 'elmlp_shortcode');
    function elmlp_shortcode()
    {
        // function that runs when shortcode is called
        // Output needs to be return
        return '<div id="elm-lp-comp"></div>';
    }

}
run_elm_lp();