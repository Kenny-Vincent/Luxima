<?php
if ( ! isset( $content_width ) ) $content_width = 940;

/* --------------------- Load Core Functions ------------------------- */
require_once( get_template_directory().'/includes/core/codeless_config.php' );
require_once( get_template_directory().'/includes/core/core-functions.php' );
/* --------------------- End Load Core ------------------------------ */

/* --------------------- Load MetaBoxes ----------------------------------- */
require_once get_template_directory().'/includes/codeless-slider/codeless_slider_options.php';
require_once get_template_directory().'/includes/core/codeless_metaboxes.php';
/* --------------------- End Load Metaboxes ------------------------------ */



require_once get_template_directory().'/functions-specular.php';
require_once get_template_directory().'/includes/core/codeless_routing.php';

/* -------------------- Load Codeless Import/Export ------------------ */
if( function_exists( 'codeless_redux_import_export_load_dir' ) )
    add_filter( "redux/cl_redata/field/class/codeless_import", "codeless_redux_import_export_load_dir" );

/* -------------------- End Load Codeless Import/Export -------------- */



if ( !isset( $redux_demo ) && file_exists( get_template_directory().'/includes/core/codeless_options.php' ) ) {
    require_once( get_template_directory().'/includes/core/codeless_options.php' );
}

if( function_exists( 'codeless_redux_import_export_load_dir' ) )
    codeless_redux_import_export_load();

/* --------------------- Register ------------------------------------ */
require_once get_template_directory().'/includes/register/register_sidebars.php';
/* --------------------- End Register -------------------------------- */



/* --------------------- Required Plugins Activation ----------------- */
require_once get_template_directory().'/includes/core/codeless_required_plugins.php' ;
require_once( get_template_directory() .'/envato-setup/envato_setup_init.php');
require_once( get_template_directory() .'/envato-setup/envato_setup.php');
/* --------------------- Required Plugins Activation ----------------- */


/* --------------------- Codeless Slider Load ------------------------ */
require_once( get_template_directory().'/includes/core/codeless_slideshow.php' );
require_once( get_template_directory().'/includes/codeless-slider/codeless_slider.php' );
/* --------------------- End Codeless Slider Load -------------------- */


/* -------------------- Load Custom Menu ----------------------------- */
require_once( get_template_directory().'/includes/core/codeless_megamenu.php' );
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Load Content Blocks ----------------------------- */
require_once( get_template_directory().'/includes/content-blocks.php' );
/* -------------------- Load Content Blocks ----------------------------- */

/* -------------------- Load Woocommerce Functions ----------------------------- */
if(class_exists( 'woocommerce' ))
    require_once( get_template_directory().'/functions-woocommerce.php' );

add_action( 'after_setup_theme', 'codeless_woocommerce_setup' );


function codeless_woocommerce_setup() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_filter( 'woocommerce_enqueue_styles', 'simple_dequeue_styles' );
function simple_dequeue_styles( ) {
     wp_dequeue_style( 'flexslider');
}
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Setup Theme ---------------------------------- */

add_action( 'after_setup_theme', 'codeless_setup' );

function codeless_setup(){
    add_action('init', 'codeless_language_setup');
    add_action('wp_enqueue_scripts', 'codeless_register_global_styles');
    add_action('wp_enqueue_scripts', 'codeless_register_global_scripts');

    add_filter( 'https_ssl_verify', '__return_false' );
    add_filter( 'https_local_ssl_verify', '__return_false' );

    codeless_theme_support();
    codeless_images_sizes();
    codeless_navigation_menus();
    if(is_single()){

        call_facebookmeta();
    }
    new codeless_custom_menu();
}

/* -------------------- End Setup Theme --------------------------------- */


/* -------------------- PO/MO files ------------------------------------- */

function codeless_language_setup() {
    $lang_dir = get_template_directory() . '/lang';
    load_theme_textdomain('specular', $lang_dir);
} 

/* -------------------- End PO/MO files --------------------------------- */



/* -------------------- Theme Support ----------------------------------- */

function codeless_theme_support(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );

    add_theme_support('nav_menus');
    add_theme_support( 'post-formats', array( 'quote', 'gallery','video', 'audio' ) ); 

    if( !class_exists( 'Redux' ) )
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 164,
            'flex-height' => true,
            'flex-width'  => true,
        ) );

    add_theme_support( 'custom-background' );

    add_theme_support( "title-tag" );
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
}

/* -------------------- End Theme Support ------------------------------- */



/* -------------------- Add Various Image Sizes ------------------------ */

function codeless_images_sizes(){
    
    add_image_size( 'port3', 600, 600, true );
    add_image_size( 'port3_grayscale', 627, 470, true );
    add_image_size( 'port2', 460, 275, true );
    add_image_size( 'port2_grayscale', 940, 470, true );
    add_image_size( 'port4', 600, 600, true );

    add_image_size( 'blog', 825, 340, true );
    add_image_size( 'alternate_blog', 440, 195, true );
    add_image_size( 'alternate_blog_side', 355, 235, true );
    add_image_size( 'blog_grid', 350, 350, true );

    add_image_size( 'staff', 400, 270, true );
    add_image_size( 'staff_full', 500, 340, true );

}

/* -------------------- End Add Various Image Sizes --------------------- */


/* -------------------- Register Navigations ---------------------------- */

function codeless_navigation_menus(){
    $navigations = array('main' => esc_attr__('Main Navigation', 'specular') );

    if(codeless_get_mod('header_style') == 'header_11')
        $navigations = array('left' => esc_attr__('In left side of logo', 'specular'), 'right' => esc_attr__('In right side of logo', 'specular') ); 

    foreach($navigations as $id => $name){ 
    	register_nav_menu($id, THEMETITLE.' '.$name); 
    }
}

/* -------------------- End Register Navigation ------------------------ */


/**
 * Gutenberg Editor CSS
 * 
 * @since 1.0.0
 */

add_action( 'enqueue_block_editor_assets', 'codeless_gutenberg_css', 999 );
function codeless_gutenberg_css(){
    wp_enqueue_style(
		'codeless-guten-css', // Handle.
		get_template_directory_uri() . '/css/gutenberg-editor.css', // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
    );

    $body_type = codeless_get_mod('body_typography');
    $headings_typo = codeless_get_mod('headings_font_type');

    $custom_font_link = add_query_arg( array(
		'family' => str_replace( '%2B', '+', urlencode( implode( '|', array( $body_type['font-family'].':400,500,600,700', $headings_typo['font-family'] ) ) . ':400,500,600,700'  ) )
	), 'https://fonts.googleapis.com/css' );

	wp_enqueue_style( 'codeless-guten-font-family', $custom_font_link  );
    
    $dynamic_styles = '.editor-post-title__block .editor-post-title__input{ font-size:36px; font-family:\''.$headings_typo['font-family'].'\'; font-weight:600; }';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-quote div p{ font-size:'.$body_type['font-size'].' !important; font-weight:400; }';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-quote__citation{ font-weight: 500; font-style: normal; font-size:16px; }';

    $dynamic_styles .= '.editor-styles-wrapper{ font-family: '.$body_type['font-family'].' !important; line-height:'.$body_type['line-height'].' !important; font-size:'.$body_type['font-size'] .'   }';
    
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-paragraph:not(.has-small-font-size):not(.has-large-font-size):not(.has-larger-font-size), .editor-styles-wrapper li{ font-size:'.$body_type['font-size'].' !important;  }';
    $dynamic_styles .= '.editor-styles-wrapper p.has-drop-cap:not(:focus):first-letter { color: '.codeless_get_mod('primary_color').'; } ';    
    $dynamic_styles .= '.editor-styles-wrapper p:not(.has-text-color):not(.wp-block-cover-text):not(.wp-block-pullquote), .editor-styles-wrapper .wp-block-quote__citation { color:'.$body_type['color'].' !important; }'; 
    $dynamic_styles .= '.editor-styles-wrapper h1, .editor-styles-wrapper h2, .editor-styles-wrapper h3, .editor-styles-wrapper h4, .editor-styles-wrapper h5, .editor-styles-wrapper h6{ font-family:\''.$headings_typo['font-family'].'\'; font-weight:600; color: #444; }';
    $dynamic_styles .= ' .editor-styles-wrapper .wp-block-quote p{ font-family:\''.$body_type['font-family'].'\';}';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block[data-type="core/cover"] .wp-block[data-type="core/paragraph"] p{ font-size: 24px !important; color:#fff !important; }';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-pullquote:not(.has-text-color) p:not(.has-text-color):not(.wp-block-cover-text):not(.wp-block-pullquote){ color:#40464d !important; }';
    $dynamic_styles .= '.editor-styles-wrapper h1{ font-size:'.codeless_get_mod('heading_1_font', 'font-size').' !important;  }';
    $dynamic_styles .= '.editor-styles-wrapper h2{ font-size:'.codeless_get_mod('heading_2_font', 'font-size').' !important;  }';
    $dynamic_styles .= '.editor-styles-wrapper h3{ font-size:'.codeless_get_mod('heading_3_font', 'font-size').' !important; }';
    $dynamic_styles .= '.editor-styles-wrapper h4{ font-size:'.codeless_get_mod('heading_4_font', 'font-size').' !important; }';
    $dynamic_styles .= '.editor-styles-wrapper h5{ font-size:'.codeless_get_mod('heading_5_font', 'font-size').' !important;}';
    $dynamic_styles .= '.editor-styles-wrapper h6{ font-size:'.codeless_get_mod('heading_6_font', 'font-size').' !important; }';

    

    wp_add_inline_style( 'codeless-guten-css', $dynamic_styles );
}

/* End Gutenberg */



/* -------------------- Register Styles used over all pages --------- */

function codeless_register_global_styles(){
    if( !class_exists('Redux') )
        wp_enqueue_style('codeless-dynamic-style', get_template_directory_uri(). '/css/dynamic_style.css');

    wp_enqueue_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.css');

    // Deregister Visual Composer Slider Style
    wp_deregister_style('flexslider', get_template_directory_uri(). '/css/flexslider.css');
    wp_enqueue_style('flexslider', get_template_directory_uri(). '/css/flexslider.css');
    
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');

    wp_enqueue_style('codeless-shortcodes', get_template_directory_uri(). '/css/shortcodes.css');
    wp_enqueue_style('codeless-animate', get_template_directory_uri(). '/css/animate.min.css');
    wp_enqueue_style('style', get_stylesheet_uri() );
    wp_enqueue_style('bootstrap-responsive', get_template_directory_uri().'/css/bootstrap-responsive.css');
    
    wp_enqueue_style('jquery-fancybox',get_template_directory_uri().'/css/jquery.fancybox.min.css');
    wp_enqueue_style('vector-icons',get_template_directory_uri().'/css/vector-icons.css');
    wp_enqueue_style('fontawesome',get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style('linecon',get_template_directory_uri().'/css/linecon.css');
    wp_enqueue_style('steadysets',get_template_directory_uri().'/css/steadysets.css');
    wp_enqueue_style('hoverex',get_template_directory_uri().'/css/hoverex-all.css');
    wp_enqueue_style( 'jquery.easy-pie-chart',get_template_directory_uri().'/css/jquery.easy-pie-chart.css' );
    wp_enqueue_style( 'idangerous.swiper',get_template_directory_uri().'/css/swiper.css');
    if( (function_exists('redux_post_meta') && redux_post_meta('cl_redata',(int) codeless_get_post_id(), 'post_style' ) == 'fullscreen' ) || codeless_get_mod('fullscreen_sections_active') )   
        wp_enqueue_style('fullscreen_post_css',get_template_directory_uri().'/css/fullscreen_post.css');

}

/* -------------------- Register Styles used over all pages --------- */

$codeless_custom_header_args = array(
    'wp-head-callback'       => '',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $codeless_custom_header_args );

/** New elementor widgets */
require get_template_directory() .'/includes/widgets/codeless_widgets.php';



/* -------------------- Register Scripts used over all pages --------- */

function codeless_register_global_scripts(){

    wp_enqueue_script( 'bootstrap.min', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script( 'jquery-easing-1-1', get_template_directory_uri().'/js/jquery.easing.1.1.js', array('jquery'), false, true);
    wp_enqueue_script( 'jquery-easing-1-3', get_template_directory_uri().'/js/jquery.easing.1.3.js', array('jquery'), false, true);
    
    wp_enqueue_script( 'modernizr', get_template_directory_uri().'/js/modernizr.custom.66803.js', array('jquery'), false, true);
    wp_enqueue_script( 'classie', get_template_directory_uri().'/js/classie.js', array('jquery'), false, true);

    if(codeless_get_mod('nicescroll'))
        wp_enqueue_script('smoothscroll', get_template_directory_uri().'/js/smoothscroll.js', array('jquery'), false, true); 

    wp_enqueue_script( 'codeless-main', get_template_directory_uri().'/js/codeless-main.js', array('jquery', 'animations'), false, true);


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
    wp_enqueue_script( 'waypoints.min', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), false, true); 
    wp_enqueue_script('jquery.appear', get_template_directory_uri().'/js/jquery.appear.js', array('jquery'), false, true);
    wp_enqueue_script('animations', get_template_directory_uri().'/js/animations.js', array('jquery', 'jquery.appear'), false, true );  
    wp_enqueue_script('background-check.min', get_template_directory_uri().'/js/background-check.min.js', array('jquery'), false, true);
    wp_enqueue_script('imagesloaded',get_template_directory_uri().'/js/jquery.imagesloaded.min.js', array('jquery'), false, true);

    if( (function_exists('redux_post_meta') && redux_post_meta('cl_redata',(int) codeless_get_post_id(), 'post_style' ) == 'fullscreen' ) || codeless_get_mod('fullscreen_sections_active') )   
        wp_enqueue_script('fullscreen_post', get_template_directory_uri().'/js/fullscreen_post.js', array('jquery'), false, true);

    wp_localize_script(
        'codeless-main',
        'codeless_global',
        array(
            'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
            'FRONT_LIB_JS' => esc_url( get_template_directory_uri() . '/js/' ),
            'FRONT_LIB_CSS' => esc_url( get_template_directory_uri() . '/css/' ),
            'button_style' => esc_js(codeless_get_mod('overall_button_style', 0))
            // Blog Slider Data
        )
    );
}

/* -------------------- Register Scripts used over all pages --------- */ 





function codeless_get_all_wordpress_menus(){
    $terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
    $menus = array(
        'default' => esc_attr__( 'Default (Main Theme Location)', 'specular' )
    );

    if( count( $terms ) == 0 )
        return $menus;

    foreach($terms as $term){
        $menus[$term->slug] = $term->name;
    } 

    return $menus;
}

function codeless_get_post_like_link( $id ){
    if( function_exists( 'codeless_framework_get_post_like_link' ) )
        return codeless_framework_get_post_like_link( $id );
}


function codeless_get_mod( $opt, $subopt = false ){
    global $cl_redata;

    if( !is_array( $cl_redata ) || !isset( $cl_redata[$opt] ) || ( $subopt !== false && !isset( $cl_redata[$opt][$subopt] ) ) )
        return '';

    if( $subopt !== false && is_array( $cl_redata[$opt] ) && isset( $cl_redata[$opt][$subopt] ) )
        return $cl_redata[$opt][$subopt];
    
    return $cl_redata[$opt];
}

function codeless_set_mod( $key, $value ){
    global $cl_redata;

    if( is_array( $cl_redata ) )
        $cl_redata[$key] = $value;
}


function codeless_current_view( $view = false ){
    global $codeless_current_view;
    
    if( $view !== false && !empty($view) )
        $codeless_current_view = $view;
    
    return $codeless_current_view;
}

/**
 * Returns true if the current Query is standart blog post.
 *
 * @since 1.0.0
 */
function codeless_is_blog_query() {
    
	// False by default
	$blog_bool = false;

	// Return true for blog archives
	if ( is_search() ) {
		$blog_bool = false; // Fixes wp bug
	} elseif (
		is_home() 
		|| is_category()
		|| is_tag()
		|| is_date()
		|| is_author()
		|| is_page_template( 'template-blog.php' )
		|| ( is_tax( 'post_format' ) && 'post' == get_post_type() )
	) {
		$blog_bool = true;
	}

	return $blog_bool;

}



function codeless_get_page_layout(){
    
    global $codeless_page_layout;

    // Default 
    $codeless_page_layout = codeless_get_mod( 'page_overall_layout' );

    // Check if query is a blog query
    if( codeless_current_view() == 'blog' )
        $codeless_page_layout = codeless_get_mod( 'bloglayout' );
        
    // Blog Post layout
    if( codeless_current_view() == 'single_blog' )
        $codeless_page_layout = codeless_get_mod( 'singlebloglayout' );       
    
    if( function_exists( 'is_product_category' ) && ( is_product_category() || is_product_tag() ) )
        $codeless_page_layout = codeless_get_mod( 'shop_archive_layout' );
    
    if( function_exists( 'is_product' ) && is_product() )
        $codeless_page_layout = codeless_get_mod( 'shop_single_layout' );
    
    // Add single page layout check here
    if( codeless_get_mod( 'overwrite_layout' ) && codeless_get_mod( 'layout' ) )
        $codeless_page_layout = codeless_get_mod( 'layout' );

    

    // if no sidebar is active return 'fullwidth'
    if( ! codeless_is_active_sidebar() )
        $codeless_page_layout = 'fullwidth';

    // Apply filter and return
    $codeless_page_layout = apply_filters( 'codeless_page_layout', $codeless_page_layout );

    return $codeless_page_layout;
}


function codeless_is_active_sidebar(){

    return is_active_sidebar( codeless_get_sidebar_name() );
}


function codeless_get_sidebar_name(){

    $sidebar = 'sidebar-2';

    if( codeless_is_blog_query() || ( is_single() && get_post_type( codeless_get_post_id() ) == 'post' ) )
        $sidebar = 'sidebar-1';
    
    if( codeless_current_view() == 'woocommerce' || codeless_is_shop_page() || (function_exists('is_product_category') && is_product_category() ) )
        $sidebar = 'sidebar-11';

    if( codeless_current_view() == 'portfolio' )
        $sidebar = 'sidebar-3';

    if( is_page() && is_registered_sidebar( 'sidebar-custom-page-' . codeless_get_post_id() ) )
        $sidebar = 'sidebar-custom-page-' . codeless_get_post_id();

    if( is_archive() ){
        $obj = get_queried_object();
        if( is_object($obj) && isset($obj->term_id) && is_registered_sidebar( 'sidebar-custom-category-' . $obj->term_id ) ){
            $sidebar = 'sidebar-custom-category-' . $obj->term_id;
        }
    }
    
    return $sidebar;
}

function codeless_is_shop_page(){
    if( class_exists( 'woocommerce' ) && is_shop() )
        return true;
    return false;
}


?>