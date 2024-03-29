<?php
/**
 * Blocks for the Gutenberg
 *
 * @link       https://faithinmarketing.com
 * @since      2.0.1
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/blocks
 */

/**
 * Gives block functions
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/admin
 * @author     Melissa R Hiatt <melissa@faithinmarketing.com>
 */

class FIM_Ministries_Blocks {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

  public function add_block_category( $categories, $post ) {

  	return array_merge(
  		$categories,
  		array(
  			array(
  				'slug' => 'ministry-blocks',
  				'title' => __( 'Ministry Blocks', 'ministry-blocks' )
  			),
  		)
  	);

  }

	public function register_ministry_blocks(){
		register_block_type( __DIR__ . '/build/contact-info' );
		register_block_type( __DIR__ . '/build/contact-group' );
	}


	public function register_ministry_template_blocks(){
		register_block_type( __DIR__ . '/build/ministry-listing', array(
			'render_callback' => array($this, 'MinistriesList'),
			'attributes' => [
					'hide_empty' => ['type' => 'boolean', 'default' => true ]
			]
		));

		register_block_type( __DIR__ . '/build/ministry-categories', array(
			'render_callback' => array($this, 'MinistriesCategoryMenu'),
			'attributes' => [
					'show_subcategories' => ['type' => 'boolean', 'default' => true ],
					'hide_empty' => ['type' => 'boolean', 'default' => false ],
					'show_all' => ['type' => 'boolean', 'default' => true ],
					'show_all_text' => ['type' => 'string', 'default' => "All Ministries"]
			]
		));
		register_block_type( __DIR__ . '/build/ministry-category-description', array(
			'render_callback' => array($this, 'MinistryCategoryDescription')
		));

		register_block_type( __DIR__ . '/build/ministry-page-content', array(
			'render_callback' => array($this, 'MinistryPageContent'),
			'attributes' => [
					'align' => ['type' => 'string',
											'default' => ''],
					'className' => ['type' => 'string',
													'default' => 'wp-blocks-fim-ministries-ministry-page-content']
				]
		));

	}

	private $postid;
	private $ministries_opt;


	//Ministry Pages Within Categories
	public function MinistryPages($category, $taxonomy_name){
		ob_start();
	
		$taxonomy_name = 'ministry-category';

		$args = [
			'post_type' => 'ministries',
			'tax_query' => [
					['taxonomy' => $taxonomy_name,
					'field' => 'term_id',
					'terms' => $category,
					'include_children' => false
					]				
				]
			];
		

		$pagelist = new WP_QUERY($args);

		//$pagelist = $wpdb->get_results("SELECT $posttable.ID,$posttable.post_title FROM $posttable,$termrelation WHERE $posttable.post_type LIKE '%ministries%' AND $posttable.post_status LIKE '%publish%' AND $posttable.ID = $termrelation.object_id AND $termrelation.term_taxonomy_id = $category ORDER BY $posttable.post_title ASC");

		$ministry_pages = '';

		if($pagelist->have_posts()){
			while($pagelist->have_posts()){
				$pagelist->the_post();
				$ministry_pages .= '<li id="ministry-id-'.get_the_ID().'"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

			}
			

		}
	

		$ministry_pages .= ob_get_clean();
		wp_reset_postdata();

		return $ministry_pages;
	}

	//Ministry Categories and Subcategories
	public function MinistriesCategoryMenu($attributes){
		ob_start();
		$show_subcategories = $attributes['show_subcategories'];
		$hide_empty = $attributes['hide_empty'];
		$show_all = $attributes['show_all'];
		$show_all_text = $attributes['show_all_text'];
		$taxonomy_name = 'ministry-category';

		$categories = get_terms( array(
			'taxonomy' => $taxonomy_name,
			'parent' => 0,
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => $hide_empty
			) );

		$ministry_category = '<ul class="ministry_category_menu">';

		if( $show_all ){

			if(empty($show_all_text)) {
				$show_all_text = __('All Ministries', 'fim_ministries');
			} else {
				$show_all_text = __($show_all_text , 'fim_ministries');
			}

			$archive_id = get_option($this->option_name.'_page');
			$ministry_category .= '<li><a href="'.get_the_permalink($archive_id).'">'.$show_all_text.'</a></li>';
		}


		foreach($categories as $category):
			$ministry_category .= '<li id="category-id-'.$category->term_id.'"><a href="'.get_term_link( $category->term_id, 'ministry-category' ).'">'. $category->name .'</a>';

		if( $show_subcategories === true ):

				$term_children = get_term_children( $category->term_id, $taxonomy_name );

				if($term_children){

					$ministry_category .= '<ul class="sub_category">';

					foreach ( $term_children as $child ) {
						$term = get_term_by( 'id', $child, $taxonomy_name );
						if($term->count > 0 || ( $hide_empty == false && $term->count == 0 ) ) {
							$ministry_category .= '<li class="sub_category_title"><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
						}
					}

						$ministry_category .= '</ul>';
				}

		endif; //subcategories

			$ministry_category .= '</li>';

		endforeach;

		$ministry_category .= '</ul><!-- end category menu -->';

		$ministry_category .= ob_get_clean();

		return $ministry_category;

	} //end Ministries Category List


	//Ministry Category list
	public function MinistriesCategoryList($category, $hide_empty){
		ob_start();
		$taxonomy_name = 'ministry-category';

		$ministry_category = $this->MinistryPages($category, $taxonomy_name);

		$term_children = get_term_children( $category, $taxonomy_name );

		if($term_children){
			$ministry_category .= '<ul class="sub_category">';

			foreach ( $term_children as $child ) {
				$term = get_term_by( 'id', $child, $taxonomy_name );
				if($term->count > 0 || ( $hide_empty == false && $term->count == 0 ) ) {
					$ministry_category .= '<li class="sub_category_title"><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
					$ministry_category .= $this->MinistryPages($term->term_id,$taxonomy_name);
				}
			}

				$ministry_category .= '</ul>';
		}

		$ministry_category .= ob_get_clean();

		return $ministry_category;

	} //end Ministries Category List

	//Ministry Full List
	public function MinistriesList($attributes){
		
		$hide_empty = $attributes['hide_empty'];

		$ministry_categories = get_terms('ministry-category', ['fields' => 'ids']);


		$args = [
				'post_type' => 'ministries',
				'tax_query' => [
						['taxonomy' => 'ministry-category',
						'field' => 'term_id',
						'operator' => 'NOT EXISTS',
						'terms' => $ministry_categories
						]
					]
				];

		$noterms = new WP_QUERY($args);

		$ministries_list = '<div class="ministries-list">';
		

		if($noterms->have_posts()){
			$ministries_list .= '<div class="ministry-category-wrap">';
			while ($noterms->have_posts()) {
				$noterms->the_post();
				$ministries_list .= '<li id="ministry-id-'.get_the_ID().'"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
			}
			$ministries_list .= '</div>';
				
		}

		wp_reset_postdata();

		/*if($category == ''){*/

			$categories = get_terms( array(
				'taxonomy' => 'ministry-category',
				'parent' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => $hide_empty
				) );

				foreach($categories as $category){
					$ministries_list .= '<div class="ministry-category-wrap">';
					$ministries_list .='<h3 class="ministry-category-name"><a href="'. get_term_link($category->term_id,'ministry-category').'">'.$category->name.'</a></h3>';
					$ministries_list .= $this->MinistriesCategoryList($category->term_id, $hide_empty);
					$ministries_list .= '</div>';
				}

		/*} else {

				$ministries_list .= '<div class="ministry-category-wrap">';

				if($display_name === true){
					$term = get_term($category_id);
					$link = get_term_link($term);
					$ministries_list .= '<h3 class="ministry-category-name"><a href="'.$link.'">'.$term->name.'</a></h3>';
				}
				$ministries_list .= $this->MinistriesCategoryList($category_id, $hide_empty);
				$ministries_list .= '</div>';
		}*/

			$ministries_list .= '</div>';

		$ministries_list .= ob_get_clean();

		return $ministries_list;

	}

	//Ministry Category Description

	public function MinistryCategoryDescription(){
		return term_description();
	}

	public function MinistryPageContent($attributes){

		$className = $attributes['className'];
		$align = $attributes['align'] ? $attributes['align'] : '';

		$blockProps = implode(' ', array($className, $align ? 'align'.$align : ''));
		$ministry_page = get_option($this->option_name.'_page');
		$postcontent = get_post_field('post_content', $ministry_page);

		ob_start();
		$content = '<div class="'.$blockProps.'">';
		$content .= apply_filters('the_content',$postcontent);
		$content .= '</div>';
		$content .= ob_get_clean();
		return $content;
	}

}