<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */
if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "cl_redata";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'cl_redata', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Specular', 'specular'),
                'page_title' => esc_html__('Specular', 'specular'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'async_typography'  => false,      
                'google_api_key' => esc_attr__('AIzaSyDNS4R2BxpPspB31mZPnGvelSPSXvggI4I', 'specular'), // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'codeless', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => false, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // esc_html__( '', $this->args['domain'] );        
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
    
            );


            

            // Panel Intro text -> before the form
            if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
                if (!empty($args['global_variable'])) {
                    $v = $args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $args['opt_name']);
                }
                $args['intro_text'] = sprintf('<p>'.esc_html__('Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success.', 'specular').' </p>', $v);
            } else {
                $args['intro_text'] = '<p>'.esc_html__('Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success. ', 'specular').'</p>';
            }

            // Add content after the form.
            $args['footer_text'] = esc_html__('', 'specular');

            Redux::setArgs( $opt_name, $args );

            // ACTUAL DECLARATION OF SECTIONS

            Redux::setSection( $opt_name, array(
                'title' => esc_html__('General Options', 'specular'),
                'desc' => esc_html__('In this section you can customize basic options like logo, responsive etc...', 'specular'),
                'icon' => 'el-icon-cogs',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    
                    array(
                        'id' => 'responsive_bool',
                        'type' => 'switch',
                        'title' => esc_html__('Responsive Layout', 'specular'),
                        'subtitle' => esc_html__('Switch on to active responsive layout', 'specular'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'title' => esc_html__('Upload Logo', 'specular'),
                        'desc' => esc_html__('Upload here the logo that is placed in top of the page ', 'specular'),
                        'subtitle' => esc_html__('Upload any media using the WordPress native uploader', 'specular'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo.png'),
                    ),

                    array(
                        'id' => 'logo_light',
                        'type' => 'media',
                        'title' => esc_html__('Upload Logo Light', 'specular'),
                        'desc' => esc_html__('Upload here the logo that is placed in top of the page (Light Version) ', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo_light.png'),
                    ),

                    array(
                        'id' => 'logo_height',
                        'type' => 'dimensions', 
                        'output' => array('#logo img'),
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => esc_html__('Logo Height', 'specular'),
                        'subtitle' => esc_html__('units: px', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'default' => array('height' => 50)
                    ),


                    array(
                        'id' => 'nicescroll',
                        'type' => 'switch',
                        'title' => esc_html__('Smooth Scroll', 'specular'),
                        'subtitle' => esc_html__('Switch on to active smooth scrolling', 'specular'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'section-special-pages-start',
                        'type' => 'section',
                        'title' => esc_html__('Select Special Pages', 'specular'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


                    array(
                        'id' => 'frontpage',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => esc_html__('Select Frontpage', 'specular'),
                        'subtitle' => esc_html__('Frontpage is the page that you want to show in the home', 'specular'),
                        'desc' => esc_html__('Select one of the created pages to use it as frontpage', 'specular'),
                    ),


                    array(
                        'id' => 'blogpage',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => esc_html__('Select Blog Page', 'specular'),
                        'subtitle' => esc_html__('Blogpage is the page that you want to show the blog posts', 'specular'),
                        'desc' => esc_html__('Select one of the created pages to use as blog', 'specular'),
                    ),

                    array(
                        'id' => 'comingsoon_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => esc_html__('Select Coming Soon Page', 'specular'),
                        'subtitle' => esc_html__('Select one page that you want to use as comingsoon or maintenance page', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                    ),

                    array(
                        'id' => 'section-special-pages-end',
                        'type' => 'section',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),

                    array(
                        'id' => '404_error_message',
                        'type' => 'editor',
                        'title' => esc_html__('404 error message', 'specular'),
                        'subtitle' => esc_html__('Text to be placed in 404 page', 'specular'),
                        'default' => esc_html__('Sorry but the page you are looking for has not been found. Try checking the URL for errors, then hit the refresh button on your browser', 'specular' ),
                    ),

                    array(
                        'id' => 'section-code-start',
                        'type' => 'section',
                        'title' => esc_html__('Tracking Code / Custom CSS / Custom JS', 'specular'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


                    array(
                        'id' => 'tracking_code',
                        'type' => 'ace_editor',
                        'title' => esc_html__('Tracking Code', 'specular'),
                        'subtitle' => esc_html__('Paste your JS code here.', 'specular'),
                        'mode' => 'html',
                        'theme' => 'chrome',
                        'desc' => esc_html__('Paste your Google Analytics or other tracking code here. Tags needed!', 'specular'),
                        'default' => '<script type="text/javascript"></script>'
                    ),

                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'title' => esc_html__('Custom CSS Code', 'specular'),
                        'subtitle' => esc_html__('Paste your CSS code here.', 'specular'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => esc_html__('Add custom css code to theme.', 'specular'),
                        'default' => "/*#header{\nmargin: 0 auto;\n}*/"
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'title' => esc_html__('Custom JS Code', 'specular'),
                        'subtitle' => esc_html__('Paste your JS code here. Only JS code, tags will be added automatically!', 'specular'),
                        'mode' => 'text',
                        'theme' => 'chrome',
                        'desc' => '.',
                        'default' => "/*jQuery(document).ready(function(){\n\n});*/"
                    ),

                    array(
                        'id' => 'section-code-end',
                        'type' => 'section',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),

                ),
            ));

            

            Redux::setSection( $opt_name, array(
                'type' => 'divide',
            ));



            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-website',
                'title' => esc_html__('Header Options', 'specular'),
                'fields' => array(
                    
                    array(
                        'id' => 'section-header-opts-start',
                        'type' => 'section',
                        'title' => esc_html__('General', 'specular'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


            

                    array(
                        'id' => 'header_style',
                        'type' => 'select',
                        'title' => esc_html__('Header Style', 'specular'),
                        'subtitle' => esc_html__('Select the style for the header', 'specular'),
                        'options' => array('header_1' => esc_html__('Simple style', 'specular'), 'header_2' => esc_html__('With border top', 'specular') , 'header_3' => esc_html__('Modern Style', 'specular') , 'header_4' => esc_html__('Menu Item with BG', 'specular') , 'header_5' => esc_html__('Fullscreen Overlay', 'specular') , 'header_6' => esc_html__('Below the logo navigation with bg', 'specular') , 'header_7' => esc_html__('Left / Right Side Header', 'specular') , 'header_8' => esc_html__('Menu Item with border bottom', 'specular') , 'header_9' => esc_html__('Menu link underline', 'specular') , 'header_10' => esc_html__('Centered Logo and Navigation', 'specular') , 'header_11' => esc_html__('Logo in center and 2 navigations in sides', 'specular') , 'header_12' => esc_html__('Navigation with border separators, below logo', 'specular') ), //Must provide key => value pairs for select options
                        'default' => 'header_1'
                    ), 

                    array(
                        'id' => 'header_1_center',
                        'type' => 'switch',
                        'title' => esc_html__('Header Simple Style Centered Menu', 'specular'),
                        'subtitle' => esc_html__('Switch On to place Menu into the center of Header', 'specular'),
                        'default' => 0,
                        'required' => array('header_style', 'equals', array('header_1') ),
                    ),


                    array(
                        'id' => 'header_transparency',
                        'type' => 'switch',
                        'title' => esc_html__('Make Transparency Header', 'specular'),
                        'subtitle' => esc_html__('If you active this option the header should be shown on top of the slider', 'specular'),
                        'default' => 1,
                        'required' => array('header_style', 'equals', array('header_1', 'header_4', 'header_9', 'header_5', 'header_11') ),
                    ),

                    array(
                        'id' => 'header_overlay_color',
                        'type' => 'color_rgba',
                        'output' => array('.overlay_menu'),
                        'title' => esc_html__('Menu Overlay Fullscreen BG Color', 'specular'),
                        'mode' => 'background-color', 
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '0.95'
                        ),
                        'required' => array('header_style', 'equals', 'header_5'),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'header_navigation',
                        'type' => 'color_rgba',
                        'output' => array('.header_6 #navigation'),
                        'title' => esc_html__('Header 6 Navigation BG Color', 'specular'),
                        'mode' => 'background-color',  
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '1.00'
                        ),
                        'required' => array('header_style', 'equals', 'header_6'),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'header_6_nav_height',
                        'type' => 'dimensions',
                        'output' => array('.header_6 #navigation'), 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => esc_html__('Header 6 Navigation Height', 'specular'),
                        'required' => array('header_style', 'equals', 'header_6'),
                        'subtitle' => esc_html__('units: px', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'default' => array('height' => 45)
                    ),

                    array(
                        'id' => 'header_6_transparent',
                        'type' => 'switch',
                        'title' => esc_html__('Make transparent this header', 'specular'),
                        'subtitle' => esc_html__('Switch On to enable transparency', 'specular'),
                        'default' => 0,
                        'required' => array('header_style', 'equals', 'header_6'),
                    ),



                    array(
                        'id' => 'header_7_width',
                        'type' => 'dimensions',
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => esc_html__('Header 7 Side Menu Width', 'specular'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'subtitle' => esc_html__('units: px', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'default' => array('width' => 280)
                    ),

                    array(
                        'id' => 'header_7_padding',
                        'type' => 'spacing',
                        'mode' => 'padding', // absolute, padding, margin, defaults to padding
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => esc_html__('Header 7 Side Menu Inner Padding', 'specular'),
                        'subtitle' => esc_html__('Adjust side menu padding ', 'specular'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'desc' => esc_html__('Unit: px', 'specular'),
                        'default' => array('padding-left' => '20px', 'padding-right' => "20px", 'padding-top' => "20px", 'padding-bottom' => "20px")
                    ),
                    
                    array( 
                        'id' => 'header_7_margin',
                        'type' => 'spacing',
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        'bottom' => false,
                        'left' => false,
                        'right' => false,
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => esc_html__('Header 7 Side Menu Inner Margin beetwen logo/menu/widgets', 'specular'),
                        'subtitle' => esc_html__('Adjust margin beetween side menu elements logog/menu/widgets ', 'specular'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'desc' => esc_html__('Unit: px', 'specular'),
                        'default' => array('margin-top' => '40px')
                    ),

                    array(
                        'title'     => esc_html__( 'Header 7 Side Menu Position', 'specular' ),
                        'desc'      => esc_html__( 'Select the fixed position for the side navigation', 'specular' ),
                        'id'        => 'header_7_position',
                        'type'      => 'image_select',
                        'required' => array('header_style', 'equals', 'header_7'),
                        'customizer'=> array(),
                        'default' => 'left',
                        'options'   => array(
                            'left' => ReduxFramework::$_url . 'assets/img/2cl.png',
                            'right'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                        )
                    ),


                    array(
                        'id' => 'header_7_border', 
                        'type' => 'switch',
                        'title' => esc_html__('Add border to side header style', 'specular'),
                        'subtitle' => esc_html__('Border for side left/right header style', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'default' => 0// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'header_7_border_top', 
                        'type' => 'switch',
                        'title' => esc_html__('Add colored border in top of Header', 'specular'),
                        'subtitle' => esc_html__('Border with theme color in top of Left/Right header', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'default' => 0// 1 = on | 0 = off
                    ),


                    array(
                        'id' => 'header_10_border', 
                        'type' => 'switch',
                        'title' => esc_html__('Border Top & bottom for navigation', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'required' => array('header_style', 'equals', 'header_10'),
                        'default' => 1// 1 = on | 0 = off
                    ),
                    



                    array(
                        'id' => 'header_height',
                        'type' => 'dimensions',
                        'output' => array('header#header .row-fluid .span12', '.header_wrapper'),
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => esc_html__('Header Height', 'specular'),
                        'subtitle' => esc_html__('units: px', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'default' => array('height' => 80)
                    ),
                    
                    
                    array(
                        'id' => 'header_background',
                        'type' => 'color_rgba', 
                        'mode' => 'background-color',
                        'transparent' => true,
                        'validate' => 'colorrgba',
                        'output' => array('.header_1 header#header:not(.transparent), .header_2 header#header, .header_3.header_wrapper header > .container,  .header_4 header#header:not(.transparent),  .header_5 header#header:not(.transparent), .header_6 header#header, .header_6 .full_nav_menu, .header_7.header_wrapper, .header_8.header_wrapper, .header_9 header#header:not(.transparent), .header_10.header_wrapper, .header_10 .full_nav_menu, .header_11.header_wrapper:not(.transparent)'),
                        'title' => esc_html__('Background', 'specular'),
                        'subtitle' => esc_html__('Header background with image, color, etc.', 'specular'),
                        'default' => array(
                            'color' => '#fff',
                            'alpha' => '1.00'
                        ),
                    ),

                    array(
                        'id' => 'show_search', 
                        'type' => 'checkbox',
                        'title' => esc_html__('Show Search', 'specular'),
                        'subtitle' => esc_html__('Show search in the right of header', 'specular'),
                        'desc' => esc_html__('Check this if you want the search field in the right part of the header', 'specular'),
                        'default' => '1'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'header_container_full', 
                        'type' => 'checkbox',
                        'title' => esc_html__('Remove container from header', 'specular'),
                        'subtitle' => esc_html__('Cant use with left menu', 'specular'),
                        'desc' => esc_html__('By checking this the header container should be removed and transformed in fullwidth header', 'specular'),
                        'default' => '0'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'show_button', 
                        'type' => 'checkbox',
                        'title' => esc_html__('Add button to header', 'specular'),
                        'subtitle' => esc_html__('Add a button in header after the menu', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'default' => '0'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'header_button',
                        'type' => 'text',
                        'title' => esc_html__('Header Button', 'specular'),
                        'required' => array('show_button', 'equals', '1'),
                        'default' => esc_attr__('Donate Now', 'specular')
                    ),

                    array(
                        'id' => 'header_button_link',
                        'type' => 'text', 
                        'title' => esc_html__('Header Button Link', 'specular'),
                        'required' => array('show_button', 'equals', '1'),
                        'default' => '#'
                    ),

                    array(
                        'id' => 'header_button_color',
                        'type' => 'select',
                        'title' => esc_html__('Button Color', 'specular'),
                        'options' => array( 'dark' => esc_attr__('Dark', 'specular'), 'light' => esc_attr__('Light', 'specular') ),
                        'required' => array('show_button', 'equals', '1'),
                        'default' => 'dark'
                    ),

                    array( 
                        'id'       => 'header_border_bottom',
                        'type'     => 'border',
                        'title'    => esc_html__('Header Border Bottom', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        'output'   => array('.header_wrapper'),
                        'right'    => false,
                        'top'   => false,  
                        'left'     => false,
                        'color'    => true,
                        'style'    => true,
                        'desc'     => esc_html__('Add Border bottom for header', 'specular'),
                        'default'  => array(
                            'color'  => '', 
                            'border-style'  => 'solid',
                            'border-bottom'    => '0px'
                        )
                    ),

                    array(
                        'id' => 'header_shadow', 
                        'type' => 'select',
                        'title' => esc_html__('Header Shadow', 'specular'),
                        'subtitle' => esc_html__('Select one shadow style or leave it without shadow', 'specular'),
                        'desc' => esc_html__('Isnt compatible with all headers', 'specular'),
                        'options' => array('no_shadow' => esc_attr__('Without Shadow', 'specular'), 'full' => esc_attr__('Fullwidth light shadow', 'specular'), 'shadow1' => esc_attr__('Shadow1', 'specular'), 'shadow2' => esc_attr__('Shadow2', 'specular'), 'shadow3' => esc_attr__('Shadow3', 'specular')), //Must provide key => value pairs for select options
                        'required' => array('header_style', 'equals', array('header_2', 'header_8', 'header_12')),
                        'default' => 'no_shadow'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'responsive_menu_dropdown',
                        'type' => 'switch',
                        'title' => esc_html__('Show Responsive Menu Dropdown', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'header_responsive_tools',
                        'type' => 'switch',
                        'title' => esc_html__('Show header tools in responsive (Mobile)', 'specular'),
                        'subtitle' => esc_html__('Extra Nav, Shop Cart etc...', 'specular'),
                        "default" => 0,

                    ),
                )
            ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => esc_html__('Menu Options', 'specular'),
                        'fields' => array(
                            array(
                                'id' => 'menu_font_style',
                                'type' => 'typography',
                                'title' => esc_html__('Menu Item Typography', 'specular'),
                                //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                                'font-weight'=>true,
                                'subsets'=>false, // Only appears if google is true and subsets not set to false
                                //'font-size'=>false,
                                'line-height'=>true,
                                //'word-spacing'=>true, // Defaults to false
                                'letter-spacing'=>true, // Defaults to false
                                //'color'=>false,
                                //'preview'=>false, // Disable the previewer 
                                'text-align' => true,
                                'text-transform' => true,
                                'output' => array('nav .menu > li > a, nav .menu > li.hasSubMenu:after', 'header#header .header_tools .vert_mid > a:not(#trigger-overlay), header#header .header_tools .cart .cart_icon'), // An array of CSS selectors to apply this font style to dynamically
                                'units' => 'px', // Defaults to px
                                'subtitle' => esc_html__('Select the appropiate font style for the menu', 'specular'),
                                'default' => array(
                                    'color' => "#222",
                                    'font-weight' => '600',
                                    'font-family' => esc_attr__('Open Sans', 'specular'),
                                    'google' => true,
                                    'font-size' => '13px',
                                    'line-height' => '20px',
                                    'text-align' => 'center',
                                    'text-transform' => 'uppercase',
                                    'letter-spacing' => '1px'
                                ),
                            ),

                            array(
                                'id' => 'menu_padding',
                                'type' => 'spacing',
                                'output' => array('nav .menu > li'), // An array of CSS selectors to apply this font style to
                                'mode' => 'padding', // absolute, padding, margin, defaults to padding
                                'top' => false, // Disable the top
                                //'right' => false, // Disable the right
                                'bottom' => false, // Disable the bottom
                                //'left' => false, // Disable the left
                                //'all' => true, // Have one field that applies to all
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                //'display_units' => 'false', // Set to false to hide the units if the units are specified
                                'title' => esc_html__('Menu Items padding', 'specular'),
                                'subtitle' => esc_html__('Adjust padding beetwen menu items ', 'specular'),
                                'desc' => esc_html__('Unit: px', 'specular'),
                                'default' => array('padding-left' => '5px', 'padding-right' => "5px")
                            ),


                            array(
                                'id' => 'menu_margin',
                                'type' => 'spacing',
                                'output' => array('nav .menu > li'), // An array of CSS selectors to apply this font style to
                                'mode' => 'margin', // absolute, padding, margin, defaults to padding
                                'top' => false, // Disable the top
                                //'right' => false, // Disable the right
                                'bottom' => false, // Disable the bottom
                                //'left' => false, // Disable the left
                                //'all' => true, // Have one field that applies to all
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                //'display_units' => 'false', // Set to false to hide the units if the units are specified
                                'title' => esc_html__('Menu Items Margin', 'specular'),
                                'subtitle' => esc_html__('Adjust margin beetwen menu items ', 'specular'),
                                'desc' => esc_html__('Unit: px', 'specular'),
                                'default' => array('margin-left' => '0px', 'margin-right' => "0px")
                            ), 

                            array(
                                'id' => 'menu_custom_current_menu_item_color_bool',
                                'type' => 'switch',
                                'title' => esc_html__('Custom Current Menu Item / Hover Color', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                "default" => 0,
                            ),

                            array(
                                'id' => 'current_menu_item_color',
                                'type' => 'color',
                                'mode' => 'color',
                                'output' => array('.custom-current-menu-item-color header#header nav li.current-menu-item > a, .custom-current-menu-item-color header#header nav li > a:hover'),
                                'title' => esc_html__('Current Menu Item / Hover Color', 'specular'),
                                'subtitle' => esc_html__('This option will overwrite the default value of Primary Color on Styling Options', 'specular'),
                                'default' => '',
                                'required' => array('menu_custom_current_menu_item_color_bool', 'equals', 1),
                            ),
                        ),
                        'subsection' => true
                    ));

                    
                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => esc_html__('Dropdown Options & Mobile Menu', 'specular'),
                        'fields' => array(
                            array(
                                'id' => 'dropdown_width',
                                'type' => 'dimensions',
                                'output' => array('nav .menu > li > ul.sub-menu', 'nav .menu > li > ul.sub-menu ul'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'height' => false,
                                'title' => esc_html__('Dropdown Width', 'specular'),
                                'subtitle' => esc_html__('units: px', 'specular'),
                                'desc' => esc_html__('', 'specular'),
                                'default' => array('width' => 220)
                            ),

                            array(
                                'id' => 'background_dropdown',
                                'type' => 'color',
                                'mode' => 'background-color',
                                'output' => array('nav .menu li > ul', '.codeless_custom_menu_mega_menu', '.menu-small', '.header_tools .cart .content'),
                                'title' => esc_html__('Dropdown Background Color', 'specular'),
                                'subtitle' => esc_html__('Background Color for the dropdown in the menu', 'specular'),
                                'default' => '#222222'  
                            ),

                            array(
                                'id' => 'dropdown_border_color',
                                'type' => 'color',
                                'output' => array('nav .menu li > ul.sub-menu li'),
                                'title' => esc_html__('Dropdown Border color', 'specular'),
                                'subtitle' => esc_html__('Dropdown border color for navigation', 'specular'),
                                'default' => '#222222'
                            ),

                            array( 
                                'id' => 'dropdown_font',
                                'type' => 'typography',
                                'title' => esc_html__('Dropdown typography', 'specular'),
                                'font-family' => false,
                                'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-size'=>true,
                                'line-height'=>false,
                                'font-weight' => false,
                                'font-style' => false,
                                'letter-spacing'=>true, // Defaults to false
                                'color'=>true,
                                'preview' => false,
                                'text-align' => false,
                                'text-transform' => true,
                                'units' => 'px', // Defaults to px
                                'subtitle' => esc_html__('Select the appropiate font style for the megamenu column title', 'specular'),
                                'output' => 'nav .menu li > ul.sub-menu li, .menu-small ul li a',
                                'default' => array(
                                    'color' => "#888",
                                    'font-size' => '11px',
                                    'letter-spacing' => '0.3px',
                                    'text-transform' => 'uppercase'
                                ),
                            ),

                            array( 
                                'id' => 'megamenu_title',
                                'type' => 'typography',
                                'title' => esc_html__('Megamenu title', 'specular'),
                                'font-family' => false,
                                'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-size'=>true,
                                'line-height'=>false,
                                'font-weight' => true,
                                'font-style' => false,
                                'letter-spacing'=>true, // Defaults to false
                                'color'=>true,
                                'preview' => false,
                                'text-align' => false,
                                'text-transform' => true,
                                'units' => 'px', // Defaults to px
                                'subtitle' => esc_html__('Select the appropiate font style for the megamenu column title', 'specular'),
                                'output' => 'nav .codeless_custom_menu_mega_menu ul>li h6, .menu-small ul.menu .codeless_custom_menu_mega_menu h6, .menu-small ul.menu > li > a ',
                                'default' => array(
                                    'color' => "#fff",
                                    'font-size' => '14px',
                                    'font-weight' => '600',
                                    'letter-spacing' => '1px',
                                    'text-transform' => 'uppercase'
                                ),
                            ),

                            array(
                                'id' => 'cart_dropdown_button',
                                'type' => 'select',
                                'title' => esc_html__('Cart Dropdown in header button style', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'options' => array('dark' => esc_attr__('Dark', 'specular'), 'light' => esc_attr__('Light', 'specular')), //Must provide key => value pairs for select options
                                'default' => 'light'
                            ),
                        ),
                        'subsection' => true
                    ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => esc_html__('Top Widgetized Area', 'specular'),
                        'fields' => array(
                            array(
                                'id' => 'top_navigation',
                                'type' => 'switch',
                                'title' => esc_html__('Show Top Navigation', 'specular'),
                                'subtitle' => esc_html__('Switch On to enable top navigation', 'specular'),
                                'default' => 0// 1 = on | 0 = off
                            ),

                            array(
                                'id'       => 'topnav_layout',
                                'type'     => 'image_select',
                                'title'    => esc_html__('Layout', 'specular'), 
                                'subtitle' => esc_html__('Select layout of columns on this area', 'specular'),
                                'options'  => array(
                                    '6-6'      => array(
                                        'alt'   => '6cols - 6cols', 
                                        'img'   => get_template_directory_uri() .'/img/6-6.png'
                                    ),
                                    '9-3'      => array(
                                        'alt'   => '9cols - 3cols', 
                                        'img'   => get_template_directory_uri() .'/img/9-3.png'
                                    ),
                                    '3-9'      => array(
                                        'alt'   => '3cols - 9cols', 
                                        'img'  => get_template_directory_uri() .'/img/3-9.png'
                                    ),
                                    
                                ),
                                'default' => '6-6'
                            ),

                            array(
                                'id' => 'topnav_bg',
                                'type' => 'color',
                                'mode' => 'background-color',
                                'output' => array('.top_nav'),
                                'title' => esc_html__('Background Color', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'default' => '#f5f5f5',
                                'validate' => 'color',
                            ),


                            array( 
                                'id'       => 'topnav_border_top',
                                'type'     => 'border',
                                'title'    => esc_html__('Top Navigation Border Top', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'output'   => array('.top_nav'),
                                'right'    => false,
                                'bottom'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => esc_html__('Add Border top for the top navigation', 'specular'),
                                'default'  => array(
                                    'color'  => '', 
                                    'border-style'  => 'solid',
                                    'border-top'    => '0px',
                                )
                            ),

                            array( 
                                'id'       => 'topnav_border_bottom',
                                'type'     => 'border',
                                'title'    => esc_html__('Top Navigation Border Bottom', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'output'   => array('.top_nav'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => esc_html__('Add Border bottom for the top navigation', 'specular'),
                                'default'  => array(
                                    'color'  => '', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '0px',
                                )
                            ),

                            array(
                                'id' => 'topnav_font_style',
                                'type' => 'typography',
                                'title' => esc_html__('Typography', 'specular'),
                                //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => true, // Select a backup non-google font in addition to a google font
                                //'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                                //'subsets'=>false, // Only appears if google is true and subsets not set to false
                                //'font-size'=>false,
                                'line-height'=>false,
                                //'word-spacing'=>true, // Defaults to false
                                //'letter-spacing'=>true, // Defaults to false 
                                //'color'=>false,
                                //'preview'=>false, // Disable the previewer
                                'text-align' => false,
                                'output' => array('.top_nav'),
                                'units' => 'px', // Defaults to px
                                'subtitle' => esc_html__('Select the appropiate font style for top nav', 'specular'),
                                'default' => array(
                                    'color' => "#999",
                                    'font-family' => esc_attr__('Open Sans', 'specular'),
                                    'google' => true,
                                    'font-size' => '11px'
                                ),
                            ),

                            array(
                                'id' => 'topnav_height',
                                'type' => 'dimensions', 
                                'output' => array('.top_nav, .top_nav .widget'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => esc_html__('Top Nav Height', 'specular'),
                                'subtitle' => esc_html__('units: px', 'specular'),
                                'desc' => esc_html__('', 'specular'),
                                'default' => array('height' => 40)
                            ),

                            array(
                                'id' => 'top_navigation_mobile',
                                'type' => 'switch',
                                'title' => esc_html__('Show Top Navigation on Mobile (Small screens)', 'specular'),
                                'subtitle' => esc_html__('Switch On to enable top navigation on small screens', 'specular'),
                                'default' => 0// 1 = on | 0 = off
                            ),



                        ),
                        'subsection' => true
                    ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => esc_html__('Default Page Header', 'specular'),
                        'fields' => array(
                            array(
                                'id' => 'page_header_bool',
                                'type' => 'switch',
                                'title' => esc_html__('Active Page Header', 'specular'),
                                'subtitle' => esc_html__('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'specular'),
                                'default' => 1// 1 = on | 0 = off
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
                                'default' => array('height' => 80)
                            ),

                            array(
                                'id' => 'page_header_style',
                                'type' => 'select',
                                'title' => esc_html__('Page header style', 'specular'),
                                'subtitle' => esc_html__('Select the style for the default page header', 'specular'),
                                'options' => array('normal' => esc_attr__('Basic (Left with breadcrumbs)', 'specular'), 'centered' => esc_attr__('Centered', 'specular')), //Must provide key => value pairs for select options
                                'default' => 'normal'
                            ),

                            array(
                                'id' => 'page_header_f_color',
                                'type' => 'color',
                                'output' => array('.header_page'),
                                'title' => esc_html__('Page header font color', 'specular'),
                                'subtitle' => esc_html__('Select the color for the title or breadcrumbs in page header', 'specular'),
                                'default' => '#444',
                                'validate' => 'color',
                            ),

                            array(
                                'id' => 'page_header_background',
                                'type' => 'background',
                                'output' => array('.header_page'),
                                'title' => esc_html__('Page header background', 'specular'),
                                'subtitle' => esc_html__('Page Header background with image, color, etc.', 'specular'),
                                'default' => array('background-color' => '#f5f5f5')
                            ),

                            array( 
                                'id'       => 'page_header_border',
                                'type'     => 'border',
                                'title'    => esc_html__('Page header Border Bottom', 'specular'),
                                'subtitle' => esc_html__('', 'specular'),
                                'output'   => array('.header_page, #slider-fullwidth'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => esc_html__('Add Border bottom for page header', 'specular'),
                                'default'  => array(
                                    'color'  => '', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '0px'
                                )
                            ),
                        ),
                        'subsection' => true
                    ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => esc_html__('Archives Header', 'specular'),
                        'desc' => esc_html__( 'Header Options for any type of Archive page is being displayed. Category, Tag, other Taxonomy Term, custom post type archive, Author and Date-based pages are all types of Archives.', 'specular' ),
                        'fields' => array(

                            array(
                                'id' => 'archives_header_color',
                                'type' => 'select',
                                'title' => esc_html__('Archives Header Text Color', 'specular'),
                                'subtitle' => esc_html__('Select the style for archives header text color', 'specular'),
                                'options' => array('light' => esc_attr__('Dark version header', 'specular'), 'dark' => esc_attr__('Light version header', 'specular')), //Must provide key => value pairs for select options
                                'default' => 'light'
                            )
                        ),
                        'subsection' => true
                    ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => esc_html__('Sticky Nav', 'specular'),
                        'fields' => array(
                            array(
                                'id' => 'sticky',
                                'type' => 'switch',
                                'title' => esc_html__('Sticky Header', 'specular'),
                                'subtitle' => esc_html__('Switch on to active sticky header (fixed position on header)', 'specular'),
                                "default" => 0,
                            ),
                            array(
                                'id' => 'sticky_header_height',
                                'type' => 'dimensions',
                                'output' => array('.sticky_header header#header .row-fluid .span12', '.sticky_header .header_wrapper'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => esc_html__('Sticky Header Height', 'specular'),
                                'subtitle' => esc_html__('units: px', 'specular'),
                                'desc' => esc_html__('', 'specular'),
                                'default' => array('height' => 60)
                            ),
                            
                            array(
                                'id' => 'sticky_header_background',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                'transparent' => true,
                                'validate' => 'colorrgba',
                                'output' => array('.sticky_header header#header'),
                                'title' => esc_html__('Sticky Background', 'specular'),
                                'subtitle' => esc_html__('Header background with image, color, etc.', 'specular'),
                                'default' => array(
                                    'color' => '#fff',
                                    'alpha' => '0.80'
                                ),
                            ),

                            array(
                                'id' => 'sticky_logo',
                                'type' => 'switch',
                                'title' => esc_html__('Sticky Logo', 'specular'),
                                'subtitle' => esc_html__('Remove the Logo from the main Header and shows only on stiky', 'specular'),
                                "default" => 0,
                                'required' => array('sticky', 'equals', 1),
                            ),

                            array(
                                'id' => 'sticky_mobile',
                                'type' => 'switch',
                                'title' => esc_html__('Sticky on Responsive', 'specular'),
                                'subtitle' => esc_html__('Switch on to active sticky header on responsive', 'specular'),
                                "default" => 0,
                                'required' => array('sticky', 'equals', 1),
                            ),
                        ),
                        'subsection' => true
                    ));
            

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Styling Options', 'specular'),
                'fields' => array(
                    array(
                        'id' => 'primary_color', 
                        'type' => 'color',
                        'output' => array('.header_11 nav li > a:hover, .header_11 nav li.current-menu-item > a, .header_11 nav li.current-menu-parent > a ','.header_10 nav li > a:hover, .header_10 nav li.current-menu-item > a, .header_10 nav li.current-menu-parent > a ','.header_9 nav li > a:hover, .header_9 nav li.current-menu-item > a, .header_9 nav li.current-menu-parent > a ','.header_8 nav li > a:hover, .header_8 nav li.current-menu-item > a, .header_8 nav li.current-menu-parent > a ','.header_7 nav li > a:hover, .header_7 nav li.current-menu-item > a, .header_7 nav li.current-menu-parent > a ','.header_6 nav li > a:hover, .header_6 nav li.current-menu-item > a, .header_6 nav li.current-menu-parent > a ','.header_5 nav li > a:hover, .header_5 nav li.current-menu-item > a, .header_5 nav li.current-menu-parent > a ','.header_3 nav li > a:hover, .header_3 nav li.current-menu-item > a, .header_3 nav li.current-menu-parent > a ','.header_2 nav li > a:hover, .header_2 nav li.current-menu-item > a, .header_2 nav li.current-menu-parent > a ', '.codeless_slider .swiper-slide .buttons.colors-light a.colored:hover *',  '.services_steps .icon_wrapper i', '.testimonial_carousel .item .param span', '.services_large .icon_wrapper i', '.animated_counter i', '.services_medium.style_1 i', '.services_small dt i', '.single_staff .social_widget li a:hover i', '.single_staff .position', '.list li.titledesc dl dt i', '.list li.simple i', '.page_parents li a:hover', '#portfolio-filter ul li.active a','.content_portfolio.fullwidth #portfolio-filter ul li.active a', 'a:hover', '.header_1 nav li.current-menu-item > a','.blog-article h1 a:hover, .blog-article.timeline-style .content .quote i', '.header_1 nav li.current-menu-item:after', '.header_1 nav li > a:hover', '.header_1 nav li:hover:after', 'header#header .header_tools > a:hover', 'footer#footer a:hover', 'aside ul li:hover:after', '.highlights'),
                        'title' => esc_html__('Primary Color', 'specular'),
                        'subtitle' => esc_html__('Color for links on hover, highlighted text and other', 'specular'),
                        'default' => '#10b8c7',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'link_color', 
                        'type' => 'color',
                        'title' => esc_html__('Content Links Color', 'specular'),
                        'subtitle' => esc_html__('Color for links', 'specular'),
                        'default' => '#10b8c7',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'body_font_color',
                        'type' => 'color',
                        'output' => array('body'),
                        'title' => esc_html__('Body Font Color', 'specular'),
                        'subtitle' => esc_html__('Base font color for the main content, in light sections', 'specular'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'headings_font_color',
                        'type' => 'color',
                        'output' => array('h1,h2,h3,h4,h5,h6', '.portfolio_single ul.info li .title, .skill_title'),
                        'title' => esc_html__('Headings Font Color', 'specular'),
                        'subtitle' => esc_html__('Base font color for headings, in light sections', 'specular'),
                        'default' => '#444444',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'base_border_color',
                        'type' => 'color',
                        'title' => esc_html__('Base Border Color', 'specular'),
                        'subtitle' => esc_html__('Base border color around the theme', 'specular'), 
                        'default' => '#e7e7e7',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'highlighted_background_main',
                        'type' => 'color',
                        'output' => array('.p_pagination .pagination span, .pagination a','.testimonial_cycle .item p', '#portfolio-filter ul li.active, #faq-filter ul li.active, .accordion.style_2 .accordion-heading .accordion-toggle, .services_medium.style_1 .icon_wrapper, .skill'),
                        'title' => esc_html__('Highlighted Background', 'specular'),
                        'subtitle' => esc_html__('Highlighted Background in main content, white sections', 'specular'), 
                        'mode' => 'background-color',
                        'default' => '#f5f5f5',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'body_background',
                        'type' => 'background',
                        'output' => array('body, html', '.viewport'),
                        'title' => esc_html__('Background', 'specular'),
                        'subtitle' => esc_html__('Add a background to body', 'specular'),
                        'default' => 'transparent',
                    ),

                    array(
                        'id' => 'page_content_background_overall',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'output' => array('#content'),
                        'title' => esc_html__('Content Background', 'specular'),
                        'subtitle' => esc_html__('Add a background to content', 'specular'),
                        'default' => 'transparent',
                    ),
                    



                )
            ));
            
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Default Page Header', 'specular'),
                'fields' => array(
                        array( 
                            'id' => 'page_header_normal_typography',
                            'type' => 'typography',
                            'title' => esc_html__('Normal Style No Subtitle Title Typography', 'specular'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.normal h1',
                            'default' => array(
                                'font-size' => '24px',
                                'font-weight' => '600',
                                'text-transform' => 'uppercase'
                            ),
                        ),

                        array( 
                            'id' => 'page_header_normal_typography_subtitle_title',
                            'type' => 'typography',
                            'title' => esc_html__('Normal Style With Subtitle Title Typography', 'specular'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.normal .titles h1',
                            'default' => array(
                                'font-size' => '20px',
                                'font-weight' => '600',
                                'text-transform' => 'uppercase' 
                            ),
                        ),
                        
                        array( 
                            'id' => 'page_header_normal_typography_subtitle_subtitle',
                            'type' => 'typography',
                            'title' => esc_html__('Normal Style With Subtitle Subtitle Typography', 'specular'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.normal .titles h3',
                            'default' => array(
                                'font-size' => '13px',
                                'font-weight' => '400',
                                'text-transform' => 'none' 
                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_nosub_title',
                            'type' => 'typography',
                            'title' => esc_html__('Centered Style No Subtitle Title Typography', 'specular'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.centered h1',
                            'default' => array(
                                'font-size' => '38px',
                                'font-weight' => '300', 
                                'text-transform' => 'none'
                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_subtitle_title',
                            'type' => 'typography',
                            'title' => esc_html__('Centered Style With Subtitle Title Typography', 'specular'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>true, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true, 
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.centered .titles h1',
                            'default' => array(
                                'font-size' => '48px',
                                'font-weight' => '600',
                                'text-transform' => 'uppercase',
                                'letter-spacing' => '4px' 
                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_subtitle_subtitle',
                            'type' => 'typography',
                            'title' => esc_html__('Centered Style With Subtitle Subtitle Typography', 'specular'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false, 
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.centered .titles h3',
                            'default' => array(
                                'font-size' => '26px',
                                'font-weight' => '300', 
                                'text-transform' => 'none',
                            ),
                        ),
                        
                        array(
                                'id' => 'page_header_design_style',
                                'type' => 'select',
                                'title' => esc_html__('Page Header Design Style', 'specular'),
                                'subtitle' => esc_html__('Select the design style for the default page header', 'specular'),
                                'options' => array('normal' => esc_attr__('Basic no padding and background, with little border', 'specular'), 'padd' => esc_attr__('With padding and background', 'specular')), //Must provide key => value pairs for select options
                                'default' => 'normal'
                        ),

                        array(
                            'id' => 'page_header_padd_bg_title',
                            'title' => esc_html__('Page Header with padding style title bg color', 'specular'),
                            'mode' => 'background-color',
                            'type' => 'color_rgba',
                            'default'  => array(
                                'color' => '#000', 
                                'alpha' => '0.70'
                            ),
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'colorrgba',
                        ),
                        array(
                            'id' => 'page_header_padd_bg_subtitle',
                            'title' => esc_html__('Page Header with padding style subtitle bg color', 'specular'),
                            'mode' => 'background-color',
                            'type' => 'color_rgba',
                            'default'  => array(
                                'color' => '#fff', 
                                'alpha' => '0.70'
                            ),
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'colorrgba',
                        ),
                        array(
                            'id' => 'page_header_padd_bg_subtitle_font',
                            'title' => esc_html__('Page Header with padding style subtitle font color', 'specular'),
                            'mode' => 'color',
                            'type' => 'color',
                            'default'  => '#222',
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'color',
                        )
                ),
                'subsection' => true
            ));

             Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Footer Styling', 'specular'),
                'fields' => array(
                    array( 
                        'id' => 'fppter_headings_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Footer Headings Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color'=>true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => 'footer#footer .widget-title',
                        'default' => array(
                            'color' => '#cdcdcd',
                            'font-weight' => '700',
                            'font-size' => '14px', 
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px'
                        ),
                    ),

                    array(
                        'id' => 'footer_body_color',
                        'type' => 'color',
                        'output' => array('footer#footer, footer#footer .contact_information dd .title'),
                        'title' => esc_html__('Footer Body Font Color', 'specular'),
                        'subtitle' => esc_html__('Select the font color for text in footer' ,  'specular'),
                        'default' => '#818181',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'footer_links_color',
                        'type' => 'color',
                        'output' => array('footer#footer a, footer#footer .contact_information dd p'),
                        'title' => esc_html__('Footer links font Color', 'specular'),
                        'subtitle' => esc_html__('Select the font color for links' ,  'specular'),
                        'default' => '#cdcdcd',
                        'validate' => 'color',
                    ),
                    
                    array(
                        'id' => 'footer_background_color',
                        'type' => 'color',
                        'output' => array('footer#footer .inner'),
                        'title' => esc_html__('Footer Background Color', 'specular'),
                        'subtitle' => esc_html__('Color for the footer main part' ,  'specular'), 
                        'mode' => 'background-color',
                        'default' => '#1c1c1c',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'copyright_background_color',
                        'type' => 'color',
                        'output' => array('#copyright, footer .widget_recent_comments li, footer .tagcloud a'),
                        'title' => esc_html__('Copyright Background Color', 'specular'),
                        'subtitle' => esc_html__('Color for the latest part of the footer' ,  'specular'), 
                        'mode' => 'background-color',
                        'default' => '#222222',
                        'validate' => 'color',
                    ),

                    array( 
                        'id'       => 'footer_border_top',
                        'type'     => 'border',
                        'title'    => esc_html__('Footer Border Top', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        'output'   => array('footer#footer'),
                        'right'    => false,
                        'top'      => true, 
                        'left'     => false,
                        'bottom'   => false,
                        'color'    => true,
                        'style'    => true, 
                        'desc'     => esc_html__('Add Border top for footer', 'specular'),
                        'default'  => array(
                            'color'  => '', 
                            'border-style'  => 'solid',
                            'border-top'    => '0px'
                        )
                    ),

                    array(
                        'id' => 'footer_social_icons_bg',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'output' => array('.footer_social_icons.circle li'),
                        'title' => esc_html__('Social Icons Circle BG', 'specular'),
                        'subtitle' => esc_html__('Circle background color' ,  'specular'),
                        'default' => '#222222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'footer_social_icons_icon',
                        'type' => 'color',
                        'output' => array('.footer_social_icons.circle li a i'),
                        'title' => esc_html__('Social Icons Circle Icon Color', 'specular'),
                        'subtitle' => esc_html__('Circle icon color' ,  'specular'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),


                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Blog Styling', 'specular'),
                'fields' => array(
                    array( 
                        'id' => 'blog_title_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Blog Title Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.standard-style .content h1,.blog-article.standard-style .content > h2, .blog-article.alternative-style .content h1, .blog-article.timeline-style .content h1',
                        'default' => array(
                            'font-weight' => '700',
                            'color' => '#444444',
                            'text-transform' => 'uppercase', 
                            'line-height' => '30px',
                            'font-size' => '20px'
                        ),
                    ),
                    
                    array( 
                        'id' => 'blog_info_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Blog Info List Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true,  
                        'font-weight' => false, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true,
                        'preview' => false, 
                        'text-align' => false,
                        'text-transform' => false, 
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.alternate-style .info, .blog-article.timeline-style .info, .blog-article.standard-style .info, .blog-article.grid-style .info, .fullscreen-single .info, .recent_news .blog-item .info, .latest_blog .blog-item .info ',
                        'default' => array(
                            'color' => '#999999',
                            'font-size' => '12px',
                            'line-height' => '20px' 
                        ),
                    ),

                    array( 
                        'id' => 'blog_info_typography_icon',
                        'type' => 'typography',
                        'title' => esc_html__('Blog Info List Icon Size', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false,  
                        'font-weight' => false, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => false,
                        'preview' => false, 
                        'text-align' => false,
                        'text-transform' => false, 
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.alternate-style .info i, .blog-article.timeline-style .info i, .blog-article.standard-style .info i, .blog-article.grid-style .info, .fullscreen-single .info i, .latest_blog .blog-item .info i, .recent_news .blog-item .info i ',
                        'default' => array(
                            'font-size' => '15px'
                        ),
                    ),

                    array(
                        'id' => 'timeline_box_shadow',
                        'type' => 'switch',
                        'title' => esc_html__('Active Timeline (or for masonry) Box Shadow', 'specular'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'timeline_bg_color',
                        'type' => 'color',
                        'output' => array('.blog-article.timeline-style .post_box, .blog-article.grid-style .gridbox'),
                        'title' => esc_html__('Timeline (or masonry) post box bg color', 'specular'),
                        'mode' => 'background-color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'fullscreen_blog_box_bg', 
                        'output' => array('.fullscreen-blog-article .content'),
                        'title' => esc_html__('Fullscreen Blog Content Box BG', 'specular'),
                        'mode' => 'background-color',
                        'type' => 'color_rgba',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba',
                    )
                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Sidebar Styling', 'specular'),
                'fields' => array(
                    array( 
                        'id' => 'sidebar_widget_title',
                        'type' => 'typography',
                        'title' => esc_html__('Widget Title', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => 'aside .widget-title, .portfolio_single h4',
                        'default' => array(
                            'font-weight' => '700',
                            'color' => '#444444',
                            'font-size' => '15px',
                            'text-transform' => 'uppercase', 
                            'line-height' => '20px',
                            'letter-spacing' => '1px'
                        ),
                    ),
                    
                    array(
                        'id' => 'sidebar_widget_title_margin',
                        'type' => 'spacing',
                        'output' => array('aside .widget-title'), // An array of CSS selectors to apply this font style to
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => esc_html__('Widget Title Margin Bottom', 'specular'),
                        'desc' => esc_html__('Unit: px', 'specular'),
                        'default' => array('margin-bottom' => '24px')
                    ),

                    array(
                        'id' => 'sidebar_widget_margin',
                        'type' => 'spacing',
                        'output' => array('aside .widget'), // An array of CSS selectors to apply this font style to
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => esc_html__('Widget Margin Bottom', 'specular'),
                        'desc' => esc_html__('Unit: px', 'specular'),
                        'default' => array('margin-bottom' => '35px')
                    ),
                    
                    array(
                        'id' => 'sidebar_tagcloud_bg',
                        'type' => 'color',
                        'output' => array('aside .tagcloud a'),
                        'title' => esc_html__('Sidebar Tagcloud Background', 'specular'),
                        'mode' => 'background-color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'sidebar_tagcloud_color',
                        'type' => 'color',
                        'output' => array('aside .tagcloud a'),
                        'title' => esc_html__('Sidebar Tagcloud Font color', 'specular'),
                        'mode' => 'color',
                        'default' => '#fff',
                        'validate' => 'color',
                    )

                ), 
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Sliders Styling', 'specular'),
                'fields' => array(
                    array(
                        'id' => 'codeless_slider_wrapper_bg',
                        'type' => 'color',
                        'output' => array('.codeless_slider_wrapper'),
                        'title' => esc_html__('Codeless Slider Wrapper Background Color', 'specular'),
                        'mode' => 'background-color',
                        'default' => '#222',
                        'validate' => 'color'
                    ),
                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Filters Styling', 'specular'),
                'fields' => array(
                    array( 
                        'id' => 'portfolio_filter_basic_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Portfolio Filter & FAQ Filter Basic Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '#portfolio-filter ul li a, #faq-filter ul li a',
                        'default' => array(
                            'font-weight' => '600',
                            'color' => '#bebebe',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px'
                        ),
                    ),
                    
                    array(
                        'id' => 'portfolio_filter_basic_typography_active',
                        'type' => 'color',
                        'output' => array('#portfolio-filter ul li.active a, #portfolio-filter ul li a:hover, #faq-filter ul li.active a, #faq-filter ul li a:hover'),
                        'title' => esc_html__('Portfolio Filter & FAQ Filter Basic Typography (Active)', 'specular'),
                        'mode' => 'color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_bg',
                        'type' => 'color',
                        'output' => array('.content_portfolio.fullwidth .filter-row'),
                        'title' => esc_html__('Portfolio Filter Fullwidth Background Color', 'specular'),
                        'mode' => 'background-color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_link_color',
                        'type' => 'color_rgba',
                        'output' => array('.content_portfolio.fullwidth #portfolio-filter ul li a'),
                        'title' => esc_html__('Portfolio Filter Fullwidth Item color', 'specular'),
                        'mode' => 'color',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '0.80'
                        ),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array('.content_portfolio.fullwidth #portfolio-filter ul li a:hover'),
                        'title' => esc_html__('Portfolio Filter Fullwidth Item hover color ', 'specular'),
                        'mode' => 'color',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba',
                    ),

                ),
                'subsection' => true,
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Portfolio Styling', 'specular'),
                'fields' => array(
                    array(
                        'id' => 'portfolio_overlay_bg',
                        'type' => 'color_rgba',
                        'output' => array('.portfolio-item.overlayed .tpl2 .bg'),
                        'title' => esc_html__('Portfolio Overlay BG Color ', 'specular'),
                        'mode' => 'background-color',
                        'default'  => array(
                            'color' => '#10b8c7',  
                            'alpha' => '0.90'
                        ),
                        'validate' => 'colorrgba',
                    ),
                    array( 
                        'id' => 'portfolio_overlay_title',
                        'type' => 'typography',
                        'title' => esc_html__('Portfolio Overlay Title Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.overlayed h4',
                        'default' => array(
                            'font-weight' => '600',
                            'color' => '#fff',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => ''
                        ),
                    ),

                    array( 
                        'id' => 'portfolio_overlay_subtitle',
                        'type' => 'typography',
                        'title' => esc_html__('Portfolio Overlay Subtitle Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.overlayed h6',
                        'default' => array(
                            'font-size' => '14px',
                            'font-weight' => '300',
                            'color' => '#fff',
                            'text-transform' => 'none'
                        ),
                    ),
                    
                    array(
                        'id' => 'portfolio_grayscale_bg',
                        'type' => 'color',
                        'output' => array('.portfolio-item.grayscale .project'),
                        'title' => esc_html__('Portfolio Grayscale Background', 'specular'),
                        'mode' => 'background-color',
                        'default' => '#fff',
                        'validate' => 'color',
                    ),

                    array( 
                        'id' => 'portfolio_grayscale_title',
                        'type' => 'typography',
                        'title' => esc_html__('Portfolio Grayscale Title Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.grayscale .project h5',
                        'default' => array(
                            'color' => '',
                            'font-weight' => '600'
                        ),
                    ),
 
                    array(
                        'id' => 'portfolio_grayscale_subtitle',
                        'type' => 'color',
                        'output' => array('.portfolio-item.grayscale .project h6'),
                        'title' => esc_html__('Portfolio Grayscale Subtitle Color', 'specular'),
                        'mode' => 'color',
                        'default' => '#bebebe',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_basic_overlay_bg',
                        'type' => 'color_rgba',
                        'output' => array('.portfolio-item.basic .bg'),
                        'title' => esc_html__('Portfolio Basic Overlay Background', 'specular'),
                        'mode' => 'background-color',
                        'default' => array(
                            'color' => '#fff',
                            'alpha' => '0.90'
                        ),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'portfolio_basic_overlay_icon_color',
                        'type' => 'color',
                        'output' => '.portfolio-item.basic .link',
                        'title' => esc_html__('Portfolio Basic Icon Color', 'specular'),
                        'mode' => 'color',
                        'default' => '#fff',
                        'validate' => 'color',
                    ),

                    array( 
                        'id' => 'portfolio_basic_title',
                        'type' => 'typography',
                        'title' => esc_html__('Portfolio Basic Title Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.basic .show_text h5',
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '600',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px',
                            'text-align' => 'center'
                        ),
                    ),

                    array( 
                        'id' => 'portfolio_basic_subtitle',
                        'type' => 'typography',
                        'title' => esc_html__('Portfolio Basic Subtitle Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.basic .show_text h6',
                        'default' => array(
                            'color' => '#888',
                            'font-weight' => '400',
                            'text-align' => 'center'
                        ),
                    ),

                    

                ),
                'subsection' => true,
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Elements Styling', 'specular'),
                'fields' => array(
                    array( 
                        'id' => 'toggle_title_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Toggle title typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.accordion.style_2 .accordion-heading .accordion-toggle, .accordion.style_1 .accordion-heading .accordion-toggle',
                        'default' => array(
                            'color' => '#555',
                            'font-weight' => '600',
                            'font-size' => '15px',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px'
                        ),
                    ),
                    array(
                        'id' => 'toggle_active_color',
                        'type' => 'color',
                        'output' => '.accordion.style_1 .accordion-heading.in_head .accordion-toggle, .accordion.style_2 .accordion-heading.in_head .accordion-toggle',
                        'title' => esc_html__('Activated Toggle Font Color', 'specular'),
                        'mode' => 'color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array( 
                        'id' => 'block_title_column_title',
                        'type' => 'typography',
                        'title' => esc_html__('Block Title Element (Column) Title', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'line-height' => true,
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.column_title .h1',
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '600',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px',
                            'line-height' => '24px',
                            'text-align' => 'left'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_column_subtitle',
                        'type' => 'typography',
                        'title' => esc_html__('Block Title Element (Column) Subtitle', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.column_title h2',
                        'default' => array(
                            'color' => '#888',
                            'font-weight' => '300',
                            'text-transform' => 'none',
                            'text-align' => 'left'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_section_title',
                        'type' => 'typography',
                        'title' => esc_html__('Block Title Element (Section) Title', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.section_title .h1',
                        'default' => array(
                            'color' => '',
                            'font-size' => '20px',
                            'font-weight' => '700',
                            'text-transform' => 'uppercase',
                            'line-height' => '38px',
                            'letter-spacing' => '1.5px'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_section_desc',
                        'type' => 'typography',
                        'title' => esc_html__('Block Title Element (Section) Desc', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.section_title p',
                        'default' => array(
                            'color' => '#555',
                            'font-weight' => '400',
                            'text-transform' => '',
                            'line-height' => '20px',
                            'font-size' => '14px'
                        ),
                    ),

                    array( 
                        'id' => 'animated_counter_typ',
                        'type' => 'typography',
                        'title' => esc_html__('Animated Counters Typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.odometer',
                        'default' => array(
                            'color' => '#444',
                            'font-weight' => '600',
                            'font-size' => '48px',
                            'line-height' => '48px',
                            'letter-spacing' => '-1px'
                        ),
                    ),
                    array( 
                        'id' => 'testimonial_text',
                        'type' => 'typography',
                        'title' => esc_html__('Testimonial typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => false,
                        'line-height' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.testimonial_carousel .item p',
                        'default' => array(
                            'color' => '#444',
                            'font-weight' => '300',
                            'font-size' => '18px',
                            'line-height' => '30px'
                        ),
                    ),

                    array( 
                        'id' => 'textbar_title_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Textbar title typography', 'specular'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.textbar h2',
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '600',
                            'font-size' => '24px',
                            'text-transform' => 'none',
                            'letter-spacing' => '0px'
                        ),
                    ),
                    array(
                        'id' => 'contact_border',
                        'type' => 'color',
                        'output' => '',
                        'title' => esc_html__('Contact Form Elements Border', 'specular'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    )
                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Buttons Styling', 'specular'),
                'fields' => array(
                    array(
                        'id'       => 'overall_button_style',
                        'type'     => 'select',
                        'multi'    => true,
                        'options'  => array(
                            'default' => esc_attr__('Default (Border and Effect)', 'specular'),
                            'business' => esc_attr__('Business', 'specular'),
                            'modern' => esc_attr__('Modern Shadow', 'specular'),
                            'no_padding' => esc_attr__('Without padding', 'specular'),
                            'rounded' => esc_attr__('Rounded', 'specular'),
                            'big' => esc_attr__('Big and Shadow', 'specular'),
                            'with_icon' => esc_attr__('With Icon in the left', 'specular'),
                            'gradient' => esc_attr__('Gradient', 'specular')
                        ),
                        'default'  => array('default'),
                        'title'    => esc_html__('Overall Button Style', 'specular')
                    ),


                    array( 
                        'id' => 'button_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Overall button typography', 'specular'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '',
                        'default' => array(
                            'color' => '#222',
                            'font-family' => codeless_get_mod( 'body_typography', 'font-family' ),
                            'font-weight' => '600',
                            'font-size' => '13px',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1.5px'
                        )
                    ),
                    array(
                        'id' => 'button_background_color',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Overall button background', 'specular'),
                        'default'  => array(
                            'color' => '#ffffff',  
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba'
                    ),
                    array(
                        'id' => 'button_border_color',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Overall button border', 'specular'),
                        'default'  => array(
                            'color' => '#444444', 
                            'alpha' => '0.20'
                        ),
                        'validate' => 'colorrgba'
                    ),
                    array(
                        'id' => 'button_hover_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => esc_html__('Overall button hover Font Color', 'specular'),
                        'default' => '#222',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_hover_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Overall button hover bg', 'specular'),
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_hover_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Overall button hover border', 'specular'),
                        'default'  => array(
                            'color' => '#444', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba'
                    ),

                    array(
                        'id' => 'button_light_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => esc_html__('Light button Font Color', 'specular'),
                        'default' => '#fff',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_light_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Light button bg', 'specular'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_light_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Light button border', 'specular'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '0.40'
                        ),
                        'validate' => 'colorrgba'
                    ),

                    array(
                        'id' => 'button_light_hover_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => esc_html__('Light button hover Font Color', 'specular'),
                        'default' => '#fff',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_light__hover_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Light button hover bg', 'specular'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_light_hover_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => esc_html__('Light button hover border', 'specular'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba'
                    ),
                ),
                'subsection' => true
            ) );     

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Shop Styling', 'specular'),
                'fields' => array(
                    
                    array(
                        'id' => 'shop_single_title',
                        'type' => 'typography',
                        'title' => esc_html__('Shop Single Product Title', 'specular'),
                        'compiler'=>false, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'=>false, // Only appears if google is true and subsets not set to false
                        'font-size'=>false,
                        'font-family' => false,
                        'text-transform' => true,
                        'line-height'=>false,
                        //'word-spacing'=>true, // Defaults to false
                        'letter-spacing'=>true, // Defaults to false
                        'color'=>false,
                        //'preview'=>false, // Disable the previewer
                        'text-align' => false,
                        'font-weight' => true,
                        'all-styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title, .woocommerce ul.products li.product h6, .woocommerce-page ul.products li.product h6'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for single product title', 'specular'),
                        'default' => array(
                            'font-weight' => '700',
                            'letter-spacing' => '1.5',
                            'text-transform' => 'uppercase'
                        ),
                    ),

                    array(
                        'id' => 'shop_product_overlay',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Shop item overlay', 'specular'),
                        'mode' => 'background-color', 
                        'default'  => array(
                            'color' => '#10b8c7', 
                            'alpha' => '0.90'
                        ),
                        'validate' => 'colorrgba',
                    ),
                ),
                'subsection' => true
            ));
                   
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-text-width',
                'title' => esc_html__('Typography Options', 'specular'),
                'fields' => array(
                    array(
                        'id' => 'body_typography',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font Style', 'specular'),
                        'compiler'=>false, 
                        'google' => true, 
                        'font-backup' => true,
                        'font-style'=>true, 
                        'line-height'=>true,
                        'text-align' => false,
                        'font-weight' => true,
                        'all-styles' => true,
                        'output' => array('body'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for the body text', 'specular'),
                        'default' => array(
                            'color' => "#777",
                            'font-family' => esc_attr__('Open Sans', 'specular'),
                            'google' => true,
                            'line-height' => '28px',
                            'font-size' => '16px',
                            'font-weight' => '400' 
                        ),
                    ),

                    
                    array(
                        'id' => 'headings_font_type',
                        'type' => 'typography',
                        'title' => esc_html__('Headings font type', 'specular'),
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => true,
                        'font-style' => true,
                        'subsets' => false,
                        'font-size' => false,
                        'line-height'=>false,
                        'color'=>false,
                        'font-family' => true,
                        'text-align' => false,
                        'all-styles' => true,
                        'compiler' => false,
                        'output' => array('h1,h2,h3,h4,h5,h6', '.skill_title'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for the body text', 'specular'),
                        'default' => array(
                            'font-family' => esc_attr__('Open Sans', 'specular'),
                            'google' => true,
                            'font-weight' => '600'
                        ),
                    ),


                    array(
                        'id' => 'heading_1_font',
                        'type' => 'typography',
                        'title' => esc_html__('Heading 1 Font style', 'specular'),
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'font-style' => false,
                        'line-height'=>true,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h1, .h1'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for the h1 text', 'specular'),
                        'default' => array(
                            'line-height' => '24px',
                            'google' => true,
                            'font-size' => '20px'
                        ),
                    ),
                    array(
                        'id' => 'heading_2_font',
                        'type' => 'typography',
                        'title' => esc_html__('Heading 2 Font style', 'specular'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'font-style' => false,
                        'line-height'=>true,
                        'color'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'preview'=>false,
                        'output' => array('h2'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for this heading', 'specular'),
                        'default' => array(
                            'line-height' => '30px',
                            'google' => true,
                            'font-size' => '24px'
                        ),
                    ),
                    array(
                        'id' => 'heading_3_font',
                        'type' => 'typography',
                        'title' => esc_html__('Heading 3 Font style', 'specular'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'preview'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'output' => array('h3'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for this heading', 'specular'),
                        'default' => array(
                            'line-height' => '26px',
                            'google' => true,
                            'font-size' => '18px'
                        ),
                    ),
                    array(
                        'id' => 'heading_4_font',
                        'type' => 'typography',
                        'title' => esc_html__('Heading 4 Font style', 'specular'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h4'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for this heading', 'specular'),
                        'default' => array(
                            'line-height' => '24px',
                            'google' => true,
                            'font-size' => '16px'
                        ),
                    ),
                    array(
                        'id' => 'heading_5_font',
                        'type' => 'typography',
                        'title' => esc_html__('Heading 5 Font style', 'specular'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h5'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for this heading', 'specular'),
                        'default' => array(
                            'line-height' => '22px',
                            'google' => true,
                            'font-size' => '15px'
                        ),
                    ),
                    array(
                        'id' => 'heading_6_font',
                        'type' => 'typography',
                        'title' => esc_html__('Heading 6 Font style', 'specular'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'preview'=>false,
                        'output' => array('h6'), 
                        'units' => 'px',
                        'subtitle' => esc_html__('Select the appropiate font style for this heading', 'specular'),
                        'default' => array(
                            'line-height' => '20px',
                            'google' => true,
                            'font-size' => '14px'
                        ),
                    ),
                )
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => esc_html__('Footer Options', 'specular'),
                'fields' => array(
                    array(
                        'id'       => 'footer_columns',
                        'type'     => 'image_select',
                        'title'    => esc_html__('Footer Columns', 'specular'), 
                        'subtitle' => esc_html__('Select how many columns do you want for the footer. Choose between 1, 2, 3 or 4 column layout.', 'specular'),
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
                            )
                        ),
                        'default' => '2'
                    ),
                    
                    array(
                        'id' => 'copyright_text',
                        'type' => 'editor',
                        'title' => esc_html__('Copyright Text in the end of footer', 'specular'),
                        'subtitle' => esc_html__('Text have to be placed in the copyright bar', 'specular'),
                        'default' => '@2014 Specular - Multi-Purpose theme from <a href="http://codeless.co">Code-less</a>, builded with <a href="#">Wordpress</a>, <a href="#">Visual Composer</a> and <a href="#">Redux</a>',
                    ),

                    array(
                        'id' => 'show_footer',
                        'type' => 'switch',
                        'title' => esc_html__('Show Footer', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'show_copyright',
                        'type' => 'switch',
                        'title' => esc_html__('Show Copyright', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 0,
                    ),

                )
            ));
            

            

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-file-edit',
                'title' => esc_html__('Blog Config', 'specular'),
                'fields' => array(
                    array(
                        'id' => 'blog_style',
                        'type' => 'select',
                        'title' => esc_html__('Blog Style', 'specular'),
                        'subtitle' => esc_html__('Select the blog style to be used', 'specular'),
                        'options' => array('normal' => esc_attr__('Normal', 'specular'), 'timeline' => esc_attr__('Timeline', 'specular'), 'alternate' => esc_attr__('Alternate', 'specular'), 'grid' => esc_attr__('Masonry', 'specular'), 'fullscreen' => esc_attr__('Fullscreen Innovative', 'specular')), //Must provide key => value pairs for select options
                        'default' => 'normal'
                    ),


                    array(
                        'id' => 'post_style',
                        'type' => 'select',
                        'title' => esc_html__('Post Style', 'specular'),
                        'subtitle' => esc_html__('Select the post style to be used. You can overwrite this option in each post', 'specular'),
                        'options' => array('normal' => esc_attr__('Normal', 'specular'), 'modern' => esc_attr__('Modern', 'specular'), 'fullscreen' => esc_attr__('Fullscreen', 'specular')), //Must provide key => value pairs for select options
                        'default' => 'modern'
                    ),

                    array(
                        'id' => 'blog_grid_col',
                        'title' => esc_html__( 'Blog Masonry Columns', 'specular' ),
                        'desc' => esc_attr__('Number of columns for the layout', 'specular'),
                        'type' => 'image_select',
                        'options'  => array(
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
                            ),
                        'default' => '3',
                        'required' => array('blog_style', 'equals', 'grid')
                    ),

                    array(
                        'title'     => esc_html__( 'Layout', 'specular' ),
                        'desc'      => esc_html__( 'Select main content and sidebar arrangement.', 'specular' ),
                        'id'        => 'bloglayout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),

                    array(
                        'title'     => esc_html__( 'Single Post Layout', 'specular' ),
                        'desc'      => esc_html__( 'Select the default single post sidebar position', 'specular' ),
                        'id'        => 'singlebloglayout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),
                    array(
                        'id' => 'post_like',
                        'type' => 'switch',
                        'title' => esc_html__('Active Post Like', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'social_shares',
                        'type' => 'switch',
                        'title' => esc_html__('Social Shares on Posts', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'blog_pagination',
                        'type' => 'select',
                        'title' => esc_html__('Select the pagination method', 'specular'),
                        'options' => array('no_pagination' => esc_attr__('Without pagination', 'specular'), 'with_pagination' => esc_attr__('With Pagination', 'specular'), 'infinite_scroll' => esc_attr__('Infinite Scroll', 'specular')),
                        'default' => 'with_pagination'
                    ),

                    array(
                        'id' => 'blog_info_author',
                        'type' => 'switch',
                        'title' => esc_html__('Show author at blog post', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_date',
                        'type' => 'switch',
                        'title' => esc_html__('Show date at blog post', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_comments',
                        'type' => 'switch',
                        'title' => esc_html__('Show comments count at blog post', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_tags',
                        'type' => 'switch',
                        'title' => esc_html__('Show tags at blog post', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 1,
                    ),

                )
            ));

            
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-view-mode',
                'title' => esc_html__('Portfolio Config', 'specular'),
                'fields' => array(
                    array(
                        'id' => 'portfolio_slug',
                        'type' => 'text',
                        'title' => esc_html__('Portfolio Slug', 'specular'),
                        'default' => 'codeless_portfolio'
                    ),
                    array(
                        'id'=>'single_portfolio_custom_params',
                        'type' => 'multi_text',
                        'title' => esc_html__('Custom fields Parameters', 'specular'),
                        'subtitle' => esc_html__('Create unlimited custom fields. Add values in respetive single portfolio', 'specular') 
                    ),
                    array(
                        'id' => 'portfolio_post_like',
                        'type' => 'switch',
                        'title' => esc_html__('Active Portfolio Item Like', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 0,
                    ),
                )
            ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-fullscreen',
                'title' => esc_html__('Layout', 'specular'),
                'fields' => array(
                    array(
                        'id' => 'site_layout',
                        'type' => 'select',
                        'title' => esc_html__('Overall site layout', 'specular'),
                        'subtitle' => esc_html__('Select overall ste pages layout', 'specular'),
                        'options' => array('fullwidth' => esc_attr__('Fullwidth', 'specular'), 'boxed' => esc_attr__('Boxed', 'specular')), //Must provide key => value pairs for select options
                        'default' => 'fullwidth'
                    ),

                    array(
                        'title'     => esc_html__( 'Pages Default Layout', 'specular' ),
                        'desc'      => esc_html__( 'Select default layout for pages. You can overwrite it in Page Options', 'specular' ),
                        'id'        => 'page_overall_layout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),

                    array(
                        'title'     => esc_html__( 'Shop Categories/Archives  Layout', 'specular' ),
                        'desc'      => esc_html__( 'Select layout for shop categories and archives.', 'specular' ),
                        'id'        => 'shop_archive_layout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),

                    array(
                        'title'     => esc_html__( 'Shop Single Product Layout', 'specular' ),
                        'desc'      => esc_html__( 'Layout for shop single product', 'specular' ),
                        'id'        => 'shop_single_layout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),
                    

                    array(
                        'id' => 'page_container_width',
                        'type' => 'dimensions', 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => esc_html__('Page Container Width', 'specular'),
                        'subtitle' => esc_html__('units: px', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'default' => array('width' => '1100px')
                    ),

                    array(
                        'id' => 'page_container_width_percent',
                        'type' => 'dimensions',
                        'units' => '%', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => esc_html__('Page Container Width with percentage', 'specular'),
                        'subtitle' => esc_html__('units: px', 'specular'),
                        'desc' => esc_html__('If you set the width in percentage, the page container width in pixel should be used as max-width', 'specular'),
                        'default' => array('width' => '87%')
                    ),

                    array(
                        'id' => 'boxed_container_width',
                        'type' => 'dimensions', 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => esc_html__('Boxed Container Width', 'specular'),
                        'subtitle' => esc_html__('units: px', 'specular'),
                        'desc' => esc_html__('', 'specular'),
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'default' => array('width' => '1100px'),

                    ),

                    array(
                        'id' => 'boxed_container_width_percent',
                        'type' => 'dimensions',
                        'units' => '%', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => esc_html__('Boxed Container Width with percentage', 'specular'),
                        'subtitle' => esc_html__('units: px', 'specular'),   
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'desc' => esc_html__('If you set the width in percentage, the boxed container width in pixel should be used as max-width', 'specular'),
                        'default' => array('width' => '87%')
                    ),

                    array(
                        'title'=> esc_html__( 'Boxed Container Margin', 'specular' ),
                        'desc' => esc_html__( 'Boxed Container Top/Bottom Margin', 'specular' ),
                        'id'   => 'boxed_container_margin',
                        'type' => 'spacing',
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'right' => false, // Disable the right
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('margin-bottom' => '30px', 'margin-top' => '30px'),
                        'required' => array('site_layout', 'equals', 'boxed')
                    ),

                    array(
                        'id' => 'boxed_shadow',
                        'type' => 'switch',
                        'title' => esc_html__('Boxed Container Shadow', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        'required' => array('site_layout', 'equals', 'boxed'),
                        "default" => 1,
                    ),

                    array(
                        'id'       => 'boxed_border',
                        'type'     => 'border',
                        'title'    => esc_html__('Boxed Container Border', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        'output'   => array('.boxed_layout'),
                        'all'      => true,
                        'color'    => true,
                        'style'    => true, 
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'desc'     => esc_html__('Add Border for boxed container', 'specular'),
                        'default'  => array(
                            'color'  => '#e7e7e7', 
                            'border-style'  => 'solid',
                            'border'    => '0px'
                        )
                    ),

                    array(
                        'id' => 'extra_navigation',
                        'type' => 'switch',
                        'title' => esc_html__('Extra Side Navigation', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        "default" => 0,
                    ),

                    array(
                        'title'     => esc_html__( 'Extra Navigation Position', 'specular' ),
                        'desc'      => esc_html__( 'Select the default single post sidebar position', 'specular' ),
                        'id'        => 'extra_navigation_position',
                        'default'   => 'right',
                        'type'      => 'image_select',
                        'customizer'=> array(), 
                        'options'   => array( 
                            'left'     => ReduxFramework::$_url . 'assets/img/2cl.png',
                            'right' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        'required' => array('extra_navigation', 'equals', 1),
                    ),

                    array(
                        'title'=> esc_html__( 'Page Builder Row Margin Bottom', 'specular' ),
                        'desc' => esc_html__( 'Margin bottom for the ROW in Page builder', 'specular' ),
                        'id'   => 'row_margin_bottom',
                        'type' => 'spacing',
                        'output' => array('.vc_row.section-style, .vc_row.standard_section'),
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('margin-bottom' => '85px')
                    ),

                    array(
                        'title'=> esc_html__( 'Inner Page Content Padding', 'specular' ),
                        'desc' => esc_html__( 'Change padding of the inner page content', 'specular' ),
                        'id'   => 'content_padding',
                        'type' => 'spacing',
                        'output' => array('#content'), 
                        'mode' => 'padding', // absolute, padding, margin, defaults to padding
                        'top' => true, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('padding-bottom' => '85px','padding-top' => '85px')
                    )
                    
                )
            ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-heart',
                'title' => esc_html__('Clients', 'specular'),
                'fields' => array(
                    array(
                        'id'       => 'clients_dark',
                        'type'     => 'slides',
                        'title'    => esc_html__('Add/Edit Clients Dark Version', 'specular'),
                        'subtitle' => esc_html__('Upload clients logo here', 'specular')
                    ),

                    array(
                        'id'       => 'clients_light',
                        'type'     => 'slides',
                        'title'    => esc_html__('Add/Edit Clients Light Version', 'specular'),
                        'subtitle' => esc_html__('Upload clients logo here', 'specular')
                    ),

                )
            ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-twitter',
                'title' => esc_html__('Social Media', 'specular'),
                'fields' => array(
                    array(
                        'id'       => 'facebook',
                        'type'     => 'text',
                        'title'    => esc_html__('Facebook Link', 'specular')
                    ),
                    array(
                        'id'       => 'twitter',
                        'type'     => 'text',
                        'title'    => esc_html__('Twitter Link', 'specular')
                    ),
                    array(
                        'id'       => 'pinterest',
                        'type'     => 'text',
                        'title'    => esc_html__('Pinterest Link', 'specular')
                    ),
                    array(
                        'id'       => 'flickr',
                        'type'     => 'text',
                        'title'    => esc_html__('Flickr Link', 'specular')
                    ),
                    array(
                        'id'       => 'foursquare',
                        'type'     => 'text',
                        'title'    => esc_html__('Foursquare Link', 'specular')
                    ),
                    array(
                        'id'       => 'google',
                        'type'     => 'text',
                        'title'    => esc_html__('Google Plus Link', 'specular')
                    ),
                    array(
                        'id'       => 'dribbble',
                        'type'     => 'text',
                        'title'    => esc_html__('Dribbble Link', 'specular')
                    ),
                    array(
                        'id'       => 'linkedin',
                        'type'     => 'text',
                        'title'    => esc_html__('Linkedin Link', 'specular')
                    ),

                    array(
                        'id'       => 'youtube',
                        'type'     => 'text',
                        'title'    => esc_html__('Youtube Link', 'specular')
                    ),

                    array(
                        'id'       => 'instagram',
                        'type'     => 'text',
                        'title'    => esc_html__('Instagram Link', 'specular')
                    ),

                    array(
                        'id'       => 'snapchat',
                        'type'     => 'text',
                        'title'    => esc_html__('Snapchat Link', 'specular')
                    ),

                    array(
                        'id'       => 'vimeo',
                        'type'     => 'text',
                        'title'    => esc_html__('Vimeo Link', 'specular')
                    ),

                    array(
                        'id'       => 'email',
                        'type'     => 'text',
                        'title'    => esc_html__('Email Link', 'specular')
                    ),
                )
            ));

            Redux::setSection( $opt_name, array( 
                'icon' => 'el-icon-indent-right',
                'title' => esc_html__('Custom Sidebars', 'specular'),
                'fields' => array(
                    array(
                        'id'       => 'pages_sidebar',
                        'type'     => 'select',
                        'multi'    => true,
                        'data'     => 'pages',
                        'title'    => esc_html__('Pages custom sidebars', 'specular'),
                        'subtitle' => esc_html__('Select all pages that you want a custom sidebar (widgetized area)', 'specular')
                    ),

                    array(
                        'id'       => 'categories_sidebar',
                        'type'     => 'select',
                        'multi'    => true,
                        'data'     => 'categories',
                        'title'    => esc_html__('Categories custom sidebars', 'specular'),
                        'subtitle' => esc_html__('Select all categories that you want a custom sidebar (widgetized area)', 'specular')
                    ),

                )
            ));

            Redux::setSection( $opt_name, array( 
                'icon' => 'el-icon-magic',
                'title' => esc_html__('Import / Export (Dummy Data)', 'specular'),
                'fields' => array(
                    array(
                        'id'       => 'codeless_import_export',
                        'type'     => 'codeless_import', 
                        'data'     => array(
                            array('name' => esc_attr__('Default', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/default.jpg', 'folder' => 'default', 'parts' => '1'),
                            array('name' => esc_attr__('DefaultV3', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/defaultv3.jpg', 'folder' => 'defaultv3', 'parts' => '1'),
                            array('name' => esc_attr__('SEO', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/seo.jpg', 'folder' => 'seo', 'parts' => '1'),
                            array('name' => esc_attr__('Finance', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/finance.jpg', 'folder' => 'finance', 'parts' => '1'),
                            array('name' => esc_attr__('Agency', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/agency.jpg', 'folder' => 'agency', 'parts' => '1'),
                            array('name' => esc_attr__('Agency 2', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/agency2.jpg', 'folder' => 'agency2', 'parts' => '1'),
                            array('name' => esc_attr__('Business', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/business.jpg', 'folder' => 'business', 'parts' => '1'),
                            array('name' => esc_attr__('Business 2', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/business2.jpg', 'folder' => 'business2', 'parts' => '1'),
                            array('name' => esc_attr__('Business 3', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/business3.jpg', 'folder' => 'business3', 'parts' => '1'),
                            array('name' => esc_attr__('Business 4', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/business4.jpg', 'folder' => 'business4', 'parts' => '1'),
                            array('name' => esc_attr__('Business 5', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/business5.jpg', 'folder' => 'business5', 'parts' => '1'),
                            array('name' => esc_attr__('Creative', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/creative.jpg', 'folder' => 'creative', 'parts' => '1'),
                            array('name' => esc_attr__('Church', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/church.jpg', 'folder' => 'church', 'parts' => '1'),
                            array('name' => esc_attr__('Estate', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/estate.jpg', 'folder' => 'estate', 'parts' => '1'),
                             array('name' => esc_attr__('Lawyer', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/lawyer.jpg', 'folder' => 'lawyer', 'parts' => '1'),
                            array('name' => esc_attr__('Education', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/education.jpg', 'folder' => 'education', 'parts' => '1'),
                            array('name' => esc_attr__('Magazine', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/magazine.jpg', 'folder' => 'magazine', 'parts' => '1'),
                            array('name' => esc_attr__('Marketing', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/marketing.jpg', 'folder' => 'marketing', 'parts' => '1'),
                            array('name' => esc_attr__('Medicine', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/medicine.jpg', 'folder' => 'medicine', 'parts' => '1'),
                            array('name' => esc_attr__('Minimal', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/minimal.jpg', 'folder' => 'minimal', 'parts' => '1'),
                            array('name' => esc_attr__('Minimal 2', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/minimal2.jpg', 'folder' => 'minimal2', 'parts' => '1'),
                            array('name' => esc_attr__('Micro', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/micro.jpg', 'folder' => 'micro', 'parts' => '1'),
                            array('name' => esc_attr__('One Page', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/onepage.jpg', 'folder' => 'onepage', 'parts' => '1'),
                            array('name' => esc_attr__('Parallax', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/parallax.jpg', 'folder' => 'parallax', 'parts' => '1'),
                            array('name' => esc_attr__('Personal', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/personal.jpg', 'folder' => 'personal', 'parts' => '1'),
                            array('name' => esc_attr__('Photography', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/photography.jpg', 'folder' => 'photography', 'parts' => '1'),
                            array('name' => esc_attr__('Portfolio', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/portfolio.jpg', 'folder' => 'portfolio', 'parts' => '1'),
                            array('name' => esc_attr__('Portfolio 2', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/portfolio2.jpg', 'folder' => 'portfolio_2', 'parts' => '1'),
                            array('name' => esc_attr__('Portfolio 3', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/portfolio3.jpg', 'folder' => 'portfolio_3', 'parts' => '1'),
                            array('name' => esc_attr__('Restaurant', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/restaurant.jpg', 'folder' => 'restaurant', 'parts' => '1'),
                            array('name' => esc_attr__('Shop', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/shop.jpg', 'folder' => 'shop', 'parts' => '1'),
                            array('name' => esc_attr__('Sliding', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/sliding.jpg', 'folder' => 'sliding', 'parts' => '1'),
                            array('name' => esc_attr__('Gallery', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/gallery.jpg', 'folder' => 'gallery', 'parts' => '1'),
                            array('name' => esc_attr__('Fullscreen', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/fullscreen.jpg', 'folder' => 'fullscreen', 'parts' => '1'),
                            array('name' => esc_attr__('Hotel', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/hotel.jpg', 'folder' => 'hotel', 'parts' => '1'),
                            array('name' => esc_attr__('Charity', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/charity.jpg', 'folder' => 'charity', 'parts' => '1'),
                            array('name' => esc_attr__('Digital Agency Elementor', 'specular'), 'image' => get_template_directory_uri() . '/includes/dummy_data/img/digitalagency.jpg', 'folder' => 'digitalagency', 'parts' => '1'),
                            
                        ),
                        'title'    => esc_html__('Codeless Import', 'specular'),
                        'subtitle' => esc_html__('', 'specular'),
                        'default' => 'default'
                    )
                )
            ));