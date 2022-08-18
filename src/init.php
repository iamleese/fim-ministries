<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */

function fim_ministries_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'ministry-blocks',
				'title' => __( 'Ministry Blocks', 'ministry-blocks' ),
			),
		)
	);
}



add_filter( 'block_categories', 'fim_ministries_block_category', 10, 2);



function fim_ministries_block_assets() {
	// Register block styles for frontend.

	wp_enqueue_style(
		'fim_ministries-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-editor' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
}

add_action( 'enqueue_block_assets', 'fim_ministries_block_assets' );


function fim_ministries_block_editor_assets() { // phpcs:ignore
	
	// Register block editor script for backend.
	wp_enqueue_script(
		'fim_ministries-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_enqueue_style(
		'fim_ministries-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

		
}


// Hook: Block Editor assets.
add_action( 'enqueue_block_editor_assets', 'fim_ministries_block_editor_assets' );






//RENDERING
function fim_ministries_render_featured_image() {
	if(has_post_thumbnail()){
		$thumb = get_the_post_thumbnail_url();
		$display = '<img src="'.$thumb.'">';
		return $display;
		
	} 
}


add_shortcode('fim-ministry-image','fim_ministries_render_featured_image');

?>