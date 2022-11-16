<?php
return array(
	'title'      => __( 'Single Ministry', 'fim_ministries' ),
	'categories' => array( 'ministries','pages' ),
	'content'    => '
	<!-- wp:group {"className":"ministry-page-contact","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top","justifyContent":"left"}} -->
	<div class="wp-block-group ministry-page-contact"><!-- wp:post-featured-image {"style":{"border":{"width":"0px","style":"none"}}} /-->

	<!-- wp:fim-ministries/contact-group -->
	<div class="wp-block-fim-ministries-contact-group"><!-- wp:fim-ministries/contact-info -->
	<div class="wp-block-fim-ministries-contact-info"></div>
	<!-- /wp:fim-ministries/contact-info --></div>
	<!-- /wp:fim-ministries/contact-group --></div>
	<!-- /wp:group -->

<!-- wp:paragraph {"placeholder":"Detailed description of your ministry"} -->
<p></p>
<!-- /wp:paragraph -->'
);
