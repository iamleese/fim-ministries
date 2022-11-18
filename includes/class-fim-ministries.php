<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://faithinmarketing.com
 * @since      2.0.0
 *
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      2.0.0
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/includes
 * @author     Melissa R Hiatt <melissa@faithinmarketing.com>
 */
class FIM_Ministries {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      FIM_Ministries_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function __construct() {
		if ( defined( 'FIM_MINISTRIES_VERSION' ) ) {
			$this->version = FIM_MINISTRIES_VERSION;
		} else {
			$this->version = '2.0.0';
		}
		$this->plugin_name = 'fim_ministries';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_block_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - FIM_Ministries_Loader. Orchestrates the hooks of the plugin.
	 * - FIM_Ministries_i18n. Defines internationalization functionality.
	 * - FIM_Ministries_Admin. Defines all hooks for the admin area.
	 * - FIM_Ministries_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fim-ministries-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fim-ministries-i18n.php';

		/**
		* The class that creates the custom post type.
		**/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fim-ministries-registerpost.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-fim-ministries-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-fim-ministries-public.php';

		/**
		* The class responsible for defining all actions related to blocks
		**/

		require_once plugin_dir_path( dirname(__FILE__) ). 'blocks/class-fim-ministries-blocks.php';

		$this->loader = new FIM_Ministries_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the FIM_Ministries_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new FIM_Ministries_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new FIM_Ministries_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		//Add Post Type
		$plugin_posttype = new FIM_Ministries_Post_Type($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action ( 'init', $plugin_posttype, 'create_ministry_page', 999 ); //create page
		$this->loader->add_action ( 'init', $plugin_posttype, 'create_ministries_post_type', 999 ); //create post type
		$this->loader->add_action ( 'init', $plugin_posttype, 'add_ministry_taxonomies', 999); //add categories
		$this->loader->add_action ( 'init', $plugin_posttype, 'register_ministry_meta', 999);

		//ADD POST TYPE SETTINGS
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_ministries_settings'); //register post settings
		$this->loader->add_action( 'admin_menu', $plugin_admin,'add_menu'); //add settings to admin menu
		$this->loader->add_filter( 'display_post_states', $plugin_admin, 'fim_ministries_post_states',10,2); //set post state label on dashboard

		//ADD BLOCK PATTERNS
		$this->loader->add_action('init', $plugin_admin, 'ministries_register_block_patterns', 9 );
		$this->loader->add_action('init', $plugin_admin, 'ministries_register_block_pattern_category', 9);

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new FIM_Ministries_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );


	}

	/**
	* Register all of the hooks related to blocks used by the plugin
	**/
	private function define_block_hooks(){

		// Only load blocks if its ministries
		function get_current_post_type() {
			global $post, $parent_file, $typenow, $current_screen, $pagenow;

			 $post_type = NULL;

			 if($post && (property_exists($post, 'post_type') || method_exists($post, 'post_type')))
					 $post_type = $post->post_type;

			 if(empty($post_type) && !empty($current_screen) && (property_exists($current_screen, 'post_type') || method_exists($current_screen, 'post_type')) && !empty($current_screen->post_type))
					 $post_type = $current_screen->post_type;

			 if(empty($post_type) && !empty($typenow))
					 $post_type = $typenow;

			 if(empty($post_type) && function_exists('get_current_screen'))
					 $post_type = get_current_screen();

			 if(empty($post_type) && isset($_REQUEST['post']) && !empty($_REQUEST['post']) && function_exists('get_post_type') && $get_post_type = get_post_type((int)$_REQUEST['post']))
					 $post_type = $get_post_type;

			 if(empty($post_type) && isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type']))
					 $post_type = sanitize_key($_REQUEST['post_type']);

			 if(empty($post_type) && 'edit.php' == $pagenow)
					 $post_type = 'post';

			 return $post_type;
		}

		$plugin_blocks = new FIM_Ministries_Blocks( $this->get_plugin_name(), $this->get_version() );

			$this->loader->add_action( 'init', $plugin_blocks, 'register_ministry_blocks');

			//load blocks used for templates
			$this->loader->add_action( 'init', $plugin_blocks, 'register_ministry_template_blocks');
			$this->loader->add_filter( 'block_categories', $plugin_blocks, 'add_block_category', 10, 2);


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @return    FIM_Ministries_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
