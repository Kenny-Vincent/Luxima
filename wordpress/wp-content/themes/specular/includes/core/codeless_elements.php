<?php

vc_remove_element("vc_button");

vc_remove_element("vc_posts_slider");

vc_remove_element("vc_gmaps");

vc_remove_element("vc_teaser_grid");

vc_remove_element("vc_progress_bar");

//vc_remove_element("vc_facebook");

vc_remove_element("vc_tweetmeme");

vc_remove_element("vc_googleplus");

//vc_remove_element("vc_facebook");

vc_remove_element("vc_pinterest");

vc_remove_element("vc_message");

//vc_remove_element("vc_posts_grid");

vc_remove_element("vc_carousel");

vc_remove_element("vc_flickr");

vc_remove_element("vc_tour");

//vc_remove_element("vc_separator");

vc_remove_element("vc_single_image"); 

vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");

vc_remove_element("vc_images_carousel");

vc_remove_element("vc_wp_archives");

vc_remove_element("vc_wp_calendar");

vc_remove_element("vc_wp_categories");

vc_remove_element("vc_wp_custommenu");

vc_remove_element("vc_wp_links");

vc_remove_element("vc_wp_meta");

vc_remove_element("vc_wp_pages");

vc_remove_element("vc_wp_posts");

vc_remove_element("vc_wp_recentcomments");

vc_remove_element("vc_wp_rss");

vc_remove_element("vc_wp_search");

vc_remove_element("vc_wp_tagcloud");

vc_remove_element("vc_wp_text");

vc_remove_element("vc_pie");

//vc_remove_element("vc_widget_sidebar");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
//vc_remove_element("vc_wp_text");
//vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
//vc_remove_element("vc_button");
//vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_message");
vc_remove_element("vc_tour");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
//vc_remove_element("vc_toggle");
vc_remove_element("vc_images_carousel");
//vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
//vc_remove_element("vc_btn");
vc_remove_element("vc_cta");
//vc_remove_element("vc_round_chart");
//vc_remove_element("vc_line_chart");
//vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_tour");
//vc_remove_element("vc_tta_tabs");


// VC_Row Mods/Additions
vc_remove_param("vc_row", "css");

vc_remove_param("vc_row", "bg_color");

vc_remove_param("vc_row", "video_bg");

vc_remove_param("vc_row", "font_color");

vc_remove_param("vc_row", "margin_bottom");

//vc_remove_param("vc_row", "bg_image");

vc_remove_param("vc_row", "bg_image_repeat");

//vc_remove_param("vc_row", "padding");

vc_remove_param("vc_row", "el_class");

vc_remove_param("vc_row", "full_width");

vc_remove_param("vc_row", "gap");

vc_remove_param("vc_row", "full_height");

vc_remove_param("vc_row", "equal_height");

vc_remove_param("vc_row", "rtl_reverse");

vc_remove_param("vc_row", "content_placement");

vc_remove_param("vc_row", "columns_placement");

vc_remove_param("vc_row", "parallax");

vc_remove_param("vc_row", "parallax_speed_bg");

vc_remove_param("vc_row", "parallax_image");


vc_remove_param( "vc_custom_heading", "use_theme_fonts" );
vc_add_param( "vc_custom_heading", array(
  'type' => 'checkbox',
  'heading' => __( 'Use theme default font family?', 'specular' ),
  'param_name' => 'use_theme_fonts',
  'value' => array( __( 'Yes', 'specular' ) => 'yes' ),
  'std' => 'yes',
  'description' => __( 'Use font family from the theme.', 'specular' ),
  'weight' => 100
) );

/*active_vc();*/
$portfolio_types = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=portfolio_entries');



$portfolio_terms = array();

if(!empty($portfolio_types)){

  foreach ($portfolio_types as $type) {

    if(isset($type->term_id))

      $portfolio_terms[$type->name] = $type->term_id;

  }

}







$blog_types = get_categories('title_li=&orderby=name&hide_empty=0');



$blog_terms = array();

if(!empty($blog_types)){

  foreach ($blog_types as $type) {

    if(isset($type->term_id))

      $blog_terms[$type->name] = $type->term_id;

  }

}

$args = array( 'posts_per_page' => 9999 );

$blog_posts = get_posts($args);

$post_terms = array();

if(!empty($blog_posts)){

     foreach ( $blog_posts as $posts ):

            if(isset($posts->ID))

                  $post_terms[$posts->post_title] = $posts->ID;
      endforeach;
}


$image_sizes_ = array();
$image_sizes = codeless_get_image_sizes();
if(!empty($image_sizes) ){
  foreach ($image_sizes as $key => $value) {
    $image_sizes_[$value['width'].' x '.$value['height']] = $key;
  }
}


$pages_entries = get_pages('title_li=&orderby=name');

$pages = array();



if(!empty($pages_entries) ){

  foreach($pages_entries as $p){

      $pages[$p->post_title] = $p->ID;

  }

}


$posts_entries = get_posts('title_li=&orderby=name&numberposts=-1');

$posts = array();



if(!empty($posts_entries) ){

  foreach($posts_entries as $p){

      $posts[$p->post_title] = $p->ID;

  }

}




$test_entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=testimonial');

$testimonials = array();



if(!empty($test_entries) ){

  foreach($test_entries as $p){

      $testimonials[$p->post_title] = $p->ID;

  }

}

$staff_entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=staff');

$staff = array();



if(!empty($staff_entries) ){

  foreach($staff_entries as $p){

      $staff[$p->post_title] = $p->ID;

  }

}


$testimonials_cat = array();
$testimonials_cat['Retrive from all categories'] = 0;
$testimonials_cat_term = get_terms('testimonial_entries');

foreach ($testimonials_cat_term as $term) {
  if( is_object( $term ) )
    $testimonials_cat[$term->name] = $term->term_id;
}

$staff_cat = array();
$staff_cat['Retrive from all categories'] = 0;
$staff_cat_term = get_terms('staff_entries');

foreach ($staff_cat_term as $term) {
  if( is_object( $term ) )
    $staff_cat[$term->name] = $term->term_id;
}

$faq_cat = array();
$faq_cat['Retrive from all categories'] = 0;
$faq_cat_term = get_terms('faq_entries');

foreach ($faq_cat_term as $term) {
  if(is_object($term))
  $faq_cat[$term->name] = $term->term_id;
}







vc_map( array (

  'base' => 'block_title',

  'name' => esc_attr__('Title Heading', 'specular'),

  'description' => esc_attr__('Block title heading, section and column', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/title_heading.png',

  'params' => 

  array (


      array (

      'heading' => esc_attr__('Type', 'specular'),

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => array(

            esc_attr__('Section Title (Centered)', 'specular') =>'section_title',
            esc_attr__('Column Title (Left Aligned)', 'specular') =>'column_title' 

      )

    ),

    array (

      'heading' => esc_attr__('Title', 'specular'),

      'param_name' => 'title',

      'type' => 'textfield',

      'holder' => 'h3'

    ),

     array (

      'heading' => esc_attr__('Second Title', 'specular'),

      'holder' => 'div',

      'param_name' => 'second_title',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'column_title',

        ),
      )

    ),


     array (

      'heading' => esc_attr__('Style', 'specular'),

      'admin_label' => true,

      'param_name' => 'inner_style',

      'type' => 'dropdown',

      'value' => array(

            esc_attr__('Simple', 'specular') =>'simple',
            esc_attr__('With Inline border', 'specular') =>'inline_border' 

      ),

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'column_title',

        ),
      )

    ),

    array (

      'heading' => esc_attr__('Style', 'specular'),

      'admin_label' => true,

      'param_name' => 'inner_style_title',

      'type' => 'dropdown',

      'value' => array(

            esc_attr__('With Square and two lateral borders', 'specular') =>'square',

            esc_attr__('Simple Only text', 'specular') =>'only_text' 

      ),

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'section_title',

        ),
      )

    ), 


    array (

      'heading' => esc_attr__('Description', 'specular'),

      'admin_label' => true,

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'section_title',

        ),
      )

    ),

 
    array (

      'heading' => esc_attr__('Padding Description', 'specular'),

      'admin_label' => true,

      'param_name' => 'padding_desc',

      'type' => 'textfield',

      'value' => '28%',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'section_title',

        ),
      )

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),
));


vc_map( array (

  'base' => 'separator',

  'name' => esc_attr__('Separator', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/separator.png',

  'description' => esc_attr__('Create a custom separator', 'specular'),

  'category' => esc_attr__('Codeless Elements', 'specular'),

  'params' => array (

      array (

            'heading' => esc_attr__('Width', 'specular'),

            'description' => '',

            'type' => 'textfield',

            'value' => '40px',

            'param_name' => 'width',

          ),

      array (

            'heading' => esc_attr__('Height', 'specular'),

            'description' => '',

            'type' => 'textfield',

            'value' => '4px',

            'param_name' => 'height',

          ),

       array (

            'heading' => esc_attr__('Position', 'specular'),

            'param_name' => 'position',

            'type' => 'dropdown',

            'value' => 

            array (

              esc_attr__('Left', 'specular') =>'left',

              esc_attr__('Center', 'specular') =>'center',

              esc_attr__('Right', 'specular') =>'right',

            ),

          ),

      array (
            "type" => "colorpicker",

            "class" => "",

            "heading" => "Color",

            "param_name" => "color",

            "value" => "#222",

            "description" => ""
            ),

      array (

            'heading' => esc_attr__('Margin Top', 'specular'),

            'description' => '',

            'type' => 'textfield',

            'value' => '0px',

            'param_name' => 'margin_top',

          ),

      array (

            'heading' => esc_attr__('Margin Bottom', 'specular'),

            'description' => '',

            'type' => 'textfield',

            'value' => '0px',

            'param_name' => 'margin_bottom',

          ),
      )
));

vc_map( array (

  'base' => 'recent_portfolio',

  'name' => esc_attr__('Recent Portfolio', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/recent_portfolio.png',

  "description" => esc_html__('Show off some recent portfolio', 'specular'),

  'params' => 

  array (


    array (

      'heading' => esc_attr__('Portfolio Style', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Overlayed', 'specular') =>'overlayed',

        esc_attr__('Grayscale', 'specular') =>'grayscale',

        esc_attr__('Basic', 'specular') =>'basic',

        esc_attr__('Wrap with Chrome browser', 'specular') =>'chrome',

      ),

    ),




    array (

      'heading' => esc_attr__('Select the way you want to show the items', 'specular'),

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        esc_attr__('Grid', 'specular') =>'grid',

        esc_attr__('Masonry', 'specular') =>'masonry',


      ),

      'param_name' => 'mode',

      'type' => 'dropdown',

    ),

    array (

      'param_name' => 'space',

      'admin_label' => true,

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Yes', 'specular') =>'normal',

        esc_attr__('No', 'specular') =>'no_space',

      ),

      'heading' => esc_attr__('Do you want space beetwen items?', 'specular'),

    ),

    array (

      'heading' => esc_attr__('Block Size:', 'specular'),

      'admin_label' => true,

      'description' => esc_attr__('This mean that if you select 1/4 and you choose a 100% row, should be display 4 items. Be sure that items are in exact proporcion with the column percentage. For example you cant use a 1/4 with 66% column or 1/3 with 75% column ', 'specular'),

      'param_name' => 'columns',

      'type' => 'dropdown',

      'value' => 

      array (

        '1/5' => 5,

        '1/4' => 4,

        '1/3' => 3,

        '1/2' => 2

      ),

    ),

    array (

      'heading' => esc_attr__('Portfolio Rows', 'specular'),

      'admin_label' => true,

      'param_name' => 'rows',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('One Row', 'specular') =>'1',

        esc_attr__('Two Rows', 'specular') =>'2',

        esc_attr__('Three Rows', 'specular') =>'3',

        esc_attr__('Four Rows', 'specular') =>'4',

        esc_attr__('Five Rows', 'specular') =>'5',

      ),

    ),

    array (

      'heading' => esc_attr__('With carousel', 'specular'),

      'admin_label' => true,

      'param_name' => 'carousel',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Yes', 'specular') =>'yes',

        esc_attr__('No', 'specular') =>'no',

      ),
      'dependency' => 

      array (

        'element' => 'rows',

        'value' => 

        array (

          0 => '1',

        ),

      ),

    ),


    array (

      'param_name' => 'from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Set featured Portfolio:', 'specular'),

      'value' => 

      array (

        esc_attr__('Show Portfolio from all categories', 'specular') =>'all_cat',

        esc_attr__('Select a specific Category', 'specular') =>'cat',

      ),

    ),


    array (

      'param_name' => 'category',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Select the category:', 'specular'),

      'value' => $portfolio_terms,

      'dependency' => 

      array (
  
        'element' => 'from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));



vc_map( array (

  'base' => 'latest_blog',

  'name' => esc_attr__('Latest From Blog', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/latest_blog.png',

  'description' => esc_attr__('Blog Carousel with 2 styles', 'specular'),

  'params' => 

  array (
 

    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Set Headlines From Blog', 'specular'),

      'value' => 

      array (

        esc_attr__('Show headlines from all categories', 'specular') =>'all_cat',

        esc_attr__('Select a specific Category', 'specular') =>'cat',

        esc_attr__('Select a specific post', 'specular') =>'one_post'

      ),

    ),
    

   array (

      'param_name' => 'post_selected', 

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Select the post:', 'specular'),

      'value' => $post_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'one_post',

        ),

      ),

    ),
 
 

    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Select the category:', 'specular'),

      'value' => $blog_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

    array (

      'heading' => esc_attr__('With carousel', 'specular'),

      'admin_label' => true,

      'param_name' => 'carousel',

      'type' => 'dropdown', 

      'value' => 

      array (

        esc_attr__('Yes', 'specular') =>'yes',

        esc_attr__('No', 'specular') =>'no',

      )

    ),

    array (

      'param_name' => 'style',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Style', 'specular'),

      'value' => 

      array (

        esc_attr__('Simple without box', 'specular') =>'simple',

        esc_attr__('Boxed and with padding', 'specular') =>'boxed'

      ),

    ),

    array (

      'param_name' => 'posts_per_page',

      'admin_label' => true,

      'type' => 'textfield',

      'heading' => esc_attr__('Posts to show', 'specular'),

      'value' => '3'

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));

vc_map( array (

  'base' => 'home_blog',

  'name' => esc_attr__('Full Blog', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/full_blog.png',

  'description' => esc_attr__('All blog styles, show as much as you want', 'specular'),

  'params' => 

  array ( 

    array (

      'heading' => esc_attr__('Style:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'value' => 

      array (

        esc_attr__('Normal', 'specular') =>'index',

        esc_attr__('Second Style', 'specular') =>'second-style',

        esc_attr__('Masonry', 'specular') =>'grid',

        esc_attr__('Timeline', 'specular') =>'timeline',

        esc_attr__('With Shadow & Rounded Corners', 'specular') =>'shadowbox',

      ),

      'type' => 'dropdown',

    ),

    array (

      'heading' => esc_attr__('Post Numbers', 'specular'),

      'admin_label' => true,

      'description' => '-1 for all',

      'param_name' => 'posts_per_page',

      'value' => '4',

      'type' => 'textfield',

    ),

    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Set Headlines From Blog', 'specular'),

      'value' => 

      array (

        esc_attr__('Show headlines from all categories', 'specular') =>'all_cat',

        esc_attr__('Select a specific Category', 'specular') =>'cat',

      ),

    ),


    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Select the category:', 'specular'),

      'value' => $blog_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'recent_news',

  'name' => esc_attr__('Recent News', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/recent_news.png',

  'description' => esc_attr__('Posts as events, inline and thumbnail', 'specular'),

  'params' => 

  array (


    array (

      'heading' => esc_attr__('Number of posts', 'specular'),

      'admin_label' => true,

      'param_name' => 'posts_per_page',

      'type' => 'textfield',

      'value' => '2',

    ),

    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true, 

      'type' => 'dropdown',

      'heading' => esc_attr__('Set Headlines From Blog', 'specular'),

      'value' => 

      array (

        esc_attr__('Show headlines from all categories', 'specular') =>'all_cat',

        esc_attr__('Select a specific Category', 'specular') =>'cat',

      ),

    ),


    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => esc_attr__('Select the category:', 'specular'),

      'value' => $blog_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

    array (

      'param_name' => 'style',

      'admin_label' => true, 

      'type' => 'dropdown',

      'heading' => esc_attr__('Style', 'specular'),

      'value' => 

      array (

        esc_attr__('Inline Style Horizontal', 'specular') =>'inline',

        esc_attr__('Events Style', 'specular') =>'events',

        esc_attr__('Vertical with thumbnail', 'specular') =>'vertical'

      ),

    ),
 
  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));



vc_map( array (

  'base' => 'textbar',

  'name' => esc_attr__('Call-to-action', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/call_to_action.png',

  'description' => esc_attr__('CTA block with various options', 'specular'),

  'params' => 

  array (

 

    array (

      'heading' => esc_attr__('Title', 'specular'),

      'admin_label' => true,

      'description' => '',

      'value'   => '',

      'param_name' => 'title',

      'type' => 'textfield',

      'holder' => 'div'

    ),

    array (

      'heading' => esc_attr__('Style', 'specular'),

      'admin_label' => true,

      'description' => '', 

      'param_name' => 'style',

      'value' => 

      array (

        esc_attr__('All in-line', 'specular') =>'style_1',

        esc_attr__('Center with button after title', 'specular') =>'style_2',

      ),

      'type' => 'dropdown',

    ),

    array (

      'heading' => esc_attr__('Button Bool', 'specular'),

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        esc_attr__('Yes', 'specular') =>'yes',

        esc_attr__('No', 'specular') =>'no',

      ),

      'param_name' => 'button_bool',

      'type' => 'dropdown',

    ),

 

    array (

      'heading' => esc_attr__('Button Title', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'button_title',

      'type' => 'textfield',

      'value'   => '',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

   

    array (

      'heading' => esc_attr__('Button Link', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_link',

      'type' => 'textfield',

      'value'   => '#',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Select Icon', 'specular'),

      'admin_label' => true,

      'description' => '',

      'type' => 'iconselect',

      'value' => '',

      'param_name' => 'icon',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),


  ),

  'category' => esc_attr__('Codeless Elements', 'specular')

));


vc_map( array (

  'base' => 'services_small',

  'name' => esc_attr__('Service Small Icon', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/services_small.png',

  'description' => esc_attr__('Small icon in the left', 'specular'),

  'params' => 

  array (



    array (

      'heading' => esc_attr__('Title:', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),



    array (

      'heading' => esc_attr__('Do you want Icon?', 'specular'),

    

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        esc_attr__('Yes', 'specular') =>'yes',

        esc_attr__('No', 'specular') =>'no',

      ),

      'type' => 'dropdown',

    ),



    array (

      'heading' => esc_attr__('Select Icon', 'specular'),

      'description' => '',

      'param_name' => 'icon', 

      'value' => '', 

      'type' => 'iconselect',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

           'yes'

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Select Style', 'specular'),

      'description' => '',

      'param_name' => 'style',

      'value' => array(esc_attr__('Only Icon', 'specular') => 'style_1', esc_attr__('With Circle', 'specular') =>'style_2'),

      'type' => 'dropdown',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

           'yes'

        ),

      ),

    ),

    array (

      'heading' => esc_attr__('Icon wrapper bg color', 'specular'),

      'admin_label' => true,

      'param_name' => 'color_icon_wr',

      'type' => 'colorpicker', 

      'value' => '#222',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

           'style_2'

        ),

      ),

    ),

    array (

      'heading' => esc_attr__('Icon color', 'specular'),

      'admin_label' => true,

      'param_name' => 'icon_color',

      'type' => 'colorpicker',

      'value' => codeless_get_mod('primary_color')

    ),


    array (

   

      'heading' => esc_attr__('Content Type', 'specular'),

      'description' => esc_attr__('Select the content type to be used', 'specular'),

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Post', 'specular') =>'post',

        esc_attr__('Page', 'specular') =>'page',

        esc_attr__('Add Content here', 'specular') =>'content',

      ),

    ),



    array (

    

      'heading' => esc_attr__('Select the post', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        ),

      ),

    ),



    array (

     

      'heading' => esc_attr__('Select the page', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page',

        ),

      ),

    ),



    array (

   

      'heading' => esc_attr__('Content', 'specular'),

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'content',

        ),

      ),

    ),



    array (

    

      'heading' => esc_attr__('Link', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'content',

        ),

      ),

    ),

    array (

      'heading' => esc_attr__('Element Alignment', 'specular'),

    

      'description' => '',

      'param_name' => 'align',

      'value' => 

      array (

        esc_attr__('Left', 'specular') =>'left',

        esc_attr__('Right', 'specular') =>'right',

      ),

      'type' => 'dropdown',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'services_medium',

  'name' => esc_attr__('Service Circle Icon', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/services_circle.png',

  'description' => esc_attr__('With large icon in top center', 'specular'),

  'params' => 

  array (



    array (

      'heading' => esc_attr__('Title:', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

    
    array (

      'heading' => esc_attr__('Style?', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'style', 

      'value' => 

      array (

        esc_attr__('Circle without border', 'specular') =>'style_1',

        esc_attr__('Only icon', 'specular') =>'style_2',

        esc_attr__('With border', 'specular') =>'style_3',

        esc_attr__('Circle with shadow', 'specular') =>'style_4',

      ),

      'type' => 'dropdown'

    ),


    array (

      'heading' => esc_attr__('Do you want Icon or Image?', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        esc_attr__('Icon', 'specular') =>'icon',

        esc_attr__('Image', 'specular') =>'image'

      ),

      'type' => 'dropdown'

    ),

  


    array (

      'heading' => esc_attr__('Select Icon', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'iconselect',

      'value' => '',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

          0 => 'icon',

        )

      )

    ),


    array (

      'heading' => esc_attr__('Image:', 'specular'),

      'admin_label' => true,

      'param_name' => 'image',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Icon color', 'specular'),

      'admin_label' => true,

      'param_name' => 'icon_color',

      'type' => 'colorpicker',

      'value' => codeless_get_mod('primary_color')

    ),


    array (

      'heading' => esc_attr__('Circle Color', 'specular'),

      'admin_label' => true,

      'param_name' => 'circle_color',

      'type' => 'colorpicker',

      'value' => codeless_get_mod('highlighted_background_main')

    ),

    array (

      'heading' => esc_attr__('Border Color', 'specular'),

      'admin_label' => true,

      'param_name' => 'border_color',

      'type' => 'colorpicker',

      'value' => codeless_get_mod('primary_color')

    ),


  

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Content Type', 'specular'),

      'description' => esc_attr__('Select the content type to be used', 'specular'),

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Add Content here', 'specular') =>'content',

        esc_attr__('Post', 'specular') =>'post',

        esc_attr__('Page', 'specular') =>'page'

        

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Select the post', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        )

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Select the page', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page'

        )

      )

    ),

  

    array (

      'admin_label' => true,

      'heading' => esc_attr__('Content', 'specular'),

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          'content'

        ),

      ),

    ),

   

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Link', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

           'content'

        )

      )

    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular')

));


vc_map( array (

  'base' => 'services_large',

  'name' => esc_attr__('Service Square', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/services_square.png',

  'description' => esc_attr__('Square with borders', 'specular'),

  'params' => 

  array (



    array (

      'heading' => esc_attr__('Title:', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

 

    array (

      'heading' => esc_attr__('Select Icon', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'iconselect',

      'value' => '',

    ),



    array (

      'admin_label' => false,

      'heading' => esc_attr__('Content Type', 'specular'),

      'description' => esc_attr__('Select the content type to be used', 'specular'),

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Add Content here', 'specular') =>'content',

        esc_attr__('Post', 'specular') =>'post',

        esc_attr__('Page', 'specular') =>'page'

        

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Select the post', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        )

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Select the page', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page'

        )

      )

    ),

  

    array (

      'admin_label' => true,

      'heading' => esc_attr__('Content', 'specular'),

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          'content'

        ),

      ),

    ),

   

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Link', 'specular'),

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

           'content'

        )

      )

    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular')

));


vc_map( array (

  'base' => 'services_steps',

  'name' => esc_attr__('Service Text Effect', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/services_text.png',

  'description' => esc_attr__('When hover title, shows the description', 'specular'),

  'params' => 

  array (



    array (

      'heading' => esc_attr__('Title:', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

    array (

      'heading' => esc_attr__('Select Icon', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'iconselect',

      'value' => '',

    ),


    array (

      'admin_label' => true,

      'heading' => esc_attr__('Content', 'specular'),

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html'

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular')

));


vc_map( array (

  'base' => 'services_media',

  'name' => esc_attr__('Service Media', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/services_media.png',

  'description' => esc_attr__('Add a service with image or video', 'specular'),

  'params' => 

  array (


    array (

      'heading' => esc_attr__('Title:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),

    array (

      'heading' => esc_attr__('Type of Media ?', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'type',

      'value' => 

      array (

        esc_attr__('Image', 'specular') =>'img',

        esc_attr__('Video', 'specular') =>'video',

        esc_attr__('Self Hosted Video', 'specular') =>'self_hosted'

      ),

      'type' => 'dropdown',

    ),
 

    array (

      'heading' => esc_attr__('Upload Photo', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'photo',

      'value' => '',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'img',

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Video', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'video',

      'value' => '',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 =>'video'

        

        ),

      ),

    ),

    array (

      'heading' => esc_attr__('Video Mp4', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'self_hosted_mp4',

      'value' => '',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 =>'self_hosted',

        

        ),

      ),

    ),

    array (

      'heading' => esc_attr__('Video WebM', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'self_hosted_webm',

      'value' => '',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 =>'self_hosted',

        

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Style', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'style', 

      'value' => 

      array (

        esc_attr__('With Title and Description below media', 'specular') =>'style_1',

        esc_attr__('Title over image', 'specular') =>'style_2' 

      ),

      'type' => 'dropdown'

    ),

    array (

      'heading' => esc_attr__('Description', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'content',

      'value' => '',

      'type' => 'textarea_html',

    ),


    array (

      'admin_label' => false,

      'heading' => esc_attr__('Link', 'specular'),

      'description' => '',

      'param_name' => 'link',

      'type' => 'textfield',

      'value' => '#',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'chart_skill',

  'name' => esc_attr__('Chart Skill', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/skills_chart.png',

  'description' => esc_attr__('Pie Chart skill ', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Percentage %', 'specular'),

      'admin_label' => true,

      'param_name' => 'percent',

      'type' => 'textfield',

      'value' => '',

    ),

    array (

      'heading' => esc_attr__('Text', 'specular'),

      'admin_label' => true,

      'param_name' => 'text',

      'value' => '',

      'type' => 'textfield',

    ),


    array (

      'heading' => esc_attr__('Color', 'specular'),

      'admin_label' => true,

      'param_name' => 'color',

      'type' => 'colorpicker',

      'value' => 'base',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));

vc_map( array (

  'base' => 'skills',

  'name' => esc_attr__('Skills', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/skills.png',

  'description' => esc_attr__('Progress Bar Skills. Linked with Skill element', 'specular'),

  "content_element" => true,
 
  'is_container' => true,

  "show_settings_on_create" => false,

  'category' => esc_attr__('Codeless Elements', 'specular'),

  'js_view' => esc_attr__('VcColumnView', 'specular')

));



vc_map( array (

  'base' => 'skill',

  'name' => esc_attr__('Skill', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/skills.png',

  'description' => esc_attr__('Single skill to be linked with others', 'specular'),

  'as_child' => array('only' => 'skills'),

  'params' => 

  array (



    array (

      'heading' => esc_attr__('Title', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),



    array (

      'heading' => esc_attr__('Percentage %', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'percentage',

      'value' => '',

      'type' => 'textfield'

    )

    

  ),

  'category' => esc_attr__('Codeless Elements', 'specular')

));

vc_map( array (

  'base' => 'single_testimonial',

  'name' => esc_attr__('Single Testimonial', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/testimonial.png',

  'description' => esc_attr__('Testimonial with image in the left', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Select testimonial:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'testimon',

      'value' => $testimonials,

      'type' => 'dropdown',

    ),



  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));

vc_map( array (

  'base' => 'testimonial_carousel',

  'name' => esc_attr__('Testimonial (Carousel)', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/testimonial_carousel.png',

  'description' => esc_attr__('Without image and so simple', 'specular'),

  "show_settings_on_create" => false,

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Select Category:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'test_cat',

      'value' => $testimonials_cat,

      'type' => 'dropdown',

    ),

    array (
      "type" => "textfield",

      "class" => "",

      "heading" => "Duration of Item in View",

      "value" => 500 ,

      "param_name" => "duration",
      
      "description" => ""
    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'left_testimonial_carousel',

  'name' => esc_attr__('Left Aligned Testimonial (Carousel)', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/testimonial_carousel.png',

  'description' => esc_attr__('With Image and Left Aligned Carousel', 'specular'),

  "show_settings_on_create" => false,

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Select Category:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'test_cat',

      'value' => $testimonials_cat,

      'type' => 'dropdown',

    ),

    array (
      "type" => "textfield",

      "class" => "",

      "heading" => "Duration of Item in View",

      "value" => 500 ,

      "param_name" => "duration",
      
      "description" => ""
    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'testimonial_cycle',

  'name' => esc_attr__('Testimonial (Cycle)', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/testimonial_cycle.png',

  'description' => esc_attr__('Testimonial business, corporate style, no image', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Select Category:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'test_cat',

      'value' => $testimonials_cat,

      'type' => 'dropdown',

    ),

  ),

  "show_settings_on_create" => false, 

  'category' => esc_attr__('Codeless Elements', 'specular'),

));

vc_map( array (

  'base' => 'staff',

  'name' => esc_attr__('Single Staff', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/staff_single.png',

  'description' => esc_attr__('Show one member from staff', 'specular'),

  'params' => 

  array (

    0 => 

    array (

      'heading' => esc_attr__('Select Staff Member', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'staff',

      'type' => 'dropdown',

      'value' => $staff,

    ),

    array (

      'heading' => esc_attr__('Style', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => array(esc_attr__('With white box','specular') => 'style_1', esc_attr__('Simple centered', 'specular') =>'style_2'),

    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));

vc_map( array (

  'base' => 'staff_carousel',

  'name' => esc_attr__('Staff Carousel', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/staff_carousel.png',

  'description' => esc_attr__('Staff members carousel', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Do you want pagination?', 'specular'),

      'admin_label' => false,

      'description' => 'if you active pagination, you have to create a section on top of this section. See the preview About us 2',

      'param_name' => 'pagination',

      'value' => 

      array (

        esc_attr__('Yes', 'specular') =>'yes',

        esc_attr__('No', 'specular') =>'no'

      ),

      'type' => 'dropdown'

    ),

    array (
      "type" => "textfield",

      "class" => "",

      "heading" => "Slide per view",

      "value" => 4 ,

      "param_name" => "slide_per_view",
      
      "description" => ""
    ),

    array (

      'heading' => esc_attr__('Select Category:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'test_cat',

      'value' => $staff_cat,

      'type' => 'dropdown',

    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular')

));

vc_map( array (

  'base' => 'faq',

  'name' => esc_attr__('FAQ', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/faq.png',

  'description' => esc_attr__('Display FAQ posts', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Style', 'specular'),

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => 

      array (

        "With circle in left" => "style_1",

        "Title with Background" => "style_2",

        "Simple" => "style_3"

      ),

    ),

    array (

      'heading' => esc_attr__('Select Category:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'faq_cat',

      'value' => $faq_cat,

      'type' => 'dropdown',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'clients',

  'name' => esc_attr__('Clients', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/clients.png',

  'description' => esc_attr__('Show clients from Theme Options -> Clients', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Dark or Light:', 'specular'),

      'admin_label' => true,

      'description' => esc_attr__('Select the type of client image, light or dark version', 'specular'),

      'param_name' => 'dark_light',

      'value' => array("Dark" => 'dark', esc_attr__('Light', 'specular') =>'light'),

      'type' => 'dropdown',

    ),

    array (

      'heading' => esc_attr__('Carousel', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'carousel',

      'value' => 

      array (

        esc_attr__('Yes', 'specular') =>'yes',

        esc_attr__('No', 'specular') =>'no',

      ),

      'type' => 'dropdown',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));

vc_map( array (

  'base' => 'price_list',

  'name' => esc_attr__('Price List', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/price_list.png',

  'description' => esc_attr__('Price list is linked with List Item element', 'specular'),

  'as_parent' => array('only' => 'list_item'),

   'is_container' => true,

  'params' => 


  array (


    array (

      'heading' => esc_attr__('Title', 'specular'),

      'holder' => 'div',

      'param_name' => 'title',

      'type' => 'textfield',

      'value' => '',

    ),


    array (

      'heading' => esc_attr__('Price', 'specular'),

      'admin_label' => true,

      'param_name' => 'price',

      'type' => 'textfield',

      'value' => '55',

    ),


    array (

      'heading' => esc_attr__('Currency', 'specular'),

      'admin_label' => true,

      'param_name' => 'currency',

      'type' => 'textfield',

      'value' => '$',

    ),


    array (

      'heading' => esc_attr__('Period', 'specular'),

      'admin_label' => true,

      'param_name' => 'period',

      'type' => 'textfield',

      'value' => 'month',

    ),

    array (

      'heading' => esc_attr__('Box Color', 'specular'),

      'admin_label' => true,

      'param_name' => 'bg_color', 

      'type' => 'colorpicker',

      'value' => '',

    ),

    array (

     "type" => "dropdown",

      "class" => "",

      "heading" => "Type",

      "param_name" => "type",

      "value" => array(

            "Normal" => "normal",

            "Highlighted" => "highlighted"   

      ),
    ),

    array (

      'heading' => esc_attr__('Button title', 'specular'),

      'admin_label' => true,

      'param_name' => 'button_title',

      'type' => 'textfield',

      'value' => esc_attr__('Purchase', 'specular'),

    ),
    array (

      'heading' => esc_attr__('Button link', 'specular'),

      'admin_label' => true,

      'param_name' => 'button_link',

      'type' => 'textfield',

      'value' => '#',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),
  'js_view' => esc_attr__('VcColumnView', 'specular'),

));

vc_map( array (

  'base' => 'list',

  'name' => esc_attr__('List', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/list.png',

  'description' => esc_attr__('List with or without description', 'specular'),

  'as_parent' => array('only' => 'list_item'),

  'is_container' => false,

  'category' => esc_attr__('Codeless Elements', 'specular'),

  'js_view' => esc_attr__('VcColumnView', 'specular'),

  'params' => array (

      array (

            'heading' => esc_attr__('Select Icon', 'specular'),

            'admin_label' => true,

            'description' => '',

            'type' => 'iconselect',

            'value' => '',

            'param_name' => 'icon',

          ),

   )

));



vc_map( array (

  'base' => 'list_item',

  'name' => esc_attr__('List Item', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/list_item.png',

  'description' => 'used in List and Price List',

  'as_child' => array('list', 'price_list'),

  'content_element' => true,

  'params' => 

  array (
    
    array (

      'heading' => esc_attr__('Style', 'specular'),

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => array(

            esc_attr__('Simple', 'specular') =>'simple',
            esc_attr__('Title & Description', 'specular') =>'titledesc' 
      )
    ),

    array (

      'heading' => esc_attr__('Title:', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),   

    array (

      'heading' => esc_attr__('Description:', 'specular'),

      'holder' => 'div',

      'description' => '',

      'param_name' => 'desc',

      'value' => '',

      'type' => 'textarea',


      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'titledesc',

        ),
      )



    ), 

    array (

      'heading' => esc_attr__('Link', 'specular'),

      'descriptiom' => esc_attr__('Leave empty if you don\'t need a link for this item', 'specular'),

      'admin_label' => true,

      'param_name' => 'link',

      'type' => 'textfield',

      'value' => '',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular')

));


vc_map( array (

  'base' => 'google_map',

  'name' => esc_attr__('Google Map', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/maps.png',

  'description' => esc_attr__('Create a google map', 'specular'),

  'params' => 

  array (


    array (

      'heading' => esc_attr__('Source', 'specular'),

      'admin_label' => true,

      'description' => esc_attr__('Only the link', 'specular'),

      'param_name' => 'dynamic_src',

      'type' => 'textfield',

    ),

    array (

      'heading' => esc_attr__('Map Height (px)', 'specular'),

      'admin_label' => true,

      'description' => '',

      'value' => '150',

      'param_name' => 'height',

      'type' => 'textfield',

    ),

    array (

      'heading' => esc_attr__('Content after the map', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'desc',

      'type' => 'exploded_textarea',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'countdown',

  'name' => esc_attr__('Countdown', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/countdown.png',

  'description' => esc_attr__('Comingsoon countdown', 'specular'),

  'params' => 

  array (

    0 => 

    array (

      'heading' => esc_attr__('Year', 'specular'),

      'admin_label' => true,

      'param_name' => 'year',

      'type' => 'textfield',

    ),

    1 => 

    array (

      'heading' => esc_attr__('Month', 'specular'),

      'admin_label' => true,

      'param_name' => 'month',

      'type' => 'dropdown',

      'value' => 

      array (

        1 => 1,

        2 => 2,

        3 => 3,

        4 => 4,

        5 => 5,

        6 => 6,

        7 => 7,

        8 => 8,

        9 => 9,

        10 => 10,

        11 => 11,

        12 => 12,

      ),

    ),

    2 => 

    array (

      'heading' => esc_attr__('Day', 'specular'),

      'admin_label' => true,

      'param_name' => 'day',

      'type' => 'textfield',

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Type",

  "param_name" => "type",

  "value" => array(

    "In Container" => "in_container",

    "Full Width Background" => "full_width_background",

    "Full Width Content" => "full_width_content"    

  ),
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "attach_image",

  "class" => "",

  "heading" => "Background Image",

  "param_name" => "bg_image",

  "value" => "",

  "description" => "",
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Position",

  "param_name" => "bg_position",

  "value" => array(

     "Left Top" => "left top",

       "Left Center" => "left center",

       "Left Bottom" => "left bottom",

       "Center Top" => "center top",

       "Center Center" => "center center",

       "Center Bottom" => "center bottom",

       "Right Top" => "right top",

       "Right Center" => "right center",

       "Right Bottom" => "right bottom"

  ),

  "dependency" => Array('element' => "bg_image", 'not_empty' => true),
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Repeat",

  "param_name" => "bg_repeat",

  "value" => array(

    "No Repeat" => "no-repeat",

    "Repeat" => "repeat"

  ),

  "dependency" => Array('element' => "bg_image", 'not_empty' => true),
  'weight' => 900

));


vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Background Cover",

  "value" => array("Enable Background as Cover?" => "true" ),

  "param_name" => "cover_bg",

  "description" => "",

  "dependency" => Array('element' => "bg_image", 'not_empty' => true),
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Parallax Background",

  "value" => array("Enable Parallax Background?" => "true" ),

  "param_name" => "parallax_bg",

  "description" => "",

  "dependency" => Array('element' => "bg_image", 'not_empty' => true),
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Background Color",

  "param_name" => "bg_color",

  "value" => "",

  "description" => "",
  'weight' => 900

));





vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Overlay",

  "value" => array("Enable a color overlay? " => "true" ),

  "param_name" => "overlay",

  "description" => "",
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Overlay Color",

  "param_name" => "overlay_color",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "overlay", 'value' => array('true')),
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Youtube Video Background",

  "value" => array("Enable Youtube Video Background ?" => 'use' ),

  "param_name" => "youtube_video_bool",

  "description" => "",
  'weight' => 900



));

vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Youtube URL",

  "value" => "",

  "param_name" => "youtube_video_url",

  "description" => "",

  "dependency" => array('element' => "youtube_video_bool", 'value' => array('use')),
  'weight' => 900

));




vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Custom Video Background",

  "value" => array("Enable Custom Video Background?" => "use_video" ),

  "param_name" => "video_bg",

  "description" => "",
  'weight' => 900

));







vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "WebM File URL",

  "value" => "",

  "param_name" => "video_webm",

  "description" => "Webm video file url",

  "dependency" => Array('element' => "video_bg", 'value' => array('use_video')),
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "MP4 File URL",

  "value" => "",

  "param_name" => "video_mp4",

  "description" => "Mp4 video file url",

  "dependency" => Array('element' => "video_bg", 'value' => array('use_video')),
  'weight' => 900

));





vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Text Color",

  "param_name" => "text_color",

  "value" => array(

    "Dark" => "dark",

    "Light" => "light",

    "Custom" => "custom"

  ),
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Custom Text Color",

  "param_name" => "custom_text_color",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "text_color", 'value' => array('custom')),
  'weight' => 900

));





vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Padding Top",

  "value" => "",

  "param_name" => "top_padding",

  "description" => "Without px",
  'weight' => 900

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Padding Bottom",

  "value" => "",

  "param_name" => "bottom_padding",

  "description" => "Without px",
  'weight' => 900

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Transparency Section to be used with Slider",

  "value" => array("Enable Transparency" => true ),

  "param_name" => "transparency",

  "description" => "Check this if you want to use this section as a transparent section on the slider.",
  'weight' => 900

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Active Borders",

  "value" => array("Check to active section borders" => true ),

  "param_name" => "borders",

  "description" => "Check this if you want to active the borders top and bottom of this section. Type should be Fullwidth Content or Fullwidth Backgroud",
  'weight' => 900

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Active Arrow Bottom",

  "value" => array("Check to active bottom arrow" => true ),

  "param_name" => "arrow_bottom",

  "description" => "",
  'weight' => 900

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Active Arrow Up",

  "value" => array("Check to active top arrow" => true ),

  "param_name" => "arrow_top",

  "description" => "",
  'weight' => 900

));

vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Extra Class Name",

  "param_name" => "class",

  "value" => "",
  'weight' => 900

));



vc_add_param("vc_tabs", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Style",

  "param_name" => "style",

  "value" => array(

    "Classic" => "style_2",

    "Modern" => "style_1"

  )

));



vc_add_param("vc_tabs", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Position",

  "param_name" => "position",

  "value" => array(

    "Top" => "top",

    "Left" => "left"

  )

));

vc_add_param("vc_tabs", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Open Tab",

  "param_name" => "open_tab",

  "value" => '1'

));



vc_add_param("vc_accordion", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Style",

  "param_name" => "style",

  "value" => array(

    "With circle in left" => "style_1",

    "Title with Background" => "style_2",

    "Simple" => "style_3"

  )

));



vc_add_param("vc_accordion_tab", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Open?",

  "param_name" => "open",

  "value" => array("Check to make this accordion open" => true ),

));

vc_add_param("vc_column_text", array (

      'heading' => esc_attr__('Block Title:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

));

vc_add_param("vc_custom_heading", array (

  'heading' => esc_attr__('Letter Spacing:', 'specular'),

  'admin_label' => false,

  'description' => '',

  'param_name' => 'letter_space',

  'value' => '',

  'type' => 'textfield'

));


vc_remove_param("vc_tabs", "interval"); 

//vc_remove_param("vc_column_text", "css_animation");

vc_remove_param("vc_accordion", "collapsible");

vc_remove_param("vc_accordion", "interval");

vc_remove_param("vc_accordion", "active_tab");


vc_map( array (

  'base' => 'counter',

  'name' => esc_attr__('Animated Counter', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/counter.png',

  'description' => esc_attr__('Animated counter with Icon in top', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Number', 'specular'),

      'admin_label' => true,

      'param_name' => 'number',

      'type' => 'textfield',

    ),

    array (

      'heading' => esc_attr__('Title', 'specular'),

      'admin_label' => true,

      'param_name' => 'text',

      'type' => 'textfield',

      'value' => ''

    ),

    array (

      'heading' => esc_attr__('Icon', 'specular'),

      'param_name' => 'icon',

      'type' => 'iconselect',

      'value' => ''

    ),

    array(

      "type" => "dropdown",
    
      "class" => "",
    
      "heading" => "Style",
    
      "param_name" => "style",
    
      "value" => array(
    
        "Center" => "center",
    
        "Left" => "left"
    
      )
    
    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'media',

  'name' => esc_attr__('Media', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/media.png',

  'description' => esc_attr__('Add Image or Video with custom size', 'specular'),

  'params' => 

  array (


    array (

      'heading' => esc_attr__('Select type of media:', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'type',

      'value' => 

      array (

        esc_attr__('Image', 'specular') =>'image',

        esc_attr__('Video', 'specular') =>'video'

      ),

      'type' => 'dropdown',

    ),


    array (

      'heading' => esc_attr__('Image:', 'specular'),

      'admin_label' => true,

      'param_name' => 'image',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Video:', 'specular'),

      'admin_label' => false,

      'param_name' => 'video',

      'type' => 'textfield',

      'value' => '',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Alignment:', 'specular'),

      'admin_label' => false,

      'param_name' => 'alignment',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Left', 'specular') =>'left',

        'center' => 'center',

        esc_attr__('Right', 'specular') =>'right',

      ),

    ),


    array (

      'heading' => esc_attr__('Specify Width (px):', 'specular'),

      'admin_label' => false,

      'param_name' => 'width',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'alignment',

        'value' => 

        array (

          0 => 'center',

        ),

      ),

    ),


    array (

      'heading' => esc_attr__('Animation', 'specular'),

      'admin_label' => true,

      'param_name' => 'animation',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Show From Left', 'specular') =>esc_attr__('Left', 'specular'),

        esc_attr__('Show From Right', 'specular') =>esc_attr__('Right', 'specular'),

        esc_attr__('Show from Top', 'specular') =>esc_attr__('Up', 'specular'),

        esc_attr__('Show From Bottom', 'specular') =>esc_attr__('Down', 'specular'),

        esc_attr__('None', 'specular') =>'none',

      ),

    ),

    array (

      'admin_label' => false,

      'heading' => esc_attr__('Link', 'specular'),

      'description' => '',

      'param_name' => 'link',

      'type' => 'textfield',

      'value' => '#',
      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'image',

        ),

      ),
      ),

      array(

        "type" => "checkbox",
      
        "class" => "",
      
        "heading" => esc_attr__("Add Image Shadow", 'specular'),
      
        "value" => array("Enable to add a modern shadow to this image" => 1 ),
      
        "param_name" => "shadow",
      
        "description" => "",

      ),

      array(

        "type" => "checkbox",
      
        "class" => "",
      
        "heading" => esc_attr__("Add Left Rounded Corners", 'specular'),
      
        "value" => array("Enable to activate rounded corners on the left part of image" => 1 ),
      
        "param_name" => "rounded_left",
      
        "description" => "",

      ),

      array(

        "type" => "checkbox",
      
        "class" => "",
      
        "heading" => esc_attr__("Add Right Rounded Corners", 'specular'),
      
        "value" => array("Enable to activate rounded corners on the right part of image" => 1 ),
      
        "param_name" => "rounded_right",
      
        "description" => "",

      ),
      

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'button',

  'name' => esc_attr__('Button', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/button.png',

  'description' => esc_attr__('Get the styles from theme options.', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Title', 'specular'),

      'admin_label' => true,

      'param_name' => 'title',

      'type' => 'textfield',

      'value' => '',

    ),

    array (

      'heading' => esc_attr__('Link', 'specular'),

      'admin_label' => true,

      'param_name' => 'link',

      'value' => '#',

      'type' => 'textfield',

    ),

    array (

      'heading' => esc_attr__('Open in new tab', 'specular'),

      'admin_label' => true,

      'param_name' => 'new_tab',

      'value' => 

      array (


        esc_attr__('No', 'specular') =>'no',
        esc_attr__('Yes', 'specular') =>'yes'

       

      ),

      'type' => 'dropdown',

    ),

    array (

      'heading' => esc_attr__('With Icon', 'specular'),

      'admin_label' => true,

      'param_name' => 'with_icon_bool',

      'value' => 

      array (


        esc_attr__('No', 'specular') =>'no',
        esc_attr__('Yes', 'specular') =>'yes'

       

      ),

      'std' => 'yes',

      'type' => 'dropdown',

    ),

    array (

      'heading' => esc_attr__('Icon', 'specular'),

      'admin_label' => true,

      'param_name' => 'icon',

      'type' => 'iconselect',

      'value' => '',

      'dependency' => 

      array (

        'element' => 'with_icon_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

    array (

      'heading' => esc_attr__('Align', 'specular'),

      'admin_label' => false,

      'param_name' => 'align',

      'type' => 'dropdown',

      'value' => 

      array (

        esc_attr__('Left', 'specular') =>'left',

        esc_attr__('Right', 'specular') =>'right',

        esc_attr__('Center', 'specular') =>'center'

      ),

    ),

    array (

      'heading' => esc_attr__('Second Button ?', 'specular'),

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        esc_attr__('No', 'specular') =>'no',

        esc_attr__('Yes', 'specular') =>'yes',

      ),

      'param_name' => 'button_bool',

      'type' => 'dropdown',

    ),

 

    array (

      'heading' => esc_attr__('Button 2 Title', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_2_title',

      'type' => 'textfield',

      'value'   => '',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

   

    array (

      'heading' => esc_attr__('Button 2 Link', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_2_link',

      'type' => 'textfield',

      'value'   => '#',

      'dependency' => 

      array (

        'element' => 'button_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_remove_param("vc_column", "el_class");
vc_remove_param("vc_column", "video_bg");
vc_remove_param("vc_column", "video_bg_url");
vc_remove_param("vc_column", "video_bg_parallax");
vc_remove_param("vc_column", "parallax");
vc_remove_param("vc_column", "parallax_image");
vc_remove_param("vc_column", "parallax_speed_bg");
vc_remove_param("vc_column", "parallax_speed_video");
vc_remove_param("vc_column", "css_animation");



vc_add_param("vc_column", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Do you want animation for this column ?",
      "value" => array("Enable?" => "true" ),
      "param_name" => "enable_animation",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Select Animation",
      "param_name" => "animation",
      "value" => array_flip(codeless_animations()),
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Animation Delay",
      "param_name" => "delay",
      "admin_label" => false,
      "description" => "",
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content",
      "value" => array("Centered Content Horizontal" => "true" ),
      "param_name" => "centered_cont",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "checkbox",
      "class" => "",  
      "heading" => "Centered Content Vertical",
      "value" => array("Centered Content Vertical" => "true" ),
      "param_name" => "centered_cont_vertical",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Assign Padding to this column",
      "param_name" => "column_padding",
      "value" => '',
      "description" => "Use this in case you have created a full width content row. For ex: 10%"
));


vc_add_param("vc_column", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Background Color",
      "param_name" => "background_color",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Background Color Opacity",
      "param_name" => "background_color_opacity",
      "value" => '1'
      
));

vc_add_param("vc_column", array(
      "type" => "attach_image",
      "class" => "",
      "heading" => "Background Image",
      "param_name" => "background_image",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Font Color",
      "param_name" => "font_color",
      "value" => "",
      "description" => ""
));

vc_add_param("vc_column", array(
  "type" => "checkbox",
  "class" => "",  
  "heading" => "Add Shadow to the Box",
  "value" => array("Check to add shadow to this column" => true ),
  "param_name" => "shadow",
  "description" => ""
));

vc_add_param("vc_column", array(
  "type" => "checkbox",
  "class" => "",  
  "heading" => "Add Rounded Corners",
  "value" => array("Check to add rounded columns to this column" => true ),
  "param_name" => "rounded_border",
  "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Extra Class Name",
      "param_name" => "el_class",
      "value" => ""
));

vc_remove_param("vc_column_inner", "el_class");

vc_add_param("vc_column_inner", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Do you want animation for this column ?",
      "value" => array("Enable?" => "true" ),
      "param_name" => "enable_animation",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Select Animation",
      "param_name" => "animation",
      "value" => array_flip(codeless_animations()),
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Animation Delay",
      "param_name" => "delay",
      "admin_label" => false,
      "description" => "",
      "dependency" => Array('element' => "enable_animation", 'not_empty' => true)
));

vc_add_param("vc_column_inner", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content Horizontal",
      "value" => array("Centered Content Horizontal" => "true" ),
      "param_name" => "centered_cont",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content Vertical",
      "value" => array("Centered Content Vertical" => "true" ),
      "param_name" => "centered_cont_vertical",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Assign Padding to this column",
      "param_name" => "column_padding",
      "value" => '',
      "description" => "Use this in case you have created a full width content row. For ex: 10%"
));


vc_add_param("vc_column_inner", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Background Color",
      "param_name" => "background_color",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Background Color Opacity",
      "param_name" => "background_color_opacity",
      "value" => '1'
      
));

vc_add_param("vc_column_inner", array(
      "type" => "attach_image",
      "class" => "",
      "heading" => "Background Image",
      "param_name" => "background_image",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column_inner", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Font Color",
      "param_name" => "font_color",
      "value" => "",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Extra Class Name",
      "param_name" => "el_class",
      "value" => ""
));


vc_add_param("vc_column_text", array( 
  "type" => "colorpicker",
  "class" => "",
  "heading" => esc_attr__("Custom Text Color", 'specular') ,
  "param_name" => "custom_text_color",
  "value" => "",
  "description" => "",
));

vc_map( array (

  'base' => 'slideshow',

  'name' => esc_attr__('Slideshow', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/slideshow.png',

  'description' => esc_attr__('Flexslider Slideshow', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Select slides', 'specular'),

      'admin_label' => true,

      'description' => '',

      'param_name' => 'slides',

      'type' => 'attach_images'

    ),

    array (
      'heading' => esc_attr__('Image Size', 'specular'),

      'description' => '',

      'param_name' => 'image_size',

      'type' => 'dropdown',

      'value' => $image_sizes_
    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));


vc_map( array (

  'base' => 'video_lightbox_button',

  'name' => esc_attr__('Video Lightbox Button', 'specular'),

  'icon' => get_template_directory_uri().'/includes/core/icons/media.png',

  'description' => esc_attr__('Add a Play button, when clicked', 'specular'),

  'params' => 

  array (

    array (

      'heading' => esc_attr__('Video URL ( youtube / vimeo)', 'specular'),

      'admin_label' => false,

      'description' => '',

      'param_name' => 'link',

      'type' => 'textfield'

    ),

    array (

      'heading' => esc_attr__('Image', 'specular'),

      'description' => esc_attr__( 'Leave empty if need only a Play Button', 'specular' ),

      'admin_label' => false,

      'param_name' => 'image',

      'type' => 'attach_image'

    )

  ),

  'category' => esc_attr__('Codeless Elements', 'specular'),

));

class WPBakeryShortCode_Video_Lightbox_Button extends WPBakeryShortCode {



}


class WPBakeryShortCode_Plain_Text extends WPBakeryShortCode {



}

class WPBakeryShortCode_Separator extends WPBakeryShortCode {



}



class WPBakeryShortCode_Recent_Portfolio extends WPBakeryShortCode {



}



class WPBakeryShortCode_Recent_News extends WPBakeryShortCode {



}



class WPBakeryShortCode_Latest_Blog extends WPBakeryShortCode {



}



class WPBakeryShortCode_Home_Blog extends WPBakeryShortCode {



}



class WPBakeryShortCode_Faq extends WPBakeryShortCode {



}



class WPBakeryShortCode_Staff extends WPBakeryShortCode {



}



class WPBakeryShortCode_Slideshow extends WPBakeryShortCode {



}



class WPBakeryShortCode_Single_Testimonial extends WPBakeryShortCode {



}

class WPBakeryShortCode_Testimonial_Carousel extends WPBakeryShortCode {



}
class WPBakeryShortCode_Left_Testimonial_Carousel extends WPBakeryShortCode {



}

class WPBakeryShortCode_Testimonial_Cycle extends WPBakeryShortCode {



}



class WPBakeryShortCode_Clients extends WPBakeryShortCode {



}



class WPBakeryShortCode_Textbar extends WPBakeryShortCode {



}



class WPBakeryShortCode_Services_Small extends WPBakeryShortCode {



}



class WPBakeryShortCode_Services_Medium extends WPBakeryShortCode {



}


class WPBakeryShortCode_Services_Large extends WPBakeryShortCode {



}




class WPBakeryShortCode_Services_Media extends WPBakeryShortCode {



}



class WPBakeryShortCode_Media extends WPBakeryShortCode {



}




class WPBakeryShortCode_Chart_Skill extends WPBakeryShortCode {

           

}



class WPBakeryShortCode_Skills extends WPBakeryShortCodesContainer  {

           

}



class WPBakeryShortCode_Skill extends WPBakeryShortCode {

           

}



class WPBakeryShortCode_List extends WPBakeryShortCodesContainer {

           

}



class WPBakeryShortCode_List_Item extends WPBakeryShortCode {

           

}



class WPBakeryShortCode_Page_Intro extends WPBakeryShortCode {



}


class WPBakeryShortCode_Countdown extends WPBakeryShortCode {



}



class WPBakeryShortCode_Google_Map extends WPBakeryShortCode {



}


class WPBakeryShortCode_Counter extends WPBakeryShortCode {

}

class WPBakeryShortcode_Price_List extends WPBakeryShortCodesContainer{
      
}


class WPBakeryShortCode_Block_Title extends WPBakeryShortCode {

}

class WPBakeryShortCode_Staff_Carousel extends WPBakeryShortCode {

}

class WPBakeryShortCode_Button extends WPBakeryShortCode {

}

class WPBakeryShortCode_Services_Steps extends WPBakeryShortCode {

}

$vc_map_deprecated_settings = array (
  'deprecated' => false,
  'category' => esc_html__( 'Content', 'specular' )
);
vc_map_update( 'vc_accordion', $vc_map_deprecated_settings );
vc_map_update( 'vc_tabs', $vc_map_deprecated_settings );
vc_map_update( 'vc_tab', array('deprecated' => false) );
vc_map_update( 'vc_accordion_tab', $vc_map_deprecated_settings );



add_filter( 'vc_iconpicker-type-fontawesome', 'codeless_vc_fontawesome', 999  );
function codeless_vc_fontawesome($data){
  $new_data = array();
  foreach( $data as $icon_group_key => $icon_group_value ){
    $new_data[$icon_group_key] = array_map("codeless_vc_map_icon", $icon_group_value);
  }
  return $new_data;
}

function codeless_vc_map_icon( $item ){
  $new_key = '';
  foreach( $item as $key => $value ){
    $new_key = str_replace( 'fa-', 'icon-', str_replace( 'fa ', '', $key ) );
  }
  return array( $new_key => $val );
}


?>