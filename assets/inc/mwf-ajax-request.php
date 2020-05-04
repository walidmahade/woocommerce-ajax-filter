<?php
/*
*
*	***** mw-woo-filter *****
*
*	Ajax Request
*
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
Ajax Requests
*/
add_action('wp_ajax_myfilter', 'misha_filter_function'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');

function misha_filter_function(){
	$args = array(
		'orderby' => 'date', // we will sort posts by date
		'order'	=> 'ASC', // ASC or DESC
		'post_type' => 'product'
	);

//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';
//	var_dump( $_POST['product_attributes']);

//	$terms_arr = [];
	$args['tax_query'] = array(
		'relation' => 'AND',
	);

	foreach ($_POST['product_attributes'] as $key=>$prod_attr) {
		if (!empty($prod_attr)) {
			// array_push($terms_arr, $prod_attr);
			array_push($args['tax_query'], array(
				'taxonomy' => $key,
				'field' => 'id',
				'terms' => $prod_attr
			));
		}
	}

//	echo '<pre>';
//	var_dump($args);
//	echo '</pre>';
	// create $args['meta_query'] array if one of the following fields is filled
//	if( isset( $_POST['price_min'] ) && $_POST['price_min'] || isset( $_POST['price_max'] ) && $_POST['price_max'] || isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' )
//		$args['meta_query'] = array( 'relation'=>'AND' ); // AND means that all conditions of meta_query should be true

	// if both minimum price and maximum price are specified we will use BETWEEN comparison
//	if( isset( $_POST['price_min'] ) && $_POST['price_min'] && isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
//		$args['meta_query'][] = array(
//			'key' => '_price',
//			'value' => array( $_POST['price_min'], $_POST['price_max'] ),
//			'type' => 'numeric',
//			'compare' => 'between'
//		);
//	} else {
//		// if only min price is set
//		if( isset( $_POST['price_min'] ) && $_POST['price_min'] )
//			$args['meta_query'][] = array(
//				'key' => '_price',
//				'value' => $_POST['price_min'],
//				'type' => 'numeric',
//				'compare' => '>'
//			);

	// if only max price is set
//		if( isset( $_POST['price_max'] ) && $_POST['price_max'] )
//			$args['meta_query'][] = array(
//				'key' => '_price',
//				'value' => $_POST['price_max'],
//				'type' => 'numeric',
//				'compare' => '<'
//			);
//	}


	// if post thumbnail is set
//	if( isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' )
//		$args['meta_query'][] = array(
//			'key' => '_thumbnail_id',
//			'compare' => 'EXISTS'
//		);
	// if you want to use multiple checkboxed, just duplicate the above 5 lines for each checkbox

	$query = new WP_Query( $args );

	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
			wc_get_template_part( 'content', 'product' );
		endwhile;
		wp_reset_postdata();
	else :
		echo 'No products found';
	endif;

	die();
}
