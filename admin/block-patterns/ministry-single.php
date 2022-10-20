<?php
return array(
	'title'      => __( 'Single Ministry', 'fim_ministries' ),
	'categories' => array( 'ministries','pages' ),
	'content'    => '
	<!-- wp:columns {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns" style="margin-bottom:var(--wp--preset--spacing--70)"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:post-featured-image /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:fim-ministries/contact-info /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"placeholder":"Detailed description of your ministry"} -->
<p></p>
<!-- /wp:paragraph -->'
);
