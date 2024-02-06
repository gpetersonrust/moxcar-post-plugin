<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://moxcar.copm
 * @since             1.0.0
 * @package           Moxcar_Post_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Moxcar Post Plugin
 * Plugin URI:        https://moxcar.com
 * Description:       This plugin is used to email Moxcar's Post and create a subscriber list
 * Version:           1.0.0
 * Author:            Gino Peterson
 * Author URI:        https://moxcar.copm/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       moxcar-post-plugin
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
define( 'MOXCAR_POST_PLUGIN_VERSION', '1.0.0' );

define("MOXCAR_POST_PLUGIN_DIR_PATH", plugin_dir_path( __FILE__ ));

define("MOXCAR_POST_PLUGIN_URL", plugin_dir_url( __FILE__ ));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-moxcar-post-plugin-activator.php
 */
function activate_moxcar_post_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-moxcar-post-plugin-activator.php';
	Moxcar_Post_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-moxcar-post-plugin-deactivator.php
 */
function deactivate_moxcar_post_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-moxcar-post-plugin-deactivator.php';
	Moxcar_Post_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_moxcar_post_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_moxcar_post_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-moxcar-post-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_moxcar_post_plugin() {

	$plugin = new Moxcar_Post_Plugin();
	$plugin->run();



}
run_moxcar_post_plugin();
