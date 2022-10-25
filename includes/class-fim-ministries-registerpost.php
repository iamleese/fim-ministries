<?php

/**
 * Register post type for the plugin
 * Creates a "Ministry" custom post type, Creates ministry index page, Adds Menu item, registers post meta, registers category taxonomy.

 *
 * @link       https://faithinmarketing.com
 * @since      2.0.1
 *
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/includes
  * @author     Faith in Marketing <melissa@faithinmarketing.com>
 */

/**
 */
class FIM_Ministries_Post_Type {

    public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
        $this->version = $version;

        global $wpdb;

	}

    /**
    * Create ministry page
    *
    */
    public function create_ministry_page(){

        if(get_option('fim_ministry_page') == ''){
  			     $fim_ministry_page = array(
  			          'post_title' => __('Ministries','fim_ministries'),
                  'post_name' => 'Ministries',
  			          'post_content' => '',
  					      'post_status' => 'publish',
  			          'post_type' => 'page'
                );

				      $post_id = wp_insert_post($fim_ministry_page);

              update_option( 'fim_ministry_page', $post_id );
        }
    } //end create_ministry_page

    public function create_ministries_post_type(){

  		// let's create the function for the custom type
  			$ministry_id = get_option('fim_ministry_page');

  			if($ministry_id){
  				$postinfo = get_post($ministry_id);
  				$rewrite_slug = $postinfo->slug;
  			} else {
  				$rewrite_slug = 'ministries';
  			}

        $labels = array(
            'name'                  => _x( 'Ministries', 'Ministries', 'fim_ministries' ),
            'singular_name'         => _x( 'Ministry', 'Ministry', 'fim_ministries' ),
            'menu_name'             => __( 'Ministries', 'fim_ministries' ),
            'name_admin_bar'        => __( 'Ministries', 'fim_ministries' ),
            'archives'              => __( 'Ministry Archives', 'fim_ministries' ),
            'all_items'             => __( 'All Ministries', 'fim_ministries' ),
            'add_new_item'          => __( 'Add New Ministry', 'fim_ministries' ),
            'add_new'               => __( 'Add New', 'fim_ministries' ),
            'new_item'              => __( 'New Ministry', 'fim_ministries' ),
            'edit_item'             => __( 'Edit Ministry', 'fim_ministries' ),
            'update_item'           => __( 'Update Ministry', 'fim_ministries' ),
            'view_item'             => __( 'View Ministry', 'fim_ministries' ),
            'view_items'            => __( 'View Ministries', 'fim_ministries' ),
            'search_items'          => __( 'Search Ministry', 'fim_ministries' ),
            'not_found'             => __( 'Not found', 'fim_ministries' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'fim_ministries' ),
            'featured_image'        => __( 'Featured Image ', 'fim_ministries' ),
            'set_featured_image'    => __( 'Set Featured Image', 'fim_ministries' ),
            'remove_featured_image' => __( 'Remove Featured Image', 'fim_ministries' ),
            'use_featured_image'    => __( 'Use Featured Image', 'fim_ministries' ),
        );

        $args =  array(
          'label'                 => __( 'Ministry', 'fim_ministries' ),
          'description'           => __( 'Ministry', 'fim_ministries' ),
          'labels'                => $labels,
          'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
          'taxonomies'            => array( 'ministry-tag', 'ministry-category' ),
          'hierarchical'          => true,
          'public'                => true,
          'show_ui'               => true,
          'show_in_menu'          => true,
          'menu_position'         => 8,
          'show_in_admin_bar'     => true,
          'show_in_nav_menus'     => true,
          'can_export'            => true,
          'has_archive'           => true,
          'exclude_from_search'   => false,
          'menu_icon'             => plugin_dir_url(__FILE__).'images/fim_ministry_icon.png',
          'rewrite'	            => array( 'slug' => $rewrite_slug, 'with_front' => true ),
          'publicly_queryable'    => true,
          'capability_type'       => 'post',
          'show_in_rest'          =>  true,
          'template' => array(
                  array('core/columns',
                    array('style' => array('spacing' => array('margin' => array('bottom' => 'var:preset|spacing|70') )) ),
                    array(
                        array('core/column', array('width' => '66.66%'), array(array('core/post-featured-image'))),
                        array('core/column', array('width' => '33.33%'), array(array('fim-ministries/contact-info')))
                    )
                  ),
                  array('core/paragraph', array(
                    'placeholder' => __('Detailed description of your ministry', 'fim_ministries')
                  ))
            )
        );


  			register_post_type( 'ministries', $args );

  			/* this adds your post categories and tags to your Ministry type */
  			register_taxonomy_for_object_type( 'ministry-category', 'ministries' );
  			register_taxonomy_for_object_type( 'ministry-tag', 'ministries' );

  			flush_rewrite_rules();

  	} //end create_ministry_post_type


    /*
    * ADD CATEGORIES AND TAGS
    */

    public function add_ministry_taxonomies(){

      register_taxonomy( 'ministry-category',
        array('ministries'), /* if you change the name of register_post_type( 'ministries', then you have to change this */
        array('hierarchical' => true,     /* if this is true, it acts like categories */
          'labels' => array(
            'name' => __( 'Ministry Categories', 'fim-ministries' ), /* name of the custom taxonomy */
            'singular_name' => __( 'Ministry Category', 'fim-ministries' ), /* single taxonomy name */
            'search_items' =>  __( 'Search Ministry Categories', 'fim-ministries' ), /* search title for taxomony */
            'all_items' => __( 'All Ministry Categories', 'fim-ministries' ), /* all title for taxonomies */
            'parent_item' => __( 'Parent Ministry Category', 'fim-ministries' ), /* parent title for taxonomy */
            'parent_item_colon' => __( 'Parent Ministry Category:', 'fim-ministries' ), /* parent taxonomy title */
            'edit_item' => __( 'Edit Ministry Category', 'fim-ministries' ), /* edit Ministry taxonomy title */
            'update_item' => __( 'Update Ministry Category', 'fim-ministries' ), /* update title for taxonomy */
            'add_new_item' => __( 'Add New Ministry Category', 'fim-ministries' ), /* add new title for taxonomy */
            'new_item_name' => __( 'New Ministry Category Name', 'fim-ministries' ) /* name title for taxonomy */
          ),
          'show_admin_column' => true,
          'show_ui' => true,
          'query_var' => true,
          'rewrite' => array( 'slug' => 'ministry-category' ),
          'supports' => array('title','editor','thumbnail'),
          'show_in_rest' => true

        ) /* end of options */
      );

      // Add custom tags (these act like categories)
      register_taxonomy( 'ministry-tag',
        array('ministries'), /* if you change the name of register_post_type( 'ministries', then you have to change this */
        array('hierarchical' => true,    /* if this is false, it acts like tags */
          'labels' => array(
            'name' => __( 'Ministry Tags', 'fim-ministries' ), /* name of the ministry taxonomy */
            'singular_name' => __( 'Ministry Tag', 'fim-ministries' ), /* single taxonomy name */
            'search_items' =>  __( 'Search Ministry Tags', 'fim-ministries' ), /* search title for taxomony */
            'all_items' => __( 'All Ministry Tags', 'fim-ministries' ), /* all title for taxonomies */
            'parent_item' => __( 'Parent Ministry Tag', 'fim-ministries' ), /* parent title for taxonomy */
            'parent_item_colon' => __( 'Parent Ministry Tag:', 'fim-ministries' ), /* parent taxonomy title */
            'edit_item' => __( 'Edit Ministry Tag', 'fim-ministries' ), /* edit ministry taxonomy title */
            'update_item' => __( 'Update Ministry Tag', 'fim-ministries' ), /* update title for taxonomy */
            'add_new_item' => __( 'Add New Ministry Tag', 'fim-ministries' ), /* add new title for taxonomy */
            'new_item_name' => __( 'New Ministry Tag Name', 'fim-ministries' ) /* name title for taxonomy */
          ),
          'show_admin_column' => true,
          'meta_box_cb'	=> 'post_categories_meta_box',
          'show_ui' => true,
          'query_var' => true,
          'show_in_rest' => true
        )
      );
    } //end add_ministry_taxonomies

    /**
    * Add Meta fields
    **/
    public function register_ministry_meta(){

        $custom_fields = [
            'contact_info'
        ];

        foreach ($custom_fields as $custom_field) {
            register_post_meta('ministries', $custom_field, array(
                'show_in_rest' => true,
                'type' => 'string',
                'single' => true,
                'auth_callback' => function() {
                    return current_user_can( 'edit_posts' );
                }
            ));
        }

    } //end register_ministry_meta

}
