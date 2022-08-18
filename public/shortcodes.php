<?php 
/*-----SHORTCODES-----*/

function ministryCategoryList($atts){
	$a = shortcode_atts(array(
					'archive_link' => 1,
					'title' 	   => ''
							 ), $atts);
	
	$categories = get_terms( array(
			'taxonomy' => 'ministry-category',
			'parent' => 0,
			'orderby' => 'name',
			'order' => 'ASC'
			) );
	$option = get_option('fim_ministries_options');

	if($a['title'] == ''){
		//get the ministry page title
		$ministry_title = get_the_title($option['listpage']);
	
	} else {
		$ministry_title = $a['title'];
	}
	
	$ministries_list .= '<div class="ministry-category-nav">';
	
	if($a['archive_link'] == 1){
		$ministry_page_link = get_permalink($option['listpage']);
		$ministries_list .= '<h2 class="ministry_header"><a href="'.$ministry_page_link.'">'.$ministry_title.'</a></h2>';
	} else {
		$ministries_list .= '<h2 class="ministry_header">'.$ministry_title.'</h2>';
	}
	
	$ministries_list .= '<ul>';
		
	foreach($categories as $category){
		
		$ministries_list .='<li><a href="'. get_term_link($category->term_id,'ministry-category').'">'.$category->name.'</a></li>';
	}
	
	$ministries_list .= '</ul></div>';

	return $ministries_list;
}

add_shortcode('ministry_categories','ministryCategoryList');
?>