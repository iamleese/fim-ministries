<?php
//render post image
function render_fim_ministries_featured_image( ) {
	global $post;
	

	if(!has_post_thumbnail() ) {
		return;
	} else {
		return the_post_thumbnail();
	}
	
}

?>