<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://faithinmarketing.com
 * @since      2.0.1
 *
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/admin
 * @author     Melissa R Hiatt <melissa@faithinmarketing.com>
 */
class FIM_Ministries_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $option_name = 'fim_ministry';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.1
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
	 * @since    2.0.1
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fim-ministries-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.1
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fim-ministries-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function add_menu(){
			add_submenu_page(
			'edit.php?post_type=ministries',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Ministry Settings', 'fim_ministries' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Ministry Settings', 'fim_ministries' ) ),
			'manage_options',
			'fim_ministry_settings',
			array( $this, 'options_page' )
		);
	}

	function register_ministries_settings() {

		register_setting( $this->plugin_name, $this->option_name . '_page');

		//register settings
		add_settings_section(
			$this->option_name . '_general',
			__( 'Page Settings', 'fim_ministries' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		add_settings_field(
			$this->option_name . '_page',
			__( 'Ministry Listing Page', 'fim_ministries' ),
			array( $this, $this->option_name . '_page_cb' ), //callback
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_page' )
		);


	}
	/**
	* Options Page - shows the settings
	*/

	public function options_page() {
		include_once 'partials/fim-ministries-admin-display.php';
	} //end options_page

	/**
	* Callbacks
	*/

	public function fim_ministry_general_cb() {
		echo '<p>' . __( 'Settings for the Ministries Page.', 'fim_ministries' ) . '</p>';
	} //end fim_ministry_page_cb

	public function fim_ministry_page_cb(){
		$pages = get_pages();
		$pagelist ='<option value="">'.__('Please Select', 'fim_ministries').'</option>';
		$listpage = get_option( $this->option_name . '_page' );
		?>
		<fieldset>
				<label>
					<?php
          	foreach ( $pages as $page ) {
                  $pageid = str_replace(' ','',$page->ID);

									if( $listpage == $pageid) { $selected = 'selected'; } else { $selected = ''; }
                      $pagelist.= '<option value="'.$pageid.'" '.$selected.'>'.$page->post_title.'</option>';
                  }

                	printf('<select id="listpage" name="'.$this->option_name.'_page'.'">%s</select>', $pagelist);
            ?>
				</label>
		 </fieldset>

	<?php } //end fim_ministry_page_cb




	/**
	* Set Indicator for Directory Page under Page list
	**/
	public function fim_ministries_post_states( $post_states, $post ) {

      $page_id = get_option( $this->option_name . '_page') ;

      if ( $page_id == $post->ID ) {
          $post_states[] = _('Ministry Listing Page');
			}

      return $post_states;
	}

	/**
	* Create Block Patterns for ministries
	**/

	public function ministries_register_block_patterns(){
		$block_pattern_categories = array(
			'ministries' => array( 'label' => __( 'Ministries', 'fim_ministries' ) )
		);

		$block_patterns = array(
			'ministry-archive',
			'ministry-single'
		);


		$block_patterns = apply_filters( 'fim_ministries_block_patterns', $block_patterns );

		foreach ( $block_patterns as $block_pattern ) {
			$pattern_file =   plugin_dir_path( dirname( __FILE__ ) ) .'admin/block-patterns/' . $block_pattern . '.php';

			register_block_pattern(
				$this->plugin_name . '/' . $block_pattern,
				require $pattern_file
			);
		}

	}

	public function ministries_register_block_pattern_category(){
		register_block_pattern_category( 'ministries', array(
				'label' => __('Ministries','fim_ministries')
		) );
	}

}
