<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://faithinmarketing.com
 * @since      2.0.1
 *
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 *  @package    FIM_Ministries
* @subpackage FIM_Ministries/public
 * @author     Melissa R Hiatt <melissa@faithinmarketing.com>
 */
class FIM_Ministries_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $option_name = 'fim_ministry';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fim-ministries-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {


		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fim-ministries-public.js', array( 'jquery' ), $this->version, false );

	}

	public function ministries_archive_display($content){

			if( is_post_type_archive('ministries') ){
			$ministry_page = get_option($this->option_name.'_page');
			$post = get_post($ministry_page);
			$content = $post->post_content;
		}
		return $content;

	}


}
