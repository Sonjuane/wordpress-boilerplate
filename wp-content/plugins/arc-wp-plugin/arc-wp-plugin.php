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


// EXECUTE FUNCTION WHEN ON ADMIN PAGE LOAD
    add_action('admin_init', 'arc_function');
    function arc_function() {
    
        global $current_user;
        wp_get_current_user();
        $username = $current_user->user_login;
        $users = array("arclabs", "atomic", "Atomic"); // Usernames to check
    
    
        // ALL PRIVATE FUNCTIONS
        if (!in_array($username, $users)) { // CONDITIONAL IF CURRENT USERNAME DOES NOT EXISTS IN USERS ARRAY
            
            // HIDE ALL UPDATE NOTIFICATIONS
            function remove_core_updates(){
                global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
            }
            add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
            add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
            add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes
            add_filter( 'site_transient_update_themes', 'remove_core_updates' );
        
    
            remove_action('load-update-core.php','wp_update_plugins');
            add_filter('pre_site_transient_update_plugins','__return_null');

            // HIDE PLUGINS 
            add_filter( 'all_plugins', 'hide_plugins');
            function hide_plugins($plugins){
                $pluginsArray = array(  // plugins to remove if not admin
                    'arc-wp-plugin/arc-wp-plugin.php',
                    'cleantalk-spam-protect/cleantalk.php',
                    'all-in-one-wp-migration/all-in-one-wp-migration.php',
                    'all-in-one-wp-migration-s3-extension/all-in-one-wp-migration-s3-extension.php',
                    'all-in-one-wp-migration-multisite-extension/all-in-one-wp-migration-multisite-extension.php',
					'wp-staging/wp-staging.php');
                    
                foreach( $pluginsArray as $plugin_ ) {
                    // Hide Plugin from Plugin page
            		if(is_plugin_active($plugin_)) {
            				unset( $plugins[$plugin_] );
            		}    
                }
                return $plugins;
            }
             
            // HIDE FROM MENU (SIDE)
            $menuItems = array(// hides menu items
                'ai1wm_export',
                'cleantalk',
                'wpstg_clone',
                'Wordfence'
                );
            foreach($menuItems as $menuItem){
                remove_menu_page('admin.php?page='.$menuItem); // removes from menu
                remove_menu_page($menuItem);
                
                // in case it's an options page
                remove_menu_page('options-general.php?page='.$menuItem); // removes options  items
                remove_submenu_page( 'options-general.php',$menuItem );
            }
            
            //ADD ADMIN JS/CSS FOR NON-AUTH USER
            add_action('admin_enqueue_scripts', 'admin_scripts_arc');            
            function admin_scripts_arc() {
                wp_enqueue_style('arc-wp-styles', plugins_url().'/arc-wp-plugin/css/arc-wp-hide.css');
                wp_enqueue_script('arc-wp-scripts',plugins_url().'/arc-wp-plugin/js/arc-wp-hide.js');
            }

            // REMOVE DASHBOARD WIDGETS 
            add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
            function remove_dashboard_widgets() {
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
                
            } else{
                
            }
         
        // GET ALL WORDPRESS PAGES (with children) AND CREATE JS VARIABLE
        function pages(){
        
            // gets all pages as flat array
            //$pages = get_posts( array( 'post_type' => 'page', null, 'post_status' => array( 'draft', 'publish' ) ) ); 
            
            $pages = get_posts( array( 'post_type' => 'page', 'post_parent' => 0, 'post_status' => array( 'draft', 'publish' ) ) );
            $pageArray = array();
            
            foreach( $pages as $page ) {
                $child_ = array();
                $page_ = array(
                        id => $page->ID,
                        title => get_the_title( $page->ID ),
                        status => get_post_status ( $page->ID ),
                    );
                    // gets children pages
                    $children = get_children( 'post_parent='. $page->ID );
                    foreach( $children as $subpage ) {
                        $subpage_ = array(
                            id => $subpage->ID,
                            title => get_the_title( $subpage->ID ),
                            status => get_post_status ( $subpage->ID )
                        );
                        array_push($child_, $subpage_);
                    }    
                
                if (count($child_) > 0) {
                    // children array if exists
                    $page_['children'] = $child_;    
                }
                array_push($pageArray, $page_);
            }
			
			
			
            wp_enqueue_script('arc-wp-script',plugins_url().'/arc-wp-plugin/js/arc-wp-pages-plugin.js');
            wp_localize_script( 'arc-wp-script', 'pages', $pageArray ); // where pages is the variable name
			
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
    'post_status' => 'publish'
); 


// recursively gets all files in plugin directory
$dir = plugin_dir_path( __FILE__ ); // gets plugin directory
$folder = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$files = array(); 
foreach ($folder as $file) {
    if ($file->isDir()){ 
        continue;
    }
    $files[] = $file->getPathname(); 
}

$pages2 = get_pages($args); 	
			
			wp_localize_script( 'arc-wp-script', 'pages2', $pages2 ); // where pages is the variable name
			wp_localize_script( 'arc-wp-script', 'pluginFiles', $files ); // where pages is the variable name
        }
        pages();
    }
    

    // LISTS ALL INSTALLED MENU ITEMS
    // add_action( 'admin_init', function () {
    //     echo '<pre>' . print_r( $GLOBALS[ 'menu' ], true) . '</pre>';
    //     echo '<style> #adminmenuback {display: none !important}</style>';
    // } );