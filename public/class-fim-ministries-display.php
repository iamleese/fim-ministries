<?php
// Exit if accessed directly.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class displayMinistries{
	
	//declare variables
	
	private $postid;
	private $ministries_opt;
	
	//Show Single Ministry
	public function singleMinistry(){
		global $post;
		
		$html = wpautop(get_the_content($post->ID));
		
		
		return $html;
				
	}// end Single Ministry
	
	
	//Ministry Pages Within Categories
	public function MinistryPages($category, $taxonomy_name){
		global $wpdb;
		$posttable = $wpdb->posts;
		$termrelation = $wpdb->term_relationships;
		$taxonomy_name = 'ministry-category';

		$pagelist = $wpdb->get_results("SELECT $posttable.ID,$posttable.post_title FROM $posttable,$termrelation WHERE $posttable.post_type LIKE '%ministries%' AND $posttable.post_status LIKE '%publish%' AND $posttable.ID = $termrelation.object_id AND $termrelation.term_taxonomy_id = $category ORDER BY $posttable.post_title ASC");

		$ministry_pages = '';
		
		foreach($pagelist as $page){
			$ministry_pages .= '<li id="ministry-id-'.$page->ID.'"><a href="'.get_the_permalink($page->ID).'">'.$page->post_title.'</a></li>';
		}
		
		return $ministry_pages;
	}
	
	
	//Ministry Category list
	public function MinistriesCategoryList($category, $taxonomy_name = 'ministry-category'){
		
		$ministry_category = $this->MinistryPages($category, $taxonomy_name);
		
		$term_children = get_term_children( $category, $taxonomy_name );

		if($term_children){
			$ministry_category .= '<ul class="sub_category">';

			foreach ( $term_children as $child ) {
				$term = get_term_by( 'id', $child, $taxonomy_name );
				$ministry_category .= '<li class="sub_category_title"><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
				$this->MinistryPages($term->term_id,$taxonomy_name);
			}

				$ministry_category .= '</ul>';
			}
		
		return $ministry_category;

	} //end Ministries Category List

	//Ministry Full List
	public function MinistriesList(){
		$categories = get_terms( array(
			'taxonomy' => 'ministry-category',
			'parent' => 0,
			'orderby' => 'name',
			'order' => 'ASC'
			) );
		$ministries_list = '<div class="ministries-list">';
		foreach($categories as $category){
			$ministries_list .= '<div class="ministry-category-wrap">';
			$ministries_list .='<h3 class="ministry-category-name"><a href="'. get_term_link($category->term_id,'ministry-category').'">'.$category->name.'</a></h3>';
			$ministries_list .= $this->MinistriesCategoryList($category->term_id);
			$ministries_list .= '</div>';
		}
		$ministries_list .= '</div>';
		return $ministries_list;
		
	}
	

}
?>