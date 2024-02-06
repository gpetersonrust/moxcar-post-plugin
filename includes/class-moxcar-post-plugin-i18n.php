<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://moxcar.copm
 * @since      1.0.0
 *
 * @package    Moxcar_Post_Plugin
 * @subpackage Moxcar_Post_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Moxcar_Post_Plugin
 * @subpackage Moxcar_Post_Plugin/includes
 * @author     Gino Peterson <gpeterson@moxcar.com>
 */
class Moxcar_Post_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'moxcar-post-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
