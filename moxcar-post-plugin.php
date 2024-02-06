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






$posts_to_mail_ids = get_posts(
    array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'fields' => 'ids', // Specify that you only want post IDs
        'date_query' => array(
            array(
                'after' => '2024-02-01',
                'inclusive' => true
            )
        )
    )
);


  

	$posts_already_sent = get_option('moxcar_posts_already_sent');

//  if empty or not an array, create an empty array
	if ( ! is_array($posts_already_sent) ) {
		$posts_already_sent = array();
		update_option('moxcar_posts_already_sent', $posts_already_sent);
	}

	$ids_to_mail = array_diff($posts_to_mail_ids, $posts_already_sent);

	$subscribers = get_option('moxcar_subscribers');

	if ( ! is_array($subscribers) ) {
		$subscribers = array();
		update_option('moxcar_subscribers', $subscribers);
	}

	// go through subscribers and ignore the ones that are not active
	$active_subscribers = array_filter($subscribers, function($subscriber) {
		return $subscriber['is_active'] == 1;
	});

	//  posts to mail for each subscriber

	foreach ($active_subscribers as $subscriber) {
		$to = $subscriber['email'];
		$subject = 'New Posts from Moxcar';
		$body = 'New posts from Moxcar: <br>';

		foreach ($ids_to_mail as $id) {
			$post = get_post($id);
			 $post_title = $post->post_title;
			 $post_url =  $post->guid;
			 
			 $body .= "<a href='$post_url'>$post_title</a><br>";
		}

		$headers = array('Content-Type: text/html; charset=UTF-8');

		 wp_mail($to, $subject, $message, $headers, $attachments);
	}
	 