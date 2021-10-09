<?php

require_once 'partials/firebase-authentication-admin-display.php';
class  MO_Firebase_Authentication_Admin {

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
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {
		if( $hook != 'toplevel_page_mo_firebase_authentication' ) {
                return;
        }
		wp_enqueue_style( 'mo_firebase_auth_admin_bootstrap_style', plugins_url( 'css/bootstrap.min.css', __FILE__ ) );
		wp_enqueue_style( 'mo_firebase_auth_firebase_phone_style', plugins_url( 'css/phone.css', __FILE__ ) );
		wp_enqueue_style( 'mo_firebase_auth_settings_style', plugins_url( 'css/style.css', __FILE__ ) );
		wp_enqueue_style( 'mo_firebase_auth_fontawesome', plugins_url( 'css/font-awesome.css', __FILE__ ) );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {
		if( $hook != 'toplevel_page_mo_firebase_authentication' ) {
                return;
        }
		wp_enqueue_script( 'mo_firebase_auth_bootstrap_script', plugins_url( 'js/bootstrap.min.js', __FILE__) );
		wp_enqueue_script( 'mo_firebase_auth_custom_settings_script', plugins_url( 'js/custom.js', __FILE__) );
		wp_enqueue_script( 'mo_firebase_auth_firebase_phone_script', plugins_url( 'js/phone.js', __FILE__ ), array(), $this->version , false );
	}
	
	public function mo_firebase_auth_page() {
		global $wpdb;
		update_option( 'host_name', 'https://login.xecurify.com' );
		$customerRegistered = mo_firebase_authentication_is_customer_registered();
		mo_firebase_authentication_main_menu();
	}
	
}
