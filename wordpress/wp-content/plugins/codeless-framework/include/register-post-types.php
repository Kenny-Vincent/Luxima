<?php

add_action('init', 'codeless_faq_register', 4);

/* FAQ REGISTER */

function codeless_faq_register() 

{

	$labels = array(

		'name' => _x('Faq', 'post type general name','codeless'),

		'singular_name' => _x('Faq Entry', 'post type singular name', 'codeless'),

		'add_new' => _x('Add New', 'faq', 'codeless'),

		'add_new_item' => __('Add New Faq Entry', 'codeless'),

		'edit_item' => __('Edit Faq Entry', 'codeless'),

		'new_item' => __('New Faq Entry', 'codeless'),

		'view_item' => __('View Faq Entry', 'codeless'),

		'search_items' => __('Search Faq Entries', 'codeless'),

		'not_found' =>  __('No Faq Entries found', 'codeless'),

		'not_found_in_trash' => __('No Faq Entries found in Trash', 'codeless'), 

		'parent_item_colon' => ''

	);

	

	$slugRule = "faq";

	

	$args = array(

		'labels' => $labels,

		'public' => true,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),

		'query_var' => true,

		'show_in_nav_menus'=> false,

		'supports' => array('title','thumbnail','editor')

	);

	register_post_type( 'faq' , $args );

	register_taxonomy("faq_entries", 

		array("faq"), 

		array(	"hierarchical" => true, 

		"label" => "Faq Categories", 

		"singular_label" => "Faq Categories", 

		"rewrite" => true,

		"query_var" => true

	));  


}


add_filter("manage_edit-faq_columns", "prod_edit_faq_columns");

add_action("manage_posts_custom_column",  "prod_custom_faq_columns");


function prod_edit_faq_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		

		"title" => "Title",

		"faq_entries" => "Categories"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}


function prod_custom_faq_columns($column)

{

	global $post;

	switch ($column)

	{

		case "description":

		

		break;

		case "price":

		

		break;

		case "faq_entries":

		echo get_the_term_list($post->ID, 'faq_entries', '', ', ','');

		break;

	}

}



add_action('init', 'codeless_portfolio_register', 1);



/* Portfolio Register */

function codeless_portfolio_register() 

{

	global $cl_redata;

	$labels = array(

		'name' => _x('Portfolio Items', 'post type general name', 'codeless'),

		'singular_name' => _x('Portfolio Entry', 'post type singular name', 'codeless'),

		'add_new' => _x('Add New', 'portfolio', 'codeless'),

		'add_new_item' => __('Add New Portfolio Entry', 'codeless'),

		'edit_item' => __('Edit Portfolio Entry', 'codeless'),

		'new_item' => __('New Portfolio Entry', 'codeless'),

		'view_item' => __('View Portfolio Entry', 'codeless'),

		'search_items' => __('Search Portfolio Entries', 'codeless'),

		'not_found' =>  __('No Portfolio Entries found', 'codeless'),

		'not_found_in_trash' => __('No Portfolio Entries found in Trash', 'codeless'), 

		'parent_item_colon' => ''

	);

	

	$slugRule = (isset($cl_redata["portfolio_slug"]) ? $cl_redata["portfolio_slug"] : '');

	

	$args = array(

		'labels' => $labels,

		'public' => true,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),

		'query_var' => true,

		'show_in_nav_menus'=> true,

		'supports' => array('title','thumbnail','excerpt','editor','comments')

	);

	

	

	

	register_post_type( 'portfolio' , $args );

	

	

	register_taxonomy("portfolio_entries", 

		array("portfolio"), 

		array(	"hierarchical" => true, 

		"label" => "Portfolio Categories", 

		"singular_label" => "Portfolio Categories", 

		"rewrite" => true,

		"query_var" => true

	));  

}



add_filter("manage_edit-portfolio_columns", "prod_edit_columns");

add_action("manage_posts_custom_column",  "prod_custom_columns");


function prod_edit_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		

		"title" => "Title",

		"portfolio_entries" => "Categories"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}


function prod_custom_columns($column)

{

	global $post;

	switch ($column)

	{

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "portfolio_entries":

		echo get_the_term_list($post->ID, 'portfolio_entries', '', ', ','');

		break;

	}

}


add_action('init', 'codeless_staff_register', 1);

/* Staff Register */

function codeless_staff_register() 
{

	$labels = array(
		'name' => _x('Team', 'post type general name', 'codeless'),
		'singular_name' => _x('Staff Entry', 'post type singular name', 'codeless'),
		'add_new' => _x('Add New', 'staff', 'codeless'),
		'add_new_item' => __('Add New Staff Entry', 'codeless'),
		'edit_item' => __('Edit Staff Entry', 'codeless'),
		'new_item' => __('New Staff Entry', 'codeless'),
		'view_item' => __('View Staff Entry', 'codeless'),
		'search_items' => __('Search Staff Entries', 'codeless'),
		'not_found' =>  __('No Staff Entries found', 'codeless'),
		'not_found_in_trash' => __('No Staff Entries found in Trash', 'codeless'), 
		'parent_item_colon' => ''
	);
	
	$slugRule = "staff_trusted";
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'supports' => array('title','thumbnail','editor')
	);
	
	
	
	register_post_type( 'staff' , $args );
	
	
	register_taxonomy("staff_entries", 
		array("staff"), 
		array(	"hierarchical" => true, 
		"label" => "Staff Categories", 
		"singular_label" => "Staff Categories", 
		"rewrite" => true,
		"query_var" => true
	));  
}

add_filter("manage_edit-staff_columns", "prod_edit_staff_columns");
add_action("manage_posts_custom_column",  "prod_custom_staff_columns");


function prod_edit_staff_columns($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		
		"title" => "Title",
		"staff_entries" => "Categories"
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}

function prod_custom_staff_columns($column)
{
	global $post;
	switch ($column)
	{
		
	
		case "description":
		
		break;
		case "price":
		
		break;
		case "staff_entries":
		echo get_the_term_list($post->ID, 'staff_entries', '', ', ','');
		break;
	}
}




add_action('init', 'codeless_testimonial_register', 1);

/* Testimonial Register */
function codeless_testimonial_register() 

{



	$labels = array(

		'name' => _x('Testimonials', 'post type general name', 'codeless'),

		'singular_name' => _x('Testimonial Entry', 'post type singular name', 'codeless'),

		'add_new' => _x('Add New', 'testimonial', 'codeless'),

		'add_new_item' => __('Add New Testimonial Entry', 'codeless'),

		'edit_item' => __('Edit Testimonial Entry', 'codeless'),

		'new_item' => __('New Testimonial Entry', 'codeless'),

		'view_item' => __('View Testimonial Entry', 'codeless'),

		'search_items' => __('Search Testimonial Entries', 'codeless'),

		'not_found' =>  __('No Testimonial Entries found', 'codeless'),

		'not_found_in_trash' => __('No Testimonial Entries found in Trash', 'codeless'), 

		'parent_item_colon' => ''

	);

	

	$slugRule = "testimonial_trusted";

	

	$args = array(

		'labels' => $labels,

		'public' => true,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),

		'query_var' => true,

		'show_in_nav_menus'=> false,

		'supports' => array('title','thumbnail','editor')

	);

	

	

	

	register_post_type( 'testimonial' , $args );

	

	

	register_taxonomy("testimonial_entries", 

		array("testimonial"), 

		array(	"hierarchical" => true, 

		"label" => "Testimonial Categories", 

		"singular_label" => "Testimonial Categories", 

		"rewrite" => true,

		"query_var" => true

	));  

}



add_filter("manage_edit-testimonial_columns", "prod_edit_testimonial_columns");

add_action("manage_posts_custom_column",  "prod_custom_testimonial_columns");


function prod_edit_testimonial_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		"title" => "Title",

		"testimonial_entries" => "Categories"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}


function prod_custom_testimonial_columns($column)

{

	global $post;

	switch ($column)

	{

		

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "testimonial_entries":

		echo get_the_term_list($post->ID, 'testimonial_entries', '', ', ','');

		break;

	}

}


add_action('init', 'codeless_slider_register', 1);


function codeless_slider_register() 

{



	$labels = array(

		'name' => _x('Slides', 'post type general name', 'codeless'),

		'all_items'	=> __('Slides','codeless' ),

		'singular_name' => _x('Slide', 'post type singular name', 'codeless'),

		'menu_name'	=> __('Codeless Slider','codeless' ),

		'add_new' => _x('Add New Slide', 'slide', 'codeless'),

		'add_new_item' => __('Add New Slide', 'codeless'),

		'edit_item' => __('Edit Slide', 'codeless'),

		'new_item' => __('New Slide', 'codeless'),

		'view_item' => __('View Slide', 'codeless'),

		'search_items' => __('Search Slides', 'codeless'),

		'not_found' =>  __('No Slides found', 'codeless'),

		'not_found_in_trash' => __('No Slides found in Trash', 'codeless'), 

		'parent_item_colon' => ''

	);



	$args = array(

		'labels' => $labels,

		'public' => true,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array('slug'=>'slides','with_front'=>true),

		'query_var' => true,

		'show_in_nav_menus'=> false,

		'supports' => array('title')

	);

	

	

	

	register_post_type( 'slide' , $args );

	

	$labels = array(
			
			'menu_name' => __( 'Sliders','codeless' ),

			'name' => __( 'Sliders', 'codeless' ),

			'singular_name' => __( 'Slider', 'codeless' ),

			'all_items' => __( 'All Sliders','codeless' ),

			'search_items' =>  __( 'Search Sliders','codeless' ),

			'parent_item' => __( 'Parent Slider','codeless' ),

			'parent_item_colon' => __( 'Parent Slider:','codeless' ),

			'update_item' => __( 'Update Slider','codeless' ),

			'add_new_item' => __( 'Add New Slider','codeless' ),

			'edit_item' => __( 'Edit Slider','codeless' ), 

			'new_item_name' => __( 'New Slider Name','codeless' )

			
	 );     

	register_taxonomy("slider", 

		array("slide"), 

		array(	"hierarchical" => true, 

		"labels" => $labels, 

		"singular_label" => "Slider", 

		"rewrite" => true,

		"query_var" => true

	));  

}



add_filter("manage_edit-slide_columns", "slide_edit_columns");

add_action("manage_posts_custom_column",  "slide_custom_columns");



function slide_edit_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		

		"title" => "Title",

		"slides" => "Sliders"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}



/**

 * prod_custom_columns()

 * 

 * @param mixed $column

 * @return

 */

function slide_custom_columns($column)

{

	global $post;

	switch ($column)

	{

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "slider":

		echo get_the_term_list($post->ID, 'slider', '', ', ','');

		break;

	}

}