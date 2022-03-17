<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://arclabs.ca
 * @since      1.0.0
 *
 * @package    Elm_Lp
 * @subpackage Elm_Lp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Elm_Lp
 * @subpackage Elm_Lp/admin
 * @author     ARC Labs | Applied Research Concepts <info@arclabs.ca>
 */
class Elm_Lp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Elm_Lp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Elm_Lp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/elm-lp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Elm_Lp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Elm_Lp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/elm-lp-admin.js', array( 'jquery' ), $this->version, false );

	}

}
// CREATE MENU ITEM 
add_action( 'admin_menu', 'lmic_admin_menu' );
function lmic_admin_menu() {
    add_menu_page(
        __( 'Sample page', 'my-textdomain' ),
        __( 'LMIC Admin', 'my-textdomain' ),
        'manage_options',
        'lmic-admin',
        'lmic_admin_page_contents',
        'dashicons-schedule',
        3
    );
}

// ADMIN PAGE 
function lmic_admin_page_contents() {
    include('partials/elm-lp-admin-display.php');
}
        
