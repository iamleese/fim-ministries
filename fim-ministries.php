<?php

/**
 *
 * @link              https://faithinmarketing.com
 * @since             2.0.0
 * @package           FIM-ministries
 *
 * @wordpress-plugin
 * Plugin Name:       FIM Ministries
 * Plugin URI:        https://faithinmarketing.com/websites
 * Description:       Faith in Marketing Ministry Plugin
 * Version:           2.1.0
 * Author:            Melissa R Hiatt
 * Author URI:        https://faithinmarketing.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fim_ministries
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
* Plugin Version
*/
define( 'FIM_MINISTRIES_VERSION', '2.1.0' );

/**
 * Plugin Activator
 */
function activate_fim_ministries() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fim-ministries-activator.php';
	FIM_Ministries_Activator::activate();
}

/**
 * Plugin Deactivation
 */
function deactivate_fim_ministries() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fim-ministries-deactivator.php';
	FIM_Ministries_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fim_ministries' );
register_deactivation_hook( __FILE__, 'deactivate_fim_ministries' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fim-ministries.php';

/**
 * Execute the plugin
 *
 * @since    2.0.0
 */
function run_fim_ministries() {

	$plugin = new FIM_Ministries();
	$plugin->run();

}
run_fim_ministries();
