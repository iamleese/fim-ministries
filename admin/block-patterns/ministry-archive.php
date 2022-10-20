<?php
return array(
	'title'      => __( 'Ministry Archive', 'fim_ministries' ),
	'categories' => array( 'ministries', 'pages' ),
	'content'    => '
      <!-- wp:columns -->
      <div class="wp-block-columns"><!-- wp:column {"width":"25%"} -->
      <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"className":"fim-category-list-container"} -->
      <div class="wp-block-group fim-category-list-container" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:heading {"level":3,"className":"fim-ministry-category-list-heading"} -->
      <h3 class="fim-ministry-category-list-heading">'.__('Our Ministries', 'fim_ministries').'</h3>
      <!-- /wp:heading -->

      <!-- wp:fim-ministries/ministry-categories /--></div>
      <!-- /wp:group --></div>
      <!-- /wp:column -->

      <!-- wp:column {"width":"75%"} -->
      <div class="wp-block-column" style="flex-basis:75%"><!-- wp:fim-ministries/ministry-listing /--></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->'
);
