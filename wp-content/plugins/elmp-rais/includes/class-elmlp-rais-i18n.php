<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://arclabs.ca
 * @since      1.0.0
 *
 * @package    Elmlp_Rais
 * @subpackage Elmlp_Rais/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Elmlp_Rais
 * @subpackage Elmlp_Rais/includes
 * @author     ARC Labs | Applied Research & Consulting <info@arclabs.ca>
 */
class Elmlp_Rais_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'elmlp-rais',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
