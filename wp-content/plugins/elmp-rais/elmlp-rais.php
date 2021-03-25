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
 * @package           Elmlp_Rais
 *
 * @wordpress-plugin
 * Plugin Name:       ELMLP-RAIS
 * Plugin URI:        https://arclabs.ca
 * Description:        RAIS (Registered Apprenticeship Information System) Dashboard component development for the <a href="https://lmic-cimt.ca" target="_blank" style="text-decoration: none !important;">Labour Market Information Council</a> by <a href="https://arclabs.ca" target="_blank" style="text-decoration: none !important;">ARC Labs - Applied Research & Consulting</a>
 * Version:           1.0.0
 * Author:            ARC Labs | Applied Research & Consulting
 * Author URI:        https://arclabs.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       elmlp-rais
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
define( 'ELMLP_RAIS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elmlp-rais-activator.php
 */
function activate_elmlp_rais() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elmlp-rais-activator.php';
	Elmlp_Rais_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elmlp-rais-deactivator.php
 */
function deactivate_elmlp_rais() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elmlp-rais-deactivator.php';
	Elmlp_Rais_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_elmlp_rais' );
register_deactivation_hook( __FILE__, 'deactivate_elmlp_rais' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-elmlp-rais.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elmlp_rais() {

	$plugin = new Elmlp_Rais();
	$plugin->run();

// CREATE SETTTINGS/OPTIONS DASHBOARD
	add_action( 'admin_menu', 'lmic_rais_options_page' );
	function lmic_rais_options_page() {
	
		add_options_page(
			'Rais Dashboard', // page <title>Title</title>
			null,//'Rais Dashboard', // menu link text - appears under Settings
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
        RAIS (Registered Apprenticeship Information System) Dashboard component development for the <a
            href="https://lmic-cimt.ca" target="_blank" style="text-decoration: none;">Labour Market Information
            Council</a> by <a href="https://arclabs.ca" target="_blank" style="text-decoration: none;">ARC Labs -
            Applied Research & Consulting</a>
    </p>

    <p>
        To use add shortcode to page:<br />

        <input type="text" value="[elmlp-rais]" style="color: black; text-align: center; width: 110px;" disabled><br />

    </p>
    
    <p>
    <ul>
        <li id="pages">
    <h2><?php _e('pages:'); ?></h2>
    <form action="<?php bloginfo('url'); ?>" method="get">
        <?php wp_dropdown_pages(); ?>
        <input type="submit" name="submit" value="view" />
    </form>
</li>
</ul>
    </p>

<p>

<?php
$pages = get_posts( array( 'post_type' => 'page', 'post_parent' => 0, 'post_status' => array( 'draft', 'publish' ) ) );
//$pages = get_posts( array( 'post_type' => 'page', null, 'post_status' => array( 'draft', 'publish' ) ) );

$pageArray = array();
//global $pageArray;

foreach( $pages as $page ) {
    $children = array();
    
    $page_ = array(
        id => $page->ID,
        title => get_the_title( $page->ID ),
        status => get_post_status ( $page->ID ),
        children => null
        );
        $children = get_children( 'post_parent='. $page->ID );
        foreach( $children as $subpage ) {
            $subpage_ = array(
                id => $subpage->ID,
                title => get_the_title( $subpage->ID ),
                status => get_post_status ( $subpage->ID )
            );
            array_push($children, $subpage_);
        }    
        
    $page_['children'] = $subpage;
    array_push($pageArray, $page_);
}
// PUSH INTO ARRAY
	wp_enqueue_script('my-script',plugins_url().'/elmp-rais/test-script.js');
    wp_localize_script( 'my-script', 'MyScriptParams', $pageArray );

$pages = get_posts( array( 'post_type' => 'page', 'post_parent' => 0, 'post_status' => array( 'draft', 'publish' ) ) );
echo '<select name="selected-food-type" id="selected-food-type">';
foreach( $pages as $page ) {
    echo '<option value="' . $page->ID . '">' . get_the_title( $page->ID ) .' status:'. get_post_status ( $page->ID ). '</option>';
    $children = get_children( 'post_parent='. $page->ID );
    foreach( $children as $subpage ) {
        echo '<option value="' . $subpage->ID . '">&nbsp;&nbsp;&nbsp;' . get_the_title( $subpage->ID ) . '</option>';
    }
}
echo '</select>';
?>
</p>

    <div class="clear"></div>
</div>

    <?php }

// CREATE SHORTCODE
	function rais_shortcode() { 
		// Things that you want to do. 
		
		$chart =  plugin_dir_url( __FILE__ ) . 'public/chart/index.html';
		//$message = '<div class="rais-wrapper"><embed src="'.$chart.'" width="100%" /></div>';
		$message = '<embed src="'.$chart.'" width="100%" height="674" />';
		// Output needs to be return
		return $message;
		} 
	// register shortcode
	add_shortcode('elmlp-rais', 'rais_shortcode'); 

// ADD SETTING LINKS - PLUGINS PAGE
	function my_plugin_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page=lmic-rais-settings">Settings</a>'; 
    	array_unshift($links, $settings_link); 
    	return $links; 
	}
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'my_plugin_settings_link' );

// ADDS LINKS TO <HEAD> ON PUBLIC FACING SITE
    add_action('wp_head', function () {
    	$file =  plugin_dir_url( __FILE__ ) . 'public/js/app.a26b7620.js';
    	echo "<link id='wolfgang' rel='preload' href='{$file}' as='script'/>\n";
    	echo '<script id="wolfgang">console.log("Wolfgang")'.$file.'</script>';
    }, 1);
    



    
    
}
run_elmlp_rais();
