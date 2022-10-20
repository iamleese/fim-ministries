<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://faithinmarketing.com
 * @since      2.0.0
 *
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0.0
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/includes
 * @author     Melissa R Hiatt <melissa@faithinmarketing.com>
 */
class FIM_Ministries_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'fim_ministries',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
