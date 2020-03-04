<?php

// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = "cl_redata";


/*--------------------------------------SINGLE PORTFOLIO METABOXES------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "codeless_add_single_portfolio_metaboxes" ) ):
    function codeless_add_single_portfolio_metaboxes($metaboxes) {
       
        $custom_fieldss = codeless_get_mod('single_portfolio_custom_params');

        $portfolio_options = array();

        $page_style = array(
            'title'         => esc_html__('Page Style', 'specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'single_custom_link_switch',
                    'type' => 'switch',
                    'title' => esc_html__('Overwrite the link with your custom link', 'specular'),
                    'default' => 0// 1 = on | 0 = off
                ),
                array(
                    'id' => 'single_custom_link',
                    'title' => esc_html__( 'Add Custom Link', 'specular' ),
                    'type' => 'text',
                    'required' => array('single_custom_link_switch', '=', 1 )
                ), 
                array(
                    'id' => 'single_portfolio_style',
                    'title' => esc_html__( 'Select the style of the single portfolio', 'specular' ),
                    'desc' => esc_attr__('Please select the style for the portfolio', 'specular'),
                    'type' => 'select',
                    'multi' => false,
                    'default' => 'container',
                    'options' => array('gallery' => esc_attr__('Gallery Grid', 'specular'),'floating' => esc_attr__('Floating Sidebar', 'specular'), 'fullwidth' => esc_attr__('Fullwidth Slider / Image / Video', 'specular'), 'container' => esc_attr__('In Container Slider / Image / Video', 'specular'))
                ),
                array(
                    'id' => 'single_portfolio_content_position_floating',
                    'title' => esc_html__( 'Content Position', 'specular' ),
                    'desc' => esc_attr__('Select the position for the content', 'specular'),
                    'type' => 'select',
                    'options' => array('left' => esc_attr__('Left', 'specular'), 'right' => esc_attr__('Right', 'specular')),
                    'default' => 'right',
                    'required' => array('single_portfolio_style','=', 'floating')
                ),
                array(
                    'id' => 'single_portfolio_content_position_container',
                    'title' => esc_html__( 'Content Position', 'specular' ),
                    'desc' => esc_attr__('Select the position for the content', 'specular'),
                    'type' => 'select',
                    'options' => array('left' => esc_attr__('Left', 'specular'), 'right' => esc_attr__('Right', 'specular'), 'bottom' => esc_attr__('Bottom', 'specular'), 'top' => esc_attr__('Top', 'specular')),
                    'default' => 'right',
                    'required' => array('single_portfolio_style','=', 'container')
                ),
                array(
                    'id' => 'single_portfolio_media',
                    'title' => esc_html__( 'Media Type', 'specular' ),
                    'desc' => 'use feature image, video or slideshow. If you choose slideshow, add images in the gallery below',
                    'type' => 'select',
                    'options' => array('featured' => esc_attr__('Featured Image', 'specular'), 'video' => esc_attr__('Video', 'specular'), 'slideshow' => esc_attr__('Slideshow', 'specular')),
                    'default' => 'featured',
                    'required' => array('single_portfolio_style', '=', array('fullwidth', 'container') )
                ),
                array(
                    'id' => 'single_portfolio_video',
                    'title' => esc_html__( 'Video', 'specular' ),
                    'desc' => esc_attr__('Youtube or vimeo video link or iframe', 'specular'),
                    'type' => 'text',
                    'required' => array('single_portfolio_media', '=', 'video' )
                ), 

                array(
                    'id' => 'single_portfolio_gallery',
                    'type' => 'slides',
                    'title' => esc_html__('Add/Edit Slides', 'specular'),
                    'subtitle' => esc_html__('Add new or edit existing slider images', 'specular'),
                    
                ),

                array(
                    'id' => 'single_portfolio_related',
                    'type' => 'switch',
                    'title' => esc_html__('Switch On to add related portfolio items on bottom', 'specular'),
                    'default' => 0// 1 = on | 0 = off
                ),

                array(
                    'id' => 'single_portfolio_active_comments',
                    'type' => 'switch',
                    'title' => esc_html__('Switch On if you want comments functionality', 'specular'),
                    'default' => 0// 1 = on | 0 = off
                ),


                 
            ),
        );
        $description_fields = codeless_getPortfolioFields();

        $custom_fields = array(
            'title'         => esc_html__('Custom Fields', 'specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id'=>'single_portfolio_custom_fields',
                    'type' => 'multi_text',
                    'title' => esc_html__('Custom fields Values', 'specular'),
                    'subtitle' => esc_html__('Create unlimited custom fields in Theme Options. Leave empty if you dont want to display this custom field', 'specular').'<br /><br />Fields:<br />'.trim($description_fields)
                ),
                 
            ),
        );


        $portfolio_options[] = $page_style;
        $portfolio_options[] = $custom_fields;


        $metaboxes[] = array(
            'id'            => 'portfolio-options',
            'title'         => esc_html__( 'Single Portfolio Options', 'specular' ),
            'post_types'    => array( 'portfolio'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $portfolio_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_single_portfolio_metaboxes');
endif;

/*--------------------------------------END SINGLE PORTFOLIO METABOXES--------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/




/*--------------------------------------PORTFOLIO METABOXES-------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "codeless_add_portfolio_metaboxes" ) ):
    function codeless_add_portfolio_metaboxes($metaboxes) {
        
        $portfolio_options = array();

        $portfolio_options[] = array(
            //'title'         => esc_html__('General Settings', 'specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'portfolio_categories',
                    'title' => esc_html__( 'Portfolio Categories', 'specular' ),
                    'desc' => esc_attr__('Please select the categories of portfolio items to connect with this page', 'specular'),
                    'type' => 'select',
                    'multi' => true,
                    'data' => 'categories',
                    'args' => array('orderby'=>'name', 'hide_empty'=> 0, 'taxonomy' => 'portfolio_entries')
                ),

                array(
                    'id' => 'portfolio_filters',
                    'type' => 'select',
                    'title' => esc_html__('Portfolio Filters', 'specular'),
                    'options' => array('enabled' => esc_attr__('Enabled', 'specular'), 'disabled' => esc_attr__('Disabled', 'specular') ),
                    'default' => 'enabled'
                ),

                array(
                    'id' => 'portfolio_mode',
                    'title' => esc_html__( 'Portfolio Mode', 'specular' ),
                    'desc' => esc_attr__('Select one mode to display items', 'specular'),
                    'type' => 'select',
                    'options' => array('grid' => esc_attr__('Grid', 'specular'), 'masonry' => 'masonry'),
                    'default' => 'grid'
                ),
                array(
                    'id' => 'portfolio_columns',
                    'title' => esc_html__( 'Portfolio Columns', 'specular' ),
                    'desc' => esc_attr__('Number of columns for the layout', 'specular'),
                    'type' => 'image_select',
                    'options'  => array(
                            '1'      => array(
                                'alt'   => '1 Column', 
                                'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                            ),
                            '2'      => array(
                                'alt'   => '2 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/2-col-portfolio.png'
                            ),
                            '3'      => array(
                                'alt'   => '3 Columns', 
                                'img'  => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'
                            ),
                            '4'      => array(
                                'alt'   => '4 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'
                            ),
                            '5'      => array(
                                'alt'   => '5 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/5-col-portfolio.png'
                            )
                        ),
                    'default' => '3'
                ),
                array(
                    'id' => 'portfolio_style',
                    'title' => esc_html__( 'Portfolio Style', 'specular' ),
                    'desc' => esc_attr__('Select one style to display items', 'specular'),
                    'type' => 'select',
                    'options' => array('overlayed' => esc_attr__('Overlayed with base color and zoom effect', 'specular'), 'grayscale' => esc_attr__('Grayscale (Colored on hover)', 'specular'), 'basic' => esc_attr__('Basic with Title and Description', 'specular'), 'chrome' => esc_attr__('With Chrome Browser PNG', 'specular')),
                    'default' => 'overlayed'
                ),
                array(
                    'id' => 'portfolio_layout',
                    'title' => esc_html__( 'Portfolio Layout', 'specular' ),
                    'desc' => esc_attr__('The grid layout', 'specular'),
                    'type' => 'select',
                    'options' => array('in_container' => esc_attr__('Centered grid in container', 'specular'), 'fullwidth' => esc_attr__('Fullwidth', 'specular')),
                    'default' => 'in_container'
                ),
                array(
                    'id' => 'portfolio_space',
                    'title' => esc_html__( 'Portfolio Space', 'specular' ),
                    'desc' => esc_attr__('Space beetwen portfolio items', 'specular'),
                    'type' => 'select',
                    'options' => array( 'normal' => esc_attr__('Normal grid space', 'specular'), 'no_space' => esc_attr__('Without space', 'specular')),
                    'default' => 'normal'
                ),
                array(
                    'id' => 'portfolio_content',
                    'title' => esc_html__( 'Portfolio Content Position', 'specular' ),
                    'desc' => esc_attr__('Add this page content (Visual Composer Content) on top or bottom of grid ?', 'specular'),
                    'type' => 'select',
                    'options' => array('top' => esc_attr__('Top', 'specular'), 'bottom' => esc_attr__('Bottom', 'specular')),
                    'default' => 'top'
                ),
                array(
                    'id' => 'portfolio_pagination',
                    'type' => 'select',
                    'title' => esc_html__('Select the pagination method', 'specular'),
                    'options' => array('no_pagination' => esc_attr__('Without pagination', 'specular'), 'with_pagination' => esc_attr__('With Pagination', 'specular'), 'infinite_scroll' => esc_attr__('Infinite Scroll', 'specular')),
                    'default' => 'with_pagination'
                ),
                array(
                    'id' => 'portfolio_posts_per_page_bool',
                    'type' => 'switch',
                    'title' => esc_html__('Custom number of portfolio items per Page', 'specular'),
                    'subtitle' => esc_html__('Switch on to set a custom number of portfolio items per page', 'specular'),
                    'default' => 0// 1 = on | 0 = off
                ),

                array(
                    'id' => 'portfolio_posts_per_page',
                    'type' => 'text',
                    'title' => esc_html__('Portfolio Items per Page', 'specular'),
                    'default' => '6',
                    'required' => array('portfolio_posts_per_page_bool', 'equals', 1)
                ),

                
            ),
        );


        $metaboxes[] = array(
            'id'            => 'portfolio-options',
            'title'         => esc_html__( 'Portfolio Options', 'specular' ),
            'post_types'    => array( 'page'),
            'page_template' => array('portfolio.php'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $portfolio_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_portfolio_metaboxes');
endif;

/*--------------------------------------END PORTFOLIO METABOXES---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*------------------------------------------LAYOUT OPTIONS--------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "codeless_add_layout_metaboxes" ) ):
    function codeless_add_layout_metaboxes($metaboxes) {
        
        $layoutOptions = array();
        $layoutOptions[] = array(
            //'title' => esc_html__('Home Settings', 'specular'),
            'icon_class' => 'icon-large',
            'icon' => 'el-icon-home',
            'fields' => array(
                array(
                    'id' => 'overwrite_layout',
                    'type' => 'switch',
                    'title' => esc_html__('Overwrite the default post layout', 'specular'),
                    'subtitle' => esc_html__('Do you want to overwrite the default layout for this post?', 'specular'),
                    'default' => 0// 1 = on | 0 = off
                ),
                array(
                    'title'     => esc_html__( 'Layout', 'specular' ),
                    'desc'      => esc_html__( 'Select main content and sidebar arrangement.', 'specular' ),
                    'id'        => 'layout',
                    'default'   => 'fullwidth',
                    'type'      => 'image_select',
                    'customizer'=> array(),
                    'options'   => array( 
                        'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                        'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                        'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png',
                        'dual'          => ReduxFramework::$_url . 'assets/img/dual.png'
                    ),
                    'required' => array('overwrite_layout', 'equals', 1)
                ),

                array(
                    'id' => 'left_sidebar_dual',
                    'type' => 'select',
                    'title' => esc_html__('Left Sidebar', 'specular'),
                    'subtitle' => esc_html__('', 'specular'),
                    'data' => 'sidebar',
                    'required' => array('layout','=','dual')
                ),

                array(
                    'id' => 'right_sidebar_dual',
                    'type' => 'select',
                    'title' => esc_html__('Right Sidebar', 'specular'),
                    'subtitle' => esc_html__('', 'specular'),
                    'data' => 'sidebar',
                    'required' => array('layout','=','dual')
                ),


            )
        );
      
        $metaboxes[] = array(
            'id' => 'demo-layout2',
            //'title' => esc_html__('Cool Options', 'specular'),
            'post_types' => array('page', 'post', 'product'),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'side', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $layoutOptions
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_layout_metaboxes');
endif;

/*------------------------------------------END LAYOUT OPTIONS----------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------GENERAL SETTINGS----------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "codeless_add_general_metaboxes" ) ):
    function codeless_add_general_metaboxes($metaboxes) {
       
        $sections = array();


        /*----------------------------------------------PAGE HEADER-------------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $page_header_section = array(
            'title' => esc_html__('Page Header Options', 'specular'),
            'desc' => esc_html__('In this section you can create custom page header only for this page. If you want to change or to view the default page header options', 'specular').' <a href="'.admin_url().'admin.php?page=_options&tab=2">click here</a>',
            'icon' => 'el-icon-home',
            'fields' => array(  

                            array(
                                'id' => 'page_header_overwrite',
                                'type' => 'switch',
                                'title' => esc_html__('Overwrite the default page options', 'specular'),
                                'subtitle' => esc_html__('Do you want to overwrite the default page options in Theme Options ?', 'specular'),
                                'default' => 0// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'page_header_bool',
                                'type' => 'switch',
                                'title' => esc_html__('Active Page Header', 'specular'),
                                'subtitle' => esc_html__('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'specular'),
                                'default' => codeless_get_mod('page_header_bool'),// 1 = on | 0 = off
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_height',
                                'type' => 'dimensions',
                                'output' => array('.header_page'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => esc_html__('Page Header Height', 'specular'),
                                'subtitle' => esc_html__('units: px', 'specular'),
                                'desc' => esc_html__('', 'specular'),
                                'default' => codeless_get_mod('page_header_height'),
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_style',
                                'type' => 'select',
                                'title' => esc_html__('Page header style', 'specular'),
                                'subtitle' => esc_html__('Select the style for the default page header', 'specular'),
                                'options' => array('normal' => esc_attr__('Basic (Left with breadcrumbs)', 'specular'), 'centered' => esc_attr__('Centered', 'specular')), //Must provide key => value pairs for select options
                                'default' =>  codeless_get_mod('page_header_style'),
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'subtitle_bool',
                                'type' => 'switch',
                                'title' => esc_html__('SUbtitle for this page ?', 'specular'),
                                'default' => 0,
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'subtitle',
                                'type' => 'text',
                                'title' => esc_html__('SUbtitle for this page', 'specular'),
                                'subtitle' => esc_html__('Add a subtitle here', 'specular'),
                                'desc' => esc_html__('Show after the main title  ', 'specular'),
                                'default' => esc_attr__('A sample page description', 'specular'),
                                'required' => array(array('page_header_overwrite','=','1'), array('subtitle_bool','=', '1'))
                            ),

                            array(
                                'id' => 'page_header_f_color',
                                'type' => 'color',
                                'output' => array('.header_page'),
                                'title' => esc_html__('Page header font color', 'specular'),
                                'subtitle' => esc_html__('Select the color for the title or breadcrumbs in page header', 'specular'),
                                'default' => codeless_get_mod('page_header_f_color'),
                                'validate' => 'color',
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_background',
                                'type' => 'background',
                                'output' => array('.header_page'),
                                'title' => esc_html__('Page header background', 'specular'),
                                'subtitle' => esc_html__('Page Header background with image, color, etc.', 'specular'),
                                'default' => codeless_get_mod('page_header_background'),
                                'required' => array('page_header_overwrite','=','1')
                            )

            )
         );


         $shop_page_header_section = array(
            'title' => esc_html__('Page Header Options', 'specular'),
            'desc' => esc_html__('In this section you can create custom page header only for this page. If you want to change or to view the default page header options', 'specular').' <a href="'.admin_url().'admin.php?page=_options&tab=2">click here</a>',
            'icon' => 'el-icon-home',
            'fields' => array(  

                            array(
                                'id' => 'single_product_page_header_bool',
                                'type' => 'switch',
                                'title' => esc_html__('Active Page Header', 'specular'),
                                'subtitle' => esc_html__('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'specular'),
                                'default' => 0,// 1 = on | 0 = off
                             
                            ),

            )
         );


        /*----------------------------------------------END PAGE HEADER---------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        /*----------------------------------------------SLIDER OPTIONS----------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $layers = array();
        // Get WPDB Object
        global $wpdb;
     
        // Table name
        $table_name = $wpdb->prefix . "layerslider";
        $sql = $wpdb->prepare('show tables like %s', array($table_name));
        if($wpdb->get_var($sql) == $table_name) {
        // Get sliders
            $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );
           

        
            foreach($sliders as $key => $item) {
         
                $layers[$item->id-1] = $item->name;
            }
        }



        $revsliders = array();
        // Get WPDB Object
        global $wpdb;
     
        // Table name
        $table_name = $wpdb->prefix . "revslider_sliders";
     
        $sql = $wpdb->prepare('show tables like %s', array($table_name));
        if($wpdb->get_var($sql) == $table_name) {
           
            $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                            ORDER BY id ASC LIMIT 100" );   
            if(count($sliders) > 0):
                foreach($sliders as $key => $item) {
                    $revsliders[$item->alias] = $item->title;
                }

            endif;
        }


        $slider_section = array(

            'title' => esc_html__('Sliders Options', 'specular'),
            'icon' => 'el-icon-home',
            'fields' => array(
                            array(
                                'id' => 'slider_type',
                                'type' => 'select',
                                'title' => esc_html__('Select Slider Type', 'specular'),
                                'subtitle' => esc_html__('Select one of the listed sliders', 'specular'),
                                'options' => array('none'=>'None', 'codeless' => esc_attr__('Codeless Slider', 'specular'), 'flexslider' => esc_attr__('Flexslider', 'specular'), 'revolution' => esc_attr__('Revolution Slider', 'specular'), 'layerslider' => esc_attr__('Layerslider', 'specular'), 'codeless_news' => esc_attr__('News Slider', 'specular'), 'gallery_carousel' => esc_attr__('Gallery Carousel', 'specular')), //Must provide key => value pairs for select options
                                'default' =>  'none'
                            ),

                            array(
                                'id' => 'gallery',
                                'type' => 'slides',
                                'title' => esc_html__('Add/Edit Slides', 'specular'),
                                'subtitle' => esc_html__('Add new or edit existing slider images', 'specular'),
                                'required' => array('slider_type', '=', array('flexslider', 'gallery_carousel'))
                            ),

                            array(
                                'id' => 'gallery_effect',
                                'type' => 'select',
                                'title' => esc_html__('Gallery Carousel Effect', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'default' => 'simple',
                                'options' => array('simple' => esc_attr__('Simple', 'specular'), 'grayscale' => esc_attr__('Grayscale', 'specular'), 'opacity' => esc_attr__('With Opacity', 'specular')),
                                'required' => array('slider_type', '=', 'gallery_carousel')
                            ),

                            array( 
                                'id' => 'revslider',
                                'type' => 'select',
                                'title' => esc_html__('Select one of the created revolution sliders.', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'options' => $revsliders, //Must provide key => value pairs for select options
                                'default' =>  'none',
                                'required' => array('slider_type', '=', 'revolution')
                            ),

                            array(
                                'id' => 'layerslider',
                                'type' => 'select',
                                'title' => esc_html__('Select one of the created layer sliders.', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'options' => $layers, //Must provide key => value pairs for select options
                                'default' =>  'none',
                                'required' => array('slider_type', '=', 'layerslider')
                            ),

                            array(
                                'id' => 'codeless_slider',
                                'type' => 'select',
                                'title' => esc_html__('Select one of the created codelessliders.', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'data' => 'categories',
                                'args' => array('orderby'=>'date', 'hide_empty'=> 0, 'taxonomy' => 'slider'),
                                'required' => array('slider_type', '=', 'codeless')
                            ),

                            array(
                                'id' => 'codeless_slider_speed',
                                'type' => 'text',
                                'title' => esc_html__('Codeless Slider Speed', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'default' => '800',
                                'required' => array('slider_type', '=', 'codeless' )
                            ),

                            array(
                                'id' => 'codeless_slider_height',
                                'type' => 'text',
                                'title' => esc_html__('Slider height', 'specular'),
                                'subtitle' => esc_html__('Write 100% for fullscreen or for example 600 (without px) for custom', 'specular'),
                                'required' => array('slider_type', '=', array('codeless', 'gallery_carousel') )
                            ),

                            array(
                                'id' => 'codeless_news_featured_1',
                                'type' => 'select',
                                'title' => esc_html__('Select the first featured post', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'data' => 'post',
                                'args' => array('orderby'=>'date', 'posts_per_page' => -1),
                                'required' => array('slider_type', '=', 'codeless_news')
                            ),

                            array(
                                'id' => 'codeless_news_featured_2',
                                'type' => 'select',
                                'title' => esc_html__('Select the second featured post', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'data' => 'post',
                                'args' => array('orderby'=>'date', 'posts_per_page' => -1),
                                'required' => array('slider_type', '=', 'codeless_news')
                            ),

                            array(
                                'id' => 'slider_layout',
                                'type' => 'select',
                                'title' => esc_html__('Select Slider layout', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'options' => array('boxed'=>'Boxed', 'fullwidth' => esc_attr__('Fullwidth', 'specular')), //Must provide key => value pairs for select options
                                'default' =>  'fullwidth',
                                'required' => array('slider_type', '!=', 'none')
                            ),
                            array(
                                'id' => 'slider_fixed',
                                'type' => 'switch',
                                'title' => esc_html__('Active Fixed Slider', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'default' =>  0,
                                'required' => array('slider_type', '!=', 'none')
                            ),  

                            array(
                                'id'=>'slider_parallax',
                                'type' => 'switch', 
                                'title' => esc_html__('Active Parallax', 'specular'),
                                'subtitle'=> esc_html__('Look, it\'s on!', 'specular'),
                                "default"       => 0,
                            ), 

                            array(
                                'id'=>'slider_onmobile_remove',
                                'type' => 'switch', 
                                'title' => esc_html__('Remove Sliders from Mobile Phone View', 'specular'),
                                'subtitle'=> esc_html__('Check this option if you want to remove sliders from mobile view for this page.', 'specular'),
                                "default"       => 0,
                            ),     
            )

        );

        /*----------------------------------------------END SLIDER OPTIONS------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        /*----------------------------------------------PAGE OPTIONS & STYLE----------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $page_opt_style = array(

            'title' => esc_html__('Page Options & Style', 'specular'),
            'icon' => 'el-icon-home',
            'fields' => array(
                            array(
                                'id' => 'page_content_background',
                                'type' => 'color',
                                'output' => array('#content', '.fullscreen-single', '.fullscreen-single .content'),
                                'title' => esc_html__('Page Content Background', 'specular'),
                                'subtitle' => esc_html__('Background color of content in this page ' , 'specular'), 
                                'mode' => 'background-color',
                                'default' => codeless_get_mod('page_content_background'),
                                'validate' => 'color',
                            ),
                            array(
                                'id' => 'page_header_menu_color',
                                'type' => 'select',
                                'title' => esc_html__('Header Color Style for Header 1', 'specular'),
                                'subtitle' => esc_html__('Select Light for light colors in header and white logo', 'specular'),
                                'options' => array('light' => esc_attr__('Dark version header', 'specular'), 'dark' => esc_attr__('Light version header', 'specular'), 'auto' => esc_attr__('Auto check (Works only with background images)', 'specular') ), //Must provide key => value pairs for select options
                                'default' =>  'light'
                            ),

                            array(
                                'id' => 'one_page_active', 
                                'type' => 'switch',
                                'title' => esc_html__('Use menu as one page menu', 'specular'),
                                'subtitle' => esc_html__('Check this to activate one page menu', 'specular'),
                                'desc' => esc_html__('After activate this, to the sections of visual composer add a class attribute for ex: "services" and set the link of the menu item: #services', 'specular'),
                                'default' => '0'// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'fullscreen_sections_active', 
                                'type' => 'switch',
                                'title' => esc_html__('Fullscreen Sections Sliding', 'specular'),
                                'subtitle' => esc_html__('Check to use visual sections as fullscreen sections', 'specular'),
                                'desc' => esc_html__('', 'specular'),
                                'default' => '0'// 1 = on | 0 = off
                            ),

                            array(
                                'id'=>'use_featured_image_as_photo',
                                'type' => 'switch', 
                                'title' => esc_html__('Use Featured Image as Photo', 'specular'),
                                'subtitle'=> esc_html__('', 'specular'),
                                "default"       => 1,
                            ),


                            array(
                                'id'=>'custom_menu_for_page_bool',
                                'type' => 'switch', 
                                'title' => esc_html__('Custom Menu for this page?', 'specular'),
                                'subtitle'=> esc_html__('Switch on if you need a custom Menu for this page', 'specular'),
                                "default"      => '0',
                            ),

                            array(
                                'id' => 'custom_menu_for_page',
                                'type' => 'select',
                                'title' => esc_html__('Select Custom Menu', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'data' => 'categories',
                                'args' => array('orderby'=>'name', 'hide_empty'=> 0, 'taxonomy' => 'nav_menu'),
                                'required' => array('custom_menu_for_page_bool', '=', '1')
                            ),


            )

        );


        /*----------------------------------------------END PAGE OPTIONS & STYLE------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        $sections[] = $page_header_section;   // PAge Header Added
        $sections[] = $slider_section;   // Slider Added
        $sections[] = $page_opt_style; // Page Options and Style Added

        $single_portfolio = array();
        $single_portfolio[] = $page_header_section;
        $single_portfolio[] = $page_opt_style;

        $single_product = array();
        $single_product[] = $shop_page_header_section;

        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => esc_html__('General Settings', 'specular'),
            'post_types' => array('page','post'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $sections
        );
        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => esc_html__('General Settings', 'specular'),
            'post_types' => array('portfolio'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $single_portfolio 
        );

        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => esc_html__('General Settings', 'specular'),
            'post_types' => array('product'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $single_product 
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_general_metaboxes');
endif;

/*----------------------------------------------END GENERAL SETTINGS-----------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*---------------------------------------------------- STAFF -----------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "codeless_add_staff_metaboxes" ) ):
    function codeless_add_staff_metaboxes($metaboxes) {

        $staff_options = array();

        $staff_options[] = array(
            //'title'         => esc_html__('General Settings', 'specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'staff_position',
                    'title' => esc_html__( 'Staff Position', 'specular' ),
                    'desc' => esc_attr__('Write here the position for this staff member into your business', 'specular'),
                    'type' => 'text'
                ),
                array(
                    'id' => 'staff_link',
                    'title' => esc_html__( 'Staff Link', 'specular' ),
                    'desc' => esc_attr__('Set a link for this team member. You can connect with a page created with visual composer', 'specular'),
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'facebook_link',
                    'title' => esc_html__( 'Facebook Link', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'twitter_link',
                    'title' => esc_html__( 'Twitter Link', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'google_link',
                    'title' => esc_html__( 'Google Link', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'pinterest_link',
                    'title' => esc_html__( 'Pinterest Link', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'linkedin_link',
                    'title' => esc_html__( 'Linkedin Link', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'instagram_link',
                    'title' => esc_html__( 'Instagram Link', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'mail_link',
                    'title' => esc_html__( 'Mail Link', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),

                
            ),
        );


        $metaboxes[] = array(
            'id'            => 'staff-options',
            'title'         => esc_html__( 'Staff Options', 'specular' ),
            'post_types'    => array( 'staff'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $staff_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_staff_metaboxes');
endif;

/*-------------------------------------------------- END STAFF ---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*------------------------------------------------- TESTIMONIAL --------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "codeless_add_testimonial_metaboxes" ) ):
    function codeless_add_testimonial_metaboxes($metaboxes) {

        $testimonial_options = array();

        $testimonial_options[] = array(
            //'title'         => esc_html__('General Settings', 'specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'staff_position',
                    'title' => esc_html__( 'Staff Position', 'specular' ),
                    'desc' => esc_attr__('Write here the position for this testimonial post', 'specular'),
                    'type' => 'text'
                )
            ),
        );


        $metaboxes[] = array(
            'id'            => 'testimonial-options',
            'title'         => esc_html__( 'Testimonial Options', 'specular' ),
            'post_types'    => array( 'testimonial'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $testimonial_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_testimonial_metaboxes');
endif;

/*-------------------------------------------------- END Testimonial ---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------------*/


/*--------------------------------------BLOG POST METABOXES--------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------------------*/
if ( !function_exists( "codeless_add_blog_post_metaboxes" ) ):
    function codeless_add_blog_post_metaboxes($metaboxes) {
        $blog_options = array();
        
        $blog_options[] = array(
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'post_style',
                    'title' => esc_html__( 'Blog Post Style', 'specular' ),
                    'desc' => esc_attr__('Select from various blog post styles', 'specular'),
                    'type' => 'select', 
                    'options' => array(
                        'normal' => esc_attr__('Normal', 'specular'),
                        'modern' => esc_attr__('Modern', 'specular'),
                        'fullscreen' => esc_attr__('Fullscreen Post Style', 'specular')
                    ),
                    'default' => codeless_get_mod('post_style')
                ),
                array(
                    'id' => 'fullscreen_post_effect',
                    'title' => esc_html__( 'Fullscreen Post Effect', 'specular' ),
                    'desc' => esc_attr__('Use this option if you active the fullscreen blog', 'specular'),
                    'type' => 'select',
                    'options' => codeless_animations(), 
                    'default' => 'fadeInLeft',
                    'required' => array( 'post_style', '=', 'fullscreen' ) 
                ),
                array(
                    'id' => 'fullscreen_post_delay',
                    'type' => 'text',
                    'title' => esc_html__('Fullscreen Post Effect Delay', 'specular'),
                    'default' => '200',
                    'required' => array( 'post_style', '=', 'fullscreen' ) 
                ),
                array(
                    'id' => 'fullscreen_post_position',
                    'title' => esc_html__( 'Fullscreen Post Position', 'specular' ),
                    'desc' => esc_attr__('Position of the content in the fullscreen section', 'specular'),
                    'type' => 'select',
                    'default' => 'left',
                    'options' => array('left' => esc_attr__('Left', 'specular'), 'right' => esc_attr__('Right', 'specular')),
                    'required' => array( 'post_style', '=', 'fullscreen' ) 
                ),
                array(
                    'id' => 'future_date_events',
                    'title' => esc_html__( 'Future date for upcoming events', 'specular' ),
                    'desc' => '',
                    'type' => 'text',
                    'placeholder' => esc_attr__('Click to enter a date', 'specular'),
                    
                )      
            ) 
        );



        $metaboxes[] = array(
            'id'            => 'blog-options',
            'title'         => esc_html__( 'Blog Options', 'specular' ),
            'post_types'    => array( 'post'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'low', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $blog_options
        );

        $post_format = array(); 
        
        $post_format[] = array(
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'media_post_link',
                    'title' => esc_html__( 'Video / Audio Link or Iframe', 'specular' ),
                    'desc' => esc_attr__('Insert here link / Iframe for video or audio', 'specular'),
                    'type' => 'textarea', 
                    'default' => '' 
                )          
            ) 
        );

        $metaboxes[] = array(
            'id'            => 'blog-post-format',
            'title'         => esc_html__( 'Blog Post Format', 'specular' ),
            'post_types'    => array( 'post'),
            'post_format'   => array('video', 'audio'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $post_format
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_blog_post_metaboxes');
endif;

/*--------------------------------------END BLOG POST METABOXES---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if( function_exists( 'codeless_load_redux_metaboxes_extension' ) )
    codeless_load_redux_metaboxes_extension();
